<?php include_once("header.php")?>
<?php require("utilities.php")?>

<?php
  include("includes/db.php");
  
  // Get info from the URL:
  $item_id = $_GET['item_id'];

  // TODO: Use item_id to make a query to the database.
  $get_auction = "select * from auction where auction.auction_id ='$item_id'";
  $run_auction = mysqli_query($con,$get_auction);
  $info_auction = mysqli_fetch_array($run_auction);

  // DELETEME: For now, using placeholder data.
  $seller_id = $info_auction[2];
  $title = $info_auction[7];
  $description = $info_auction[3];
  $start_price = $info_auction[4];
  $reserve_price = $info_auction[5];
  $picture = $info_auction[6];
  $end_time = new DateTime($info_auction[1]);
  
  
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

  // TODO: Note: Auctions that have ended may pull a different set of data,
  //       like whether the auction ended in a sale or was cancelled due
  //       to lack of high-enough bids. Or maybe not.
  
  // Calculate time to auction end:
  $now = new DateTime();
  
  if ($now < $end_time) {
    $time_to_end = date_diff($now, $end_time);
    $time_remaining = ' (in ' . display_time_remaining($time_to_end) . ')';
  }
  
  // TODO: If the user has a session, use it to make a query to the database
  //       to determine if the user is already watching this item.
  //       For now, this is hardcoded.
  $watching = false;
  
  if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
	  $get_watchlist = "select * from watchlist where auction_id ='$item_id' and user_id =".$_SESSION['user_id'];
	  $run_watchlist = mysqli_fetch_array(mysqli_query($con,$get_watchlist));
	  
	  if ($run_watchlist != 0) {
		  $watching = true;
	  }
  }
?>


<div class="container">

<div class="row"> <!-- Row #1 with auction title + watch button -->
  <div class="col-sm-8"> <!-- Left col -->
    <h2 class="my-3"><?php echo($title); ?></h2>
  </div>
  <div class="col-sm-4 align-self-center"> <!-- Right col -->
<?php
  /* The following watchlist functionality uses JavaScript, but could
     just as easily use PHP as in other places in the code */
  if ($now < $end_time):
?>

<?php
  if ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) && $_SESSION['account_type'] == 0) {
?>
	<div id="watch_nowatch" <?php if ($watching) echo('style="display: none"');?> >
	  <button type="button" class="btn btn-outline-secondary btn-sm" onclick="addToWatchlist()">+ Add to watchlist</button>
	</div>
	<div id="watch_watching" <?php if (!$watching) echo('style="display: none"');?> >
	  <button type="button" class="btn btn-success btn-sm" disabled>Watching</button>
	  <button type="button" class="btn btn-danger btn-sm" onclick="removeFromWatchlist()">Remove watch</button>
	</div>
<?php } ?>
<?php endif /* Print nothing otherwise */ ?>
  </div>
</div>

<div class="row"> <!-- Row #2 with auction description + bidding info -->
  <div class="col-sm-8"> <!-- Left col with item info -->

    <div class="itemDescription">
    <?php echo($description); ?>
    </div>
	<p></p>
	<img class="img-fluid" src="<?php echo $picture ?>" >
  </div>

  <div class="col-sm-4"> <!-- Right col with bidding info -->

    <p>
<?php if ($now > $end_time): ?>
     This auction ended <?php echo(date_format($end_time, 'j M H:i')) ?>
     <!-- TODO: Print the result of the auction here? -->
	 <?php 
		$bid_sql_select = "SELECT * FROM user WHERE user.user_id = (SELECT bid.user_id FROM bid where bid.auction_id = '$item_id' ORDER BY bid.price DESC LIMIT 1)";
		$bider_data = mysqli_fetch_array(mysqli_query($con,$bid_sql_select));
		if ($bider_data != null){
			$bider_name = $bider_data['user_name'];
			$bider_email = $bider_data['email'];
		}
		
		$seller_sql_select = "SELECT * FROM user WHERE user_id = '$seller_id'";
		$seller_data = mysqli_fetch_array(mysqli_query($con,$seller_sql_select));
		if ($seller_data != null){
			$seller_name = $seller_data['user_name'];
			$seller_email = $seller_data['email'];
		}
		
		if ($current_price >= $reserve_price) {
			// send bider
			$email = $bider_email;
			$receiver = $bider_name;
			$email_title = 'Dear bider';
			$content = '<h1>Congratulations! You have successfully won the bid of '. $title .'.</h1>' . date('Y-m-d H:i:s');
			
			include("email/email.php");
			
			// send seller
			$email = $seller_email;
			$receiver = $seller_name;
			$email_title = 'Dear seller';
			$content = '<h1>Congratulations! Your goods of '. $title .' have been auctioned successfully.</h1>' . date('Y-m-d H:i:s');
			
			include("email/email.php");
			
			$auction_update = "UPDATE auction SET status = 1 WHERE auction_id = '$item_id'";
			$run_auction = mysqli_query($con,$auction_update);
			
		} else {
			// send seller
			$email = $seller_email;
			$receiver = $seller_name;
			$email_title = 'Dear seller';
			$content = '<h1>Sorry! Your goods of '. $title .' have been auctioned unsuccessfully.</h1>' . date('Y-m-d H:i:s');
			
			include("email/email.php");
			
			$auction_update = "UPDATE auction SET status = 2 WHERE auction_id = '$item_id'";
			$run_auction = mysqli_query($con,$auction_update);
		}
	 ?>
<?php else: ?>
     Auction ends <?php echo(date_format($end_time, 'j M H:i') . $time_remaining) ?></p>  
	<p class="lead">The start price: £<?php echo(number_format($start_price, 2)) ?></p>
    <p class="lead">Current bid: £<?php echo(number_format($current_price, 2)) ?></p>

    <!-- Bidding form -->
    <form method="POST" action="place_bid.php?item_id=<?php echo "$item_id"; ?> ">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">£</span>
        </div>
	    <input name="new_price" atype="number" class="form-control" id="bid">
      </div>
      <button type="submit" class="btn btn-primary form-control">Place bid</button>
    </form>
<?php endif ?>
	
	<p></p>
	
	<p class="lead">Number of bids: #<?php echo $num_bids ?></p>
	
	<p></p>
	
	<?php
		if ($num_bids > 0) { ?>
		<table class="table-bordered" border="1">
			<tr>
				<th>Bid Time</th>
				<th>Bid Price</th>			
			</tr>
			<?php
				foreach ($bid_data as $data){
				  $time = $data[0];
				  $price = $data[1];
				  echo '<tr><td>' .$time. '</td><td>' .$price. '</td></tr>';		  
				}
			?>
		</table>
	<?php } ?>
	
	<p></p>
  
  </div> <!-- End of right col with bidding info -->

</div> <!-- End of row #2 -->



<?php include_once("footer.php")?>


<script> 
// JavaScript functions: addToWatchlist and removeFromWatchlist.

function addToWatchlist(button) {
  console.log("These print statements are helpful for debugging btw");

  // This performs an asynchronous call to a PHP function using POST method.
  // Sends item ID as an argument to that function.
  $.ajax('watchlist_funcs.php', {
    type: "POST",
    data: {functionname: 'add_to_watchlist', auction: <?php echo($item_id);?>, user: <?php echo($_SESSION['user_id']);?>},

    success: 
      function (obj, textstatus) {
        // Callback function for when call is successful and returns obj
        console.log("Success");
        var objT = obj.trim();
 
        if (objT == "success") {
          $("#watch_nowatch").hide();
          $("#watch_watching").show();
        }
        else {
          var mydiv = document.getElementById("watch_nowatch");
          mydiv.appendChild(document.createElement("br"));
          mydiv.appendChild(document.createTextNode("Add to watch failed. Try again later."));
        }
      },

    error:
      function (obj, textstatus) {
        console.log("Error");
      }
  }); // End of AJAX call

} // End of addToWatchlist func

function removeFromWatchlist(button) {
  // This performs an asynchronous call to a PHP function using POST method.
  // Sends item ID as an argument to that function.
  $.ajax('watchlist_funcs.php', {
    type: "POST",
    data: {functionname: 'remove_from_watchlist', auction: <?php echo($item_id);?>, user: <?php echo($_SESSION['user_id']);?>},

    success: 
      function (obj, textstatus) {
        // Callback function for when call is successful and returns obj
        console.log("Success");
        var objT = obj.trim();
 
        if (objT == "success") {
          $("#watch_watching").hide();
          $("#watch_nowatch").show();
        }
        else {
          var mydiv = document.getElementById("watch_watching");
          mydiv.appendChild(document.createElement("br"));
          mydiv.appendChild(document.createTextNode("Watch removal failed. Try again later."));
        }
      },

    error:
      function (obj, textstatus) {
        console.log("Error");
      }
  }); // End of AJAX call

} // End of addToWatchlist func
</script>