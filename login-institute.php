<?php
    session_start();
    date_default_timezone_set("Asia/Calcutta");
    require("connection.php");
    $page_title = "Institute Login";
    $success = "";
    $date = date("Y-m-d");

    if(isset($_POST['ins_register'])){
        $ins_name = mysqli_real_escape_string($connect,$_POST['ins_name']);
        $ins_email = mysqli_real_escape_string($connect,$_POST['ins_email']);
        $ins_phone = mysqli_real_escape_string($connect,$_POST['ins_phone']);
        $ins_password = md5(mysqli_real_escape_string($connect,$_POST['ins_password']));

        $sql_ins_register = "INSERT INTO `institute`(`ins_name`, `ins_email`, `ins_phone`, `ins_password`, `ins_regdate`) 
        VALUES ('$ins_name','$ins_email','$ins_phone','$ins_password', '$date')";
        $result_ins_register = mysqli_query($connect, $sql_ins_register);

        if($result_ins_register){
            $success = 1;
            $sql_institute = "SELECT * FROM institute WHERE `ins_phone` = $ins_phone";
            $result_institute = mysqli_query($connect, $sql_institute);
            $num_institute = mysqli_num_rows($result_institute);
            $info_institute = mysqli_fetch_assoc($result_institute);
            $_SESSION['ins_id'] = $info_institute['ins_id'];
            if($num_institute==1){
                ?>
                <script>
                    window.location.href="index-institute.php";
                </script>
            <?php
            }
        }
        else{
            $success = 2;
            echo "Some Error Occurred!";
        }
    }

    if(isset($_POST['ins_login'])){
        $ins_email = mysqli_real_escape_string($connect,$_POST['ins_email']);
        $ins_password = md5(mysqli_real_escape_string($connect,$_POST['ins_password']));
        $sql_ins_login = "SELECT * FROM institute WHERE `ins_email` = '$ins_email' AND `ins_password` = '$ins_password'";
        $result_ins_login = mysqli_query($connect, $sql_ins_login);
        $num_ins_login = mysqli_num_rows($result_ins_login);
        $info_ins_login = mysqli_fetch_assoc($result_ins_login);

        if($num_ins_login==1){
            $_SESSION['ins_id'] = $info_ins_login['ins_id'];
            if($info_ins_login['ins_status']=='0'){
                ?>
                <script>
                    window.location.href="index-institute.php";
                </script>
                <?php
            }
            elseif($info_ins_login['ins_status']=='1'){
                ?>
                <script>
                    window.location.href="index-institute.php";
                </script>
                <?php
            }
            elseif($info_ins_login['ins_status']=='2'){
                ?>
                <script>
                    window.location.href="index-institute.php";
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
    <link rel="stylesheet" href="css/login-institute.css">
</head>
<body>
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="login-institute.php" method="post">
			<h1 style="margin-bottom: 25px;">Institute Register</h1>
			<input type="text" name="ins_name" id="ins_name" placeholder="Institute Name" required>
			<input type="email" name="ins_email" id="ins_email" placeholder="Institute Email ID" required>
			<input type="tel" name="ins_phone" id="ins_phone" pattern="[1-9]{1}[0-9]{9}" placeholder="Institute Phone No" required>
			<input type="password" name="ins_password" id="ins_password" placeholder="Password" required>
			<button type="submit" name="ins_register" style="margin-top: 25px; cursor: pointer;">Register</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="login-institute.php" method="post">
			<h1 style="margin-bottom: 25px;">Institute Log in</h1>
			<input type="email" name="ins_email" id="ins_password" placeholder="Email" required>
			<input type="password" name="ins_password" id="ins_password" placeholder="Password" required>
			<button type="submit" name="ins_login" style="margin-top: 25px; cursor: pointer;">Log In</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
                <span><img src="assets/images/eadmission-logo.PNG" height="94px" width="168px"></span>
				<p style="text-shadow: 2px 2px 10px #00533E;">If your university is already registered, just sign in. Students've missed you!</p>
				<button class="ghost" id="signIn">Log In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<span><img src="assets/images/eadmission-logo.PNG" height="94px" width="168px"></span>
				<p style="text-shadow: 1px 1px 10px #00533E;">Register at India's No #1 digital admission portal for your University!</p>
				<button class="ghost" id="signUp">Register</button>
			</div>
		</div>
	</div>
</div>

<div class="footer">
    <div>
        <button onclick="window.location.href='login.php'" class="institute-login">Student Login</i></button>
    </div>
</div>
</body>
</html>

<script src="js/login-institute.js"></script>