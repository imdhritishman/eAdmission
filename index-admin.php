<?php
    require("connection.php");
    require("header.php");
    $page_title = "Admin Home";

    if(isset($_SESSION['adm_id'])){
        $adm_id = $_SESSION['adm_id'];
        $sql_admin = "SELECT * FROM `admin` WHERE `adm_id` = '$adm_id'";
        $result_admin = mysqli_query($connect, $sql_admin);
        $num_admin = mysqli_num_rows($result_admin);
        $info_admin = mysqli_fetch_assoc($result_admin);
    }
    else{
        ?>
        <script>
            window.location.href="logout-admin.php";
        </script>
        <?php
    }

    $sql_total_institute = "SELECT * FROM institute";
    $result_total_institute = mysqli_query($connect, $sql_total_institute);
    $num_total_institute = mysqli_num_rows($result_total_institute);
    $info_total_institute = mysqli_fetch_all($result_total_institute, MYSQLI_ASSOC);

    $sql_total_application = "SELECT * FROM registration_details";
    $result_total_application = mysqli_query($connect, $sql_total_application);
    $num_total_application = mysqli_num_rows($result_total_application);
    $info_total_application = mysqli_fetch_all($result_total_application, MYSQLI_ASSOC);

    $sql_total_students = "SELECT * FROM student";
    $result_total_students = mysqli_query($connect, $sql_total_students);
    $num_total_students = mysqli_num_rows($result_total_students);
    $info_total_students = mysqli_fetch_all($result_total_students, MYSQLI_ASSOC);

    $sql_pending_applications = "SELECT * FROM registration_details WHERE ((`s_aplstatus1`=0 OR `s_aplstatus2`=0 OR `s_aplstatus3`=0) AND (`s_aplstatus1`!=3 AND `s_aplstatus2`!=3 AND `s_aplstatus3`!=3))";
    $result_pending_applications = mysqli_query($connect, $sql_pending_applications);
    $num_pending_applications = mysqli_num_rows($result_pending_applications);
    $info_pending_applications = mysqli_fetch_all($result_pending_applications, MYSQLI_ASSOC);

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
    <link rel="stylesheet" href="css/index-admin.css">
</head>

<style>
  #card1{
    background-image: url("assets/images/card-background.png");
    background-size: cover;
  }
  #card2{
    background-image: url("assets/images/card-background.png");
    background-size: cover;
  }
  #card3{
    background-image: url("assets/images/card-background.png");
    background-size: cover;
  }
  #card4{
    background-image: url("assets/images/card-background.png");
    background-size: cover;
  }
</style>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="margin-left: 10px; font-weight:600;">
        <i class="fa fa-exclamation-triangle" style="color: red; font-size:20px"></i> &nbsp; &nbsp; Are you sure want to Log out of <?php echo $info_admin['adm_name'] ?>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
        <button type="button" class="btn btn-danger" onclick="window.location.href='logout-admin.php'">LOGOUT</button>
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
            <i class="fa fa-user" id="user" style="font-size: 18px;"></i>
            <div class="username">Welcome, <span><?php echo $info_admin['adm_name']?></span>!</div>
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
          <img src="assets/icons/eadmission-icon.png" alt="eAdmission Logo">
      </div>
    </div>
    <div class="l-sidebar__content">
      <nav class="c-menu js-menu">
        <ul class="u-list">
          <a href="index-admin.php" style="text-decoration:none">
            <li class="c-menu__item is-active" data-toggle="tooltip" title="Dashboard">
              <div class="c-menu__item__inner"><i class="fa fa-th-large"></i>
                <div class="c-menu-item__title"><span>Dashboard</span></div>
              </div>
            </li>
          </a>
          <a href="institutes-admin.php" style="text-decoration:none">
            <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Institutes">
              <div class="c-menu__item__inner"><i class="fa fa-university"></i>
                <div class="c-menu-item__title"><span>Institutes</span></div>
              </div>
            </li>
          </a>
          <a href="applications-admin.php" style="text-decoration:none">
            <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Applications">
              <div class="c-menu__item__inner"><i class="fa fa-file-pdf"></i>
                <div class="c-menu-item__title"><span>Applications</span></div>
              </div>
            </li>
          </a>
          <a href="students-admin.php" style="text-decoration:none">
            <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Students">
              <div class="c-menu__item__inner"><i class="fa fa-graduation-cap"></i>
                <div class="c-menu-item__title"><span>Students</span></div>
              </div>
            </li>
          </a>
          <a href="admin-profile.php" style="text-decoration:none">
            <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Admin Profile">
              <div class="c-menu__item__inner"><i class="fa fa-user"></i>
                <div class="c-menu-item__title"><span>Admin Profile</span></div>
              </div>
            </li>
          </a>
          <a href="change-password-admin.php" style="text-decoration:none">
            <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Change Password">
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
    <h2 class="page-title">Admin Dashboard</h2>
    <div class="row">
      <div class="col-md-3 card-area" onclick="window.location.href='institutes-admin.php'">
        <div class="page-content card" id="card1">
          <div class="row card-title">
            <span>Total Institutes</span>
          </div>
          <div class="row card-icon">
            <div>
              <i class="fa fa-university" style="font-size: 72px;"></i>
            </div>
          </div>
          <div class="row card-value">
            <span><?php echo $num_total_institute ?></span>
          </div>
        </div>
      </div>
      <div class="col-md-3 card-area" onclick="window.location.href='applications-admin.php'">
        <div class="page-content card" id="card2">
          <div class="row card-title">
            <span>Total Applications</span>
          </div>
          <div class="row card-icon">
            <div>
              <i class="fa fa-file-pdf" style="font-size: 72px;"></i>
            </div>
          </div>
          <div class="row card-value">
            <span><?php echo $num_total_application ?></span>
          </div>
        </div>
      </div>
      <div class="col-md-3 card-area" onclick="window.location.href='students-admin.php'">
        <div class="page-content card" id="card3">
          <div class="row card-title">
            <span>Total Students</span>
          </div>
          <div class="row card-icon">
            <div>
              <i class="fa fa-graduation-cap" style="font-size: 72px;"></i>
            </div>
          </div>
          <div class="row card-value">
            <span><?php echo $num_total_students ?></span>
          </div>
        </div>
      </div>
      <div class="col-md-3 card-area" onclick="window.location.href='applications-admin.php'">
        <div class="page-content card" id="card4">
          <div class="row card-title">
            <span>Pending Applications</span>
          </div>
          <div class="row card-icon">
            <div>
              <i class="fa fa-exclamation-circle" style="font-size: 72px;"></i>
            </div>
          </div>
          <div class="row card-value">
            <span><?php echo $num_pending_applications ?></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<div class="footer">&copy; 2022 | <strong>eAdmission System</strong> | All Rights are Reserved</div>
</html>

<script src="js/index-admin.js"></script>
