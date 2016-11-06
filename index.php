<?php
require "system/connect.php";

//ini_set('session.cookie_lifetime', 60 * 60 * 24 * 7);
//ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 7);
//ini_set('session.save_path', '/sessions');
$lifetime = 60 * 60 * 24 * 7 * 365;
session_set_cookie_params($lifetime);
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
if ($user_login != "" || $username !=  "") {

	echo "\n<script>window.location.assign('home.php'); </script>\n";
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
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
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
		.back-img{
			position: fixed;
			display: inline-block;
			height: 32px;
			width: 32px;
			background-image: url(img/back.png);
			background-size: cover;
			background-repeat: no-repeat;
			top: 20px;
			left: 15px;
		}
		.front-body{
			z-index: 1;
		}
		.name-register {
		    height: 100vh;
		    width: 100vw;
		    overflow: hidden;
		    background: #4080ff;
		}
		.info-register {
		    height: 100vh;
		    width: 100vw;
		    overflow: hidden;
		    background: #4080ff;
		}
		.id-register {
		    height: 100vh;
		    width: 100vw;
		    overflow: hidden;
		    background: #4080ff;
		}
		.key-register {
			height: 100vh;
			width: 100vw;
			overflow: hidden;
			background: #4080ff;
		}
		.type-inputs {
		    width: 90vw;
		    position: relative;
		    left: 5vw;
		    margin-top: 10px;
		    background: transparent;
		    border: 0;
		    border-bottom: 1px solid white;
		    color: white;
		    outline: 0;
		    font-size: 17px;
		    padding-left: 14px;
		    height: 36px;
		    top: 100px;
		}
		.type-inputs::-webkit-input-placeholder{
			color: #dedede;
		}
		.name-info {
		    color: white;
		    font-size: 23px;
		    position: relative;
		    top: 77px;
		    text-align: center;
		}
		.info-info {
		    color: white;
		    font-size: 23px;
		    position: relative;
		    top: 77px;
		    text-align: center;
		}
		.id-info {
		    color: white;
		    font-size: 23px;
		    position: relative;
		    top: 77px;
		    text-align: center;
		}
		.key-info {
		    color: white;
		    font-size: 23px;
		    position: relative;
		    top: 77px;
		    text-align: center;
		}
		.next-btn{
			width: 90vw;
			height: 36px;
			position: absolute;
			top: calc(100% - 55px);
			left: calc(50% - 45vw);
			border: 0;
			background: #2a4c79;
			color: white;
			font-size: 14px;
			font-family: 'PT Serif Caption';
			text-align: center;
			line-height: 36px;
		}
		.es-input {
		    top: 108px;
		}
		select {
		    width: 90vw;
		    height: 36px;
		    font-size: 19px;
		    background: transparent;
		    border: 0;
		    border-bottom: 1px solid white;
		    color: white;
		    position: relative;
		    left: 5vw;
		    outline: 0;
		    top: 107px;
		    padding-left: 10px;
		}
		select.grade {
		    top: 115px;
		}
		.options {
		    background: #4080ff;
		    color: white;
		    width: 60px;
		}
		hr.pass-breaker {
		    position: relative;
		    top: 114px;
		    border-color: #91b6ff;
		}
		.or-num {
		    position: relative;
		    top: 115px;
		    text-align: center;
		    font-size: 25px;
		    color: white;
		}
		.key-wrapper{
			height: 86vh;
			overflow-y: scroll;
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
	<div class="front-body">
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
	<button class="register-btn" id="register-btn">Or Register Now</button>
	</div>
	<form action="#" method="POST" enctype="multipart/form-data" id="register">
		<div class="name-register">
			<div class="topbar-back">
				<div class="back-img" id="back-name"></div>
			</div>
			<div class="name-info">
				So, What's your name?
			</div>
			<input type="text" name="firstname" class="type-inputs firstname-input" placeholder="Firstname">
			<input type="text" name="lastname" class="type-inputs lastname-input" placeholder="Lastname">

			<div class="next-btn" id="next-name">Next</div>
		</div>
		<div class="info-register">
			<div class="topbar-back">
				<div class="back-img" id="back-info"></div>
			</div>
			<div class="info-info">
				So, Tell us about you?
			</div>
			<input type="date" name="dob" placeholder = "Date Of Birth" class="type-inputs dob-input">
			<select name="gender" form="register" class="gender">
			  <option class="options" value="male">Male</option>
			  <option class="options" value="female">Female</option>
			  <option class="options" value="other">Other</option>
			</select>
			<select name="grade" form="register" class="grade">
			  <option class="options" value="9">Freshman</option>
			  <option class="options" value="10">Sophomore</option>
			  <option class="options" value="11">Junior</option>
			  <option class="options" value="12">Senior</option>
			</select>
			<input type="text" name="es" class="type-inputs es-input" placeholder="Elementary School">
			<input type="text" name="ms" class="type-inputs ms-input" placeholder="Middle School">
			<div class="next-btn" id="next-info">Next</div>
		</div>
		<div class="id-register">
			<div class="topbar-back">
				<div class="back-img" id="back-id"></div>
			</div>
			<div class="id-info">
				What's your student id?
			</div>
			<input type="number" name="id" class="type-inputs id-input" placeholder="Student Id">
			<div class="next-btn" id="next-id">Next</div>
		</div>
		<div class="key-register">
			<div class="topbar-key">
				<div class="back-img" id="back-key"></div>
			</div>
			<div class="key-wrapper">
				<div class="key-info">
					Choose Identity
				</div>
				<input type="text" name="usernamekey" class="type-inputs username-input" placeholder="Username" required>
				<input type="password" name="passwordkey" class="type-inputs password-input" placeholder="Password" required>
				<input type="password" name="passwordagainkey" class="type-inputs password-again-input" placeholder="Repeat Password" required>
				<hr class="pass-breaker">
				<input type="number" name="number" class="type-inputs number-input" placeholder="Phone Number">
				<div class="or-num">OR</div>
				<input type="email" name="number" class="type-inputs email-input" placeholder="Email">
			</div>
			<input type="submit" name="reg" class="done-btn next-btn" value="Continue >>">
		</div>
	</form>

</body>
<script type="text/javascript">
$('#register').submit(function(e){
	e.preventDefault();
	var fn = $(".firstname-input").val();
	var ln = $(".lastname-input").val();
	var dob = $(".dob-input").val();
	var gender = $(".gender").val();
	var grade = $(".grade").val();
	var es = $(".es-input").val();
	var ms = $(".ms-input").val();
	var stuid = $(".id-input").val();
	var usr = $(".username-input").val();
	var psw = $(".password-input").val();
	var psw2 = $(".password-again-input").val();
	var num = $(".number-input").val();
	var email = $(".email-input").val();
	var url = "action/createacc.php";
	var data = "fn="+fn+"&ln="+ln+"&dob="+dob+"&gender="+gender+"&grade="+grade+"&es="+es+"&ms="+ms+"&stuid="+stuid+"&usr="+usr+"&psw="+psw+"&psw2="+psw2+"&num="+num+"&email="+email;
	$.ajax({
		url:url,
		type:'post',
		data:data, 
		success:function(){
			location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
        	alert("failed");
        }
    });
});

	$(".info-register").hide();
	$(".name-register").hide();
	$(".id-register").hide();
	$(".key-register").hide();

	
	$("#register-btn").click(function(){
		$(".name-register").show("slide", { direction: "left" }, 500);
		$(".front-body").hide();
	});
	$("#back-name").click(function(){
		$(".name-register").hide("slide", { direction: "left" }, 500);
		$(".front-body").show();
	});
	$("#next-name").click(function(){
		var nextnameallowed = false;
		if($(".firstname-input").val() != "" && $(".lastname-input").val() != ""){
			nextnameallowed = true;
		}
		if(nextnameallowed == true){
			$(".info-register").show();
			$(".name-register").hide();
		}
		else{
			alert("Fill the Form First!");
		}
	});
	$("#back-info").click(function(){
		$(".info-register").hide();
		$(".name-register").show();
	});
	$("#next-info").click(function(){
		var nextinfoallowed = false;
		if($(".dob-input").val() != "" && $(".gender").val() != "" && $(".grade").val()!= ""){
			nextinfoallowed = true;
		}
		if(nextinfoallowed) {
			$(".id-register").show();
			$(".info-register").hide();
		} else {
			alert("Fill the Form First!");
		}
	});
	$("#next-id").click(function(){
		var nextidallowed = false;
		if($(".id-input").val() != ""){
			nextidallowed = true;
		}
		if(nextidallowed) {
			$(".key-register").show();
			$(".id-register").hide();
		}
		else {
			alert("Fill the Form First!");
		}
	});
	$("#back-id").click(function(){
		$(".info-register").show();
		$(".id-register").hide();
	});
	$("#back-key").click(function(){
		$(".id-register").show();
		$(".key-register").hide();
	});
</script>
</html>