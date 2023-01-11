<?php

// TODO: Extract $_POST variables, check they're OK, and attempt to login.
// Notify user of success/failure and redirect/give navigation options.

// For now, I will just set session variables and redirect.

session_start();
include("includes/db.php");
$_SESSION['logged_in'] = false;
if (isset($_POST['login'])) {
    $email_or_user_name = $_POST['email_or_user_name'];
    $password = $_POST['password'];
    $get_user = "SELECT email, user_id, user_name, password, is_seller FROM user WHERE (email='$email_or_user_name' OR user_name='$email_or_user_name') AND password='$password'";
    $result = mysqli_query($con, $get_user);
    $count = mysqli_num_rows($result);
if ($count==1) {
//        $_SESSION['auction'] = $email;
    $row_user = mysqli_fetch_array($result);
	$_SESSION['user'] = $row_user['email'];
    $_SESSION['logged_in'] = true;
    $_SESSION['user_name'] = $row_user['user_name'];
    $_SESSION['account_type'] = $row_user['is_seller'];
    $_SESSION['user_id'] = $row_user['user_id'];
    echo "<script>alert('".$row_user['user_name']." are now logged in! You will be redirected shortly.')</script>";
//        echo('<div class="text-center">You are now logged in! You will be redirected shortly.</div>');
//        echo "<script>alert('Welcome ".$row_admin['user_name']."!')</script>";
    echo "<script>window.open('browse.php','_self')</script>";
}
else{
    echo "<script>alert('E-mail or Password is Wrong!')</script>";
    echo "<script>window.open('browse.php','_self')</script>";
}

}



//echo('<div class="text-center">You are now logged in! You will be redirected shortly.</div>');

// Redirect to index after 5 seconds
header("refresh:5;url=index.php");

?>
