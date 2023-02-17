<?php
    require("../../connection.php");
    require("../../header.php");
    
    if(isset($_SESSION['adm_id']) && (isset($_GET['s_id']))){
        $s_id = $_GET['s_id'];
    }

    $sql_registration_details = "SELECT * FROM registration_details WHERE `s_id`='$s_id'";
    $result_registration_details = mysqli_query($connect, $sql_registration_details);
    $num_registration_details = mysqli_num_rows($result_registration_details);
    $info_registration_details = mysqli_fetch_assoc($result_registration_details);
    $s_aplstatus1 = $info_registration_details['s_aplstatus1'];
    $s_aplstatus2 = $info_registration_details['s_aplstatus2'];
    $s_aplstatus3 = $info_registration_details['s_aplstatus3'];

    if($s_aplstatus1<=2 && $s_aplstatus2<=2 && $s_aplstatus3<=2){
        $sql_delete_registration_details = "DELETE FROM `registration_details` WHERE `s_id` = '$s_id'";
        $result_delete_registration_details = mysqli_query($connect,$sql_delete_registration_details);

        $sql_delete_residential_details = "DELETE FROM `residential_details` WHERE `s_id` = '$s_id'";
        $result_delete_residential_details = mysqli_query($connect,$sql_delete_residential_details);

        $sql_delete_personal_details = "DELETE FROM `personal_details` WHERE `s_id` = '$s_id'";
        $result_delete_personal_details = mysqli_query($connect,$sql_delete_personal_details);

        $sql_delete_family_details = "DELETE FROM `family_details` WHERE `s_id` = '$s_id'";
        $result_delete_family_details = mysqli_query($connect,$sql_delete_family_details);

        $sql_delete_bank_details = "DELETE FROM `bank_details` WHERE `s_id` = '$s_id'";
        $result_delete_bank_details = mysqli_query($connect,$sql_delete_bank_details);

        $sql_delete_additional_details = "DELETE FROM `additional_details` WHERE `s_id` = '$s_id'";
        $result_delete_additional_details = mysqli_query($connect,$sql_delete_additional_details);

        $sql_delete_academic_details = "DELETE FROM `academic_details` WHERE `s_id` = '$s_id'";
        $result_delete_academic_details = mysqli_query($connect,$sql_delete_academic_details);

        $sql_delete_course_details = "DELETE FROM `course_details` WHERE `s_id` = '$s_id'";
        $result_delete_course_details = mysqli_query($connect,$sql_delete_course_details);

        $sql_delete_upload_documents = "DELETE FROM `upload_documents` WHERE `s_id` = '$s_id'";
        $result_delete_upload_documents = mysqli_query($connect,$sql_delete_upload_documents);

        if($result_delete_registration_details && $result_delete_residential_details && $result_delete_personal_details && $result_delete_family_details && $result_delete_bank_details && $result_delete_additional_details && $result_delete_academic_details && $result_delete_course_details && $result_delete_upload_documents){
            ?>
                <script>
                    window.location.href="delete-application-success.php";
                </script>
            <?php
        }

    }elseif($s_aplstatus1==3 || $s_aplstatus2==3 || $s_aplstatus3==3){
        ?>
        <script>
            window.location.href="delete-application-fail.php";
        </script>
        <?php
    }

?>
