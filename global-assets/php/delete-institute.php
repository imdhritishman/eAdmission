<?php
    require("../../connection.php");
    require("../../header.php");
    
    if(isset($_SESSION['adm_id']) && (isset($_GET['ins_id']))){
        $ins_id = $_GET['ins_id'];
    }

    $sql_institute = "SELECT * FROM institute WHERE `ins_id`='$ins_id'";
    $result_institute = mysqli_query($connect, $sql_institute);
    $num_institute = mysqli_num_rows($result_institute);
    $info_institute = mysqli_fetch_assoc($result_institute);

    $sql_delete_institute = "DELETE FROM `institute` WHERE `ins_id` = '$ins_id'";
    $result_delete_institute = mysqli_query($connect,$sql_delete_institute);

    if($result_delete_institute){
        ?>
            <script>
                window.location.href="delete-institute-success.php";
            </script>
        <?php
    }

?>
