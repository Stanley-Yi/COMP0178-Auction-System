<?php include_once("header.php")?>

<?php
/* (Uncomment this block to redirect people without selling privileges away from this page)
  // If user is not logged in or not a seller, they should not be able to
  // use this page.
  if (!isset($_SESSION['account_type']) || $_SESSION['account_type'] != 'seller') {
    header('Location: browse.php');
  }
*/
?>

<!-- No operations conducted above, my code start from below -->

<?php
// check whether user is seller
include("includes/db.php");

if (isset($_POST['create'])) {
	$user = $_SESSION['user'];
	$get_user = "select user.user_id from user where user.email='$user'";
	
	$run_user = mysqli_query($con,$get_user);
	$id = mysqli_fetch_array($run_user)[0];
	
    $end_date = $_POST['end_date'];
    $description = $_POST['description'];
    $start_price = $_POST['start_price'];
    $reserve_price = $_POST['reserve_price'];
	
	if (!empty($_POST['new_category'])) {
		$category = $_POST['new_category'];
		
		# check if category exists
		$check_category = "select COUNT(name) as amount from category where name = '$category'";
		$category_status = mysqli_fetch_array(mysqli_query($con,$check_category))[0];
		
		if ($category_status == 0) {
			$add_category = "INSERT INTO category (name) VALUES ('$category')";
			$add_update = mysqli_query($con,$add_category);
		}
		
		$get_cate_id = "select category.id from category where category.name='$category'";
		
		$run_cate_id = mysqli_query($con,$get_cate_id);
		$category = mysqli_fetch_array($run_cate_id)[0];
	} else {
		$category = $_POST['category'];
	}
	
	$name = $_POST['name'];
	
    $exts = explode('.', $_FILES['image_path']['name']);
    $my_img_path = "/auction/img/".time().".".end($exts);
    $temp_name = $_FILES['image_path']['tmp_name'];
    $store_path = $_SERVER['DOCUMENT_ROOT'].$my_img_path;
    move_uploaded_file($temp_name, $store_path);
    
    $update = "INSERT INTO auction (end_date, seller_id, description, start_price, reserve_price, picture, category, name, status) 
				VALUES ('$end_date', '$id', '$description', '$start_price', '$reserve_price', '$my_img_path', '$category', '$name', 0)";
    $run = mysqli_query($con,$update);
    if ($run) {
        echo "<script>alert('Dear seller, your product is posted successfully')</script>";
        echo "<script>window.open('browse.php','_self')</script>";
    }
}
else{

?> 

<!-- my code end -->

<div class="container">

<!-- Create auction form -->
<div style="max-width: 800px; margin: 10px auto">
  <h2 class="my-3">Create new auction</h2>
  <div class="card">
    <div class="card-body">
      <!-- Note: This form does not do any dynamic / client-side / 
      JavaScript-based validation of data. It only performs checking after 
      the form has been submitted, and only allows users to try once. You 
      can make this fancier using JavaScript to alert users of invalid data
      before they try to send it, but that kind of functionality should be
      extremely low-priority / only done after all database functions are
      complete. -->
      <!-- <form method="post" action="create_auction_result.php"> -->
	  <form method="post" enctype="multipart/form-data">
        <div class="form-group row">
          <label for="auctionTitle" class="col-sm-2 col-form-label text-right">Title of auction</label>
          <div class="col-sm-10">
            <input name="name" type="text" class="form-control" id="auctionTitle" placeholder="e.g. Black mountain bike">
            <small id="titleHelp" class="form-text text-muted"><span class="text-danger">* Required.</span> A short description of the item you're selling, which will display in listings.</small>
          </div>
        </div>
        <div class="form-group row">
          <label for="auctionDetails" class="col-sm-2 col-form-label text-right">Details</label>
          <div class="col-sm-10">
            <textarea name="description" class="form-control" id="auctionDetails" rows="4"></textarea>
            <small id="detailsHelp" class="form-text text-muted">Full details of the listing to help bidders decide if it's what they're looking for.</small>
          </div>
        </div>
		
		<div class="form-group row">
		  <label class="col-sm-2 col-form-label text-right">Item Image</label>
		  <div class="col-sm-10">
		    <input name="image_path" type="file" class="form-control" required>
		    <small id="detailsHelp" class="form-text text-muted">Upload a image for better display of auction items.</small>
		  </div>
		</div>
		
        <div class="form-group row">
          <label for="auctionCategory" class="col-sm-2 col-form-label text-right">Category</label>
          <div class="col-sm-10">
			<input name="new_category" type="text" class="form-control" placeholder="add a category if not found in below">
            <select name="category" class="form-control" id="auctionCategory">
              <option selected>Choose...</option>
              <?php
                $get_p_cats = "select * from category";
                $run_p_cats = mysqli_query($con,$get_p_cats);
                while ($row_p_cats=mysqli_fetch_array($run_p_cats)){
                    $p_cat_id = $row_p_cats['id'];
                    $p_cat_name = $row_p_cats['name'];
                    echo "<option value='$p_cat_id'> $p_cat_name </option>";
              }
              ?>
            </select>
            <small id="categoryHelp" class="form-text text-muted"><span class="text-danger">* Required.</span> Select a category for this item.</small>
          </div>
        </div>
        <div class="form-group row">
          <label for="auctionStartPrice" class="col-sm-2 col-form-label text-right">Starting price</label>
          <div class="col-sm-10">
	        <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">£</span>
              </div>
              <input name="start_price" type="number" class="form-control" id="auctionStartPrice">
            </div>
            <small id="startBidHelp" class="form-text text-muted"><span class="text-danger">* Required.</span> Initial bid amount.</small>
          </div>
        </div>
        <div class="form-group row">
          <label for="auctionReservePrice" class="col-sm-2 col-form-label text-right">Reserve price</label>
          <div class="col-sm-10">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">£</span>
              </div>
              <input name="reserve_price" type="number" class="form-control" id="auctionReservePrice">
            </div>
            <small id="reservePriceHelp" class="form-text text-muted">Optional. Auctions that end below this price will not go through. This value is not displayed in the auction listing.</small>
          </div>
        </div>
        <div class="form-group row">
          <label for="auctionEndDate" class="col-sm-2 col-form-label text-right">End date</label>
          <div class="col-sm-10">
            <input name="end_date" type="datetime-local" class="form-control" id="auctionEndDate">
            <small id="endDateHelp" class="form-text text-muted"><span class="text-danger">* Required.</span> Day for the auction to end.</small>
          </div>
        </div>
        <!-- <button type="submit" class="btn btn-primary form-control">Create Auction</button> -->
		<input name="create" type="submit" value="Create Auction" class="btn btn-primary form-control">
      </form>
    </div>
  </div>
</div>

</div>

<?php } ?>

<?php include_once("footer.php")?>