<?php
    require("connection.php");
    require("header.php");
    $page_title = "Students Database";
    $year = date("Y");
    $count = 1;

    if(isset($_SESSION['adm_id'])){
        $adm_id = $_SESSION['adm_id'];
        $sql_admin = "SELECT * FROM `admin` WHERE `adm_id` = '$adm_id'";
        $result_admin = mysqli_query($connect, $sql_admin);
        $num_admin = mysqli_num_rows($result_admin);
        $info_admin = mysqli_fetch_assoc($result_admin);
    }
    else{
        ?>
        <script>
            window.location.href="logout-admin.php";
        </script>
        <?php
    }

    $sql_student = "SELECT * FROM student";
    $result_student = mysqli_query($connect, $sql_student);
    $num_student = mysqli_num_rows($result_student);
    $info_student = mysqli_fetch_all($result_student, MYSQLI_ASSOC);

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
    <link rel="stylesheet" href="css/students-database.css">
</head>
<body>
    <div class="page-header">
        <div class="page-title-logo">
            <img class="page-title-logo-image" src="assets/images/eadmission-logo.PNG" alt="Logo">
        </div>
    </div>
    <div class="application-data">
        <div class="table-title">Students Database</div>
        <table class="students-database">
            <tr>
                <th class="regular">Sl No</th>
                <th class="regular">Name</th>
                <th class="regular">Phone No</th>
                <th class="regular">Email ID</th>
                <th class="regular">Institute</th>
                <th class="regular">Enrollment No</th>
                <th class="regular">Stream</th>
                <th class="regular">Course</th>
                <th class="regular">Photograph</th>
                <th class="regular">Signature</th>
            </tr>
            <?php foreach($info_student as $student){
                $std_aplno = $student['std_aplno'];

                $sql_registration_details = "SELECT * FROM registration_details WHERE `s_aplno1`='$std_aplno' OR `s_aplno2`='$std_aplno' OR `s_aplno3`='$std_aplno'";
                $result_registration_details = mysqli_query($connect,$sql_registration_details);
                $num_registration_details = mysqli_num_rows($result_registration_details);
                $info_registration_details = mysqli_fetch_assoc($result_registration_details);
                $s_id = $info_registration_details['s_id'];
            
                $sql_upload_documents = "SELECT * FROM upload_documents WHERE `s_id` = '$s_id'";
                $result_upload_documents = mysqli_query($connect,$sql_upload_documents);
                $num_upload_documents = mysqli_num_rows($result_upload_documents);
                $info_upload_documents = mysqli_fetch_assoc($result_upload_documents);            
            ?>
            <tr>
                <td class="regular"><?php echo $count++ ?></td>
                <td class="regular"><?php echo $student['std_name'] ?></td>
                <td class="regular"><?php echo $info_registration_details['s_phone'] ?></td>
                <td class="regular"><?php echo $info_registration_details['s_email'] ?></td>
                <td class="regular"><?php echo $student['std_institute'] ?></td>
                <td class="regular"><?php echo $student['std_rollno'] ?></td>
                <td class="regular"><?php echo $info_registration_details['s_stream'] ?></td>
                <td class="regular"><?php echo $info_registration_details['s_course'] ?></td>
                <td class="regular"><img src="<?php echo $info_upload_documents['s_passportphotograph'] ?>" height="120px" width="120px"></td>
                <td class="regular"><img src="<?php echo $info_upload_documents['s_signature'] ?>" height="80px" width="120px"></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
<footer class="bg-light text-center text-lg-start" style="margin-top: 20px;">
  <div class="text-center p-3" style="opacity: 0.7; font-size:small;background-color:#f3f3f3;">
    © <?php echo $year?> Powered by eAdmission 
  </div>
</footer>

<script src="js/students-database.js"></script>
