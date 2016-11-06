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
			$profilepic = "http://www4.csudh.edu/Assets/CSUDH-Sites/History/images/Faculty-Profile-Pictures/Faculty%20Female%20Default%20Profile%20Picture.jpg";
		}
	}


} else {
	//echo "<meta http-equiv=\"refresh\" content=\"0; url=/bruinskave/index.php\">";
	exit();
}
if (isset($_POST['feedback'])) {
	$post = @$_POST['feedback'];
	$post = str_replace("'","&apos;",$post);
	
	$fp = fopen("bruinfeedback.txt", "a");
	fputs($fp,"Username: ");
	fputs($fp,$username);
	fputs($fp,"\n");
	fputs($fp,"\n");
	fputs($fp,"Message: ");
	fputs($fp,$post);
	fputs($fp,"\n");
	fputs($fp,"\n");
	fputs($fp,"============================================================================");
	
	fclose($fp);
}
if (isset($_POST['crushpost'])) {
	$post = @$_POST['crushpost'];
	$post = str_replace("'","&apos;",$post);
	if($post != ""){
		date_default_timezone_set("America/Los_Angeles");
		$date_added = date("Y/m/d");
		$time_added = date("h:i:sa"); 
		$added_by = $username;
		

		$sqlcommand = "INSERT INTO crush VALUES ('', '$post', '$added_by', '', '$time_added', '$date_added')";
		$query = $conn->query($sqlcommand);
	}
	header("Location: home.php?tab=c");
}
else if (isset($_FILES['crushpictureUpload'])) {
	$post = '';
	$post = $_POST['crushpost'];
	$post = str_replace("'","&apos;",$post);
	date_default_timezone_set("America/Los_Angeles");
	$date_added = date("Y/m/d");
	$added_by = $username;
	$time_added = date("h:i:sa");


	if (((@$_FILES["crushpictureUpload"]["type"]=="image/jpeg") || (@$_FILES["crushpictureUpload"]["type"]=="image/png") || (@$_FILES["crushpictureUpload"]["type"]=="image/gif"))&&(@$_FILES["crushpictureUpload"]["size"] < 10485760)) {

		$rand_dir_name = $username;


		if (file_exists("userdata/pictures/$rand_dir_name/".@$_FILES["crushpictureUpload"]["name"])){

			move_uploaded_file(@$_FILES["crushpictureUpload"]["tmp_name"],"userdata/pictures/$rand_dir_name/".$_FILES["crushpictureUpload"]["name"]);
//echo "Uploaded and stored in: userdata/pictures/$rand_dir_name/".@$_FILES["crushpictureUpload"]["name"];
			$profile_pic_name = @$_FILES["crushpictureUpload"]["name"];

			$sql = "INSERT INTO posts VALUES ('', '$post', '$date_added', '$time_added', '$added_by', '0', '', '', '', 'userdata/pictures/$rand_dir_name/$profile_pic_name', '', '', '0', '', '')";
			
		}

		else {
			if (file_exists("userdata/pictures/$rand_dir_name")){
				mkdir("userdata/pictures/$rand_dir_name");
			}
			move_uploaded_file(@$_FILES["crushpictureUpload"]["tmp_name"],"userdata/pictures/$rand_dir_name/".$_FILES["crushpictureUpload"]["name"]);
//echo "Uploaded and stored in: userdata/pictures/$rand_dir_name/".@$_FILES["crushpictureUpload"]["name"];
			$profile_pic_name = @$_FILES["crushpictureUpload"]["name"];
			$sql = "INSERT INTO posts VALUES ('', '$post', '$date_added', '$time_added', '$added_by', '0', '', '', '', 'userdata/pictures/$rand_dir_name/$profile_pic_name', '', '', '0', '', '')";


		}


	}
}

if (isset($_POST['post'])) {
	$post = @$_POST['post'];
	$post = str_replace("'","&apos;",$post);
	$post = str_replace("<","&lt;",$post);
	$post = str_replace(">","&gt;",$post);
	if($post != ""){
		date_default_timezone_set("America/Los_Angeles");
		$date_added = date("Y/m/d");
		$time_added = date("h:i:sa"); 
		$added_by = $username;
		

		$sqlcommand = "INSERT INTO posts VALUES ( '', '$post', '$date_added', '$time_added', '$added_by', '0', '', '', '', '', '', '', '0', '', '')";
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
	header("Location: home.php");
}
//post picture :: ln 603 :: postmethods/post.html
else if (isset($_FILES['pictureUpload'])) {
	$post = '';
	$post = $_POST['photopost'];
	$post = str_replace("'","&apos;",$post);
	$post = str_replace("<","&lt;",$post);
	$post = str_replace(">","&gt;",$post);
	date_default_timezone_set("America/Los_Angeles");
	$date_added = date("Y/m/d");
	$added_by = $username;
	$time_added = date("h:i:sa");


	if (((@$_FILES["pictureUpload"]["type"]=="image/jpeg") || (@$_FILES["pictureUpload"]["type"]=="image/png") || (@$_FILES["pictureUpload"]["type"]=="image/gif"))&&(@$_FILES["pictureUpload"]["size"] < 10485760)) {

		$rand_dir_name = $username;


		if (file_exists("userdata/pictures/$rand_dir_name/".@$_FILES["pictureUpload"]["name"])){

			move_uploaded_file(@$_FILES["pictureUpload"]["tmp_name"],"userdata/pictures/$rand_dir_name/".$_FILES["pictureUpload"]["name"]);
//echo "Uploaded and stored in: userdata/pictures/$rand_dir_name/".@$_FILES["pictureUpload"]["name"];
			$profile_pic_name = @$_FILES["pictureUpload"]["name"];

			$sql = "INSERT INTO posts VALUES ('', '$post', '$date_added', '$time_added', '$added_by', '0', '', '', '', 'userdata/pictures/$rand_dir_name/$profile_pic_name', '', '', '0', '', '')";
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
			if (!file_exists("userdata/pictures/$rand_dir_name")){
				mkdir("userdata/pictures/$rand_dir_name");
			}
			move_uploaded_file(@$_FILES["pictureUpload"]["tmp_name"],"userdata/pictures/$rand_dir_name/".$_FILES["pictureUpload"]["name"]);
//echo "Uploaded and stored in: userdata/pictures/$rand_dir_name/".@$_FILES["pictureUpload"]["name"];
			$profile_pic_name = @$_FILES["pictureUpload"]["name"];
			$sql = "INSERT INTO posts VALUES ('', '$post', '$date_added', '$time_added', '$added_by', '0', '', '', '', 'userdata/pictures/$rand_dir_name/$profile_pic_name', '', '', '0', '', '')";

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
	header("Location: home.php");
} /* else if (isset($_FILES['videoUpload'])) {
	$post = '';
	$post = $_POST['videopost'];
	$post = str_replace("'","&apos;",$post);
	date_default_timezone_set("America/Los_Angeles");
	$date_added = date("Y/m/d");
	$added_by = $username;
	$time_added = date("h:i:sa");


	if (((@$_FILES["videoUpload"]["type"]=="video/mp4") || (@$_FILES["videoUpload"]["type"]=="video/webm") || (@$_FILES["videoUpload"]["type"]=="video/ogg"))&&(@$_FILES["videoUpload"]["size"] < 10485760)) {

		$rand_dir_name = $username;


		if (file_exists("userdata/videos/$rand_dir_name/".@$_FILES["videoUpload"]["name"])){

			move_uploaded_file(@$_FILES["videoUpload"]["tmp_name"],"userdata/videos/$rand_dir_name/".$_FILES["videoUpload"]["name"]);
//echo "Uploaded and stored in: userdata/videos/$rand_dir_name/".@$_FILES["videoUpload"]["name"];
			$profile_pic_name = @$_FILES["videoUpload"]["name"];

			$sql = "INSERT INTO posts VALUES ('', '$post', '$date_added', '$time_added', '$added_by', '0', '', '', '', '', 'userdata/videos/$rand_dir_name/$profile_pic_name', '', '0', '', '')";
			$profile_pic_query = $conn->query($sql);
		}

		else {
			if (file_exists("userdata/videos/$rand_dir_name")){
				
			}else{
				mkdir("userdata/videos/$rand_dir_name");
			}
			move_uploaded_file(@$_FILES["videoUpload"]["tmp_name"],"userdata/videos/$rand_dir_name/".$_FILES["videoUpload"]["name"]);
//echo "Uploaded and stored in: userdata/videos/$rand_dir_name/".@$_FILES["videoUpload"]["name"];
			$profile_pic_name = @$_FILES["videoUpload"]["name"];
			$sql = "INSERT INTO posts VALUES ('', '$post', '$date_added', '$time_added', '$added_by', '0', '', '', '', '', 'userdata/videos/$rand_dir_name/$profile_pic_name', '', '0', '', '')";

			$profile_pic_query = $conn->query($sql);
		}


	}
}
*/

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
			overflow: hidden;
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
			background-position: center;
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
			height: 50px;
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
			background-image: url(img/anonymous-logo-white.png);
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
		.crush-post {
			position: relative;
			width: 95vw;
			left: 2.5vw;
			margin-bottom: 15px;
			border-top: 1px solid #bbb;
			border-bottom: 1px solid #bbb;
			color: white;
		}

		.posted-by-img{
			display: inline-block;
			width: 50px;
			height: 50px;
			border-radius: 45px;
			background-repeat: no-repeat;
			background-position: center;
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
			font-size: 23px;
			padding-left: 10px;
			padding-right: 10px;
			margin-left: 15px;
			margin-top: 17px;
			padding-bottom: 10px;
		}
		.crush_pic {
			width: 95vw;
			position: relative;
			left: 2.5vw;
			max-height: 400px;
			margin-top: -15px;
			margin-bottom: 15px;
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
			top: -72px;
			width: calc(100vw - 57px);
			height: 57px;
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
			height: 57px;
			background-color: white;
			position: relative;
			top: -15px;
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
			border-bottom: 1px solid #bbb;
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
			background-color: white;
			padding: 20px;
			position: relative;
			width: 95vw;
			left: 2.5vw;
			margin-bottom: 15px;
			border-top: 1px solid #bbb;
			border-bottom: 1px solid #bbb;
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
		    position: relative;
		    width: 100vw;
		    height: 53px;
		    padding: 13px;
		    border-bottom: 1px solid #d7d7d7;
		}
		.each-user-text {
		    position: absolute;
		    display: inline-block;
		    top: 30px;
		    left: 68px;
		    font-size: 13px;
		}
		.chat-user-img {
			display: inline-block;
			width: 40px;
			height: 40px;
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center;
			position: relative;
			top: -6px;
			border-radius: 45px;
		}
		.each-user-name {
			display: inline-block;
			position: relative;
			top: -27px;
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
			display: none;
		}
		#messenger-name{
			position: relative;
			left: 3px;
			top: 3px;
			font-size: 20px;
			font-family: 'PT Serif Caption';
		}
		.arrow-back{
			font-size: 27px;
			position: relative;
			left: 20px;
			top: 15px;
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
			width: 100vw;
		}
		.notificationBox {
		    display: inline-block;
		    width: calc(100vw - 60px);
		    position: relative;
		    padding-top: 15px;
		    top: 0px;
		    left: 53px;
		    padding-bottom: 10px;
		}
		.fromPicNotification {
		    height: 35px;
		    width: 35px;
		    background-size: cover;
		    background-repeat: no-repeat;
		    background-position: center;
		    border-radius: 45px;
		    position: absolute;
		    left: 10px;
		    top: 6px;
		}
		span.notifier {
			font-weight: bold;
			font-size: 13px;
			color: black;
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
			background-position: center;
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
		.body-content {
			z-index: 3;
			height: 100vh;
			position: absolute;
			top: 0;
			padding-top: 110px;
			overflow-y: scroll;
		}
		.crush-content{
			z-index: 3;
			height: 100vh;
			width: 100vw;
			position: absolute;
			top: 0;
			padding-top: 125px;
			overflow-y: scroll;
			background:url(img/confessionbackground.jpg);
			background-size: cover;
			opacity: 0.9; 
		}
		.notifications-content{
			z-index: 0;
			height: 100vh;
			position: absolute;
			top: 0;
			padding-top: 110px;
			overflow-y: scroll;
		}
		.message-content{
			z-index: 3;
		}
		.add-post{
			display: inline-block;
			width: 55px;
			height: 55px;
			position: fixed;
			z-index: 8;
			top: calc(100vh - 70px);
			left: calc(100vw - 70px);
			background-color: orange;
			padding: 10px;
			border-radius: 90px;
		}
		.add-crush{
			display: inline-block;
			width: 55px;
			height: 55px;
			position: fixed;
			z-index: 8;
			top: calc(100vh - 70px);
			left: calc(100vw - 70px);
			background-color: #ebdbd8;
			padding: 10px;
			border-radius: 90px;
		}
		.add-people{
			display: inline-block;
			width: 55px;
			height: 55px;
			position: fixed;
			z-index: 8;
			top: calc(100vh - 70px);
			left: calc(100vw - 70px);
			background-color: orange;
			padding: 10px;
			border-radius: 90px;
		}
		.add-people-plus{
			display: inline-block;
			height: 30px;
			width: 30px;
			background-size: cover;
			background-repeat: no-repeat;
			color: white;
			font-size: 28px;
			position: relative;
			left: 5px;
			top: 3px;
		}
		.add-post-pen {
		    display: inline-block;
		    height: 30px;
		    width: 30px;
		    background-image: url(img/edit.png);
		    background-size: cover;
		    background-repeat: no-repeat;
		    position: relative;
		    left: 3px;
		    top: 2px;
		}
		.add-post-crush{
			display: inline-block;
			height: 30px;
			width: 30px;
			background-image: url(img/anonymous-logo-blue.png);
			background-size: cover;
			background-repeat: no-repeat;
			position: relative;
			left: 3px;
			top: 4px;
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
		.addpeoplesearch{
			position: fixed;
			top: 0;
			height: 100vh;
			width: 100vw;
			background-color: #e6e6e6;
			z-index: 20;
			overflow-y: scroll;
			overflow-x: hidden;
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
		.back-img{
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
		.userimages-name {
		    color: white;
		    font-size: 15px;
		    position: fixed;
		    top: 19px;
		    left: 59px;
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
		div#search-contentpeople {
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
		div#last_notification {
			padding: 15px;
			padding-left: calc(50vw - 89px);
		}
		.post-write-tabs {
			display: inline-block;
			width: calc((100vw / 2) - 6px);
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
		.reported{
			position: fixed;
			background-color: white;
			height: 50px;
			width: 80vw;
			z-index: 25;
			top: calc(50vh - 25px);
			left: 10vw;
			text-align: center;
			font-size: 20px;
		}
		.flag-reported{
			color: black;
			font-size: 35px;
			position: relative;
			left: -15px;
			top: 9px;
		}
		#top-content{
			height: 0px;
			z-index: 50;
		}
		div#fullscreen-img-wrapper {
		    position: absolute;
		    top: 0;
		    height: 100%;
		    overflow: scroll;
		 	background-color: white;
		 	z-index: 20;
		}
		.postoptions-cover {
		    position: relative;
		    background: #e6e6e6;
		    top: 45px;
		}
		.add-people-tip {
		    position: fixed;
		    top: calc(100vh - 59px);
		    left: calc(100vw - 193px);
		    background: #1d2d4a;
		    color: white;
		    padding: 7px;
		    padding-left: 15px;
		    padding-right: 25px;
		    border-top-right-radius: 50px;
		    border-bottom-right-radius: 50px;
		}
	</style>
</head>
<body id="element">
	<div class="feedbackhome">
		<form action="home.php" method="POST" enctype="multipart/form-data">
			<div class="back-img" id="back-feedback"></div>
			<input type="submit" name="submitpost" class="submitpost" value="Send">
			<div id="feedbacktype">
				<textarea class="feedbacktext" placeholder="How can we improve?" name="feedback"></textarea>
			</div>
		</form>
	</div>
	<div class="reported">
		<span class="glyphicon glyphicon-flag flag-reported"></span>
		<span>Reported</span>
	</div>
	<div class="posthome">
		<form action="home.php" method="POST" enctype="multipart/form-data">
			<div class="back-img" id="back-post"></div>
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
	<div class="postcrush">
		<form action="home.php?tab=c" method="POST" enctype="multipart/form-data">
			<div class="back-img" id="back-crush"></div>
			<input type="submit" name="submitpost" class="submitpost" value="Roar">
			<div id="crushtype">
				<textarea class="posttextcrush" placeholder="Make confession anonymously" name="crushpost"></textarea>
			</div>
		</form>
	</div>
<div class="top-pusher"></div>
<div id="top-content">
	<div class="top-bar">
		<div class="homepic-searchbar"></div>
		<div class="searchbar-wrapper">
			<div class="search-tool-wrapper">
				<span class="search-tool glyphicon glyphicon-search"></span>
			</div>
			<input class="search" id = "search-btn" type="text" placeholder="Search..." name="search" autocomplete="off">
		</div>
	</div>
	<div class="options-tabs">
		<div class="tabs home-tab"><div class="home-img"></div></div>
		<div class="tabs crush-tab"><div class="crush-img"></div></div>
		<div class="tabs notifications-tab"><div class="notifications-img"></div></div>
		<div class="tabs messages-tab"><div class="messages-img"></div></div>
	</div>
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
	<div class="add-post" id="add-post">
		<div class="add-post-pen"></div>
	</div>
</div>

<div class="crush-content">
	<div class="crushcontent" id="crushcontent">

	</div>
	<div id = "endcrush">
		<div id="loading-img-crush" style = "position: relative;">
			<img  src="http://bestanimations.com/Science/Gears/loadinggears/loading-gear.gif" style="position: absolute;left: calc(50vw - 144px);" class="the-loading-img" />
		</div>
	</div>
	<div style="display:none" id="crush_offset">0</div>
	<div class="add-crush" id="add-crush">
		<div class="add-post-crush"></div>
	</div>
</div>

<div class="notifications-content">
	<div class="notificationscontent" id="notificationscontent">

	</div>
	<div id = "endnotifications">
		<div id="loading-img-notifications" style = "position: relative;">
			<img  src="http://bestanimations.com/Science/Gears/loadinggears/loading-gear.gif" style="position: absolute;left: calc(50vw - 144px);" class="the-loading-img" />
		</div>
	</div>
	<div style="display:none" id="notifications_offset">0</div>
</div>
<div class="addpeoplesearch">
	<div class="search-topbar">
		<div class="back-img" id="back-searchpeople"></div>
		<div class="searchbar-wrapper">
			<div class="search-tool-wrapper">
				<span class="search-tool glyphicon glyphicon-search"></span>
			</div>
			<input class="search" id = "searchpeople" type="text" placeholder="Search..." name="search" autocomplete="off">
		</div>
	</div>
	<div id="search-contentpeople">
		
	</div>
</div>
<div class="message-content">
	<div class="add-people-tip">Add People</div>
	<div class="add-people" id="add-people">
		<div class="add-people-plus glyphicon glyphicon-plus"></div>
	</div>
	<div class="users-searchbox">
		<span class="usersearch-tool glyphicon glyphicon-search"></span>
		<input class = "search-users" id = "search-users" placeholder = "Lookup!" />
	</div>
	<div id = "users">

	</div>
	<div class="messages-wrapper">
		<div class="top-message-wrapper">
			<span class="glyphicon glyphicon-arrow-left arrow-back"></span>
			<div class="messenger-info">
				<div id="messenger-pic"></div>
				<span id="messenger-name"></span>
			</div>
		</div>
		<div id="messages">

		</div>
		<div class="bottom-message-wrapper">
			<input type = 'text' name = 'sendingText' class = 'sendingText' sending-to = '' placeholder = 'Type a Message...' id = 'sendingText' autocomplete="off" ></input>
			<input type = 'text' name = 'msg-id' id = 'msg-id' style = "display: none;" />
		</div>
	</div>
</div>

<div class="home-sidebody">
	<div class="banner-sidebody">
		<div class="profilepic-sidebody"></div>
		<div class="info-sidebody">
			<div class="name-sidebody"><?php echo $firstname ." ". $lastname; ?></div>
			<div class="username-sidebody">@<?php echo $username; ?></div>
		</div>
	</div>
	<a href="profile.php?u=<?php echo $username; ?>"><div class="sidebody-profiletab sidebody-tab">Profile</div></a>
	<div class="sidebody-feedbacktab sidebody-tab">Feedback</div>
	<div class="sidebody-faqtab sidebody-tab">FAQ</div>
	<a href="logout.php"><div class="sidebody-logouttab sidebody-tab">Logout</div></a>
</div>
</div>
<div class="like-bearpic" style="position: fixed;height: 209px;width: 200px;top: calc(50vh - 100px);left: calc(50vw - 100px);background: url(http://web1.nbed.nb.ca/sites/ASD-S/1929/PublishingImages/BEAR%20PAW.gif);z-index: 20;background-size:cover;background-repeat:no-repeat;"></div>

<div class="search-body">
	<div class="search-topbar">
		<div class="back-img" id="back-search"></div>
		<div class="searchbar-wrapper">
			<div class="search-tool-wrapper">
				<span class="search-tool glyphicon glyphicon-search"></span>
			</div>
			<input class="search" id = "search" type="text" placeholder="Search..." name="search" autocomplete="off">
		</div>
	</div>
	<div id="search-content">
		
	</div>
</div>
<div id="fullscreen-img-wrapper">
	
</div>
<script type="text/javascript">

	$("#fullscreen-img-wrapper").hide();

	$(".feedbackhome").hide();
	$(".sidebody-feedbacktab").click(function(){
		$(".feedbackhome").show();
	});
	$("#back-feedback").click(function(){
		$(".feedbackhome").hide();
	});
	$(function() {
		var current_scrolltop = $('.body-content').scrollTop();
		$('.body-content').scroll(function(){


			if ($('.body-content').scrollTop() >= current_scrolltop && $('.body-content').scrollTop() >= 110) {
				$(".options-tabs").hide(200);
				setTimeout(
					function() 
					{
						$(".top-bar").hide();
					}, 80);
			}
			else {
				$(".options-tabs").show();
				$(".top-bar").show();
			}
			current_scrolltop = $('.body-content').scrollTop();
			
		});
	});
	$(function() {
		var current_scrolltop = $('.crush-content').scrollTop();
		$('.crush-content').scroll(function(){


			if ($('.crush-content').scrollTop() >= current_scrolltop && $('.crush-content').scrollTop() >= 110) {
				$(".options-tabs").hide(100);
				setTimeout(
					function() 
					{
						$(".top-bar").hide();
					}, 80);
			}
			else {
				$(".options-tabs").show();
				$(".top-bar").show();
			}
			current_scrolltop = $('.crush-content').scrollTop();
			
		});
	});
	/*
	$(function() {
		var current_scrolltop = $('.body-content').scrollTop();
		var top_content_full_height = $("#top-content").height();
		var top_content_scroll = $("#top-content").scrollTop();
		$('.body-content').scroll(function(){
			//alert(top_content_scroll);
			if ($('.body-content').scrollTop() >= current_scrolltop) {
				top_content_scroll += $('.body-content').scrollTop() - current_scrolltop;
				top_content_scroll  = Math.min(top_content_full_height,top_content_scroll);
			} else {
				top_content_scroll -= current_scrolltop - $('.body-content').scrollTop();
				top_content_scroll  = Math.max(0,top_content_scroll);
			}
			alert(top_content_scroll);
			$("#top-content").scrollTop(top_content_scroll);
			current_scrolltop = $('.body-content').scrollTop();
		});
	});
	*/
	$(".reported").hide();
	$(".text-tab-crush").click(function(){
		$("#crushtype").load("postmethods/textcrush.php");
		$(".crushoptions-cover").css("top", "45px");
	});
	$(".photo-tab-crush").click(function(){
		$("#crushtype").load("postmethods/photocrush.php");
		$(".crushoptions-cover").css("top", "-15px");
	});
	$(".text-tab-post").click(function(){
		$("#posttype").load("postmethods/textpost.php");
		$(".postoptions-cover").css("top", "45px");
	});
	$(".photo-tab-post").click(function(){
		$("#posttype").load("postmethods/photopost.php");
		$(".postoptions-cover").css("top", "-15px");
	});
	$(".video-tab-post").click(function(){
		$("#posttype").load("postmethods/videopost.php");
		$(".postoptions-cover").css("top", "-15px");
	});
	$(".search-body").hide();
	$("#search-btn").click(function(){
		$(".search-body").show();
		$("#search").focus();
	});
	$("#back-search").click(function(){
		$(".search-body").hide();
	});
	
	$("#search").keydown(function(e){
		if (e.keyCode == 13) {
			var searchStr = $(this).val();
			var usersurl = "action/searchusers.php";
			var postsurl = "action/searchposts.php";
			$.get(usersurl, {search:searchStr},
				function(result){
					$("#search-content").html(result);
					$('.search-layer').click(function(){
						var username = $(this).attr('user');
						window.location.href = 'profile.php?u='+username;
					});
					$.get(postsurl, {search:searchStr},
						function(posts){
							$("#search-content").append(posts);
						}
					);
				}
			);
		}
	});

	$("#back-searchpeople").click(function(){
		$(".addpeoplesearch").hide();
	});
	$("#searchpeople").keydown(function(e){
		if (e.keyCode == 13) {
			var searchStr = $(this).val();
			var usersurl = "action/searchusers.php";
			$.get(usersurl, {search:searchStr},
				function(result){
					$("#search-contentpeople").html(result);
					$('.search-layer').click(function(){
						var username = $(this).attr('user');
						var addurl = "action/addpeople.php?u="+username;
						$.ajax({url: addurl, 
							success: function(){
								alert("success: action/addpeople.php?u="+username);
								window.location.replace("home.php?tab=m");
							},
							error: function(){
								alert("error");
							}
						});
					});
					$.get(postsurl, {search:searchStr},
						function(posts){
							$("#search-contentpeople").append(posts);
						}
					);
				}
			);
		}
	});
	$(".posthome").hide();
	$(".postcrush").hide();
	$(".addpeoplesearch").hide();
	$("#add-people").click(function(){
		$(".addpeoplesearch").slideDown(700);
	});
	$("#add-post").click(function(){
		$(".posthome").slideDown(700);
	});
	$("#back-post").click(function(){
		$(".posthome").slideUp(700);
	});
	$("#add-crush").click(function(){
		$(".postcrush").slideDown(700);
	});
	$("#back-crush").click(function(){
		$(".postcrush").slideUp(700);
	});

	$(".body-content").hide();
	$(".crush-content").hide();
	$(".notifications-content").hide();
	$(".message-content").hide();
	$(".body-content").show();
	$(".like-bearpic").hide();
	$(".home-sidebody").hide();

	var myElement = document.getElementById('element');

	// create a simple instance
	// by default, it only adds horizontal recognizers
	var mc = new Hammer(myElement);
	mc.get('swipe').set({ velocity: 0.60});
	var scrollTopHome =  0;
	var scrollTopCrush = 0;
	var scrollTopNotice = 0;
	var scrollTopMessage = 0;

	// listen to events...
	mc.on("swipeleft", function(ev) {
		var homedisplay = $(".body-content").css("display");
		var crushdisplay = $(".crush-content").css("display");
		var notificationsdisplay = $(".notifications-content").css("display");
		var messagedisplay = $(".message-content").css("display");

		if(homedisplay != "none"){
			$(".home-img").css("background-image", "url(img/home-grey.png)");
			$(".crush-img").css("background-image", "url(img/anonymous-logo-blue.png");
			$(".notifications-img").css("background-image", "url(img/notification-bell-grey.png)");
			$(".messages-img").css("background-image", "url(img/message-grey.png)");

			$(".body-content").hide();
			$(".crush-content").show();

		}
		else if(crushdisplay != "none"){
			$(".home-img").css("background-image", "url(img/home-grey.png)");
			$(".crush-img").css("background-image", "url(img/anonymous-logo-white.png");
			$(".notifications-img").css("background-image", "url(img/notification-bell-blue.png)");
			$(".messages-img").css("background-image", "url(img/message-grey.png)");

			$(".crush-content").hide();
			$(".notifications-content").show();
		}
		else if(notificationsdisplay != "none"){
			$(".home-img").css("background-image", "url(img/home-grey.png)");
			$(".crush-img").css("background-image", "url(img/anonymous-logo-white.png");
			$(".notifications-img").css("background-image", "url(img/notification-bell-grey.png)");
			$(".messages-img").css("background-image", "url(img/message-blue.png)");

			$(".notifications-content").hide();
			$(".message-content").show();
		}
	});

	mc.on("swiperight", function(ev) {
		var homedisplay = $(".body-content").css("display");
		var crushdisplay = $(".crush-content").css("display");
		var notificationsdisplay = $(".notifications-content").css("display");
		var messagedisplay = $(".message-content").css("display");

		if(messagedisplay != "none"){
			$(".home-img").css("background-image", "url(img/home-grey.png)");
			$(".crush-img").css("background-image", "url(img/anonymous-logo-white.png");
			$(".notifications-img").css("background-image", "url(img/notification-bell-blue.png)");
			$(".messages-img").css("background-image", "url(img/message-grey.png)");

			$(".message-content").hide();
			$(".notifications-content").show();
		}
		else if(notificationsdisplay != "none"){
			$(".home-img").css("background-image", "url(img/home-grey.png)");
			$(".crush-img").css("background-image", "url(img/anonymous-logo-blue.png");
			$(".notifications-img").css("background-image", "url(img/notification-bell-grey.png)");
			$(".messages-img").css("background-image", "url(img/message-grey.png)");

			$(".notifications-content").hide();
			$(".crush-content").show();
		}
		else if(crushdisplay != "none"){
			$(".home-img").css("background-image", "url(img/home-blue.png)");
			$(".crush-img").css("background-image", "url(img/anonymous-logo-white.png");
			$(".notifications-img").css("background-image", "url(img/notification-bell-grey.png)");
			$(".messages-img").css("background-image", "url(img/message-grey.png)");

			$(".crush-content").hide();
			$(".body-content").show();
		}
	});

	$(".homepic-searchbar").click(function(){
		$(".home-sidebody").show("slide", { direction: "left" }, 500);
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

		$(".body-content").bind('scroll', function() {
			var offset = $("#end").offset().top;
			if ($(".body-content").height() >= offset - 400) {
				load_more_post();
				$("#loading-img").show();
			}
		});
	});
	function sensitizeNotifications(){
        $(".notification-post").click(function(){
            var id = $(this).attr("postid");
            
            var url = "action/bringfullscreenpost.php?id="+id;
            $.ajax({url: url, success: function(result){
            	
                $("#fullscreen-img-wrapper").show("slide", { direction: "left" }, 200);
                $("#fullscreen-img-wrapper").html(result);
                $("#close-fullscreen").click(function(){
                    $("#fullscreen-img-wrapper").html("");
                });
                $(".post-comment").submit(function(e){
                    e.preventDefault();
                    var curr_position = $(this).closest(".post-comment");
                    postcomment(curr_position);
                    e.unbind();
                });     
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(textStatus);
            }});
        });
	}
	var all_notifications_loaded = false;
	var loading_currently_notifications = false;
	function load_more_notifications() {
		if (!all_notifications_loaded && !loading_currently_notifications)  {
			loading_currently_notifications = true;
			offset = Number($("#notifications_offset").text());
			posturl = "action/bringnotifications.php?o="+offset;
			$.ajax({url: posturl, success: function(result){
				$("#notificationscontent").before(result);
				$("#notifications_offset").text(20+offset);
				loading_currently_notifications = false;
				
				if ($("#last_notification").length > 0) {
					all_notifications_loaded = true;
				}
				sensitizeNotifications();
			}});
		}
	}
	$(function() {
		$("#loading-img-notifications").hide();
		load_more_notifications();
		$("#loading-img-notifications").show();
		//alert('end reached');

		$(".notifications-content").bind('scroll', function() {
			var offset = $("#endnotifications").offset().top;
			if ($(".notifications-content").height() >= offset - 400) {

				load_more_notifications();
				$("#loading-img-notifications").show();
			}
		});
	});
	var all_crush_loaded = false;
	var loading_currently_crush = false;
	function load_more_crush() {
		if (!all_crush_loaded && !loading_currently_crush)  {
			loading_currently_crush = true;
			offset = Number($("#crush_offset").text());
			posturl = "action/bringcrush.php?o="+offset;
			$.ajax({url: posturl, success: function(result){
				$("#crushcontent").before(result);
				$("#crush_offset").text(20+offset);
				loading_currently_crush = false;
				if(Number($("#crush_offset").text()) == 20){
					load_more_crush();
				}
				if ($("#last_crush").length > 0) {
					all_crush_loaded = true;
				}
			}});
		}
	}
	$(function() {
		$("#loading-img-crush").hide();
		load_more_crush();
		$("#loading-img-crush").show();
		//alert('end reached');

		$(".crush-content").bind('scroll', function() {
			var crushoffset = $("#endcrush").offset().top;
			//alert(crushoffset);
			//alert($(".crush-content").height());
			if ($(".crush-content").height() >= crushoffset - 400) {
				load_more_crush();
				$("#loading-img-crush").show();
			}
		});
	});	


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

	$(".home-tab").click(function(){
		$(".home-img").css("background-image", "url(img/home-blue.png)");
		$(".crush-img").css("background-image", "url(img/anonymous-logo-white.png");
		$(".notifications-img").css("background-image", "url(img/notification-bell-grey.png)");
		$(".messages-img").css("background-image", "url(img/message-grey.png)");

		var homedisplay = $(".body-content").css("display");
		var crushdisplay = $(".crush-content").css("display");
		var notificationsdisplay = $(".notifications-content").css("display");
		var messagedisplay = $(".message-content").css("display");

		if(homedisplay != "none"){
			
		}
		else if(crushdisplay != "none"){
			$(".body-content").show();
			$(".crush-content").hide();
		}
		else if(notificationsdisplay != "none"){
			$(".body-content").show();
			$(".notifications-content").hide();
		}
		else if(messagedisplay != "none"){
			$(".body-content").show();
			$(".message-content").hide();
		}
	});

	$(".crush-tab").click(function(){
		$(".home-img").css("background-image", "url(img/home-grey.png)");
		$(".crush-img").css("background-image", "url(img/anonymous-logo-blue.png");
		$(".notifications-img").css("background-image", "url(img/notification-bell-grey.png)");
		$(".messages-img").css("background-image", "url(img/message-grey.png)");

		var homedisplay = $(".body-content").css("display");
		var crushdisplay = $(".crush-content").css("display");
		var notificationsdisplay = $(".notifications-content").css("display");
		var messagedisplay = $(".message-content").css("display");

		if(homedisplay != "none"){
			$(".crush-content").show();
			$(".body-content").hide();
		}
		else if(crushdisplay != "none"){
			
		}
		else if(notificationsdisplay != "none"){
			$(".crush-content").show();
			$(".notifications-content").hide();
		}
		else if(messagedisplay != "none"){
			$(".crush-content").show();
			$(".message-content").hide();
		}
	});

	$(".notifications-tab").click(function(){
		$(".home-img").css("background-image", "url(img/home-grey.png)");
		$(".crush-img").css("background-image", "url(img/anonymous-logo-white.png");
		$(".notifications-img").css("background-image", "url(img/notification-bell-blue.png)");
		$(".messages-img").css("background-image", "url(img/message-grey.png)");

		var homedisplay = $(".body-content").css("display");
		var crushdisplay = $(".crush-content").css("display");
		var notificationsdisplay = $(".notifications-content").css("display");
		var messagedisplay = $(".message-content").css("display");

		if(homedisplay != "none"){
			$(".notifications-content").show();
			$(".body-content").hide();
		}
		else if(crushdisplay != "none"){
			$(".notifications-content").show();
			$(".crush-content").hide();
		}
		else if(notificationsdisplay != "none"){
			
		}
		else if(messagedisplay != "none"){
			$(".notifications-content").show();
			$(".message-content").hide();
		}
	});

	$(".messages-tab").click(function(){
		$(".home-img").css("background-image", "url(img/home-grey.png)");
		$(".crush-img").css("background-image", "url(img/anonymous-logo-white.png");
		$(".notifications-img").css("background-image", "url(img/notification-bell-grey.png)");
		$(".messages-img").css("background-image", "url(img/message-blue.png)");

		var homedisplay = $(".body-content").css("display");
		var crushdisplay = $(".crush-content").css("display");
		var notificationsdisplay = $(".notifications-content").css("display");
		var messagedisplay = $(".message-content").css("display");

		if(homedisplay != "none"){
			$(".message-content").show();
			$(".body-content").hide();
		}
		else if(crushdisplay != "none"){
			$(".message-content").show();
			$(".crush-content").hide();
		}
		else if(notificationsdisplay != "none"){
			$(".message-content").show();
			$(".notifications-content").hide();
		}
		else if(messagedisplay != "none"){
			
		}
	});


	function likePost(id) {
		var addurl = "action/likepost.php?id="+id;
		var postid = "#like-btn-"+id;
		$.ajax({url: addurl, 
			success: function(){
				$(postid).attr('class', 'liked');
				$(postid).attr('onclick', 'unlikePost(' + id + ')');
				$(".like-bearpic").show();
				if (!$(".like-bearpic").is(':animated')) {
					$(".like-bearpic").effect("shake", 3000);
				}
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

<?php
if (isset($_GET['tab'])) {
	if ($_GET['tab']=='m') {
?>
$(function() {
	$(".messages-tab").trigger("click");
})   
<?php
	}else if($_GET['tab']=='c'){

?>
$(function() {
	$(".crush-tab").trigger("click");
})  
<?php
	}
}
?>
</script>
</body>
</html>