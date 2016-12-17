<?php
include "../system/connect.php";

session_start();
if (isset($_SESSION['user_login'])) {
	$username = $_SESSION['user_login'];
}
else{
	$username = "";
}


if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "SELECT * FROM posts WHERE id='$id'";
	$get = $conn->query($sql);
	$backto = $get->fetch_assoc();
	$goto =  $backto['user_posted_to'];
	$sql = "SELECT * FROM users WHERE username='$username'";
	$get = $conn->query($sql);
	$backto = $get->fetch_assoc();
	$adminornot = $backto['admin'];
	
	if($adminornot == '1'){
		$admin = true;
	}
	else{
		$admin = false;
	}
	
	
	if($admin){
		$sql = "DELETE FROM `report` WHERE post_id='$id'";
		$delete = $conn->query($sql);
	}

	//echo "<script>location.assign('profile.php?u=$goto#profilePosts')</script>";
}
?>