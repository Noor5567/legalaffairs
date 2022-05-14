<?php
session_start();
include "conn.php";
if(isset($_POST['submit']))
{
   $id=$_POST['empid'];
   $pass=$_POST['password'];
if (mysqli_connect_error())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    if(empty($id) && empty($pass))  
      {  
           echo '<div class="alert alert-danger">"Both Fields are required &#128526;." </div>';  
      } 
      else {
$sql="SELECT * FROM users WHERE EID = '$id' ";
$result= mysqli_query($conn, $sql);
while($row= mysqli_fetch_assoc($result))
{
if($row['EID'] == $id && $row['Password'] == $pass)
{
    $_SESSION['EID'] = $id;
    $_SESSION['Name']=$row['Name'];
    header('location:dashboard.php');
    
}else {
    echo '<div class="alert alert-danger">" Incorrect Password or Employee ID &#128539; !" </div>' ;
}
}
}
}
?>
<!doctype html>
<html lang="en">
   <head>
      <title>Login</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
      <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
      <link rel="stylesheet" href="css/forms.css">
      <link rel="stylesheet" href="./css/header.css"/>
    <style>
       body 
       {
         font-family: 'Signika Negative', sans-serif;
       }
       .alert-danger
       {
          color: #721c24;
      background-color: #f8d7da;
      border-color: #f5c6cb;
      top:50px;
      text-align: center;
      margin-right: 28%;
      margin-left: 28%;
      font-weight:bold;
       }
    </style>
   </head>
   <body>
      <form action="" method="post"> 
         <div class="main">
         <section class="signup">
            <div class="container">
               <div class="signup-content">
                  <img src="images/UJLogo.svg.png" alt="UJ LOGO" width="100" height="100" > 
                  <img class ="img2" src="images/LAU.png" alt="LAU LOGO" width="140" height="140" > 
                  <form method="POST" id="signup-form" class="signup-form">
                  <h3><strong> Log In to Legal Affairs Department </strong></h3>
                  <br>
                  <div class="form-group">
                     <label for="username" style="font-size: 20px;"><strong>Employee ID</strong></label>
                     <input type="text" name="empid" class="form-control" id="username" placeholder="Enter The Employee ID" >
                  </div>
                  <div class="form-group">
                     <label for="password" style="font-size: 20px;"><strong>Password</strong></label>
                     <input type="password" name="password" class="form-control" id="password" placeholder="Enter The Password">
                  </div>
                  <input type="submit" value="Log In" name="submit" class="btn text-white btn-block btn-primary" style="font-size: 20px;">
                  <br>
                  <div class="d-flex mb-5 align-items-center">
                     <span class="ml-auto"><a href="forgetPassEn.php" class="forgot-pass" style="font-size:20px;align-items: center;">Forgot Password</a></span> 
                  </div>
                  <hr>
                  <p style="font-size:20px;">Don't have an account ? <a href="signUpEn.php" class="loginhere-link" style="font-size: 20px;">Sign up here</a>
                  </p>
               </div>
            </div>
      </div>
      </section>
      </div>
   </form>
      <script src="js/jquery-3.3.1.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/main.js"></script>
   </body>
</html>