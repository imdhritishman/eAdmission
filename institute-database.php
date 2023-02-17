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

    $sql_total_institute = "SELECT * FROM institute";
    $result_total_institute = mysqli_query($connect, $sql_total_institute);
    $num_total_institute = mysqli_num_rows($result_total_institute);
    $info_total_institute = mysqli_fetch_all($result_total_institute, MYSQLI_ASSOC);

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
    <link rel="stylesheet" href="css/institute-database.css">
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
        <div class="table-title">Institute Database</div>
        <table class="applications-database">
        <tr>
                <th class="narrow">Sl No</th>
                <th class="special">Institute Name</th>
                <th class="narrow">Institute Code</th>
                <th class="regular">Institute Phone No</th>
                <th class="regular">Institute Email ID</th>
                <th class="regular">Institute Website</th>
                <th class="regular">Institute Registration Date</th>
                <th class="regular">Institute Status</th>
                <th class="special">Institute Address</th>
            </tr>
            <?php foreach($info_total_institute as $institute){ ?>
            <tr>
                <td class="narrow"><?php echo $count++ ?></td>
                <td class="special"><?php echo $institute['ins_name'] ?></td>
                <td class="narrow"><?php echo $institute['ins_code'] ?></td>
                <td class="regular"><?php echo $institute['ins_phone'] ?></td>
                <td class="regular"><?php echo $institute['ins_email'] ?></td>
                <td class="regular"><?php echo $institute['ins_website'] ?></td>
                <td class="regular"><?php echo $institute['ins_regdate'] ?></td>
                <?php if($institute['ins_status']==0){ ?>
                <td class="regular" style="color: orange;">Verification Pending</td>
                <?php } elseif($institute['ins_status']==1){ ?>
                <td class="regular" style="color: green;">Verified</td>
                <?php } else { ?>
                <td class="regular" style="color: red;">Verification Failed</td>
                <?php } ?>
                <td class="special"><?php echo $institute['ins_address'] ?></td>
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

<script src="js/institute-database.js"></script>
