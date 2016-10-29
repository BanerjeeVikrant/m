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

	$getSender = $conn->query("SELECT * FROM users WHERE id = '$sendto'");
	$get = $getSender->fetch_assoc();
	$sendingto = $get['username'];
	$dmfriends2 = $get['dmfriends'];

	$getSender = $conn->query("SELECT * FROM users WHERE username = '$username'");
	$get = $getSender->fetch_assoc();

	$dmfriends = $get['dmfriends'];
	$id = $get['id'];
	
	$getUser = $conn->query("INSERT INTO messages VALUES('', '$id', '$sendto', '$msg')");


	$dmfriendsArray = explode(",",$dmfriends);
	$dmfriendsArrayCount = count($dmfriendsArray);
	$dmfriendsArrayNow = []; 
	$j = 0;

	for ($i=0; $i < $dmfriendsArrayCount; $i++) {
		if (strcasecmp($dmfriendsArray[$i], $sendingto) != 0) {
			$dmfriendsArrayNow[$j++] = $dmfriendsArray[$i];
		}
	}
	$dmfriendsNow = join(',',$dmfriendsArrayNow);
	if($dmfriendsNow == ""){
		$dmfriendsNow1 = $sendingto;
	}
	else{
		$dmfriendsNow1 = $sendingto . "," . $dmfriendsNow;
	}


	$sql = "UPDATE users SET dmfriends='$dmfriendsNow1' WHERE username='$username'";

	$removeFriendsQuery = $conn->query($sql);


	$dmfriends2Array = explode(",",$dmfriends2);
	$dmfriends2ArrayCount = count($dmfriends2Array);
	$dmfriends2ArrayNow = []; 
	$j = 0;

	for ($i=0; $i < $dmfriends2ArrayCount; $i++) {
		if (strcasecmp($dmfriends2Array[$i], $username) != 0) {
			$dmfriends2ArrayNow[$j++] = $dmfriends2Array[$i];
		}
	}
	$dmfriends2Now = join(',',$dmfriends2ArrayNow);
	echo "<h1>$dmfriends2Now</h1>";
	if($dmfriends2Now == ""){
		$dmfriends2Now1 = $username;
	}
	else{
		$dmfriends2Now1 = $username . "," . $dmfriends2Now;
	}

	$sql = "UPDATE users SET dmfriends='$dmfriends2Now1' WHERE username='$sendingto'";

	$removeFriendsQuery = $conn->query($sql);
}
?>