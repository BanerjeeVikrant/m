<?php
require "system/connect.php";

session_start();
if (isset($_SESSION['user_login'])) {
	$username = $_SESSION['user_login'];
}
else{
	$username = "";
}
if($username){

	$check = $conn->query("SELECT * FROM users WHERE username='$username'");
	if ($check->num_rows == 1) {
		$get = $check->fetch_assoc();
		$username = $get['username'];
		$firstname = $get['first_name'];
		$lastname = $get['last_name'];
		$bio = $get['bio'];
		$sex = $get['sex'];
		$interests = $get['interests'];
		$dob = $get['dob'];
		$relationship = $get['relationship'];
		$midschool = $get['ms'];
		$elemschool = $get['es'];
			
	} 

}else{
	die("You must be <a href = '/v2/socialnetwork/'>logged in.</a>");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>bruincave</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="shortcut icon" href="/bkd/img/bearpic.png">
	<meta name="theme-color" content="#1d2d4a" />
	<!--other resourses, external source(help)-->
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=IM+Fell+English+SC" />
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Carter+One" />
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Alice" />
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=PT+Serif+Caption" />

	<!--jquery 2.2.0-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>

	<!--angularjs 1.4.8-->
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>

	<!--bootstrap 3.3.6-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

	<style type="text/css">
		*{
			font-family: 'PT Serif Caption';
		}
		body{
			overflow-x: hidden;
			background-color: #e6e6e6;
		}
		.top-bar{
			display: inline-block;
			position: fixed;
			z-index: 9;
			padding: 15px;
			width: 100vw;
			height: 60px;
			background-color: #1d2d4a;
		}
		.back-img{
			display: inline-block;
			height: 32px;
			width:32px;
			background-image: url(img/back.png);
			background-size: cover;
			background-repeat: no-repeat;
		}
		.settingsbar-wrapper{
			display: inline-block;
		}
		.settings-tool-wrapper{
			display: inline-block;
			color: white;
			padding-left: 4px;
			font-size: 17px;
			position: relative;
			top: -9px;
			left: 10px;
			font-size: 18px;
		}
		.message-settingsbar{
		    display: inline-block;
		    height: 30px;
		    width: 30px;
		    background-image: url(img/speech-start.png);
		    background-size: cover;
		    background-repeat: no-repeat;
		    position: relative;
		    left: 15px;
		}
		.messages-wrapper {
		    height: 100vh;
		    width: 100vw;
		    position: fixed;
		    top: 0;
		    background: rgba(0,0,0, 0.9);
		    z-index: 9;
		    color: white;
		}
		.info {
		    position: relative;
		    width: 90vw;
		    height: 40px;
		    left: 5vw;
		    border: 0;
		    padding-left: 15px;
		    font-size: 14px;
		    border: 1px solid #b1afaf;
		    margin-top: 5px;
		}
		span.subject-info {
		    position: relative;
		    left: 25px;
		    top: 5px;
		}
		textarea.bio {
		    position: relative;
		    top: 15px;
		    width: 90vw;
		    left: 5vw;
		    height: 100px;
		    padding-left: 15px;
		    padding-top: 10px;
		    resize: none;
		}
		input.save-btn {
		    position: relative;
		    top: 35px;
		    height: 35px;
		    width: 120px;
		    left: calc(50% - 60px);
		    background: #1d2d4a;
		    color: white;
		    border: 0;
		    border-radius: 5px;
		    font-size: 15px;
		}
	</style>

</head>
<body>
	<div class="top-bar">
		<a href="home.php"><div class="back-img"></div></a>

		<div class="settingsbar-wrapper">
			<div class="settings-tool-wrapper">
				Settings
			</div>
		</div>
	</div>
	<div style="height:75px"></div>
	<form method="POST" action="#">
		<span class="subject-info">Username</span>
		<input class="info info-username" type="text" name="username" value="<?php echo $username;?>">
		<span class="subject-info">Firstname</span>
		<input class="info info-firstname" type="text" name="firstname" value="<?php echo $firstname;?>">
		<span class="subject-info">Lastame</span>
		<input class="info info-lastname" type="text" name="lastname" value="<?php echo $lastname;?>">
		<span class="subject-info">Interests</span>
		<input class="info info-interests" type="text" name="interests" value="<?php echo $interests;?>">
		<textarea name="bio" class="bio"><?php echo $bio;?></textarea>

		<input type="submit" name="savechanges" class="save-btn" value="Save">
	</form>
</body>
</html>