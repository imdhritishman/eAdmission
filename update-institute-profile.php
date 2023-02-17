<?php
    require("connection.php");
    require("header.php");
    $page_title = "Institute Profile";


    if(isset($_SESSION['ins_id'])){
        $ins_id = $_SESSION['ins_id'];
        $sql_institute = "SELECT * FROM institute WHERE `ins_id` = '$ins_id'";
        $result_institute = mysqli_query($connect, $sql_institute);
        $num_institute = mysqli_num_rows($result_institute);
        $info_institute = mysqli_fetch_assoc($result_institute);
        $ins_code = $info_institute['ins_code'];
        $ins_logo = $info_institute['ins_logo'];
        $ins_name = $info_institute['ins_name'];
    }
    else{
        ?>
        <script>
            window.location.href="logout-institute.php";
        </script>
        <?php
    }

    if(isset($_POST['submit_update_institute_profile'])){
        $ins_phone = $_POST['ins_phone'];
        $ins_email = $_POST['ins_email'];
        $ins_website = $_POST['ins_website'];
        $ins_address = $_POST['ins_address'];

        $sql_update_institute_profile = "UPDATE `institute` SET `ins_phone`='$ins_phone', `ins_email`='$ins_email',`ins_website`='$ins_website',`ins_address`='$ins_address' WHERE `ins_id`='$ins_id'";
        $result_update_institute_profile = mysqli_query($connect, $sql_update_institute_profile);

        $size = 2000000;
        $extensions = array("pdf", "png");
        if($ins_logo==""){
          @$ins_logo_name= $_FILES['file']['name'];
          @$ins_logo_type= $_FILES['file']['type'];
          @$ins_logo_size= $_FILES['file']['size'];
          @$ins_logo_tmp_name= $_FILES['file']['tmp_name'];

          $ins_logo_location="";

          $ins_logo_extension = explode(".", $ins_logo_name);

          $ins_logo_actual_extension = strtolower(end($ins_logo_extension));
    
          $ins_logo_newname= $ins_code."LOGO".rand().".".$ins_logo_actual_extension;
        }          
  
        if($ins_logo==""){
          $ins_logo_location = "assets/docs/institute-logo/".$ins_logo_newname;
          move_uploaded_file($ins_logo_tmp_name, $ins_logo_location);

          $sql_update_institute_profile_logo = "UPDATE `institute` SET `ins_logo`='$ins_logo_location' WHERE `ins_id`='$ins_id'";
          $result_update_institute_profile_logo = mysqli_query($connect, $sql_update_institute_profile_logo);
        }
        

        if($result_update_institute_profile || $result_update_institute_profile_logo){
        ?>
          <script>
              window.location.href="global-assets/php/update-institute-profile-success.php";
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
    <link rel="stylesheet" href="css/update-institute-profile.css">
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
            <li class="c-menu__item is-active" data-toggle="tooltip" title="Institute Profile">
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
    <h2 class="page-title">Update Institute Profile</h2>
    <div class="page-content">
      <form action="update-institute-profile.php" method="post" autocomplete="off" enctype="multipart/form-data">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="InputInstituteName">Institute Name<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
                <input class="form-control" type="text" name="ins_name" value="<?php echo $info_institute['ins_name'] ?>" readonly>
            <small id="fathersnameHelpInline" class="text-muted">
              Enter the Updated Name of institute.
            </small>
          </div>
          <div class="form-group col-md-4">
            <label for="InputInstituteCode">Institute Code<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
                <input class="form-control" type="text" name="ins_code" value="<?php echo $info_institute['ins_code'] ?>" readonly>
            <small id="fathersoccupationHelpInline" class="text-muted">
              Enter the Updated Code of institute.
            </small>
          </div>
          <div class="form-group col-md-4">
            <label for="InputInstitutePhone">Institute Phone No<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
              <input class="form-control" type="tel" name="ins_phone" value="<?php echo $info_institute['ins_phone'] ?>" required>
            <small id="fathersphonenoHelpInline" class="text-muted">
              Enter the Updated 10 Digit Phone no of institute.
            </small>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="InputInstituteEmail">Institute Email ID<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
              <input class="form-control" type="email" name="ins_email" value="<?php echo $info_institute['ins_email'] ?>" required>
            <small id="mothersnameHelpInline" class="text-muted">
              Enter the Updated Email ID of institute.
            </small>
          </div>
          <div class="form-group col-md-4">
            <label for="InputInstituteWebsite">Institute Website<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
              <input class="form-control" type="text" name="ins_website" value="<?php echo $info_institute['ins_website'] ?>" required>
            <small id="mothersoccupationHelpInline" class="text-muted">
              Enter the Updated Website of institute.
            </small>
          </div>
          <div class="form-group col-md-4">
            <label for="InputInstituteAddress">Institute Address<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
              <input class="form-control" type="text" name="ins_address" value="<?php echo $info_institute['ins_address'] ?>" required>
            <small id="mothersphonenoHelpInline" class="text-muted">
              Enter the Updated Address of institute.
            </small>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="InputInstituteLogo">Institute Logo<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
              <?php if($info_institute['ins_logo']==""){ ?>
                <input class="form-control" type="file" name="file" accept=".jpg, .jpeg, .png" required>
              <?php } else{ ?>
                <input class="form-control" type="file" disabled>
              <?php } ?>
            <small id="gurdiansnameHelpInline" class="text-muted">
              Upload the Updated Logo of institute in 1:1 ratio.
            </small>
          </div>
          <div class="form-group col-md-4">
          </div>
        </div>
        <div class="form-row">
          <!-- <div class="form-group col-md-8" style="text-align:left">
            <button type="submit" name="prev_family_details" class="btn btn-warning">Prev</button>
            <button type="submit" name="next_family_details" class="btn btn-info">Next</button>
          </div> -->
          <div class="form-group col-md-12" style="text-align:right">
                <button type="button" class="btn btn-warning" onclick="window.location.href='institute-profile.php'">Go Back</button>
                <button type="submit" name="submit_update_institute_profile" class="btn btn-primary">Update Institute Profile</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</main>
<div class="footer">&copy; 2022 | <strong>eAdmission System</strong> | All Rights are Reserved</div>
</html>

<script src="js/update-institute-profile.js"></script>
