<?php include "../system/connect.php"; ?>
<?php 
session_start();
if (isset($_SESSION['user_login'])) {
	$username = $_SESSION['user_login'];
	$query = $conn->query("SELECT * FROM users WHERE username='$username'");
	$row = $query->fetch_assoc();
	$usernameid = $row['id'];
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
	$sendingtoid = $get['id'];
	$dmfriends2 = $get['dmfriends'];

	$getSender = $conn->query("SELECT * FROM users WHERE username = '$username'");
	$get = $getSender->fetch_assoc();

	$dmfriends = $get['dmfriends'];
	$id = $get['id'];
	$time = time();

	$msg = str_replace("'","&apos;",$msg);
	$msg = str_replace("<","&lt;",$msg);
	$msg = str_replace(">","&gt;",$msg);

	if ($msg) {
		$getUser = $conn->query("INSERT INTO messages VALUES('', '$id', '$sendto', '$msg', '$time')");
	}


	$dmfriendsArray = explode(",",$dmfriends);
	$dmfriendsArrayCount = count($dmfriendsArray);
	$dmfriendsArrayNow = []; 
	$j = 0;

	for ($i=0; $i < $dmfriendsArrayCount; $i++) {
		if (strcasecmp($dmfriendsArray[$i], $sendingtoid) != 0) {
			$dmfriendsArrayNow[$j++] = $dmfriendsArray[$i];
		}
	}
	$dmfriendsNow = join(',',$dmfriendsArrayNow);
	if($dmfriendsNow == ""){
		$dmfriendsNow1 = $sendingtoid;
	}
	else{
		$dmfriendsNow1 = $sendingtoid . "," . $dmfriendsNow;
	}


	$sql = "UPDATE users SET dmfriends='$dmfriendsNow1' WHERE username='$usernameid'";

	$removeFriendsQuery = $conn->query($sql);


	$dmfriends2Array = explode(",",$dmfriends2);
	$dmfriends2ArrayCount = count($dmfriends2Array);
	$dmfriends2ArrayNow = []; 
	$j = 0;

	for ($i=0; $i < $dmfriends2ArrayCount; $i++) {
		$dmfriends2ArrayNow[$j++] = $dmfriends2Array[$i];
	}
	$dmfriends2Now = join(',',$dmfriends2ArrayNow);

	if($dmfriends2Now == ""){
		$dmfriends2Now1 = $usernameid;
	}
	else{
		$dmfriends2Now1 = $usernameid . "," . $dmfriends2Now;
	}

	$sql = "UPDATE users SET dmfriends='$dmfriends2Now1' WHERE username='$sendingtoid'";

	$removeFriendsQuery = $conn->query($sql);
}
?>