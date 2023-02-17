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
    
    $sql_upload = "SELECT * FROM upload_documents WHERE `s_id` = '$s_id'";
    $result_upload = mysqli_query($connect, $sql_upload);
    $num_upload = mysqli_num_rows($result_upload);
    $info_upload = mysqli_fetch_assoc($result_upload);

    $sql_additional = "SELECT * FROM additional_details WHERE `s_id` = '$s_id'";
    $result_additional = mysqli_query($connect, $sql_additional);
    $num_additional = mysqli_num_rows($result_additional);
    $info_additional = mysqli_fetch_assoc($result_additional);

    $sql_personal = "SELECT * FROM personal_details WHERE `s_id` = '$s_id'";
    $result_personal = mysqli_query($connect, $sql_personal);
    $num_personal = mysqli_num_rows($result_personal);
    $info_personal = mysqli_fetch_assoc($result_personal);

    if($info_upload['s_passportphotograph']=="" && $info_registration['s_status']=='9'){
        if(isset($_POST['submit_upload_documents'])){
            $s_size = 2000000;
            $s_extensions = array("jpg", "jpeg", "png", "pdf");

            $s_passportphotograph_name = $_FILES['s_passportphotograph']['name'];
            $s_passportphotograph_type = $_FILES['s_passportphotograph']['type'];
            $s_passportphotograph_size = $_FILES['s_passportphotograph']['size'];
            $s_passportphotograph_tmp = $_FILES['s_passportphotograph']['tmp_name'];

            $s_signature_name = $_FILES['s_signature']['name'];
            $s_signature_type = $_FILES['s_signature']['type'];
            $s_signature_size = $_FILES['s_signature']['size'];
            $s_signature_tmp = $_FILES['s_signature']['tmp_name'];

            $s_hslccertificate_name = $_FILES['s_hslccertificate']['name'];
            $s_hslccertificate_type = $_FILES['s_hslccertificate']['type'];
            $s_hslccertificate_size = $_FILES['s_hslccertificate']['size'];
            $s_hslccertificate_tmp = $_FILES['s_hslccertificate']['tmp_name'];

            $s_hslcmarksheet_name = $_FILES['s_hslcmarksheet']['name'];
            $s_hslcmarksheet_type = $_FILES['s_hslcmarksheet']['type'];
            $s_hslcmarksheet_size = $_FILES['s_hslcmarksheet']['size'];
            $s_hslcmarksheet_tmp = $_FILES['s_hslcmarksheet']['tmp_name'];

            $s_bankpassbook_name = $_FILES['s_bankpassbook']['name'];
            $s_bankpassbook_type = $_FILES['s_bankpassbook']['type'];
            $s_bankpassbook_size = $_FILES['s_bankpassbook']['size'];
            $s_bankpassbook_tmp = $_FILES['s_bankpassbook']['tmp_name'];

            $s_domicilecertificate_name = $_FILES['s_domicilecertificate']['name'];
            $s_domicilecertificate_type = $_FILES['s_domicilecertificate']['type'];
            $s_domicilecertificate_size = $_FILES['s_domicilecertificate']['size'];
            $s_domicilecertificate_tmp = $_FILES['s_domicilecertificate']['tmp_name'];

            $s_aadhaarcard_name = $_FILES['s_aadhaarcard']['name'];
            $s_aadhaarcard_type = $_FILES['s_aadhaarcard']['type'];
            $s_aadhaarcard_size = $_FILES['s_aadhaarcard']['size'];
            $s_aadhaarcard_tmp = $_FILES['s_aadhaarcard']['tmp_name'];
            
            $s_passportphotograph_location="";
            $s_signature_location="";
            $s_hslccertificate_location="";
            $s_hslcmarksheet_location="";
            $s_bankpassbook_location="";
            $s_domicilecertificate_location="";
            $s_aadhaarcard_location="";

            $s_passportphotograph_extention = explode(".", $s_passportphotograph_name);
            $s_signature_extention = explode(".", $s_signature_name);
            $s_hslccertificate_extention = explode(".", $s_hslccertificate_name);
            $s_hslcmarksheet_extention = explode(".", $s_hslcmarksheet_name);
            $s_bankpassbook_extention = explode(".", $s_bankpassbook_name);
            $s_domicilecertificate_extention = explode(".", $s_domicilecertificate_name);
            $s_aadhaarcard_extention = explode(".", $s_aadhaarcard_name);

            $s_passportphotograph_actual_extention = strtolower(end($s_passportphotograph_extention));
            $s_signature_actual_extention = strtolower(end($s_signature_extention));
            $s_hslccertificate_actual_extention = strtolower(end($s_hslccertificate_extention));
            $s_hslcmarksheet_actual_extention = strtolower(end($s_hslcmarksheet_extention));
            $s_bankpassbook_actual_extention = strtolower(end($s_bankpassbook_extention));
            $s_domicilecertificate_actual_extention = strtolower(end($s_domicilecertificate_extention));
            $s_aadhaarcard_actual_extention = strtolower(end($s_aadhaarcard_extention));
    
            $s_passportphotograph_newname= "eAdmission".rand().".".$s_passportphotograph_actual_extention;
            $s_signature_newname= "eAdmission".rand().".".$s_signature_actual_extention;
            $s_hslccertificate__newname= "eAdmission".rand().".".$s_hslccertificate_actual_extention;
            $s_hslcmarksheet_newname= "eAdmission".rand().".".$s_hslcmarksheet_actual_extention;
            $s_bankpassbook_newname= "eAdmission".rand().".".$s_bankpassbook_actual_extention;
            $s_domicilecertificate_newname= "eAdmission".rand().".".$s_domicilecertificate_actual_extention;
            $s_aadhaarcard_newname= "eAdmission".rand().".".$s_aadhaarcard_actual_extention;

            if($info_registration['s_course']=="Higher Secondary"){
              $s_passportphotograph_name = $_FILES['s_passportphotograph']['name'];
              $s_passportphotograph_type = $_FILES['s_passportphotograph']['type'];
              $s_passportphotograph_size = $_FILES['s_passportphotograph']['size'];
              $s_passportphotograph_tmp = $_FILES['s_passportphotograph']['tmp_name'];
  
              $s_signature_name = $_FILES['s_signature']['name'];
              $s_signature_type = $_FILES['s_signature']['type'];
              $s_signature_size = $_FILES['s_signature']['size'];
              $s_signature_tmp = $_FILES['s_signature']['tmp_name'];
  
              $s_hslccertificate_name = $_FILES['s_hslccertificate']['name'];
              $s_hslccertificate_type = $_FILES['s_hslccertificate']['type'];
              $s_hslccertificate_size = $_FILES['s_hslccertificate']['size'];
              $s_hslccertificate_tmp = $_FILES['s_hslccertificate']['tmp_name'];
  
              $s_hslcmarksheet_name = $_FILES['s_hslcmarksheet']['name'];
              $s_hslcmarksheet_type = $_FILES['s_hslcmarksheet']['type'];
              $s_hslcmarksheet_size = $_FILES['s_hslcmarksheet']['size'];
              $s_hslcmarksheet_tmp = $_FILES['s_hslcmarksheet']['tmp_name'];
  
              $s_bankpassbook_name = $_FILES['s_bankpassbook']['name'];
              $s_bankpassbook_type = $_FILES['s_bankpassbook']['type'];
              $s_bankpassbook_size = $_FILES['s_bankpassbook']['size'];
              $s_bankpassbook_tmp = $_FILES['s_bankpassbook']['tmp_name'];
              
            }
            elseif($info_registration['s_course']=="Under Graduate"){
              $s_hscertificate_name = $_FILES['s_hscertificate']['name'];
              $s_hscertificate_type = $_FILES['s_hscertificate']['type'];
              $s_hscertificate_size = $_FILES['s_hscertificate']['size'];
              $s_hscertificate_tmp = $_FILES['s_hscertificate']['tmp_name'];
  
              $s_hsmarksheet_name = $_FILES['s_hsmarksheet']['name'];
              $s_hsmarksheet_type = $_FILES['s_hsmarksheet']['type'];
              $s_hsmarksheet_size = $_FILES['s_hsmarksheet']['size'];
              $s_hsmarksheet_tmp = $_FILES['s_hsmarksheet']['tmp_name'];  

              $s_hscertificate_location="";
              $s_hsmarksheet_location="";

              $s_hscertificate_extention = explode(".", $s_hscertificate_name);
              $s_hsmarksheet_extention = explode(".", $s_hsmarksheet_name);

              $s_hscertificate_actual_extention = strtolower(end($s_hscertificate_extention));
              $s_hsmarksheet_actual_extention = strtolower(end($s_hsmarksheet_extention));

              $s_hscertificate_newname= "eAdmission".rand().".".$s_hscertificate_actual_extention;
              $s_hsmarksheet_newname= "eAdmission".rand().".".$s_hsmarksheet_actual_extention;
            }
            elseif($info_registration['s_course']=="Post Graduate"){
              $s_hscertificate_name = $_FILES['s_hscertificate']['name'];
              $s_hscertificate_type = $_FILES['s_hscertificate']['type'];
              $s_hscertificate_size = $_FILES['s_hscertificate']['size'];
              $s_hscertificate_tmp = $_FILES['s_hscertificate']['tmp_name'];
  
              $s_hsmarksheet_name = $_FILES['s_hsmarksheet']['name'];
              $s_hsmarksheet_type = $_FILES['s_hsmarksheet']['type'];
              $s_hsmarksheet_size = $_FILES['s_hsmarksheet']['size'];
              $s_hsmarksheet_tmp = $_FILES['s_hsmarksheet']['tmp_name'];  
              
              $s_ugcertificate_name = $_FILES['s_ugcertificate']['name'];
              $s_ugcertificate_type = $_FILES['s_ugcertificate']['type'];
              $s_ugcertificate_size = $_FILES['s_ugcertificate']['size'];
              $s_ugcertificate_tmp = $_FILES['s_ugcertificate']['tmp_name'];
  
              $s_ugmarksheet_name = $_FILES['s_ugmarksheet']['name'];
              $s_ugmarksheet_type = $_FILES['s_ugmarksheet']['type'];
              $s_ugmarksheet_size = $_FILES['s_ugmarksheet']['size'];
              $s_ugmarksheet_tmp = $_FILES['s_ugmarksheet']['tmp_name'];

              $s_hscertificate_location="";
              $s_hsmarksheet_location="";
              $s_ugcertificate_location="";
              $s_ugmarksheet_location="";

              $s_hscertificate_extention = explode(".", $s_hscertificate_name);
              $s_hsmarksheet_extention = explode(".", $s_hsmarksheet_name);
              $s_ugcertificate_extention = explode(".", $s_ugcertificate_name);
              $s_ugmarksheet_extention = explode(".", $s_ugmarksheet_name);

              $s_hscertificate_actual_extention = strtolower(end($s_hscertificate_extention));
              $s_hsmarksheet_actual_extention = strtolower(end($s_hsmarksheet_extention));
              $s_ugcertificate_actual_extention = strtolower(end($s_ugcertificate_extention));
              $s_ugmarksheet_actual_extention = strtolower(end($s_ugmarksheet_extention));

              $s_hscertificate_newname= "eAdmission".rand().".".$s_hscertificate_actual_extention;
              $s_hsmarksheet_newname= "eAdmission".rand().".".$s_hsmarksheet_actual_extention;
              $s_ugcertificate_newname= "eAdmission".rand().".".$s_ugcertificate_actual_extention;
              $s_ugmarksheet_newname= "eAdmission".rand().".".$s_ugmarksheet_actual_extention;
            }

            if($info_additional['s_extracarricularquota']=="Yes"){
              $s_extracarricular_name = $_FILES['s_extracarricular']['name'];
              $s_extracarricular_type = $_FILES['s_extracarricular']['type'];
              $s_extracarricular_size = $_FILES['s_extracarricular']['size'];
              $s_extracarricular_tmp = $_FILES['s_extracarricular']['tmp_name'];

              $s_extracarricular_location="";

              $s_extracarricular_extention = explode(".", $s_extracarricular_name);

              $s_extracarricular_actual_extention = strtolower(end($s_extracarricular_extention));

              $s_extracarricular_newname= "eAdmission".rand().".".$s_extracarricular_actual_extention;
            }

            if($info_additional['s_differentlyabledquota']=="Yes"){
              $s_differentlyabled_name = $_FILES['s_differentlyabled']['name'];
              $s_differentlyabled_type = $_FILES['s_differentlyabled']['type'];
              $s_differentlyabled_size = $_FILES['s_differentlyabled']['size'];
              $s_differentlyabled_tmp = $_FILES['s_differentlyabled']['tmp_name'];
  
              $s_differentlyabled_location="";

              $s_differentlyabled_extention = explode(".", $s_differentlyabled_name);

              $s_differentlyabled_actual_extention = strtolower(end($s_differentlyabled_extention));

              $s_differentlyabled_newname= "eAdmission".rand().".".$s_differentlyabled_actual_extention;
            }

            if($info_additional['s_nccquota']=="Yes"){
              $s_ncc_name = $_FILES['s_ncc']['name'];
              $s_ncc_type = $_FILES['s_ncc']['type'];
              $s_ncc_size = $_FILES['s_ncc']['size'];
              $s_ncc_tmp = $_FILES['s_ncc']['tmp_name'];
  
              $s_ncc_location="";

              $s_ncc_extention = explode(".", $s_ncc_name);

              $s_ncc_actual_extention = strtolower(end($s_ncc_extention));

              $s_ncc_newname= "eAdmission".rand().".".$s_ncc_actual_extention;
            }

            if($info_personal['s_caste']!="General"){
              $s_castecertificate_name = $_FILES['s_castecertificate']['name'];
              $s_castecertificate_type = $_FILES['s_castecertificate']['type'];
              $s_castecertificate_size = $_FILES['s_castecertificate']['size'];
              $s_castecertificate_tmp = $_FILES['s_castecertificate']['tmp_name'];
  
              $s_castecertificate_location="";

              $s_castecertificate_extention = explode(".", $s_castecertificate_name);

              $s_castecertificate_actual_extention = strtolower(end($s_castecertificate_extention));

              $s_castecertificate_newname= "eAdmission".rand().".".$s_castecertificate_actual_extention;
            }

            if($info_additional['s_bplcategory']=="Yes"){
              $s_incomecertificate_name = $_FILES['s_incomecertificate']['name'];
              $s_incomecertificate_type = $_FILES['s_incomecertificate']['type'];
              $s_incomecertificate_size = $_FILES['s_incomecertificate']['size'];
              $s_incomecertificate_tmp = $_FILES['s_incomecertificate']['tmp_name'];
  
              $s_incomecertificate_location="";

              $s_incomecertificate_extention = explode(".", $s_incomecertificate_name);

              $s_incomecertificate_actual_extention = strtolower(end($s_incomecertificate_extention));

              $s_incomecertificate_newname= "eAdmission".rand().".".$s_incomecertificate_actual_extention;
            }

            if (in_array($s_passportphotograph_actual_extention, $s_extensions) && ($s_passportphotograph_size < $s_size)){
              
              $s_passportphotograph_location = "assets/docs/".$s_passportphotograph_newname;
              $s_signature_location = "assets/docs/".$s_signature_newname;
              $s_hslccertificate_location = "assets/docs/".$s_hslccertificate__newname;
              $s_hslcmarksheet_location = "assets/docs/".$s_hslcmarksheet_newname;
              $s_hscertificate_location = "assets/docs/".$s_hscertificate_newname;
              $s_hsmarksheet_location = "assets/docs/".$s_hsmarksheet_newname;
              $s_ugcertificate_location = "assets/docs/".$s_ugcertificate_newname;
              $s_ugmarksheet_location = "assets/docs/".$s_ugmarksheet_newname;
              $s_bankpassbook_location = "assets/docs/".$s_bankpassbook_newname;
              $s_extracarricular_location = "assets/docs/".$s_extracarricular_newname;
              // $s_differentlyabled_location = "assets/docs/".$s_differentlyabled_newname;
              $s_ncc_location = "assets/docs/".$s_ncc_newname;
              // $s_castecertificate_location = "assets/docs/".$s_castecertificate_newname;
              $s_incomecertificate_location = "assets/docs/".$s_incomecertificate_newname;
              $s_domicilecertificate_location = "assets/docs/".$s_domicilecertificate_newname;
              $s_aadhaarcard_location = "assets/docs/".$s_aadhaarcard_newname;

              move_uploaded_file($s_passportphotograph_tmp, $s_passportphotograph_location);
              move_uploaded_file($s_signature_tmp, $s_signature_location);
              move_uploaded_file($s_hslccertificate_tmp, $s_hslccertificate_location);
              move_uploaded_file($s_hslcmarksheet_tmp, $s_hslcmarksheet_location);
              move_uploaded_file($s_hscertificate_tmp, $s_hscertificate_location);
              move_uploaded_file($s_hsmarksheet_tmp, $s_hsmarksheet_location);
              move_uploaded_file($s_ugcertificate_tmp, $s_ugcertificate_location);
              move_uploaded_file($s_ugmarksheet_tmp, $s_ugmarksheet_location);
              move_uploaded_file($s_bankpassbook_tmp, $s_bankpassbook_location);
              move_uploaded_file($s_extracarricular_tmp, $s_extracarricular_location);
              // move_uploaded_file($s_differentlyabled_tmp, $s_differentlyabled_location);
              move_uploaded_file($s_ncc_tmp, $s_ncc_location);
              // move_uploaded_file($s_castecertificate_tmp, $s_castecertificate_location);
              move_uploaded_file($s_incomecertificate_tmp, $s_incomecertificate_location);
              move_uploaded_file($s_domicilecertificate_tmp, $s_domicilecertificate_location);
              move_uploaded_file($s_aadhaarcard_tmp, $s_aadhaarcard_location);

            }
            else{
              ?>
                <script type="text/javascript">
                  alert("Error while uploading picture. Please Check image size and extention");
                </script>
              <?php
            }
          }
        }
        else{
        if(isset($_POST['submit_upload_documents'])){
        ?>
          <script>
            alert("Required Documents already exist!");
            window.location.href="upload-documents.php";
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
    <link rel="stylesheet" href="css/upload-documents.css">
</head>
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
            <a href="logout.php" class="logout" style="color:red">
                <i class="fa fa-power-off"></i>
            </a>
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
            <li class="c-menu__item is-active" data-toggle="tooltip" title="Upload Documents">
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
<main>
    <div class="page-header">
        <div class="page-title-logo">
            <img class="page-title-logo-image" src="assets/images/eadmission-logo.PNG" alt="Logo">
        </div>
        <div class="page-title-text">
            <span style="font-weight: bold;"><?php echo $info_registration['s_institute'] ?> - eAdmission</span>
        </div>
    </div>
    <div class="application-data">
        <div class="table-title">Registration Details</div>
        <table class="registration-details">
            <tr>
                <td class="left">Applicant's Name</td>
                <td class="right"><?php echo $info_registration['s_name'] ?></td>
            </tr>
            <tr>
                <td class="left">Application Number</td>
                <td class="right"><?php echo $info_registration['s_aplno'] ?></td>
            </tr>
            <tr>
                <td class="left">Application Date</td>
                <td class="right"><?php echo $info_registration['s_apldate'] ?></td>
            </tr>
            <tr>
                <td class="left">Phone Number</td>
                <td class="right"><?php echo $info_registration['s_phone'] ?></td>
            </tr>
            <tr>
                <td class="left">Email ID</td>
                <td class="right"><?php echo $info_registration['s_email'] ?></td>
            </tr>
            <tr>
                <td class="left">Preferred Institute</td>
                <td class="right"><?php echo $info_registration['s_institute'] ?></td>
            </tr>
            <tr>
                <td class="left">Preferred Stream</td>
                <td class="right"><?php echo $info_registration['s_stream'] ?></td>
            </tr>
            <tr>
                <td class="left">Preferred Course</td>
                <td class="right"><?php echo $info_registration['s_course'] ?></td>
            </tr>    
            <tr>
                <td class="left">Preferred Year</td>
                <td class="right"><?php echo $info_registration['s_year'] ?></td>
            </tr>
        </table>
        <div class="table-title">Residential Details</div>
        <table class="residential-details">
            <tr>
                <td class="left">Village/Town</td>
                <td class="right"><?php echo $info_residential['s_villagetown'] ?></td>
            </tr>
            <tr>
                <td class="left">Post Office</td>
                <td class="right"><?php echo $info_residential['s_postoffice'] ?></td>
            </tr>
            <tr>
                <td class="left">Police Station</td>
                <td class="right"><?php echo $info_residential['s_policestation'] ?></td>
            </tr>
            <tr>
                <td class="left">PIN No</td>
                <td class="right"><?php echo $info_residential['s_pinno'] ?></td>
            </tr>
            <tr>
                <td class="left">State</td>
                <td class="right"><?php echo $info_residential['s_state'] ?></td>
            </tr>
            <tr>
                <td class="left">District</td>
                <td class="right"><?php echo $info_residential['s_district'] ?></td>
            </tr>    
        </table>
        <div class="table-title">Personal Details</div>
        <table class="personal-details">
            <tr>
                <td class="left">Date of Birth</td>
                <td class="right"><?php echo $info_personal['s_dob'] ?></td>
            </tr>
            <tr>
                <td class="left">Gender</td>
                <td class="right"><?php echo $info_personal['s_gender'] ?></td>
            </tr>
            <tr>
                <td class="left">Nationality</td>
                <td class="right"><?php echo $info_personal['s_nationality'] ?></td>
            </tr>
            <tr>
                <td class="left">Religion</td>
                <td class="right"><?php echo $info_personal['s_religion'] ?></td>
            </tr>
            <tr>
                <td class="left">Caste</td>
                <td class="right"><?php echo $info_personal['s_caste'] ?></td>
            </tr>
            <tr>
                <td class="left">Blood Group</td>
                <td class="right"><?php echo $info_personal['s_bloodgroup'] ?></td>
            </tr>    
            <tr>
                <td class="left">Marritial Status</td>
                <td class="right"><?php echo $info_personal['s_marritialstatus'] ?></td>
            </tr>
        </table>
        <div class="table-title">Family Details</div>
        <table class="family-details">
            <tr>
                <td class="left">Father's Name</td>
                <td class="right"><?php echo $info_family['s_fathersname'] ?></td>
            </tr>
            <tr>
                <td class="left">Father's Occupation</td>
                <td class="right"><?php echo $info_family['s_fathersoccupation'] ?></td>
            </tr>
            <tr>
                <td class="left">Father's Phone No</td>
                <td class="right"><?php echo $info_family['s_fathersphoneno'] ?></td>
            </tr>
            <tr>
                <td class="left">Mother's Name</td>
                <td width="right"><?php echo $info_family['s_mothersname'] ?></td>
            </tr>
            <tr>
                <td class="left">Mother's Occupation</td>
                <td class="right"><?php echo $info_family['s_mothersoccupation'] ?></td>
            </tr>
            <tr>
                <td class="left">Mother's Phone No</td>
                <td class="right"><?php echo $info_family['s_mothersphoneno'] ?></td>
            </tr>
            <tr>
                <td class="left">Gurdian's Name</td>
                <td class="right"><?php echo $info_family['s_fathersname'] ?></td>
            </tr>
            <tr>
                <td class="left">Gurdian's Phone Number</td>
                <td class="right"><?php echo $info_family['s_gurdiansphoneno'] ?></td>
            </tr>
        </table>
        <div class="table-title">Bank Details</div>
        <table class="bank-details">
            <tr>
                <td class="left">Bank Name</td>
                <td class="right"><?php echo $info_bank['s_bankname'] ?></td>
            </tr>
            <tr>
                <td class="left">Branch Name</td>
                <td class="right"><?php echo $info_bank['s_branchname'] ?></td>
            </tr>
            <tr>
                <td class="left">Benificiary</td>
                <td class="right"><?php echo $info_bank['s_beneficiaryname'] ?></td>
            </tr>
            <tr>
                <td class="left">Account Number</td>
                <td class="right"><?php echo $info_bank['s_accountno'] ?></td>
            </tr>
            <tr>
                <td class="left">IFSC Code</td>
                <td class="right"><?php echo $info_bank['s_ifsccode'] ?></td>
            </tr>
        </table>
        <div class="table-title">Additional Details</div>
        <table class="additional-details">
            <tr>
                <td class="left">Are you an applicant for extra carricular quota?</td>
                <td class="right"><?php echo $info_additional['s_extracarricularquota'] ?></td>
            </tr>
            <tr>
                <td class="left">State your field of proficiency</td>
                <td class="right"><?php echo $info_additional['s_fieldofproficiency'] ?></td>
            </tr>
            <tr>
                <td class="left">State your level of proficiency</td>
                <td class="right"><?php echo $info_additional['s_levelofproficiency'] ?></td>
            </tr>
            <tr>
                <td class="left">Are you an applicant for Differently Abled quota?</td>
                <td class="right"><?php echo $info_additional['s_differentlyabledquota'] ?></td>
            </tr>
            <tr>
                <td class="left">Are you an applicant for NCC quota?</td>
                <td class="right"><?php echo $info_additional['s_nccquota'] ?></td>
            </tr>
            <?php if($info_personal['s_gender']=="Female") { ?>
            <tr>
                <td class="left">Are you propose to reside in hostel? (Only for female)</td>
                <td class="right"><?php echo $info_additional['s_resideinhostel'] ?></td>
            </tr>
            <?php } ?>
            <tr>
                <td class="left">Are you under BPL category? (Family income below Rs.2Lakh/Anum)</td>
                <td class="right"><?php echo $info_additional['s_bplcategory'] ?></td>
            </tr>
            <tr>
                <td class="left">Domicle State</td>
                <td class="right"><?php echo $info_additional['s_domiclestate'] ?></td>
            </tr>
        </table>
        <div class="table-title">Academic Details</div>
        <table class="academic-details">
        <?php if($info_registration['s_course']=="Higher Secondary") { ?>
            <tr>
                <td class="block1">Subject Name</td>
                <td class="block2">Theory</td>
                <td class="block3">Practical</td>
                <td class="block4">Total</td>
            </tr>
            <tr>
                <td class="block1"><?php echo $info_academic['s_sub1'] ?></td>
                <td class="block2"><?php echo $info_academic['s_theory1'] ?></td>
                <td class="block3"><?php echo $info_academic['s_practical1'] ?></td>
                <td class="block4"><?php echo $info_academic['s_total1'] ?></td>
            </tr>
            <tr>
                <td class="block1"><?php echo $info_academic['s_sub2'] ?></td>
                <td class="block2"><?php echo $info_academic['s_theory2'] ?></td>
                <td class="block3"><?php echo $info_academic['s_practical2'] ?></td>
                <td class="block4"><?php echo $info_academic['s_total2'] ?></td>
            </tr>
            <tr>
                <td class="block1"><?php echo $info_academic['s_sub3'] ?></td>
                <td class="block2"><?php echo $info_academic['s_theory3'] ?></td>
                <td class="block3"><?php echo $info_academic['s_practical3'] ?></td>
                <td class="block4"><?php echo $info_academic['s_total3'] ?></td>
            </tr>
            <tr>
                <td class="block1"><?php echo $info_academic['s_sub4'] ?></td>
                <td class="block2"><?php echo $info_academic['s_theory4'] ?></td>
                <td class="block3"><?php echo $info_academic['s_practical4'] ?></td>
                <td class="block4"><?php echo $info_academic['s_total4'] ?></td>
            </tr>
            <tr>
                <td class="block1"><?php echo $info_academic['s_sub5'] ?></td>
                <td class="block2"><?php echo $info_academic['s_theory5'] ?></td>
                <td class="block3"><?php echo $info_academic['s_practical5'] ?></td>
                <td class="block4"><?php echo $info_academic['s_total5'] ?></td>
            </tr>
            <tr>
                <td class="block1"><?php echo $info_academic['s_sub6'] ?></td>
                <td class="block2"><?php echo $info_academic['s_theory6'] ?></td>
                <td class="block3"><?php echo $info_academic['s_practical6'] ?></td>
                <td class="block4"><?php echo $info_academic['s_total6'] ?></td>
            </tr>
            <tr>
                <td class="block1"></td>
                <td class="block2"></td>
                <td class="block3">Total Marks</td>
                <td class="block4"><?php echo $info_academic['s_total'] ?></td>
            </tr>
            <tr>
                <td class="block1"></td>
                <td class="block2"></td>
                <td class="block3">Percentage</td>
                <td class="block4"><?php echo $info_academic['s_percentage'] ?></td>
            </tr>
        <?php } elseif($info_registration['s_course']=="Under Graduate") { ?>
            <tr>
                <td class="block1">Subject Name</td>
                <td class="block2">Theory</td>
                <td class="block3">Practical</td>
                <td class="block4">Total</td>
            </tr>
            <tr>
                <td class="block1"><?php echo $info_academic['s_sub1'] ?></td>
                <td class="block2"><?php echo $info_academic['s_theory1'] ?></td>
                <td class="block3"><?php echo $info_academic['s_practical1'] ?></td>
                <td class="block4"><?php echo $info_academic['s_total1'] ?></td>
            </tr>
            <tr>
                <td class="block1"><?php echo $info_academic['s_sub2'] ?></td>
                <td class="block2"><?php echo $info_academic['s_theory2'] ?></td>
                <td class="block3"><?php echo $info_academic['s_practical2'] ?></td>
                <td class="block4"><?php echo $info_academic['s_total2'] ?></td>
            </tr>
            <tr>
                <td class="block1"><?php echo $info_academic['s_sub3'] ?></td>
                <td class="block2"><?php echo $info_academic['s_theory3'] ?></td>
                <td class="block3"><?php echo $info_academic['s_practical3'] ?></td>
                <td class="block4"><?php echo $info_academic['s_total3'] ?></td>
            </tr>
            <tr>
                <td class="block1"><?php echo $info_academic['s_sub4'] ?></td>
                <td class="block2"><?php echo $info_academic['s_theory4'] ?></td>
                <td class="block3"><?php echo $info_academic['s_practical4'] ?></td>
                <td class="block4"><?php echo $info_academic['s_total4'] ?></td>
            </tr>
            <tr>
                <td class="block1"><?php echo $info_academic['s_sub5'] ?></td>
                <td class="block2"><?php echo $info_academic['s_theory5'] ?></td>
                <td class="block3"><?php echo $info_academic['s_practical5'] ?></td>
                <td class="block4"><?php echo $info_academic['s_total5'] ?></td>
            </tr>
            <tr>
                <td class="block1"></td>
                <td class="block2"></td>
                <td class="block3">Total Marks</td>
                <td class="block4"><?php echo $info_academic['s_total'] ?></td>
            </tr>
            <tr>
                <td class="block1"></td>
                <td class="block2"></td>
                <td class="block3">Percentage</td>
                <td class="block4"><?php echo $info_academic['s_percentage'] ?></td>
            </tr>
        <?php } if($info_registration['s_course']=="Post Graduate") { ?>
            <tr>
                <td class="block1">Semester Name</td>
                <td class="block2">Grade Secured</td>
                <td class="block3">Credit Secured</td>
                <td class="block4">SGPA</td>
            </tr>
            <tr>
                <td class="block1"><?php echo $info_academic['s_sub1'] ?></td>
                <td class="block2"><?php echo $info_academic['s_theory1'] ?></td>
                <td class="block3"><?php echo $info_academic['s_practical1'] ?></td>
                <td class="block4"><?php echo $info_academic['s_total1'] ?></td>
            </tr>
            <tr>
                <td class="block1"><?php echo $info_academic['s_sub2'] ?></td>
                <td class="block2"><?php echo $info_academic['s_theory2'] ?></td>
                <td class="block3"><?php echo $info_academic['s_practical2'] ?></td>
                <td class="block4"><?php echo $info_academic['s_total2'] ?></td>
            </tr>
            <tr>
                <td class="block1"><?php echo $info_academic['s_sub3'] ?></td>
                <td class="block2"><?php echo $info_academic['s_theory3'] ?></td>
                <td class="block3"><?php echo $info_academic['s_practical3'] ?></td>
                <td class="block4"><?php echo $info_academic['s_total3'] ?></td>
            </tr>
            <tr>
                <td class="block1"><?php echo $info_academic['s_sub4'] ?></td>
                <td class="block2"><?php echo $info_academic['s_theory4'] ?></td>
                <td class="block3"><?php echo $info_academic['s_practical4'] ?></td>
                <td class="block4"><?php echo $info_academic['s_total4'] ?></td>
            </tr>
            <tr>
                <td class="block1"><?php echo $info_academic['s_sub5'] ?></td>
                <td class="block2"><?php echo $info_academic['s_theory5'] ?></td>
                <td class="block3"><?php echo $info_academic['s_practical5'] ?></td>
                <td class="block4"><?php echo $info_academic['s_total5'] ?></td>
            </tr>
            <tr>
                <td class="block1"><?php echo $info_academic['s_sub6'] ?></td>
                <td class="block2"><?php echo $info_academic['s_theory6'] ?></td>
                <td class="block3"><?php echo $info_academic['s_practical6'] ?></td>
                <td class="block4"><?php echo $info_academic['s_total6'] ?></td>
            </tr>
            <tr>
                <td class="block1"></td>
                <td class="block2"></td>
                <td class="block3">Total Marks</td>
                <td class="block4"><?php echo $info_academic['s_total'] ?></td>
            </tr>
            <tr>
                <td class="block1"></td>
                <td class="block2"></td>
                <td class="block3">Percentage</td>
                <td class="block4"><?php echo $info_academic['s_percentage'] ?></td>
            </tr>
        <?php } ?>
        </table>
        <div class="table-title">Course Details</div>
        <table class="course-details">
            <tr>
                <td class="left">Preferred Code Subject-1</td>
                <td width="right"><?php echo $info_course['s_coresubject1'] ?></td>
            </tr>
            <tr>
                <td class="left">Preferred Code Subject-2</td>
                <td width="right"><?php echo $info_course['s_coresubject2'] ?></td>
            </tr>
            <tr>
                <td class="left">Preferred Elective Subject-1</td>
                <td width="right"><?php echo $info_course['s_electivesubject1'] ?></td>
            </tr>
            <tr>
                <td class="left">Preferred Elective Subject-2</td>
                <td width="right"><?php echo $info_course['s_electivesubject2'] ?></td>
            </tr>
            <tr>
                <td class="left">Preferred Elective Subject-3</td>
                <td width="right"><?php echo $info_course['s_electivesubject3'] ?></td>
            </tr>
            <tr>
                <td class="left">Preferred Elective Subject-4</td>
                <td width="right"><?php echo $info_course['s_electivesubject4'] ?></td>
            </tr>
        </table>
        <div class="table-title">Declaration by the candidate</div>
        <table class="declaration">
            <tr>
                <td class="declaration-text" colspan="2">
                    I declare that the above entries in the Application Form have been filled up by myself and the entries made are correct as per my documents and to the best of my knowledge and belief. I agree that if any statement is proved to be false then the Authority shall have the right to take legal action against me and also cancel the application for submitting false information. I further declare that there is no allegation of misconduct against me and I have never been convicted for any offence involving moral turpitude.
                </td>
            </tr>
            <tr>
                <td class="left">Recent Passport Size Photograph</td>
                <td class="right" style="text-align: center;">
                    <img src="<?php echo $info_upload['s_passportphotograph']?>" height="120px" width="120px">
                </td>
            </tr>
            <tr>
                <td class="left">Signature</td>
                <td class="right" style="text-align: center;">
                    <img src="<?php echo $info_upload['s_signature']?>" height="80px" width="120px">
                </td>
            </tr>
        </table>
    </div>
</main>
<div class="footer">&copy; 2022 | <strong>eAdmission System</strong> | All Rights are Reserved</div>
</html>

<script src="js/upload-documents.js"></script>