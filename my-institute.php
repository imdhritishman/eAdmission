<?php
    require("connection.php");
    require("header.php");
    $page_title = "My Institute";

    if(isset($_SESSION['s_id'])){
        $s_id = $_SESSION['s_id'];
        $sql_registration = "SELECT * FROM registration_details WHERE `s_id` = '$s_id'";
        $result_registration = mysqli_query($connect, $sql_registration);
        $num_registration = mysqli_num_rows($result_registration);
        $info_registration = mysqli_fetch_assoc($result_registration);
        $s_aplno1 = $info_registration['s_aplno1'];
        $s_aplno2 = $info_registration['s_aplno2'];
        $s_aplno3 = $info_registration['s_aplno3'];
    }
    else{
        ?>
        <script>
            window.location.href="logout.php";
        </script>
        <?php
    }

    $sql_student = "SELECT * FROM student WHERE `std_aplno`='$s_aplno1' OR `std_aplno`='$s_aplno2' OR `std_aplno`='$s_aplno3'";
    $result_student = mysqli_query($connect,$sql_student);
    $num_student = mysqli_num_rows($result_student);
    $info_student = mysqli_fetch_assoc($result_student);
    $ins_name = $info_student['std_institute'];

    $sql_institute = "SELECT * FROM institute WHERE `ins_name`='$ins_name'";
    $result_institute = mysqli_query($connect,$sql_institute);
    $num_institute = mysqli_num_rows($result_institute);
    $info_institute = mysqli_fetch_assoc($result_institute);
    
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
    <link rel="stylesheet" href="css/my-institute.css">
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

<body class="sidebar-is-reduced" onload="startTime()"> 
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
            <li class="c-menu__item is-active" data-toggle="tooltip" title="My Institute">
              <div class="c-menu__item__inner"><i class="fa fa-university"></i>
                <div class="c-menu-item__title"><span>My Institute</span></div>
              </div>
            </li>
          </a>
          <a href="my-profile.php" style="text-decoration:none">
            <li class="c-menu__item has-submenu" data-toggle="tooltip" title="My Profile">
              <div class="c-menu__item__inner"><i class="fa fa-user"></i>
                <div class="c-menu-item__title"><span>My Profile</span></div>
              </div>
            </li>
          </a>
          <a href="change-password.php" style="text-decoration:none">
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

<?php if(($info_registration['s_aplstatus1']==3) || ($info_registration['s_aplstatus2']==3) || ($info_registration['s_aplstatus3']==3)){ ?>
<main class="l-main">
  <div class="content-wrapper content-wrapper--with-bg">
    <h2 class="page-title">My Institute</h2>
    <div class="page-content">
      <div class="form-row">
        <div class="form-group col-md-12">
          <div class="form-group ins-logo" style="text-align: center;">
            <img id="logo" src="<?php echo $info_institute['ins_logo'] ?>" height="100px" width="100px">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12">
            <div class="form-group ins-title" style="text-align: center;">
              <span class="ins-name col-md-12"><?php echo $info_institute['ins_name'] ?></span>
              <span class="ins-phone col-md-12">Phone: <?php echo $info_institute['ins_phone'] ?>&nbsp;&nbsp;&nbsp;Email: <?php echo $info_institute['ins_email'] ?></span>
              <span class="ins-address col-md-12"><?php echo $info_institute['ins_address'] ?></span>
              <span class="ins-website col-md-12"><?php echo $info_institute['ins_website'] ?></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-11">
            <div class="row" style="margin-top: 20px; margin-bottom: 20px">
              <div class="form-group col-md-6">
                <div class="form-group adm-data" style="text-align: left;">
                  <div class="row">
                    <span class="roll-no col-md-4">Admission Application No</span>
                    <span class="roll-no col-md-1">:</span>
                    <span class="roll-no col-md-7"><?php echo $info_student['std_aplno'] ?></span>
                  </div>
                  <div class="row">
                    <span class="roll-no col-md-4">Admission Application Date</span>
                    <span class="roll-no col-md-1">:</span>
                    <span class="roll-no col-md-7"><?php echo $info_registration['s_apldate'] ?></span>
                  </div>
                  <div class="row">
                    <span class="roll-no col-md-4">Institue Enrollment No</span>
                    <span class="roll-no col-md-1">:</span>
                    <span class="roll-no col-md-7"><?php echo $info_student['std_rollno'] ?></span>
                  </div>
                  <div class="row">
                    <span class="roll-no col-md-4">Date of Admission</span>
                    <span class="roll-no col-md-1">:</span>
                    <span class="roll-no col-md-7"><?php echo $info_student['std_admdate'] ?></span>
                  </div>
                </div>
              </div>
              <div class="form-group col-md-6">
                <div class="form-group adm-data" style="text-align: left;">
                  <div class="row">
                    <span class="roll-no col-md-4">Registered Phone No</span>
                    <span class="roll-no col-md-1">:</span>
                    <span class="roll-no col-md-7"><?php echo $info_registration['s_phone'] ?></span>
                  </div>
                  <div class="row">
                    <span class="roll-no col-md-4">Registered Email ID</span>
                    <span class="roll-no col-md-1">:</span>
                    <span class="roll-no col-md-7"><?php echo $info_registration['s_email'] ?></span>
                  </div>
                  <div class="row">
                    <span class="roll-no col-md-4">Preferred Stream</span>
                    <span class="roll-no col-md-1">:</span>
                    <span class="roll-no col-md-7"><?php echo $info_registration['s_stream'] ?></span>
                  </div>
                  <div class="row">
                    <span class="roll-no col-md-4">Preferred Course</span>
                    <span class="roll-no col-md-1">:</span>
                    <span class="roll-no col-md-7"><?php echo $info_registration['s_course'] ?></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12" style="text-align: center; font-size: 24px; cursor:pointer">
            <button type="button" class="btn btn-primary" onclick="viewStudentCard('<?php echo $info_student['std_id'] ?>')">View Details</button>
          </div>
        </div>        
      </div>
    </div>
  </div>
</main>
<?php }else{ ?>
  <main class="l-main">
  <div class="content-wrapper content-wrapper--with-bg">
    <h2 class="page-title">My Institute</h2>
    <div class="page-content">
      <div class="form-row">
        <div class="form-group col-md-12">
          <div class="form-group" style="text-align: center;">
            <img src="assets/images/my-institute-fail.svg" height="300px" width="300px">
          </div>
          <div class="my-institute-fail form-group col-md-12">
            <span>Opsssss..! Seems like you have'nt confirmed your admission yet</span>
          </div>
          <div class="confirm-admission" style="text-align: center; margin-top:70px">
            <button type="button" class="btn btn-warning" onclick="window.location.href='index.php'">Confirm Admission</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php } ?>

<div class="footer">&copy; 2022 | <strong>eAdmission System</strong> | All Rights are Reserved</div>
</html>

<script src="js/my-institute.js"></script>
<script src="global-assets/js/confirmation.js"></script>
