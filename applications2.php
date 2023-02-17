<?php
    require("connection.php");
    require("header.php");
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
            window.location.href="logout-institute.php";
        </script>
        <?php
    }

    $ins_name = $info_institute['ins_name'];
    $sql_applications = "SELECT * FROM registration_details WHERE `s_institute1` = '$ins_name' OR `s_institute2` = '$ins_name' OR `s_institute3` = '$ins_name'";
    $result_applications = mysqli_query($connect, $sql_applications);
    $num_applications = mysqli_num_rows($result_applications);
    $info_applications = mysqli_fetch_all($result_applications, MYSQLI_ASSOC);
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
    <link rel="stylesheet" href="css/applications.css">
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
            <li class="c-menu__item" data-toggle="tooltip" title="Dashboard">
              <div class="c-menu__item__inner"><i class="fa fa-th-large"></i>
                <div class="c-menu-item__title"><span>Dashboard</span></div>
              </div>
            </li>
          </a>
          <a href="applications.php" style="text-decoration:none">
            <li class="c-menu__item is-active" data-toggle="tooltip" title="Applications">
              <div class="c-menu__item__inner"><i class="fa fa-file-pdf"></i>
                <div class="c-menu-item__title"><span>Applications</span></div>
              </div>
            </li>
          </a>
          <a href="students.php" style="text-decoration:none">
            <li class="c-menu__item" data-toggle="tooltip" title="Students">
              <div class="c-menu__item__inner"><i class="fa fa-graduation-cap"></i>
                <div class="c-menu-item__title"><span>Students</span></div>
              </div>
            </li>
          </a>
          <a href="institute-profile.php" style="text-decoration:none">
            <li class="c-menu__item" data-toggle="tooltip" title="Institute Profile">
              <div class="c-menu__item__inner"><i class="fa fa-university"></i>
                <div class="c-menu-item__title"><span>Institute Profile</span></div>
              </div>
            </li>
          </a>
          <a href="change-password-institute.php" style="text-decoration:none">
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
    <h2 class="page-title">Applications Database</h2>
    <div class="page-content">
      <div class="table-responsive">
        <table id="myTable" class="display table" width="100%">
          <thead>
            <tr>
              <th style="text-align:center">#</th>
              <th style="text-align:center">Application No</th>
              <th style="text-align:center">Application Date</th>
              <th style="text-align:center">Applicant's Name</th>
              <th style="text-align:center">Course</th>
              <th style="text-align:center">Stream</th>
              <th style="text-align:center">Progress</th>
              <th style="text-align:center">Approval</th>
              <th style="text-align:center">View</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($info_applications as $applications) {
                $progress = "";
                if($applications['s_status']==1){
                    $progress = "Applicant Registered";
                } elseif($applications['s_status']==2){
                    $progress = "Registration Details Submitted";        
                } elseif($applications['s_status']==3){
                    $progress = "Residential Details Submitted";        
                } elseif($applications['s_status']==4){
                    $progress = "Personal Details Submitted";        
                } elseif($applications['s_status']==5){
                    $progress = "Family Details Submitted";        
                } elseif($applications['s_status']==6){
                    $progress = "Bank Details Submitted";        
                } elseif($applications['s_status']==7){
                    $progress = "Additional Details Submitted";        
                } elseif($applications['s_status']==8){
                    $progress = "Academic Details Submitted";        
                } elseif($applications['s_status']==9){
                    $progress = "Course Details Submitted";        
                } elseif($applications['s_status']>=10){
                    $progress = "Application Submission Completed";        
                }

                if($applications['s_institute1']=="$ins_name"){
                  $s_aplno = $applications['s_aplno1'];
                  $s_status = $applications['s_aplstatus1'];
                  $sl = 1;
                }
                elseif($applications['s_institute2']=="$ins_name"){
                  $s_aplno = $applications['s_aplno2'];
                  $s_status = $applications['s_aplstatus2'];
                  $sl = 2;
                }
                elseif($applications['s_institute3']=="$ins_name"){
                  $s_aplno = $applications['s_aplno3'];
                  $s_status = $applications['s_aplstatus3'];
                  $sl = 3;
                }

                $status = $applications['s_status'];

              ?>
              <tr>
                <td><?php echo $count++ ?></td>
                <?php if($applications['s_institute1']=="$ins_name"){ ?>
                  <td><?php echo $s_aplno ?></td>
                <?php } ?>
                <?php if($applications['s_institute2']=="$ins_name"){ ?>
                  <td><?php echo $s_aplno ?></td>
                <?php } ?>
                <?php if($applications['s_institute3']=="$ins_name"){ ?>
                  <td><?php echo $s_aplno ?></td>
                <?php } ?>

                <td><?php echo $applications['s_apldate'] ?></td>
                <td><?php echo $applications['s_name'] ?></td>
                <td><?php echo $applications['s_course'] ?></td>
                <td><?php echo $applications['s_stream'] ?></td>
                <td><?php echo $progress ?></th>
                
                <?php if($s_status==0){ ?>
                  <td>
                    <i class="fa fa-exclamation-circle" id="pending-icon" style="font-size: 24px;" data-toggle="modal" data-target="#approveApplication1"></i>
                    <div class="modal fade" id="approveApplication1" tabindex="-1" role="dialog" aria-labelledby="approveApplicationLabel1" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <!-- <h5 class="modal-title" id="approveApplicationLabel1">Modal title</h5> -->
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Are you sure want to approval or reject application?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" onclick="approveApplication('<?php echo $sl ?>','<?php echo $applications['s_id'] ?>',<?php echo 2 ?>)">Reject</button>
                            <button type="button" class="btn btn-success" onclick="approveApplication('<?php echo $sl ?>','<?php echo $applications['s_id'] ?>','<?php echo 1 ?>')">Approve</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                <?php }elseif($s_status==1){ ?>
                  <td>
                    <i class="fa fa-check" id="verified-icon" style="font-size: 24px;" data-toggle="modal" data-target="#approveApplication2"></i>
                    <div class="modal fade" id="approveApplication2" tabindex="-1" role="dialog" aria-labelledby="approveApplicationLabel2" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <!-- <h5 class="modal-title" id="approveApplicationLabel1">Modal title</h5> -->
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Are you sure want to reject application?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" onclick="approveApplication('<?php echo $sl ?>','<?php echo $applications['s_id'] ?>',<?php echo 2 ?>)">Reject</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>  
                <?php }elseif($s_status==2){ ?>
                  <td>
                    <i class="fa fa-times" id="rejected-icon" style="font-size: 24px;" data-toggle="modal" data-target="#approveApplication3"></i>
                    <div class="modal fade" id="approveApplication3" tabindex="-1" role="dialog" aria-labelledby="approveApplicationLabel3" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <!-- <h5 class="modal-title" id="approveApplicationLabel1">Modal title</h5> -->
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Are you sure want to approve application?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-success" onclick="approveApplication('<?php echo $sl ?>','<?php echo $applications['s_id'] ?>','<?php echo 1 ?>')">Approve</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                <?php }elseif($s_status==3){ ?>
                  <td><i class="fa fa-graduation-cap" id="rejected-icon" style="font-size: 24px;" onclick="approveApplication('<?php echo $sl ?>','<?php echo $applications['s_id'] ?>')"></i></td>
                <?php } ?>

                <td><i class="fa fa-print" id="print-icon" style="font-size: 24px;" onclick="viewApplication('<?php echo $applications['s_id'] ?>','<?php echo $s_aplno ?>','<?php echo $sl ?>')"></i></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <div style="text-align: center;">
      <button type="button" class="btn btn-primary" onclick="viewApplicationsDatabase('<?php echo $ins_id ?>')"><i class="fa fa-print" style="font-size: 14px;"></i>&nbsp; Print Database</button>
    </div>
  </div>
</main>
<div class="footer">&copy; 2022 | <strong>eAdmission System</strong> | All Rights are Reserved</div>
</html>

<script src="js/applications.js"></script>
<script src="global-assets/js/confirmation.js"></script>
