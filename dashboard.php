
<script type="text/javascript">
    var http = new XMLHttpRequest();

    function searchfun(user) {
        http.open("GET", "searchfun.php?ID=" + user, true);
        http.onreadystatechange = function() {
            if (http.readyState == 4) {
                document.getElementById('informations').innerHTML = http.responseText;
            }
        }
        http.send(null);
    }
</script>
<?php
session_start();
if(!isset($_SESSION['EID']))
{
    header("location:index.php");
}
?>
<html>
  <?php include 'fileupload.php'; ?>
  <?php
  include "./Navbar/nav.php";
  ?>
  <head>
    <?php include "bootstraplink.php"?>
    <style>
      body
      {
        background-image: linear-gradient(#ffffff,#d7e1ec);
        font-family: 'Signika Negative', sans-serif;
      }
      .head 
      {
        background-color: #5fb0f7;
        color: white;
      }
      #myTable 
      {
        border:2px solid gray;
      }
      td
      {
        text-align:center;
        font-weight:bolder;
      }
      tr:nth-child(even) {
        background-color: #f2f2f2;
      }
      #myInput 
      {
        background-image: url('./css/search.svg');
        background-position: 10px 10px;
        background-repeat: no-repeat;
        width: 20%;font-size: 16px;
        padding: 12px 20px 12px 40px;
        border: 1px solid #ddd;
        margin-bottom: 12px;
        margin-left:2%;
      }
      .se 
      {
        margin-left:2%;
      }
    </style>
  </head>
  <body>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="style.css">
  <title>Download files</title>
</head>
<body>
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Files..">
<div class="table-responsive">
<table class="table table-bordered" id="myTable">
  <thead>
    <tr class="head">
      <th scope="col"><center>ID</center></th>
      <th scope="col"><center>FileName</center></th>
      <th scope="col"><center>Size (in KB)</center></th>
      <th scope="col"><center>Downloads</center></th>
      <th scope="col"><center>Action</center></th>
      <th scope="col"><center>Uploaded Date</center></th>
      <th scope="col"><center>Uploaded by</center></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($row as $rows)
  { ?>
    <tr>
      <td><?php  echo $rows['ID']; ?></td>
      <td><?php echo $rows['FileName']; ?></td>
      <td><?php echo floor($rows['Size'] / 1000) . ' KB'; ?></td>
      <td><?php echo $rows['Downloads']; ?></td>
      <td><a href="dashboard.php?show=<?php echo $rows['ID'] ?>" class="btn btn-outline-primary"><i class="fa fa-eye" aria-hidden="true"> Show </i></a>
      <a href="dashboard.php?download=<?php echo $rows['ID'] ?>" class="btn btn-outline-success"><i class="fa fa-arrow-circle-o-down" aria-hidden="true"> Download </i></a>
      <a href="dashboard.php?delete=<?php echo $rows['ID'] ?>" onclick="return confirm('Are You Sure You Want To Delete This File?');"class="btn btn-outline-danger"><i class="fa fa-trash-o" aria-hidden="true"> Delete </i></a>
      <td><?php echo $rows['current_date']; ?></td>
      <td><?php echo $rows ['Name'];?></td>
    </td>
      <?php }?>
    </tr>
  </tbody>
</table>
  </div>
  <script>
function myFunction() {
  var input, text, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  text = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(text) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
</div>
</body>
</html>
