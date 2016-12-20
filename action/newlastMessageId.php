<?php include "../system/connect.php"; 

ini_set('session.cookie_lifetime', 60 * 60 * 24 * 7);
session_start();
$username = $_SESSION['user_login'];


$check = $conn->query("SELECT * FROM users WHERE username='$username'");
if ($check->num_rows == 1) {

	$get = $check->fetch_assoc();

	$id = $get['id'];

}

$check = $conn->query("SELECT id FROM messages WHERE toUser = '$id' OR fromUser = '$id' ORDER BY id DESC LIMIT 1");
if ($check->num_rows == 1) {

	$get = $check->fetch_assoc();
	$lastMessageId = $get['id'];

}
echo $lastMessageId;
?>