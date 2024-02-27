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
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    body {
      width: 100%;
      margin: auto;
      max-height: 500px;
      background: #001C30;
    }

    header {
      padding-top: 40px;
    }

    .title {
      font-family: dacing;
      font-size: 60px;
      color: #D8C4B6;
      text-align: center;
      padding: 80px 0px 10px 0px;
    }

    table {
      margin: auto;
      /* From https://css.glass */
      background: rgba(255, 255, 255, 0.2);
      border-radius: 16px;
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(5px);
      -webkit-backdrop-filter: blur(5px);
      border: 1px solid rgba(255, 255, 255, 0.3);
    }

    th {
      width: 400px;
      background-color: #4F709C;
      border-radius: 19px;
      text-align: center;
    }

    td {
      background-color: #D8C4B6;
      border-radius: 19px;
      width: 400px;
      text-align: center;
    }

    img {
      position: relative;
      left: 42%;
    }
  </style>
</head>

<body>
  <header>
    <nav class="navbar bg-body-tertiary">
      <div class="d-flex justify-content-center align-items-center">
        <a class="navbar-brand" href="https://www.aptiv.com/">
          <img src="aptiv-logo.svg" alt="Logo" class="img-fluid">
        </a>
      </div>
    </nav>

  </header>
  <h2 class="title">LISTE MAINTENNANCES</h2>
  <table>
    <tr>
      <th>ID</th>
      <th>NOM</th>
      <th>DATE OF THE LOGIN</th>
      <th>QR CODE</th>
    </tr>
    <?php
    include('connexion.php');
    $requet = "SELECT * FROM login_logs,employer WHERE login_logs.username=employer.ID ";
    $result = mysqli_query($link, $requet);
    while ($data = mysqli_fetch_assoc($result)) {
      $nom = $data['NAME'];
      $ID = $data['username'];
      $loginTime = $data['login_date'];
      $qrID = $data['QR'];
      if ($qrID !== null && $qrID !== '') {
        echo "<tr>";
        echo "<td>$ID</td>";
        echo "<td>$nom</td>";
        echo "<td>$loginTime</td>";
        echo "<td>$qrID</td>";
        echo "</tr>";
      }
    }
    ?>
  </table>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1450 320">
    <path fill="#ff2171" fill-opacity="0.8" d="M0,288L12.6,261.3C25.3,235,51,181,76,149.3C101.1,117,126,107,152,133.3C176.8,160,202,224,227,240C252.6,256,278,224,303,224C328.4,224,354,256,379,240C404.2,224,429,160,455,154.7C480,149,505,203,531,186.7C555.8,171,581,85,606,85.3C631.6,85,657,171,682,176C707.4,181,733,107,758,96C783.2,85,808,139,834,176C858.9,213,884,235,909,234.7C934.7,235,960,213,985,181.3C1010.5,149,1036,107,1061,122.7C1086.3,139,1112,213,1137,240C1162.1,267,1187,245,1213,213.3C1237.9,181,1263,139,1288,144C1313.7,149,1339,203,1364,218.7C1389.5,235,1415,213,1427,202.7L1440,192L1440,320L1427.4,320C1414.7,320,1389,320,1364,320C1338.9,320,1314,320,1288,320C1263.2,320,1238,320,1213,320C1187.4,320,1162,320,1137,320C1111.6,320,1086,320,1061,320C1035.8,320,1011,320,985,320C960,320,935,320,909,320C884.2,320,859,320,834,320C808.4,320,783,320,758,320C732.6,320,707,320,682,320C656.8,320,632,320,606,320C581.1,320,556,320,531,320C505.3,320,480,320,455,320C429.5,320,404,320,379,320C353.7,320,328,320,303,320C277.9,320,253,320,227,320C202.1,320,177,320,152,320C126.3,320,101,320,76,320C50.5,320,25,320,13,320L0,320Z" style="--darkreader-inline-fill: #b80042;" data-darkreader-inline-fill=""></path>
  </svg>
</body>

</html>