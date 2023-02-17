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
    
    $sql_family = "SELECT * FROM family_details WHERE `s_id` = '$s_id'";
    $result_family = mysqli_query($connect, $sql_family);
    $num_family = mysqli_num_rows($result_family);
    $info_family = mysqli_fetch_assoc($result_family);

    if($info_family['s_fathersname']=="" && $info_registration['s_status']=='4') {
      if(isset($_POST['s_fathersname']) && ($_POST['s_fathersoccupation']) && ($_POST['s_fathersphoneno']) && ($_POST['s_mothersname']) && ($_POST['s_mothersoccupation']) && ($_POST['s_mothersphoneno']) && ($_POST['s_gurdiansname']) && ($_POST['s_gurdiansphoneno'])){
        $s_fathersname = $_POST['s_fathersname'];
        $s_fathersoccupation = $_POST['s_fathersoccupation'];
        $s_fathersphoneno = $_POST['s_fathersphoneno'];
        $s_mothersname = $_POST['s_mothersname'];
        $s_mothersoccupation = $_POST['s_mothersoccupation'];
        $s_mothersphoneno = $_POST['s_mothersphoneno'];
        $s_gurdiansname = $_POST['s_gurdiansname'];
        $s_gurdiansphoneno = $_POST['s_gurdiansphoneno'];
        
        $sql_family_update = "UPDATE `family_details` SET `s_fathersname`='$s_fathersname',`s_fathersoccupation`='$s_fathersoccupation',`s_fathersphoneno`='$s_fathersphoneno', `s_mothersname`='$s_mothersname',`s_mothersoccupation`='$s_mothersoccupation',`s_mothersphoneno`='$s_mothersphoneno', `s_gurdiansname`='$s_gurdiansname',`s_gurdiansphoneno`='$s_gurdiansphoneno' WHERE `s_id`='$s_id'";
        $result_family_update = mysqli_query($connect, $sql_family_update);
        
        $sql_registration_update = "UPDATE `registration_details` SET `s_status`='5' WHERE `s_id`='$s_id'";
        $result_registration_update = mysqli_query($connect, $sql_registration_update);

        if($result_family_update && $result_registration_update){
          ?>
            <script>
              alert("Family Details Inserted Successfully!");
              window.location.href="bank-details.php";
            </script>
          <?php
        }
      }
    }
    else {
      if(isset($_POST['submit_family_details'])){
        ?>
          <script>
            alert("Family Details Already Exist!");
            window.location.href="family-details.php";
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
    <link rel="stylesheet" href="css/family-details.css">
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
            <li class="c-menu__item is-active" data-toggle="tooltip" title="Family Details">
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
    <h2 class="page-title">Family Details</h2>
    <?php if ($success == 1) { ?>
      <div class="alert alert-success alert-dismissible" role="alert">
        Family Details submitted successfully!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php } elseif ($success == 2) { ?>
      <div class="alert alert-danger alert-dismissible" role="alert">
        Family Details already submitted!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php } ?>
    <div class="page-content">
      <form action="family-details.php" method="post" autocomplete="off">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="InputFathersName">Father's Name<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_family['s_fathersname']=="") { ?>
              <input class="form-control" type="text" name="s_fathersname" required>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_fathersname" value="<?php echo $info_family['s_fathersname'] ?>" disabled>
            <?php } ?>
            <small id="fathersnameHelpInline" class="text-muted">
              Enter the Father's Name of student.
            </small>
          </div>
          <div class="form-group col-md-4">
            <label for="InputFathersOccupation">Father's Occupation<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_family['s_fathersoccupation']=="") { ?>
              <input class="form-control" type="text" name="s_fathersoccupation" required>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_fathersoccupation" value="<?php echo $info_family['s_fathersoccupation'] ?>" disabled>
            <?php } ?>
            <small id="fathersoccupationHelpInline" class="text-muted">
              Enter the Father's occupation of student.
            </small>
          </div>
          <div class="form-group col-md-4">
            <label for="InputFathersPhoneNo">Father's Phone No<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_family['s_fathersphoneno']=="") { ?>
              <input class="form-control" type="number" name="s_fathersphoneno" pattern="[1-9]{1}[0-9]{9}" required>
            <?php } else { ?>
              <input class="form-control" type="number" name="s_fathersphoneno" value="<?php echo $info_family['s_fathersphoneno'] ?>" disabled>
            <?php } ?>
            <small id="fathersphonenoHelpInline" class="text-muted">
              Enter the 10 Digit Father's Phone no of student.
            </small>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="InputMothersName">Mother's Name<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_family['s_mothersname']=="") { ?>
              <input class="form-control" type="text" name="s_mothersname" required>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_mothersname" value="<?php echo $info_family['s_mothersname'] ?>" disabled>
            <?php } ?>
            <small id="mothersnameHelpInline" class="text-muted">
              Enter the Mother's Name of student.
            </small>
          </div>
          <div class="form-group col-md-4">
            <label for="InputMothersOccupation">Mother's Occupation<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_family['s_mothersoccupation']=="") { ?>
              <input class="form-control" type="text" name="s_mothersoccupation" required>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_mothersoccupation" value="<?php echo $info_family['s_mothersoccupation'] ?>" disabled>
            <?php } ?>
            <small id="mothersoccupationHelpInline" class="text-muted">
              Enter the Mother's occupation of student.
            </small>
          </div>
          <div class="form-group col-md-4">
            <label for="InputMothersPhoneNo">Mother's Phone No<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_family['s_mothersphoneno']=="") { ?>
              <input class="form-control" type="number" name="s_mothersphoneno" pattern="[1-9]{1}[0-9]{9}" required>
            <?php } else { ?>
              <input class="form-control" type="number" name="s_mothersphoneno" value="<?php echo $info_family['s_mothersphoneno'] ?>" disabled>
            <?php } ?>
            <small id="mothersphonenoHelpInline" class="text-muted">
              Enter the Mother's 10 Digit Phone no of student.
            </small>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="InputGurdiansName">Gurdian's Name<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_family['s_gurdiansname']=="") { ?>
              <input class="form-control" type="text" name="s_gurdiansname" required>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_gurdiansname" value="<?php echo $info_family['s_gurdiansname'] ?>" disabled>
            <?php } ?>
            <small id="gurdiansnameHelpInline" class="text-muted">
              Enter the Gurdian's Name of student.
            </small>
          </div>
          <div class="form-group col-md-4">
            <label for="InputGurdiansPhoneNo">Gurdian's Phone No<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_family['s_gurdiansphoneno']=="") { ?>
              <input class="form-control" type="number" name="s_gurdiansphoneno" pattern="[1-9]{1}[0-9]{9}" required>
            <?php } else { ?>
              <input class="form-control" type="number" name="s_gurdiansphoneno" value="<?php echo $info_family['s_gurdiansphoneno'] ?>" disabled>
            <?php } ?>
            <small id="gurdiansphonenoHelpInline" class="text-muted">
              Enter the 10 Digit Gurdian's Phone No of student.
            </small>
          </div>
        </div>
        <div class="form-row">
          <!-- <div class="form-group col-md-8" style="text-align:left">
            <button type="submit" name="prev_family_details" class="btn btn-warning">Prev</button>
            <button type="submit" name="next_family_details" class="btn btn-info">Next</button>
          </div> -->
          <div class="form-group col-md-12" style="text-align:right">
            <button type="submit" name="submit_family_details" class="btn btn-success">Save Family Details</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</main>
<div class="footer">&copy; 2022 | <strong>eAdmission System</strong> | All Rights are Reserved</div>
</html>

<script src="js/family-details.js"></script>