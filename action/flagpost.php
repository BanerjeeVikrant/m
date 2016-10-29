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

	$id = $_GET['id'];

	$getReport = $conn->query("SELECT * FROM report WHERE post_id = '$id'");
	
	$pushReport = $conn->query("INSERT INTO report VALUES('', '$id', '$username')");

?>