<?php 
include "includes/db.php";
include_once("header.php");
require("utilities.php");
?>

<div class="container">

<h2 class="my-3">Browse listings</h2>

<div id="searchSpecs">
<!-- When this form is submitted, this PHP page is what processes it.
     Search/sort specs are passed to this page through parameters in the URL
     (GET method of passing data to a page). -->

<?php
$sql = "SELECT name FROM category";
$result = $con->query($sql);
$result_array = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        array_push($result_array, $row['name']);
    }
} 
?>


<form method="get" action="browse.php">
  <div class="row">
    <div class="col-md-4 pr-0">  
      <label for="search">Search keyword:</label><br>
      <input type="text" id="keyword" name="keyword" value=""><br>
    </div>
    <div class="col-md-3 pr-0">
    <label for="category">Category</label><br>
    <select  name="cat"> 
    <option selected value="all">All Category</option>
      <?php
        foreach ($result_array as $cat){
          echo "<option value='$cat'>$cat</option>";
        }
      ?>
    </select> 
    </div>
      <div class="col-md-3 pr-0">
    <label for="order_by">Sort by:</label><br>
    <select  name="order_by">
          <option selected value="pricelow">Price (low to high)</option>
          <option value="pricehigh">Price (high to low)</option>
          <option value="date">Latest expiry</option>
    </select> 
	</div>
    <div class="col-md-1 px-0">
      <button type="submit" class="btn btn-primary">Search</button>
    </div>
  </div>
</form>
</div> <!-- end search specs bar -->


</div>

<?php
  // Retrieve these from the URL
  if (!isset($_GET['keyword'])) {
    $keyword = "";
  }
  else {
    $keyword = $_GET['keyword'];
  }
  if (!isset($_GET['cat'])) {
    $category = "all";
  }
  else {
    $category = $_GET['cat'];
  }
  
  if (!isset($_GET['order_by'])) {
    $ordering = "pricelow";
  }
  else {
    $ordering = $_GET['order_by'];
  }
  
  if (!isset($_GET['page'])) {
    $curr_page = 1;
  }
  else {
    $curr_page = $_GET['page'];
  }



  $sql = "SELECT auction_id,name,description,end_date,category FROM auction";
  $display_array = get_displayItemObjectList($sql);
 

  // keyword filtering
  if (strlen($keyword) != 0){
    $temp = array();
    foreach($display_array as $display){
      $has_keyword = strpos(strtolower($display->getTitle()), strtolower($keyword));
      if ($has_keyword !== false){
          array_push($temp, $display);
      }
    }
    $display_array = $temp;
  }
  
  //category filtering
  if ($category != "all"){
    $temp = array();
    foreach($display_array as $display){
      if(trim($display->getCategory()) == trim($category)){
        array_push($temp, $display);
      }
    }
    $display_array = $temp;
  }

  //sorting
  switch($ordering)
  {
    case "pricelow";
      function mycmp($a, $b){
        return $a->getCurrent_price() - $b->getCurrent_price();
      }
      usort($display_array, "mycmp");
      break;
    case "pricehigh";
      function mycmp($a, $b){
        return $b->getCurrent_price() - $a->getCurrent_price();
      }
      usort($display_array, "mycmp");
      break;
    case "date";
      function mycmp($a, $b){
        $time1= new DateTime($a->getEnd_date());
        $time2= new DateTime($b->getEnd_date());
        if ($time1 > $time2) {
          return -1;
        } else{
          return 1;
        }
      }
      usort($display_array, "mycmp");
      break;
  }
  #usort($display_array, "mycmp");


  $num_results = count($display_array);
  $results_per_page = 10;
  $max_page = ceil($num_results / $results_per_page);
?>

<div class="container mt-5">

<?php 
if ($num_results==0){
  echo "<h3>No matching auctions found</h3>";
}
?>


<ul class="list-group">

<?php
  display_items($curr_page, $results_per_page, $display_array); // move to utilities.php
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