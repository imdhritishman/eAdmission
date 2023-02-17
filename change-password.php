<?php
    require("connection.php");
    require("header.php");
    $page_title = "Change Password";

    if(isset($_SESSION['s_id'])){
        $s_id = $_SESSION['s_id'];
        $sql_registration = "SELECT * FROM registration_details WHERE `s_id` = '$s_id'";
        $result_registration = mysqli_query($connect, $sql_registration);
        $num_registration = mysqli_num_rows($result_registration);
        $info_registration = mysqli_fetch_assoc($result_registration);
    }
    else{
        ?>
        <script>
            window.location.href="logout.php";
        </script>
        <?php
    }

    $sql_upload = "SELECT * FROM upload_documents WHERE `s_id` = '$s_id'";
    $result_upload = mysqli_query($connect, $sql_upload);
    $num_upload = mysqli_num_rows($result_upload);
    $info_upload = mysqli_fetch_assoc($result_upload);

    $sql_personal = "SELECT * FROM personal_details WHERE `s_id` = '$s_id'";
    $result_personal = mysqli_query($connect, $sql_personal);
    $num_personal = mysqli_num_rows($result_personal);
    $info_personal = mysqli_fetch_assoc($result_personal);

    $sql_family = "SELECT * FROM family_details WHERE `s_id` = '$s_id'";
    $result_family = mysqli_query($connect, $sql_family);
    $num_family = mysqli_num_rows($result_family);
    $info_family = mysqli_fetch_assoc($result_family);

    if(isset($_POST['submit_change_password'])){
      if(($_POST['s_newpassword']===$_POST['s_confirmpassword']) && (md5($_POST['s_previouspassword'])==$info_registration['s_password'])){
        $s_previouspassword = md5($_POST['s_previouspassword']);
        $s_newpassword = md5($_POST['s_newpassword']);
        $s_confirmpassword = md5($_POST['s_confirmpassword']);
        
        $sql_change_password = "UPDATE `registration_details` SET `s_password`='$s_newpassword' WHERE `s_id`='$s_id'";
        $result_change_password = mysqli_query($connect, $sql_change_password);
        
        if($result_change_password){
          ?>
            <script>
              window.location.href="global-assets/php/change-password-success.php";
            </script>
          <?php
        }
      }
      ?>
      <script>
        window.location.href="global-assets/php/change-password-fail.php";
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
    <link rel="stylesheet" href="css/change-password.css">
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
        <i class="fa fa-exclamation-triangle" style="color: red; font-size:20px"></i> &nbsp; &nbsp; Are you sure want to Log out of <?php echo $info_registration['s_name'] ?>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
        <button type="button" class="btn btn-danger" onclick="window.location.href='logout.php'">LOGOUT</button>
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
            <i class="fa fa-user" id="user"></i>
            <div class="username">Hello, <span><?php echo $info_registration['s_name']?></span>!</div>
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
          <a href="index.php" style="text-decoration:none">
            <li class="c-menu__item" data-toggle="tooltip" title="Dashboard">
              <div class="c-menu__item__inner"><i class="fa fa-th-large"></i>
                <div class="c-menu-item__title"><span>Dashboard</span></div>
              </div>
            </li>
          </a>
          <a href="my-institute.php" style="text-decoration:none">
            <li class="c-menu__item" data-toggle="tooltip" title="My Institute">
              <div class="c-menu__item__inner"><i class="fa fa-university"></i>
                <div class="c-menu-item__title"><span>My Institute</span></div>
              </div>
            </li>
          </a>
          <a href="my-profile.php" style="text-decoration:none">
            <li class="c-menu__item" data-toggle="tooltip" title="My Profile">
              <div class="c-menu__item__inner"><i class="fa fa-user"></i>
                <div class="c-menu-item__title"><span>My Profile</span></div>
              </div>
            </li>
          </a>
          <a href="change-password.php" style="text-decoration:none">
            <li class="c-menu__item is-active" data-toggle="tooltip" title="Change Password">
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
    <h2 class="page-title">Change Password</h2>
    <div class="page-content">
      <form action="change-password.php" method="post" autocomplete="off">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="InputPreviousPassword">Previous Password<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
              <input class="form-control" type="password" name="s_previouspassword" required>
            <small id="previousPasswordHelpInline" class="text-muted">
              Enter the previous password.
            </small>
          </div>
          <div class="form-group col-md-4">
            <label for="InputNewPassword">New Password<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
              <input class="form-control" type="password" name="s_newpassword" required>
            <small id="emailHelpInline" class="text-muted">
              Enter the new password.
            </small>
          </div>
          <div class="form-group col-md-4">
            <label for="InputConfirmPassword">Confirm Password<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
              <input class="form-control" type="password" name="s_confirmpassword" required>
            <small id="phoneHelpInline" class="text-muted">
              Enter the new password again.
            </small>
          </div>
        </div>
        <div class="form-row">
          <!-- <div class="form-group col-md-8" style="text-align:left">
            <button type="submit" name="prev_registration_details" class="btn btn-warning">Prev</button>
            <button type="submit" name="next_registration_details" class="btn btn-info">Next</button>
          </div> -->
          <div class="form-group col-md-12" style="text-align:right">
            <button type="submit" name="submit_change_password" class="btn btn-success">Change Password</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</main>
<div class="footer">&copy; 2022 | <strong>eAdmission System</strong> | All Rights are Reserved</div>
</html>

<script src="js/change-password.js"></script>
