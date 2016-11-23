<?php
require "../system/connect.php";

session_start();
if (isset($_SESSION['user_login'])) {
	$username = $_SESSION['user_login'];
}
else{
	$username = "";
}

$lastMessageId = $_GET['l'];

$needToRefreshMessages = false;
$i = 0;

$check = $conn->query("SELECT * FROM users WHERE username='$username'");


	$get = $check->fetch_assoc();

	$id = $get['id'];

	$dmfriends =  $get['dmfriends'];
	$dmfriendsArray = explode(",", $dmfriends);


$getIdQuery = $conn->query("SELECT id FROM messages WHERE toUser = '$id' AND id > $lastMessageId");
$get = $getIdQuery->fetch_assoc();
if($getIdQuery->num_rows > 0){
	$needToRefreshMessages = true;
	$i++;
}
/*
if($needToRefreshMessages == true){
	$needToRefreshMessages = "true";
}*/

echo $needToRefreshMessages ? 'true' : 'false' . "," . $i . "";
?>