<?php 
require "../system/connect.php"; 

session_start();
if (isset($_SESSION['user_login'])) {
	$username = $_SESSION['user_login'];
}
else{
	$username = "";
}

if (isset($_GET['u'])) {
	$u = $_GET['u'];
}

$sql = "SELECT * FROM users WHERE username='$username'";
$check = $conn->query($sql);
if ($check->num_rows == 1) {

	$get = $check->fetch_assoc();
	$fromId = $get['id'];
	$dmfriends = $get['dmfriends'];

}
$check = $conn->query("SELECT * FROM users WHERE username='$u'");
if ($check->num_rows == 1) {

	$get = $check->fetch_assoc();

	$toId = $get['id'];
	$dmfriends2 = $get['dmfriends'];

}
$already_friend = false;
$dmfriends_explode = explode(",", $dmfriends);
foreach ($dmfriends_explode as $value) {
	if (strcasecmp($value, $u) == 0) {
		$already_friend = true; 
	}
}
$already_friend2 = false;
$dmfriends2_explode = explode(",", $dmfriends2);
foreach ($dmfriends2_explode as $value) {
	if (strcasecmp($value, $username) == 0) {
		$already_friend2 = true; 
	}
}
if($already_friend == false){
	if($dmfriends == "" || $dmfriends == NULL){
		$sqlcommand = $conn->query("UPDATE users SET dmfriends='$u' WHERE username='$username'");
	}
	else{
		if($already_friend == false){
			$addedList = $u . "," .  $dmfriends;
			$sqlcommand = $conn->query("UPDATE users SET dmfriends='$addedList' WHERE username='$username'");
		}
	}
}
if($already_friend2 == false){
	if($dmfriends2 == "" || $dmfriends2 == NULL){
		$sqlcommand = $conn->query("UPDATE users SET dmfriends='$username' WHERE username='$u'");
	}
	else{
		if($already_friend == false){
			$addedList = $username . "," .  $dmfriends2;
			$sqlcommand = $conn->query("UPDATE users SET dmfriends='$addedList' WHERE username='$u'");
		}
	}
}