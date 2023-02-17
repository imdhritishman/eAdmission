<?php
    require("header.php");
    require("connection.php");

    if(isset($_POST['adm_submit'])){
        $adm_username = $_POST['adm_username'];
        $adm_password = md5($_POST['adm_password']);

        $sql_admin = "SELECT * FROM `admin` WHERE `adm_username` = '$adm_username' AND `adm_password` = '$adm_password'";
        $result_admin = mysqli_query($connect, $sql_admin);
        $num_admin = mysqli_num_rows($result_admin);
        $info_admin = mysqli_fetch_assoc($result_admin);
        
        if($num_admin==1) {
          $adm_id = $info_admin['adm_id'];
          $_SESSION['adm_id']=$adm_id;
          ?>
          <script>
            window.location.href = "index-admin.php";
          </script>
          <?php
      }
      else
      {
          $success=0;
      }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eAdmission - Admin Login</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/icons/sa-title-icon.png" />
    <link rel="stylesheet" href="css/login-admin.css">
</head>
<body>
<div class="login">
  <h1>Hi, Admin!</h1>
  <form method="post" autocomplete="off">
    <input type="text" name="adm_username" placeholder="Username" required="required">
    <input type="password" name="adm_password" placeholder="Password" required="required">
    <input type="submit" name="adm_submit" class="btn btn-primary btn-block btn-large" value="LOGIN">
  </form>
</div>
</body>
</html>

<script src="js/login-admin.js"></script>