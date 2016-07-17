<?php

require "../system/connect.php"; 

session_start();
if (isset($_SESSION['user_login'])) {
	$username = $_SESSION['user_login'];
}
else{
	$username = "";
}

$check = $conn->query("SELECT * FROM users WHERE username='$username'");
if ($check->num_rows == 1) {
	$get = $check->fetch_assoc();
	$following = $get['following'];
}

if (isset($_GET['rem'])) {
	$remove = $_GET['rem'];
}


$followingArray = explode(",",$following);
$followingArrayCount = count($followingArray);
$followingArrayNow = []; 
$j = 0;

for ($i=0; $i < $followingArrayCount; $i++) {
	if ($followingArray[$i] != $remove) {
		$followingArrayNow[$j++] = $followingArray[$i];
	}
}
$followingNow = join(',',$followingArrayNow);


$sql = "UPDATE users SET following='$followingNow' WHERE username='$username'";

$removeFollowingQuery = $conn->query($sql);

/*-----------------*/
$check = $conn->query("SELECT * FROM users WHERE username='$remove'");
if ($check->num_rows == 1) {
	$get = $check->fetch_assoc();
	$followers = $get['followers'];
}

$followersArray = explode(",",$followers);
$followersArrayCount = count($followersArray);
$followersArrayNow = []; 
$j = 0;
for ($i=0; $i < $followersArrayCount; $i++) {
	if ($followersArray[$i] != $username) {
		$followersArrayNow[$j++] = $followersArray[$i];
	}
}
$followersNow = join(',',$followersArrayNow);


$sql = "UPDATE users SET followers='$followersNow' WHERE username='$remove'";

$removeFollowersQuery = $conn->query($sql);
?>