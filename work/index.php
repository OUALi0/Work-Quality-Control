<?php
include('connexion.php');

if (isset($_POST['connecter'])) {
  $login = $_POST['login'];
  $requet1 = "SELECT * FROM employer WHERE ID='$login'";
  $result1 = mysqli_query($link, $requet1);
  $data1 = mysqli_fetch_assoc($result1);
  $requet2 = "SELECT * FROM admin WHERE ID='$login'";
  $result2 = mysqli_query($link, $requet2);
  $data2 = mysqli_fetch_assoc($result2);
  if ($data1 == true) {
    // Save login time
    $currentDateTime = new DateTime();
    $currentDateTime->modify('-1 hour');
    $Time = $currentDateTime->format('Y-m-d H:i:s');
    session_start();
    $_SESSION['login'] = $data1['ID'];
    $_SESSION['login_date'] = $Time;
    $requet = "INSERT INTO `login_logs`(`ID_LOGIN`, `username`, `login_date`) VALUES (NULL,'$ID','$Time')";
    $result = mysqli_query($link, $requet);

    header('location: scan.php');
  } elseif ($data2 == true) {
    session_start();
    $_SESSION['login'] = $data2['ID'];
    header('location: menu.php');
  } else {
    exit("login or password incorrect");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>LOGIN</title>
  <link rel="manifest" href="/manifest.json">
  <meta name="theme-color" content="#2196f3" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="viewport" content="width=device-width">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: "Muli", sans-serif;
      background-color: #001C30;
      color: #fff;
      display: flex;
      height: 100vh;
      overflow: hidden;
      margin: 0;
    }

    .container {
      background-color: rgba(0, 0, 0, 0.4);
      position: absolute;
      left: 60%;
      top: 20%;
      padding: 20px 40px;
      border-radius: 5px;
      background: rgba(23, 107, 135, 1);
      border-radius: 16px;
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(7.8px);
      -webkit-backdrop-filter: blur(7.8px);
      border: 1px solid rgba(23, 107, 135, 0.3);
    }

    .container h1 {
      text-align: center;
      margin-bottom: 30px;
    }

    .container a {
      padding-top: 20px;
      text-decoration: none;
      color: #FCFFE7;
    }

    .btn {
      cursor: pointer;
      display: inline-block;
      width: 100%;
      background: #00ADB5;
      padding: 15px;
      font-family: inherit;
      font-size: 16px;
      border: 0;
      border-radius: 5px;
    }

    .btn:hover {
      background-color: #393E46;
      color: #BAD7E9;
    }

    input {
      background-color: transparent;
      border: 0;
      border-bottom: 2px #fff solid;
      display: block;
      margin: 20px 0 40px;
      width: 300px;
      width: 100%;
      padding: 15px 0;
      font-size: 18px;
      color: #fff;
    }

    input:focus,
    input:valid {
      outline: 0;
      border-bottom-color: lightblue;
    }

    .btn:focus {
      outline: 0;
    }

    .btn:active {
      transform: scale(0.98);
    }

    #imgLogin {
      position: relative;
      /* or absolute */
      width: 40%;
      top: 8%;
      /* adjust the value as needed */
      left: 70px;
      /* adjust the value as needed */
    }

    #imgContainer {
      position: relative;
      left: 70px;
    }
  </style>
</head>

<body>

  <img src="Fingerprint-cuate.svg" id="imgLogin" alt="">
  <div class="container d-flex flex-column align-items-center">
    <img src="aptiv-logo.svg" id="imgContainer" alt="">
    <h1>CONNECTEZ VOUS</h1>
    <form method="POST">
      <label><b>LOGIN</b></label>
      <input type="number" placeholder="ENTRER VOTRE ID" name="login" required>
      <input type="submit" class='btn' value='connecter' name="connecter">
    </form>
  </div>

</body>

</html>