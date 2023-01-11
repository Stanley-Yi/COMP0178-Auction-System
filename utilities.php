<?php

// display_time_remaining:
// Helper function to help figure out what time to display
function display_time_remaining($interval) {

    if ($interval->days == 0 && $interval->h == 0) {
      // Less than one hour remaining: print mins + seconds:
      $time_remaining = $interval->format('%im %Ss');
    }
    else if ($interval->days == 0) {
      // Less than one day remaining: print hrs + mins:
      $time_remaining = $interval->format('%hh %im');
    }
    else {
      // At least one day remaining: print days + hrs:
      $time_remaining = $interval->format('%ad %hh');
    }

  return $time_remaining;

}

// print_listing_li:
// This function prints an HTML <li> element containing an auction listing
function print_listing_li($item_id, $title, $desc, $price, $num_bids, $end_time)
{
  // Truncate long descriptions
  if (strlen($desc) > 250) {
    $desc_shortened = substr($desc, 0, 250) . '...';
  }
  else {
    $desc_shortened = $desc;
  }
  
  // Fix language of bid vs. bids
  if ($num_bids == 1) {
    $bid = ' bid';
  }
  else {
    $bid = ' bids';
  }
  
  // Calculate time to auction end
  $now = new DateTime();
  if ($now > $end_time) {
    $time_remaining = 'This auction has ended';
  }
  else {
    // Get interval:
    $time_to_end = date_diff($now, $end_time);
    $time_remaining = display_time_remaining($time_to_end) . ' remaining';
  }
  
  // Print HTML
  echo('
    <li class="list-group-item d-flex justify-content-between">
    <div class="p-2 mr-5"><h5><a href="listing.php?item_id=' . $item_id . '">' . $title . '</a></h5>' . $desc_shortened . '</div>
    <div class="text-center text-nowrap"><span style="font-size: 1.5em">£' . number_format($price, 2) . '</span><br/>' . $num_bids . $bid . '<br/>' . $time_remaining . '</div>
  </li>'
  );
}

function get_displayItemObjectList($sql){
  include "includes/db.php";
  $result = $con->query($sql);
  $display_array = array();
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          $record = new DisplayItem();
          $id = $row['auction_id'];
          $record->setItem_id($id);
          $record->setTitle($row['name']);
          $record->setDescription($row['description']);
          $get_bid = "SELECT price FROM bid WHERE bid.auction_id ='$id'";
          $run_bid = mysqli_query($con,$get_bid);

          $num_bids = 0;
          $current_price = 0.0;
          while ($info_bid = $run_bid->fetch_assoc()){
          $num_bids = $num_bids + 1;
          if ($info_bid['price'] > $current_price) {
            $current_price = $info_bid['price'];
          }
          }
      
          $record->setCurrent_price($current_price);
          $record->setNum_bids($num_bids);
      
          $record->setEnd_date($row['end_date']);
          $get_cat = "SELECT name FROM category where id=".$row['category'];
          $run_cat = mysqli_query($con,$get_cat);
          while($info_cat = $run_cat->fetch_assoc()){
            $cat = $info_cat['name'];
          }
          $record->setCategory($cat);
          array_push($display_array, $record);
      }
  }
  return $display_array;
}

// Demonstration of what listings will look like using dummy data.
function display_items($curr_page, $results_per_page, $display_array){
  $num_results = count($display_array);
  $page = $curr_page * $results_per_page;
  for($i = $page - $results_per_page; $i < $page; $i++){
    //print_r (explode("-",$display->getEnd_date()));
    if ($i >= $num_results){
      break;
    }
    $display = $display_array[$i];
    $datetime = new DateTime($display->getEnd_date());
    print_listing_li($display->getItem_id(), $display->getTitle(), $display->getDescription(), $display->getCurrent_price(), $display->getNum_bids(), $datetime);
  }
}

//<!-- Pagination for results listings -->
function pagination($curr_page, $max_page){
    // Copy any currently-set GET variables to the URL.
  $querystring = "";
  foreach ($_GET as $key => $value) {
  if ($key != "page") {
    $querystring .= "$key=$value&amp;";
  }
  }

  $high_page_boost = max(3 - $curr_page, 0);
  $low_page_boost = max(2 - ($max_page - $curr_page), 0);
  $low_page = max(1, $curr_page - 2 - $low_page_boost);
  $high_page = min($max_page, $curr_page + 2 + $high_page_boost);

  if ($curr_page != 1) {
  echo('
  <li class="page-item">
    <a class="page-link" href="browse.php?' . $querystring . 'page=' . ($curr_page - 1) . '" aria-label="Previous">
      <span aria-hidden="true"><i class="fa fa-arrow-left"></i></span>
      <span class="sr-only">Previous</span>
    </a>
  </li>');
  }

  for ($i = $low_page; $i <= $high_page; $i++) {
  if ($i == $curr_page) {
    // Highlight the link
    echo('
  <li class="page-item active">');
  }
  else {
    // Non-highlighted link
    echo('
  <li class="page-item">');
  }

  // Do this in any case
  echo('
    <a class="page-link" href="browse.php?' . $querystring . 'page=' . $i . '">' . $i . '</a>
  </li>');
  }

  if ($curr_page != $max_page) {
  echo('
  <li class="page-item">
    <a class="page-link" href="browse.php?' . $querystring . 'page=' . ($curr_page + 1) . '" aria-label="Next">
      <span aria-hidden="true"><i class="fa fa-arrow-right"></i></span>
      <span class="sr-only">Next</span>
    </a>
  </li>');

  }
}

class DisplayItem{
  var $item_id;
  var $title;
  var $description;
  var $current_price;
  var $num_bids;
  var $end_date;
  var $category;
  
  /**
   * Get the value of item_id
   */ 
  public function getItem_id()
  {
      return $this->item_id;
  }

  /**
   * Set the value of item_id
   *
   * @return  self
   */ 
  public function setItem_id($item_id)
  {
      $this->item_id = $item_id;

      return $this;
  }

  /**
   * Get the value of title
   */ 
  public function getTitle()
  {
      return $this->title;
  }

  /**
   * Set the value of title
   *
   * @return  self
   */ 
  public function setTitle($title)
  {
      $this->title = $title;

      return $this;
  }

  /**
   * Get the value of description
   */ 
  public function getDescription()
  {
      return $this->description;
  }

  /**
   * Set the value of description
   *
   * @return  self
   */ 
  public function setDescription($description)
  {
      $this->description = $description;

      return $this;
  }

  /**
   * Get the value of current_price
   */ 
  public function getCurrent_price()
  {
      return $this->current_price;
  }

  /**
   * Set the value of current_price
   *
   * @return  self
   */ 
  public function setCurrent_price($current_price)
  {
      $this->current_price = $current_price;

      return $this;
  }

  /**
   * Get the value of num_bids
   */ 
  public function getNum_bids()
  {
      return $this->num_bids;
  }

  /**
   * Set the value of num_bids
   *
   * @return  self
   */ 
  public function setNum_bids($num_bids)
  {
      $this->num_bids = $num_bids;

      return $this;
  }

  /**
   * Get the value of end_date
   */ 
  public function getEnd_date()
  {
      return $this->end_date;
  }

  /**
   * Set the value of end_date
   *
   * @return  self
   */ 
  public function setEnd_date($end_date)
  {
      $this->end_date = $end_date;

      return $this;
  }

      /**
   * Get the value of category
   */ 
  public function getCategory()
  {
      return $this->category;
  }

  /**
   * Set the value of category
   *
   * @return  self
   */ 
  public function setCategory($category)
  {
      $this->category = $category;

      return $this;
  }
}
?>