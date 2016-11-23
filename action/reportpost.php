<?php include "../system/connect.php"; ?>
<?php 
session_start();
if (isset($_SESSION['user_login'])) {
	$username = $_SESSION['user_login'];
}
else{
	$username = "";
}

$id = $_GET['pid'];
$about = $_GET['about'];


$pushReport = $conn->query("INSERT INTO report VALUES('', '$id', '$username', '$about')");

?>