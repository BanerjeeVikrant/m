<?php include '../system/connect.php';?>
<?php 
session_start();
if (isset($_SESSION['user_login'])) {
    $username = $_SESSION['user_login'];
}
else{
    $username = "";
}


?>
