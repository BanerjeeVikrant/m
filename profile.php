
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

if (isset($_GET['u'])) {
	$profileUser = $_GET['u'];
	if($profileUser == ""){
		echo "<meta http-equiv=\"refresh\" content=\"0; url=profile.php?u=$username\">";
	}
//check user exists
	$check = $conn->query("SELECT * FROM users WHERE username='$profileUser'");
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
		if(($adminProfile) && ($profileUser != "ssdf")){
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
}
$yourcheck = $conn->query("SELECT * FROM users WHERE username='$username'");
if ($yourcheck->num_rows == 1) {

	$yourget = $yourcheck->fetch_assoc();
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
	if(($adminProfile) && ($profileUser != "ssdf")){
		$staff = true;
	}
	else{
		$staff = false;
	}
	$yourid = $yourget['id'];
	$yourfirstname = $yourget['first_name'];
	$yourgrade = $yourget['grade'];
	if($yourgrade == 9){
		$yourgrade = "Freshman";
	}else if($yourgrade == 10){
		$yourgrade = "Sophomore";
	}else if($yourgrade == 11){
		$grade = "Junior";
	}else if($yourgrade == 12){
		$yourgrade = "Senior";
	}
	$yourlastname = $yourget['last_name'];
	$yoursignupdate= $yourget['sign_up_date'];
	$yourprofilepic = $yourget['profile_pic'];
	$yourbannerimg = $yourget['bannerimg'];
	$yourbio = $yourget['bio'];
	$yoursex = $yourget['sex'];
	$yourinterests = $yourget['interests'];
	$yourdob = $yourget['dob'];
	$yourfollowing = $yourget['following'];
	$yourfollowers = $yourget['followers'];

	if($yourbannerimg == "" || $yourbannerimg == NULL){
		$bannerimg = "https://upload.wikimedia.org/wikipedia/commons/1/19/Salt_Lake_City_skyline_banner.jpg";
	}
	if(($yourprofilepic == "" || $yourprofilepic == NULL) && ($yoursex == '1')){
		$profilepic = "https://upload.wikimedia.org/wikipedia/commons/3/34/PICA.jpg";
	}
	else if(($yourprofilepic == "" || $yourprofilepic == NULL) && ($yoursex == '0')){
		$profilepic = "http://ieeemjcet.org/wp-content/uploads/2014/11/default-girl.jpg";
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
	<link rel="shortcut icon" href="/bkd/img/bearpic.png">

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
		.banner{
			width:100vw;
			height: 325px;
			background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),url(<?php echo $bannerimg; ?>);
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center;

			-webkit-filter: blur(5px);
			-moz-filter: blur(5px);
			-o-filter: blur(5px);
			-ms-filter: blur(5px);
			filter: blur(5px);

			z-index: 1;
		}
		.profile-pic{
			width: 40vw;
			height: 40vw;
			background-image: url(<?php echo $profilepic; ?>);
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center;

			position: fixed;
			top: calc(162px - 20vw - 10px);
			left: calc(50% - 20vw);

			border-radius: 360px;
			z-index: 2;
		}
		.profile-name{
			position: fixed;
			width: 100%;
			top: calc(162px + 70px);
			text-align: center;
			font-size: 18px;
			color: white;
			z-index: 2;
		}
		#follow{
			width: 60vw;
			height: 33px;
			border-radius: 360px;
			border: 0;
			z-index: 2;
			position: fixed;
			top: calc(162px + 108px);
			left: calc(50% - 30vw);
			font-size: 15px;
			font-family: 'PT Serif Caption';
		}
		#changepic{
			border: 0;
			width: 40vw;
			height: 40px;
			border-bottom-left-radius: 360px;
			border-bottom-right-radius: 360px;
			position: relative;
			top: calc(50% + 10px);
			font-size: 14px;
		}
		.follow{
			background-color: #0ebb0e;
			color: white;
		}
		.unfollow{
			background-color: #b8340c;
			color: white;
		}
		.profileedit{
			background-color: grey;
			color: white;
		}
		.lower-body{
			background-color: #e6e6e6;
			z-index: 6;
			position: relative;
		}
		.about-me{
			position: relative;
			padding: 20px;
			background-color: white;
			z-index: 5;
		}
		.bio{
			font-size: 13px;
			font-family: 'PT Serif Caption';
			display: block;
			line-height: 20px;
			color: #4a4949;
		}
		.info-mid{
			font-size: 13px;
			font-family: 'PT Serif Caption';
			position: relative;
			left: 10px;
			top: 1px;
			color:#4a4949;
		}
		.dob{
			font-size: 13px;
			font-family: 'PT Serif Caption';
			position: relative;
			left: 6px;

			color: #4a4949;
		}
		.lastonline{
			font-size: 13px;
			font-family: 'PT Serif Caption';
			position: relative;
			left: 10px;

			color:#4a4949;
		}
		.info-about-me{
			margin-top: 10px;
		}
		.tabs{
			position: relative;
			display: inline-block;
			width: calc(100vw / 3);
			background-color: #f1f1f1;
			height: 40px;
			text-align: center;
			line-height: 40px;
			font-size: 15px;
			z-index: 5;
			border-bottom: 1px solid #bfbcbc;
			border-top: 1px solid #bfbcbc;
			margin-bottom: 15px;
		}
		.following-tab{
			margin-left: -4px;
			border-left: 1px solid #bfbcbc;

		}
		.followers-tab{
			margin-left: -4px;
			border-left: 1px solid #bfbcbc;
		}
		.add-post{
			display: inline-block;
			width: 45px;
			height: 45px;
			position: fixed;
			z-index: 8;
			top: calc(100vh - 60px);
			left: calc(100vw - 60px);
			background-color: orange;
			padding: 10px;
			border-radius: 90px;
		}
		.add-post-pen{
			display: inline-block;
			height: 25px;
			width: 25px;
			background-image: url(img/edit.png);
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
			top: -73px;
			width: calc(100vw - 58px);
			height: 58px;
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
			height: 58px;
			background-color: white;
			position: relative;
			top: -15px;
			border-bottom: 1px solid #bbb;
		}	
		.notliked{
			display: inline-block;
			height: 38px;
			width: 38px;
			margin-top: 5px;
			margin-left: 10px;
			background-image: url(img/notliked-paw.png);
			position: relative;
			top: 4px;
			background-repeat: no-repeat;
			background-size: cover;
			cursor: pointer;
		}
		.liked{
			display: inline-block;
			height: 38px;
			width: 38px;
			margin: 5px;
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
		.top-bar{
			display: inline-block;
			position: fixed;
			z-index: 9;
			padding: 15px;
			width: 100vw;
			height: 60px;
		}
		.back-img{
			display: inline-block;
			height: 32px;
			width:32px;
			background-image: url(img/back.png);
			background-size: cover;
			background-repeat: no-repeat;
		}
		.searchbar-wrapper{
			display: inline-block;
		}
		.search-tool-wrapper{
			display: inline-block;
			border-bottom: 1px solid white;
			color: white;
			width: 29px;
			padding-left: 4px;
			font-size: 17px;
			position: relative;
			top: -10px;
			left: 10px;
		}
		.message-searchbar{
		    display: inline-block;
		    height: 32px;
		    width: 32px;
		    background-image: url(img/speech-start.png);
		    background-size: cover;
		    background-repeat: no-repeat;
		    position: relative;
		    left: 15px;
		}
		.search{
			background: transparent;
			border: 0;
			border-bottom: 1px solid #fff;
			position: relative;
			left: 5px;
			top: -10px;
			font-size: 16px;
			outline: 0;
			color: white;
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
	</style>

</head>
<body>
	<div class="top-bar">
		<a href="home.php"><div class="back-img"></div></a>

		<div class="searchbar-wrapper">
			<div class="search-tool-wrapper">
				<span class="search-tool glyphicon glyphicon-search"></span>
			</div>
			<input class="search" type="text" placeholder="Search..." name="search" autocomplete="off" value="<?php echo $firstname . " " . $lastname; ?>">
		</div>
		<div class="message-searchbar"></div>
	</div>
	<div class="banner"></div>
	<div class="profile-pic">
		<?php 
		if($username == $profileUser){
			echo '
			<button id = "changepic" class = "profileedit">Change Picture</button>
			';
		}
		?>
	</div>

	<div class="profile-name"><?php echo $firstname . " " . $lastname;?></div>

	<?php
	if($username != $profileUser){
		if(in_array($username, $followersArray)){
			echo '
			<button id = "follow" class = "unfollow" onclick="removeFollowing();">Unfollow</button>
			';
		}else{
			echo '
			<button id = "follow" class = "follow" onclick="addFollowing();">Follow</button>
			';
		}
	}
	else{
		echo '
		<button id = "follow" class = "profileedit" onclick="addFollowing();">Edit Profile</button>
		';
	}

	?>
	<div class="add-post" id="addPost">
		<div class="add-post-pen"></div>
	</div>
	<div class="lower-body">
		<div class="about-me">
			<div class="info-about-me"><span class="bio"><?php echo $bio; ?></span></div>
			<div class="info-about-me"><img src="img/house.png" width="20px"><span class="elem info-mid">Went to <?php echo $es; ?> Elementary School</span></div>
			<div class="info-about-me"><img src="img/house.png" width="20px"><span class="mid info-mid">Went to <?php echo $ms; ?> Middle School</span></div>
			<div class="info-about-me"><img src="img/favorite.png" width="20px"><span class="relationship-info info-mid"><?php echo $relationship; ?></span></div>
			<div class="info-about-me"><img src="img/bird-in-broken-egg.png" width="25px"><span class="dob">Was born on <?php echo $dob; ?></span></div>
			<div class="info-about-me"><img src="img/wifi.png" width="20px"><span class="lastonline">Last online <?php echo $last_online_date . ", " . $last_online_time; ?></span></div>
		</div>
		<div class="options-tabs">
			<div class="tabs photos-tab">Photos</div>
			<div class="tabs following-tab">Following</div>
			<div class="tabs followers-tab">Followers</div>
		</div>
		<div class="content" id="content">

		</div>
		<div id = "end">
			<div id="loading-img" style = "position: relative;">
				<img  src = "https://www.wpfaster.org/wp-content/uploads/2013/06/loading-gif.gif" style = "position: absolute; top: 100px; left:180px;" width = "200px"/>
			</div>
		</div>
		<div style="display:none" id="post_offset">0</div>
	</div>

	<script>
		var all_posts_loaded = false;
		var loading_currently = false;
		function load_more_post() {
			if (!all_posts_loaded && !loading_currently)  {
				loading_currently = true;
				offset = Number($("#post_offset").text());
				username = <?php echo '"'.$profileUser.'"'; ?>;
				posturl = "action/bringposts.php?u="+username+"&o="+offset;

				$.ajax({url: posturl, success: function(result){
					$("#content").before(result);
					$("#post_offset").text(20+offset);
					loading_currently = false;
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
	var $document = $(document);

	$document.scroll(function() {
	  if ($document.scrollTop() >= 300) {

	  	$(".top-bar").css("background-color","#1d2d4a");

	  } else {
	  	$(".top-bar").css("background-color","transparent");
	  }
	});
</script>
</body>
</html>