<?php
include "connect.php";

// Create connection
$conn = new mysqli($servername, $username1, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
include "../system/helpers.php";

$username = $_POST['u'];
$password = $_POST['password'];

$password_md5 = md5($password);

$sql = "UPDATE users SET password='$password_md5' WHERE username='$username'";
$query = $conn->query($sql);

$response["success"] = true;  
echo json_encode($response);
?>