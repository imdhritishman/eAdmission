<?php
    require("connection.php");
    require("header.php");
    $page_title = "Home";

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

    $sql_aplno = "SELECT `s_aplno1`,`s_aplno2`,`s_aplno3` FROM `registration_details` WHERE `s_id`=$s_id";
    $result_aplno = mysqli_query($connect, $sql_aplno);
    $num_aplno = mysqli_num_fields($result_aplno);
    $info_aplno = mysqli_fetch_assoc($result_aplno);

    $sql_inscode1 = "SELECT LEFT('$info_aplno[s_aplno1]', 4) FROM registration_details WHERE `s_id`='$s_id'";
    $result_inscode1 = mysqli_query($connect, $sql_inscode1);
    $num_inscode1 = mysqli_num_rows($result_inscode1);
    $info_inscode1 = mysqli_fetch_assoc($result_inscode1);

    $sql_inscode2 = "SELECT LEFT('$info_aplno[s_aplno2]', 4) FROM registration_details WHERE `s_id`='$s_id'";
    $result_inscode2 = mysqli_query($connect, $sql_inscode2);
    $num_inscode2 = mysqli_num_rows($result_inscode2);
    $info_inscode2 = mysqli_fetch_assoc($result_inscode2);


    $sql_inscode3 = "SELECT LEFT('$info_aplno[s_aplno3]', 4) FROM registration_details WHERE `s_id`='$s_id'";
    $result_inscode3 = mysqli_query($connect, $sql_inscode3);
    $num_inscode3 = mysqli_num_rows($result_inscode3);
    $info_inscode3 = mysqli_fetch_assoc($result_inscode3);

    $ins_code1 = implode($info_inscode1);
    $sql_institute1 = "SELECT * FROM institute WHERE `ins_code` = '$ins_code1'";
    $result_institute1 = mysqli_query($connect, $sql_institute1);
    $num_institute1 = mysqli_num_rows($result_institute1);
    $info_institute1 = mysqli_fetch_assoc($result_institute1);

    $ins_code2 = implode($info_inscode2);
    $sql_institute2 = "SELECT * FROM institute WHERE `ins_code` = '$ins_code2'";
    $result_institute2 = mysqli_query($connect, $sql_institute2);
    $num_institute2 = mysqli_num_rows($result_institute2);
    $info_institute2 = mysqli_fetch_assoc($result_institute2);

    $ins_code3 = implode($info_inscode3);
    $sql_institute3 = "SELECT * FROM institute WHERE `ins_code` = '$ins_code3'";
    $result_institute3 = mysqli_query($connect, $sql_institute3);
    $num_institute3 = mysqli_num_rows($result_institute3);
    $info_institute3 = mysqli_fetch_assoc($result_institute3);

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
    <link rel="stylesheet" href="css/index.css">
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
            <li class="c-menu__item is-active" data-toggle="tooltip" title="Dashboard">
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
<main class="l-main">
  <div class="content-wrapper content-wrapper--with-bg">
    <h2 class="page-title">Student Dashboard</h2>
      <div class="page-content" id="card1" style="text-align: center;">
        <div class="col-md-12" style="padding: 0; margin:0; font-weight: 600; text-align: left">
          <div class="row" style="margin-bottom: 40px; padding:0; margin-right:0; border-right:0;">
              <div class="col-md-6" style="text-align: left;">
                Application - 1
              </div>
              <div class="col-md-6" style="text-align: right;">
                <a href="" onclick="viewApplication('<?php echo $s_id ?>','<?php echo $info_registration['s_aplno1']?>',<?php echo 1 ?>)" style="text-decoration: none; color: navy;">
                  <i class="fa fa-print" style="font-size: 30px;"></i>
                </a>
              </div>
          </div>
          <div class="row" style="margin-bottom: 10px; padding:0; padding-left: 20px; padding-right: 20px; margin-right:0; border-right:0;">
            <div class="col-md-3">
              Applicant's Name
            </div>
            <div class="col-md-3">
              Application Number
            </div>
            <div class="col-md-2">
              Applicantion Date
            </div>
            <div class="col-md-2">
              Regestered Phone No
            </div>
            <div class="col-md-2">
              Regestered Email ID
            </div>
          </div>
          <div class="row" style="margin-bottom: 40px; padding:0; padding-left: 20px; padding-right: 20px; margin-right:0; border-right:0;">
            <div class="col-md-3">
              <?php echo $info_registration['s_name'] ?>
            </div>
            <div class="col-md-3">
              <?php echo $info_registration['s_aplno1'] ?>
            </div>
            <div class="col-md-2">
              <?php echo $info_registration['s_apldate'] ?>
            </div>
            <div class="col-md-2">
              <?php echo $info_registration['s_phone'] ?>
            </div>
            <div class="col-md-2">
              <?php echo $info_registration['s_email'] ?>
            </div>
          </div>
          <div class="row" style="margin-bottom: 10px; padding:0; padding-left: 20px; padding-right: 20px; margin-right:0; margin-right:0; border-right:0;">
            <div class="col-md-3">
              Institution Name
            </div>
            <div class="col-md-3">
              Institution Address
            </div>
            <div class="col-md-2">
              Course Applied For
            </div>
            <div class="col-md-2">
              Stream Applied For
            </div>
            <div class="col-md-2">
              Application Status
            </div>
          </div>
          <div class="row" style="margin-bottom: 50px; padding:0; padding-left: 20px; padding-right: 20px; margin-right:0; margin-right:0; border-right:0;">
            <div class="col-md-3">
              <?php echo $info_registration['s_institute1'] ?>
            </div>
            <div class="col-md-3">
              <?php echo $info_institute1['ins_address'] ?>
            </div>
            <div class="col-md-2">
              <?php echo $info_registration['s_course'] ?>
            </div>
            <div class="col-md-2">
              <?php echo $info_registration['s_stream'] ?>
            </div>
            <div class="col-md-2">
              <?php if($info_registration['s_aplstatus1']==0) { ?>
                <span style="color: Orange;">Pending Verification</span>
              <?php } elseif($info_registration['s_aplstatus1']==1) { ?>
                <span style="color: Green;">Verified</span>
              <?php } elseif($info_registration['s_aplstatus1']==2) { ?>
                <span style="color: Red;">Rejected</span>
              <?php }elseif($info_registration['s_aplstatus1']==3) { ?>
                <span style="color: Green;">Admission Confirmed</span>
              <?php } ?>
            </div>
          </div>
          <div class="row" style="margin-bottom: 20px; padding:0; margin-right:0; border-right:0;">
              <div class="col-md-12" style="text-align: center;">
                  <?php if(($info_registration['s_aplstatus1']==1) && (($info_registration['s_aplstatus2']!=3) && ($info_registration['s_aplstatus3']!=3))){ ?>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#confirmAdmission1">CONFIRM ADMISSION</button>
                  <?php }else{ ?>
                    <button type="button" class="btn btn-success" disabled>CONFIRM ADMISSION</button>
                  <?php } ?>
              </div>
          </div>
          <div class="modal fade" id="confirmAdmission1" tabindex="-1" role="dialog" aria-labelledby="confirmAdmissionLabel1" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <!-- <h5 class="modal-title" id="confirmAdmissionLabel1"></h5> -->
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Confirm admission for the following details: <br>
                  <div class="modal-body-inside" style="padding-top: 10px; font-weight:normal">
                    <div class="row">
                      <div class="col-md-3">Institute Name</div>
                      <div class="col-md-1">:</div>
                      <div class="col-md-8"><?php echo $info_registration['s_institute1'] ?></div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">Stream Applied</div>
                      <div class="col-md-1">:</div>
                      <div class="col-md-8"><?php echo $info_registration['s_stream'] ?></div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">Course Applied</div>
                      <div class="col-md-1">:</div>
                      <div class="col-md-8"><?php echo $info_registration['s_course'] ?></div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">Application No</div>
                      <div class="col-md-1">:</div>
                      <div class="col-md-8"><?php echo $info_registration['s_aplno1'] ?></div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-success" onclick="confirmAdmission('<?php echo $s_id ?>','<?php echo 1 ?>')">Confirm</button>
                </div>
              </div>
            </div>
          </div>          
          <!-- <div class="row" style="margin-bottom: 0px; padding:0; margin-right:0; border-right:0;">
              <div class="col-md-5"></div>
              <div class="col-md-1">
                <a href="" onclick="window.open('application-form.php', 'newwindow', 'width=1000,height=300'); return false;" style="text-decoration: none; color: brown;">
                  <i class="fa fa-file-pdf" style="font-size: 30px;"></i>
                </a>
              </div>
              <div class="col-md-1">
                <a href="" onclick="window.open('application-form.php', 'newwindow', 'width=1000,height=300'); return false;" style="text-decoration: none; color: navy;">
                  <i class="fa fa-print" style="font-size: 30px;"></i>
                </a>
              </div>
              <div class="col-md-5"></div>
          </div> -->
        </div>
      </div>
      <div class="page-content card2" style="text-align: center;">
        <div class="col-md-12" style="padding: 0; margin:0; font-weight: 600; text-align: left">
          <div class="row" style="margin-bottom: 40px; padding:0; margin-right:0; border-right:0;">
              <div class="col-md-6" style="text-align: left;">
                Application - 2
              </div>
              <div class="col-md-6" style="text-align: right;">
                <a href="" onclick="viewApplication('<?php echo $s_id ?>','<?php echo $info_registration['s_aplno2']?>',<?php echo 2 ?>)" style="text-decoration: none; color: navy;">
                  <i class="fa fa-print" style="font-size: 30px;"></i>
                </a>
              </div>
          </div>
          <div class="row" style="margin-bottom: 10px; padding:0; padding-left: 20px; padding-right: 20px; margin-right:0; border-right:0;">
            <div class="col-md-3">
              Applicant's Name
            </div>
            <div class="col-md-3">
              Application Number
            </div>
            <div class="col-md-2">
              Applicantion Date
            </div>
            <div class="col-md-2">
              Regestered Phone No
            </div>
            <div class="col-md-2">
              Regestered Email ID
            </div>
          </div>
          <div class="row" style="margin-bottom: 40px; padding:0; padding-left: 20px; padding-right: 20px; margin-right:0; border-right:0;">
            <div class="col-md-3">
              <?php echo $info_registration['s_name'] ?>
            </div>
            <div class="col-md-3">
              <?php echo $info_registration['s_aplno2'] ?>
            </div>
            <div class="col-md-2">
              <?php echo $info_registration['s_apldate'] ?>
            </div>
            <div class="col-md-2">
              <?php echo $info_registration['s_phone'] ?>
            </div>
            <div class="col-md-2">
              <?php echo $info_registration['s_email'] ?>
            </div>
          </div>
          <div class="row" style="margin-bottom: 10px; padding:0; padding-left: 20px; padding-right: 20px; margin-right:0; border-right:0;">
            <div class="col-md-3">
              Institution Name
            </div>
            <div class="col-md-3">
              Institution Address
            </div>
            <div class="col-md-2">
              Course Applied For
            </div>
            <div class="col-md-2">
              Stream Applied For
            </div>
            <div class="col-md-2">
              Application Status
            </div>
          </div>
          <div class="row" style="margin-bottom: 50px; padding:0; padding-left: 20px; padding-right: 20px; margin-right:0; border-right:0;">
            <div class="col-md-3">
              <?php echo $info_registration['s_institute2'] ?>
            </div>
            <div class="col-md-3">
              <?php echo $info_institute2['ins_address'] ?>
            </div>
            <div class="col-md-2">
              <?php echo $info_registration['s_course'] ?>
            </div>
            <div class="col-md-2">
              <?php echo $info_registration['s_stream'] ?>
            </div>
            <div class="col-md-2">
              <?php if($info_registration['s_aplstatus2']==0) { ?>
                <span style="color: Orange;">Pending Verification</span>
              <?php } elseif($info_registration['s_aplstatus2']==1) { ?>
                <span style="color: Green;">Verified</span>
                <?php } elseif($info_registration['s_aplstatus2']==2) { ?>
                <span style="color: Red;">Rejected</span>
              <?php }elseif($info_registration['s_aplstatus2']==3) { ?>
                <span style="color: Green;">Admission Confirmed</span>
              <?php } ?>
            </div>
          </div>
          <div class="row" style="margin-bottom: 20px; padding:0; margin-right:0; border-right:0;">
              <div class="col-md-12" style="text-align: center;">
                  <?php if(($info_registration['s_aplstatus2']==1) && (($info_registration['s_aplstatus1']!=3) && ($info_registration['s_aplstatus3']!=3))){ ?>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#confirmAdmission2">CONFIRM ADMISSION</button>
                  <?php }else{ ?>
                    <button type="button" class="btn btn-success" disabled>CONFIRM ADMISSION</button>
                  <?php } ?>
              </div>
          </div>
          <div class="modal fade" id="confirmAdmission2" tabindex="-1" role="dialog" aria-labelledby="confirmAdmissionLabel2" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <!-- <h5 class="modal-title" id="confirmAdmissionLabel1"></h5> -->
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Confirm admission for the following details: <br>
                  <div class="modal-body-inside" style="padding-top: 10px; font-weight:normal">
                    <div class="row">
                      <div class="col-md-3">Institute Name</div>
                      <div class="col-md-1">:</div>
                      <div class="col-md-8"><?php echo $info_registration['s_institute2'] ?></div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">Stream Applied</div>
                      <div class="col-md-1">:</div>
                      <div class="col-md-8"><?php echo $info_registration['s_stream'] ?></div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">Course Applied</div>
                      <div class="col-md-1">:</div>
                      <div class="col-md-8"><?php echo $info_registration['s_course'] ?></div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">Application No</div>
                      <div class="col-md-1">:</div>
                      <div class="col-md-8"><?php echo $info_registration['s_aplno2'] ?></div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-success" onclick="confirmAdmission('<?php echo $s_id ?>','<?php echo 2 ?>')">Confirm</button>
                </div>
              </div>
            </div>
          </div>                    
          <!-- <div class="row" style="margin-bottom: 0px; padding:0; margin-right:0; border-right:0;">
              <div class="col-md-5"></div>
              <div class="col-md-1">
                <a href="" onclick="window.open('application-form.php', 'newwindow', 'width=1000,height=300'); return false;" style="text-decoration: none; color: brown;">
                  <i class="fa fa-file-pdf" style="font-size: 30px;"></i>
                </a>
              </div>
              <div class="col-md-1">
                <a href="" onclick="window.open('application-form.php', 'newwindow', 'width=1000,height=300'); return false;" style="text-decoration: none; color: navy;">
                  <i class="fa fa-print" style="font-size: 30px;"></i>
                </a>
              </div>
              <div class="col-md-5"></div>
          </div> -->
        </div>
      </div>
      <div class="page-content card3" style="text-align: center;">
        <div class="col-md-12" style="padding: 0; margin:0; font-weight: 600; text-align: left">
          <div class="row" style="margin-bottom: 40px; padding:0; margin-right:0; border-right:0;">
              <div class="col-md-6" style="text-align: left;">
                Application - 3
              </div>
              <div class="col-md-6" style="text-align: right;">
                <a href="" onclick="viewApplication('<?php echo $s_id ?>','<?php echo $info_registration['s_aplno3']?>',<?php echo 3 ?>)" style="text-decoration: none; color: navy;">
                  <i class="fa fa-print" style="font-size: 30px;"></i>
                </a>
              </div>
          </div>
          <div class="row" style="margin-bottom: 10px; padding:0; padding-left: 20px; padding-right: 20px; margin-right:0; border-right:0;">
            <div class="col-md-3">
              Applicant's Name
            </div>
            <div class="col-md-3">
              Application Number
            </div>
            <div class="col-md-2">
              Applicantion Date
            </div>
            <div class="col-md-2">
              Regestered Phone No
            </div>
            <div class="col-md-2">
              Regestered Email ID
            </div>
          </div>
          <div class="row" style="margin-bottom: 40px; padding:0; padding-left: 20px; padding-right: 20px; margin-right:0; border-right:0;">
            <div class="col-md-3">
              <?php echo $info_registration['s_name'] ?>
            </div>
            <div class="col-md-3">
              <?php echo $info_registration['s_aplno3'] ?>
            </div>
            <div class="col-md-2">
              <?php echo $info_registration['s_apldate'] ?>
            </div>
            <div class="col-md-2">
              <?php echo $info_registration['s_phone'] ?>
            </div>
            <div class="col-md-2">
              <?php echo $info_registration['s_email'] ?>
            </div>
          </div>
          <div class="row" style="margin-bottom: 10px; padding:0; padding-left: 20px; padding-right: 20px; margin-right:0; border-right:0;">
            <div class="col-md-3">
              Institution Name
            </div>
            <div class="col-md-3">
              Institution Address
            </div>
            <div class="col-md-2">
              Course Applied For
            </div>
            <div class="col-md-2">
              Stream Applied For
            </div>
            <div class="col-md-2">
              Application Status
            </div>
          </div>
          <div class="row" style="margin-bottom: 50px; padding:0; padding-left: 20px; padding-right: 20px; margin-right:0; border-right:0;">
            <div class="col-md-3">
              <?php echo $info_registration['s_institute3'] ?>
            </div>
            <div class="col-md-3">
              <?php echo $info_institute3['ins_address'] ?>
            </div>
            <div class="col-md-2">
              <?php echo $info_registration['s_course'] ?>
            </div>
            <div class="col-md-2">
              <?php echo $info_registration['s_stream'] ?>
            </div>
            <div class="col-md-2">
              <?php if($info_registration['s_aplstatus3']==0) { ?>
                <span style="color: Orange;">Pending Verification</span>
              <?php } elseif($info_registration['s_aplstatus3']==1) { ?>
                <span style="color: Green;">Verified</span>
                <?php } elseif($info_registration['s_aplstatus3']==2) { ?>
                <span style="color: Red;">Rejected</span>
              <?php }elseif($info_registration['s_aplstatus3']==3) { ?>
                <span style="color: Green;">Admission Confirmed</span>
              <?php } ?>
            </div>
          </div>
          <div class="row" style="margin-bottom: 20px; padding:0; margin-right:0; border-right:0;">
              <div class="col-md-12" style="text-align: center;">
                  <?php if(($info_registration['s_aplstatus3']==1) && (($info_registration['s_aplstatus1']!=3) && ($info_registration['s_aplstatus2']!=3))){ ?>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#confirmAdmission3">CONFIRM ADMISSION</button>
                  <?php }else{ ?>
                    <button type="button" class="btn btn-success" disabled>CONFIRM ADMISSION</button>
                  <?php } ?>
              </div>
          </div>
          <div class="modal fade" id="confirmAdmission3" tabindex="-1" role="dialog" aria-labelledby="confirmAdmissionLabel3" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <!-- <h5 class="modal-title" id="confirmAdmissionLabel1"></h5> -->
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Confirm admission for the following details: <br>
                  <div class="modal-body-inside" style="padding-top: 10px; font-weight:normal">
                    <div class="row">
                      <div class="col-md-3">Institute Name</div>
                      <div class="col-md-1">:</div>
                      <div class="col-md-8"><?php echo $info_registration['s_institute3'] ?></div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">Stream Applied</div>
                      <div class="col-md-1">:</div>
                      <div class="col-md-8"><?php echo $info_registration['s_stream'] ?></div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">Course Applied</div>
                      <div class="col-md-1">:</div>
                      <div class="col-md-8"><?php echo $info_registration['s_course'] ?></div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">Application No</div>
                      <div class="col-md-1">:</div>
                      <div class="col-md-8"><?php echo $info_registration['s_aplno3'] ?></div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-success" onclick="confirmAdmission('<?php echo $s_id ?>','<?php echo 3 ?>')">Confirm</button>
                </div>
              </div>
            </div>
          </div>                    
          <!-- <div class="row" style="margin-bottom: 0px; padding:0; margin-right:0; border-right:0;">
              <div class="col-md-5"></div>
              <div class="col-md-1">
                <a href="" onclick="window.open('application-form.php', 'newwindow', 'width=1000,height=300'); return false;" style="text-decoration: none; color: brown;">
                  <i class="fa fa-file-pdf" style="font-size: 30px;"></i>
                </a>
              </div>
              <div class="col-md-1">
                <a href="" onclick="window.open('application-form.php', 'newwindow', 'width=1000,height=300'); return false;" style="text-decoration: none; color: navy;">
                  <i class="fa fa-print" style="font-size: 30px;"></i>
                </a>
              </div>
              <div class="col-md-5"></div>
          </div> -->
        </div>
      </div>
  </div>
</main>
<div class="footer">&copy; 2022 | <strong>eAdmission System</strong> | All Rights are Reserved</div>
</html>

<script src="js/index.js"></script>
<script src="global-assets/js/confirmation.js"></script>
