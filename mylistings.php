<?php include "includes/db.php";?>
<?php include_once("header.php")?>
<?php require("utilities.php")?>


<div class="container">

<h2 class="my-3">My listings</h2>

<?php
  // This page is for showing a user the auction listings they've made.
  // It will be pretty similar to browse.php, except there is no search bar.
  // This can be started after browse.php is working with a database.
  // Feel free to extract out useful functions from browse.php and put them in
  // the shared "utilities.php" where they can be shared by multiple files.  

  $sql = "SELECT auction_id,name,description,end_date,category FROM auction WHERE seller_id=".$_SESSION['user_id'];
  $result = $con->query($sql);
  $result_array = array();
  $result_array = get_displayItemObjectList($sql);

  $num_results = count($result_array);
  $results_per_page = 10;
  $max_page = ceil($num_results / $results_per_page);
  if (!isset($_GET['page'])) {
    $curr_page = 1;
  }
  else {
    $curr_page = $_GET['page'];
  }

?>


<div class="container mt-5">

<?php 
if ($num_results==0){
  echo "<h3>No matching auctions found</h3>";
}
?>


<ul class="list-group">

<?php
  display_items($curr_page, $results_per_page, $result_array); // move to utilities.php
?>

</ul>

<!-- Pagination for results listings -->
<nav aria-label="Search results pages" class="mt-5">
  <ul class="pagination justify-content-center">
  
<?php

  pagination($curr_page, $max_page);  // move to utilities.php
?>

  </ul>
</nav>

</div>

<?php include_once("footer.php")?>