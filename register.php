<?php include_once("header.php")?>

<?php

include("includes/db.php");
if (isset($_POST['register'])) {
    $user_name = mysqli_real_escape_string($con,$_POST['user_name']);
    $search_name_query = mysqli_query($con,"select * from user where user_name='$user_name'");
    if (mysqli_num_rows($search_name_query) > 0){
        echo "<script>alert('The username is existed!')</script>";
    }
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $search_email_query = mysqli_query($con,"select * from user where email='$email'");
    if (mysqli_num_rows($search_email_query) > 0){
        echo "<script>alert('The email address is existed!')</script>";
    }
    $password = mysqli_real_escape_string($con,$_POST['password']);
    $confirm_password = mysqli_real_escape_string($con,$_POST['confirm_password']);
    if($password != $confirm_password){
        echo "<script>alert('The password is not same!')</script>";
    }

    if((mysqli_num_rows($search_name_query) == 0) && (mysqli_num_rows($search_email_query) == 0) && ($password == $confirm_password)) {
        $is_seller = $_POST['is_seller'];
        $set_user = "insert into user(user_name,email,password,is_seller) values ('$user_name','$email','$password',$is_seller)";
        $result = mysqli_query($con, $set_user);
        echo "<script>alert('Registration success!')</script>";
        echo "<script>window.open('browse.php','_self')</script>";
    }
}
?>



<div class="container">
<h2 class="my-3">Register new account</h2>

<!-- Create auction form -->
<form method="POST", class="well", action="">

  <div class="form-group row">
    <label for="accountType" class="col-sm-2 col-form-label text-right">Registering as a:</label>

    <div class="col-sm-10">
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="is_seller" value=0 checked>
        <label class="form-check-label" for="accountBuyer">Buyer</label>
      </div>

      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="is_seller" value=1>
        <label class="form-check-label" for="accountSeller">Seller</label>
      </div>
      <small id="accountTypeHelp" class="form-text-inline text-muted"><span class="text-danger">* Required.</span></small>
    </div>
  </div>


  <div class="form-group row">
    <label for="user_name" class="col-sm-2 col-form-label text-right">Username</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id=“user_name” name="user_name" placeholder="Username" required>
      <small id="usernameHelp" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
    </div>
  </div>

  <div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label text-right">Email</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
      <small id="emailHelp" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
    </div>
  </div>

  <div class="form-group row">
    <label for="password" class="col-sm-2 col-form-label text-right">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
      <small id="passwordHelp" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
    </div>
  </div>

  <div class="form-group row">
    <label for="passwordConfirmation" class="col-sm-2 col-form-label text-right">Repeat password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="passwordConfirmation" name="confirm_password" placeholder="Enter password again" required>
      <small id="passwordConfirmationHelp" class="form-text text-muted"><span class="text-danger">* Required.</span></small>
    </div>
  </div>
  <div class="form-group row">
    <button type="submit" class="btn btn-primary form-control" name="register">Register</button>
  </div>
</form>

<div class="text-center">Already have an account? <a href="" data-toggle="modal" data-target="#loginModal">Login</a>

</div>

<?php include_once("footer.php")?>