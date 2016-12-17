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
		$sql = "SELECT * FROM posts WHERE id = '$id'";
		$query = $conn->query($sql);
		$get = $query->fetch_assoc();

		$added_by = $get['added_by'];

		$sql = "SELECT * FROM users WHERE username = '$added_by'";
		$query = $conn->query($sql);
		$get = $query->fetch_assoc();

		$warned_times = $get['warned_times'];

		$warned_times_now = $warned_times + 1;

		$report = "SELECT * FROM report WHERE post_id = '$id' ORDER BY id ASC LIMIT 1";
		$reported = $conn->query($sql);

		$get = $reported->fetch_assoc();

		$reportedfor = $get['about'];


		$sql = "UPDATE users SET warned='1', warned_by='$username', warned_times='$warned_times_now', warned_post = '$id' warned_for='$reportedfor' WHERE username='$added_by'";
		$delete = $conn->query($sql);

		$sql = "DELETE FROM `report` WHERE post_id='$id'";
		$delete = $conn->query($sql);
	}

	//echo "<script>location.assign('profile.php?u=$goto#profilePosts')</script>";
}
?>