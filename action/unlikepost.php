<?php

require "../system/connect.php"; 

session_start();
if (isset($_SESSION['user_login'])) {
	$username = $_SESSION['user_login'];
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
	$likedby = $get['liked_by'];
}


$likedbyArray = explode(",",$likedby);
$likedbyArrayCount = count($likedbyArray);
$likedbyArrayNow = []; 
$j = 0;
for ($i=0; $i < $likedbyArrayCount; $i++) {
	if ($likedbyArray[$i] != $username) {
		$likedbyArrayNow[$j++] = $likedbyArray[$i];
	}
}
$likedbyNow = join(',',$likedbyArrayNow);


$sql = "UPDATE posts SET liked_by='$likedbyNow' WHERE id='$id'";

$removeLikeQuery = $conn->query($sql);

?>