<?php
    require("../../connection.php");
    require("../../header.php");
    
    if((isset($_SESSION['s_id'])) && (isset($_GET['std_id'])) && (isset($_GET['sl']))){
        $std_id = $_GET['std_id'];
        $sl = $_GET['sl'];
        $year = date("Y");
        $date = date("Y-m-d");

    $sql_registration = "SELECT * FROM registration_details WHERE `s_id`='$std_id'";
    $result_registration = mysqli_query($connect, $sql_registration);
    $num_registration = mysqli_num_rows($result_registration);
    $info_registration = mysqli_fetch_assoc($result_registration);
    $std_name = $info_registration['s_name'];


    if($sl==1){
        $std_aplno = $info_registration['s_aplno1'];
        $std_institute = $info_registration['s_institute1'];
        $sql_update_aplstatus = "UPDATE `registration_details` SET `s_aplstatus1`=3 WHERE `s_id`=$std_id";
        $result_update_aplstatus = mysqli_query($connect,$sql_update_aplstatus);
        }elseif($sl==2){
        $std_aplno = $info_registration['s_aplno2'];
        $std_institute = $info_registration['s_institute2'];
        $sql_update_aplstatus = "UPDATE `registration_details` SET `s_aplstatus2`=3 WHERE `s_id`=$std_id";
        $result_update_aplstatus = mysqli_query($connect,$sql_update_aplstatus);
    }elseif($sl==3){
        $std_aplno = $info_registration['s_aplno3'];
        $std_institute = $info_registration['s_institute3'];
        $sql_update_aplstatus = "UPDATE `registration_details` SET `s_aplstatus3`=3 WHERE `s_id`=$std_id";
        $result_update_aplstatus = mysqli_query($connect,$sql_update_aplstatus);
    }

    $sql_institute = "SELECT * FROM institute WHERE `ins_name`='$std_institute'";
    $result_institute = mysqli_query($connect,$sql_institute);
    $num_institute = mysqli_num_rows($result_institute);
    $info_institute = mysqli_fetch_assoc($result_institute);
    $ins_code = $info_institute['ins_code'];

    $std_rollno = $ins_code."/".$year."/".rand(1000,9999);

    $sql_confirm_admission = "INSERT INTO `student`(`std_name`, `std_aplno`, `std_institute`, `std_rollno`, `std_admdate`) 
    VALUES ('$std_name','$std_aplno','$std_institute','$std_rollno','$date')";
    $result_confirm_admission = mysqli_query($connect,$sql_confirm_admission);
    
    if($result_confirm_admission && $result_update_aplstatus){ 
        ?>
        <script>
            window.location.href="confirm-admission-success.php";
        </script>
        <?php
    }
    
}

?>