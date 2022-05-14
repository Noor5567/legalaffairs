<?php 
	require 'conn.php';

	if(isset($_POST['sourceid'])) {
		$sql="SELECT * FROM sources WHERE CID = " . $_POST['sourceid'];
		$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
		echo json_encode($row);
	  }
 ?>