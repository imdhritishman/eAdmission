<?php
    session_start();
    date_default_timezone_set("Asia/Calcutta");
    require("connection.php");
    $page_title = "Login";
    $success = "";

    if(isset($_POST['s_register'])){
        $s_name = mysqli_real_escape_string($connect,$_POST['s_name']);
        $s_email = mysqli_real_escape_string($connect,$_POST['s_email']);
        $s_phone = mysqli_real_escape_string($connect,$_POST['s_phone']);
        $s_password = md5(mysqli_real_escape_string($connect,$_POST['s_password']));

        $sql_s_register = "INSERT INTO `registration_details`(`s_name`, `s_email`, `s_phone`, `s_password`) 
        VALUES ('$s_name','$s_email','$s_phone','$s_password')";
        $result_s_register = mysqli_query($connect, $sql_s_register);

        if($result_s_register){
            $success = 1;
            $sql_student = "SELECT * FROM registration_details WHERE `s_phone` = $s_phone";
            $result_student = mysqli_query($connect, $sql_student);
            $num_student = mysqli_num_rows($result_student);
            $info_student = mysqli_fetch_assoc($result_student);
            $_SESSION['s_id'] = $info_student['s_id'];
            $s_id = $info_student['s_id'];
            $s_name = $info_student['s_name'];

            $sql_residential_details = "INSERT INTO `residential_details`(`s_id`, `s_name`) VALUES ('$s_id','$s_name')";
            $result_residential_details = mysqli_query($connect, $sql_residential_details);

            $sql_personal_details = "INSERT INTO `personal_details`(`s_id`, `s_name`) VALUES ('$s_id','$s_name')";
            $result_personal_details = mysqli_query($connect, $sql_personal_details);

            $sql_family_details = "INSERT INTO `family_details`(`s_id`, `s_name`) VALUES ('$s_id','$s_name')";
            $result_family_details = mysqli_query($connect, $sql_family_details);

            $sql_bank_details = "INSERT INTO `bank_details`(`s_id`, `s_name`) VALUES ('$s_id','$s_name')";
            $result_bank_details = mysqli_query($connect, $sql_bank_details);

            $sql_additional_details = "INSERT INTO `additional_details`(`s_id`, `s_name`) VALUES ('$s_id','$s_name')";
            $result_additional_details = mysqli_query($connect, $sql_additional_details);

            $sql_academic_details = "INSERT INTO `academic_details`(`s_id`, `s_name`) VALUES ('$s_id','$s_name')";
            $result_academic_details = mysqli_query($connect, $sql_academic_details);

            $sql_course_details = "INSERT INTO `course_details`(`s_id`, `s_name`) VALUES ('$s_id','$s_name')";
            $result_course_details = mysqli_query($connect, $sql_course_details);

            $sql_upload_documents = "INSERT INTO `upload_documents`(`s_id`, `s_name`) VALUES ('$s_id','$s_name')";
            $result_upload_documents = mysqli_query($connect, $sql_upload_documents);

            if($num_student==1){
                ?>
                <script>
                    window.location.href="registration-details.php";
                </script>
            <?php
            }
        }
        else{
            $success = 2;
            echo "Some Error Occurred!";
        }
    }

    if(isset($_POST['s_login'])){
        $s_email = mysqli_real_escape_string($connect,$_POST['s_email']);
        $s_password = md5(mysqli_real_escape_string($connect,$_POST['s_password']));
        $sql_s_login = "SELECT * FROM registration_details WHERE `s_email` = '$s_email' AND `s_password` = '$s_password'";
        $result_s_login = mysqli_query($connect, $sql_s_login);
        $num_s_login = mysqli_num_rows($result_s_login);
        $info_s_login = mysqli_fetch_assoc($result_s_login);

        if($num_s_login==1){
            $_SESSION['s_id'] = $info_s_login['s_id'];
            if($info_s_login['s_status']=='1'){
                ?>
                <script>
                    window.location.href="registration-details.php";
                </script>
                <?php
            }
            elseif($info_s_login['s_status']=='2'){
                ?>
                <script>
                    window.location.href="residential-details.php";
                </script>
                <?php
            }
            elseif($info_s_login['s_status']=='3'){
                ?>
                <script>
                    window.location.href="personal-details.php";
                </script>
                <?php
            }
            elseif($info_s_login['s_status']=='4'){
                ?>
                <script>
                    window.location.href="family-details.php";
                </script>
                <?php
            }
            elseif($info_s_login['s_status']=='5'){
                ?>
                <script>
                    window.location.href="bank-details.php";
                </script>
                <?php
            }
            elseif($info_s_login['s_status']=='6'){
                ?>
                <script>
                    window.location.href="additional-details.php";
                </script>
                <?php
            }
            elseif($info_s_login['s_status']=='7'){
                ?>
                <script>
                    window.location.href="academic-details.php";
                </script>
                <?php
            }
            elseif($info_s_login['s_status']=='8'){
                ?>
                <script>
                    window.location.href="course-details.php";
                </script>
                <?php
            }
            elseif($info_s_login['s_status']=='9'){
                ?>
                <script>
                    window.location.href="upload-documents.php";
                </script>
                <?php
            }
            else{
                ?>
                <script>
                    window.location.href="index.php";
                </script>
                <?php
            }
        }
        else{
            $success = 3;
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
    <link rel="shortcut icon" type="image/x-icon" href="assets/icons/eadmission-logo.png" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="login.php" method="post">
			<h1 style="margin-bottom: 25px;">Register</h1>
			<input type="text" name="s_name" id="s_name" placeholder="Full Name" required>
			<input type="email" name="s_email" id="s_email" placeholder="Email ID" required>
			<input type="tel" name="s_phone" id="s_phone" pattern="[1-9]{1}[0-9]{9}" placeholder="Phone No" required>
			<input type="password" name="s_password" id="s_password" placeholder="Password" required>
			<button type="submit" name="s_register" style="margin-top: 25px; cursor: pointer;">Register</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="login.php" method="post">
			<h1 style="margin-bottom: 25px;">Log in</h1>
			<input type="email" name="s_email" id="s_password" placeholder="Email" required>
			<input type="password" name="s_password" id="s_password" placeholder="Password" required>
			<button type="submit" name="s_login" style="margin-top: 25px; cursor: pointer;">Log In</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
                <span><img src="assets/images/eadmission-logo.PNG" height="94px" width="168px"></span>
				<p style="text-shadow: 2px 2px 10px #00533E;">If you already have an account, just sign in. We've missed you!</p>
				<button class="ghost" id="signIn">Log In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<span><img src="assets/images/eadmission-logo.PNG" height="94px" width="168px"></span>
				<p style="text-shadow: 1px 1px 10px #00533E;">Register at North East India's No #1 placement driven University!</p>
				<button class="ghost" id="signUp">Register</button>
			</div>
		</div>
	</div>
</div>

<div class="footer">
    <div>
        <button onclick="window.location.href='login-institute.php'" class="institute-login">Institute Login</i></button>
    </div>
</div>
</body>
</html>

<script src="js/login.js"></script>