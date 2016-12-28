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

if (isset($_GET['id'])) {
	$id = $_GET['id'];
}

$check = $conn->query("SELECT * FROM posts WHERE id='$id'");
if ($check->num_rows == 1) {

	$get = $check->fetch_assoc();

	$added_by = $get['added_by'];

	$query = $conn->query("SELECT * FROM users WHERE id='$added_by'");
	$row = $query->fetch_assoc();
	$added_byid = $row['id'];

	$likedby = $get['liked_by'];

}


if($likedby == "" || $likedby == NULL){
	$sqlcommand = $conn->query("UPDATE posts SET liked_by='$usernameid' WHERE id='$id'");
}
else{
	$addedList = $likedby . "," . $usernameid;
	$sqlcommand = $conn->query("UPDATE posts SET liked_by='$addedList' WHERE id='$id'");
}

date_default_timezone_set("America/Los_Angeles");
$date_added = date("Y/m/d");
$time_added = time(); 

$check = $conn->query("SELECT * FROM notifications WHERE (type='2' AND fromUser='$usernameid' AND toUser='$added_by' AND post_id='$id')");
if ($check->num_rows == 0) {
	$query = $conn->query("INSERT INTO notifications VALUES ('', '2', '$usernameid', '$added_by', '', '$id', '$time_added', '$date_added')");
}

?>