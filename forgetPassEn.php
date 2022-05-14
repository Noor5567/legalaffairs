<head>
<style>
   body 
   {
      font-family: 'Signika Negative', sans-serif;
   }
   .msg {
    border: 1px solid black;
    border-radius: 15px;
    height: 200px;
    width: 350px;
    padding: 0px;
    background-color: skyblue;
    text-align: center;
    margin: auto;
    margin-top: 20%;
    padding-top: 7%;
    font-size: revert;
    font-weight: bold;
}
.href
{
   color:white;
   text-decoration:none;
   
}
.back
{
   margin-left:37%;
   margin-top:5px;
}
.alert-danger {
    color: #842029;
    background-color: #f8d7da;
    border-color: #f5c2c7;
    font-weight: bolder;
    margin-right: 25%;
    margin-left: 25%;
    text-align: center;
}
      </style>
</head>
<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'conn.php';
require 'bootstraplink.php';
//Create an instance; passing `true` enables exceptions
if(isset($_POST['email']))
{
    $email_to=$_POST['email'];
    $code=uniqid(true);
    $sql=mysqli_query($conn,"SELECT Email FROM users WHERE Email='$email_to'");
    while($row=mysqli_fetch_assoc($sql)) 
    {
          if($row['Email']==$email_to)
    {
           $query=mysqli_query($conn,"INSERT INTO password(email,code) VALUES ('$email_to','$code')");
    if(!$query)
    {
        exit("ERROR");

    }
    $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'legalaffaris0@gmail.com';                     //SMTP username
    $mail->Password   = 'legalaff5567';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('legalaffaris0@gmail.com', 'Legal Affaris Deapartment');
    $mail->addAddress("$email_to");     //Add a recipient
    $mail->addReplyTo('no-reply@gmail.com', 'no-reply');

    //Content
    $url="http://". $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/restPassword.php?code=$code";
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Reset Password';
    $mail->Body    = "<h1> You requested a password reset link </h1>
                        Click on <a href=' $url'> this link </a> to change the password ";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo '<div class="msg"> Message has been sent , Check Your Email </div>'; echo "<br";
    echo '<div class="btn btn-success back"><a class ="href" href="index.php">Back</a></div>';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
exit();
}
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
      <link rel="stylesheet" href="./css/forms.css">
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
                     <label for="email"> <strong style="font-size: 20px;">Email:</strong></label>
                     <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
                  </div>
                  <button type="submit"  class="btn btn-success confirm ">Submit</button>
                  <a href="index.php" class="btn btn-primary">Back</a>
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