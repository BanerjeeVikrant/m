<?php
require "system/connect.php";

session_start();
if (isset($_SESSION['user_login'])) {
	$username = $_SESSION['user_login'];
}
else{
	$username = "";
}

//Login
$user_login = "";
if (isset($_POST["user_login"]) && isset($_POST["password_login"])) {
	$user_login = $_POST["user_login"];
    	$password_login = $_POST["password_login"];
	$md5password_login = md5($password_login);
    	$result = $conn->query("SELECT id FROM users WHERE username='$user_login' AND password='$md5password_login' AND activated='1' LIMIT 1"); // query the person
	//Check for their existance
	$userCount = $result->num_rows; //Count the number of rows returned
	if ($userCount == 1) {
		$row = $result->fetch_assoc();
             	$id = $row["id"];
		$_SESSION["id"] = $id;
		$_SESSION["user_login"] = $user_login;
		$_SESSION["password_login"] = $password_login;

		//echo 'header("Location: http://www.gogogoru.com/v2/socialnetwork/php/home.php");';
         	
	} else {
		echo 'That information is incorrect, try again';
		exit();
	}
	
}
if ($user_login != "") {

	echo "\n<script>window.location.assign('profile.php?u=$user_login'); </script>\n";
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
			display: inline-block;
			width: 100vw;
			height: 100vh;
			background: linear-gradient(#1d2d4a, rgb(0, 53, 124));
			overflow: hidden;
		}
		.logo-img{
			height: 40px;
			width: 40px;
			background-image: url(img/paw-logo.png);
			display: inline-block;
			position: absolute;
			left: calc(50% - 22.5px);
			top: calc(19% - 22.5px);
			background-size: cover;
			background-repeat: no-repeat;
		}
		.slogan{
			display: inline-block;
			color: white;
			font-size: 12px;
			position: absolute;
			left: calc(50% - 68px);
			top: calc(19% + 24.5px);
		}
		.form-inputs{
			position: absolute;
			top: calc(40% - 30px);
			text-align: center;
		}
		.login-inputs{
			width: 90vw;
			margin-top: 20px;
			background: transparent;
			border: 0;
			border-bottom: 2px solid white;
			padding-left: 7px;
			outline:0;
			color: white;
		}
		.submit-login{
			width: 90vw;
			height: 34px;
			position: absolute;
			top: calc(40% + 78px);
			left: calc(50% - 45vw);
			border: 0;
			background: white;
			color: black;
			font-size: 14px;
		}
		.fg-psw-text{
			display: inline-block;
			position: absolute;
			color: white;
			top: calc(40% + 118px);
			left: calc(50% - 61px);
		}
		.register-btn{
			width: 90vw;
			height: 36px;
			position: absolute;
			top: calc(100% - 45px);
			left: calc(50% - 45vw);
			border: 0;
			background: #2a4c79;
			color: white;
			font-size: 14px;
			font-family: 'PT Serif Caption';
		}

		@media only screen and (min-height : 500px){
			.register-btn{
				top: calc(100vh - 70px);
			}
		}
		@media only screen and (max-height : 320px){
			body{
				height: 320px;
				overflow-y: scroll;
			}
			.register-btn{
				top: calc(40% + 150px);
			}
		}
		@media only screen and (max-height : 210px){
			.login-inputs{
				margin-top: 5px;
			}
			.form-inputs{
				top: 40%;
			}
		}
	</style>
</head>
<body>
	<div class="logo-img"></div>

	<div class="slogan">Connect with Bruins..</div>

	<form action="#" method="POST">
		<div class = "form-inputs">
			<input class="login-inputs usr-login" type="text" name="user_login" placeholder="Username">
			<input class="login-inputs psw-login" type="password" name="password_login" placeholder="Password">
		</div>
		<input class="submit-login" type="submit" name="submit-login" value="Log In">
	</form>
	<div class="fg-psw-text">Forgot Password?</div>

	<button class="register-btn">Or Register Now</button>
</body>
</html>