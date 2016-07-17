<?php
require "system/connect.php";

session_start();
if (isset($_SESSION['user_login'])) {
	$username = $_SESSION['user_login'];
}
else{
	$username = "";
}

if ($_SESSION['user_login']){
	$username = $_SESSION['user_login'];
	$adminCheck = $conn->query("SELECT admin FROM users WHERE username='$username'");
	$find = $adminCheck->fetch_assoc();
	$found = $find['admin'];
	if($found == '1'){
		$admin = true;
	}
	else{
		$admin = false;
	}
}else{

}
?>
<?php

if($username == ""){
	echo "<meta http-equiv=\"refresh\" content=\"0; url=profile.php?u=$username\">";
}
//check user exists
$check = $conn->query("SELECT * FROM users WHERE username='$username'");
if ($check->num_rows == 1) {

	$get = $check->fetch_assoc();
	$activatedornot = $get['activated'];
	if($activatedornot == '0'){
		exit("ERROR 5718 No User exits. <a href = 'profile.php?u=$username'>Your profile</a>");
	}
	$adminornot = $get['admin'];
	if($adminornot == '1'){
		$adminProfile = true;
	}
	else{
		$adminProfile = false;
	}
	if(($adminProfile) && ($username != "ssdf")){
		$staff = true;
	}
	else{
		$staff = false;
	}
	$firstname = $get['first_name'];
	$grade = $get['grade'];
	if($grade == 9){
		$grade = "Freshman";
	}else if($grade == 10){
		$grade = "Sophomore";
	}else if($grade == 11){
		$grade = "Junior";
	}else if($grade == 12){
		$grade = "Senior";
	}
	$lastname = $get['last_name'];
	$signupdate= $get['sign_up_date'];
	$profilepic = $get['profile_pic'];
	$bannerimg = $get['bannerimg'];
	$es = $get['es'];
	$ms = $get['ms'];
	$bio = $get['bio'];
	$sex = $get['sex'];
	$interests = $get['interests'];
	$relationship = $get['relationship'];
	if($relationship == 1){
		$relationship = "In a relationship";
	}
	else{
		$relationship = "Single";
	}
	$dob = $get['dob'];
	$followings = $get['following'];
	$followers = $get['followers'];

	$followingArray = explode(",", $followings);
	$followersArray = explode(",", $followers);

	$followingCount = count($followingArray);
	$followersCount = count($followersArray);

	if($followings == ""){
		$followingCount = 0;
	}
	if($followers == ""){
		$followersCount = 0;
	}


	$last_online_date = $get['last_online_date'];
	$last_online_time = $get['last_online_time'];

	$sql = "SELECT id from posts ORDER BY id DESC LIMIT 1";
	$result = $conn->query($sql);
	if ($result->num_rows==1) {
		$getid = $result->fetch_assoc();

		$maxid = $getid['id'] + 1;
	}

	if($bannerimg == "" || $bannerimg == NULL){
		$bannerimg = "https://upload.wikimedia.org/wikipedia/commons/1/19/Salt_Lake_City_skyline_banner.jpg";
	}
	if($profilepic == "" || $profilepic == NULL){
		if($sex == "1"){
			$profilepic = "https://upload.wikimedia.org/wikipedia/commons/3/34/PICA.jpg";
		}
		else{
			$profilepic = "http://ieeemjcet.org/wp-content/uploads/2014/11/default-girl.jpg";
		}
	}


} else {
	//echo "<meta http-equiv=\"refresh\" content=\"0; url=/bruinskave/index.php\">";
	exit();
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>bruincave</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="theme-color" content="#1d2d4a" />
	<link rel="shortcut icon" href="/bkd/img/bearpic.png">

	<!--other resourses, external source(help)-->
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=IM+Fell+English+SC" />
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Carter+One" />
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Alice" />
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=PT+Serif+Caption" />
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Creepster+Caps" />

	<!--jquery 2.2.0-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<script src="https://hammerjs.github.io/dist/hammer.js"></script>

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
			top:0px;
			z-index: 9;
			padding: 15px;
			width: 100vw;
			height: 60px;
			background-color: #1d2d4a;
		}
		.searchbar-wrapper{
			display: inline-block;
		}
		.search-tool-wrapper {
		    display: inline-block;
		    color: #e0dfdf;
		    width: 29px;
		    padding-left: 4px;
		    font-size: 15px;
		    position: relative;
		    top: 3px;
		    left: 56px;
		}
		.homepic-searchbar{
			display: inline-block;
			height: 40px;
			width: 40px;
			background-image: url(<?php echo $profilepic;?>);
			background-size: cover;
			background-repeat: no-repeat;
			position: fixed;
			top: 11px;
			border-radius: 45px;
		}
		.search{
			background: transparent;
			border: 0;
			border-bottom: 1px solid #fff;
			position: relative;
			left: 20px;
			top: 3px;
			font-size: 16px;
			outline: 0;
			color: white;
			width: 70vw;
			padding-left: 30px;
		}
		.options-tabs{
			position: fixed;
			top: 60px;
			height: 49px;
			border-bottom: 1px solid #c4c4c4;
			z-index: 6;
			background-color: white;
		}
		.tabs{
			position: relative;
			display: inline-block;
			width: calc((100vw / 4) + 1px);
			height: 50px;
			text-align: center;
			line-height: 40px;
			font-size: 15px;
			margin-bottom: 15px;
			padding-top: 10px;
		}
		.crush-tab{
			margin-left: -5px;
		}
		.notifications-tab{
			margin-left: -5px;
		}
		.messages-tab{
			margin-left: -5px;
			width: calc((100vw / 4) + 0px);
		}
		.home-img{
			display: inline-block;
			height: 32px;
			width: 32px;
			background-image: url(img/home-blue.png);
			background-size: cover;
			background-repeat: no-repeat;

		}
		.crush-img{
			display: inline-block;
			height: 32px;
			width: 32px;
			background-image: url(img/heart-grey.png);
			background-size: cover;
			background-repeat: no-repeat;

		}
		.notifications-img{
			display: inline-block;
			height: 32px;
			width: 32px;
			background-image: url(img/notification-bell-grey.png);
			background-size: cover;
			background-repeat: no-repeat;

		}
		.messages-img{
			display: inline-block;
			height: 32px;
			width: 32px;
			background-image: url(img/message-grey.png);
			background-size: cover;
			background-repeat: no-repeat;

		}
		.profile-post{
			background-color: white;
			position: relative;

			width: 100vw;
			margin-bottom: 15px;

			border-top: 1px solid #bbb;
		}
		.post-breaker{
			margin: 0;
			margin-bottom: 2px;
			position: relative;
			top: -5px;
			border-color: #dad4d4;
			margin-left: 15px;
			margin-right: 15px;
		}
		.crush-post{
			background-color: white;
			position: relative;

			width: 100vw;
			margin-bottom: 15px;

			border-top: 1px solid #bbb;
		}

		.posted-by-img{
			display: inline-block;
			width: 50px;
			height: 50px;
			border-radius: 45px;
			background-repeat: no-repeat;
			background-size: cover;
			position: relative;
			top: 10px;
			left: 15px;
		}
		.posted-pic {
			width: 100%;
		}
		.samepostedby {
			margin: 10px;
			font-size: 16px;
			text-decoration: none !important;
			color: black;
			font-family: 'PT Serif Caption';
			position: relative;
			top: -11px;
			left: 10px;
		}
		.posted-by-name{
			margin: 10px;
			font-size: 16px;
			text-decoration: none !important;
			color: black;
			font-family: 'PT Serif Caption';
			position: relative;
			top: -11px;
			left: 10px;
		}
		.posted-to-name{
			display: none;
			/*margin: 10px;
			font-size: 16px;
			text-decoration: none !important;
			color: black;
			font-family: 'PT Serif Caption';*/
		}
		.topNameCrush{
			position: relative;
			left: 30px;
			top: 10px;
		}
		.timeCrush{

		}
		.msg-body-crush{
			font-size: 20px;
			color: black;
			padding-left: 10px;
			margin-left: 15px;
			margin-top: 17px;
			padding-bottom: 10px;
		}
		.crush_pic{
			width:100vw;
		}
		.arrow{
			display: none;
			/*
			margin: 5px;
			font-size: 16px;
			*/
		}

		.post-options{
			font-size: 20px;
			color: #9ba0a3;
			float: right;
			position: relative;
			top: 27px;
			right: 15px;

		}
		.time{
			font-family: 'Alice';
			position: relative;
			top: -13px;
			left: 70px;
		}
		.msg-body{
			font-size: 15px;
			color: black;
			padding-left: 10px;
			padding-right: 10px;
		}
		.comment-inputs{
			position: absolute;
			left: 58px;
			top: -71px;
			width: calc(100vw - 58px);
			height: 56px;
			border: 0;
			padding-left: 15px;
			font-size: 15px;
			background-color: #fff;
			outline-width: 0;
			font-family: Verdana;
			border-bottom: 1px solid #bbb;
		}
		.like-btn-div{
			position: absolute;
			display: inline-block;
			width: 58px;
			height: 57px;
			background-color: white;
			position: relative;
			top: -15px;
			border-bottom: 1px solid #bbb;
		}	
		.notliked{
			display: inline-block;
			height: 38px;
			width: 38px;
			margin-top:10px;
			margin-left: 10px;
			background-image: url(img/notliked-paw.png);
			z-index: 2;
			background-repeat: no-repeat;
			background-size: cover;
			cursor: pointer;
		}
		.liked{
			display: inline-block;
			height: 38px;
			width: 38px;
			margin-top:10px;
			margin-left: 10px;
			background-image: url(img/liked-paw.png);
			z-index: 2;
			background-repeat: no-repeat;
			background-size: cover;
			cursor: pointer;
		}
		.comment-body{
			background-color: #f9f9f9;
			width: 100vw;
			margin-top: -4px;
		}
		.comments-img{
			width:35px;
			height: 35px;
			padding: 5px;
			background-repeat: no-repeat;
			background-size: cover;
			border-radius: 45px;
			display:inline-block;

		}
		.commentPosted{
			padding-left: 0px;
			font-size: 14px;
			margin-top: -30px;
			position: relative;
			font-family: 'PT Serif Caption';
			top: -7px;
			left: 11px;
		}
		.comment-area{
			width: 90vw;
		}
		#last_post{
			padding: 20px;
			border-top: 1px solid #bbb;
			border-left: 1px solid #bbb;
		}
		.youtube-link-iframe{
			width: 100vw;
			height: 300px;
			position: relative;
			margin-top:-6px;
			top: 6px;
		}
		.posted-video{
			width: 100vw;
			margin-left: -20px;
			position: relative;
			margin-top:-6px;
			top: 6px;
		}
		.count-likes{
			font-size: 13px;

			font-family: 'PT Serif Caption';
			float: right;
			position: relative;
			right: 25px;
			top: -23px;

		}
		.comments-box {
			position: relative;
			top: -11px;
		}
		.top-pusher{
			position: relative;
			height:125px;
		} 
		#last_crush{
			padding: 20px;
			border-top: 1px solid #bbb;
			border-left: 1px solid #bbb;
		}
		.bottom-message-wrapper{
			position: fixed;
			height: 50px;
			width: 100vw;
			top: calc(100vh - 50px);
			background-color: #222;
		}
		input#sendingText {
		    width: 90vw;
		    height: 30px;
		    position: relative;
		    left: 5vw;
		    top: calc(50% - 15px);
		    border-radius: 45px;
		    border: 0;
		    padding-left: 15px;
		    outline: 0;
		}
		input#search-users {
		    width: 90vw;
		    height: 30px;
		    border-radius: 45px;
		    border: 0;
		    outline: 0;
		    padding-left: 33px;
		    margin-bottom: 10px;
		}
		span.usersearch-tool {
		    position: relative;
		    left: 30px;
		    top: 3px;
		    color: #b0b0b0;
		}
		.each-user {
		    width: 100vw;
		    height: 50px;
		    background: #d7d7d7;
		    padding: 13px;
		}
		.chat-user-img {
		    display: inline-block;
		    width: 40px;
		    height: 40px;
		    background-size: cover;
		    background-repeat: no-repeat;
		    position: relative;
		    top: -8px;
		    border-radius: 45px;
		}
		.each-user-name {
		    display: inline-block;
		    position: relative;
		    top: -20px;
		    margin-left: 10px;
		    font-size: 15px;
		}
		#messenger-pic{
			display: inline-block;
			width: 50px;
			height: 50px;
			border-radius: 45px;
			background-size: cover;
			background-repeat: no-repeat;
			position: relative;
			left: 0px;
			top: 7px;
		}
		#messenger-name{
			position: relative;
			left: 3px;
			top: -8px;
			font-size: 20px;
			font-family: 'PT Serif Caption';
		}
		.arrow-back{
			font-size: 27px;
			position: relative;
			left: 20px;
			top: 30px;
			cursor: pointer;
			z-index: 12;
		}
		.messenger-info{
			display: inline-block;
			text-align: center;
			height: 27px;
			width: 100vw;
			position: relative;
			top: -20px;
		}
		.your-message{
			background-color: white;
			color: black;
			display: inline-block;
			padding-left: 10px;
			padding-right: 10px;
			max-width: 70%;
			padding-top: 6px;
			padding-bottom: 6px;
			border-radius: 5px;
			margin-top:5px;
			margin-right: 10px;
			float: right;
		}
		.your-message-box{
			float: right;
			width: 100%;
			font-size: 14px;
			font-family: 'PT Serif Caption';
		}
		.their-message-box{
			float: left;
			width: 100%;
			font-size: 14px;
			font-family: 'PT Serif Caption';
			padding-left: 10px;
		}
		.their-message{
			background-color: white;
			color: black;
			display: inline-block;
			padding-left: 10px;
			padding-right: 10px;
			max-width: 70%;
			padding-top: 6px;
			padding-bottom: 6px;
			border-radius: 5px;
			margin-top:5px;
		}
		.toPic{
			display: inline-block;
			width: 35px;
			height: 35px;
			background-size: cover;
			background-repeat: no-repeat;
			float: left;
			margin-right: 10px;
			border-radius: 45px;
			margin-top:5px;	
		}
		.sendingText::-webkit-input-placeholder{
			color: grey;
		}
		.sendingText{
			width: 360px;
			height: 29px;
			position: relative;
			left: 20px;
			top: 11px;
			border-radius: 30px;
			border: 0;
			padding-left: 16px;
			color:black;
			outline: 0;
			font-family: 'PT Serif Caption';
			font-size: 15px;
		}
		.message-box-close{
			color: white;
			font-size: 25px;
			position: relative;
			top: 7px;
			left: 7px;
			cursor: pointer;
		}
		.messages-wrapper {
		    width: 100vw;
		    position: absolute;
		    top: 0;
		    background: rgba(0,0,0,0.9);
		    z-index: 9;
		    color: white;
		}
		#messages{
			height: calc(100vh - 100px);
			overflow: scroll;
			padding-bottom:50px;
		}
		.notification-post {
		    background: white;
		    min-height: 45px;
		    margin-bottom: 1px;
		}
		.notificationBox {
		    display: inline-block;
		    width: calc(100vw - 60px);
		    position: relative;
		    top: -5px;
		    left: 5px;
		}
		.fromPicNotification {
		    height: 35px;
		    width: 35px;
		    display: inline-block;
		    background-size: cover;
		    background-repeat: no-repeat;
		    border-radius: 45px;
		    position: relative;
		    left: 3px;
		    top: 5px;
		}
		span.notifier {
		    font-weight: bold;
		    font-size: 13px;
		}
		span.notificationInfo {
		    color: #414040;
		}
		span.notifier-time {
		    color: #939393;
		}
		.home-sidebody{
			position: fixed;
			width: 85vw;
			height: 100vh;
			top: 0px;
			z-index: 20;
			background: #e6e6e6;
			border-right: 1px solid #b5b5b5;
		}
		.banner-sidebody{
			background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url(<?php echo $bannerimg; ?>);
			width: 100%;
			height: 200px;
			background-size: cover;
			background-repeat: no-repeat;
		}
		.profilepic-sidebody{
			background-image: url(<?php echo $profilepic; ?>);
			width: 55px;
			height: 55px;
			background-size: cover;
			background-repeat: no-repeat;
			position: relative;
			left: calc(50% - 35vw);
			top: calc(100px - 55px);
			display: inline-block;
			border-radius: 45px;
		}
		.info-sidebody {
		    color: white;
		    font-size: 16px;
		    position: relative;
		    width: 70vw;
		    top: 50px;
		    left: calc(50% - 35vw);
		}
		.sidebody-tab {
		    width: 100%;
		    height: 40px;
		    vertical-align: middle;
		    background: #fff;
		    line-height: 40px;
		    padding-left: 17px;
		    border-top: 1px solid #e6e6e6;
		    border-right: 1px solid #e6e6e6;
		    color: black;		
		}
		a{
			text-decoration: none !important;
		}
	</style>
</head>
<body id="element">
	<div class="top-pusher"></div>
	<div class="top-bar">
		<div class="homepic-searchbar"></div>
		<div class="searchbar-wrapper">
			<div class="search-tool-wrapper">
				<span class="search-tool glyphicon glyphicon-search"></span>
			</div>
			<input class="search" type="text" placeholder="Search..." name="search" autocomplete="off">
		</div>
	</div>
	<div class="options-tabs">
		<div class="tabs home-tab"><div class="home-img"></div></div>
		<div class="tabs crush-tab"><div class="crush-img"></div></div>
		<div class="tabs notifications-tab"><div class="notifications-img"></div></div>
		<div class="tabs messages-tab"><div class="messages-img"></div></div>
	</div>
	<div class="body-content">
		<div class="content" id="content">

		</div>
		<div id = "end">
			<div id="loading-img" style = "position: relative;">
				<img  src = "http://bestanimations.com/Science/Gears/loadinggears/loading-gear.gif" style = "position: absolute;left: calc(50vw - 144px);" />
			</div>
		</div>
		<div style="display:none" id="post_offset">0</div>
	</div>
	<div class="home-sidebody">
		<div class="banner-sidebody">
			<div class="profilepic-sidebody"></div>
			<div class="info-sidebody">
				<div class="name-sidebody"><?php echo $firstname ." ". $lastname; ?></div>
				<div class="username-sidebody">@<?php echo $username; ?></div>
			</div>
		</div>
		<a href="profile.php?u=<?php echo $username;?>"><div class="sidebody-profiletab sidebody-tab">Profile</div></a>
		<div class="sidebody-feedbacktab sidebody-tab">Feedback</div>
		<div class="sidebody-faqtab sidebody-tab">FAQ</div>
		<div class="sidebody-helptab sidebody-tab">Help</div>
		<a href="logout.php"><div class="sidebody-logouttab sidebody-tab">Logout</div></a>
	</div>
</div>
<div class="like-bearpic" style="position: fixed;height: 209px;width: 200px;top: calc(50vh - 100px);left: calc(50vw - 100px);background: url(http://web1.nbed.nb.ca/sites/ASD-S/1929/PublishingImages/BEAR%20PAW.gif);z-index: 20;background-size:cover;background-repeat:no-repeat;"></div>
<script type="text/javascript">
	var insertMsgCall;
	var myElement = document.getElementById('element');

	// create a simple instance
	// by default, it only adds horizontal recognizers
	var mc = new Hammer(myElement);
	mc.get('swipe').set({ velocity: 0.60});
	// listen to events...
	mc.on("swiperight", function(ev) {
	    var elem = $(".body-content").children().attr("class");
	    if(elem == "notification-post"){
	    	$(".home-img").css("background-image", "url(img/home-grey.png)");
	    	$(".crush-img").css("background-image", "url(img/heart-red.png");
	    	$(".notifications-img").css("background-image", "url(img/notification-bell-grey.png)");
	    	$(".messages-img").css("background-image", "url(img/message-grey.png)");

	    	$(".body-content").load("crushpage.php", function(){
	    		var all_posts_loaded = false;
	    		var loading_currently = false;
	    		function load_more_post() {
	    			if (!all_posts_loaded && !loading_currently)  {
	    				loading_currently = true;
	    				offset = Number($("#crush_offset").text());
	    				posturl = "action/bringcrush.php?o="+offset;
	    				$.ajax({url: posturl, success: function(result){
	    					$("#crushcontent").before(result);
	    					$("#crush_offset").text(20+offset);
	    					loading_currently = false;
	    					var crush_id = Number($("#crush_offset").text());
	    					if(crush_id == 20){
	    						load_more_post();
	    					}
	    					if ($("#last_post").length > 0) {
	    						all_posts_loaded = true;
	    					}
	    				}});
	    			}
	    		}
	    		$(function() {
	    			$("#loading-img").hide();
	    			load_more_post();
	    			$("#loading-img").show();
	    			//alert('end reached');

	    			$(window).bind('scroll', function() {
	    				if($(window).scrollTop() >= $('#end').offset().top + $('#end').outerHeight() - window.innerHeight) {

	    					//alert('end reached');
	    					load_more_post();
	    					$("#loading-img").show();
	    				}
	    			});
	    		});		
	    	});
	    }
	    else if(elem == "users-searchbox"){
	    	$(".home-img").css("background-image", "url(img/home-grey.png)");
	    	$(".crush-img").css("background-image", "url(img/heart-grey.png");
	    	$(".notifications-img").css("background-image", "url(img/notification-bell-blue.png)");
	    	$(".messages-img").css("background-image", "url(img/message-grey.png)");

	    	$(".body-content").load("notificationspage.php", function(){
	    		var all_posts_loaded = false;
	    		var loading_currently = false;
	    		function load_more_post() {
	    			if (!all_posts_loaded && !loading_currently)  {
	    				loading_currently = true;
	    				offset = Number($("#notifications_offset").text());
	    				posturl = "action/bringnotifications.php?o="+offset;
	    				$.ajax({url: posturl, success: function(result){
	    					$("#notificationscontent").before(result);
	    					$("#notifications_offset").text(20+offset);
	    					loading_currently = false;
	    					var noti_id = Number($("#notifications_offset").text());
	    					if(noti_id == 20){
	    						load_more_post();
	    					}
	    					if ($("#last_post").length > 0) {
	    						all_posts_loaded = true;
	    					}
	    				}});
	    			}
	    		}
	    		$(function() {
	    			$("#loading-img").hide();
	    			load_more_post();
	    			$("#loading-img").show();
	    			//alert('end reached');

	    			$(window).bind('scroll', function() {
	    				if($(window).scrollTop() >= $('#end').offset().top + $('#end').outerHeight() - window.innerHeight) {

	    					//alert('end reached');
	    					load_more_post();
	    					$("#loading-img").show();
	    				}
	    			});
	    		});		
	    	});
	    }
	    else if(elem == "crush-post"){
	    				$(".home-img").css("background-image", "url(img/home-blue.png)");
		$(".crush-img").css("background-image", "url(img/heart-grey.png");
		$(".notifications-img").css("background-image", "url(img/notification-bell-grey.png)");
		$(".messages-img").css("background-image", "url(img/message-grey.png)");

		$(".body-content").load("homepage.php", function(){
			var all_posts_loaded = false;
	var loading_currently = false;
	function load_more_post() {
		if (!all_posts_loaded && !loading_currently)  {
			loading_currently = true;
			offset = Number($("#post_offset").text());
			posturl = "action/bringposts.php?o="+offset;
			$.ajax({url: posturl, success: function(result){
				$("#content").before(result);
				$("#post_offset").text(20+offset);
				loading_currently = false;
				var home_id = Number($("#post_offset").text());
				if(home_id == 20){
					load_more_post();
				}
				if ($("#last_post").length > 0) {
					all_posts_loaded = true;
				}
			}});
		}
	}
	$(function() {
		$("#loading-img").hide();
		load_more_post();
		$("#loading-img").show();
		//alert('end reached');

		$(window).bind('scroll', function() {
			if($(window).scrollTop() >= $('#end').offset().top + $('#end').outerHeight() - window.innerHeight) {

				//alert('end reached');
				load_more_post();
				$("#loading-img").show();
			}
		});
	});
		});
	    }
	});
	mc.on("swipeleft", function(ev) {
	    var elem = $(".body-content").children().attr("class");
	    if(elem == "profile-post"){
	    	$(".home-img").css("background-image", "url(img/home-grey.png)");
	    	$(".crush-img").css("background-image", "url(img/heart-red.png");
	    	$(".notifications-img").css("background-image", "url(img/notification-bell-grey.png)");
	    	$(".messages-img").css("background-image", "url(img/message-grey.png)");

	    	$(".body-content").load("crushpage.php", function(){
	    		var all_posts_loaded = false;
	    		var loading_currently = false;
	    		function load_more_post() {
	    			if (!all_posts_loaded && !loading_currently)  {
	    				loading_currently = true;
	    				offset = Number($("#crush_offset").text());
	    				posturl = "action/bringcrush.php?o="+offset;
	    				$.ajax({url: posturl, success: function(result){
	    					$("#crushcontent").before(result);
	    					$("#crush_offset").text(20+offset);
	    					loading_currently = false;
	    					var crush_id = Number($("#crush_offset").text());
	    					if(crush_id == 20){
	    						load_more_post();
	    					}
	    					if ($("#last_post").length > 0) {
	    						all_posts_loaded = true;
	    					}
	    				}});
	    			}
	    		}
	    		$(function() {
	    			$("#loading-img").hide();
	    			load_more_post();
	    			$("#loading-img").show();
	    			//alert('end reached');

	    			$(window).bind('scroll', function() {
	    				if($(window).scrollTop() >= $('#end').offset().top + $('#end').outerHeight() - window.innerHeight) {

	    					//alert('end reached');
	    					load_more_post();
	    					$("#loading-img").show();
	    				}
	    			});
	    		});		
	    	});
	    }
	    else if(elem == "crush-post"){
	    	$(".home-img").css("background-image", "url(img/home-grey.png)");
	    	$(".crush-img").css("background-image", "url(img/heart-grey.png");
	    	$(".notifications-img").css("background-image", "url(img/notification-bell-blue.png)");
	    	$(".messages-img").css("background-image", "url(img/message-grey.png)");

	    	$(".body-content").load("notificationspage.php", function(){
	    		var all_posts_loaded = false;
	    		var loading_currently = false;
	    		function load_more_post() {
	    			if (!all_posts_loaded && !loading_currently)  {
	    				loading_currently = true;
	    				offset = Number($("#notifications_offset").text());
	    				posturl = "action/bringnotifications.php?o="+offset;
	    				$.ajax({url: posturl, success: function(result){
	    					$("#notificationscontent").before(result);
	    					$("#notifications_offset").text(20+offset);
	    					loading_currently = false;
	    					var noti_id = Number($("#notifications_offset").text());
	    					if(noti_id == 20){
	    						load_more_post();
	    					}
	    					if ($("#last_post").length > 0) {
	    						all_posts_loaded = true;
	    					}
	    				}});
	    			}
	    		}
	    		$(function() {
	    			$("#loading-img").hide();
	    			load_more_post();
	    			$("#loading-img").show();
	    			//alert('end reached');

	    			$(window).bind('scroll', function() {
	    				if($(window).scrollTop() >= $('#end').offset().top + $('#end').outerHeight() - window.innerHeight) {

	    					//alert('end reached');
	    					load_more_post();
	    					$("#loading-img").show();
	    				}
	    			});
	    		});		
	    	});
	    }
	    else if(elem == "notification-post"){
	    		$(".home-img").css("background-image", "url(img/home-grey.png)");
	    		$(".crush-img").css("background-image", "url(img/heart-grey.png");
	    		$(".notifications-img").css("background-image", "url(img/notification-bell-grey.png)");
	    		$(".messages-img").css("background-image", "url(img/message-blue.png)");

	    		$(".body-content").load("messagespage.php", function(){
	    			$(".messages-wrapper").hide();
	    			$(".arrow-back").click(function(){
	    				$(".messages-wrapper").hide();
	    				clearTimeout(insertMsgCall);
	    			});
	    			var disable_msg_update = false;
	    			$('#users').load('action/users.php', function() {
	    				$('.each-user').click(function(){
	    					var pic = $(this).children().first().css("background-image");
	    					var name = $(this).children().first().next().text();

	    					$(".messages-wrapper").show("slide", { direction: "left" }, 500);
	    					$("#messenger-pic").css("background-image", pic);
	    					$("#messenger-name").html(name);
	    					$(this).children().first().css("background-image");
	    					var lastid = 0;
	    					toId = $(this).attr('uid');
	    					$("#sendingText").attr("sending-to", toId);
	    					$("#msg-id").val(toId);
	    					url = 'action/messages.php?from=<?php echo $username; ?>&toid='+toId+'&getnew=0';

	    					$('#messages').load(url, function() {
	    						insertMsgCall = setTimeout(scrollAndInsertNewMsg,500);
	    					});
	    	        	});
	    			});
	    			var scrollTopAlign_g = -1;
	    			function scrollAndInsertNewMsg() {
	    				var scrollTopAlign = scrollTopAlign_g;
	    				if (scrollTopAlign == -1) { // go to bottom
	    					scrollTopAlign = $("#messages")[0].scrollHeight;
	    				}
	    				$("#messages").scrollTop(scrollTopAlign);
	    				insertMsgCall = setTimeout(insertNewMsg,1000);
	    				scrollTopAlign_g = -1;
	    			}
	    			$("#sendingText").keyup(function(event){
	    				if(event.keyCode == 13){
	    					disable_msg_update = true;
	    					var msgText = $("#sendingText").val();
	    					var sendingToId = $("#sendingText").attr("sending-to");	
	    					$.post( "action/add_msg.php", { sendmsg: msgText, sendto: sendingToId }, function() {disable_msg_update = false;});	
	    					$("#sendingText").val("");    	
	    				}
	    			});
	    			function insertNewMsg(){
	    				if (disable_msg_update) {
	    					insertMsgCall = setTimeout(insertNewMsg,1000);
	    					return;
	    				}
	    				fromUser = "<?php echo $username; ?>";

	    				if ($("#messages").scrollTop() == 0) {
	    					//alert("Reached top");
	    					$("#messages").scrollTop(2);
	    					firstid = $(".first_text").first().text();
	    					if(firstid == ""){
	    						firstid = 99999999;
	    					}
	    					if (firstid != 0) { // more comments remaining
	    						$.get("action/messages.php",{from : fromUser, toid : toId, getold: firstid}, function(newMsgs) {
	    							var info = newMsgs;
	    							if(info != "") {
	    								var scrollHeightOld = $('#messages')[0].scrollHeight;
	    								$('#messages').prepend(newMsgs);
	    								scrollTopAlign_g = 2;
	    								insertMsgCall = setTimeout(scrollAndInsertNewMsg,500);
	    							} else {
	    								insertMsgCall = setTimeout(insertNewMsg,1500);
	    							}
	    						});
	    						return;
	    					} // else look for new messages
	    				}
	    				lastid = $(".last_text").last().text();
	    				if(lastid == ""){
	    					lastid = 0;
	    				}
	    				$.get("action/messages.php",{from : fromUser, toid : toId, getnew: lastid}, function(newMsgs) {		
	    					var info = newMsgs;
	    					if(info != ""){			
	    						$('#messages').append(newMsgs);
	    						insertMsgCall = setTimeout(scrollAndInsertNewMsg,500);
	    					} else {
	    						insertMsgCall = setTimeout(insertNewMsg,1500);
	    					}
	    				});
	    			}     
	    		});
	    }
	});


	$(".like-bearpic").hide();
	$(".home-sidebody").hide();
	$(".homepic-searchbar").click(function(){
		$(".home-sidebody").show("slide", { direction: "left" }, 300);
		$("body").css("overflow", "hidden");
	});
	$(document).mouseup(function (e)
	{
	    var container = $(".home-sidebody");

	    if (!container.is(e.target) // if the target of the click isn't the container...
	        && container.has(e.target).length === 0) // ... nor a descendant of the container
	    {
	        container.hide("slide", { direction: "left" }, 500);
	        $("body").css("overflow-x", "hidden");
	        $("body").css("overflow-y", "scroll");
	    }
	});
	var all_posts_loaded = false;
	var loading_currently = false;
	function load_more_post() {
		if (!all_posts_loaded && !loading_currently)  {
			loading_currently = true;
			offset = Number($("#post_offset").text());
			posturl = "action/bringposts.php?o="+offset;
			$.ajax({url: posturl, success: function(result){
				$("#content").before(result);
				$("#post_offset").text(20+offset);
				loading_currently = false;
				var home_id = Number($("#post_offset").text());
				if(home_id == 20){
					load_more_post();
				}
				if ($("#last_post").length > 0) {
					all_posts_loaded = true;
				}
			}});
		}
	}
	$(function() {
		$("#loading-img").hide();
		load_more_post();
		$("#loading-img").show();
		//alert('end reached');

		$(window).bind('scroll', function() {
			if($(window).scrollTop() >= $('#end').offset().top + $('#end').outerHeight() - window.innerHeight) {

				//alert('end reached');
				load_more_post();
				$("#loading-img").show();
			}
		});
	});
	$(".home-tab").click(function(){
		$(".home-img").css("background-image", "url(img/home-blue.png)");
		$(".crush-img").css("background-image", "url(img/heart-grey.png");
		$(".notifications-img").css("background-image", "url(img/notification-bell-grey.png)");
		$(".messages-img").css("background-image", "url(img/message-grey.png)");

		$(".body-content").load("homepage.php", function(){
			var all_posts_loaded = false;
	var loading_currently = false;
	function load_more_post() {
		if (!all_posts_loaded && !loading_currently)  {
			loading_currently = true;
			offset = Number($("#post_offset").text());
			posturl = "action/bringposts.php?o="+offset;
			$.ajax({url: posturl, success: function(result){
				$("#content").before(result);
				$("#post_offset").text(20+offset);
				loading_currently = false;
				var home_id = Number($("#post_offset").text());
				if(home_id == 20){
					load_more_post();
				}
				if ($("#last_post").length > 0) {
					all_posts_loaded = true;
				}
			}});
		}
	}
	$(function() {
		$("#loading-img").hide();
		load_more_post();
		$("#loading-img").show();
		//alert('end reached');

		$(window).bind('scroll', function() {
			if($(window).scrollTop() >= $('#end').offset().top + $('#end').outerHeight() - window.innerHeight) {

				//alert('end reached');
				load_more_post();
				$("#loading-img").show();
			}
		});
	});
		});
	});
	$(".crush-tab").click(function(){

		$(".home-img").css("background-image", "url(img/home-grey.png)");
		$(".crush-img").css("background-image", "url(img/heart-red.png");
		$(".notifications-img").css("background-image", "url(img/notification-bell-grey.png)");
		$(".messages-img").css("background-image", "url(img/message-grey.png)");

		$(".body-content").load("crushpage.php", function(){
			var all_posts_loaded = false;
			var loading_currently = false;
			function load_more_post() {
				if (!all_posts_loaded && !loading_currently)  {
					loading_currently = true;
					offset = Number($("#crush_offset").text());
					posturl = "action/bringcrush.php?o="+offset;
					$.ajax({url: posturl, success: function(result){
						$("#crushcontent").before(result);
						$("#crush_offset").text(20+offset);
						loading_currently = false;
						var crush_id = Number($("#crush_offset").text());
						if(crush_id == 20){
							load_more_post();
						}
						if ($("#last_post").length > 0) {
							all_posts_loaded = true;
						}
					}});
				}
			}
			$(function() {
				$("#loading-img").hide();
				load_more_post();
				$("#loading-img").show();
				//alert('end reached');

				$(window).bind('scroll', function() {
					if($(window).scrollTop() >= $('#end').offset().top + $('#end').outerHeight() - window.innerHeight) {

						//alert('end reached');
						load_more_post();
						$("#loading-img").show();
					}
				});
			});		
		});
	});
	$(".notifications-tab").click(function(){
		$(".home-img").css("background-image", "url(img/home-grey.png)");
		$(".crush-img").css("background-image", "url(img/heart-grey.png");
		$(".notifications-img").css("background-image", "url(img/notification-bell-blue.png)");
		$(".messages-img").css("background-image", "url(img/message-grey.png)");

		$(".body-content").load("notificationspage.php", function(){
			var all_posts_loaded = false;
			var loading_currently = false;
			function load_more_post() {
				if (!all_posts_loaded && !loading_currently)  {
					loading_currently = true;
					offset = Number($("#notifications_offset").text());
					posturl = "action/bringnotifications.php?o="+offset;
					$.ajax({url: posturl, success: function(result){
						$("#notificationscontent").before(result);
						$("#notifications_offset").text(20+offset);
						loading_currently = false;
						var noti_id = Number($("#notifications_offset").text());
						if(noti_id == 20){
							load_more_post();
						}
						if ($("#last_post").length > 0) {
							all_posts_loaded = true;
						}
					}});
				}
			}
			$(function() {
				$("#loading-img").hide();
				load_more_post();
				$("#loading-img").show();
				//alert('end reached');

				$(window).bind('scroll', function() {
					if($(window).scrollTop() >= $('#end').offset().top + $('#end').outerHeight() - window.innerHeight) {

						//alert('end reached');
						load_more_post();
						$("#loading-img").show();
					}
				});
			});		
		});
	});
	$(".messages-tab").click(function(){
		$(".home-img").css("background-image", "url(img/home-grey.png)");
		$(".crush-img").css("background-image", "url(img/heart-grey.png");
		$(".notifications-img").css("background-image", "url(img/notification-bell-grey.png)");
		$(".messages-img").css("background-image", "url(img/message-blue.png)");

		$(".body-content").load("messagespage.php", function(){
			$(".messages-wrapper").hide();
			$(".arrow-back").click(function(){
				$(".messages-wrapper").hide();
				clearTimeout(insertMsgCall);
			});
			var disable_msg_update = false;
			$('#users').load('action/users.php', function() {
				$('.each-user').click(function(){
					var pic = $(this).children().first().css("background-image");
					var name = $(this).children().first().next().text();

					$(".messages-wrapper").show("slide", { direction: "left" }, 500);
					$("#messenger-pic").css("background-image", pic);
					$("#messenger-name").html(name);
					$(this).children().first().css("background-image");
					var lastid = 0;
					toId = $(this).attr('uid');
					$("#sendingText").attr("sending-to", toId);
					$("#msg-id").val(toId);
					url = 'action/messages.php?from=<?php echo $username; ?>&toid='+toId+'&getnew=0';

					$('#messages').load(url, function() {
						insertMsgCall = setTimeout(scrollAndInsertNewMsg,500);
					});
	        	});
			});
			var scrollTopAlign_g = -1;
			function scrollAndInsertNewMsg() {
				var scrollTopAlign = scrollTopAlign_g;
				if (scrollTopAlign == -1) { // go to bottom
					scrollTopAlign = $("#messages")[0].scrollHeight;
				}
				$("#messages").scrollTop(scrollTopAlign);
				insertMsgCall = setTimeout(insertNewMsg,1000);
				scrollTopAlign_g = -1;
			}
			$("#sendingText").keyup(function(event){
				if(event.keyCode == 13){
					disable_msg_update = true;
					var msgText = $("#sendingText").val();
					var sendingToId = $("#sendingText").attr("sending-to");	
					$.post( "action/add_msg.php", { sendmsg: msgText, sendto: sendingToId }, function() {disable_msg_update = false;});	
					$("#sendingText").val("");    	
				}
			});
			function insertNewMsg(){
				if (disable_msg_update) {
					insertMsgCall = setTimeout(insertNewMsg,1000);
					return;
				}
				fromUser = "<?php echo $username; ?>";

				if ($("#messages").scrollTop() == 0) {
					//alert("Reached top");
					$("#messages").scrollTop(2);
					firstid = $(".first_text").first().text();
					if(firstid == ""){
						firstid = 99999999;
					}
					if (firstid != 0) { // more comments remaining
						$.get("action/messages.php",{from : fromUser, toid : toId, getold: firstid}, function(newMsgs) {
							var info = newMsgs;
							if(info != "") {
								var scrollHeightOld = $('#messages')[0].scrollHeight;
								$('#messages').prepend(newMsgs);
								scrollTopAlign_g = 2;
								insertMsgCall = setTimeout(scrollAndInsertNewMsg,500);
							} else {
								insertMsgCall = setTimeout(insertNewMsg,1500);
							}
						});
						return;
					} // else look for new messages
				}
				lastid = $(".last_text").last().text();
				if(lastid == ""){
					lastid = 0;
				}
				$.get("action/messages.php",{from : fromUser, toid : toId, getnew: lastid}, function(newMsgs) {		
					var info = newMsgs;
					if(info != ""){			
						$('#messages').append(newMsgs);
						insertMsgCall = setTimeout(scrollAndInsertNewMsg,500);
					} else {
						insertMsgCall = setTimeout(insertNewMsg,1500);
					}
				});
			}     
		});
	});


	function likePost(id) {
		var addurl = "action/likepost.php?id="+id;
		var postid = "#like-btn-"+id;
		$.ajax({url: addurl, 
			success: function(){
				$(postid).attr('class', 'liked');
				$(postid).attr('onclick', 'unlikePost(' + id + ')');
				$(".like-bearpic").show();
				$(".like-bearpic").effect("shake", 3000);
				setTimeout(
				  function() 
				  {
				    $(".like-bearpic").hide();
				  }, 500);
			},
			error: function(){
				alert("failed");
			}
		});
	}
	function unlikePost(id) {
		var addurl = "action/unlikepost.php?id="+id;
		var postid = "#like-btn-"+id;
		$.ajax({url: addurl, 
			success: function(){
				$(postid).attr('class', 'notliked');
				$(postid).attr('onclick', 'likePost(' + id + ')');
			},
			error: function(){
				alert("failed");
			}
		});
	}

	function postcomment(curr_position) {
		var url="action/post-comment.php";
		var comment = $(curr_position).children().first().val();
		comment = comment.replace('\'','');
		var id    = $(curr_position).children().first().next().val();
		var  data = "comment="+comment+"&id="+id;
		var comment_html1 =
		"<div style = 'position: relative;'>"+
		"	<div class = 'comment-body' style='position: relative;top: -70px;'>"+
		"    <div class = 'comments-img'></div>" +
		"    <div class = 'comment-area'>"+
		"      <div style = 'position: relative;'>";
		var comment_html2 =
		"      </div>"+
		"    </div>"+
		"  </div>"+
		"</div>";
		$.ajax({
			url:url,
			type:'post',
			data:data, 
			success:function(commentText){
				if(commentText == ""){
					return;
				}
				var commenttxt =
				"          <div class = 'commentPosted'>"+
				"            <a style='position: relative;' href = 'profile.php?u=<?php echo $username; ?>'><?php echo $username; ?></a>&nbsp;&nbsp;&nbsp;" + commentText +
				"          </div>";
				var paw = curr_position.parent().prev().children().first();
				curr_position.parent().before(comment_html1+commenttxt+comment_html2);

				var btn_num = paw.closest(".like-btn-div").css("top");
				var arr = btn_num.split("p");
				var num = Number(arr[0]) + 26;
				var x = num + "px";

				paw.closest(".like-btn-div").css("top", x);
				$("body").closest(".comment-input").next().children().first().css("top", x);
				$(".comment-inputs").val("");
	            //stopCommentPosting = false;
	            
	        },
	        error: function(jqXHR, textStatus, errorThrown) {
	        	alert("failed");
	        }
	    });
	}

</script>
</body>
</html>