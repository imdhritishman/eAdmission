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
    
    $sql_personal = "SELECT * FROM personal_details WHERE `s_id` = '$s_id'";
    $result_personal = mysqli_query($connect, $sql_personal);
    $num_personal = mysqli_num_rows($result_personal);
    $info_personal = mysqli_fetch_assoc($result_personal);

    if($info_personal['s_dob']=="" && $info_registration['s_status']=='3') {
      if(isset($_POST['s_dob']) && ($_POST['s_gender']) && ($_POST['s_nationality']) && ($_POST['s_religion']) && ($_POST['s_caste']) && ($_POST['s_bloodgroup']) && ($_POST['s_marritialstatus'])){
        $s_dob = $_POST['s_dob'];
        $s_gender = $_POST['s_gender'];
        $s_nationality = $_POST['s_nationality'];
        $s_religion = $_POST['s_religion'];
        $s_caste = $_POST['s_caste'];
        $s_bloodgroup = $_POST['s_bloodgroup'];
        $s_marritialstatus = $_POST['s_marritialstatus'];
        
        $sql_personal_update = "UPDATE `personal_details` SET `s_dob`='$s_dob',`s_gender`='$s_gender',`s_nationality`='$s_nationality', `s_religion`='$s_religion', `s_caste`='$s_caste', `s_bloodgroup`='$s_bloodgroup', `s_marritialstatus`='$s_marritialstatus' WHERE `s_id`='$s_id'";
        $result_personal_update = mysqli_query($connect, $sql_personal_update);

        $sql_registration_update = "UPDATE `registration_details` SET `s_status`='4' WHERE `s_id`='$s_id'";
        $result_registration_update = mysqli_query($connect, $sql_registration_update);
        
        if($result_personal_update && $result_registration_update){
          ?>
            <script>
              alert("Personal Details Inserted Successfully!");
              window.location.href="family-details.php";
            </script>
          <?php
        }
      }
    }
    else {
      if(isset($_POST['submit_personal_details'])){
        ?>
          <script>
            alert("Personal Details Already Exist!");
            window.location.href="personal-details.php";
          </script>
        <?php
      }
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
    <link rel="stylesheet" href="css/personal-details.css">
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
            <li class="c-menu__item" data-toggle="tooltip" title="Registration Details">
              <div class="c-menu__item__inner"><i class="fa fa-info"></i>
                <div class="c-menu-item__title"><span>Registration Details</span></div>
              </div>
            </li>
          </a>
          <a href="residential-details.php" style="text-decoration:none">
            <li class="c-menu__item" data-toggle="tooltip" title="Residential Details">
              <div class="c-menu__item__inner"><i class="fa fa-home"></i>
                <div class="c-menu-item__title"><span>Residential Details</span></div>
              </div>
            </li>
          </a>
          <a href="personal-details.php" style="text-decoration:none">
            <li class="c-menu__item is-active" data-toggle="tooltip" title="Personal Details">
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
    <h2 class="page-title">Personal Details</h2>
    <?php if ($success == 1) { ?>
      <div class="alert alert-success alert-dismissible" role="alert">
        Personal Details submitted successfully!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php } elseif ($success == 2) { ?>
      <div class="alert alert-danger alert-dismissible" role="alert">
        Personal Details already submitted!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php } ?>
    <div class="page-content">
      <form action="personal-details.php" method="post" autocomplete="off">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="InputDOB">Date of Birth<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_personal['s_dob']=="") { ?>
              <input class="form-control" type="date" name="s_dob" required>
            <?php } else { ?>
              <input class="form-control" type="date" name="s_dob" value="<?php echo $info_personal['s_dob'] ?>" disabled>
            <?php } ?>
            <small id="dobHelpInline" class="text-muted">
              Enter the Date of Birth of student.
            </small>
          </div>
          <div class="form-group col-md-4">
            <label for="InputGender">Gender<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_personal['s_gender']=="") { ?>
              <select class="form-control" type="text" name="s_gender" required>
                <option value="" selected disabled>Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Others">Others</option>
              </select>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_gender" value="<?php echo $info_personal['s_gender'] ?>" disabled>
            <?php } ?>
            <small id="genderHelpInline" class="text-muted">
              Enter the Gender of student.
            </small>
          </div>
          <div class="form-group col-md-4">
            <label for="InputNationality">Nationality<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_personal['s_nationality']=="") { ?>
              <select class="form-control" type="text" name="s_nationality" required>
                <option value="" selected disabled>Select Nationality</option>
                <option value="Indian">Indian</option>
                <option value="Others">Others</option>
              </select>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_nationality" value="<?php echo $info_personal['s_nationality'] ?>" disabled>
            <?php } ?>
            <small id="nationalityHelpInline" class="text-muted">
              Enter the Nationality of student.
            </small>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="InputReligion">Religion<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_personal['s_religion']=="") { ?>
              <select class="form-control" type="text" name="s_religion" required>
                <option value="" selected disabled>Select Religion</option>
                <option value="Hindu">Hindu</option>
                <option value="Islam">Islam</option>
                <option value="Christian">Christian</option>
                <option value="Buddhist">Buddhist</option>
                <option value="Sikh">Sikh</option>
                <option value="Jain">Jain</option>
                <option value="Others">Others</option>
              </select>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_religion" value="<?php echo $info_personal['s_religion'] ?>" disabled>
            <?php } ?>
            <small id="religionHelpInline" class="text-muted">
              Enter the Religion of student.
            </small>
          </div>
          <div class="form-row">
          <div class="form-group col-md-4">
            <label for="InputCaste">Caste<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_personal['s_caste']=="") { ?>
              <select class="form-control" id="InputCaste" type="text" name="s_caste" required>
                <option value="" selected disabled>Select Caste</option>
                <option value="General">General</option>
                <option value="OBC">OBC</option>
                <option value="MOBC">MOBC</option>
                <option value="SC">SC</option>
                <option value="ST (P)">ST (P)</option>
                <option value="ST (H)">ST (H)</option>
                <option value="Others">Others</option>
              </select>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_caste" value="<?php echo $info_personal['s_caste'] ?>" disabled>
            <?php } ?>
            <small id="casteHelpInline" class="text-muted">
              Enter the Caste of student.
            </small>
          </div>
          <div class="form-group col-md-4">
            <label for="InputBloodGroup">Blood Group<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_personal['s_bloodgroup']=="") { ?>
              <select class="form-control" id="InputBloodGroup" type="text" name="s_bloodgroup" required>
                <option value="" selected disabled>Select Blood Group</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
              </select>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_district" value="<?php echo $info_personal['s_bloodgroup'] ?>" disabled>
            <?php } ?>
            <small id="districtHelpInline" class="text-muted">
              Enter the District of student.
            </small>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="InputMarritialStatus">Marritial Status<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_personal['s_marritialstatus']=="") { ?>
              <select class="form-control" type="text" name="s_marritialstatus" required>
                <option value="" selected disabled>Select Marritial Status</option>
                <option value="Married">Married</option>
                <option value="Unmarried">Unmarried</option>
              </select>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_marritialstatus" value="<?php echo $info_personal['s_marritialstatus'] ?>" disabled>
            <?php } ?>
            <small id="marritialstatusHelpInline" class="text-muted">
              Enter the Marritial Status of student.
            </small>
          </div>
        </div>
        <div class="form-row">
          <!-- <div class="form-group col-md-8" style="text-align:left">
            <a href="personal-details.php"><button type="prev" name="prev_personal_details" class="btn btn-warning">Prev</button></a>
            <a href="personal-details.php"><button type="next" name="next_personal_details" class="btn btn-info">Next</button></a>
          </div> -->
          <div class="form-group col-md-12" style="text-align:right">
            <button type="submit" name="submit_personal_details" class="btn btn-success">Save Personal Details</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</main>
<div class="footer">&copy; 2022 | <strong>eAdmission System</strong> | All Rights are Reserved</div>
</html>

<script src="js/personal-details.js"></script>