<?php
include "conn.php";
if(isset($_POST['submit']))
{
   if($_POST['password']==$_POST['repassword'])
   {
   $Name=$_POST['name'];
   $emp=$_POST['empid'];
   $email=$_POST['email'];
   $pass=$_POST['password'];
   $Sql="INSERT INTO users(EID,Name,Email,Password) VALUES ('$emp','$Name','$email','$pass')";
   $result =  mysqli_query($conn, $Sql);
   if($result)
   {
      echo '<div class="alert alert-success">" Successfully Saved " </div>' ;
   }
   else
   {
      echo '<div class="alert alert-danger">" That was The Error While Register" </div>' ;
   }
   }
   else
   {
      echo '<div class="alert alert-danger"> " The Password Does Not Match " </div>' ;
   }
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Sign Up Form </title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
      <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
      <link rel="stylesheet" href="./css/forms.css">
      <link rel="stylesheet" href="./css/header.css"/>
      <style>
         body 
         {
            font-family: 'Signika Negative', sans-serif;
         }
      .alert-danger
       {
      top: 28%;
      text-align: center;
      margin-right: 30%;
      margin-left: 30%;
      font-weight:bold;
       }
       .alert-success
       {
      top: 15%;
      text-align: center;
      margin-right: 30%;
      margin-left: 30%;
      font-weight:bold;
      background-color:#63e6be;
      color:#2952a3;
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
                  <img class ="img2" src="images/LAU.png" alt="UJ LOGO" width="120" height="120" > 
                  <form method="POST" id="signup-form" class="signup-form">
                     <h2 class="form-title">Create a new account</h2>
                     <div class="form-group">
                        <input type="text" class="form-input" name="name" id="name" placeholder="Name"/>
                     </div>
                     <div class="form-group">
                        <input type="text" class="form-input" name="empid" id="name" placeholder="Employee ID"/>
                     </div>
                     <div class="form-group">
                        <input type="email" class="form-input" name="email" id="email" placeholder="University Email"/>
                     </div>
                     <div class="form-group">
                        <input type="password" class="form-input" name="password" id="password" placeholder="Enter a password"/>
                     </div>
                     <div class="form-group">
                        <input type="password" class="form-input" name="repassword" id="re_password" placeholder="Repeat your password"/>
                     </div>
                     <div class="form-group">
                        <input type="submit" name="submit" id="submit" class="form-submit" value="Sign up"/>
                     </div>
                  </form>
                    <center>Have already an account ? <a href="index.php" class="loginhere-link">Login here</a></center> 
               </div>
            </div>
         </section>
      </div>
      </form>
     
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="js/main.js"></script>
   </body>
</html>