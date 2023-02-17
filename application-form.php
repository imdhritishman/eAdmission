<?php
    require("connection.php");
    require("header.php");
    $page_title = "Application Form";
    $year = date("Y");

    if(((isset($_SESSION['s_id'])) || (isset($_SESSION['ins_id']))) && (isset($_GET['std_id'])) && (isset($_GET['s_aplno'])) && (isset($_GET['sl']))){
        $std_id = $_GET['std_id'];
        $sl = $_GET['sl'];
        $s_aplno = $_GET['s_aplno'];
        $sql_registration = "SELECT * FROM registration_details WHERE `s_id` = '$std_id'";
        $result_registration = mysqli_query($connect, $sql_registration);
        $num_registration = mysqli_num_rows($result_registration);
        $info_registration = mysqli_fetch_assoc($result_registration);
    }
    else{
        ?>
        <script>
            // alert("No Session");
            window.location.href="logout.php";
        </script>
        <?php
    }

    $sql_residential = "SELECT * FROM residential_details WHERE `s_id` = '$std_id'";
    $result_residential = mysqli_query($connect, $sql_residential);
    $num_residential = mysqli_num_rows($result_residential);
    $info_residential = mysqli_fetch_assoc($result_residential);

    $sql_personal = "SELECT * FROM personal_details WHERE `s_id` = '$std_id'";
    $result_personal = mysqli_query($connect, $sql_personal);
    $num_personal = mysqli_num_rows($result_personal);
    $info_personal = mysqli_fetch_assoc($result_personal);

    $sql_family = "SELECT * FROM family_details WHERE `s_id` = '$std_id'";
    $result_family = mysqli_query($connect, $sql_family);
    $num_family = mysqli_num_rows($result_family);
    $info_family = mysqli_fetch_assoc($result_family);

    $sql_bank = "SELECT * FROM bank_details WHERE `s_id` = '$std_id'";
    $result_bank = mysqli_query($connect, $sql_bank);
    $num_bank = mysqli_num_rows($result_bank);
    $info_bank = mysqli_fetch_assoc($result_bank);

    $sql_additional = "SELECT * FROM additional_details WHERE `s_id` = '$std_id'";
    $result_additional = mysqli_query($connect, $sql_additional);
    $num_additional = mysqli_num_rows($result_additional);
    $info_additional = mysqli_fetch_assoc($result_additional);

    $sql_academic = "SELECT * FROM academic_details WHERE `s_id` = '$std_id'";
    $result_academic = mysqli_query($connect, $sql_academic);
    $num_academic = mysqli_num_rows($result_academic);
    $info_academic = mysqli_fetch_assoc($result_academic);

    $sql_course = "SELECT * FROM course_details WHERE `s_id` = '$std_id'";
    $result_course = mysqli_query($connect, $sql_course);
    $num_course = mysqli_num_rows($result_course);
    $info_course = mysqli_fetch_assoc($result_course);

    $sql_upload = "SELECT * FROM upload_documents WHERE `s_id` = '$std_id'";
    $result_upload = mysqli_query($connect, $sql_upload);
    $num_upload = mysqli_num_rows($result_upload);
    $info_upload = mysqli_fetch_assoc($result_upload);

    $sql_application = "SELECT `s_aplno1`,`s_aplno2`,`s_aplno3` FROM `registration_details` WHERE `s_id`='$std_id'";
    $result_application = mysqli_query($connect, $sql_application);
    $num_application = mysqli_num_fields($result_application);
    $info_application = mysqli_fetch_assoc($result_application);

    if($sl==1){
        $ins_name = $info_registration['s_institute1'];
    }elseif($sl==2){
        $ins_name = $info_registration['s_institute2'];
    }else{
        $ins_name = $info_registration['s_institute3'];
    }
    $sql_institute = "SELECT * FROM institute WHERE `ins_name` = '$ins_name'";
    $result_institute = mysqli_query($connect, $sql_institute);
    $num_institute = mysqli_num_rows($result_institute);
    $info_institute = mysqli_fetch_assoc($result_institute);

    if($sl==1){
        $s_aplstatus = $info_registration['s_aplstatus1'];
    }elseif($sl==2){
        $s_aplstatus = $info_registration['s_aplstatus2'];
    }else{
        $s_aplstatus = $info_registration['s_aplstatus3'];
    }

    if($s_aplstatus==0){
        $aplstatus = "Pending";
    }elseif($s_aplstatus==1){
        $aplstatus = "Verified";
    }elseif($s_aplstatus==2){
        $aplstatus = "Rejected";
    }elseif($s_aplstatus==3){
        $aplstatus = "Admission Confirmed";
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
    <link rel="stylesheet" href="css/application-form.css">
</head>
<body>
    <div class="page-header">
        <div class="page-title-logo">
            <img class="page-title-logo-image" src="<?php echo $info_institute['ins_logo'] ?>" alt="Logo">
        </div>
        <div class="page-title-text">
            <span style="font-weight: bold; font-size:large;"><?php echo $ins_name ?> - eAdmission</span><br>
            <span style=""><?php echo $info_institute['ins_address'] ?></span><br>
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
                <?php if($sl==1) { ?>
                    <td class="right"><?php echo $info_registration['s_aplno1'] ?></td>
                <?php } elseif($sl==2) { ?>
                    <td class="right"><?php echo $info_registration['s_aplno2'] ?></td>
                <?php } else { ?>
                    <td class="right"><?php echo $info_registration['s_aplno3'] ?></td>
                <?php } ?>
            </tr>
            <tr>
                <td class="left">Application Date</td>
                <td class="right"><?php echo $info_registration['s_apldate'] ?></td>
            </tr>
            <tr>
                <td class="left">Application Status</td>
                <td class="right"><?php echo $aplstatus ?></td>
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
                <?php if($sl==1) { ?>
                    <td class="right"><?php echo $info_registration['s_institute1'] ?></td>
                <?php } elseif($sl==2) { ?>
                    <td class="right"><?php echo $info_registration['s_institute2'] ?></td>
                <?php } else { ?>
                    <td class="right"><?php echo $info_registration['s_institute3'] ?></td>
                <?php } ?>
            </tr>
            <tr>
                <td class="left">Preferred Stream</td>
                <td class="right"><?php echo $info_registration['s_stream'] ?></td>
            </tr>
            <tr>
                <td class="left">Preferred Course</td>
                <td class="right"><?php echo $info_registration['s_course'] ?></td>
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
                <td class="left">Benificiary Name</td>
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
                <td class="left">Preferred Core Subject-1</td>
                <td width="right"><?php echo $info_course['s_coresubject1'] ?></td>
            </tr>
            <tr>
                <td class="left">Preferred Core Subject-2</td>
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
</body>
<footer class="bg-light text-center text-lg-start" style="margin-top: 20px;">
  <div class="text-center p-3" style="opacity: 0.7; font-size:small; background-color:#f3f3f3;">
    © <?php echo $year?> Powered by eAdmission 
  </div>
</footer>

<script src="js/application-form.js"></script>
