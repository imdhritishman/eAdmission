<?php
    require("connection.php");
    require("header.php");
    $page_title = "Applications Database";
    $year = date("Y");
    $count = 1;

    if((isset($_SESSION['ins_id'])) && (isset($_GET['i_id']))){
        $i_id = $_GET['i_id'];
        $sql_institute = "SELECT * FROM institute WHERE `ins_id` = '$i_id'";
        $result_institute = mysqli_query($connect, $sql_institute);
        $num_institute = mysqli_num_rows($result_institute);
        $info_institute = mysqli_fetch_assoc($result_institute);
        $ins_name = $info_institute['ins_name'];
    }
    else{
        ?>
        <script>
            window.location.href="logout-institute.php";
        </script>
        <?php
    }

    $sql_registration = "SELECT * FROM registration_details WHERE `s_institute1` = '$ins_name' OR `s_institute2` = '$ins_name' OR `s_institute3` = '$ins_name' ";
    $result_registration = mysqli_query($connect, $sql_registration);
    $num_registration = mysqli_num_rows($result_registration);
    $info_registration = mysqli_fetch_all($result_registration, MYSQLI_ASSOC);


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
    <link rel="stylesheet" href="css/applications-database.css">
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
        <div class="table-title">Applications Database</div>
        <table class="applications-database">
        <tr>
                <th class="regular">Sl No</th>
                <th class="regular">Application No</th>
                <th class="regular">Application Date</th>
                <th class="special">Applicant's Name</th>
                <th class="regular">Course</th>
                <th class="regular">Stream</th>
                <th class="special">Progress</th>
                <th class="regular">Approval</th>
            </tr>
            <?php foreach($info_registration as $registration){
                $progress = "";
                if($registration['s_status']==1){
                    $progress = "Applicant Registered";
                } elseif($registration['s_status']==2){
                    $progress = "Registration Details Submitted";        
                } elseif($registration['s_status']==3){
                    $progress = "Residential Details Submitted";        
                } elseif($registration['s_status']==4){
                    $progress = "Personal Details Submitted";        
                } elseif($registration['s_status']==5){
                    $progress = "Family Details Submitted";        
                } elseif($registration['s_status']==6){
                    $progress = "Bank Details Submitted";        
                } elseif($registration['s_status']==7){
                    $progress = "Additional Details Submitted";        
                } elseif($registration['s_status']==8){
                    $progress = "Academic Details Submitted";        
                } elseif($registration['s_status']==9){
                    $progress = "Course Details Submitted";        
                } elseif($registration['s_status']>=10){
                    $progress = "Application Submission Completed";        
                }

                if($registration['s_institute1']==$ins_name){
                    $s_aplno = $registration['s_aplno1'];
                    $s_aplstatus = $registration['s_aplstatus1'];
                }elseif($registration['s_institute2']==$ins_name){
                    $s_aplno = $registration['s_aplno2'];
                    $s_aplstatus = $registration['s_aplstatus2'];
                }elseif($registration['s_institute3']==$ins_name){
                    $s_aplno = $registration['s_aplno2'];
                    $s_aplstatus = $registration['s_aplstatus3'];
                }

                if($s_aplstatus==0){
                    $approval = "Pending";
                }elseif($s_aplstatus==1){
                    $approval = "Verified";
                }elseif($s_aplstatus==2){
                    $approval = "Rejected";
                }elseif($s_aplstatus==3){
                    $approval = "Admission Confirmed";
                }

            ?>
            <tr>
                <td class="regular"><?php echo $count++ ?></td>
                <td class="regular"><?php echo $s_aplno ?></td>
                <td class="regular"><?php echo $registration['s_apldate'] ?></td>
                <td class="special"><?php echo $registration['s_name'] ?></td>
                <td class="regular"><?php echo $registration['s_course'] ?></td>
                <td class="regular"><?php echo $registration['s_stream'] ?></td>
                <td class="special"><?php echo $progress ?></td>
                <td class="regular"><?php echo $approval ?></td>
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

<script src="js/applications-database.js"></script>
