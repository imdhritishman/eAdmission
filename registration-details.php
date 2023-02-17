<?php
    require("connection.php");
    require("header.php");
    $page_title = "Registration";
    $success = "";

    if(isset($_SESSION['s_id'])){
        $s_id = $_SESSION['s_id'];
    }
    else{
        ?>
        <script>
            window.location.href="logout.php";
        </script>
        <?php
    }

    $sql_registration = "SELECT * FROM registration_details WHERE `s_id` = '$s_id'";
    $result_registration = mysqli_query($connect, $sql_registration);
    $num_registration = mysqli_num_rows($result_registration);
    $info_registration = mysqli_fetch_assoc($result_registration);
    $s_name = $info_registration['s_name'];

    $sql_institute = "SELECT * FROM institute";
    $result_institute = mysqli_query($connect, $sql_institute);
    $num_institute = mysqli_num_rows($result_institute);
    $info_institute = mysqli_fetch_all($result_institute, MYSQLI_ASSOC);

    $sql_active_institute = "SELECT * FROM institute WHERE `ins_status`=1";
    $result_active_institute = mysqli_query($connect, $sql_active_institute);
    $num_active_institute = mysqli_num_rows($result_active_institute);
    $info_active_institute = mysqli_fetch_all($result_active_institute, MYSQLI_ASSOC);

    $sql_stream = "SELECT * FROM stream";
    $result_stream = mysqli_query($connect, $sql_stream);
    $num_stream = mysqli_num_rows($result_stream);
    $info_stream = mysqli_fetch_all($result_stream, MYSQLI_ASSOC);

    $sql_course = "SELECT * FROM course";
    $result_course = mysqli_query($connect, $sql_course);
    $num_course = mysqli_num_rows($result_course);
    $info_course = mysqli_fetch_all($result_course, MYSQLI_ASSOC);

    $sql_residential = "SELECT * FROM residential_details";
    $result_residential = mysqli_query($connect, $sql_residential);
    $num_residential = mysqli_num_rows($result_residential);
    $info_residential = mysqli_fetch_all($result_residential, MYSQLI_ASSOC);

    if($info_registration['s_institute1']=="" && $info_registration['s_status']=='1') {
      if(isset($_POST['s_institute1'])){
        $s_institute1 = $_POST['s_institute1'];
        $s_institute2 = $_POST['s_institute2'];
        $s_institute3 = $_POST['s_institute3'];
        $s_stream = $_POST['s_stream'];
        $s_course = $_POST['s_course'];

        if(($_POST['s_institute1'] !== $_POST['s_institute2']) && ($_POST['s_institute2'] !== $_POST['s_institute3']) && ($_POST['s_institute1'] !== $_POST['s_institute3'])){
          $sql_registration_update = "UPDATE `registration_details` SET `s_institute1`='$s_institute1',`s_institute2`='$s_institute2',`s_institute3`='$s_institute3',`s_stream`='$s_stream',`s_course`='$s_course',`s_status`='2' WHERE `s_id`='$s_id'";
          $result_registration_update = mysqli_query($connect, $sql_registration_update);

          if($result_registration_update){ 
            ?>
              <script>
                alert("Registration Details Inserted Successfully!");
                window.location.href="residential-details.php";
              </script>
            <?php
          }
        }       
        else{
          ?>
            <script>
              alert("Duplicate Preferred Institute Inserted!");
              window.location.href="registration-details.php";
            </script>
          <?php
        }
  
      }
    }
    else {
      if(isset($_POST['submit_registration_details'])){
        ?>
          <script>
            alert("Registration Details Already Exist!");
            window.location.href="registration-details.php";
          </script>
        <?php
      }
      if(isset($_POST['next_registration_details'])){
        ?>
          <script>
            window.location.href="residential-details.php";
          </script>
        <?php
      }
    }

    if(isset($_POST['prev_registration_details'])){
      ?>
        <script>
          window.location.href="registration-details.php";
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
    <link rel="stylesheet" href="css/registration-details.css">
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
          <a href="registration-details.php" style="text-decoration:none">
            <li class="c-menu__item is-active" data-toggle="tooltip" title="Registration Details">
              <div class="c-menu__item__inner"><i class="fa fa-info"></i>
                <div class="c-menu-item__title"><span>Registration Details</span></div>
              </div>
            </li>
          </a>
          <a href="residential-details.php" style="text-decoration:none">
            <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Residential Details">
              <div class="c-menu__item__inner"><i class="fa fa-home"></i>
                <div class="c-menu-item__title"><span>Residential Details</span></div>
              </div>
            </li>
          </a>
          <a href="personal-details.php" style="text-decoration:none">
            <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Personal Details">
              <div class="c-menu__item__inner"><i class="fa fa-user"></i>
                <div class="c-menu-item__title"><span>Personal Details</span></div>
              </div>
            </li>
          </a>
          <a href="family-details.php" style="text-decoration:none">
            <li class="c-menu__item" data-toggle="tooltip" title="Family Details">
              <div class="c-menu__item__inner"><i class="fa fa-users"></i>
                <div class="c-menu-item__title"><span>Family Details</span></div>
              </div>
            </li>
          </a>
          <a href="bank-details.php" style="text-decoration:none">
            <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Bank Details">
                <div class="c-menu__item__inner"><i class="fa fa-university"></i>
                <div class="c-menu-item__title"><span>Bank Details</span></div>
                </div>
            </li>
          </a>
          <a href="additional-details.php" style="text-decoration:none">
            <li class="c-menu__item" data-toggle="tooltip" title="Additional Details">
              <div class="c-menu__item__inner"><i class="fa fa-question"></i>
                <div class="c-menu-item__title"><span>Additional Details</span></div>
              </div>
            </li>
          </a>
          <a href="academic-details.php" style="text-decoration:none">
            <li class="c-menu__item" data-toggle="tooltip" title="Academic Details">
              <div class="c-menu__item__inner"><i class="fa fa-graduation-cap"></i>
                <div class="c-menu-item__title"><span>Academic Details</span></div>
              </div>
            </li>
          </a>
          <a href="course-details.php" style="text-decoration:none">
            <li class="c-menu__item" data-toggle="tooltip" title="Course Details">
              <div class="c-menu__item__inner"><i class="fa fa-book"></i>
                <div class="c-menu-item__title"><span>Course Details</span></div>
              </div>
            </li>
          </a>
          <a href="upload-documents.php" style="text-decoration:none">
            <li class="c-menu__item" data-toggle="tooltip" title="Upload Documents">
              <div class="c-menu__item__inner"><i class="fa fa-upload"></i>
                <div class="c-menu-item__title"><span>Upload Documents</span></div>
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
    <h2 class="page-title">Registration Details</h2>
    <?php if ($success == 1) { ?>
      <div class="alert alert-success alert-dismissible" role="alert">
        Registration Details submitted successfully!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php } elseif ($success == 2) { ?>
      <div class="alert alert-danger alert-dismissible" role="alert">
        Registration Details already submitted!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php } ?>
    <div class="page-content">
      <form action="registration-details.php" method="post" autocomplete="off">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="InputName">Full Name<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_registration['s_name']=="") { ?>
              <input class="form-control" type="text" name="s_name" required>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_name" value="<?php echo $info_registration['s_name'] ?>" readonly>
            <?php } ?>
            <small id="nameHelpInline" class="text-muted">
              Enter the full name of student.
            </small>
          </div>
          <div class="form-group col-md-4">
            <label for="InputEmail">Email ID<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_registration['s_email']=="") { ?>
              <input class="form-control" type="text" name="s_email" required>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_email" value="<?php echo $info_registration['s_email'] ?>" readonly>
            <?php } ?>
            <small id="emailHelpInline" class="text-muted">
              Enter the email id of student.
            </small>
          </div>
          <div class="form-group col-md-4">
            <label for="InputPhone">Phone<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_registration['s_phone']=="") { ?>
              <input class="form-control" type="text" name="s_phone" required>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_phone" value="<?php echo $info_registration['s_phone'] ?>" readonly>
            <?php } ?>
            <small id="phoneHelpInline" class="text-muted">
              Enter the 10 Digit Phone no of student.
            </small>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="InputInstitute1">Preferred Institute-1<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_registration['s_institute1']=="") { ?>
              <select class="form-control" id="InputInstitute1" name="s_institute1" required>
                <option value="" selected disabled>Select Preferred Institute-1</option>
                <?php foreach($info_active_institute as $institute) { ?>
                  <option id="<?php echo $institute['ins_id'] ?>" value="<?php echo $institute['ins_name'] ?>"><?php echo $institute['ins_name'] ?></option>
                <?php } ?>
              </select>
            <?php } else { ?>
              <select class="form-control" id="InputInstitute1" name="s_institute1" readonly>
                <option value="<?php echo $info_registration['s_institute1'] ?>" selected readonly><?php echo $info_registration['s_institute1'] ?></option>
                <?php foreach($info_active_institute as $institute) { ?>
                  <option id="<?php echo $institute['ins_id'] ?>" value="<?php echo $institute['ins_name'] ?>"><?php echo $institute['ins_name'] ?></option>
                <?php } ?>
              </select>
            <?php } ?>
            <small id="instituteHelpInline1" class="text-muted">
              Enter the preferred institute-1 of student.
            </small>
          </div>
          <div class="form-group col-md-4">
            <label for="InputInstitute2">Preferred Institute-2<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_registration['s_institute2']=="") { ?>
              <select class="form-control" id="InputInstitute2" name="s_institute2" required>
                <option value="" selected disabled>Select Preferred Institute-2</option>
                <?php foreach($info_active_institute as $institute) { ?>
                  <option id="<?php echo $institute['ins_id'] ?>" value="<?php echo $institute['ins_name'] ?>"><?php echo $institute['ins_name'] ?></option>
                <?php } ?>
              </select>
            <?php } else { ?>
              <select class="form-control" id="InputInstitute2" name="s_institute2" readonly>
                <option value="<?php echo $info_registration['s_institute2'] ?>" selected readonly><?php echo $info_registration['s_institute2'] ?></option>
                <?php foreach($info_active_institute as $institute) { ?>
                  <option id="<?php echo $institute['ins_id'] ?>" value="<?php echo $institute['ins_name'] ?>"><?php echo $institute['ins_name'] ?></option>
                <?php } ?>
              </select>
            <?php } ?>
            <small id="instituteHelpInline2" class="text-muted">
              Enter the preferred institute-2 of student.
            </small>
          </div>
          <div class="form-group col-md-4">
            <label for="InputInstitute3">Preferred Institute-3<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_registration['s_institute3']=="") { ?>
              <select class="form-control" id="InputInstitute3" name="s_institute3" required>
                <option value="" selected disabled>Select Preferred Institute-3</option>
                <?php foreach($info_active_institute as $institute) { ?>
                  <option id="<?php echo $institute['ins_id'] ?>" value="<?php echo $institute['ins_name'] ?>"><?php echo $institute['ins_name'] ?></option>
                <?php } ?>
              </select>
            <?php } else { ?>
              <select class="form-control" id="InputInstitute3" name="s_institute3" readonly>
                <option value="<?php echo $info_registration['s_institute3'] ?>" selected readonly><?php echo $info_registration['s_institute3'] ?></option>
                <?php foreach($info_active_institute as $institute) { ?>
                  <option id="<?php echo $institute['ins_id'] ?>" value="<?php echo $institute['ins_name'] ?>"><?php echo $institute['ins_name'] ?></option>
                <?php } ?>
              </select>
            <?php } ?>
            <small id="instituteHelpInline3" class="text-muted">
              Enter the preferred institute-3 of student.
            </small>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="InputStream">Preferred Stream<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_registration['s_stream']=="") { ?>
              <select class="form-control" id="InputStream" name="s_stream" required>
                <option value="" selected readonly>Select Preferred Stream</option>
                <?php foreach($info_stream as $stream) { ?>
                  <option id="<?php echo $stream['str_id'] ?>" value="<?php echo $stream['str_name'] ?>"><?php echo $stream['str_name'] ?></option>
                <?php } ?>
              </select>
            <?php } else { ?>
              <select class="form-control" id="InputStream" name="s_stream" readonly>
                <option value="<?php echo $info_registration['s_stream'] ?>" selected readonly><?php echo $info_registration['s_stream'] ?></option>
                <?php foreach($info_stream as $stream) { ?>
                  <option id="<?php echo $stream['str_id'] ?>" value="<?php echo $stream['str_name'] ?>"><?php echo $stream['str_name'] ?></option>
                <?php } ?>
              </select>
            <?php } ?>
            <small id="streamHelpInline" class="text-muted">
              Enter the preferred stream of student.
            </small>
          </div>
          <div class="form-group col-md-4">
            <label for="InputCourse">Preferred Course<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_registration['s_course']=="") { ?>
              <select class="form-control" id="InputState" name="s_course" required>
                <option value="" selected readonly>Select Preferred Course</option>
                <?php foreach($info_course as $course) { ?>
                  <option id="<?php echo $course['cour_id'] ?>" value="<?php echo $course['cour_name'] ?>"><?php echo $course['cour_name'] ?></option>
                <?php } ?>
              </select>
            <?php } else { ?>
              <select class="form-control" id="InputState" name="s_course" readonly>
                <option value="<?php echo $info_registration['s_course']?>" selected readonly><?php echo $info_registration['s_course'] ?></option>
                <?php foreach($info_course as $course) { ?>
                  <option id="<?php echo $course['cour_id'] ?>" value="<?php echo $course['cour_name'] ?>"><?php echo $course['cour_name'] ?></option>
                <?php } ?>
              </select>
            <?php } ?>
            <small id="courseHelpInline" class="text-muted">
              Enter the preferred course of student.
            </small>
          </div>
        </div>        
        <div class="form-row">
          <!-- <div class="form-group col-md-8" style="text-align:left">
            <button type="submit" name="prev_registration_details" class="btn btn-warning">Prev</button>
            <button type="submit" name="next_registration_details" class="btn btn-info">Next</button>
          </div> -->
          <div class="form-group col-md-12" style="text-align:right">
            <button type="submit" name="submit_registration_details" class="btn btn-success">Save Registration Details</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</main>
<div class="footer">&copy; 2022 | <strong>eAdmission System</strong> | All Rights are Reserved</div>
</html>

<script src="js/registration-details.js"></script>