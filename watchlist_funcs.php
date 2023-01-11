 <?php
include("includes/db.php");

if (!isset($_POST['functionname']) || !isset($_POST['auction']) || !isset($_POST['user'])) {
  return;
}

// Extract arguments from the POST variables:
$item_id = $_POST['auction'];
$user = $_POST['user'];

if ($_POST['functionname'] == "add_to_watchlist") {
  // TODO: Update database and return success/failure.
  
    $watchlist_update = "INSERT INTO watchlist (auction_id, user_id) VALUES ('$item_id', '$user')";
    $run_watchlist = mysqli_query($con,$watchlist_update);
  
    $res = "failure";
    if ($run_watchlist) {
  	  $res = "success";
    }
}
else if ($_POST['functionname'] == "remove_from_watchlist") {
  // TODO: Update database and return success/failure.
  
    $watchlist_remove = "DELETE FROM watchlist WHERE auction_id = '$item_id' and user_id = '$user'";
    $run_watchlist = mysqli_query($con,$watchlist_remove);
  
    $res = "failure";
    if ($run_watchlist) {
  	  $res = "success";
    }
}

// Note: Echoing from this PHP function will return the value as a string.
// If multiple echo's in this file exist, they will concatenate together,
// so be careful. You can also return JSON objects (in string form) using
// echo json_encode($res).
echo $res;

?>