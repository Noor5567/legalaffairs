<?php
session_start();
include "./Navbar/nav.php";
include "fileupload.php";
include "conn.php";
?>
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.asprise.com/scannerjs/scanner.js" type="text/javascript"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script type="text/javascript">
		$(document).ready(function(){
			$("#sourceclass").change(function(){
				var sourceid = $("#sourceclass").val();
				$.ajax({
					url: 'data.php',
					method: 'post',
					data: 'sourceid=' + sourceid
				}).done(function(source){
					source = JSON.parse(source); //b7awel el data men web server men string to JavaScript object
					$('#source').empty();// bmsa7 el  content men the selected elements
					source.forEach(function(sources){
						$('#source').append('<option>' + sources.SourceName + '</option>')//bda5al  eshi mo3yan men el  content fe 2a5er el selected elements
					})
				})
			})
		})
	</script>
  <script>
    /** Scan and upload in one go */
    function scanAndUploadDirectly() {
        scanner.scan(displayServerResponse,
            {
                "output_settings": [
                    {
                        "type": "upload",
                        "format": "pdf",
                        "upload_target": {
                            "url": "https://asprise.com/scan/applet/upload.php?action=dump",
                            "post_fields": {
                                "sample-field": "Test scan"
                            },
                            "cookies": document.cookie,
                            "headers": [
                                "Referer: " + window.location.href,
                                "User-Agent: " + navigator.userAgent
                            ]
                        }
                    }
                ]
            }
        );
    }

    function displayServerResponse(successful, mesg, response) {
        if(!successful) { // On error
            document.getElementById('server_response').innerHTML = 'Failed: ' + mesg;
            return;
        }

        if(successful && mesg != null && mesg.toLowerCase().indexOf('user cancel') >= 0) { // User cancelled.
            document.getElementById('server_response').innerHTML = 'User cancelled';
            return;
        }

        document.getElementById('server_response').innerHTML = scanner.getUploadResponse(response);
    }
</script>
  <style>
    body
    {
      background-image: linear-gradient(#FFFDE4,#005AA7);
      font-family: 'Signika Negative', sans-serif;
    }
    button {
      margin-left:1% !important;
    }
    .container {
  border-radius: 5px;
  background-image: linear-gradient(#FFFFFF,#ECE9E6);
  padding: 20px;
}
.bg-light
{
  background-color:whitesmoke !important;
}

.custom-file-button input[type=file] {
  margin-left:70%;
}
.custom-file-button input[type=file]::file-selector-button {
  display: none;
}
select 
{
  width: 100%;
  padding: 12px 20px;
  margin: 10px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
.drop 
{
  height: 91%;
}
</style>
</head>
<body>
<br>
  <h1 class="text-center">تحرير الوارد</h1>
  <hr>
  <form action ="income.php" method="post" enctype="multipart/form-data">    
    <div class="container">
      <div class="input-group mb-3">
        <input type="text" class="form-control" style=" direction: rtl;" name="cent" placeholder="دائرة الشؤون القانونية"disabled>
        <div class="input-group-append">
          <span class="input-group-text">:مركز الوارد</span>
        </div><div><br>
           <div class="input-group mb-3">
            <input type="text" class="form-control" style=" direction: rtl;" name="papernum" >
            <div class="input-group-append">
              <span class="input-group-text">:رقم الكتاب من المصدر</span>
            </div><div><br>
            <div class="input-group mb-3">
              <input type="date" class="form-control" style="direction:rtl;" name="date" >
              <div class="input-group-append">
                <span class="input-group-text ">:تاريخ الكتاب من المصدر</span>
              </div><div><br>
              <div class="input-group mb-3">
                <textarea class="form-control" rows="3"  id="comment" style=" direction: rtl;" name="sub" required></textarea>
                <div class="input-group-append">
                  <span class="input-group-text" >:الموضوع</span>
                </div><div><br>
                <div class="input-group mb-3">
                  <select name="sourceclass" id="sourceclass" class="custom-select mb-1" dir="rtl" lang="AR">
                  <option selected="" disabled="">تصنيف الجهة الوارد منها</option>
                  <?php
                  	$stmt = "SELECT * FROM sourceclass";
                    $result = mysqli_query($conn, $stmt);
                    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
                foreach ($row as $rows) {
                  echo "<option id='".$rows['ID']."' value='".$rows['ID']."'>".$rows['ClassName']."</option>";
                }
                  ?>
                  </select>
                  <div class="input-group-append">
                    <div class="input-group-text drop" >:تصنيف الجهة الوارد منها</div>
                  </div>
                  <div class="input-group mb-3">
                  <select name="source" id="source" class="custom-select mb-1" dir="rtl" lang="AR">
                  <option selected="" disabled="">تصنيف الجهة الوارد منها</option>
                  </select>
                    <div class="input-group-append">
                      <span class="input-group-text drop" >:الجهة الوارد منها</span>
                    </div></div><br>
                    <div class="input-group mb-3">
                      <input type="text " class="form-control" style=" direction: rtl;" placeholder="1" disabled>
                      <div class="input-group-append">
                        <span class="input-group-text" >:رقم الملف</span>
                      </div>
        </div>
         <div class="input-group custom-file-button">
    <input type="file" class="form-control" id="inputGroupFile" name="myfile">
    <label class="input-group-text" for="inputGroupFile">اختار ملف</label>
  </div>
          <button type="button" class="btn btn-outline-primary btn-lg" onclick="scanAndUploadDirectly();">Scan</button><br>
          <div id="server_response"></div>
          <button type="submit" class="btn btn-outline-success btn-lg" name="save">Save</button> 
  </div>
</div>
</form>
</body>