<?php include('connexion.php');
session_start();
if ((!isset($_SESSION['login'])) ||
  (empty($_SESSION['login']))
) {
  // la variable 'login' de session est non déclarée
  header('location:index.php');
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>New Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      padding: 20px;
      height: 100vh;
      overflow: hidden;
      background-color: #001C30;
      color: #F7FFE5;
    }

    pre {
      background: rgba(23, 107, 135, 1);
      width: 90%;
      border-radius: 16px;
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(7.8px);
      -webkit-backdrop-filter: blur(7.8px);
      border: 1px solid rgba(23, 107, 135, 0.3);
      padding: 10px;
      overflow: auto;
    }

    img {
      width: 80%;
    }

    #container {
      display: grid;
      grid-template-columns: 1fr 1fr;
      column-gap: 30px;
      align-items: center;
      color: white;
    }

    #imgContainer {
      grid-column: 1;
    }

    #contentContainer {
      grid-column: 2;
    }
  </style>
</head>

<body>
  <h1>QR Code Data</h1>
  <div id="container">
    <div class="d-flex justify-content-center">
      <img src="Personal files-cuate.svg" alt="Centered Image" id="imgContainer" class="img-fluid">
    </div>
    <pre id="contentContainer"></pre>
  </div>

  <script>
    // Extract the QR code data from the URL query parameter
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var qrCodeData = urlParams.get('qrcode');
    var qrCodeDataLines = qrCodeData.split('\n');

    // Get the first line of the qrCodeData
    var firstLineValue = qrCodeDataLines[3]; // Replace this with your actual value
    // Send the firstLineValue to the PHP script using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "afterscan.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        // Request completed successfully, do something with the response if needed
        console.log(xhr.responseText);
      }
    };
    xhr.send("firstLine=" + encodeURIComponent(firstLineValue));
    // Format the QR code data as vCard
    var vcardData =
      '' +
      qrCodeData + '\n' +
      '';
    // Display the QR code data as vCard on the page
    var vcardElement = document.getElementById('contentContainer');
    vcardElement.textContent = vcardData;
  </script>
  <?php
  $qrID = $_POST['firstLine'];
  $ID = $_SESSION['login'];
  $Time = $_SESSION['login_date'];
  $requet = "INSERT INTO `login_logs`(`ID_LOGIN`, `username`, `login_date`, `QR`) VALUES (null,'$ID','$Time','$qrID')";
  $result = mysqli_query($link, $requet);

  ?>
</body>

</html>