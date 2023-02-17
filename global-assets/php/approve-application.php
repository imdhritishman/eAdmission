<?php
    require("../../connection.php");
    require("../../header.php");
    
    if(isset($_SESSION['ins_id']) && (isset($_GET['std_id'])) && (isset($_GET['sl']))){
        $ins_id = $_SESSION['ins_id'];
        $sl = $_GET['sl'];
        $std_id = $_GET['std_id'];
    }

    $sql_registration = "SELECT * FROM registration_details WHERE `s_id`='$std_id'";
    $result_registration = mysqli_query($connect, $sql_registration);
    $num_registration = mysqli_num_rows($result_registration);
    $info_registration = mysqli_fetch_assoc($result_registration);
    $status = $info_registration['s_status'];

    if($sl==1){
        $s_aplstatus = $info_registration['s_aplstatus1'];
        if($s_aplstatus==0 && $status==10){
            $sql_approve_application = "UPDATE registration_details SET `s_aplstatus1`=1 WHERE `s_id`=$std_id";
            $result_approve_application = mysqli_query($connect, $sql_approve_application);
        }elseif($s_aplstatus==1 && $status==10){
            $sql_approve_application = "UPDATE registration_details SET `s_aplstatus1`=2 WHERE `s_id`=$std_id";
            $result_approve_application = mysqli_query($connect, $sql_approve_application);
        }elseif($s_aplstatus==2 && $status==10){
            $sql_approve_application = "UPDATE registration_details SET `s_aplstatus1`=1 WHERE `s_id`=$std_id";
            $result_approve_application = mysqli_query($connect, $sql_approve_application);        
        }elseif($s_aplstatus==3 && $status==10){
            ?>
                <script>
                    window.location.href="approve-application-reject-fail.php";
                </script>
            <?php
        }else{
            ?>
                <script>
                    window.location.href="approve-application-approve-fail.php";
                </script>
            <?php
        }
    } elseif($sl==2){
        $s_aplstatus = $info_registration['s_aplstatus2'];
        if($s_aplstatus==0 && $status==10){
            $sql_approve_application = "UPDATE registration_details SET `s_aplstatus2`=1 WHERE `s_id`=$std_id";
            $result_approve_application = mysqli_query($connect, $sql_approve_application);
        }elseif($s_aplstatus==1 && $status==10){
            $sql_approve_application = "UPDATE registration_details SET `s_aplstatus2`=2 WHERE `s_id`=$std_id";
            $result_approve_application = mysqli_query($connect, $sql_approve_application);
        }elseif($s_aplstatus==2 && $status==10){
            $sql_approve_application = "UPDATE registration_details SET `s_aplstatus2`=1 WHERE `s_id`=$std_id";
            $result_approve_application = mysqli_query($connect, $sql_approve_application);        
        }elseif($s_aplstatus==3 && $status==10){
            ?>
                <script>
                    window.location.href="approve-application-reject-fail.php";
                </script>
            <?php
        }else{
            ?>
                <script>
                    window.location.href="approve-application-approve-fail.php";
                </script>
            <?php
        }
    }
    elseif($sl==3){
        $s_aplstatus = $info_registration['s_aplstatus3'];
        if($s_aplstatus==0 && $status==10){
            $sql_approve_application = "UPDATE registration_details SET `s_aplstatus3`=1 WHERE `s_id`=$std_id";
            $result_approve_application = mysqli_query($connect, $sql_approve_application);
        }elseif($s_aplstatus==1 && $status==10){
            $sql_approve_application = "UPDATE registration_details SET `s_aplstatus3`=2 WHERE `s_id`=$std_id";
            $result_approve_application = mysqli_query($connect, $sql_approve_application);
        }elseif($s_aplstatus==2 && $status==10){
            $sql_approve_application = "UPDATE registration_details SET `s_aplstatus3`=1 WHERE `s_id`=$std_id";
            $result_approve_application = mysqli_query($connect, $sql_approve_application);        
        }elseif($s_aplstatus==3 && $status==10){
            ?>
                <script>
                    window.location.href="approve-application-reject-fail.php";
                </script>
            <?php
        }else{
            ?>
                <script>
                    window.location.href="approve-application-approve-fail.php";
                </script>
            <?php
        }
    }

    if($result_approve_application){
        ?>
        <script>
            window.location.href="approve-application-success.php";
        </script>
        <?php
    }

?>
