<?php 
include_once("header.php");
?>

<div class="container my-5">
	
<?php

include("includes/db.php");
//include("email/email.php");

// TODO: Extract $_POST variables, check they're OK, and attempt to make a bid.
// Notify user of success/failure and redirect/give navigation options.


$number = $_POST['new_price'];
$bid_time = date("Y-m-d H:i:s");
$auction_id =$_GET['item_id'];

if (!$_SESSION['logged_in']) {
	echo('<div class="text-center">Place log-in first! <a href="listing.php?item_id=' . $auction_id . '">Continue browsing.</a></div>');
} else {
	$user_email = $_SESSION['user'];  # get this from session later

	$bid_sql_select = "SELECT * FROM bid where auction_id = '$auction_id' ORDER BY price DESC LIMIT 1";

	$bid_current_data = mysqli_fetch_array(mysqli_query($con,$bid_sql_select));
	$later_price = 0;
	if ($bid_current_data != null){
		$later_price = $bid_current_data['price'];
		$user_id = $bid_current_data['user_id'];
	}

	$auction_price_sql_select = "SELECT start_price FROM auction where auction_id = '$auction_id'";
	$start_price = mysqli_fetch_array(mysqli_query($con,$auction_price_sql_select))[0];

	if ($number < $start_price or $number <= (float)$later_price){
		echo('<div class="text-center">Bid unsuccessfully placed! <a href="listing.php?item_id=' . $auction_id . '">View your bid.</a></div>');
	} else {
		$later_bid_user_data_select = "SELECT user_id FROM user where email =  '$user_email'";
		$later_bid_user_id = mysqli_fetch_array(mysqli_query($con,$later_bid_user_data_select))[0];

		$bid_update = "INSERT INTO bid (auction_id, user_id, bid_time, price) 
					VALUES ('$auction_id', '$later_bid_user_id', '$bid_time', '$number')";
		$run_bid = mysqli_query($con,$bid_update);


		if ($run_bid and isset($user_id)) {
			$overbid_email_select = "SELECT email, user_name FROM user where user_id =  '$user_id'";
			$overbid_email_data = mysqli_fetch_array(mysqli_query($con,$overbid_email_select));
			$overbid_name = $overbid_email_data['user_name'];
			$overbid_email = $overbid_email_data['email'];
			
			$email = $overbid_email;
			$receiver = $overbid_name;
			$email_title = 'Dear bider';
			$content = '<h1>Your bid was outbid, and the current bid price is '. $number .'.</h1>' . date('Y-m-d H:i:s');
			
			include("email/email.php");
			
		}
		
		echo('<div class="text-center">Bid successfully placed! <a href="listing.php?item_id=' . $auction_id . '">View your new bid.</a></div>');
	}
}

?>

<?php include_once("footer.php")?>




