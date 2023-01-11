<?php

$con = mysqli_connect("localhost", "Auction_Manager", "1234", "auction_system");

if (mysqli_connect_errno()) { 
    die("Connect to MySQL failed: " . mysqli_connect_error()); 
}

?>