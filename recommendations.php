<?php include_once("header.php")?>
<?php require("utilities.php")?>

<div class="container">

<h2 class="my-3">Recommendations for you</h2>

<?php
  // This page is for showing a buyer recommended items based on their bid 
  // history. It will be pretty similar to browse.php, except there is no 
  // search bar. This can be started after browse.php is working with a database.
  // Feel free to extract out useful functions from browse.php and put them in
  // the shared "utilities.php" where they can be shared by multiple files.
  
  
  // TODO: Check user's credentials (cookie/session).
	$user_email = $_SESSION['user'];  # get this from session later
	
	$get_user = "select user.user_id from user where user.email='$user_email'";
	
	$run_user = mysqli_query($con,$get_user);
	$id = mysqli_fetch_array($run_user)[0];
	
	// query user
	$select_user = "SELECT user_id FROM user WHERE is_seller = 0 ORDER BY user_id";
	$array_user = mysqli_query($con,$select_user);
	while ($row_user=mysqli_fetch_array($array_user)){
		$p_user_id = $row_user[0];
		$select_vec = "SELECT case when t1.auction_id is null then 0 else 1 end AS row FROM
		(SELECT DISTINCT auction_id, user_id FROM bid WHERE user_id = '$p_user_id') AS t1 
		RIGHT JOIN (SELECT auction_id FROM auction) AS t2 ON t1.auction_id = t2.auction_id ORDER BY t2.auction_id";

		$rating_vec = mysqli_fetch_array(mysqli_query($con,$select_vec));

		if ($p_user_id != $id) {
		  $rating_mat[] = [$rating_vec[0]];
		} else {
		  $target_user = $rating_vec[0];
		}
	}
	
	$distance = 10;
	$index = -1;
	for ($v = 0; $v < count($rating_mat); $v ++){
		$M_01 = 0;
		$M_10 = 0;
		$M_11 = 0;
		
		for ($i = 0; $i < count($rating_mat[$v]); $i ++) {
			if ($rating_mat[$v][$i] == 1 and $target_user[$i] == 1) {
				$M_11 += 1;
			} elseif ($rating_mat[$v][$i] == 0 and $target_user[$i] == 1) {
				$M_01 += 1;
			} else {
				$M_10 += 1;
			}
		}
		
		$Jaccard = 1 - ($M_11 / ($M_01 + $M_11 + $M_10));
		if ($Jaccard < $distance) {
			$distance = $Jaccard;
			$index = $v;
		}
	}
	
	$num = 0;
	for ($i = 0; $i < count($rating_mat[$index]); $i ++) {
		if ($rating_mat[$index][$i] == 1 and $target_user[$i] == 0) {
			$recommend[] = [$i];
			$num += 1;
		}
	}
  // TODO: Perform a query to pull up auctions they might be interested in.
  
  // TODO: Loop through results and print them out as list items.
?>

<div class="container mt-5">

<!-- TODO: If result set is empty, print an informative message. Otherwise... -->

<ul class="list-group">

<!-- TODO: Use a while loop to print a list item for each auction listing
     retrieved from the query -->

<?php
	$select_recommend = "SELECT * FROM auction ORDER BY auction_id";
	$recommend_data = mysqli_query($con,$select_recommend);
	
	$least = 3;
	if ($num > 0){
		$count = 0;
		$recommend_count = 0;
		$length = count($recommend);
		while(($recommend_count < $length or $least >= 0) and $row = mysqli_fetch_array($recommend_data)) {
			if ($row['status'] == 0) {
				if ($count == $recommend[$recommend_count]) {
					$item_id = $row['auction_id'];
					
					$get_bid = "select * from bid where bid.auction_id ='$item_id'";
					$run_bid = mysqli_query($con,$get_bid);
					
					$num_bids = 0;
					$current_price = 0.0;
					while ($info_bid = mysqli_fetch_array($run_bid)){
						  $bid_data[] = [$info_bid[3], $info_bid[4]];
						  $num_bids = $num_bids + 1;
						  if ($info_bid[4] > $current_price) {
							  $current_price = $info_bid[4];
						  }
					}
					
					$title = $row['name'];
					$description = $row['description'];
					$end_date = new DateTime($row['end_date']);
					
					print_listing_li($item_id, $title, $description, $current_price, $num_bids, $end_date);
					$recommend_count += 1;
				} else {
					if ($least >= 0 and rand(0, 2) >= 1) {
						$item_id = $row['auction_id'];
						
						$get_bid = "select * from bid where bid.auction_id ='$item_id'";
						$run_bid = mysqli_query($con,$get_bid);
						
						$num_bids = 0;
						$current_price = 0.0;
						while ($info_bid = mysqli_fetch_array($run_bid)){
							  $bid_data[] = [$info_bid[3], $info_bid[4]];
							  $num_bids = $num_bids + 1;
							  if ($info_bid[4] > $current_price) {
								  $current_price = $info_bid[4];
							  }
						}
						
						$title = $row['name'];
						$description = $row['description'];
						$end_date = new DateTime($row['end_date']);
						
						print_listing_li($item_id, $title, $description, $current_price, $num_bids, $end_date);
						$least -= 1;
					}
				}
			}
			$count += 1;
		}
	} else {
		while($least > 0 and $row = mysqli_fetch_array($recommend_data)) {
			if ($row['status'] == 0) {
				if ($least > 0 and rand(0, 2) >= 1) {
					$item_id = $row['auction_id'];
					
					$get_bid = "select * from bid where bid.auction_id ='$item_id'";
					$run_bid = mysqli_query($con,$get_bid);
					
					$num_bids = 0;
					$current_price = 0.0;
					while ($info_bid = mysqli_fetch_array($run_bid)){
						  $bid_data[] = [$info_bid[3], $info_bid[4]];
						  $num_bids = $num_bids + 1;
						  if ($info_bid[4] > $current_price) {
							  $current_price = $info_bid[4];
						  }
					}
					
					$title = $row['name'];
					$description = $row['description'];
					$end_date = new DateTime($row['end_date']);
					
					print_listing_li($item_id, $title, $description, $current_price, $num_bids, $end_date);
					$least -= 1;
				}
			}
		}
	}
?>
<p></p>
</ul>


</div>

<?php include_once("footer.php")?>