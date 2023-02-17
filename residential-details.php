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

    $sql_residential = "SELECT * FROM residential_details WHERE `s_id` = '$s_id'";
    $result_residential = mysqli_query($connect, $sql_residential);
    $num_residential = mysqli_num_rows($result_residential);
    $info_residential = mysqli_fetch_assoc($result_residential);

    if($info_residential['s_villagetown']=="" && $info_registration['s_status']=='2') {
      if(isset($_POST['s_villagetown']) && ($_POST['s_postoffice']) && ($_POST['s_policestation']) && ($_POST['s_pinno']) && ($_POST['s_state']) && ($_POST['s_district'])){
        $s_villagetown = $_POST['s_villagetown'];
        $s_postoffice = $_POST['s_postoffice'];
        $s_policestation = $_POST['s_policestation'];
        $s_pinno = $_POST['s_pinno'];
        $s_state = $_POST['s_state'];
        $s_district = $_POST['s_district'];
        
        $sql_residential_update = "UPDATE `residential_details` SET `s_villagetown`='$s_villagetown',`s_postoffice`='$s_postoffice',`s_policestation`='$s_policestation', `s_pinno`='$s_pinno', `s_state`='$s_state', `s_district`='$s_district' WHERE `s_id`='$s_id'";
        $result_residential_update = mysqli_query($connect, $sql_residential_update);

        $sql_registration_update = "UPDATE `registration_details` SET `s_status`='3' WHERE `s_id`='$s_id'";
        $result_registration_update = mysqli_query($connect, $sql_registration_update);
        
        if($result_residential_update && $result_registration_update){
          ?>
            <script>
              alert("Residential Details Inserted Successfully!");
              window.location.href="personal-details.php";
            </script>
          <?php
        }
      }
    }
    else {
      if(isset($_POST['submit_residential_details'])){
        ?>
          <script>
            alert("Residential Details Already Exist!");
            window.location.href="residential-details.php";
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
    <link rel="stylesheet" href="css/residential-details.css">
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
            <li class="c-menu__item is-active" data-toggle="tooltip" title="Residential Details">
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
    <h2 class="page-title">Residential Details</h2>
    <?php if ($success == 1) { ?>
      <div class="alert alert-success alert-dismissible" role="alert">
        Residential Details submitted successfully!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php } elseif ($success == 2) { ?>
      <div class="alert alert-danger alert-dismissible" role="alert">
        Residential Details already submitted!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php } ?>
    <div class="page-content">
      <form action="residential-details.php" method="post" autocomplete="off">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="InputVillageTown">Village/Town<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_residential['s_villagetown']=="") { ?>
              <input class="form-control" type="text" name="s_villagetown" required>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_villagetown" value="<?php echo $info_residential['s_villagetown'] ?>" disabled>
            <?php } ?>
            <small id="villagetownHelpInline" class="text-muted">
              Enter the Village/Town of student.
            </small>
          </div>
          <div class="form-group col-md-4">
            <label for="InputPostOffice">Post Office<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_residential['s_postoffice']=="") { ?>
              <input class="form-control" type="text" name="s_postoffice" required>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_postoffice" value="<?php echo $info_residential['s_postoffice'] ?>" disabled>
            <?php } ?>
            <small id="postofficeHelpInline" class="text-muted">
              Enter the Post Office of student.
            </small>
          </div>
          <div class="form-group col-md-4">
            <label for="InputPoliceStation">Police Station<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_residential['s_policestation']=="") { ?>
              <input class="form-control" type="text" name="s_policestation" required>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_policestation" value="<?php echo $info_residential['s_policestation'] ?>" disabled>
            <?php } ?>
            <small id="policestationHelpInline" class="text-muted">
              Enter the Police Station of student.
            </small>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="InputPINNo">PIN No<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_residential['s_pinno']=="") { ?>
              <input class="form-control" type="number" name="s_pinno" required>
            <?php } else { ?>
              <input class="form-control" type="number" name="s_pinno" value="<?php echo $info_residential['s_pinno'] ?>" disabled>
            <?php } ?>
            <small id="pinnoHelpInline" class="text-muted">
              Enter the PIN No of student.
            </small>
          </div>
          <div class="form-row">
          <div class="form-group col-md-4">
            <label for="InputState">State<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_residential['s_state']=="") { ?>
              <select class="form-control" id="InputState" type="text" name="s_state" required>
                <option value="" selected disabled>Select State</option>
                <option value="Andra Pradesh">Andra Pradesh</option>
                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                <option value="Assam">Assam</option>
                <option value="Bihar">Bihar</option>
                <option value="Chhattisgarh">Chhattisgarh</option>
                <option value="Goa">Goa</option>
                <option value="Gujarat">Gujarat</option>
                <option value="Haryana">Haryana</option>
                <option value="Himachal Pradesh">Himachal Pradesh</option>
                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                <option value="Jharkhand">Jharkhand</option>
                <option value="Karnataka">Karnataka</option>
                <option value="Kerala">Kerala</option>
                <option value="Madya Pradesh">Madya Pradesh</option>
                <option value="Maharashtra">Maharashtra</option>
                <option value="Manipur">Manipur</option>
                <option value="Meghalaya">Meghalaya</option>
                <option value="Mizoram">Mizoram</option>
                <option value="Nagaland">Nagaland</option>
                <option value="Orissa">Orissa</option>
                <option value="Punjab">Punjab</option>
                <option value="Rajasthan">Rajasthan</option>
                <option value="Sikkim">Sikkim</option>
                <option value="Tamil Nadu">Tamil Nadu</option>
                <option value="Telangana">Telangana</option>
                <option value="Tripura">Tripura</option>
                <option value="Uttaranchal">Uttaranchal</option>
                <option value="Uttar Pradesh">Uttar Pradesh</option>
                <option value="West Bengal">West Bengal</option>
                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                <option value="Chandigarh">Chandigarh</option>
                <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                <option value="Daman and Diu">Daman and Diu</option>
                <option value="Delhi">Delhi</option>
                <option value="Lakshadeep">Lakshadeep</option>
                <option value="Pondicherry">Pondicherry</option>
              </select>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_state" value="<?php echo $info_residential['s_state'] ?>" disabled>
            <?php } ?>
            <small id="stateHelpInline" class="text-muted">
              Enter the State of student.
            </small>
          </div>
          <div class="form-group col-md-4">
            <label for="InputDistrice">District<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_residential['s_district']=="") { ?>
              <select class="form-control" id="InputDistrict" type="text" name="s_district" required>
                <option value="" selected disabled>Select District</option>
              </select>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_district" value="<?php echo $info_residential['s_district'] ?>" disabled>
            <?php } ?>
            <small id="districtHelpInline" class="text-muted">
              Enter the District of student.
            </small>
          </div>
        </div>
        <div class="form-row">
          <!-- <div class="form-group col-md-8" style="text-align:left">
            <a href="residential-details.php"><button type="prev" name="prev_residential_details" class="btn btn-warning">Prev</button></a>
            <a href="residential-details.php"><button type="next" name="next_residential_details" class="btn btn-info">Next</button></a>
          </div> -->
          <div class="form-group col-md-12" style="text-align:right">
            <button type="submit" name="submit_residential_details" class="btn btn-success">Save Residential Details</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</main>
<div class="footer">&copy; 2022 | <strong>eAdmission System</strong> | All Rights are Reserved</div>
</html>

<script src="js/residential-details.js"></script>