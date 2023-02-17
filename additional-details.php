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
    
    $sql_additional = "SELECT * FROM additional_details WHERE `s_id` = '$s_id'";
    $result_additional = mysqli_query($connect, $sql_additional);
    $num_additional = mysqli_num_rows($result_additional);
    $info_additional = mysqli_fetch_assoc($result_additional);

    $sql_personal = "SELECT * FROM personal_details WHERE `s_id` = '$s_id'";
    $result_personal = mysqli_query($connect, $sql_personal);
    $num_personal = mysqli_num_rows($result_personal);
    $info_personal = mysqli_fetch_assoc($result_personal);

    if($info_additional['s_extracarricularquota']=="" && $info_registration['s_status']=='6'){
      if(isset($_POST['s_extracarricularquota']) && ($_POST['s_nccquota']) && ($_POST['s_bplcategory']) && ($_POST['s_domiclestate'])){
        $s_extracarricularquota = $_POST['s_extracarricularquota'];
        $s_differentlyabledquota = $_POST['s_differentlyabledquota'];
        $s_nccquota = $_POST['s_nccquota'];
        $s_bplcategory = $_POST['s_bplcategory'];
        $s_domiclestate = $_POST['s_domiclestate'];

        if($s_extracarricularquota === "Yes" && $info_personal['s_gender'] == "Female"){
          $s_fieldofproficiency = $_POST['s_fieldofproficiency'];
          $s_levelofproficiency = $_POST['s_levelofproficiency'];  
          $s_resideinhostel = $_POST['s_resideinhostel'];

          $sql_additional_update = "UPDATE `additional_details` SET `s_extracarricularquota`='$s_extracarricularquota',`s_fieldofproficiency`='$s_fieldofproficiency',`s_levelofproficiency`='$s_levelofproficiency', `s_differentlyabledquota`='$s_differentlyabledquota', `s_nccquota`='$s_nccquota', `s_resideinhostel`='$s_resideinhostel', `s_bplcategory`='$s_bplcategory', `s_domiclestate`='$s_domiclestate' WHERE `s_id`='$s_id'";
          $result_additional_update = mysqli_query($connect, $sql_additional_update);

          $sql_registration_update = "UPDATE `registration_details` SET `s_status`='7' WHERE `s_id`='$s_id'";
          $result_registration_update = mysqli_query($connect, $sql_registration_update);      

          if($result_additional_update && $result_registration_update){
            ?>
            <script>
              alert("Additional Details Inserted Successfully!");
              window.location.href="academic-details.php";
            </script>
            <?php
          }
        }
        elseif($s_extracarricularquota === "Yes" && $info_personal['s_gender'] == "Male"){
          $s_fieldofproficiency = $_POST['s_fieldofproficiency'];
          $s_levelofproficiency = $_POST['s_levelofproficiency'];  

          $sql_additional_update = "UPDATE `additional_details` SET `s_extracarricularquota`='$s_extracarricularquota',`s_fieldofproficiency`='$s_fieldofproficiency',`s_levelofproficiency`='$s_levelofproficiency', `s_differentlyabledquota`='$s_differentlyabledquota', `s_nccquota`='$s_nccquota', `s_bplcategory`='$s_bplcategory', `s_domiclestate`='$s_domiclestate' WHERE `s_id`='$s_id'";
          $result_additional_update = mysqli_query($connect, $sql_additional_update);

          $sql_registration_update = "UPDATE `registration_details` SET `s_status`='7' WHERE `s_id`='$s_id'";
          $result_registration_update = mysqli_query($connect, $sql_registration_update);      

          if($result_additional_update && $result_registration_update){
            ?>
            <script>
              alert("Additional Details Inserted Successfully!");
              window.location.href="academic-details.php";
            </script>
            <?php
          }

        }
        elseif($s_extracarricularquota === "No" && $info_personal['s_gender'] == "Female"){
          $s_resideinhostel = $_POST['s_resideinhostel'];
          $sql_additional_update = "UPDATE `additional_details` SET `s_extracarricularquota`='$s_extracarricularquota', `s_differentlyabledquota`='$s_differentlyabledquota', `s_nccquota`='$s_nccquota', `s_resideinhostel`='$s_resideinhostel', `s_bplcategory`='$s_bplcategory', `s_domiclestate`='$s_domiclestate' WHERE `s_id`='$s_id'";
          $result_additional_update = mysqli_query($connect, $sql_additional_update);

          $sql_registration_update = "UPDATE `registration_details` SET `s_status`='7' WHERE `s_id`='$s_id'";
          $result_registration_update = mysqli_query($connect, $sql_registration_update);      

          if($result_additional_update && $result_registration_update){
            ?>
            <script>
              alert("Additional Details Inserted Successfully!");
              window.location.href="academic-details.php";
            </script>
            <?php
          }


        }
        elseif($s_extracarricularquota === "No" && $info_personal['s_gender'] == "Male"){
          $sql_additional_update = "UPDATE `additional_details` SET `s_extracarricularquota`='$s_extracarricularquota', `s_differentlyabledquota`='$s_differentlyabledquota', `s_nccquota`='$s_nccquota', `s_bplcategory`='$s_bplcategory', `s_domiclestate`='$s_domiclestate' WHERE `s_id`='$s_id'";
          $result_additional_update = mysqli_query($connect, $sql_additional_update);

          $sql_registration_update = "UPDATE `registration_details` SET `s_status`='7' WHERE `s_id`='$s_id'";
          $result_registration_update = mysqli_query($connect, $sql_registration_update);      

          if($result_additional_update && $result_registration_update){
            ?>
            <script>
              alert("Additional Details Inserted Successfully!");
              window.location.href="academic-details.php";
            </script>
            <?php
          }
        }
      }
    }
    else{
      if(isset($_POST['submit_additional_details'])){
        ?>
          <script>
            alert("Additional Details Already Exist!");
            window.location.href="academic-details.php";
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
    <link rel="stylesheet" href="css/additional-details.css">
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
            <li class="c-menu__item" data-toggle="tooltip" title="Family Details">
              <div class="c-menu__item__inner"><i class="fa fa-users"></i>
                <div class="c-menu-item__title"><span>Family Details</span></div>
              </div>
            </li>
          </a>
          <a href="bank-details.php" style="text-decoration:none">
            <li class="c-menu__item" data-toggle="tooltip" title="Bank Details">
                <div class="c-menu__item__inner"><i class="fa fa-university"></i>
                <div class="c-menu-item__title"><span>Bank Details</span></div>
                </div>
            </li>
          </a>
          <a href="additional-details.php" style="text-decoration:none">
            <li class="c-menu__item is-active" data-toggle="tooltip" title="Additional Details">
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
    <h2 class="page-title">Additional Details</h2>
    <?php if ($success == 1) { ?>
      <div class="alert alert-success alert-dismissible" role="alert">
        Additional Details submitted successfully!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php } elseif ($success == 2) { ?>
      <div class="alert alert-danger alert-dismissible" role="alert">
        Additional Details already submitted!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php } ?>
    <div class="page-content">
      <form action="additional-details.php" method="post" autocomplete="off">
        <div class="form-row col-md-12">
          <div class="form-group col-md-2">
          </div>
          <div class="form-group col-md-4">
            <span id="extracarricularquotaHelpline">Are you an applicant for extra carricular quota?<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
          </div>
          <div class="form-group col-md-4">
              <?php if($info_additional['s_extracarricularquota'] == "") { ?>
              <select onChange="extracarricularquota(this.value)" class="form-control" type="text" name="s_extracarricularquota" required>
                <option value="" selected disabled>Select Answer</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
              <?php } else { ?>
                <input class="form-control" type="text" name="s_extracarricularquota" value="<?php echo $info_additional['s_extracarricularquota'] ?>" disabled>
              <?php } ?>
          </div>
          <div class="form-group col-md-2">
          </div>
        </div>
        <div class="form-row col-md-12 extracarricularquota" style="display: none;">
          <div class="form-group col-md-2">
          </div>
          <div class="form-group col-md-4">
            <span id="fieldofproficiencyHelpline">State your field of proficiency<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
          </div>
          <div class="form-group col-md-4">
              <?php if($info_additional['s_fieldofproficiency'] == "") { ?>
              <input class="form-control" type="text" name="s_fieldofproficiency">
              <?php } ?>
          </div>
          <div class="form-group col-md-2">
          </div>
        </div>
        <?php if($info_additional['s_fieldofproficiency'] != "") { ?>
        <div class="form-row col-md-12">
          <div class="form-group col-md-2">
          </div>
          <div class="form-group col-md-4">
            <span id="fieldofproficiencyHelpline">State your field of proficiency<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
          </div>
          <div class="form-group col-md-4">
              <input class="form-control" type="text" value="<?php echo $info_additional['s_fieldofproficiency'] ?>" disabled>
          </div>
          <div class="form-group col-md-2">
          </div>
        </div>
        <?php } ?>
        <div class="form-row col-md-12 extracarricularquota" style="display: none;">
          <div class="form-group col-md-2">
          </div>
          <div class="form-group col-md-4">
            <span id="levelofproficiencyHelpline">State your level of proficiency<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
          </div>
          <div class="form-group col-md-4">
              <?php if($info_additional['s_levelofproficiency'] == "") { ?>              
              <select class="form-control" type="text" name="s_levelofproficiency">
                <option value="" selected disabled>Select Answer</option>
                <option value="District">District</option>
                <option value="State">State</option>
                <option value="National">National</option>
                <option value="International">International</option>
              </select>
              <?php } ?>
          </div>
          <div class="form-group col-md-2">
          </div>
        </div>
        <?php if($info_additional['s_levelofproficiency'] != "") { ?>              
        <div class="form-row col-md-12 extracarricularquota" style="display: none;">
          <div class="form-group col-md-2">
          </div>
          <div class="form-group col-md-4">
            <span id="levelofproficiencyHelpline">State your level of proficiency<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
          </div>
          <div class="form-group col-md-4">
              <input class="form-control" type="text" value="<?php echo $info_additional['s_levelofproficiency'] ?>" disabled>
          </div>
          <div class="form-group col-md-2">
          </div>
        </div>
        <?php } ?>
        <div class="form-row col-md-12">
          <div class="form-group col-md-2">
          </div>
          <div class="form-group col-md-4">
            <span id="differentlyabledquotaHelpline">Are you an applicant for Differently Abled quota?<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
          </div>
          <div class="form-group col-md-4">
              <?php if($info_additional['s_differentlyabledquota'] == "") { ?>              
              <select class="form-control" type="text" name="s_differentlyabledquota" required>
                <option value="" selected disabled>Select Answer</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
              <?php } else { ?>
              <input class="form-control" type="text" name="s_differentlyabledquota" value="<?php echo $info_additional['s_differentlyabledquota'] ?>" disabled>
              <?php } ?>
          </div>
          <div class="form-group col-md-2">
          </div>
        </div>
        <div class="form-row col-md-12">
          <div class="form-group col-md-2">
          </div>
          <div class="form-group col-md-4">
            <span id="nccquotaHelpline">Are you an applicant for NCC quota?<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
          </div>
          <div class="form-group col-md-4">
              <?php if($info_additional['s_nccquota'] == "") { ?>              
              <select class="form-control" type="text" name="s_nccquota" required>
                <option value="" selected disabled>Select Answer</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
              <?php } else { ?>
              <input class="form-control" type="text" name="s_nccquota" value="<?php echo $info_additional['s_nccquota'] ?>" disabled>
              <?php } ?>
          </div>
          <div class="form-group col-md-2">
          </div>
        </div>
        <?php if($info_personal['s_gender'] == "Female") { ?>
            <div class="form-row col-md-12">
                <div class="form-group col-md-2">
                </div>
                <div class="form-group col-md-4">
                    <span id="resideinhostelHelpline">Are you propose to reside in hostel? (Only for female)<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
                </div>
                <div class="form-group col-md-4">
                    <?php if($info_additional['s_resideinhostel'] == "") { ?>              
                    <select class="form-control" type="text" name="s_resideinhostel" required>
                        <option value="" selected disabled>Select Answer</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                    <?php } else { ?>
                    <input class="form-control" type="text" name="s_resideinhostel" value="<?php echo $info_additional['s_resideinhostel'] ?>" disabled>
                    <?php } ?>
                </div>
                <div class="form-group col-md-2">
                </div>
            </div>
        <?php } ?>
        <div class="form-row col-md-12">
          <div class="form-group col-md-2">
          </div>
          <div class="form-group col-md-4">
            <span id="bplcategoryHelpline">Are you under BPL category? (Family income below Rs.2Lakh/Anum)<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
          </div>
          <div class="form-group col-md-4">
              <?php if($info_additional['s_bplcategory'] == "") { ?>              
              <select class="form-control" type="text" name="s_bplcategory" required>
                <option value="" selected disabled>Select Answer</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
              </select>
              <?php } else { ?>
              <input class="form-control" type="text" name="s_bplcategory" value="<?php echo $info_additional['s_bplcategory'] ?>" disabled>
              <?php } ?>
          </div>
          <div class="form-group col-md-2">
          </div>
        </div>
        <div class="form-row col-md-12">
          <div class="form-group col-md-2">
          </div>
          <div class="form-group col-md-4">
            <span id="domiclestateHelpline">Domicle State<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
          </div>
          <div class="form-group col-md-4">
              <?php if($info_additional['s_domiclestate'] == "") { ?>              
              <select class="form-control" type="text" name="s_domiclestate" required>
                <option value="" selected disabled>Select Domicle State</option>
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
              <input class="form-control" type="text" name="s_domiclestate" value="<?php echo $info_additional['s_domiclestate'] ?>" disabled>
              <?php } ?>
          </div>
          <div class="form-group col-md-2">
          </div>
        </div>
        <div class="form-row">
          <!-- <div class="form-group col-md-8" style="text-align:left">
            <button type="submit" name="prev_additional_details" class="btn btn-warning">Prev</button>
            <button type="submit" name="next_additional_details" class="btn btn-info">Next</button>
          </div> -->
          <div class="form-group col-md-12" style="text-align:right">
            <button type="submit" name="submit_additional_details" class="btn btn-success">Save Additional Details</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</main>
<div class="footer">&copy; 2022 | <strong>eAdmission System</strong> | All Rights are Reserved</div>
</html>

<script src="js/additional-details.js"></script>