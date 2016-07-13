<?php include "../system/connect.php"; ?>
<?php 
session_start();
if (isset($_SESSION['user_login'])) {
	$username = $_SESSION['user_login'];
}
else{
	$username = "";
}


?>
<?php
if (isset($_POST['sendmsg'])) {

	$msg = $_POST['sendmsg'];
	$sendto = $_POST['sendto'];

	$getSender = $conn->query("SELECT * FROM users WHERE username = '$username'");
	$get = $getSender->fetch_assoc();
	
	$id = $get['id'];
	
	$getUser = $conn->query("INSERT INTO messages VALUES('', '$id', '$sendto', '$msg')");
}
?>