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
  <title>QR Code Scanner</title>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #001C30;
      font-family: Arial, sans-serif;
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

    #video {
      width: 100%;
      border: 2px solid #000;
    }
  </style>
</head>

<body>
  <div id="container">
    <img src="QR Code-amico.svg" id="imgContainer" alt="">
    <div id="contentContainer">
      <h1>QR Code Scanner</h1>
      <video id="video" autoplay></video>
    </div>
  </div>
  <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/instascan@1.0.1/instascan.min.js"></script>
  <script>
    // Check if the browser supports getUserMedia API
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
      // Access the camera
      navigator.mediaDevices.getUserMedia({
          video: true
        })
        .then(function(stream) {
          // Bind the video element to the camera stream
          var videoElement = document.getElementById('video');
          videoElement.srcObject = stream;

          // Initialize the QR code scanner
          var scanner = new Instascan.Scanner({
            video: videoElement
          });
          scanner.addListener('scan', function(content) {
            // Redirect to a new page with the scanned QR code data
            window.location.href = 'afterscan.php?qrcode=' + encodeURIComponent(content);
          });

          // Start scanning for QR codes
          Instascan.Camera.getCameras()
            .then(function(cameras) {
              if (cameras.length > 0) {
                scanner.start(cameras[0]);
              } else {
                console.error('No cameras found.');
              }
            })
            .catch(function(error) {
              console.error('Error accessing cameras:', error);
            });
        })
        .catch(function(error) {
          console.error('Error accessing camera:', error);
        });
    } else {
      console.error('getUserMedia is not supported in this browser.');
    }
  </script>
</body>

</html>