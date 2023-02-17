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

    $sql_academic = "SELECT * FROM academic_details WHERE `s_id` = '$s_id'";
    $result_academic = mysqli_query($connect, $sql_academic);
    $num_academic = mysqli_num_rows($result_academic);
    $info_academic = mysqli_fetch_assoc($result_academic);

    if($info_academic['s_previousinstitution']=="" && $info_registration['s_status']=='7'){
      if(isset($_POST['s_previousinstitution']) && ($_POST['s_yearofpassing']) && ($_POST['s_boardname']) && ($_POST['s_sub1']) && ($_POST['s_total1']) && ($_POST['s_sub2']) && ($_POST['s_total2']) && ($_POST['s_sub3']) && ($_POST['s_total3']) && ($_POST['s_sub4']) && ($_POST['s_total4']) && ($_POST['s_sub5']) && ($_POST['s_total5']) && ($_POST['s_total']) && ($_POST['s_percentage'])){
        $s_previousinstitution = $_POST['s_previousinstitution'];
        $s_yearofpassing = $_POST['s_yearofpassing'];
        $s_boardname = $_POST['s_boardname'];
        $s_sub1 = $_POST['s_sub1'];
        $s_theory1 = $_POST['s_theory1'];
        $s_practical1 = $_POST['s_practical1'];
        $s_total1 = $_POST['s_total1'];
        $s_sub2 = $_POST['s_sub2'];
        $s_theory2 = $_POST['s_theory2'];
        $s_practical2 = $_POST['s_practical2'];
        $s_total2 = $_POST['s_total2'];
        $s_sub3 = $_POST['s_sub3'];
        $s_theory3 = $_POST['s_theory3'];
        $s_practical3 = $_POST['s_practical3'];
        $s_total3 = $_POST['s_total3'];
        $s_sub4 = $_POST['s_sub4'];
        $s_theory4 = $_POST['s_theory4'];
        $s_practical4 = $_POST['s_practical4'];
        $s_total4 = $_POST['s_total4'];
        $s_sub5 = $_POST['s_sub5'];
        $s_theory5 = $_POST['s_theory5'];
        $s_practical5 = $_POST['s_practical5'];
        $s_total5 = $_POST['s_total5'];
        $s_total = $_POST['s_total'];
        $s_percentage = $_POST['s_percentage'];

        if($info_registration['s_course']=="Under Graduate"){
          $sql_academic_update = "UPDATE `academic_details` SET `s_previousinstitution`='$s_previousinstitution',`s_yearofpassing`='$s_yearofpassing',`s_boardname`='$s_boardname',`s_sub1`='$s_sub1',`s_theory1`='$s_theory1',`s_practical1`='$s_practical1',`s_total1`='$s_total1',`s_sub2`='$s_sub2',`s_theory2`='$s_theory2',`s_practical2`='$s_practical2',`s_total2`='$s_total2',`s_sub3`='$s_sub3',`s_theory3`='$s_theory3',`s_practical3`='$s_practical3',`s_total3`='$s_total3',`s_sub4`='$s_sub4',`s_theory4`='$s_theory4',`s_practical4`='$s_practical4',`s_total4`='$s_total4',`s_sub5`='$s_sub5',`s_theory5`='$s_theory5',`s_practical5`='$s_practical5',`s_total5`='$s_total5',`s_total`='$s_total',`s_percentage`='$s_percentage' WHERE `s_id`='$s_id'";
          $result_academic_update = mysqli_query($connect, $sql_academic_update);
            
          $sql_registration_update = "UPDATE `registration_details` SET `s_status`='8' WHERE `s_id`='$s_id'";
          $result_registration_update = mysqli_query($connect, $sql_registration_update);
          
          if($result_academic_update && $result_registration_update){
            ?>
              <script>
                alert("Academic Details Inserted Successfully!");
                window.location.href="course-details.php";
              </script>
            <?php
          }
        }
        else{
          $s_sub6 = $_POST['s_sub6'];
          $s_theory6 = $_POST['s_theory6'];
          $s_practical6 = $_POST['s_practical6'];
          $s_total6 = $_POST['s_total6'];
  
          $sql_academic_update = "UPDATE `academic_details` SET `s_previousinstitution`='$s_previousinstitution',`s_yearofpassing`='$s_yearofpassing',`s_boardname`='$s_boardname',`s_sub1`='$s_sub1',`s_theory1`='$s_theory1',`s_practical1`='$s_practical1',`s_total1`='$s_total1',`s_sub2`='$s_sub2',`s_theory2`='$s_theory2',`s_practical2`='$s_practical2',`s_total2`='$s_total2',`s_sub3`='$s_sub3',`s_theory3`='$s_theory3',`s_practical3`='$s_practical3',`s_total3`='$s_total3',`s_sub4`='$s_sub4',`s_theory4`='$s_theory4',`s_practical4`='$s_practical4',`s_total4`='$s_total4',`s_sub5`='$s_sub5',`s_theory5`='$s_theory5',`s_practical5`='$s_practical5',`s_total5`='$s_total5',`s_sub6`='$s_sub6',`s_theory6`='$s_theory6',`s_practical6`='$s_practical6',`s_total6`='$s_total6',`s_total`='$s_total',`s_percentage`='$s_percentage' WHERE `s_id`='$s_id'";
          $result_academic_update = mysqli_query($connect, $sql_academic_update);
            
          $sql_registration_update = "UPDATE `registration_details` SET `s_status`='8' WHERE `s_id`='$s_id'";
          $result_registration_update = mysqli_query($connect, $sql_registration_update);
          
          if($result_academic_update && $result_registration_update){
            ?>
              <script>
                alert("Academic Details Inserted Successfully!");
                window.location.href="course-details.php";
              </script>
            <?php
          }
        }
      }
    }
    else {
      if(isset($_POST['submit_academic_details'])){
        ?>
          <script>
            alert("Academic Details Already Exist!");
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
    <link rel="stylesheet" href="css/academic-details.css">
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
            <li class="c-menu__item" data-toggle="tooltip" title="Additional Details">
              <div class="c-menu__item__inner"><i class="fa fa-question"></i>
                <div class="c-menu-item__title"><span>Additional Details</span></div>
              </div>
            </li>
          </a>
          <a href="academic-details.php" style="text-decoration:none">
            <li class="c-menu__item is-active" data-toggle="tooltip" title="Academic Details">
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
    <h2 class="page-title">Academic Details</h2>
    <?php if ($success == 1) { ?>
      <div class="alert alert-success alert-dismissible" role="alert">
        Academic Details submitted successfully!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php } elseif ($success == 2) { ?>
      <div class="alert alert-danger alert-dismissible" role="alert">
        Academic Details already submitted!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php } ?>
    <div class="page-content">
      <form action="academic-details.php" method="post" autocomplete="off">
        <div class="form-row">
        <div class="form-group col-md-4">
            <label for="InputPreviousInstitution">Previous Institution Name<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_academic['s_previousinstitution']=="") { ?>
              <input class="form-control" type="text" name="s_previousinstitution" required>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_previousinstitution" value="<?php echo $info_academic['s_previousinstitution'] ?>" disabled>
            <?php } ?>
            <small id="s_previousinstitutionHelpInline" class="text-muted">
              Enter the Previous Institution of student.
            </small>
          </div>
          <div class="form-group col-md-4">
            <label for="InputYearofPassing">Year of Passing<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_academic['s_yearofpassing']=="") { ?>
              <input class="form-control" type="text" name="s_yearofpassing" required>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_yearofpassing" value="<?php echo $info_academic['s_yearofpassing'] ?>" disabled>
            <?php } ?>
            <small id="yearofpassingHelpInline" class="text-muted">
              Enter the Year of Passing of student.
            </small>
          </div>
          <div class="form-group col-md-4">
            <label for="InputBoardName">Board Name<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_academic['s_boardname']=="") { ?>
              <select class="form-control" type="text" name="s_boardname" required>
                <option value="" selected disabled>Select Board Name</option>
                <?php if($info_registration['s_course']=="Higher Secondary") { ?>
                  <option value="Central Board of Secondary Education">Central Board of Secondary Education</option>
                  <option value="Secondary Education Board of Assam">Secondary Education Board of Assam</option>
                  <option value="Others">Others</option>
                <?php } elseif($info_registration['s_course']=="Under Graduate") { ?>
                  <option value="Central Board of Secondary Education">Central Board of Secondary Education</option>
                  <option value="Assam Higher Secondary Education Council">Assam Higher Secondary Education Council</option>
                  <option value="Others">Others</option>
                <?php } else { ?>
                  <option value="University Grants Commission">University Grants Commission</option>
                  <option value="Others">Others</option>
                <?php } ?>
              </select>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_boardname" value="<?php echo $info_academic['s_boardname'] ?>" disabled>
            <?php } ?>
            <small id="boardnameHelpInline" class="text-muted">
              Enter the Board Name of student.
            </small>
          </div>
        </div>
        <?php if($info_registration['s_course']=="Higher Secondary") { ?>
        <div class="form-row">
        <div class="form-group col-md-12">
            <label for="InputMarksObtained">Details of the Previous Examination<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
          </div>
        </div>
        <div class="form-row col-md-12" style="text-align: center;">
          <div class="form-group col-md-3">
            <label for="InputSubjectName">Subject Name</label>
          </div>
          <div class="form-group col-md-3">
            <label for="InputSubjectName">Theory</label>
          </div>
          <div class="form-group col-md-3">
            <label for="InputSubjectName">Practical</label>
          </div>
          <div class="form-group col-md-3">
            <label for="InputSubjectName">Total</label>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-3">
            <?php if($info_academic['s_sub1']=="") { ?>
              <select class="form-control" type="text" name="s_sub1" required>
                <option value="" selected disabled>Select Core Subject Name</option>
                <option value="English">English</option>
              </select>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_sub1" value="<?php echo $info_academic['s_sub1'] ?>" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_theory1']=="") { ?>
              <input class="form-control total_1" type="number" name="s_theory1" id="theory1" style="text-align: center;" oninput="hstotal_1()">
            <?php } else { ?>
              <input class="form-control s_theory s_theory1" type="number" name="s_theory1" value="<?php echo $info_academic['s_theory1'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_practical1']=="") { ?>
              <input class="form-control total_1" type="number" name="s_practical1" id="practical1" style="text-align: center;" oninput="hstotal_1()">
            <?php } else { ?>
              <input class="form-control s_practical s_practical1" type="number" name="s_practical1" value="<?php echo $info_academic['s_practical1'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_total1']=="") { ?>
              <input class="form-control totalmark" type="number" name="s_total1" id="s_total1" style="text-align: center;" readonly>
            <?php } else { ?>
              <input class="form-control s_total" type="number" name="s_total1" value="<?php echo $info_academic['s_total1'] ?>" id="s_total1" style="text-align: center;" disabled>
            <?php } ?>
          </div>      
        </div>
        <div class="form-row">
          <div class="form-group col-md-3">
            <?php if($info_academic['s_sub2']=="") { ?>
              <select class="form-control" type="text" name="s_sub2" required>
              <option value="" selected disabled>Select MIL Subject Name</option>
                <option value="Assamese MIL">Assamese MIL</option>
                <option value="Hindi MIL">Hindi MIL</option>
                <option value="Bodo MIL">Bodo MIL</option>
                <option value="Bengali MIL">Bengali MIL</option>
              </select>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_sub2" value="<?php echo $info_academic['s_sub2'] ?>" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_theory2']=="") { ?>
              <input class="form-control total_2" type="number" name="s_theory2" id="theory2" style="text-align: center;" oninput="hstotal_2()">
            <?php } else { ?>
              <input class="form-control" type="number" name="s_theory2" value="<?php echo $info_academic['s_theory2'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_practical2']=="") { ?>
              <input class="form-control total_2" type="number" name="s_practical2" id="practical2" style="text-align: center;" oninput="hstotal_2()">
            <?php } else { ?>
              <input class="form-control" type="number" name="s_practical2" value="<?php echo $info_academic['s_practical2'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_total2']=="") { ?>
              <input class="form-control totalmark" type="number" name="s_total2" id="s_total2" style="text-align: center;" readonly>
            <?php } else { ?>
              <input class="form-control" type="number" name="s_total2" value="<?php echo $info_academic['s_total2'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>      
        </div>        
        <div class="form-row">
          <div class="form-group col-md-3">
            <?php if($info_academic['s_sub3']=="") { ?>
              <select class="form-control" type="text" name="s_sub3" required>
              <option value="" selected disabled>Select Regular Subject Name</option>
                <option value="General Mathematics">General Mathematics</option>
              </select>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_sub3" value="<?php echo $info_academic['s_sub3'] ?>" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_theory3']=="") { ?>
              <input class="form-control total_3" type="number" name="s_theory3" id="theory3" style="text-align: center;" oninput="hstotal_3()">
            <?php } else { ?>
              <input class="form-control" type="number" name="s_theory3" value="<?php echo $info_academic['s_theory3'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_practical3']=="") { ?>
              <input class="form-control total_3" type="number" name="s_practical3" id="practical3" style="text-align: center;" oninput="hstotal_3()">
            <?php } else { ?>
              <input class="form-control" type="number" name="s_practical3" value="<?php echo $info_academic['s_practical3'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_total3']=="") { ?>
              <input class="form-control totalmark" type="number" name="s_total3" id="s_total3" style="text-align: center;" readonly>
            <?php } else { ?>
              <input class="form-control" type="number" name="s_total3" value="<?php echo $info_academic['s_total3'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>      
        </div>        
        <div class="form-row">
          <div class="form-group col-md-3">
            <?php if($info_academic['s_sub4']=="") { ?>
              <select class="form-control" type="text" name="s_sub4" required>
              <option value="" selected disabled>Select Regular Subject Name</option>
                <option value="General Science">General Science</option>
              </select>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_sub4" value="<?php echo $info_academic['s_sub4'] ?>" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_theory4']=="") { ?>
              <input class="form-control total_4" type="number" name="s_theory4" id="theory4" style="text-align: center;" oninput="hstotal_4()">
            <?php } else { ?>
              <input class="form-control" type="number" name="s_theory4" value="<?php echo $info_academic['s_theory4'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_practical4']=="") { ?>
              <input class="form-control total_4" type="number" name="s_practical4" id="practical4" style="text-align: center;" oninput="hstotal_4()">
            <?php } else { ?>
              <input class="form-control" type="number" name="s_practical4" value="<?php echo $info_academic['s_practical4'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_total4']=="") { ?>
              <input class="form-control totalmark" type="number" name="s_total4" id="s_total4" style="text-align: center;" readonly>
            <?php } else { ?>
              <input class="form-control" type="number" name="s_total4" value="<?php echo $info_academic['s_total4'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>      
        </div>        
        <div class="form-row">
          <div class="form-group col-md-3">
            <?php if($info_academic['s_sub5']=="") { ?>
              <select class="form-control" type="text" name="s_sub5" required>
              <option value="" selected disabled>Select Regular Subject Name</option>
                <option value="Social Science">Social Science</option>
              </select>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_sub5" value="<?php echo $info_academic['s_sub5'] ?>" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_theory5']=="") { ?>
              <input class="form-control total_5" type="number" name="s_theory5" id="theory5" style="text-align: center;" oninput="hstotal_5()">
            <?php } else { ?>
              <input class="form-control" type="number" name="s_theory5" value="<?php echo $info_academic['s_theory5'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_practical5']=="") { ?>
              <input class="form-control total_5" type="number" name="s_practical5" id="practical5" style="text-align: center;" oninput="hstotal_5()">
            <?php } else { ?>
              <input class="form-control" type="number" name="s_practical5" value="<?php echo $info_academic['s_practical5'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_total5']=="") { ?>
              <input class="form-control totalmark" type="number" name="s_total5" id="s_total5" style="text-align: center;" readonly>
            <?php } else { ?>
              <input class="form-control" type="number" name="s_total5" value="<?php echo $info_academic['s_total5'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>      
        </div>
        <div class="form-row">
          <div class="form-group col-md-3">
            <?php if($info_academic['s_sub6']=="") { ?>
              <select class="form-control" type="text" name="s_sub6" required>
              <option value="" selected disabled>Select Elective Subject Name</option>
                <option value="Advance Mathematics">Advance Mathematics</option>
                <option value="Computer Science & Applications">Computer Science & Applications</option>
                <option value="Sanskrit">Sanskrit</option>
                <option value="Music">Music</option>
              </select>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_sub6" value="<?php echo $info_academic['s_sub6'] ?>" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_theory6']=="") { ?>
              <input class="form-control total_6" type="number" name="s_theory6" id="theory6" style="text-align: center;" oninput="hstotal_6()">
            <?php } else { ?>
              <input class="form-control" type="number" name="s_theory6" value="<?php echo $info_academic['s_theory6'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_practical6']=="") { ?>
              <input class="form-control total_6" type="number" name="s_practical6" id="practical6" style="text-align: center;" oninput="hstotal_6()">
            <?php } else { ?>
              <input class="form-control" type="number" name="s_practical6" value="<?php echo $info_academic['s_practical6'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_total6']=="") { ?>
              <input class="form-control totalmark" type="number" name="s_total6" id="s_total6" style="text-align: center;" readonly>
            <?php } else { ?>
              <input class="form-control" type="number" name="s_total6" value="<?php echo $info_academic['s_total6'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>      
        </div>
        <div class="form-row" style="text-align: center;">
          <div class="form-group col-md-3">
          </div>
          <div class="form-group col-md-3">
          </div>
          <div class="form-group col-md-3">
            <label for="InputTotalMarks">Total Marks</label>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_total']=="") { ?>
              <input class="form-control" type="number" name="s_total" id="s_total" style="text-align: center;" readonly>
            <?php } else { ?>
              <input class="form-control" type="number" name="s_total" value="<?php echo $info_academic['s_total'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
        </div>
        <div class="form-row" style="text-align: center;">
          <div class="form-group col-md-3">
          </div>
          <div class="form-group col-md-3">
          </div>
          <div class="form-group col-md-3">
            <label for="InputPercentage">Percentage</label>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_percentage']=="") { ?>
              <input class="form-control" type="number" name="s_percentage" id="s_percentage" style="text-align: center;" readonly>
            <?php } else { ?>
              <input class="form-control" type="number" name="s_percentage" value="<?php echo $info_academic['s_percentage'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
        </div>        
        <div class="form-row">
          <!-- <div class="form-group col-md-8" style="text-align:left">
            <button type="submit" name="prev_academic_details" class="btn btn-warning">Prev</button>
            <button type="submit" name="next_academic_details" class="btn btn-info">Next</button>
          </div> -->
          <div class="form-group col-md-12" style="text-align:right">
            <button type="submit" name="academic_academic_details" class="btn btn-success">Save Academic Details</button>
          </div>
        </div>
        </div>
        <?php } elseif($info_registration['s_course']=="Under Graduate") { ?>
          <div class="form-row">
        <div class="form-group col-md-12">
            <label for="InputMarksObtained">Details of the Previous Examination<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
          </div>
        </div>
        <div class="form-row col-md-12" style="text-align: center;">
          <div class="form-group col-md-3">
            <label for="InputSubjectName">Subject Name</label>
          </div>
          <div class="form-group col-md-3">
            <label for="InputSubjectName">Theory</label>
          </div>
          <div class="form-group col-md-3">
            <label for="InputSubjectName">Practical</label>
          </div>
          <div class="form-group col-md-3">
            <label for="InputSubjectName">Total</label>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-3">
            <?php if($info_academic['s_sub1']=="") { ?>
              <select class="form-control" type="text" name="s_sub1" required>
                <option value="" selected disabled>Select Core Subject Name</option>
                <option value="English">English</option>
              </select>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_sub1" value="<?php echo $info_academic['s_sub1'] ?>" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_theory1']=="") { ?>
              <input class="form-control total_1" type="number" name="s_theory1" id="theory1" style="text-align: center;" oninput="total_1()">
            <?php } else { ?>
              <input class="form-control s_theory s_theory1" type="number" name="s_theory1" value="<?php echo $info_academic['s_theory1'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_practical1']=="") { ?>
              <input class="form-control total_1" type="number" name="s_practical1" id="practical1" style="text-align: center;" oninput="total_1()">
            <?php } else { ?>
              <input class="form-control s_practical s_practical1" type="number" name="s_practical1" value="<?php echo $info_academic['s_practical1'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_total1']=="") { ?>
              <input class="form-control totalmark" type="number" name="s_total1" id="s_total1" style="text-align: center;" readonly>
            <?php } else { ?>
              <input class="form-control s_total" type="number" name="s_total1" value="<?php echo $info_academic['s_total1'] ?>" id="s_total1" style="text-align: center;" disabled>
            <?php } ?>
          </div>      
        </div>
        <div class="form-row">
          <div class="form-group col-md-3">
            <?php if($info_academic['s_sub2']=="") { ?>
              <select class="form-control" type="text" name="s_sub2" required>
              <option value="" selected disabled>Select MIL Subject Name</option>
                <option value="Assamese MIL">Assamese MIL</option>
                <option value="Hindi MIL">Hindi MIL</option>
                <option value="Bodo MIL">Bodo MIL</option>
                <option value="Bengali MIL">Bengali MIL</option>
                <option value="Alternative English">Alternative English</option>
              </select>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_sub2" value="<?php echo $info_academic['s_sub2'] ?>" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_theory2']=="") { ?>
              <input class="form-control total_2" type="number" name="s_theory2" id="theory2" style="text-align: center;" oninput="total_2()">
            <?php } else { ?>
              <input class="form-control" type="number" name="s_theory2" value="<?php echo $info_academic['s_theory2'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_practical2']=="") { ?>
              <input class="form-control total_2" type="number" name="s_practical2" id="practical2" style="text-align: center;" oninput="total_2()">
            <?php } else { ?>
              <input class="form-control" type="number" name="s_practical2" value="<?php echo $info_academic['s_practical2'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_total2']=="") { ?>
              <input class="form-control totalmark" type="number" name="s_total2" id="s_total2" style="text-align: center;" readonly>
            <?php } else { ?>
              <input class="form-control" type="number" name="s_total2" value="<?php echo $info_academic['s_total2'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>      
        </div>        
        <div class="form-row">
          <div class="form-group col-md-3">
            <?php if($info_academic['s_sub3']=="") { ?>
              <select class="form-control" type="text" name="s_sub3" required>
              <option value="" selected disabled>Select Elective Subject Name</option>
                <option value="Physics">Physics</option>
                <option value="Chemistry">Chemistry</option>
                <option value="Mathematics">Mathematics</option>
                <option value="Biology">Biology</option>
                <option value="Computer Science & Applications">Computer Science & Applications</option>
                <option value="Geography">Geography</option>
                <option value="History">History</option>
                <option value="Political Science">Political Science</option>
                <option value="Anthropology">Anthropology</option>
                <option value="Economics">Economics</option>
                <option value="Advance Assamese">Advance Assamese</option>
                <option value="Education">Education</option>
                <option value="Sociology">Sociology</option>
                <option value="Finance/Banking">Finance/Banking</option>
                <option value="Business Mathematics & Statistics">Business Mathematics & Statistics</option>
                <option value="Business Studies">Business Studies</option>
                <option value="EDP">EDP</option>
                <option value="Accountancy">Accountancy</option>
              </select>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_sub3" value="<?php echo $info_academic['s_sub3'] ?>" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_theory3']=="") { ?>
              <input class="form-control total_3" type="number" name="s_theory3" id="theory3" style="text-align: center;" oninput="total_3()">
            <?php } else { ?>
              <input class="form-control" type="number" name="s_theory3" value="<?php echo $info_academic['s_theory3'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_practical3']=="") { ?>
              <input class="form-control total_3" type="number" name="s_practical3" id="practical3" style="text-align: center;" oninput="total_3()">
            <?php } else { ?>
              <input class="form-control" type="number" name="s_practical3" value="<?php echo $info_academic['s_practical3'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_total3']=="") { ?>
              <input class="form-control totalmark" type="number" name="s_total3" id="s_total3" style="text-align: center;" readonly>
            <?php } else { ?>
              <input class="form-control" type="number" name="s_total3" value="<?php echo $info_academic['s_total3'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>      
        </div>        
        <div class="form-row">
          <div class="form-group col-md-3">
            <?php if($info_academic['s_sub4']=="") { ?>
              <select class="form-control" type="text" name="s_sub4" required>
              <option value="" selected disabled>Select Elective Subject Name</option>
                <option value="Physics">Physics</option>
                <option value="Chemistry">Chemistry</option>
                <option value="Mathematics">Mathematics</option>
                <option value="Biology">Biology</option>
                <option value="Computer Science & Applications">Computer Science & Applications</option>
                <option value="Geography">Geography</option>
                <option value="History">History</option>
                <option value="Political Science">Political Science</option>
                <option value="Anthropology">Anthropology</option>
                <option value="Economics">Economics</option>
                <option value="Advance Assamese">Advance Assamese</option>
                <option value="Education">Education</option>
                <option value="Sociology">Sociology</option>
                <option value="Finance/Banking">Finance/Banking</option>
                <option value="Business Mathematics & Statistics">Business Mathematics & Statistics</option>
                <option value="Business Studies">Business Studies</option>
                <option value="EDP">EDP</option>
                <option value="Accountancy">Accountancy</option>
              </select>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_sub4" value="<?php echo $info_academic['s_sub4'] ?>" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_theory4']=="") { ?>
              <input class="form-control total_4" type="number" name="s_theory4" id="theory4" style="text-align: center;" oninput="total_4()">
            <?php } else { ?>
              <input class="form-control" type="number" name="s_theory4" value="<?php echo $info_academic['s_theory4'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_practical4']=="") { ?>
              <input class="form-control total_4" type="number" name="s_practical4" id="practical4" style="text-align: center;" oninput="total_4()">
            <?php } else { ?>
              <input class="form-control" type="number" name="s_practical4" value="<?php echo $info_academic['s_practical4'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_total4']=="") { ?>
              <input class="form-control totalmark" type="number" name="s_total4" id="s_total4" style="text-align: center;" readonly>
            <?php } else { ?>
              <input class="form-control" type="number" name="s_total4" value="<?php echo $info_academic['s_total4'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>      
        </div>        
        <div class="form-row">
          <div class="form-group col-md-3">
            <?php if($info_academic['s_sub5']=="") { ?>
              <select class="form-control" type="text" name="s_sub5" required>
              <option value="" selected disabled>Select Elective Subject Name</option>
              <option value="Physics">Physics</option>
                <option value="Chemistry">Chemistry</option>
                <option value="Mathematics">Mathematics</option>
                <option value="Biology">Biology</option>
                <option value="Computer Science & Applications">Computer Science & Applications</option>
                <option value="Geography">Geography</option>
                <option value="History">History</option>
                <option value="Political Science">Political Science</option>
                <option value="Anthropology">Anthropology</option>
                <option value="Economics">Economics</option>
                <option value="Advance Assamese">Advance Assamese</option>
                <option value="Education">Education</option>
                <option value="Sociology">Sociology</option>
                <option value="Finance/Banking">Finance/Banking</option>
                <option value="Business Mathematics & Statistics">Business Mathematics & Statistics</option>
                <option value="Business Studies">Business Studies</option>
                <option value="EDP">EDP</option>
                <option value="Accountancy">Accountancy</option>
              </select>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_sub5" value="<?php echo $info_academic['s_sub5'] ?>" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_theory5']=="") { ?>
              <input class="form-control total_5" type="number" name="s_theory5" id="theory5" style="text-align: center;" oninput="total_5()">
            <?php } else { ?>
              <input class="form-control" type="number" name="s_theory5" value="<?php echo $info_academic['s_theory5'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_practical5']=="") { ?>
              <input class="form-control total_5" type="number" name="s_practical5" id="practical5" style="text-align: center;" oninput="total_5()">
            <?php } else { ?>
              <input class="form-control" type="number" name="s_practical5" value="<?php echo $info_academic['s_practical5'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_total5']=="") { ?>
              <input class="form-control totalmark" type="number" name="s_total5" id="s_total5" style="text-align: center;" readonly>
            <?php } else { ?>
              <input class="form-control" type="number" name="s_total5" value="<?php echo $info_academic['s_total5'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>      
        </div>
        <div class="form-row" style="text-align: center;">
          <div class="form-group col-md-3">
          </div>
          <div class="form-group col-md-3">
          </div>
          <div class="form-group col-md-3">
            <label for="InputTotalMarks">Total Marks</label>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_total']=="") { ?>
              <input class="form-control" type="number" name="s_total" id="s_total" style="text-align: center;" readonly>
            <?php } else { ?>
              <input class="form-control" type="number" name="s_total" value="<?php echo $info_academic['s_total'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
        </div>
        <div class="form-row" style="text-align: center;">
          <div class="form-group col-md-3">
          </div>
          <div class="form-group col-md-3">
          </div>
          <div class="form-group col-md-3">
            <label for="InputPercentage">Percentage</label>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_percentage']=="") { ?>
              <input class="form-control" type="number" name="s_percentage" id="s_percentage" style="text-align: center;" readonly>
            <?php } else { ?>
              <input class="form-control" type="number" name="s_percentage" value="<?php echo $info_academic['s_percentage'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
        </div>        
        <div class="form-row">
          <!-- <div class="form-group col-md-8" style="text-align:left">
            <button type="submit" name="prev_academic_details" class="btn btn-warning">Prev</button>
            <button type="submit" name="next_academic_details" class="btn btn-info">Next</button>
          </div> -->
          <div class="form-group col-md-12" style="text-align:right">
            <button type="submit" name="submit_academic_details" class="btn btn-success">Save Academic Details</button>
          </div>
        </div>
        </div>
        <?php } if($info_registration['s_course']=="Post Graduate") { ?>
          <div class="form-row">
        <div class="form-group col-md-12">
            <label for="InputMarksObtained">Details of the Previous Examination<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
          </div>
        </div>
        <div class="form-row col-md-12" style="text-align: center;">
          <div class="form-group col-md-3">
            <label for="InputSubjectName">Semester Name</label>
          </div>
          <div class="form-group col-md-3">
            <label for="InputSubjectName">Grade Secured</label>
          </div>
          <div class="form-group col-md-3">
            <label for="InputSubjectName">Credit Secured</label>
          </div>
          <div class="form-group col-md-3">
            <label for="InputSubjectName">SGPA</label>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-3">
            <?php if($info_academic['s_sub1']=="") { ?>
              <select class="form-control" type="text" name="s_sub1" required>
                <option value="" selected disabled>Select Semester Name</option>
                <option value="Semester-1">Semester-1</option>
              </select>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_sub1" value="<?php echo $info_academic['s_sub1'] ?>" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_theory1']=="") { ?>
              <input class="form-control semtotal_1" type="number" name="s_theory1" id="semtheory_1" style="text-align: center;" oninput="semtotal_1()">
            <?php } else { ?>
              <input class="form-control s_semtheory s_semtheory1" type="number" name="s_theory1" value="<?php echo $info_academic['s_theory1'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_practical1']=="") { ?>
              <input class="form-control semtotal_1" type="number" name="s_practical1" id="sempractical_1" style="text-align: center;" oninput="semtotal_1()">
            <?php } else { ?>
              <input class="form-control s_sempractical s_sempractical1" type="number" name="s_practical1" value="<?php echo $info_academic['s_practical1'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_total1']=="") { ?>
              <input class="form-control semtotalmark" type="number" name="s_total1" id="s_semtotal1" style="text-align: center;" readonly>
            <?php } else { ?>
              <input class="form-control s_semtotal" type="number" name="s_total1" value="<?php echo $info_academic['s_total1'] ?>" id="s_semtotal1" style="text-align: center;" disabled>
            <?php } ?>
          </div>      
        </div>
        <div class="form-row">
          <div class="form-group col-md-3">
            <?php if($info_academic['s_sub2']=="") { ?>
              <select class="form-control" type="text" name="s_sub2" required>
              <option value="" selected disabled>Select Semester Name</option>
                <option value="Semester-2">Semester-2</option>
              </select>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_sub2" value="<?php echo $info_academic['s_sub2'] ?>" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_theory2']=="") { ?>
              <input class="form-control semotal_2" type="number" name="s_theory2" id="semtheory_2" style="text-align: center;" oninput="semtotal_2()">
            <?php } else { ?>
              <input class="form-control" type="number" name="s_theory2" value="<?php echo $info_academic['s_theory2'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_practical2']=="") { ?>
              <input class="form-control semtotal_2" type="number" name="s_practical2" id="sempractical_2" style="text-align: center;" oninput="semtotal_2()">
            <?php } else { ?>
              <input class="form-control" type="number" name="s_practical2" value="<?php echo $info_academic['s_practical2'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_total2']=="") { ?>
              <input class="form-control semtotalmark" type="number" name="s_total2" id="s_semtotal2" style="text-align: center;" readonly>
            <?php } else { ?>
              <input class="form-control" type="number" name="s_total2" value="<?php echo $info_academic['s_total2'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>      
        </div>        
        <div class="form-row">
          <div class="form-group col-md-3">
            <?php if($info_academic['s_sub3']=="") { ?>
              <select class="form-control" type="text" name="s_sub3" required>
              <option value="" selected disabled>Select Semester Name</option>
                <option value="Semester-3">Semester-3</option>
              </select>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_sub3" value="<?php echo $info_academic['s_sub3'] ?>" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_theory3']=="") { ?>
              <input class="form-control semtotal_3" type="number" name="s_theory3" id="semtheory_3" style="text-align: center;" oninput="semtotal_3()">
            <?php } else { ?>
              <input class="form-control" type="number" name="s_theory3" value="<?php echo $info_academic['s_theory3'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_practical3']=="") { ?>
              <input class="form-control semtotal_3" type="number" name="s_practical3" id="sempractical_3" style="text-align: center;" oninput="semtotal_3()">
            <?php } else { ?>
              <input class="form-control" type="number" name="s_practical3" value="<?php echo $info_academic['s_practical3'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_total3']=="") { ?>
              <input class="form-control semtotalmark" type="number" name="s_total3" id="s_semtotal3" style="text-align: center;" readonly>
            <?php } else { ?>
              <input class="form-control" type="number" name="s_total3" value="<?php echo $info_academic['s_total3'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>      
        </div>        
        <div class="form-row">
          <div class="form-group col-md-3">
            <?php if($info_academic['s_sub4']=="") { ?>
              <select class="form-control" type="text" name="s_sub4" required>
              <option value="" selected disabled>Select Semester Name</option>
                <option value="Semester-4">Semester-4</option>
              </select>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_sub4" value="<?php echo $info_academic['s_sub4'] ?>" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_theory4']=="") { ?>
              <input class="form-control semtotal_4" type="number" name="s_theory4" id="semtheory_4" style="text-align: center;" oninput="semtotal_4()">
            <?php } else { ?>
              <input class="form-control" type="number" name="s_theory4" value="<?php echo $info_academic['s_theory4'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_practical4']=="") { ?>
              <input class="form-control semtotal_4" type="number" name="s_practical4" id="sempractical_4" style="text-align: center;" oninput="semtotal_4()">
            <?php } else { ?>
              <input class="form-control" type="number" name="s_practical4" value="<?php echo $info_academic['s_practical4'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_total4']=="") { ?>
              <input class="form-control semtotalmark" type="number" name="s_total4" id="s_semtotal4" style="text-align: center;" readonly>
            <?php } else { ?>
              <input class="form-control" type="number" name="s_total4" value="<?php echo $info_academic['s_total4'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>      
        </div>        
        <div class="form-row">
          <div class="form-group col-md-3">
            <?php if($info_academic['s_sub5']=="") { ?>
              <select class="form-control" type="text" name="s_sub5" required>
              <option value="" selected disabled>Select Semester Name</option>
                <option value="Semester-5">Semester-5</option>
              </select>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_sub5" value="<?php echo $info_academic['s_sub5'] ?>" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_theory5']=="") { ?>
              <input class="form-control semtotal_5" type="number" name="s_theory5" id="semtheory_5" style="text-align: center;" oninput="semtotal_5()">
            <?php } else { ?>
              <input class="form-control" type="number" name="s_theory5" value="<?php echo $info_academic['s_theory5'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_practical5']=="") { ?>
              <input class="form-control semtotal_5" type="number" name="s_practical5" id="sempractical_5" style="text-align: center;" oninput="semtotal_5()">
            <?php } else { ?>
              <input class="form-control" type="number" name="s_practical5" value="<?php echo $info_academic['s_practical5'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_total5']=="") { ?>
              <input class="form-control semtotalmark" type="number" name="s_total5" id="s_semtotal5" style="text-align: center;" readonly>
            <?php } else { ?>
              <input class="form-control" type="number" name="s_total5" value="<?php echo $info_academic['s_total5'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>      
        </div>
        <div class="form-row">
          <div class="form-group col-md-3">
            <?php if($info_academic['s_sub6']=="") { ?>
              <select class="form-control" type="text" name="s_sub6" required>
              <option value="" selected disabled>Select Semester Name</option>
                <option value="Semester-6">Semester-6</option>
              </select>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_sub6" value="<?php echo $info_academic['s_sub6'] ?>" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_theory6']=="") { ?>
              <input class="form-control semtotal_6" type="number" name="s_theory6" id="semtheory_6" style="text-align: center;" oninput="semtotal_6()">
            <?php } else { ?>
              <input class="form-control" type="number" name="s_theory6" value="<?php echo $info_academic['s_theory6'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_practical6']=="") { ?>
              <input class="form-control semtotal_6" type="number" name="s_practical6" id="sempractical_6" style="text-align: center;" oninput="semtotal_6()">
            <?php } else { ?>
              <input class="form-control" type="number" name="s_practical6" value="<?php echo $info_academic['s_practical6'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_total6']=="") { ?>
              <input class="form-control semtotalmark" type="number" name="s_total6" id="s_semtotal6" style="text-align: center;" readonly>
            <?php } else { ?>
              <input class="form-control" type="number" name="s_total6" value="<?php echo $info_academic['s_total6'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>      
        </div>
        <div class="form-row" style="text-align: center;">
          <div class="form-group col-md-3">
          </div>
          <div class="form-group col-md-3">
          </div>
          <div class="form-group col-md-3">
            <label for="InputTotalMarks">CGPA</label>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_total']=="") { ?>
              <input class="form-control" type="number" name="s_total" id="s_semtotal" style="text-align: center;" readonly>
            <?php } else { ?>
              <input class="form-control" type="number" name="s_total" value="<?php echo $info_academic['s_total'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
        </div>
        <div class="form-row" style="text-align: center;">
          <div class="form-group col-md-3">
          </div>
          <div class="form-group col-md-3">
          </div>
          <div class="form-group col-md-3">
            <label for="InputPercentage">Percentage</label>
          </div>
          <div class="form-group col-md-3">
            <?php if($info_academic['s_percentage']=="") { ?>
              <input class="form-control" type="number" name="s_percentage" id="s_sempercentage" style="text-align: center;" readonly>
            <?php } else { ?>
              <input class="form-control" type="number" name="s_percentage" value="<?php echo $info_academic['s_percentage'] ?>" style="text-align: center;" disabled>
            <?php } ?>
          </div>
        </div>        
        <div class="form-row">
          <!-- <div class="form-group col-md-8" style="text-align:left">
            <button type="submit" name="prev_academic_details" class="btn btn-warning">Prev</button>
            <button type="submit" name="next_academic_details" class="btn btn-info">Next</button>
          </div> -->
          <div class="form-group col-md-12" style="text-align:right">
            <button type="submit" name="submit_academic_details" class="btn btn-success">Save Academic Details</button>
          </div>
        </div>
        </div>
        <?php } ?>
      </form>
    </div>
  </div>
</main>
<div class="footer">&copy; 2022 | <strong>eAdmission System</strong> | All Rights are Reserved</div>
</html>

<script src="js/academic-details.js"></script>