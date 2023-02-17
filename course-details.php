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
    
    $sql_course = "SELECT * FROM course_details WHERE `s_id` = '$s_id'";
    $result_course = mysqli_query($connect, $sql_course);
    $num_course = mysqli_num_rows($result_course);
    $info_course = mysqli_fetch_assoc($result_course);

    if($info_course['s_coresubject1']=="" && $info_registration['s_status']=='8'){
        if(isset($_POST['s_coresubject1']) && ($_POST['s_coresubject2']) && ($_POST['s_electivesubject1']) && ($_POST['s_electivesubject2']) && ($_POST['s_electivesubject3']) && ($_POST['s_electivesubject4'])){
            $s_coresubject1 = $_POST['s_coresubject1'];
            $s_coresubject2 = $_POST['s_coresubject2'];
            $s_electivesubject1 = $_POST['s_electivesubject1'];
            $s_electivesubject2 = $_POST['s_electivesubject2'];
            $s_electivesubject3 = $_POST['s_electivesubject3'];
            $s_electivesubject4 = $_POST['s_electivesubject4'];

            $sql_course_update = "UPDATE `course_details` SET `s_coresubject1`='$s_coresubject1',`s_coresubject2`='$s_coresubject2',`s_electivesubject1`='$s_electivesubject1', `s_electivesubject2`='$s_electivesubject2', `s_electivesubject3`='$s_electivesubject3', `s_electivesubject4`='$s_electivesubject4' WHERE `s_id`='$s_id'";
            $result_course_update = mysqli_query($connect, $sql_course_update);
  
            $sql_registration_update = "UPDATE `registration_details` SET `s_status`='9' WHERE `s_id`='$s_id'";
            $result_registration_update = mysqli_query($connect, $sql_registration_update);

            if($result_course_update && $result_registration_update){
                ?>
                <script>
                  alert("Course Details Inserted Successfully!");
                  window.location.href="upload-documents.php";
                </script>
                <?php
              }  
        }
    }
    else{
      if(isset($_POST['submit_course_details'])){
        ?>
          <script>
            alert("Course Details Already Exist!");
            window.location.href="course-details.php";
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
    <link rel="stylesheet" href="css/course-details.css">
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
            <li class="c-menu__item" data-toggle="tooltip" title="Academic Details">
              <div class="c-menu__item__inner"><i class="fa fa-graduation-cap"></i>
                <div class="c-menu-item__title"><span>Academic Details</span></div>
              </div>
            </li>
          </a>
          <a href="course-details.php" style="text-decoration:none">
            <li class="c-menu__item is-active" data-toggle="tooltip" title="Course Details">
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
    <h2 class="page-title">Course Details</h2>
    <?php if ($success == 1) { ?>
      <div class="alert alert-success alert-dismissible" role="alert">
        Course Details submitted successfully!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php } elseif ($success == 2) { ?>
      <div class="alert alert-danger alert-dismissible" role="alert">
        Course Details already submitted!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php } ?>
    <div class="page-content">
      <form action="course-details.php" method="post" autocomplete="off">
        <div class="form-row col-md-12">
          <div class="form-group col-md-2">
          </div>
          <div class="form-group col-md-4">
          <label for="InputSelectSubjects">Select Subjects for the Course <span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
          </div>
          <div class="form-group col-md-4">
          </div>
          <div class="form-group col-md-2">
          </div>
        </div>
        <?php if($info_registration['s_course']=="Higher Secondary") { ?>
        <div class="form-row col-md-12">
            <div class="form-group col-md-2">
            </div>
            <div class="form-group col-md-4">
                <span id="CoreSubject1Helpline">Core Subject - 1<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
            </div>
            <div class="form-group col-md-4">
            <?php if($info_course['s_coresubject1']=="") { ?>
                <select class="form-control" type="text" name="s_coresubject1" required>
                    <option value="" selected disabled>Select Core Subject - 1</option>
                    <option value="English">English</option>
                </select>
            <?php } else { ?>
                <input class="form-control" type="text" name="s_coresubject1" value="<?php echo $info_course['s_coresubject1'] ?>" disabled>
            <?php } ?>
            </div>
            <div class="form-group col-md-2">
            </div>
        </div>
        <div class="form-row col-md-12">
            <div class="form-group col-md-2">
            </div>
            <div class="form-group col-md-4">
                <span id="CoreSubject2Helpline">Core Subject - 2<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
            </div>
            <div class="form-group col-md-4">
            <?php if($info_course['s_coresubject2']=="") { ?>
                <select class="form-control" type="text" name="s_coresubject2" required>
                    <option value="" selected disabled>Select Core Subject - 2</option>
                    <option value="Assamese MIL">Assamese MIL</option>
                    <option value="Hindi MIL">Hindi MIL</option>
                    <option value="Bodo MIL">Bodo MIL</option>
                    <option value="Bengali MIL">Bengali MIL</option>
                    <option value="Alternative English">Alternative English</option>
                </select>
            <?php } else { ?>
                <input class="form-control" type="text" name="s_coresubject2" value="<?php echo $info_course['s_coresubject2'] ?>" disabled>
            <?php } ?>
            </div>
            <div class="form-group col-md-2">
            </div>
        </div>
        <div class="form-row col-md-12">
            <div class="form-group col-md-2">
            </div>
            <div class="form-group col-md-4">
                <span id="ElectiveSubject1Helpline">Elective Subject - 1<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
            </div>
            <div class="form-group col-md-4">
            <?php if($info_course['s_electivesubject1']=="") { ?>
                <select class="form-control" type="text" name="s_electivesubject1" required>
                    <option value="" selected disabled>Select Elective Subject - 1</option>
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
                <input class="form-control" type="text" name="s_electivesubject1" value="<?php echo $info_course['s_electivesubject1'] ?>" disabled>
            <?php } ?>
            </div>
            <div class="form-group col-md-2">
            </div>
        </div>
        <div class="form-row col-md-12">
            <div class="form-group col-md-2">
            </div>
            <div class="form-group col-md-4">
                <span id="ElectiveSubject2Helpline">Elective Subject - 2<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
            </div>
            <div class="form-group col-md-4">
            <?php if($info_course['s_electivesubject2']=="") { ?>
                <select class="form-control" type="text" name="s_electivesubject2" required>
                    <option value="" selected disabled>Select Elective Subject - 2</option>
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
                <input class="form-control" type="text" name="s_electivesubject2" value="<?php echo $info_course['s_electivesubject2'] ?>" disabled>
            <?php } ?>
            </div>
            <div class="form-group col-md-2">
            </div>
        </div>
        <div class="form-row col-md-12">
            <div class="form-group col-md-2">
            </div>
            <div class="form-group col-md-4">
                <span id="ElectiveSubject3Helpline">Elective Subject - 3<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
            </div>
            <div class="form-group col-md-4">
            <?php if($info_course['s_electivesubject3']=="") { ?>
                <select class="form-control" type="text" name="s_electivesubject3" required>
                    <option value="" selected disabled>Select Elective Subject - 3</option>
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
                <input class="form-control" type="text" name="s_electivesubject3" value="<?php echo $info_course['s_electivesubject3'] ?>" disabled>
            <?php } ?>
            </div>
            <div class="form-group col-md-2">
            </div>
        </div>
        <div class="form-row col-md-12">
            <div class="form-group col-md-2">
            </div>
            <div class="form-group col-md-4">
                <span id="ElectiveSubject4Helpline">Elective Subject - 4<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
            </div>
            <div class="form-group col-md-4">
            <?php if($info_course['s_electivesubject4']=="") { ?>
                <select class="form-control" type="text" name="s_electivesubject4" required>
                    <option value="" selected disabled>Select Elective Subject - 4</option>
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
                <input class="form-control" type="text" name="s_electivesubject4" value="<?php echo $info_course['s_electivesubject4'] ?>" disabled>
            <?php } ?>
            </div>
            <div class="form-group col-md-2">
            </div>
        </div>
        <?php } elseif($info_registration['s_course']=="Under Graduate") { ?>
        <div class="form-row col-md-12">
            <div class="form-group col-md-2">
            </div>
            <div class="form-group col-md-4">
                <span id="CoreSubject1Helpline">Core Subject - 1<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
            </div>
            <div class="form-group col-md-4">
            <?php if($info_course['s_coresubject1']=="") { ?>
                <select class="form-control" type="text" name="s_coresubject1" required>
                    <option value="" selected disabled>Select Core Subject - 1</option>
                    <option value="English">English</option>
                </select>
            <?php } else { ?>
                <input class="form-control" type="text" name="s_coresubject1" value="<?php echo $info_course['s_coresubject1'] ?>" disabled>
            <?php } ?>
            </div>
            <div class="form-group col-md-2">
            </div>
        </div>
        <div class="form-row col-md-12">
            <div class="form-group col-md-2">
            </div>
            <div class="form-group col-md-4">
                <span id="CoreSubject2Helpline">Core Subject - 2<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
            </div>
            <div class="form-group col-md-4">
            <?php if($info_course['s_coresubject2']=="") { ?>
                <select class="form-control" type="text" name="s_coresubject2" required>
                    <option value="" selected disabled>Select Core Subject - 2</option>
                    <option value="Assamese MIL">Assamese MIL</option>
                    <option value="Hindi MIL">Hindi MIL</option>
                    <option value="Bodo MIL">Bodo MIL</option>
                    <option value="Bengali MIL">Bengali MIL</option>
                    <option value="Alternative English">Alternative English</option>
                </select>
            <?php } else { ?>
                <input class="form-control" type="text" name="s_coresubject2" value="<?php echo $info_course['s_coresubject2'] ?>" disabled>
            <?php } ?>
            </div>
            <div class="form-group col-md-2">
            </div>
        </div>
        <div class="form-row col-md-12">
            <div class="form-group col-md-2">
            </div>
            <div class="form-group col-md-4">
                <span id="ElectiveSubject1Helpline">Elective Subject - 1<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
            </div>
            <div class="form-group col-md-4">
            <?php if($info_course['s_electivesubject1']=="") { ?>
                <select class="form-control" type="text" name="s_electivesubject1" required>
                    <option value="" selected disabled>Select Elective Subject - 1</option>
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
                <input class="form-control" type="text" name="s_electivesubject1" value="<?php echo $info_course['s_electivesubject1'] ?>" disabled>
            <?php } ?>
            </div>
            <div class="form-group col-md-2">
            </div>
        </div>
        <div class="form-row col-md-12">
            <div class="form-group col-md-2">
            </div>
            <div class="form-group col-md-4">
                <span id="ElectiveSubject2Helpline">Elective Subject - 2<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
            </div>
            <div class="form-group col-md-4">
            <?php if($info_course['s_electivesubject2']=="") { ?>
                <select class="form-control" type="text" name="s_electivesubject2" required>
                    <option value="" selected disabled>Select Elective Subject - 2</option>
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
                <input class="form-control" type="text" name="s_electivesubject2" value="<?php echo $info_course['s_electivesubject2'] ?>" disabled>
            <?php } ?>
            </div>
            <div class="form-group col-md-2">
            </div>
        </div>
        <div class="form-row col-md-12">
            <div class="form-group col-md-2">
            </div>
            <div class="form-group col-md-4">
                <span id="ElectiveSubject3Helpline">Elective Subject - 3<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
            </div>
            <div class="form-group col-md-4">
            <?php if($info_course['s_electivesubject3']=="") { ?>
                <select class="form-control" type="text" name="s_electivesubject3" required>
                    <option value="" selected disabled>Select Elective Subject - 3</option>
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
                <input class="form-control" type="text" name="s_electivesubject3" value="<?php echo $info_course['s_electivesubject3'] ?>" disabled>
            <?php } ?>
            </div>
            <div class="form-group col-md-2">
            </div>
        </div>
        <div class="form-row col-md-12">
            <div class="form-group col-md-2">
            </div>
            <div class="form-group col-md-4">
                <span id="ElectiveSubject4Helpline">Elective Subject - 4<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
            </div>
            <div class="form-group col-md-4">
            <?php if($info_course['s_electivesubject4']=="") { ?>
                <select class="form-control" type="text" name="s_electivesubject4" required>
                    <option value="" selected disabled>Select Elective Subject - 4</option>
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
                <input class="form-control" type="text" name="s_electivesubject4" value="<?php echo $info_course['s_electivesubject4'] ?>" disabled>
            <?php } ?>
            </div>
            <div class="form-group col-md-2">
            </div>
        </div>
        <?php } else { ?>
        <div class="form-row col-md-12">
            <div class="form-group col-md-2">
            </div>
            <div class="form-group col-md-4">
                <span id="CoreSubject1Helpline">Core Subject - 1<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
            </div>
            <div class="form-group col-md-4">
            <?php if($info_course['s_coresubject1']=="") { ?>
                <select class="form-control" type="text" name="s_coresubject1" required>
                    <option value="" selected disabled>Select Core Subject - 1</option>
                    <option value="English">English</option>
                </select>
            <?php } else { ?>
                <input class="form-control" type="text" name="s_coresubject1" value="<?php echo $info_course['s_coresubject1'] ?>" disabled>
            <?php } ?>
            </div>
            <div class="form-group col-md-2">
            </div>
        </div>
        <div class="form-row col-md-12">
            <div class="form-group col-md-2">
            </div>
            <div class="form-group col-md-4">
                <span id="CoreSubject2Helpline">Core Subject - 2<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
            </div>
            <div class="form-group col-md-4">
            <?php if($info_course['s_coresubject2']=="") { ?>
                <select class="form-control" type="text" name="s_coresubject2" required>
                    <option value="" selected disabled>Select Core Subject - 2</option>
                    <option value="Assamese MIL">Assamese MIL</option>
                    <option value="Hindi MIL">Hindi MIL</option>
                    <option value="Bodo MIL">Bodo MIL</option>
                    <option value="Bengali MIL">Bengali MIL</option>
                    <option value="Alternative English">Alternative English</option>
                </select>
            <?php } else { ?>
                <input class="form-control" type="text" name="s_coresubject2" value="<?php echo $info_course['s_coresubject2'] ?>" disabled>
            <?php } ?>
            </div>
            <div class="form-group col-md-2">
            </div>
        </div>
        <div class="form-row col-md-12">
            <div class="form-group col-md-2">
            </div>
            <div class="form-group col-md-4">
                <span id="ElectiveSubject1Helpline">Elective Subject - 1<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
            </div>
            <div class="form-group col-md-4">
            <?php if($info_course['s_electivesubject1']=="") { ?>
                <select class="form-control" type="text" name="s_electivesubject1" required>
                    <option value="" selected disabled>Select Elective Subject - 1</option>
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
                <input class="form-control" type="text" name="s_electivesubject1" value="<?php echo $info_course['s_electivesubject1'] ?>" disabled>
            <?php } ?>
            </div>
            <div class="form-group col-md-2">
            </div>
        </div>
        <div class="form-row col-md-12">
            <div class="form-group col-md-2">
            </div>
            <div class="form-group col-md-4">
                <span id="ElectiveSubject2Helpline">Elective Subject - 2<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
            </div>
            <div class="form-group col-md-4">
            <?php if($info_course['s_electivesubject2']=="") { ?>
                <select class="form-control" type="text" name="s_electivesubject2" required>
                    <option value="" selected disabled>Select Elective Subject - 2</option>
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
                <input class="form-control" type="text" name="s_electivesubject2" value="<?php echo $info_course['s_electivesubject2'] ?>" disabled>
            <?php } ?>
            </div>
            <div class="form-group col-md-2">
            </div>
        </div>
        <div class="form-row col-md-12">
            <div class="form-group col-md-2">
            </div>
            <div class="form-group col-md-4">
                <span id="ElectiveSubject3Helpline">Elective Subject - 3<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
            </div>
            <div class="form-group col-md-4">
            <?php if($info_course['s_electivesubject3']=="") { ?>
                <select class="form-control" type="text" name="s_electivesubject3" required>
                    <option value="" selected disabled>Select Elective Subject - 3</option>
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
                <input class="form-control" type="text" name="s_electivesubject3" value="<?php echo $info_course['s_electivesubject3'] ?>" disabled>
            <?php } ?>
            </div>
            <div class="form-group col-md-2">
            </div>
        </div>
        <div class="form-row col-md-12">
            <div class="form-group col-md-2">
            </div>
            <div class="form-group col-md-4">
                <span id="ElectiveSubject4Helpline">Elective Subject - 4<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
            </div>
            <div class="form-group col-md-4">
            <?php if($info_course['s_electivesubject4']=="") { ?>
                <select class="form-control" type="text" name="s_electivesubject4" required>
                    <option value="" selected disabled>Select Elective Subject - 4</option>
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
                <input class="form-control" type="text" name="s_electivesubject4" value="<?php echo $info_course['s_electivesubject4'] ?>" disabled>
            <?php } ?>
            </div>
            <div class="form-group col-md-2">
            </div>
        </div>
        <?php } ?>
        <div class="form-row">
          <!-- <div class="form-group col-md-8" style="text-align:left">
            <button type="submit" name="prev_course_details" class="btn btn-warning">Prev</button>
            <button type="submit" name="next_course_details" class="btn btn-info">Next</button>
          </div> -->
          <div class="form-group col-md-12" style="text-align:right">
            <button type="submit" name="submit_course_details" class="btn btn-success">Save Course Details</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</main>
<div class="footer">&copy; 2022 | <strong>eAdmission System</strong> | All Rights are Reserved</div>
</html>

<script src="js/course-details.js"></script>

