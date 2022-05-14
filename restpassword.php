<?php 
include "conn.php";
if(!isset($_GET["code"]))
{
    exit("Can't find the page");
}
$code=$_GET["code"];
$getemail= mysqli_query($conn,"SELECT email FROM password WHERE code='$code' ");
if(mysqli_num_rows($getemail) == 0)
{
    exit(" Can't find page ");
}
if(isset($_POST['password']))
{
    $pass=$_POST['password'];
    $row=mysqli_fetch_array($getemail);
    $email=$row["email"];
    $query=mysqli_query($conn,"UPDATE users SET password='$pass' WHERE email='$email'");
    if($query)
    {
        mysqli_query($conn,"DELETE FROM password WHERE code='$code'");
        exit("Password Updated");
    }else{
        exit("Error While Updated Password");
    }

}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Forget Password</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js%22%3E"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js%22%3E"></script>
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
      <link rel="stylesheet" href="./css/header.css">
      <link rel="stylesheet" href="./css/forms.css">\
      <style>
         body 
         {
            font-family: 'Signika Negative', sans-serif;
         }
      </style>
   </head>
   <body>
      <div class="main">
         <section class="signup">
            <div class="container">
               <div class="signup-content">
                  <img src="images/UJLogo.svg.png" alt="UJ LOGO" width="100" height="100" > 
                  <img class ="img2" src="images/LAU.png" alt="LAU LOGO" width="140" height="140" > 
                  <form method="POST" id="signup-form" class="signup-form">
                  <h3><strong> Legal Affairs Department </strong></h3>
                  <br>
                  <div class="form-group">
                      <form method="post ">
                     <label for="email"> <strong style="font-size: 20px;"> New Password</strong></label>
                     <input type="password" class="form-control"  placeholder=" Enter Password " name="password" required>
                  </div>
                  <button type="submit" class="btn btn-success confirm "> Reset Password </button>
                  <button type="submit" class="btn btn-primary"> Back </button>
               </div>
         </section>
         </div>
      </div>
      <script src="js/jquery-3.3.1.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/main2.js"></script>
      <script src="./js/forget.js"></script>

   </body>
</html>