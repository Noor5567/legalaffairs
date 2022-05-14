<?php
session_start();
include "./Navbar/nav.php";
include "conn.php";
if(isset($_POST['change']))
{
    $current=$_POST['current'];
    $new=$_POST['newpass'];
    $repass=$_POST['retype'];
    $pass="SELECT Password FROM users WHERE EID ="."'".$_SESSION['EID']."'";
    $result=mysqli_query($conn,$pass);
    while($row=mysqli_fetch_assoc($result))
    {
        if($row['Password'] == $current)
        {
            if($new == $repass)
            {
                if($new!=$current && $repass!=$current)
                {
                    $sql= "UPDATE users SET password = " . $new ." WHERE EID ="."'".$_SESSION['EID']."'";
                    $result1=mysqli_query($conn,$sql);
                    if($result1)
                    {
                    echo '<div class = "alert alert-success"> Password Updated &#128513;.</div>';
                    }else
                    {
                        echo '<div class="alert alert-danger"> "Cannot update password &#128531;." </div>' ;
                    }
                }else{
                    echo '<div class="alert alert-danger"> "Password must differ from old password &#128533;."</div>';
                }
                
            }else{
                echo '<div class="alert alert-danger"> "Password do not match &#128530;." </div>' ;
            }
            
        }else{
            echo '<div class="alert alert-danger"> "Current password wrong &#128529;." </div>' ;
        }
    }
}
?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <style>
    body 
    {
      font-family: 'Signika Negative', sans-serif;
    }
      .btn-success
      {
        position: relative;
        left:10px;
        bottom:4px;
      }
      .alert-success 
      {
        font-weight: bolder;
        margin-left: 30%;
        margin-right: 30%;
        text-align: center;
      }
      .alert-danger
      {
        font-weight: bolder;
        margin-left: 30%;
        margin-right: 30%;
        text-align: center;
      }
      p
      {
        color:black;
        font-weight:bold;
      }
      label 
      {
        position: relative;
        left:3px;
      }
  </style>
</head>
<form action="" method="POST">
    <div class="w3-container">
  <div class="w3-card-4">
    <div class="w3-container w3-blue">
      <h2> Change Password </h2>
    </div>
    <form class="w3-container">
      <p>
      <label> Current Password: </label>
      <input class="w3-input" type="password" name="current">
    </p>
      <p>     
      <label> New Password: </label>
      <input class="w3-input" type="password" name="newpass">
      </p>
      <p>     
      <label> Confirm New Password: </label>
      <input class="w3-input" type="password" name="retype">
      </p>
      <input type="submit" value ="Change Password" name ="change" class="btn btn-success">
    </form>
  </div>
</div>
</form>
