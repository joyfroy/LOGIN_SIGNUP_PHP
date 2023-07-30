<?php
$showAlert=false;
$showError=false;
if($_SERVER["REQUEST_METHOD"]=="POST")
{   
    include 'partials/_dbconnect.php';
    $username=$_POST["username"];
    $password=$_POST["password"];
    $cpassword=$_POST["cpassword"];
   // $exists=false;
    $existSql="SELECT * from users where username='$username'";
    
    $result=mysqli_query($conn,$existSql);
    $numExistRows=mysqli_num_rows($result);
    if($numExistRows>0)
    {
      //$exists=true;
       $showError=" Username already exists";
    }else{
      //$exists=false;

    if(($password==$cpassword))
    {
        $hash=password_hash($password, PASSWORD_DEFAULT);
        $sql="INSERT INTO `users` ( `username`, `password`, `date`) VALUES ( '$username', '$hash', current_timestamp());"; 
        $result=mysqli_query($conn,$sql);
        if($result){
            $showAlert=true;
        }
    }else
    {
        $showError="Password do not match ";
    }
  }
}

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <?php require 'partials/_nav.php'?>
    <?php
    if($showAlert){
       echo '<div class="alert alert-success" role="alert">
    Your account created succefully !!
    </div>';}

    if($showError){
       echo '<div class="alert alert-danger" role="alert">
    '. $showError.'
    </div>';}
    ?>
    <div class="container">
        <h1 class="text-center">Signup to our website</h1>
        <form class="row g-3" action="/login/signup.php" method="post">
  <div class="col-md-6">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" maxlength="11" id="username" name="username">
  </div>
  <div class="col-md-6">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" maxlength="30" id="password" name="password">
  </div>
  <div class="col-md-6">
    <label for="cpassword" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="cpassword" name="cpassword">
  </div>
  
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Sign up</button>
  </div>
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>