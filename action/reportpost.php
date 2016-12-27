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

$id = $_GET['pid'];
$about = $_GET['about'];


$pushReport = $conn->query("INSERT INTO report VALUES('', '$id', '$usernameid', '$about')");

?>