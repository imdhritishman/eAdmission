<?php
    require("connection.php");
    require("header.php");
    $page_title = "Institute Database";
    $year = date("Y");
    $count = 1;

    if(isset($_SESSION['adm_id'])){
        $adm_id = $_SESSION['adm_id'];
        $sql_admin = "SELECT * FROM `admin` WHERE `adm_id` = '$adm_id'";
        $result_admin = mysqli_query($connect, $sql_admin);
        $num_admin = mysqli_num_rows($result_admin);
        $info_admin = mysqli_fetch_assoc($result_admin);
        $adm_name = $info_admin['adm_name'];
    }
    else{
        ?>
        <script>
            window.location.href="logout-admin.php";
        </script>
        <?php
    }

    $sql_total_application = "SELECT * FROM registration_details";
    $result_total_application = mysqli_query($connect, $sql_total_application);
    $num_total_application = mysqli_num_rows($result_total_application);
    $info_total_application = mysqli_fetch_all($result_total_application, MYSQLI_ASSOC);

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
    <link rel="stylesheet" href="css/application-database.css">
</head>
<body>
    <div class="page-header">
        <div class="page-title-logo">
            <img class="page-title-logo-image" src="assets/images/eadmission-logo.PNG" alt="Logo">
        </div>
        <!-- <div class="page-title-text">
            <span style="font-weight: bold; font-size:large;">eAdmission</span><br>
        </div> -->
    </div>
    <div class="application-data">
        <div class="table-title">Application Database</div>
        <table class="applications-database">
        <tr>
                <th class="narrow">Sl No</th>
                <th class="special">Name</th>
                <th class="narrow">Course</th>
                <th class="regular">Stream</th>
                <th class="regular">Date</th>
                <th class="regular">Application No</th>
                <th class="regular">Application Status</th>
                <th class="regular">Application No</th>
                <th class="regular">Application Status</th>
                <th class="regular">Application No</th>
                <th class="regular">Application Status</th>
                <th class="regular">Progress</th>
            </tr>
            <?php foreach($info_total_application as $application){ 
                if($application['s_aplstatus1']==0){
                    $aplstatus1 = "Pending";
                }elseif($application['s_aplstatus1']==1){
                    $aplstatus1 = "Verified";
                }elseif($application['s_aplstatus1']==2){
                    $aplstatus1 = "Rejected";
                }elseif($application['s_aplstatus1']==3){
                    $aplstatus1 = "Admission Confirmed";
                }

                if($application['s_aplstatus2']==0){
                    $aplstatus2 = "Pending";
                }elseif($application['s_aplstatus2']==1){
                    $aplstatus2 = "Verified";
                }elseif($application['s_aplstatus2']==2){
                    $aplstatus2 = "Rejected";
                }elseif($application['s_aplstatus2']==3){
                    $aplstatus2 = "Admission Confirmed";
                }

                if($application['s_aplstatus3']==0){
                    $aplstatus3 = "Pending";
                }elseif($application['s_aplstatus3']==1){
                    $aplstatus3 = "Verified";
                }elseif($application['s_aplstatus3']==2){
                    $aplstatus3 = "Rejected";
                }elseif($application['s_aplstatus3']==3){
                    $aplstatus3 = "Admission Confirmed";
                }

                if($application['s_status']==1){
                    $progress = "Applicant Registered";
                } elseif($application['s_status']==2){
                    $progress = "Registration Details Submitted";        
                } elseif($application['s_status']==3){
                    $progress = "Residential Details Submitted";        
                } elseif($application['s_status']==4){
                    $progress = "Personal Details Submitted";        
                } elseif($application['s_status']==5){
                    $progress = "Family Details Submitted";        
                } elseif($application['s_status']==6){
                    $progress = "Bank Details Submitted";        
                } elseif($application['s_status']==7){
                    $progress = "Additional Details Submitted";        
                } elseif($application['s_status']==8){
                    $progress = "Academic Details Submitted";        
                } elseif($application['s_status']==9){
                    $progress = "Course Details Submitted";        
                } elseif($application['s_status']>=10){
                    $progress = "Application Submission Completed";        
                }
            ?>
            <tr>
                <td class="narrow"><?php echo $count++ ?></td>
                <td class="special"><?php echo $application['s_name'] ?></td>
                <td class="narrow"><?php echo $application['s_course'] ?></td>
                <td class="regular"><?php echo $application['s_stream'] ?></td>
                <td class="regular"><?php echo $application['s_apldate'] ?></td>
                <td class="regular"><?php echo $application['s_aplno1'] ?></td>
                <td class="regular"><?php echo $aplstatus1 ?></td>
                <td class="regular"><?php echo $application['s_aplno2'] ?></td>
                <td class="regular"><?php echo $aplstatus2 ?></td>
                <td class="regular"><?php echo $application['s_aplno3'] ?></td>
                <td class="regular"><?php echo $aplstatus3 ?></td>
                <td class="regular"><?php echo $progress ?></td>
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

<script src="js/application-database.js"></script>
