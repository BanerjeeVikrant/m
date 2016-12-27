<?php 
require "../system/connect.php"; 

session_start();
if (isset($_SESSION['user_login'])) {
	$username = $_SESSION['user_login'];
	$query = $conn->query("SELECT * FROM users WHERE username='$username'");
	$row = $query->fetch_assoc();
	$usernameid = $row['id'];
}
else{
	$username = "";
}

if (isset($_GET['addto'])) {
	$addto = $_GET['addto'];
	$query = $conn->query("SELECT * FROM users WHERE username='$addto'");
	$row = $query->fetch_assoc();
	$addtoid = $row['id'];
}

$check = $conn->query("SELECT * FROM users WHERE username='$username'");
if ($check->num_rows == 1) {

	$get = $check->fetch_assoc();

	$fromId = $get['id'];
	$following = $get['following'];

}
$check = $conn->query("SELECT * FROM users WHERE username='$addto'");
if ($check->num_rows == 1) {

	$get = $check->fetch_assoc();

	$toId = $get['id'];
	$followers = $get['followers'];

}


if($following == "" || $following == NULL){
	$sqlcommand = $conn->query("UPDATE users SET following='$addtoid' WHERE username='$username'");
}
else{
	$addedList = $following . "," . $addtoid;
	$sqlcommand = $conn->query("UPDATE users SET following='$addedList' WHERE username='$username'");
}

if($followers == "" || $followers == NULL){
	$sqlcommand = $conn->query("UPDATE users SET followers='$usernameid' WHERE username='$addto'");
}
else{
	$addedList = $followers . "," . $usernameid;
	$sqlcommand = $conn->query("UPDATE users SET followers='$addedList' WHERE username='$addto'");
}
date_default_timezone_set("America/Los_Angeles");
$date_added = date("Y/m/d");
$time_added = time(); 

$check = $conn->query("SELECT * FROM notifications WHERE (toUser='$addtoid' AND fromUser='$usernameid')");
if ($check->num_rows == 0) {
	$query = $conn->query("INSERT INTO notifications VALUES ('', '1', '$usernameid', '$addtoid', '', '', '$time_added', '$date_added')");
}

?>