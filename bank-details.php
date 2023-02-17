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

    $sql_bank = "SELECT * FROM bank_details WHERE `s_id` = '$s_id'";
    $result_bank = mysqli_query($connect, $sql_bank);
    $num_bank = mysqli_num_rows($result_bank);
    $info_bank = mysqli_fetch_assoc($result_bank);
    
    if($info_bank['s_bankname']=="" && $info_registration['s_status']=='5') {
      if(isset($_POST['s_bankname']) && ($_POST['s_branchname']) && ($_POST['s_beneficiaryname']) && ($_POST['s_accountno']) && ($_POST['s_confirmaccountno']) && ($_POST['s_ifsccode'])){
        $s_bankname = $_POST['s_bankname'];
        $s_branchname = $_POST['s_branchname'];
        $s_beneficiaryname = $_POST['s_beneficiaryname'];
        $s_accountno = $_POST['s_accountno'];
        $s_confirmaccountno = $_POST['s_confirmaccountno'];
        $s_ifsccode = $_POST['s_ifsccode'];
               
        if($s_accountno === $s_confirmaccountno){

          $sql_bank_update = "UPDATE `bank_details` SET `s_bankname`='$s_bankname',`s_branchname`='$s_branchname',`s_beneficiaryname`='$s_beneficiaryname', `s_confirmaccountno`='$s_confirmaccountno', `s_accountno`='$s_accountno',`s_ifsccode`='$s_ifsccode' WHERE `s_id`='$s_id'";
          $result_bank_update = mysqli_query($connect, $sql_bank_update);

          $sql_registration_update = "UPDATE `registration_details` SET `s_status`='6' WHERE `s_id`='$s_id'";
          $result_registration_update = mysqli_query($connect, $sql_registration_update);      

          if($result_bank_update && $result_registration_update){
            ?>
            <script>
              alert("Bank Details Inserted Successfully!");
              window.location.href="additional-details.php";
            </script>
            <?php 
          }
        }
        else{
          ?>
            <script>
              alert("Account number doesn't matched!");
              window.location.href="bank-details.php";
            </script>
            <?php
        }
      }
    }
    else {
      if(isset($_POST['submit_bank_details'])){
        ?>
          <script>
            alert("Bank Details Already Exist!");
            window.location.href="bank-details.php";
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
    <link rel="stylesheet" href="css/bank-details.css">
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
            <li class="c-menu__item is-active" data-toggle="tooltip" title="Bank Details">
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
    <h2 class="page-title">Bank Details</h2>
    <?php if ($success == 1) { ?>
      <div class="alert alert-success alert-dismissible" role="alert">
        Bank Details submitted successfully!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php } elseif ($success == 2) { ?>
      <div class="alert alert-danger alert-dismissible" role="alert">
        Bank Details already submitted!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php } ?>
    <div class="page-content">
      <form action="bank-details.php" method="post" autocomplete="off">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="InputBankName">Bank Name<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_bank['s_bankname']=="") { ?>
              <select class="form-control" type="text" name="s_bankname" required>
              <option value="" selected disabled>Select Bank Name</option>
                <option value="Allahabad Bank">Allahabad Bank</option>
                <option value="Andhra Bank">Andhra Bank</option>
                <option value="Axis Bank">Axis Bank</option>
                <option value="State Bank of India">State Bank of India</option>
                <option value="Bank of Baroda">Bank of Baroda</option>
                <option value="UCO Bank">UCO Bank</option>
                <option value="Union Bank of India">Union Bank of India</option>
                <option value="Bank of India">Bank of India</option>
                <option value="Bandhan Bank Ltd">Bandhan Bank Ltd</option>
                <option value="Canara Bank">Canara Bank</option>
                <option value="Gramin Vikash Bank">Gramin Vikash Bank</option>
                <option value="Corporation Bank">Corporation Bank</option>
                <option value="Indian Bank">Indian Bank</option>
                <option value="Indian Overseas Bank">Indian Overseas Bank</option>
                <option value="Oriental Bank of Commerce">Oriental Bank of Commerce</option>
                <option value="Punjab and Sind Bank">Punjab and Sind Bank</option>
                <option value="Punjab National Bank">Punjab National Bank</option>
                <option value="Reserve Bank of India">Reserve Bank of India</option>
                <option value="South Indian Bank">South Indian Bank</option>
                <option value="United Bank of India">United Bank of India</option>
                <option value="Central Bank of India">Central Bank of India</option>
                <option value="Vijaya Bank">Vijaya Bank</option>
                <option value="Dena Bank">Dena Bank</option>
                <option value="Bharatiya Mahila Bank Ltd">Bharatiya Mahila Bank Ltd</option>
                <option value="Federal Bank Ltd">Federal Bank Ltd</option>
                <option value="HDFC Bank Ltd">HDFC Bank Ltd</option>
                <option value="ICICI Bank Ltd">ICICI Bank Ltd</option>
                <option value="IDBI Bank Ltd">IDBI Bank Ltd</option>
                <option value="PayTM Payment Bank">PayTM Payment Bank</option>
                <option value="Fino Payment Bank">Fino Payment Bank</option>
                <option value="Indusind Bank Ltd">Indusind Bank Ltd</option>
                <option value="Karnataka Bank Ltd">Karnataka Bank Ltd</option>
                <option value="Kotak Mahindra Bank">Kotak Mahindra Bank</option>
                <option value="Yes Bank Ltd">Yes Bank Ltd</option>
                <option value="Syndicate Bank">Syndicate Bank</option>
                <option value="Bank of India">Bank of India</option>
                <option value="Bank of Maharashtra">Bank of Maharashtra/option>
              </select>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_bankname" value="<?php echo $info_bank['s_bankname'] ?>" disabled>
            <?php } ?>
            <small id="banknameHelpInline" class="text-muted">
              Enter the Bank Name of student.
            </small>
          </div>
          <div class="form-group col-md-4">
            <label for="InputBranchName">Branch Name<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_bank['s_branchname']=="") { ?>
              <input class="form-control" type="text" name="s_branchname" required>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_branchname" value="<?php echo $info_bank['s_branchname'] ?>" disabled>
            <?php } ?>
            <small id="branchnameHelpInline" class="text-muted">
              Enter the Branch Name of student.
            </small>
          </div>
          <div class="form-group col-md-4">
            <label for="InputBeneficiaryName">Beneficiary Name<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
              <input class="form-control" type="text" name="s_beneficiaryname" value="<?php echo $info_bank['s_name'] ?>" readonly>
            <small id="beneficiarynameHelpInline" class="text-muted">
              Enter the Beneficiary Name of student.
            </small>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="InputAccountNo">Account No<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_bank['s_accountno']=="") { ?>
              <input class="form-control" type="number" name="s_accountno" required>
            <?php } else { ?>
              <input class="form-control" type="number" name="s_accountno" value="<?php echo $info_bank['s_accountno'] ?>" disabled>
            <?php } ?>
            <small id="accountnoHelpInline" class="text-muted">
              Enter the Account No of student.
            </small>
          </div>
          <div class="form-group col-md-4">
            <label for="InputConfirmAccountNo">Confirm Account No<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_bank['s_accountno']=="") { ?>
              <input class="form-control" type="number" name="s_confirmaccountno" required>
            <?php } else { ?>
              <input class="form-control" type="number" name="s_confirmaccountno" value="<?php echo $info_bank['s_confirmaccountno'] ?>" disabled>
            <?php } ?>
            <small id="confirmaccountnoHelpInline" class="text-muted">
              Enter the Confirm Account No of student.
            </small>
          </div>
          <div class="form-group col-md-4">
            <label for="InputIFSCCode">IFSC Code<span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            <?php if($info_bank['s_ifsccode']=="") { ?>
              <input class="form-control" type="text" name="s_ifsccode" pattern="[A-Z]{4}[0-9]{7}" required>
            <?php } else { ?>
              <input class="form-control" type="text" name="s_ifsccode" value="<?php echo $info_bank['s_ifsccode'] ?>" disabled>
            <?php } ?>
            <small id="ifsccodeHelpInline" class="text-muted">
              Enter the 11 Digit IFSC Code of student.
            </small>
          </div>
        </div>
        <div class="form-row">
          <!-- <div class="form-group col-md-8" style="text-align:left">
            <button type="submit" name="prev_bank_details" class="btn btn-warning">Prev</button>
            <button type="submit" name="next_bank_details" class="btn btn-info">Next</button>
          </div> -->
          <div class="form-group col-md-12" style="text-align:right">
            <button type="submit" name="submit_bank_details" class="btn btn-success">Save Bank Details</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</main>
<div class="footer">&copy; 2022 | <strong>eAdmission System</strong> | All Rights are Reserved</div>
</html>

<script src="js/bank-details.js"></script>