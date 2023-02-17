<?php
    require("../../connection.php");
    require("../../header.php");
    $page_title = "Applications";
    $count = 1;

    if(isset($_SESSION['ins_id'])){
        $ins_id = $_SESSION['ins_id'];
        $sql_institute = "SELECT * FROM institute WHERE `ins_id` = '$ins_id'";
        $result_institute = mysqli_query($connect, $sql_institute);
        $num_institute = mysqli_num_rows($result_institute);
        $info_institute = mysqli_fetch_assoc($result_institute);
    }
    else{
        ?>
        <script>
            window.location.href="../../logout-institute.php";
        </script>
        <?php
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eAdmission - <?php echo $page_title ?></title>
    <!-- Dashboard UI CSS/JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/fail.css">
    <!-- Datable CSS/JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
</head>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="margin-left: 10px; font-weight:600;">
        <i class="fa fa-exclamation-triangle" style="color: red; font-size:20px"></i> &nbsp; &nbsp; Are you sure want to Log out of <?php echo $ins_name ?>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
        <button type="button" class="btn btn-danger" onclick="window.location.href='../../logout-institute.php'">LOGOUT</button>
      </div>
    </div>
  </div>
</div>

<body class="sidebar-is-reduced">
  <header class="l-header">
    <div class="l-header__inner clearfix">
      <div class="c-header-icon js-hamburger">
        <div class="hamburger-toggle"><span class="bar-top"></span><span class="bar-mid"></span><span class="bar-bot"></span></div>
      </div>
      <!-- <div class="c-header-icon has-dropdown"><span class="c-badge c-badge--red c-badge--header-icon animated swing">13</span><i class="fa fa-bell"></i>
        <div class="c-dropdown c-dropdown--notifications">
          <div class="c-dropdown__header"></div>
          <div class="c-dropdown__content"></div>
        </div>
      </div> -->
      <!-- <div class="c-search">
        <input class="c-search__input u-input" placeholder="Search..." type="text"/>
      </div> -->
      <div class="header-icons-group">
        <div class="user">
            <i class="fa fa-university" id="user" style="font-size: 18px;"></i>
            <div class="username">Welcome, <span><?php echo $info_institute['ins_name']?></span>!</div>
        </div>
        <div class="c-header-icon logout">
            <i class="fa fa-power-off" style="color: red;" data-toggle="modal" data-target="#logoutModal"></i>
        </div>
      </div>
    </div>
  </header>
  <div class="l-sidebar">
    <div class="logo" style="background-color: #D3E8FF;">
      <div class="logo__txt">
          <img src="../../assets/icons/eadmission-icon.png" alt="eAdmission Logo">
      </div>
    </div>
    <div class="l-sidebar__content">
      <nav class="c-menu js-menu">
        <ul class="u-list">
          <a href="../../index-institute.php" style="text-decoration:none">
            <li class="c-menu__item" data-toggle="tooltip" title="Dashboard">
              <div class="c-menu__item__inner"><i class="fa fa-th-large"></i>
                <div class="c-menu-item__title"><span>Dashboard</span></div>
              </div>
            </li>
          </a>
          <a href="../../applications.php" style="text-decoration:none">
            <li class="c-menu__item is-active" data-toggle="tooltip" title="Applications">
              <div class="c-menu__item__inner"><i class="fa fa-file-pdf"></i>
                <div class="c-menu-item__title"><span>Applications</span></div>
              </div>
            </li>
          </a>
          <a href="../../students.php" style="text-decoration:none">
            <li class="c-menu__item" data-toggle="tooltip" title="Students">
              <div class="c-menu__item__inner"><i class="fa fa-graduation-cap"></i>
                <div class="c-menu-item__title"><span>Students</span></div>
              </div>
            </li>
          </a>
          <a href="../../institute-profile.php" style="text-decoration:none">
            <li class="c-menu__item" data-toggle="tooltip" title="Institute Profile">
              <div class="c-menu__item__inner"><i class="fa fa-university"></i>
                <div class="c-menu-item__title"><span>Institute Profile</span></div>
              </div>
            </li>
          </a>
          <a href="../../change-password-institute.php" style="text-decoration:none">
            <li class="c-menu__item" data-toggle="tooltip" title="Change Password">
              <div class="c-menu__item__inner"><i class="fa fa-unlock-alt"></i>
                <div class="c-menu-item__title"><span>Change Password</span></div>
              </div>
            </li>
          </a>
        </ul>
      </nav>
    </div>
  </div>
</body>

<main class="l-main">
  <div class="content-wrapper content-wrapper--with-bg">
    <div class="success-animation" style="margin-bottom:50px;">
      <svg class="checkmark error" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark_circle_error" cx="26" cy="26" r="25" fill="none"/><path class="checkmark_check" stroke-linecap="round" fill="none" d="M16 16 36 36 M36 16 16 36"></svg>
    </div>
    <div class="text-center">
        <h2 style="margin-bottom: 50px;">Application Already Confirmed for Admission!</h2>
        <button type="button" class="btn btn-danger" style="font-size:large" onclick="window.location.href='../../applications.php'">Try Again</button>
    </div>
  </div>
</main>

<div class="footer">&copy; 2022 | <strong>eAdmission System</strong> | All Rights are Reserved</div>
</html>

<script src="../js/fail.js"></script>
