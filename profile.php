
<?php
require "system/connect.php";
include "system/helpers.php";

ini_set('session.cookie_lifetime', 60 * 60 * 24 * 7);
//ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 7);
//ini_set('session.save_path', '/sessions');
session_start();
if (isset($_SESSION['user_login'])) {
	$username = $_SESSION['user_login'];
	$time = time();
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
if (isset($_FILES['changebanner'])) {

	if (((@$_FILES["changebanner"]["type"]=="image/jpeg") || (@$_FILES["changebanner"]["type"]=="image/png") || (@$_FILES["changebanner"]["type"]=="image/gif"))&&(@$_FILES["changebanner"]["size"] < 10485760)) {

		$rand_dir_name = $username;


		if (file_exists("userdata/pictures/$rand_dir_name/".@$_FILES["changebanner"]["name"])){

			move_uploaded_file(@$_FILES["changebanner"]["tmp_name"],"userdata/pictures/$rand_dir_name/".$_FILES["changebanner"]["name"]);
//echo "Uploaded and stored in: userdata/pictures/$rand_dir_name/".@$_FILES["changebanner"]["name"];
			$profile_pic_name = @$_FILES["changebanner"]["name"];

			$sql = "UPDATE users SET bannerimg='userdata/pictures/$rand_dir_name/$profile_pic_name' WHERE username='$username'";
			$conn->query($sql);
		}

		else {
			if (!file_exists("userdata/pictures/$rand_dir_name")){
				mkdir("userdata/pictures/$rand_dir_name");
			}
			move_uploaded_file(@$_FILES["changebanner"]["tmp_name"],"userdata/pictures/$rand_dir_name/".$_FILES["changebanner"]["name"]);
//echo "Uploaded and stored in: userdata/pictures/$rand_dir_name/".@$_FILES["changebanner"]["name"];
			$profile_pic_name = @$_FILES["changebanner"]["name"];
			$sql = "UPDATE users SET bannerimg='userdata/pictures/$rand_dir_name/$profile_pic_name' WHERE username='$username'";

			$conn->query($sql);
		}


	}
}
if (isset($_FILES['changeprofile'])) {

	if (((@$_FILES["changeprofile"]["type"]=="image/jpeg") || (@$_FILES["changeprofile"]["type"]=="image/png") || (@$_FILES["changeprofile"]["type"]=="image/gif"))&&(@$_FILES["changeprofile"]["size"] < 10485760)) {

		$rand_dir_name = $username;


		if (file_exists("userdata/pictures/$rand_dir_name/".@$_FILES["changeprofile"]["name"])){

			move_uploaded_file(@$_FILES["changeprofile"]["tmp_name"],"userdata/pictures/$rand_dir_name/".$_FILES["changeprofile"]["name"]);
//echo "Uploaded and stored in: userdata/pictures/$rand_dir_name/".@$_FILES["changeprofile"]["name"];
			$profile_pic_name = @$_FILES["changeprofile"]["name"];

			$sql = "UPDATE users SET profile_pic='userdata/pictures/$rand_dir_name/$profile_pic_name' WHERE username='$username'";
			$conn->query($sql);
		}

		else {
			if (!file_exists("userdata/pictures/$rand_dir_name")){
				mkdir("userdata/pictures/$rand_dir_name");
			}
			move_uploaded_file(@$_FILES["changeprofile"]["tmp_name"],"userdata/pictures/$rand_dir_name/".$_FILES["changeprofile"]["name"]);
//echo "Uploaded and stored in: userdata/pictures/$rand_dir_name/".@$_FILES["changeprofile"]["name"];
			$profile_pic_name = @$_FILES["changeprofile"]["name"];
			$sql = "UPDATE users SET profile_pic='userdata/pictures/$rand_dir_name/$profile_pic_name' WHERE username='$username'";

			$conn->query($sql);
		}


	}
}




if(isset($_GET['u'])){
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
		$bio = $get['bio'];
		$sex = $get['sex'];
		
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
		$online = $get['online'];
		$profileUserOnline = false;
		if($online == '1'){
			$profileUserOnline = true;
		}
		
		$last_online_time = $get['last_online_time'];
		if($time - $last_online_time > 900){
			$sql = "UPDATE users SET online = '0' WHERE username = '$profileUser'";
			$update = $conn->query($sql);
			$profileUserOnline = false;
		}
		$onlinetimesincestr = time_elapsed_string($last_online_time);
		

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
				$profilepic = "http://www4.csudh.edu/Assets/CSUDH-Sites/History/images/Faculty-Profile-Pictures/Faculty%20Female%20Default%20Profile%20Picture.jpg";
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
		$profilepic = "http://www4.csudh.edu/Assets/CSUDH-Sites/History/images/Faculty-Profile-Pictures/Faculty%20Female%20Default%20Profile%20Picture.jpg";
	}
} else {
	//echo "<meta http-equiv=\"refresh\" content=\"0; url=/bruinskave/index.php\">";
	exit();
}

if (isset($_POST['post'])) {
	$post = @$_POST['post'];
	$post = str_replace("'","&apos;",$post);
	if($post != ""){
		date_default_timezone_set("America/Los_Angeles");
		$date_added = date("Y/m/d");
		$time_added = time(); 
		$added_by = $username;
		

		$sqlcommand = "INSERT INTO posts VALUES ( '', '$post', '$date_added', '$time_added', '$added_by', '1', '', '$profileUser', '', '', '', '', '0', '', '', '0')";
		if ($conn->query($sqlcommand) === TRUE) {
			$last_id = $conn->insert_id;
			$words_array = explode(" ", $post);

			foreach ($words_array as $value) {
				if (preg_match("/#.+/", $value)) {
					$check = $conn->query("SELECT * FROM hashtags WHERE word='$value'");
					if($check->num_rows == 1){
						$get = $check->fetch_assoc();
						$postids = $get["post_ids"];
						$postsid = $postids . ",". $last_id;
						$query = $conn->query("UPDATE hashtags SET post_ids='$postsid' WHERE word='$value'");
					}
					else{
						$query = $conn->query("INSERT INTO hashtags VALUES ('$value', '$last_id')");
					}
				} else {

				}
			}
		} else {
			echo "Error: " . $sqlcommand . "<br>" . $conn->error;
		}

	}
}
//post picture :: ln 603 :: postmethods/post.html
else if (isset($_FILES['pictureUpload'])) {
	$post = '';
	$post = $_POST['photopost'];
	$post = str_replace("'","&apos;",$post);
	date_default_timezone_set("America/Los_Angeles");
	$date_added = date("Y/m/d");
	$added_by = $username;
	$time_added = time();


	if (((@$_FILES["pictureUpload"]["type"]=="image/jpeg") || (@$_FILES["pictureUpload"]["type"]=="image/png") || (@$_FILES["pictureUpload"]["type"]=="image/gif"))&&(@$_FILES["pictureUpload"]["size"] < 10485760)) {

		$rand_dir_name = $username;


		if (file_exists("userdata/pictures/$rand_dir_name/".@$_FILES["pictureUpload"]["name"])){

			move_uploaded_file(@$_FILES["pictureUpload"]["tmp_name"],"userdata/pictures/$rand_dir_name/".$_FILES["pictureUpload"]["name"]);
//echo "Uploaded and stored in: userdata/pictures/$rand_dir_name/".@$_FILES["pictureUpload"]["name"];
			$profile_pic_name = @$_FILES["pictureUpload"]["name"];

			$sql = "INSERT INTO posts VALUES ('', '$post', '$date_added', '$time_added', '$added_by', '1', '', '$profileUser', '', 'userdata/pictures/$rand_dir_name/$profile_pic_name', '', '', '0', '', '', '0')";
			if ($conn->query($sql) === TRUE) {
				$last_id = $conn->insert_id;
				$words_array = explode(" ", $post);

				foreach ($words_array as $value) {
					if (preg_match("/#.+/", $value)) {
						$check = $conn->query("SELECT * FROM hashtags WHERE word='$value'");
						if($check->num_rows == 1){
							$get = $check->fetch_assoc();
							$postids = $get["post_ids"];
							$postsid = $postids . ",". $last_id;
							$query = $conn->query("UPDATE hashtags SET post_ids='$postsid' WHERE word='$value'");
						}
						else{
							$query = $conn->query("INSERT INTO hashtags VALUES ('$value', '$last_id')");
						}
					} else {

					}
				}
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}


			$sql = "INSERT INTO photos VALUES ('', '$username', 'userdata/pictures/$rand_dir_name/$profile_pic_name', '$maxid')";
			$profile_pic_query = $conn->query($sql);
		}

		else {
			if (file_exists("userdata/pictures/$rand_dir_name")){
				mkdir("userdata/pictures/$rand_dir_name");
			}
			move_uploaded_file(@$_FILES["pictureUpload"]["tmp_name"],"userdata/pictures/$rand_dir_name/".$_FILES["pictureUpload"]["name"]);
//echo "Uploaded and stored in: userdata/pictures/$rand_dir_name/".@$_FILES["pictureUpload"]["name"];
			$profile_pic_name = @$_FILES["pictureUpload"]["name"];
			$sql = "INSERT INTO posts VALUES ('', '$post', '$date_added', '$time_added', '$added_by', '1', '', '$profileUser', '', 'userdata/pictures/$rand_dir_name/$profile_pic_name', '', '', '0', '', '', '0')";

			if ($conn->query($sql) === TRUE) {
				$last_id = $conn->insert_id;
				$words_array = explode(" ", $post);

				foreach ($words_array as $value) {
					if (preg_match("/#.+/", $value)) {
						$check = $conn->query("SELECT * FROM hashtags WHERE word='$value'");
						if($check->num_rows == 1){
							$get = $check->fetch_assoc();
							$postids = $get["post_ids"];
							$postsid = $postids . ",". $last_id;
							$query = $conn->query("UPDATE hashtags SET post_ids='$postsid' WHERE word='$value'");
						}
						else{
							$query = $conn->query("INSERT INTO hashtags VALUES ('$value', '$last_id')");
						}
					} else {

					}
				}
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}


			$sql = "INSERT INTO photos VALUES ('', '$username', 'userdata/pictures/$rand_dir_name/$profile_pic_name', '$maxid')";
			$profile_pic_query = $conn->query($sql);
		}


	}
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>bruincave</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="theme-color" content="#1d2d4a" />
	<link rel="shortcut icon" href="img/bearpic.png">

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
		html{
			overflow-x: hidden;
		}
		body{
			
			background-color: #e6e6e6;
		}
		.banner{
			width:100vw;
			height: 325px;
			background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),url(<?php echo $bannerimg; ?>);
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center;

			-webkit-filter: blur(4px);
			-moz-filter: blur(4px);
			-o-filter: blur(4px);
			-ms-filter: blur(4px);
			filter: blur(4px);

			z-index: 1;
		}
		.profile-pic {
		    width: 150px;
		    height: 150px;
		    background-image: url(<?php echo $profilepic; ?>);
		    background-size: cover;
		    background-repeat: no-repeat;
		    background-position: center;
		    position: absolute;
		    top: 73px;
		    left: calc(50vw - 75px);
		    border-radius: 360px;
		    z-index: 2;
		}
		.profile-name{
			position: absolute;
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
			position: absolute;
			top: calc(162px + 108px);
			left: calc(50% - 30vw);
			font-size: 15px;
			font-family: 'PT Serif Caption';
			outline: 0;
		}
		#changepic{
			border: 0;
			width: 150px;
			height: 40px;
			border-bottom-left-radius: 360px;
			border-bottom-right-radius: 360px;
			position: absolute;
			top: calc(50% + 10px);
			font-size: 14px;
			max-width: 150px;
		}
		.follow{
			background-color: #0ebb0e;
			color: white;
		}
		.unfollow{
			background-color: #b8340c;
			color: white;
		}
		.changeedit{
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
		.posted-by-img{
			display: inline-block;
			width: 50px;
			height: 50px;
			border-radius: 45px;
			background-repeat: no-repeat;
			background-size: cover;
			background-position: center;
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
			font-size: 17px;
			color: #cdcdcd;
			float: right;
			position: relative;
			top: 25px;
			right: 18px;
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
			left: 57px;
			top: -73px;
			width: calc(100vw - 60px);
			height: 58px;
			border: 0;
			padding-left: 15px;
			font-size: 15px;
			background-color: #fff;
			outline-width: 0;
			font-family: Verdana;
		}
		.like-btn-div{
			position: absolute;
			display: inline-block;
			width: 58px;
			height: 58px;
			background-color: white;
			position: relative;
			top: -15px;
		}	
		.notliked{
			display: inline-block;
			height: 38px;
			width: 38px;
			margin-top: 5px;
			margin-left: 10px;
			background-image: url(img/notliked-paw.png);
			background-repeat: no-repeat;
			background-size: cover;
			cursor: pointer;
			position: relative;
			top: 5px;
			left: 3px;
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
			position: relative;
			top: 5px;
			left: 3px;
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
			top: -12px;
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
		.searchbar-wrapper{
			display: inline-block;
		}
		.search-tool-wrapper{
			display: inline-block;
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
		    left: -21px;
		    top: -10px;
		    font-size: 16px;
		    outline: 0;
		    color: white;
		    padding-left: 25px;
		    width: calc(100vw - 108px);
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
		.photos-wrapper{
			position: fixed;
			top: 0;
			height: 100vh;
			width: 100vw;
			background-color: white;
			z-index: 20;
			overflow-y: hidden;
			overflow-x: hidden;
		}
		.topbar-userimages{
			background-color: #1d2d4a;
			width: 100vw;
			height: 60px;
		}
		.userimages-name {
		    color: white;
		    text-align: center;
		    line-height: 60px;
		    position: absolute;
		    top: 0;
		    left: 58px;
		    font-size: 16px;
		}
		#back-userimages {
		    position: relative;
		    top: 13px;
		    left: 12px;
		}
		#back-photos {
		    position: relative;
		    top: 13px;
		    left: 12px;
		}
		#back-following {
		    position: relative;
		    top: 13px;
		    left: 12px;
		}
		#back-followers {
		    position: relative;
		    top: 13px;
		    left: 12px;
		}
		.photo-div-wrapper{
			display: inline-block;
		}
		.photo-div{
			height: calc(100vw / 3 - 5px);
		    width: calc(100vw / 3 - 5px);
		    background-size: cover;
		    margin-top: -2px;
		    margin-left: 0px;
		    background-repeat: no-repeat;
		    background-position: center;
		}

		.photo-cover {
		    height: calc(100vh - 60px);
		    position: relative;
		    overflow-y: scroll;
		    overflow-x: hidden;
		    left: 3px;
		    top: 3px;
		}
		div#fullscreen-img-wrapper {
		    position: absolute;
		    top: 0;
		    height: 100%;
		    overflow: scroll;
		 	background-color: white;
		}
		.following-wrapper{
			position: fixed;
			top: 0;
			height: 100vh;
			width: 100vw;
			background-color: #e6e6e6;
			z-index: 20;
			overflow-y: scroll;
			overflow-x: hidden;		
		}
		.followers-wrapper{
			position: fixed;
			top: 0;
			height: 100vh;
			width: 100vw;
			background-color: #e6e6e6;
			z-index: 20;
			overflow-y: scroll;
			overflow-x: hidden;		
		}
		.search-body{
			position: absolute;
			top: 0;
			height: 100vh;
			width: 100vw;
			background-color: #e6e6e6;
			z-index: 10;
		}
		.search-topbar{
			display: inline-block;
			position: fixed;
			top:0px;
			z-index: 9;
			padding: 15px;
			width: 100vw;
			height: 60px;
			background-color: #1d2d4a;
		}
		div#search-content {
		    margin-top: 60px;
		}
		.search-layer {
		    background: white;
		    padding: 7px;
		}
		.search-userpic {
		    display: inline-block;
		    height: 50px;
		    width: 50px;
		    background-size: cover;
		    background-position: center;
		    position: absolute;
		    top: -9px;
		}
		.search-name {
		    position: relative;
		    left: 60px;
		    top: -8px;
		    font-size: 15px;
		    font-weight: bold;
		    color: black;
		    text-decoration: none !important;
		}
		.search-time {
		    position: relative;
		    left: 60px;
		    top: -8px;
		    color: black;
		    text-decoration: none !important;
		}
		.search-layer {
		    background: white;
		    padding: 7px;
		    border-bottom: 1px solid #b5b4b4;
		}
		input.search-users {
		    width: 100vw;
		    height: 32px;
		    border: 0;
		    outline: 0;
		    padding-left: 33px;
		    margin-bottom: 10px;
		    margin-top: -6px;
		}
		span.usersearch-tool {
		    position: relative;
		    left: 10px;
		    top: 22px;
		    color: #b0b0b0;
		}
		.posthome {
			position: fixed;
			top: 0;
			height: 100vh;
			width: 100vw;
			background-color: #1d2d4a;
			z-index: 20;
			overflow: hidden;
		}
		.feedbackhome {
			position: fixed;
			top: 0;
			height: 100vh;
			width: 100vw;
			background-color: #1d2d4a;
			z-index: 30;
			overflow: hidden;
		}
		.postcrush {
			position: fixed;
			top: 0;
			height: 100vh;
			width: 100vw;
			background-color: #1d2d4a;
			z-index: 20;
			overflow: hidden;
		}
		textarea.posttext {
			position: relative;
			top: 50px;
			height: calc(100vh - 100px);
			width: 100vw;
			border: 0;
			resize: none;
			border-top: 1px solid #cec9c9;
			padding: 16px;
			font-size: 17px;
		}
		textarea.feedbacktext {
			position: relative;
			top: 50px;
			height: 100vh;
			width: 100vw;
			border: 0;
			resize: none;
			border-top: 1px solid #cec9c9;
			padding: 16px;
			font-size: 17px;
		}
		textarea.posttextcrush {
			position: relative;
			top: 50px;
			height: 100vh;
			width: 100vw;
			border: 0;
			resize: none;
			border-top: 1px solid #cec9c9;
			padding: 16px;
			font-size: 17px;
		}
		
		.crushoptions-cover {
			position: relative;
			height: 50px;
			top: 45px;
			background: #e6e6e6;
		}
		.photooption {
			border-right: 1px solid #cec9c9;
		}
		.postoptions {
			display: inline-block;
			line-height: 50px;
			width: 49vw;
			text-align: center;
			font-size: 18px;
		}
		.back-img-post{
			position: fixed;
			display: inline-block;
			height: 32px;
			width: 32px;
			background-image: url(img/back.png);
			background-size: cover;
			background-repeat: no-repeat;
			top: 10px;
			left: 15px;
		}
		.topbar-userimages{
			background-color: #1d2d4a;
			width: 100vw;
			height: 60px;
		}
		.inputfile {
			width: 0.1px;
			height: 0.1px;
			opacity: 0;
			overflow: hidden;
			position: absolute;
			z-index: -1;
		}
		.inputfile + label {
			width: 49vw;
			height: 50px;
			font-size: 15px;
			display: inline-block;
			overflow: hidden;
			text-align: center;
			position: relative;
			top: 0px;
			left: 0;
			line-height: 50px;
		}

		.no-js .inputfile + label {
			display: none;
		}

		.inputfile:focus + label,
		.inputfile.has-focus + label {
			outline: 1px dotted #000;
			outline: -webkit-focus-ring-color auto 5px;
		}

		.inputfile + label svg {
			width: 1em;
			height: 1em;
			vertical-align: middle;
			fill: currentColor;
			margin-top: -0.25em;
			/* 4px */
			margin-right: 0.25em;
			/* 4px */
		}

		.inputfile-1 + label {
			color: black;
			background-color: transparent;
		}
		.submitpost{
			position: fixed;
			width: 100px;
			height: 50px;
			left: calc(100vw - 100px);
			font-size: 17px;
			background: transparent;
			color: white;
			border: 0;
		}
		.postoptions-cover {
		    top: calc(100vh - 50px);
		    position: absolute;
		    background: #e6e6e6;
		}
		.post-write-tabs {
			display: inline-block;
			width: calc((100vw / 2) - 2px);
			font-size: 18px;
			text-align: center;
			line-height: 50px;
			border-left: 1px solid #c6c8cd;
		}
		.link-div{
			width: 49vw;
			height: 50px;
			font-size: 15px;
			display: inline-block;
			overflow: hidden;
			text-align: center;
			position: relative;
			top: -6px;
			left: 0;
			line-height: 50px;
			font-weight: bold;
		}
		#changebanner{
		    display:none;
		}
		#changeprofile{
		    display:none;
		}
		span.likedby-names {
		    position: relative;
		    top: 3px;
		    left: 5px;
		}
		.optionBox {
		    background: #e6e6e6;
		    position: fixed;
		    top: calc(50vh - 45px);
		    left: calc(50vw - 40vw);
		    z-index: 25;
		    width: 80vw;
		    box-shadow: 1px 1px 21px #e6e6e6;
		}
		.optionsPost {
		    background: white;
		    height: 43px;
		    line-height: 43px;
		    text-align: center;
		    margin-top: 1px;
		    font-size: 16px;
		}
		.optionBox-wrapper {
		    height: 100vh;
		    width: 100vw;
		    position: fixed;
		    z-index: 25;
		    background: rgba(222,215,215,0.3);
		}
		.posted-pic-crop {
		    max-height: 440px;
		    overflow: hidden;
		}
	</style>

</head>
<body>
	<div id="anyreport">

	</div>
	<div class="posthome">
		<form action="#" method="POST" enctype="multipart/form-data">
			<div class="back-img-post" id="back-post"></div>
			<input type="submit" name="submitpost" class="submitpost" value="Roar">
			<div id="posttype">
				<textarea class="posttext" placeholder="What's on your mind?" name="post"></textarea>
			</div>
			<div class="postoptions-cover">
				<div class="post-write-tabs text-tab-post">Text</div>
				<div class="post-write-tabs photo-tab-post">Photo</div>
				<!--<div class="post-write-tabs video-tab-post">Video</div>-->
			</div>
		</form>
	</div>
	<div class="top-bar">
		<a href="home.php"><div class="back-img"></div></a>

		<div class="searchbar-wrapper">
			<div class="search-tool-wrapper">
				<span class="search-tool glyphicon glyphicon-search"></span>
			</div>
			<input class="search" type="text" onclick="location.href = 'home.php'" placeholder="Search..." name="search" autocomplete="off" value="<?php echo $firstname . " " . $lastname; ?>">
		</div>
	</div>
	<div class="banner"></div>
	<div class="profile-pic">
		<?php 
		if(strcasecmp($username,$profileUser) == 0) { // profile user: strings match
			echo '
			<form id="sendprofile" action="profile.php?u='.$username.'" method="POST" enctype="multipart/form-data">
				<input id="changeprofile" name="changeprofile" type="file"/>
				<input type="submit" id="submitchangeprofile" style="display:none;"/>
				<button id = "changepic" class = "changeedit changepro">Change Picture</button>
			</form>
			';
		}
		?>
	</div>

	<div class="profile-name"><?php echo $firstname . " " . $lastname;?></div>
	<!---Fixx THis-->
	<?php
	if(strcasecmp($username,$profileUser) != 0) { // non profile user:  strings differ
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
		<form id="sendbanner" action="profile.php?u='.$username.'" method="POST" enctype="multipart/form-data">
			<input id="changebanner" name="changebanner" type="file"/>
			<input type="submit" id="submitchangebanner" style="display:none;"/>
			<button id = "follow" class = "changeedit changeban">Change Banner</button>
		</form>
		';
	}

	?>
	<div class="add-post" id="addPost">
		<div class="add-post-pen"></div>
	</div>
	<div class="lower-body">
		<div class="about-me">
			<div class="info-about-me"><span class="bio"><?php echo $bio; ?></span></div>
			<div class="info-about-me"><img src="img/bird-in-broken-egg.png" width="25px"><span class="dob">Was born on <?php echo $dob; ?></span></div>
			<div class="info-about-me"><img src="img/wifi.png" width="20px"><span class="lastonline">
			<?php 
			if($profileUserOnline){
				echo "Online";
			}else{
				echo "Last online $onlinetimesincestr";
			}
			?></span></div>
		</div>
		<div class="options-tabs">
			<div class="tabs photos-tab">Photos</div>
			<div class="tabs following-tab">Following</div>
			<div class="tabs followers-tab">Followers</div>
		</div>
		<div class="body-content" id="body-content">
			<div class="content" id="content">

			</div>
			<div id = "end">
				<div id="loading-img" style = "position: relative;">
					<img  src = "http://bestanimations.com/Science/Gears/loadinggears/loading-gear.gif" style = "position: absolute;left: calc(50vw - 144px);" />
				</div>
			</div>
			<div style="display:none" id="post_offset">0</div>
		</div>
	</div>
	<div class="like-bearpic" style="position: fixed;height: 209px;width: 200px;top: calc(50vh - 100px);left: calc(50vw - 100px);background: url(http://web1.nbed.nb.ca/sites/ASD-S/1929/PublishingImages/BEAR%20PAW.gif);z-index: 20;background-size:cover;background-repeat:no-repeat;"></div>

	<div class="photos-wrapper">
		<div class="topbar-userimages">
			<div class="back-img" id="back-userimages"></div>
			<div class="userimages-name"><?php echo $firstname . "'s Photo Uploads"; ?></div>
		</div>
		<div class="photo-cover">
		<?php
			$getphotos = $conn->query("SELECT * FROM photos WHERE username='$profileUser' ORDER BY id DESC");

			if($getphotos->num_rows > 0) {
				while ($row = $getphotos->fetch_assoc()) {
					$photo_id = $row['id'];
					$photo_link = $row['photo_link'];
					$post_id = $row['post_id'];

					echo '
						<div class="photo-div-wrapper">
							<div class="photo-div" photoid = "'.$photo_id.'" style="background-image: url('.$photo_link.');"></div>
						</div>
					';
				}
			}
		?>
		</div>
		<div id="fullscreen-img-wrapper">
			
		</div>
	</div>
	<div class="following-wrapper">
		<div class="topbar-userimages">
			<div class="back-img" id="back-following"></div>
			<div class="userimages-name"><?php echo $firstname . "'s Followings"; ?></div>
		</div>
		<div class="users-searchbox">
			<span class="usersearch-tool glyphicon glyphicon-search"></span>
			<input class = "search-users" id = "search-users-following" placeholder = "Lookup!" />
		</div>
		<div class="following-people-list">

		</div>
	</div>
	<div class="followers-wrapper">
		<div class="topbar-userimages">
			<div class="back-img" id="back-followers"></div>
			<div class="userimages-name"><?php echo $firstname . "'s Followers"; ?></div>
		</div>
		<div class="users-searchbox">
			<span class="usersearch-tool glyphicon glyphicon-search"></span>
			<input class = "search-users" id = "search-users-followers" placeholder = "Lookup!" />
		</div>
		<div class="followers-people-list">

		</div>
	</div>
	<script type="text/javascript">
		var username = "<?php echo $profileUser; ?>";
		$(".following-people-list").load("action/searchfollowing.php?u="+username);
		$(".followers-people-list").load("action/searchfollowers.php?u="+username);
		$("input#search-users-following").keyup(function(){
		    var text = $(this).val();
		    var username = "<?php echo $profileUser; ?>";
		    var link = "action/searchfollowing.php?u="+username+"&s="+text;
		    $.ajax({
		      url: link,
		      success: function(data){
		      	$(".following-people-list").html(data);
		      },
		      error: function(xhr, type, exception) { 
		      	//error
		      }
		    });
		});
		$("input#search-users-followers").keyup(function(){
		    var text = $(this).val();
		    var username = "<?php echo $profileUser; ?>";
		    var link = "action/searchfollowers.php?u="+username+"&s="+text;
		    $.ajax({
		      url: link,
		      success: function(data){
		      	$(".followers-people-list").html(data);
		      },
		      error: function(xhr, type, exception) { 
		      	//error
		      }
		    });
		});

	function reportpost(postid){
		var newElem="";
		newElem += "<div class='optionBox-wrapper'><div class='optionBox' pid='"+postid+"'>";
		newElem += "    <div class='optionsPost' id='deletepost' onclick='inappost("+postid+");'>Inappropriate...<\/div>";
		newElem += "    <div class='optionsPost' id='reportpost' onclick='bullypost("+postid+");'>Abusive, Bullying...<\/div>";
		newElem += "    <div class='optionsPost' id='reportpost' onclick='idlikepost("+postid+");'>I don\'t like it...<\/div>";
		newElem += "<\/div><\/div>";

		    $("#anyreport").html(newElem);
	}
	function inappost(postid){
		var newElem="";
		newElem += "<div class='optionBox-wrapper'><div class='optionBox' pid='"+postid+"'>";
		newElem += "    <div class='optionsPost' id='deletepost' onclick='report(1);'>It\'s sexually explicit<\/div>";
		newElem += "    <div class='optionsPost' id='reportpost' onclick='report(2);'>Drugs, or Illegal Substances<\/div>";
		newElem += "    <div class='optionsPost' id='reportpost' onclick='report(3);'>Something Else<\/div>";
		newElem += "<\/div><\/div>";

		$("#anyreport").html(newElem);
	}
	function bullypost(postid){
		var newElem="";
		newElem += "<div class='optionBox-wrapper'><div class='optionBox' pid='"+postid+"'>";
		newElem += "    <div class='optionsPost' id='deletepost' onclick='report(4);'>It\'s harassment<\/div>";
		newElem += "    <div class='optionsPost' id='reportpost' onclick='report(5);'>It\'s threatening, violent.<\/div>";
		newElem += "    <div class='optionsPost' id='deletepost' onclick='report(6);'>It\'s rude, vulgar<\/div>"; 
		newElem += "    <div class='optionsPost' id='reportpost' onclick='report(7);'>Something Else<\/div>";
		newElem += "<\/div><\/div>";

		$("#anyreport").html(newElem);
	}

	function idlikepost(postid){
		var newElem="";
		newElem += "<div class='optionBox-wrapper'><div class='optionBox' pid='"+postid+"'>";
		newElem += "    <div class='optionsPost' id='deletepost' onclick='report(8);'>It\'s not interesting<\/div>";
		newElem += "    <div class='optionsPost' id='reportpost' onclick='report(9);'>It\'s embarrassing<\/div>";
		newElem += "    <div class='optionsPost' id='reportpost' onclick='report(10);'>Something Else<\/div>";
		newElem += "<\/div><\/div>";

		$("#anyreport").html(newElem);
	}

	function report(about){
		var postid = $(".optionBox").attr("pid");

		var link ='action/reportpost.php?pid='+postid+'&about='+about;
		$.ajax({url: link, 
			success: function() {
				$("#profile-post-"+postid).slideUp(300);
				var newElem="";
				newElem += "<div class='optionBox-wrapper'><div class='optionBox'>";
				newElem += "    <div class='optionsPost' id='deletepost'><b>Thank you</b> for you help.<\/div>";
				newElem += "<\/div><\/div>";
				$("#anyreport").html(newElem);
			},
			error: function() {
				alert('not deleted');
			}
		});
	}

	if($("#anyreport").html() != ""){
		$(document).mouseup(function (e){
			var container = $(".optionBox");

		    if (!container.is(e.target) // if the target of the click isn't the container...
		        && container.has(e.target).length === 0) // ... nor a descendant of the container
		    {
		    	$("#anyreport").html("");
		    	boxOpen = false;
		    }
		});
	}

	function deletepost(postid){
		var link ='action/deletepost.php?id='+postid;
		$.ajax({url: link, 
			success: function() {
				$("#profile-post-"+postid).slideUp(300);
				$("#anyreport").html("");
			},
			error: function() {
				alert('not deleted');
			}
		});
	}

	$(function(){
	    $(".changeban").on('click', function(e){
	        e.preventDefault();
	        $("#changebanner:hidden").trigger('click');
	    });
	});
	<?php
		if(strcasecmp($username,$profileUser) == 0) {
	?>
			$("#changebanner").change(function(){
			  	$("#submitchangebanner").trigger('click');
			});
			$("#changeprofile").change(function(){
				alert("spot change");
			  	$("#submitchangeprofile").trigger('click');
			});  
	<?php 
		}
	?>
	$(function(){
	    $(".changepro").on('click', function(e){
	        e.preventDefault();
	        $("#changeprofile:hidden").trigger('click');
	    });
	});
	
	$(".posthome").hide();
	$("#addPost").click(function(){
		$(".posthome").slideDown(700);
	});
	$("#back-post").click(function(){
		$(".posthome").slideUp(700);
	});
	$(".text-tab-post").click(function(){
		$("#posttype").load("postmethods/textpost.php");
		
	});
	$(".photo-tab-post").click(function(){
		$("#posttype").load("postmethods/photopost.php");
		
	});
	$(function() {
		var current_scrolltop = $(window).scrollTop();
		$(window).scroll(function(){


			if ($(window).scrollTop() >= current_scrolltop && $(window).scrollTop() >= 60) {
				$(".top-bar").hide();
			}
			else {
				$(".top-bar").show();
			}
			current_scrolltop = $(window).scrollTop();
			
		});
	});

	$(".following-wrapper").hide();
	$(".followers-wrapper").hide();
	$(".following-tab").click(function(){
		$(".following-wrapper").show("slide", { direction: "left" }, 200);
		$("html").css("overflow", "hidden");
	});
	$("#back-following").click(function(){
		$(".following-wrapper").hide("slide", { direction: "left" }, 200);
		$("html").css("overflow", "scroll");
	});
	$(".followers-tab").click(function(){
		$(".followers-wrapper").show("slide", { direction: "left" }, 200);
		$("html").css("overflow", "hidden");
	});
	$("#back-followers").click(function(){
		$(".followers-wrapper").hide("slide", { direction: "left" }, 200);
		$("html").css("overflow", "scroll");
	});
	$("#fullscreen-img-wrapper").hide();
	$(".photos-wrapper").hide();
	$(".photos-tab").click(function(){
		$(".photos-wrapper").show("slide", { direction: "left" }, 200);
		$("html").css("overflow", "hidden");
	});
	$("#back-userimages").click(function(){
		$(".photos-wrapper").hide("slide", { direction: "left" }, 200);
		$("html").css("overflow", "scroll");
	});
	$(".photo-div").click(function(){
		var id = $(this).attr("photoid");
		var url = "action/bringfullscreenphoto.php?id="+id;
		$.ajax({url: url, success: function(result){
			$("#fullscreen-img-wrapper").show("slide", { direction: "left" }, 200);
			$("#fullscreen-img-wrapper").html(result);
			$('#close-fullscreen').click(function(){
				$('#fullscreen-img-wrapper').html('');
			});
			$('.post-comment').submit(function(e){
			    e.preventDefault();
			    var curr_position = $(this).closest('.post-comment');
			    postcomment(curr_position);
			    e.unbind();
			});		
		},
		error: function(jqXHR, textStatus, errorThrown) {
	        alert(textStatus);
	    }});
	});
	$(".like-bearpic").hide();
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
			if(($(window).scrollTop() >= $('#end').offset().top + $('#end').outerHeight() - window.innerHeight) - 400) {

				//alert('end reached');
				load_more_post();
				$("#loading-img").show();
			}
		});
	});
	/*var $document = $(document);

	$document.scroll(function() {
	  if ($document.scrollTop() >= 300) {

	  	$(".top-bar").css("background-color","#1d2d4a");

	  } else {
	  	$(".top-bar").css("background-color","transparent");
	  }
	});*/
	function addFollowing() {

		var text = <?php echo '"'.$profileUser.'"'; ?>;
		var addurl = "action/addfollowings.php?addto="+text;

		$.ajax({url: addurl, success: function(){
			$("#follow").attr('class', 'unfollow');
			$("#follow").attr('onclick', 'removeFollowing();');
			$("#follow").html("Unfollow");
			var i = $("#followersCount").html();
			i = Number(i) + 1;
			$("#followersCount").html(i);
		}});
	}

	function removeFollowing() {

		var text = <?php echo '"'.$profileUser.'"'; ?>;
		var addurl = "action/removefollowings.php?rem="+text;

		$.ajax({url: addurl, success: function(){
			$("#follow").attr('class', 'follow');
			$("#follow").attr('onclick', 'addFollowing();');
			$("#follow").html("Follow");
			var i = $("#followersCount").html();
			i = Number(i) - 1;
			$("#followersCount").html(i);
		}});
	}
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
		"	<div class = 'comment-body'>"+
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
				curr_position.parent().parent().next().append(comment_html1+commenttxt+comment_html2);

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