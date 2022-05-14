<?php
include "bootstraplink.php";
include "conn.php";
$sql = "SELECT users.Name,file.* FROM file,users where users.EID=file.UID ORDER BY file.ID DESC";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
$UID=$_SESSION ['EID'] ;
// Uploads INCOMING FILE 
if (isset($_POST['save'])) 
{ 
    // if save button on the form is clicked
    $subject=$_POST['sub'];
    $paperno=$_POST["papernum"];
    $date=date('Y-m-d',strtotime($_POST['date']));
    $name=$_FILES['myfile']['name'];
    $type=$_FILES['myfile']['type'];
    $data=file_get_contents($_FILES['myfile']['tmp_name']); // the physical file on a temporary uploads directory on the server
    $size = $_FILES['myfile']['size'];
    $extension = pathinfo($name, PATHINFO_EXTENSION);
    if (!in_array($extension, ['pdf'])) {
        echo '<div class="alert alert-danger"><center>You file extension must be .pdf</center></div>';
    } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
        echo '<div class="alert alert-danger"><center>File too large!</center></div>';
    } else {
            $sql = "INSERT INTO file (UID,FileName,FileNumber,date,size,Topic,Mime,Data) VALUES ('$UID','$name','1','$date',$size,'$subject','$type',0x".bin2hex($data).")";
            if (mysqli_query($conn, $sql)) 
            { 
                $sql2="select ID from file where topic='$subject'";
                $result2 = mysqli_query($conn, $sql2);
                if($result2)
                {
                    $row = mysqli_fetch_all($result2, MYSQLI_ASSOC);
                    foreach($row as $roww)
                    {
                $num = intval($roww['ID']);
                $sql3="INSERT INTO incoming (PaperWorkNum,FID) VALUES ('$paperno', '$num')";
                $result3 = mysqli_query($conn, $sql3);
                 }
                  echo '<div class="alert alert-info"><center> Save successfully </center></div>';
                }
            }
        else {
            echo '<div class="alert alert-danger"><center> Failed to save </center></div>';
        }  }
    }
    // Uploads  ISSUED FILE
    if(isset($_POST['save_issued']))
    {
      $transnum=$_POST['trans_num'];
      $transdate=date('Y-m-d',strtotime($_POST['trans_date']));
      $transsub=$_POST['trans_sub'];
      $name=$_FILES['trans_file']['name'];
      $type=$_FILES['trans_file']['type'];
      $data=file_get_contents($_FILES['trans_file']['tmp_name']);// the physical file on a temporary uploads directory on the server
      $size= $_FILES['trans_file']['size'];
      $extension = pathinfo($name, PATHINFO_EXTENSION);
      if (!in_array($extension, ['pdf'])) {
          echo '<div class="alert alert-danger"><center>You file extension must be .pdf</center></div>';
      } elseif ($_FILES['trans_file']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
          echo '<div class="alert alert-danger"><center>File too large!</center></div>';
      }else {
          $sql="INSERT INTO file (UID,FileName,FileNumber,date,size,Topic,Mime,Data) VALUES ('$UID','$name','2','$transdate',$size,'$transsub','$type',0x".bin2hex($data).")";
          if (mysqli_query($conn, $sql))
          {
            $sql2="select ID from file where topic='$transsub'";
            $result2 = mysqli_query($conn, $sql2);
            if($result2)
            {
                $row = mysqli_fetch_all($result2, MYSQLI_ASSOC);
                foreach($row as $roww)
                {
            $num = intval($roww['ID']);
            $sql3="INSERT INTO issued (TransactionNum,FID,TransCenter) VALUES ('$transnum', '$num','دائرة الشؤون القانونية')";
            $result3 = mysqli_query($conn, $sql3);
             }
             echo '<div class="alert alert-success"><center> Save successfully </center></div>';
            }
          }
          else 
          {
            echo '<div class="alert alert-danger"><center> Failed to save </center></div>';
          }
      }
    }
    // DOWNLOAD FILE
if (isset($_GET['download'])) {
    $id = $_GET['download'];
    // fetch file to download from database
    $sql = "SELECT * FROM file WHERE ID=$id";
    $result = mysqli_query($conn, $sql);
    $file = mysqli_fetch_assoc($result);
    //$filepath = 'uploads/' . $file['Name'];
        header('Content-Description: File Transfer');
        header('Content-Type:'.$file['Mime']);
        header('Content-Disposition: attachment; filename=' . basename($file['FileName']));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file['FileName']));
        echo $file['Data'];
        // Now update downloads count
        $newCount = $file['downloads'] + 1;
        $updateQuery = "UPDATE file SET Downloads=$newCount WHERE ID=$id";
        mysqli_query($conn, $updateQuery);
        exit;
}
// SHOW FILE 
if(isset($_GET['show']))
{
$id=  $_GET['show'];
$conn = mysqli_connect('localhost', 'root', '', 'lau');
$sql = "SELECT * FROM file WHERE ID=$id";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
  // Header y7tawi 3la content type
  header('Content-type:'.$row['Mime']);
  echo $row['Data'];
}
// DELETE FILE  
if(isset($_GET['delete']))
{
    $id = $_GET['delete'];
    $sql="DELETE FROM incoming WHERE FID=$id";
    $result= mysqli_query($conn, $sql);
    $sql2="DELETE FROM issued WHERE FID=$id";
    $result2= mysqli_query($conn, $sql2);
    $sql3="DELETE FROM file WHERE ID=$id";
    $result3= mysqli_query($conn, $sql3);
}
?>