<?php
    require("connection.php");
    require("header.php");
    $page_title = "Institute View";
    $year = date("Y");
    $count = 1;

    if(isset($_GET['ins_id'])){
        $ins_id = $_GET['ins_id'];
        $sql_institute = "SELECT * FROM institute WHERE `ins_id` = '$ins_id'";
        $result_institute = mysqli_query($connect, $sql_institute);
        $num_institute = mysqli_num_rows($result_institute);
        $info_institute = mysqli_fetch_assoc($result_institute);
        $ins_name = $info_institute['ins_name'];
        $ins_status = $info_institute['ins_status'];
    }
    else{
        ?>
        <script>
            window.location.href="logout-institute.php";
        </script>
        <?php
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
    <link rel="stylesheet" href="css/institute-view.css">
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
        <div class="table-title">Institute Details</div>
        <table class="institute-details">
            <tr>
                <td class="left">Institute Name</td>
                <td class="right"><?php echo $info_institute['ins_name'] ?></td>
            </tr>
            <tr>
                <td class="left">Institute Code</td>
                <td class="right"><?php echo $info_institute['ins_code'] ?></td>
            </tr>
            <tr>
                <td class="left">Institute Phone No</td>
                <td class="right"><?php echo $info_institute['ins_phone'] ?></td>
            </tr>
            <tr>
                <td class="left">Institute Website</td>
                <td class="right"><?php echo $info_institute['ins_email'] ?></td>
            </tr>
            <tr>
                <td class="left">Institute Registration Date</td>
                <td class="right"><?php echo $info_institute['ins_regdate'] ?></td>
            </tr>
            <tr>
                <td class="left">Institute Status</td>
                <?php if($ins_status==0){ ?>
                    <td class="right" style="color: orange;">Verification Pending</td>
                <?php }elseif($ins_status==1){ ?>
                    <td class="right" style="color: green;">Verified</td>
                <?php }else{ ?>
                    <td class="right" style="color: red;">Verification Failed</td>
                <?php } ?>
            </tr>
            <tr>
                <td class="left">Institute Address</td>
                <td class="right"><?php echo $info_institute['ins_address'] ?></td>
            </tr>
        </table>    
    </div>
</body>
<footer class="bg-light text-center text-lg-start" style="margin-top: 20px;">
  <div class="text-center p-3" style="opacity: 0.7; font-size:small;background-color:#f3f3f3;">
    © <?php echo $year?> Powered by eAdmission 
  </div>
</footer>

<script src="js/institute-view.js"></script>
