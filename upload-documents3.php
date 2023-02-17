<?php
    require("connection.php");
    require("header.php");
    $page_title = "Registration";
    $success = "";

    if(isset($_SESSION['s_id'])){
        $s_id = $_SESSION['s_id'];
    }
    else{
        ?>
        <script>
            window.location.href="logout.php";
        </script>
        <?php
    }

    $sql_registration = "SELECT * FROM registration_details WHERE `s_id` = '$s_id'";
    $result_registration = mysqli_query($connect, $sql_registration);
    $num_registration = mysqli_num_rows($result_registration);
    $info_registration = mysqli_fetch_assoc($result_registration);
    
    $sql_upload = "SELECT * FROM upload_documents WHERE `s_id` = '$s_id'";
    $result_upload = mysqli_query($connect, $sql_upload);
    $num_upload = mysqli_num_rows($result_upload);
    $info_upload = mysqli_fetch_assoc($result_upload);

    $sql_additional = "SELECT * FROM additional_details WHERE `s_id` = '$s_id'";
    $result_additional = mysqli_query($connect, $sql_additional);
    $num_additional = mysqli_num_rows($result_additional);
    $info_additional = mysqli_fetch_assoc($result_additional);

    $sql_personal = "SELECT * FROM personal_details WHERE `s_id` = '$s_id'";
    $result_personal = mysqli_query($connect, $sql_personal);
    $num_personal = mysqli_num_rows($result_personal);
    $info_personal = mysqli_fetch_assoc($result_personal);

    if($info_upload['s_passportphotograph']=="" && $info_registration['s_status']=='9'){
        if(isset($_POST['submit_upload_documents'])){
            $s_size = 2000000;
            $s_extensions = array("jpg", "jpeg", "png", "pdf");

            $s_passportphotograph_name = $_FILES['s_passportphotograph']['name'];
            $s_passportphotograph_type = $_FILES['s_passportphotograph']['type'];
            $s_passportphotograph_size = $_FILES['s_passportphotograph']['size'];
            $s_passportphotograph_tmp = $_FILES['s_passportphotograph']['tmp_name'];

            $s_signature_name = $_FILES['s_signature']['name'];
            $s_signature_type = $_FILES['s_signature']['type'];
            $s_signature_size = $_FILES['s_signature']['size'];
            $s_signature_tmp = $_FILES['s_signature']['tmp_name'];

            $s_hslccertificate_name = $_FILES['s_hslccertificate']['name'];
            $s_hslccertificate_type = $_FILES['s_hslccertificate']['type'];
            $s_hslccertificate_size = $_FILES['s_hslccertificate']['size'];
            $s_hslccertificate_tmp = $_FILES['s_hslccertificate']['tmp_name'];

            $s_hslcmarksheet_name = $_FILES['s_hslcmarksheet']['name'];
            $s_hslcmarksheet_type = $_FILES['s_hslcmarksheet']['type'];
            $s_hslcmarksheet_size = $_FILES['s_hslcmarksheet']['size'];
            $s_hslcmarksheet_tmp = $_FILES['s_hslcmarksheet']['tmp_name'];

            $s_bankpassbook_name = $_FILES['s_bankpassbook']['name'];
            $s_bankpassbook_type = $_FILES['s_bankpassbook']['type'];
            $s_bankpassbook_size = $_FILES['s_bankpassbook']['size'];
            $s_bankpassbook_tmp = $_FILES['s_bankpassbook']['tmp_name'];

            $s_domicilecertificate_name = $_FILES['s_domicilecertificate']['name'];
            $s_domicilecertificate_type = $_FILES['s_domicilecertificate']['type'];
            $s_domicilecertificate_size = $_FILES['s_domicilecertificate']['size'];
            $s_domicilecertificate_tmp = $_FILES['s_domicilecertificate']['tmp_name'];

            $s_aadhaarcard_name = $_FILES['s_aadhaarcard']['name'];
            $s_aadhaarcard_type = $_FILES['s_aadhaarcard']['type'];
            $s_aadhaarcard_size = $_FILES['s_aadhaarcard']['size'];
            $s_aadhaarcard_tmp = $_FILES['s_aadhaarcard']['tmp_name'];
            
            $s_passportphotograph_location="";
            $s_signature_location="";
            $s_hslccertificate_location="";
            $s_hslcmarksheet_location="";
            $s_bankpassbook_location="";
            $s_domicilecertificate_location="";
            $s_aadhaarcard_location="";

            $s_passportphotograph_extention = explode(".", $s_passportphotograph_name);
            $s_signature_extention = explode(".", $s_signature_name);
            $s_hslccertificate_extention = explode(".", $s_hslccertificate_name);
            $s_hslcmarksheet_extention = explode(".", $s_hslcmarksheet_name);
            $s_bankpassbook_extention = explode(".", $s_bankpassbook_name);
            $s_domicilecertificate_extention = explode(".", $s_domicilecertificate_name);
            $s_aadhaarcard_extention = explode(".", $s_aadhaarcard_name);

            $s_passportphotograph_actual_extention = strtolower(end($s_passportphotograph_extention));
            $s_signature_actual_extention = strtolower(end($s_signature_extention));
            $s_hslccertificate_actual_extention = strtolower(end($s_hslccertificate_extention));
            $s_hslcmarksheet_actual_extention = strtolower(end($s_hslcmarksheet_extention));
            $s_bankpassbook_actual_extention = strtolower(end($s_bankpassbook_extention));
            $s_domicilecertificate_actual_extention = strtolower(end($s_domicilecertificate_extention));
            $s_aadhaarcard_actual_extention = strtolower(end($s_aadhaarcard_extention));
    
            $s_passportphotograph_newname= "eAdmission".rand().".".$s_passportphotograph_actual_extention;
            $s_signature_newname= "eAdmission".rand().".".$s_signature_actual_extention;
            $s_hslccertificate__newname= "eAdmission".rand().".".$s_hslccertificate_actual_extention;
            $s_hslcmarksheet_newname= "eAdmission".rand().".".$s_hslcmarksheet_actual_extention;
            $s_bankpassbook_newname= "eAdmission".rand().".".$s_bankpassbook_actual_extention;
            $s_domicilecertificate_newname= "eAdmission".rand().".".$s_domicilecertificate_actual_extention;
            $s_aadhaarcard_newname= "eAdmission".rand().".".$s_aadhaarcard_actual_extention;

            if($info_registration['s_course']=="Higher Secondary"){
              $s_passportphotograph_name = $_FILES['s_passportphotograph']['name'];
              $s_passportphotograph_type = $_FILES['s_passportphotograph']['type'];
              $s_passportphotograph_size = $_FILES['s_passportphotograph']['size'];
              $s_passportphotograph_tmp = $_FILES['s_passportphotograph']['tmp_name'];
  
              $s_signature_name = $_FILES['s_signature']['name'];
              $s_signature_type = $_FILES['s_signature']['type'];
              $s_signature_size = $_FILES['s_signature']['size'];
              $s_signature_tmp = $_FILES['s_signature']['tmp_name'];
  
              $s_hslccertificate_name = $_FILES['s_hslccertificate']['name'];
              $s_hslccertificate_type = $_FILES['s_hslccertificate']['type'];
              $s_hslccertificate_size = $_FILES['s_hslccertificate']['size'];
              $s_hslccertificate_tmp = $_FILES['s_hslccertificate']['tmp_name'];
  
              $s_hslcmarksheet_name = $_FILES['s_hslcmarksheet']['name'];
              $s_hslcmarksheet_type = $_FILES['s_hslcmarksheet']['type'];
              $s_hslcmarksheet_size = $_FILES['s_hslcmarksheet']['size'];
              $s_hslcmarksheet_tmp = $_FILES['s_hslcmarksheet']['tmp_name'];
  
              $s_bankpassbook_name = $_FILES['s_bankpassbook']['name'];
              $s_bankpassbook_type = $_FILES['s_bankpassbook']['type'];
              $s_bankpassbook_size = $_FILES['s_bankpassbook']['size'];
              $s_bankpassbook_tmp = $_FILES['s_bankpassbook']['tmp_name'];
              
            }
            elseif($info_registration['s_course']=="Under Graduate"){
              $s_hscertificate_name = $_FILES['s_hscertificate']['name'];
              $s_hscertificate_type = $_FILES['s_hscertificate']['type'];
              $s_hscertificate_size = $_FILES['s_hscertificate']['size'];
              $s_hscertificate_tmp = $_FILES['s_hscertificate']['tmp_name'];
  
              $s_hsmarksheet_name = $_FILES['s_hsmarksheet']['name'];
              $s_hsmarksheet_type = $_FILES['s_hsmarksheet']['type'];
              $s_hsmarksheet_size = $_FILES['s_hsmarksheet']['size'];
              $s_hsmarksheet_tmp = $_FILES['s_hsmarksheet']['tmp_name'];  

              $s_hscertificate_location="";
              $s_hsmarksheet_location="";

              $s_hscertificate_extention = explode(".", $s_hscertificate_name);
              $s_hsmarksheet_extention = explode(".", $s_hsmarksheet_name);

              $s_hscertificate_actual_extention = strtolower(end($s_hscertificate_extention));
              $s_hsmarksheet_actual_extention = strtolower(end($s_hsmarksheet_extention));

              $s_hscertificate_newname= "eAdmission".rand().".".$s_hscertificate_actual_extention;
              $s_hsmarksheet_newname= "eAdmission".rand().".".$s_hsmarksheet_actual_extention;
            }
            elseif($info_registration['s_course']=="Post Graduate"){
              $s_hscertificate_name = $_FILES['s_hscertificate']['name'];
              $s_hscertificate_type = $_FILES['s_hscertificate']['type'];
              $s_hscertificate_size = $_FILES['s_hscertificate']['size'];
              $s_hscertificate_tmp = $_FILES['s_hscertificate']['tmp_name'];
  
              $s_hsmarksheet_name = $_FILES['s_hsmarksheet']['name'];
              $s_hsmarksheet_type = $_FILES['s_hsmarksheet']['type'];
              $s_hsmarksheet_size = $_FILES['s_hsmarksheet']['size'];
              $s_hsmarksheet_tmp = $_FILES['s_hsmarksheet']['tmp_name'];  
              
              $s_ugcertificate_name = $_FILES['s_ugcertificate']['name'];
              $s_ugcertificate_type = $_FILES['s_ugcertificate']['type'];
              $s_ugcertificate_size = $_FILES['s_ugcertificate']['size'];
              $s_ugcertificate_tmp = $_FILES['s_ugcertificate']['tmp_name'];
  
              $s_ugmarksheet_name = $_FILES['s_ugmarksheet']['name'];
              $s_ugmarksheet_type = $_FILES['s_ugmarksheet']['type'];
              $s_ugmarksheet_size = $_FILES['s_ugmarksheet']['size'];
              $s_ugmarksheet_tmp = $_FILES['s_ugmarksheet']['tmp_name'];

              $s_hscertificate_location="";
              $s_hsmarksheet_location="";
              $s_ugcertificate_location="";
              $s_ugmarksheet_location="";

              $s_hscertificate_extention = explode(".", $s_hscertificate_name);
              $s_hsmarksheet_extention = explode(".", $s_hsmarksheet_name);
              $s_ugcertificate_extention = explode(".", $s_ugcertificate_name);
              $s_ugmarksheet_extention = explode(".", $s_ugmarksheet_name);

              $s_hscertificate_actual_extention = strtolower(end($s_hscertificate_extention));
              $s_hsmarksheet_actual_extention = strtolower(end($s_hsmarksheet_extention));
              $s_ugcertificate_actual_extention = strtolower(end($s_ugcertificate_extention));
              $s_ugmarksheet_actual_extention = strtolower(end($s_ugmarksheet_extention));

              $s_hscertificate_newname= "eAdmission".rand().".".$s_hscertificate_actual_extention;
              $s_hsmarksheet_newname= "eAdmission".rand().".".$s_hsmarksheet_actual_extention;
              $s_ugcertificate_newname= "eAdmission".rand().".".$s_ugcertificate_actual_extention;
              $s_ugmarksheet_newname= "eAdmission".rand().".".$s_ugmarksheet_actual_extention;
            }

            if($info_additional['s_extracarricularquota']=="Yes"){
              $s_extracarricular_name = $_FILES['s_extracarricular']['name'];
              $s_extracarricular_type = $_FILES['s_extracarricular']['type'];
              $s_extracarricular_size = $_FILES['s_extracarricular']['size'];
              $s_extracarricular_tmp = $_FILES['s_extracarricular']['tmp_name'];

              $s_extracarricular_location="";

              $s_extracarricular_extention = explode(".", $s_extracarricular_name);

              $s_extracarricular_actual_extention = strtolower(end($s_extracarricular_extention));

              $s_extracarricular_newname= "eAdmission".rand().".".$s_extracarricular_actual_extention;
            }

            if($info_additional['s_differentlyabledquota']=="Yes"){
              $s_differentlyabled_name = $_FILES['s_differentlyabled']['name'];
              $s_differentlyabled_type = $_FILES['s_differentlyabled']['type'];
              $s_differentlyabled_size = $_FILES['s_differentlyabled']['size'];
              $s_differentlyabled_tmp = $_FILES['s_differentlyabled']['tmp_name'];
  
              $s_differentlyabled_location="";

              $s_differentlyabled_extention = explode(".", $s_differentlyabled_name);

              $s_differentlyabled_actual_extention = strtolower(end($s_differentlyabled_extention));

              $s_differentlyabled_newname= "eAdmission".rand().".".$s_differentlyabled_actual_extention;
            }

            if($info_additional['s_nccquota']=="Yes"){
              $s_ncc_name = $_FILES['s_ncc']['name'];
              $s_ncc_type = $_FILES['s_ncc']['type'];
              $s_ncc_size = $_FILES['s_ncc']['size'];
              $s_ncc_tmp = $_FILES['s_ncc']['tmp_name'];
  
              $s_ncc_location="";

              $s_ncc_extention = explode(".", $s_ncc_name);

              $s_ncc_actual_extention = strtolower(end($s_ncc_extention));

              $s_ncc_newname= "eAdmission".rand().".".$s_ncc_actual_extention;
            }

            if($info_personal['s_caste']!="General"){
              $s_castecertificate_name = $_FILES['s_castecertificate']['name'];
              $s_castecertificate_type = $_FILES['s_castecertificate']['type'];
              $s_castecertificate_size = $_FILES['s_castecertificate']['size'];
              $s_castecertificate_tmp = $_FILES['s_castecertificate']['tmp_name'];
  
              $s_castecertificate_location="";

              $s_castecertificate_extention = explode(".", $s_castecertificate_name);

              $s_castecertificate_actual_extention = strtolower(end($s_castecertificate_extention));

              $s_castecertificate_newname= "eAdmission".rand().".".$s_castecertificate_actual_extention;
            }

            if($info_additional['s_bplcategory']=="Yes"){
              $s_incomecertificate_name = $_FILES['s_incomecertificate']['name'];
              $s_incomecertificate_type = $_FILES['s_incomecertificate']['type'];
              $s_incomecertificate_size = $_FILES['s_incomecertificate']['size'];
              $s_incomecertificate_tmp = $_FILES['s_incomecertificate']['tmp_name'];
  
              $s_incomecertificate_location="";

              $s_incomecertificate_extention = explode(".", $s_incomecertificate_name);

              $s_incomecertificate_actual_extention = strtolower(end($s_incomecertificate_extention));

              $s_incomecertificate_newname= "eAdmission".rand().".".$s_incomecertificate_actual_extention;
            }

            if (in_array($s_passportphotograph_actual_extention, $s_extensions) && ($s_passportphotograph_size < $s_size) && ($info_registration['s_course']=="Higher Secondary")){
              
              $s_passportphotograph_location = "assets/docs/passport-photograph/".$s_passportphotograph_newname;
              $s_signature_location = "assets/docs/signature/".$s_signature_newname;
              $s_hslccertificate_location = "assets/docs/hslc-certificate/".$s_hslccertificate__newname;
              $s_hslcmarksheet_location = "assets/docs/hslc-marksheet/".$s_hslcmarksheet_newname;
              $s_bankpassbook_location = "assets/docs/bank-passbook/".$s_bankpassbook_newname;
              $s_domicilecertificate_location = "assets/docs/domicile-certificate/".$s_domicilecertificate_newname;
              $s_aadhaarcard_location = "assets/docs/aadhaar-card/".$s_aadhaarcard_newname;

              move_uploaded_file($s_passportphotograph_tmp, $s_passportphotograph_location);
              move_uploaded_file($s_signature_tmp, $s_signature_location);
              move_uploaded_file($s_hslccertificate_tmp, $s_hslccertificate_location);
              move_uploaded_file($s_hslcmarksheet_tmp, $s_hslcmarksheet_location);
              move_uploaded_file($s_bankpassbook_tmp, $s_bankpassbook_location);
              move_uploaded_file($s_domicilecertificate_tmp, $s_domicilecertificate_location);
              move_uploaded_file($s_aadhaarcard_tmp, $s_aadhaarcard_location);

              $sql_upload_update = "UPDATE `upload_documents` SET `s_passportphotograph`='$s_passportphotograph_location',`s_signature`='$s_signature_location',`s_hslccertificate`='$s_hslccertificate_location',`s_hslcmarksheet`='$s_hslcmarksheet_location',`s_bankpassbook`='$s_bankpassbook_location',`s_domicilecertificate`='$s_domicilecertificate_location',`s_aadhaarcard`='$s_aadhaarcard_location' WHERE `s_id`='$s_id'";
              $result_upload_update = mysqli_query($connect, $sql_upload_update);
      
            }
            elseif (in_array($s_passportphotograph_actual_extention, $s_extensions) && ($s_passportphotograph_size < $s_size) && ($info_registration['s_course']=="Under Graduate")){
              
              $s_passportphotograph_location = "assets/docs/passport-photograph/".$s_passportphotograph_newname;
              $s_signature_location = "assets/docs/signature/".$s_signature_newname;
              $s_hslccertificate_location = "assets/docs/hslc-certificate/".$s_hslccertificate__newname;
              $s_hslcmarksheet_location = "assets/docs/hslc-marksheet/".$s_hslcmarksheet_newname;
              $s_hscertificate_location = "assets/docs/hs-certificate/".$s_hscertificate_newname;
              $s_hsmarksheet_location = "assets/docs/hs-marksheet/".$s_hsmarksheet_newname;
              $s_bankpassbook_location = "assets/docs/bank-passbook/".$s_bankpassbook_newname;
              $s_domicilecertificate_location = "assets/docs/domicile-certificate/".$s_domicilecertificate_newname;
              $s_aadhaarcard_location = "assets/docs/aadhaar-card/".$s_aadhaarcard_newname;

              move_uploaded_file($s_passportphotograph_tmp, $s_passportphotograph_location);
              move_uploaded_file($s_signature_tmp, $s_signature_location);
              move_uploaded_file($s_hslccertificate_tmp, $s_hslccertificate_location);
              move_uploaded_file($s_hslcmarksheet_tmp, $s_hslcmarksheet_location);
              move_uploaded_file($s_hscertificate_tmp, $s_hscertificate_location);
              move_uploaded_file($s_hsmarksheet_tmp, $s_hsmarksheet_location);
              move_uploaded_file($s_bankpassbook_tmp, $s_bankpassbook_location);
              move_uploaded_file($s_domicilecertificate_tmp, $s_domicilecertificate_location);
              move_uploaded_file($s_aadhaarcard_tmp, $s_aadhaarcard_location);

              $sql_upload_update = "UPDATE `upload_documents` SET `s_passportphotograph`='$s_passportphotograph_location',`s_signature`='$s_signature_location',`s_hslccertificate`='$s_hslccertificate_location',`s_hslcmarksheet`='$s_hslcmarksheet_location',`s_hslcmarksheet`='[value-6]',`s_hscertificate`='$s_hscertificate_location',`s_hsmarksheet`='$s_hsmarksheet_location',`s_bankpassbook`='$s_bankpassbook_location',`s_domicilecertificate`='$s_domicilecertificate_location',`s_aadhaarcard`='$s_aadhaarcard_location' WHERE `s_id`='$s_id'";
              $result_upload_update = mysqli_query($connect, $sql_upload_update);

            }
            elseif (in_array($s_passportphotograph_actual_extention, $s_extensions) && ($s_passportphotograph_size < $s_size) && ($info_registration['s_course']=="Post Graduate")){
              
              $s_passportphotograph_location = "assets/docs/passport-photograph/".$s_passportphotograph_newname;
              $s_signature_location = "assets/docs/signature/".$s_signature_newname;
              $s_hslccertificate_location = "assets/docs/hslc-certificate/".$s_hslccertificate__newname;
              $s_hslcmarksheet_location = "assets/docs/hslc-marksheet/".$s_hslcmarksheet_newname;
              $s_hscertificate_location = "assets/docs/hs-certificate/".$s_hscertificate_newname;
              $s_hsmarksheet_location = "assets/docs/hs-marksheet/".$s_hsmarksheet_newname;
              $s_ugcertificate_location = "assets/docs/ug-certificate/".$s_ugcertificate_newname;
              $s_ugmarksheet_location = "assets/docs/ug-marksheet/".$s_ugmarksheet_newname;
              $s_bankpassbook_location = "assets/docs/bank-passbook/".$s_bankpassbook_newname;
              $s_domicilecertificate_location = "assets/docs/domicile-certificate/".$s_domicilecertificate_newname;
              $s_aadhaarcard_location = "assets/docs/aadhaar-card/".$s_aadhaarcard_newname;

              move_uploaded_file($s_passportphotograph_tmp, $s_passportphotograph_location);
              move_uploaded_file($s_signature_tmp, $s_signature_location);
              move_uploaded_file($s_hslccertificate_tmp, $s_hslccertificate_location);
              move_uploaded_file($s_hslcmarksheet_tmp, $s_hslcmarksheet_location);
              move_uploaded_file($s_hscertificate_tmp, $s_hscertificate_location);
              move_uploaded_file($s_hsmarksheet_tmp, $s_hsmarksheet_location);
              move_uploaded_file($s_ugcertificate_tmp, $s_ugcertificate_location);
              move_uploaded_file($s_ugmarksheet_tmp, $s_ugmarksheet_location);
              move_uploaded_file($s_bankpassbook_tmp, $s_bankpassbook_location);
              move_uploaded_file($s_domicilecertificate_tmp, $s_domicilecertificate_location);
              move_uploaded_file($s_aadhaarcard_tmp, $s_aadhaarcard_location);

              $sql_upload_update = "UPDATE `upload_documents` SET `s_passportphotograph`='$s_passportphotograph_location',`s_signature`='$s_signature_location',`s_hslccertificate`='$s_hslccertificate_location',`s_hslcmarksheet`='$s_hslcmarksheet_location',`s_hslcmarksheet`='[value-6]',`s_hscertificate`='$s_hscertificate_location',`s_hsmarksheet`='$s_hsmarksheet_location',`s_ugcertificate`='$s_ugcertificate_location',`s_ugmarksheet`='$s_ugmarksheet_location',`s_bankpassbook`='$s_bankpassbook_location',`s_domicilecertificate`='$s_domicilecertificate_location',`s_aadhaarcard`='$s_aadhaarcard_location' WHERE `s_id`='$s_id'";
              $result_upload_update = mysqli_query($connect, $sql_upload_update);

            }
            else{
              ?>
                <script type="text/javascript">
                  alert("Error while uploading picture. Please Check image size and extention");
                </script>
              <?php
            }

            if($info_additional['s_extracarricularquota']=="Yes"){
              $s_extracarricular_location = "assets/docs/extracarricular-activity-certificate/".$s_extracarricular_newname;
              move_uploaded_file($s_extracarricular_tmp, $s_extracarricular_location);

              $sql_extracarricular_update = "UPDATE `upload_documents` SET `s_extracarricular`='$s_extracarricular_location' WHERE `s_id`='$s_id'";
              $result_extracarricular_update = mysqli_query($connect, $sql_extracarricular_update);

            }

            if($info_additional['s_differentlyabledquota']=="Yes"){
              $s_differentlyabled_location = "assets/docs/differently-abled-certificate/".$s_differentlyabled_newname;
              move_uploaded_file($s_differentlyabled_tmp, $s_differentlyabled_location);

              $sql_differentlyabled_update = "UPDATE `upload_documents` SET `s_differentlyabled`='$s_differentlyabled_location' WHERE `s_id`='$s_id'";
              $result_differentlyabled_update = mysqli_query($connect, $sql_differentlyabled_update);

            }

            if($info_additional['s_nccquota']=="Yes"){
              $s_ncc_location = "assets/docs/ncc-certificate/".$s_ncc_newname;
              move_uploaded_file($s_ncc_tmp, $s_ncc_location);

              $sql_ncc_update = "UPDATE `upload_documents` SET `s_ncccertificate`='$s_ncc_location' WHERE `s_id`='$s_id'";
              $result_ncc_update = mysqli_query($connect, $sql_ncc_update);
              
            }

            if($info_personal['s_caste']!="General"){
              $s_castecertificate_location = "assets/docs/caste-certificate/".$s_castecertificate_newname;
              move_uploaded_file($s_castecertificate_tmp, $s_castecertificate_location);

              $sql_castecertificate_update = "UPDATE `upload_documents` SET `s_castecertificate`='$s_castecertificate_location' WHERE `s_id`='$s_id'";
              $result_castecertificate_update = mysqli_query($connect, $sql_castecertificate_update);

            }

            if($info_additional['s_bplcategory']=="Yes"){
              $s_incomecertificate_location = "assets/docs/income-certificate/".$s_incomecertificate_newname;
              move_uploaded_file($s_incomecertificate_tmp, $s_incomecertificate_location);

              $sql_incomecertificate_update = "UPDATE `upload_documents` SET `s_incomecertificate`='$s_incomecertificate_location' WHERE `s_id`='$s_id'";
              $result_incomecertificate_update = mysqli_query($connect, $sql_incomecertificate_update);

            }
          
          // $sql_registration_update = "UPDATE `registration_details` SET `s_status`='10' WHERE `s_id`='$s_id'";
          // $result_registration_update = mysqli_query($connect, $sql_registration_update);

            if($result_upload_update){
              ?>
                <script>
                  alert("Upload Documents Inserted Successfully!");
                  window.location.href="upload-documents3.php";
                </script>
              <?php
            }
          }
        }
        else{
        if(isset($_POST['submit_upload_documents'])){
        ?>
          <script>
            alert("Required Documents already exist!");
            window.location.href="upload-documents.php";
          </script>
        <?php
      }
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
    <link rel="stylesheet" href="css/upload-documents.css">
</head>
<body class="sidebar-is-reduced">
  <header class="l-header">
    <div class="l-header__inner clearfix">
      <div class="c-header-icon js-hamburger">
        <div class="hamburger-toggle"><span class="bar-top"></span><span class="bar-mid"></span><span class="bar-bot"></span></div>
      </div>
      <!-- <div class="c-header-icon has-dropdown"><span class="c-badge c-badge--red c-badge--header-icon animated swing">13</span><i class="fa fa-bell"></i>
        <div class="c-dropdown c-dropdown--notifications">
          <div class="c-dropdown__header"></div>
          <div class="c-dropdown__content"></div>
        </div>
      </div> -->
      <!-- <div class="c-search">
        <input class="c-search__input u-input" placeholder="Search..." type="text"/>
      </div> -->
      <div class="header-icons-group">
        <div class="user">
            <i class="fa fa-user" id="user"></i>
            <div class="username">Hello, <span><?php echo $info_registration['s_name']?></span>!</div>
        </div>
        <div class="c-header-icon logout">
            <a href="logout.php" class="logout" style="color:red">
                <i class="fa fa-power-off"></i>
            </a>
        </div>
      </div>
    </div>
  </header>
  <div class="l-sidebar">
    <div class="logo" style="background-color: #D3E8FF;">
      <div class="logo__txt">
          <img src="assets/icons/eadmission-icon.png" alt="eAdmission Logo">
      </div>
    </div>
    <div class="l-sidebar__content">
      <nav class="c-menu js-menu">
        <ul class="u-list">
          <a href="registration-details.php" style="text-decoration:none">
            <li class="c-menu__item" data-toggle="tooltip" title="Registration Details">
              <div class="c-menu__item__inner"><i class="fa fa-info"></i>
                <div class="c-menu-item__title"><span>Registration Details</span></div>
              </div>
            </li>
          </a>
          <a href="residential-details.php" style="text-decoration:none">
            <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Residential Details">
              <div class="c-menu__item__inner"><i class="fa fa-home"></i>
                <div class="c-menu-item__title"><span>Residential Details</span></div>
              </div>
            </li>
          </a>
          <a href="personal-details.php" style="text-decoration:none">
            <li class="c-menu__item has-submenu" data-toggle="tooltip" title="Personal Details">
              <div class="c-menu__item__inner"><i class="fa fa-user"></i>
                <div class="c-menu-item__title"><span>Personal Details</span></div>
              </div>
            </li>
          </a>
          <a href="family-details.php" style="text-decoration:none">
            <li class="c-menu__item" data-toggle="tooltip" title="Family Details">
              <div class="c-menu__item__inner"><i class="fa fa-users"></i>
                <div class="c-menu-item__title"><span>Family Details</span></div>
              </div>
            </li>
          </a>
          <a href="bank-details.php" style="text-decoration:none">
            <li class="c-menu__item" data-toggle="tooltip" title="Bank Details">
                <div class="c-menu__item__inner"><i class="fa fa-university"></i>
                <div class="c-menu-item__title"><span>Bank Details</span></div>
                </div>
            </li>
          </a>
          <a href="additional-details.php" style="text-decoration:none">
            <li class="c-menu__item" data-toggle="tooltip" title="Additional Details">
              <div class="c-menu__item__inner"><i class="fa fa-question"></i>
                <div class="c-menu-item__title"><span>Additional Details</span></div>
              </div>
            </li>
          </a>
          <a href="academic-details.php" style="text-decoration:none">
            <li class="c-menu__item" data-toggle="tooltip" title="Academic Details">
              <div class="c-menu__item__inner"><i class="fa fa-graduation-cap"></i>
                <div class="c-menu-item__title"><span>Academic Details</span></div>
              </div>
            </li>
          </a>
          <a href="course-details.php" style="text-decoration:none">
            <li class="c-menu__item" data-toggle="tooltip" title="Course Details">
              <div class="c-menu__item__inner"><i class="fa fa-book"></i>
                <div class="c-menu-item__title"><span>Course Details</span></div>
              </div>
            </li>
          </a>
          <a href="upload-documents.php" style="text-decoration:none">
            <li class="c-menu__item is-active" data-toggle="tooltip" title="Upload Documents">
              <div class="c-menu__item__inner"><i class="fa fa-upload"></i>
                <div class="c-menu-item__title"><span>Upload Documents</span></div>
              </div>
            </li>
          </a>
        </ul>
      </nav>
    </div>
  </div>
</body>
<main class="l-main">
  <div class="content-wrapper content-wrapper--with-bg">
    <h2 class="page-title">Upload Documents</h2>
    <?php if ($success == 1) { ?>
      <div class="alert alert-success alert-dismissible" role="alert">
        Course Details submitted successfully!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php } elseif ($success == 2) { ?>
      <div class="alert alert-danger alert-dismissible" role="alert">
        Course Details already submitted!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <?php } ?>
    <div class="page-content">
      <form action="upload-documents3.php" method="post" autocomplete="off" enctype="multipart/form-data">
        <div class="form-group col-md-9">
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="InputSelectSubjects">Upload the required documents <span style="color:red; font-weight:bold; font-size: medium;"> *</span></label>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <span id="PassportPhotoHelpline">Passport Sized Photograph<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
            </div>
            <div class="form-group col-md-6">              
              <?php if($info_upload['s_passportphotograph']=="") { ?>
                <input type="file" name="s_passportphotograph" accept="image/jpg, image/jpeg, image/png" onchange="readURL(this);" required>
              <?php } else { ?>
                <input type="file" disabled>
              <?php } ?>
              <small id="passportHelpInline" class="text-muted">
                Upload Passport Sized Photograph of student.
              </small>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <span id="SignatureHelpline">Signature<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
            </div>
            <div class="form-group col-md-6">
              <?php if($info_upload['s_signature']=="") { ?>
                <input type="file" name="s_signature" accept=".jpg, .jpeg, .png" onchange="readURL1(this);" required>
              <?php } else { ?>
                <input type="file" disabled>
              <?php } ?>
              <small id="signatureHelpInline" class="text-muted">
                Upload Signature of student.
              </small>
            </div>
          </div>
          <?php if($info_registration['s_course']=="Higher Secondary") { ?>
            <div class="form-row">
              <div class="form-group col-md-6">
                <span id="HSLCCertificateHelpline">HSLC Certificate<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
              </div>
              <div class="form-group col-md-6">
                <?php if($info_upload['s_hslccertificate']=="") { ?>
                  <input type="file" name="s_hslccertificate" accept=".pdf" required>
                <?php } else { ?>
                  <input type="file" disabled>
                <?php } ?>
                <small id="hslccertificateHelpInline" class="text-muted">
                  Upload HSLC Certificate of student.
                </small>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <span id="HSLCMarksheetHelpline">HSLC Marksheet<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
              </div>
              <div class="form-group col-md-6">
                <?php if($info_upload['s_hslcmarksheet']=="") { ?>
                  <input type="file" name="s_hslcmarksheet" accept=".pdf" required>
                <?php } else { ?>
                  <input type="file" disabled>
                <?php } ?>
                <small id="hslcmarksheetHelpInline" class="text-muted">
                  Upload HSLC Marksheet of student.
                </small>
              </div>
            </div>
          <?php } elseif($info_registration['s_course']=="Under Graduate") { ?>
            <div class="form-row">
              <div class="form-group col-md-6">
                <span id="HSLCCertificateHelpline">HSLC Certificate<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
              </div>
              <div class="form-group col-md-6">
                <?php if($info_upload['s_hslccertificate']=="") { ?>
                  <input type="file" name="s_hslccertificate" accept=".pdf" required>
                <?php } else { ?>
                  <input type="file" disabled>
                <?php } ?>
                <small id="hslccertificateHelpInline" class="text-muted">
                  Upload HSLC Certificate of student.
                </small>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <span id="HSLCMarksheetHelpline">HSLC Marksheet<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
              </div>
              <div class="form-group col-md-6">
                <?php if($info_upload['s_hslcmarksheet']=="") { ?>
                  <input type="file" name="s_hslcmarksheet" accept=".pdf" required>
                <?php } else { ?>
                  <input type="file" disabled>
                <?php } ?>
                <small id="hslcmarksheetHelpInline" class="text-muted">
                  Upload HSLC Marksheet of student.
                </small>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <span id="HSCertificateHelpline">HS Certificate<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
              </div>
              <div class="form-group col-md-6">
                <?php if($info_upload['s_hscertificate']=="") { ?>
                  <input type="file" name="s_hscertificate" accept=".pdf" required>
                <?php } else { ?>
                  <input type="file" disabled>
                <?php } ?>
                <small id="hscertificateHelpInline" class="text-muted">
                  Upload HS Certificate of student.
                </small>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <span id="HSMarksheetHelpline">HS Marksheet<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
              </div>
              <div class="form-group col-md-6">
                <?php if($info_upload['s_hsmarksheet']=="") { ?>
                  <input type="file" name="s_hsmarksheet" accept=".pdf" required>
                <?php } else { ?>
                  <input type="file" disabled>
                <?php } ?>
                <small id="hsmarksheetHelpInline" class="text-muted">
                  Upload HS Marksheet of student.
                </small>
              </div>
            </div>
          <?php } else { ?>
            <div class="form-row">
              <div class="form-group col-md-6">
                <span id="HSLCCertificateHelpline">HSLC Certificate<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
              </div>
              <div class="form-group col-md-6">
                <?php if($info_upload['s_hslccertificate']=="") { ?>
                  <input type="file" name="s_hslccertificate" accept=".pdf" required>
                <?php } else { ?>
                  <input type="file" disabled>
                <?php } ?>
                <small id="hslccertificateHelpInline" class="text-muted">
                  Upload HSLC Certificate of student.
                </small>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <span id="HSLCMarksheetHelpline">HSLC Marksheet<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
              </div>
              <div class="form-group col-md-6">
              <?php if($info_upload['s_hslcmarksheet']=="") { ?>
                  <input type="file" name="s_hslcmarksheet" accept=".pdf" required>
                <?php } else { ?>
                  <input type="file" disabled>
                <?php } ?>
                <small id="hslcmarksheetHelpInline" class="text-muted">
                  Upload HSLC Marksheet of student.
                </small>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <span id="HSCertificateHelpline">HS Certificate<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
              </div>
              <div class="form-group col-md-6">
              <?php if($info_upload['s_hscertificate']=="") { ?>
                  <input type="file" name="s_hscertificate" accept=".pdf" required>
                <?php } else { ?>
                  <input type="file" disabled>
                <?php } ?>
                <small id="hscertificateHelpInline" class="text-muted">
                  Upload HS Certificate of student.
                </small>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <span id="HSMarksheetHelpline">HS Marksheet<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
              </div>
              <div class="form-group col-md-6">
                <?php if($info_upload['s_hsmarksheet']=="") { ?>
                  <input type="file" name="s_hsmarksheet" accept=".pdf" required>
                <?php } else { ?>
                  <input type="file" disabled>
                <?php } ?>
                <small id="hsmarksheetHelpInline" class="text-muted">
                  Upload HS Marksheet of student.
                </small>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <span id="UGCertificateHelpline">UG Certificate<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
              </div>
              <div class="form-group col-md-6">
                <?php if($info_upload['s_ugcertificate']=="") { ?>
                  <input type="file" name="s_ugcertificate" accept=".pdf" required>
                <?php } else { ?>
                  <input type="file" disabled>
                <?php } ?>
                <small id="ugcertificateHelpInline" class="text-muted">
                  Upload UG Certificate of student.
                </small>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <span id="UGMarksheetHelpline">UG Marksheet<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
              </div>
              <div class="form-group col-md-6">
                <?php if($info_upload['s_ugmarksheet']=="") { ?>
                  <input type="file" name="s_ugmarksheet" accept=".pdf" required>
                <?php } else { ?>
                  <input type="file" disabled>
                <?php } ?>
                <small id="ugmarksheetHelpInline" class="text-muted">
                  Upload UG Marksheet of student.
                </small>
              </div>
            </div>
          <?php } ?>
          <div class="form-row">
            <div class="form-group col-md-6">
              <span id="BankPassbookHelpline">Bank Passbook/Cancelled Cheque Front Page<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
            </div>
            <div class="form-group col-md-6">
              <?php if($info_upload['s_bankpassbook']=="") { ?>
                <input type="file" name="s_bankpassbook" accept=".pdf" required>
              <?php } else { ?>
                <input type="file" disabled>
              <?php } ?>
              <small id="bankpassbookHelpInline" class="text-muted">
                Upload Bank Passbook/Cancelled Cheque of student.
              </small>
            </div>
          </div>
          <?php if($info_additional['s_extracarricularquota']=="Yes") { ?>
          <div class="form-row">
            <div class="form-group col-md-6">
              <span id="ExtraCarricularHelpline">Extra Carricular Activity Certificate<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
            </div>
            <div class="form-group col-md-6">
              <?php if($info_upload['s_extracarricular']=="") { ?>
                <input type="file" name="s_extracarricular" accept=".pdf" required>
              <?php } else { ?>
                <input type="file" disabled>
              <?php } ?>
              <small id="extracarricularHelpInline" class="text-muted">
                Upload Extra Carricular Activity Certificate of student.
              </small>
            </div>
          </div>
          <?php } ?>
          <?php if($info_additional['s_differentlyabledquota']=="Yes") { ?>
          <div class="form-row">
            <div class="form-group col-md-6">
              <span id="DifferentlyAbledHelpline">Differently Abled Certificate<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
            </div>
            <div class="form-group col-md-6">
              <?php if($info_upload['s_differentlyabled']=="") { ?>
                <input type="file" name="s_differentlyabled" accept=".pdf"required>
                Upload Differently Abled Certificate of student.
              <?php } else { ?>
                <input type="file" disabled>
              <?php } ?>
              <small id="differentlyabledHelpInline" class="text-muted">
                Upload Differently Abled Certificate of student.
              </small>
            </div>
          </div>
          <?php } ?>
          <?php if($info_additional['s_nccquota']=="Yes") { ?>
          <div class="form-row">
            <div class="form-group col-md-6">
              <span id="NCCHelpline">NCC Certificate<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
            </div>
            <div class="form-group col-md-6">
              <?php if($info_upload['s_ncccertificate']=="") { ?>
                <input type="file" name="s_ncc" accept=".pdf" required>
              <?php } else { ?>
                <input type="file" disabled>
              <?php } ?>
              <small id="nccHelpInline" class="text-muted">
                Upload NCC Certificate of student.
              </small>
            </div>
          </div>
          <?php } ?>
          <?php if($info_personal['s_caste']!="General") { ?>
          <div class="form-row">
            <div class="form-group col-md-6">
              <span id="CasteCertificateHelpline">Caste Certificate<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
            </div>
            <div class="form-group col-md-6">
              <?php if($info_upload['s_castecertificate']=="") { ?>
                <input type="file" name="s_castecertificate" accept=".pdf" required>
              <?php } else { ?>
                <input type="file" disabled>
              <?php } ?>
              <small id="castecertificateHelpInline" class="text-muted">
                Upload Caste Certificate of student.
              </small>
            </div>
          </div>
          <?php } ?>
          <?php if($info_additional['s_bplcategory']=="Yes") { ?>
          <div class="form-row">
            <div class="form-group col-md-6">
              <span id="IncomeCertificateHelpline">Income Certificate<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
            </div>
            <div class="form-group col-md-6">
              <?php if($info_upload['s_incomecertificate']=="") { ?>
                <input type="file" name="s_incomecertificate" accept=".pdf" required>
              <?php } else { ?>
                <input type="file" disabled>
              <?php } ?>
              <small id="incomecertificateHelpInline" class="text-muted">
                Upload Income Certificate of student.
              </small>
            </div>
          </div>
          <?php } ?>
          <div class="form-row">
            <div class="form-group col-md-6">
              <span id="DomicileCertificateHelpline">Domicile Certificate<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
            </div>
            <div class="form-group col-md-6">
              <?php if($info_upload['s_domicilecertificate']=="") { ?>
                <input type="file" name="s_domicilecertificate" accept=".pdf" required>
              <?php } else { ?>
                <input type="file" disabled>
              <?php } ?>
              <small id="domicilecertificateHelpInline" class="text-muted">
                Upload Domicile Certificate of student.
              </small>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <span id="AadhaarCardHelpline">Aadhaar Card/Voter Card<span style="color:red; font-weight:bold; font-size: medium;"> *</span></span>
            </div>
            <div class="form-group col-md-6">
              <?php if($info_upload['s_aadhaarcard']=="") { ?>
                <input type="file" name="s_aadhaarcard" accept=".pdf" required>
              <?php } else { ?>
                <input type="file" disabled>
              <?php } ?>
              <small id="aadhaarcardHelpInline" class="text-muted">
                Upload Aadhaar Card/Voter Card of student.
              </small>
            </div>
          </div>
        </div>

        <div class="form-group col-md-3">
          <div class="form-row">
            <div class="form-group col-md-12">
              <div class="form-group passbox">
                <?php if($info_upload['s_passportphotograph']=="") { ?>
                <img id="passport" src="https://apt.co.zw/wp-content/uploads/2016/12/apt-avatar.jpg" alt="Passport Sized Photograph"/>
                <?php } else{ ?>
                <img id="passport" src="<?php echo $info_upload['s_passportphotograph'] ?>" alt="Passport Sized Photograph">
                <?php } ?>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <div class="form-group signbox">
                <?php if($info_upload['s_signature']=="") { ?>
                <img id="signature" src="http://via.placeholder.com/184x104.png/FFFFFF?text=Signature" alt="Signature"/>
                <?php } else{ ?>
                <img id="signature" src="<?php echo $info_upload['s_signature'] ?>" alt="Signature">
                <?php } ?>
              </div>
            </div>
          </div>
        </div>

        <div class="form-row">
          <!-- <div class="form-group col-md-8" style="text-align:left">
            <button type="submit" name="prev_course_details" class="btn btn-warning">Prev</button>
            <button type="submit" name="next_course_details" class="btn btn-info">Next</button>
          </div> -->
          <div class="form-group col-md-12" style="text-align:right">
            <button type="submit" name="submit_upload_documents" class="btn btn-success">Save Upload Documents</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</main>
<div class="footer">&copy; 2022 | <strong>eAdmission System</strong> | All Rights are Reserved</div>
</html>

<script src="js/upload-documents.js"></script>