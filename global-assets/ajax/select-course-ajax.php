<?php
    require("../../connection.php");
    if(isset($_GET['id'])){
        $sql_select_course = "SELECT * FROM course WHERE `cour_id` = '".$_GET['id']."' ";
        $result_select_course = mysqli_query($connect, $sql_select_course);
        $num_select_course = mysqli_num_rows($result_select_course);
        $info_select_course = mysqli_fetch_assoc($result_select_course);
        echo json_encode($info_select_course);
    }
?>