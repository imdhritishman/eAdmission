<?php
    require("connection.php");
    require("header.php");
    $page_title = "Institute Home";

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
            window.location.href="logout-institute.php";
        </script>
        <?php
    }

    $ins_name = $info_institute['ins_name'];
    $sql_total_applications = "SELECT * FROM registration_details WHERE `s_institute1` = '$ins_name' OR `s_institute2` = '$ins_name' OR `s_institute3` = '$ins_name'";
    $result_total_applications = mysqli_query($connect, $sql_total_applications);
    $num_total_applications = mysqli_num_rows($result_total_applications);
    $info_total_applications = mysqli_fetch_assoc($result_total_applications);

    $sql_approved_applications = "SELECT * FROM registration_details WHERE (`s_institute1` = '$ins_name' AND (`s_aplstatus1` = 1 || `s_aplstatus1` = 3)) OR (`s_institute2` = '$ins_name' AND (`s_aplstatus2` = 1 || `s_aplstatus2` = 3)) OR (`s_institute3` = '$ins_name' AND (`s_aplstatus3` = 1 || `s_aplstatus3` = 3))";
    $result_approved_applications = mysqli_query($connect, $sql_approved_applications);
    $num_approved_applications = mysqli_num_rows($result_approved_applications);
    $info_approved_applications = mysqli_fetch_assoc($result_approved_applications);

    $sql_rejected_applications = "SELECT * FROM registration_details WHERE (`s_institute1` = '$ins_name' AND `s_aplstatus1` = 2) OR (`s_institute2` = '$ins_name' AND `s_aplstatus2` = 2) OR (`s_institute3` = '$ins_name' AND `s_aplstatus3` = 2)";
    $result_rejected_applications = mysqli_query($connect, $sql_rejected_applications);
    $num_rejected_applications = mysqli_num_rows($result_rejected_applications);
    $info_rejected_applications = mysqli_fetch_assoc($result_rejected_applications);

    $sql_pending_applications = "SELECT * FROM registration_details WHERE (`s_institute1` = '$ins_name' AND `s_aplstatus1` = 0) OR (`s_institute2` = '$ins_name' AND `s_aplstatus2` = 0) OR (`s_institute3` = '$ins_name' AND `s_aplstatus3` =0)";
    $result_pending_applications = mysqli_query($connect, $sql_pending_applications);
    $num_pending_applications = mysqli_num_rows($result_pending_applications);
    $info_pending_applications = mysqli_fetch_assoc($result_pending_applications);

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
    <link rel="stylesheet" href="css/index-institute.css">
</head>

<style>
  #total{
    background-image: url("assets/images/card-background.png");
    background-size: cover;
  }
  #approved{
    background-image: url("assets/images/card-background.png");
    background-size: cover;
  }
  #rejected{
    background-image: url("assets/images/card-background.png");
    background-size: cover;
  }
  #pending{
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
        <i class="fa fa-exclamation-triangle" style="color: red; font-size:20px"></i> &nbsp; &nbsp; Are you sure want to Log out of <?php echo $ins_name ?>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
        <button type="button" class="btn btn-danger" onclick="window.location.href='logout-institute.php'">LOGOUT</button>
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
          <img src="assets/icons/eadmission-icon.png" alt="eAdmission Logo">
      </div>
    </div>
    <div class="l-sidebar__content">
      <nav class="c-menu js-menu">
        <ul class="u-list">
          <a href="index-institute.php" style="text-decoration:none">
            <li class="c-menu__item is-active" data-toggle="tooltip" title="Dashboard">
              <div class="c-menu__item__inner"><i class="fa fa-th-large"></i>
                <div class="c-menu-item__title"><span>Dashboard</span></div>
              </div>
            </li>
          </a>
          <a href="applications.php" style="text-decoration:none">
            <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Applications">
              <div class="c-menu__item__inner"><i class="fa fa-file-pdf"></i>
                <div class="c-menu-item__title"><span>Applications</span></div>
              </div>
            </li>
          </a>
          <a href="students.php" style="text-decoration:none">
            <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Students">
              <div class="c-menu__item__inner"><i class="fa fa-graduation-cap"></i>
                <div class="c-menu-item__title"><span>Students</span></div>
              </div>
            </li>
          </a>
          <a href="institute-profile.php" style="text-decoration:none">
            <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Institute Profile">
              <div class="c-menu__item__inner"><i class="fa fa-university"></i>
                <div class="c-menu-item__title"><span>Institute Profile</span></div>
              </div>
            </li>
          </a>
          <a href="change-password-institute.php" style="text-decoration:none">
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
    <h2 class="page-title">Institute Dashboard</h2>
    <div class="row">
      <div class="col-md-3 card-area" onclick="window.location.href='applications.php'">
        <div class="page-content card" id="total">
          <div class="row card-title">
            <span>Total Applications</span>
          </div>
          <div class="row card-icon">
            <div>
              <i class="fa fa-arrow-circle-down" style="font-size: 72px;"></i>
            </div>
          </div>
          <div class="row card-value">
            <span><?php echo $num_total_applications ?></span>
          </div>
        </div>
      </div>
      <div class="col-md-3 card-area" onclick="window.location.href='applications.php'">
        <div class="page-content card" id="approved">
          <div class="row card-title">
            <span>Approved Applications</span>
          </div>
          <div class="row card-icon">
            <div>
              <i class="fa fa-check-circle" style="font-size: 72px;"></i>
            </div>
          </div>
          <div class="row card-value">
            <span><?php echo $num_approved_applications ?></span>
          </div>
        </div>
      </div>
      <div class="col-md-3 card-area" onclick="window.location.href='applications.php'">
        <div class="page-content card" id="rejected">
          <div class="row card-title">
            <span>Rejected Applications</span>
          </div>
          <div class="row card-icon">
            <div>
              <i class="fa fa-ban" style="font-size: 72px;"></i>
            </div>
          </div>
          <div class="row card-value">
            <span><?php echo $num_rejected_applications ?></span>
          </div>
        </div>
      </div>
      <div class="col-md-3 card-area" onclick="window.location.href='applications.php'">
        <div class="page-content card" id="pending">
          <div class="row card-title">
            <span>Pending Applications</span>
          </div>
          <div class="row card-icon">
            <div>
              <i class="fa fa-arrow-circle-right" style="font-size: 72px;"></i>
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

<script src="js/index-institute.js"></script>
