<?php
    require("connection.php");
    require("header.php");
    $page_title = "Student Card";
    $year = date("Y");

    if(((isset($_SESSION['ins_id'])) || (isset($_SESSION['s_id'])) || (isset($_SESSION['adm_id']))) && (isset($_GET['std_id']))){
        $std_id = $_GET['std_id'];
        $sql_students = "SELECT * FROM `student` WHERE `std_id` = '$std_id'";
        $result_students = mysqli_query($connect, $sql_students);
        $num_students = mysqli_num_rows($result_students);
        $info_students = mysqli_fetch_assoc($result_students);
        $std_aplno = $info_students['std_aplno'];
        $std_institute = $info_students['std_institute'];
    }
    else{
        ?>
        <script>
            window.location.href="logout.php";
        </script>
        <?php
    }

    $sql_registration_details = "SELECT * FROM registration_details WHERE `s_aplno1`='$std_aplno' OR `s_aplno2`='$std_aplno' OR `s_aplno3`='$std_aplno'";
    $result_registration_details = mysqli_query($connect,$sql_registration_details);
    $num_registration_details = mysqli_num_rows($result_registration_details);
    $info_registration_details = mysqli_fetch_assoc($result_registration_details);
    $s_id = $info_registration_details['s_id'];

    $sql_residential_details = "SELECT * FROM residential_details WHERE `s_id`='$s_id'";
    $result_residential_details = mysqli_query($connect,$sql_residential_details);
    $num_residential_details = mysqli_num_rows($result_residential_details);
    $info_residential_details = mysqli_fetch_assoc($result_residential_details);

    $sql_personal_details = "SELECT * FROM personal_details WHERE `s_id`='$s_id'";
    $result_personal_details = mysqli_query($connect,$sql_personal_details);
    $num_personal_details = mysqli_num_rows($result_personal_details);
    $info_personal_details = mysqli_fetch_assoc($result_personal_details);

    $sql_family_details = "SELECT * FROM family_details WHERE `s_id`='$s_id'";
    $result_family_details = mysqli_query($connect,$sql_family_details);
    $num_family_details = mysqli_num_rows($result_family_details);
    $info_family_details = mysqli_fetch_assoc($result_family_details);

    $sql_bank_details = "SELECT * FROM bank_details WHERE `s_id`='$s_id'";
    $result_bank_details = mysqli_query($connect,$sql_bank_details);
    $num_bank_details = mysqli_num_rows($result_bank_details);
    $info_bank_details = mysqli_fetch_assoc($result_bank_details);

    $sql_course_details = "SELECT * FROM course_details WHERE `s_id`='$s_id'";
    $result_course_details = mysqli_query($connect,$sql_course_details);
    $num_course_details = mysqli_num_rows($result_course_details);
    $info_course_details = mysqli_fetch_assoc($result_course_details);

    $sql_upload = "SELECT * FROM upload_documents WHERE `s_id` = '$s_id'";
    $result_upload = mysqli_query($connect, $sql_upload);
    $num_upload = mysqli_num_rows($result_upload);
    $info_upload = mysqli_fetch_assoc($result_upload);

    $sql_institute = "SELECT * FROM institute WHERE `ins_name` = '$std_institute'";
    $result_institute = mysqli_query($connect, $sql_institute);
    $num_institute = mysqli_num_rows($result_institute);
    $info_institute = mysqli_fetch_assoc($result_institute);

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
    <link rel="stylesheet" href="css/student-view.css">
</head>
<body>
    <div class="page-header">
        <div class="page-title-logo">
            <img class="page-title-logo-image" src="<?php echo $info_institute['ins_logo'] ?>" alt="Logo">
        </div>
        <div class="page-title-text">
            <span style="font-weight: bold; font-size:large;"><?php echo $std_institute ?> - eAdmission</span><br>
            <span style=""><?php echo $info_institute['ins_address'] ?></span><br>
        </div>
    </div>
    <div class="application-data">
        <div class="table-title">Student Details</div>
        <table class="student-details">
            <tr>
                <td class="left">Student Name</td>
                <td class="right"><?php echo $info_students['std_name'] ?></td>
            </tr>
            <tr>
                <td class="left">Registered Phone No</td>
                <td class="right"><?php echo $info_registration_details['s_phone'] ?></td>
            </tr>
            <tr>
                <td class="left">Registered Email ID</td>
                <td class="right"><?php echo $info_registration_details['s_email'] ?></td>
            </tr>
        </table>
        <div class="table-title">Admission Details</div>
        <table class="student-details">
            <tr>
                <td class="left">Institute Name</td>
                <td class="right"><?php echo $info_students['std_institute'] ?></td>
            </tr>
            <tr>
                <td class="left">Registered Stream</td>
                <td class="right"><?php echo $info_registration_details['s_stream'] ?></td>
            </tr>
            <tr>
                <td class="left">Registered Course</td>
                <td class="right"><?php echo $info_registration_details['s_course'] ?></td>
            </tr>
            <tr>
                <td class="left">Entrollment No</td>
                <td class="right"><?php echo $info_students['std_rollno'] ?></td>
            </tr>
            <tr>
                <td class="left">Admission Date</td>
                <td class="right"><?php echo $info_students['std_admdate'] ?></td>
            </tr>
        </table>
        <div class="table-title">Residential Details</div>
        <table class="student-details">
            <tr>
                <td class="left">Village/Town</td>
                <td class="right"><?php echo $info_residential_details['s_villagetown'] ?></td>
            </tr>
            <tr>
                <td class="left">Post Office</td>
                <td class="right"><?php echo $info_residential_details['s_postoffice'] ?></td>
            </tr>
            <tr>
                <td class="left">Police Station</td>
                <td class="right"><?php echo $info_residential_details['s_policestation'] ?></td>
            </tr>
            <tr>
                <td class="left">PIN No</td>
                <td class="right"><?php echo $info_residential_details['s_pinno'] ?></td>
            </tr>
            <tr>
                <td class="left">State</td>
                <td class="right"><?php echo $info_residential_details['s_state'] ?></td>
            </tr>
            <tr>
                <td class="left">District</td>
                <td class="right"><?php echo $info_residential_details['s_district'] ?></td>
            </tr>
        </table>
        <div class="table-title">Personal Details</div>
        <table class="student-details">
            <tr>
                <td class="left">Date of Birth</td>
                <td class="right"><?php echo $info_personal_details['s_dob'] ?></td>
            </tr>
            <tr>
                <td class="left">Gender</td>
                <td class="right"><?php echo $info_personal_details['s_gender'] ?></td>
            </tr>
            <tr>
                <td class="left">Nationality</td>
                <td class="right"><?php echo $info_personal_details['s_nationality'] ?></td>
            </tr>
            <tr>
                <td class="left">Religion</td>
                <td class="right"><?php echo $info_personal_details['s_religion'] ?></td>
            </tr>
            <tr>
                <td class="left">Caste</td>
                <td class="right"><?php echo $info_personal_details['s_caste'] ?></td>
            </tr>
            <tr>
                <td class="left">Blood Group</td>
                <td class="right"><?php echo $info_personal_details['s_bloodgroup'] ?></td>
            </tr>
            <tr>
                <td class="left">Marritial Status</td>
                <td class="right"><?php echo $info_personal_details['s_marritialstatus'] ?></td>
            </tr>
        </table>
        <div class="table-title">Family Details</div>
        <table class="student-details">
            <tr>
                <td class="left">Father's Name</td>
                <td class="right"><?php echo $info_family_details['s_fathersname'] ?></td>
            </tr>
            <tr>
                <td class="left">Father's Occupation</td>
                <td class="right"><?php echo $info_family_details['s_fathersoccupation'] ?></td>
            </tr>
            <tr>
                <td class="left">Father's Phone No</td>
                <td class="right"><?php echo $info_family_details['s_fathersphoneno'] ?></td>
            </tr>
            <tr>
                <td class="left">Mother's Name</td>
                <td class="right"><?php echo $info_family_details['s_mothersname'] ?></td>
            </tr>
            <tr>
                <td class="left">Mother's Occupation</td>
                <td class="right"><?php echo $info_family_details['s_mothersoccupation'] ?></td>
            </tr>
            <tr>
                <td class="left">Mother's Phone No</td>
                <td class="right"><?php echo $info_family_details['s_mothersphoneno'] ?></td>
            </tr>
            <tr>
                <td class="left">Gurdian's Name</td>
                <td class="right"><?php echo $info_family_details['s_gurdiansname'] ?></td>
            </tr>
            <tr>
                <td class="left">Gudrian's Phone No</td>
                <td class="right"><?php echo $info_family_details['s_gurdiansphoneno'] ?></td>
            </tr>
        </table>
        <div class="table-title">Bank Details</div>
        <table class="student-details">
            <tr>
                <td class="left">Bank Name</td>
                <td class="right"><?php echo $info_bank_details['s_bankname'] ?></td>
            </tr>
            <tr>
                <td class="left">Branch Name</td>
                <td class="right"><?php echo $info_bank_details['s_branchname'] ?></td>
            </tr>
            <tr>
                <td class="left">Benificiary Name</td>
                <td class="right"><?php echo $info_bank_details['s_beneficiaryname'] ?></td>
            </tr>
            <tr>
                <td class="left">Account No</td>
                <td class="right"><?php echo $info_bank_details['s_accountno'] ?></td>
            </tr>
            <tr>
                <td class="left">IFSC Code</td>
                <td class="right"><?php echo $info_bank_details['s_ifsccode'] ?></td>
            </tr>
        </table>
        <div class="table-title">Course Details</div>
        <table class="student-details">
            <tr>
                <td class="left">Preferred Core Subject-1</td>
                <td class="right"><?php echo $info_course_details['s_coresubject1'] ?></td>
            </tr>
            <tr>
                <td class="left">Preferred Core Subject-2</td>
                <td class="right"><?php echo $info_course_details['s_coresubject2'] ?></td>
            </tr>
            <tr>
                <td class="left">Preferred Elective Subject-1</td>
                <td class="right"><?php echo $info_course_details['s_electivesubject1'] ?></td>
            </tr>
            <tr>
                <td class="left">Preferred Elective Subject-2</td>
                <td class="right"><?php echo $info_course_details['s_electivesubject2'] ?></td>
            </tr>
            <tr>
                <td class="left">Preferred Elective Subject-3</td>
                <td class="right"><?php echo $info_course_details['s_electivesubject3'] ?></td>
            </tr>
            <tr>
                <td class="left">Preferred Elective Subject-4</td>
                <td class="right"><?php echo $info_course_details['s_electivesubject4'] ?></td>
            </tr>
        </table>
        <div class="table-title">Biometric Details</div>
        <table class="student-details">
        <tr>
                <td class="left">Photograph</td>
                <td class="right"><img src="<?php echo $info_upload['s_passportphotograph'] ?>" height="120px" width="120px"></td>
            </tr>
            <tr>
                <td class="left">Signature</td>
                <td class="right"><img src="<?php echo $info_upload['s_signature'] ?>" height="80px" width="120px"></td>
            </tr>
        </table>
    </div>
</body>
<footer class="bg-light text-center text-lg-start" style="margin-top: 20px;">
  <div class="text-center p-3" style="opacity: 0.7; font-size:small; background-color:#f3f3f3;">
    © <?php echo $year?> Powered by eAdmission 
  </div>
</footer>

<script src="js/student-view.js"></script>
