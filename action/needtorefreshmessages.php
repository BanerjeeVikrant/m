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
$selfMessaged = false;
$i = 0;

$check = $conn->query("SELECT * FROM users WHERE username='$username'");


	$get = $check->fetch_assoc();

	$id = $get['id'];

	$dmfriends =  $get['dmfriends'];
	$dmfriendsArray = explode(",", $dmfriends);

/*Adding fromUser = '$id' messing it all up*/

$getIdQuery = $conn->query("SELECT id FROM messages WHERE (fromUser = '$id' OR toUser = '$id') AND id > $lastMessageId");
$get = $getIdQuery->fetch_assoc();
if($getIdQuery->num_rows== 0){
	$needToRefreshMessage = false;
}else{
	$needToRefreshMessages = true;
	$i++;
}

$getIdQuery = $conn->query("SELECT id FROM messages WHERE fromUser = '$id' AND id > $lastMessageId");
$get = $getIdQuery->fetch_assoc();
if($getIdQuery->num_rows== 0){
	$selfMessaged = false;
}
else{
	$selfMessaged = true;
}
/*
if($needToRefreshMessages == true){
	$needToRefreshMessages = "true";
}*/

echo ($needToRefreshMessages ? 'true' : 'false') . "," . $i . ",";
echo $selfMessaged ? 'true' : 'false';
?>