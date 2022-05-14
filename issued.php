<?php
session_start();
include "./Navbar/nav.php";
include "fileupload.php";
include "conn.php";
?>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js%22%3E"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/1a3d7e969b.js" crossorigin="anonymous"></script>
    <script src="https://cdn.asprise.com/scannerjs/scanner.js" type="text/javascript"></script>
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
  .text-center
  {
    font-family:adobe arabic;
    font-size:30px;
  }
      body{
        background-image: linear-gradient(#FFFDE4,#005AA7);
        font-family: 'Signika Negative', sans-serif;
      }
      .container {
    border-radius: 5px;
    background-image: linear-gradient(#eef2f3,#8e9eab);
    padding: 20px;
  }
  button {
      margin-left:1% !important;
    }
  .bg-light
  {
    background-color:red !important;
  }
input[type=text]
{
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=date]
{
  width: 100%;
  padding: 12px 20px;
  margin: 10px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
.custom-file-button input[type=file] {
  margin-left:70%;
}
.custom-file-button input[type=file]::file-selector-button {
  display: none;
}
textarea
{
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
span 
{
  margin-top:7.5%
}
</style>
  </head>
 
  <body>
    <br>
    <h1 class="text-center"> تحرير المعاملة الداخلية </h1>
    <hr>
    <form action ="issued.php" method="post" enctype="multipart/form-data"> 
       <div class="container">
        <div class="input-group mb-3">
        <input type="text" class="form-control" style=" direction: rtl;" placeholder="دائرة الشؤون القانونية"disabled>
          <div class="input-group-append">
            <span class="input-group-text"> :مركز المعاملة</span>
          </div>
             <div class="input-group mb-3">
              <input type="text" class="form-control" style=" direction: rtl;" name="trans_num" required>
              <div class="input-group-append">
                <span class="input-group-text ">رقم المعاملة</span>
              </div>
              <div class="input-group mb-3">
                <input type="date" class="form-control" style=" direction: rtl;" name="trans_date">
                <div class="input-group-append">
                  <span class="input-group-text"> :تاريخ المعاملة</span>
                </div>
                <div class="input-group mb-3">
                  <textarea class="form-control" rows="3"  id="comment" style=" direction:rtl;" name="trans_sub" required></textarea>
                  <div class="input-group-append">
                    <span class="input-group-text" >:الموضوع</span>
                  </div>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" style=" direction: rtl;" placeholder="2" disabled>
                        <div class="input-group-append">
                          <span class="input-group-text" >:رقم الملف</span>
                        </div>
          </div>
          <div class="input-group custom-file-button">
    <input type="file" class="form-control" id="inputGroupFile" name="trans_file">
    <label class="input-group-text" for="inputGroupFile">اختار ملف</label>
  </div>
          <button type="button" class="btn btn-primary btn-lg" onclick="scanAndUploadDirectly();">Scan</button><br>
          <div id="server_response"></div>
          <button type="submit" class="btn btn-success btn-lg" name="save_issued">Save</button> 
    </div>
  </div>
</form>
</body>
</html> 