<?php
    require("../../connection.php");
    
    if(isset($_GET['ins_id'])){
        $ins_id = $_GET['ins_id'];
    }

    $sql_institute = "SELECT * FROM institute WHERE `ins_id`='$ins_id'";
    $result_institute = mysqli_query($connect, $sql_institute);
    $num_institute = mysqli_num_rows($result_institute);
    $info_institute = mysqli_fetch_assoc($result_institute);
    $ins_status = $info_institute['ins_status'];
    $ins_code = $info_institute['ins_code'];
    
    if(($ins_status==0) && ($ins_code!="")){
        $sql_approve_institute = "UPDATE institute SET `ins_status`=1 WHERE `ins_id`=$ins_id";
        $result_approve_institute = mysqli_query($connect, $sql_approve_institute);
    }elseif($ins_status==1){
        $sql_approve_institute = "UPDATE institute SET `ins_status`=2 WHERE `ins_id`=$ins_id";
        $result_approve_institute = mysqli_query($connect, $sql_approve_institute);
    }elseif($ins_status==2){
        $sql_approve_institute = "UPDATE institute SET `ins_status`=1 WHERE `ins_id`=$ins_id";
        $result_approve_institute = mysqli_query($connect, $sql_approve_institute);        
    }elseif($ins_code==""){
        ?>
            <script>
                window.location.href="approve-institute-fail.php";
            </script>
        <?php
    }

    if($result_approve_institute){
        ?>
        <script>
            window.location.href="approve-institute-success.php";
        </script>
        <?php
    }

?>