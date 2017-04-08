<?php
$servername = "localhost";
$username1 = "root";
$password = "H@ll054321";
$dbname = "bruincaveData";

// Create connection
$conn = new mysqli($servername, $username1, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$username = $_POST['u'];
$results = $conn->query("SELECT * FROM users WHERE username='$username'");
$rowget = $results->fetch_assoc();
$usernameid = $rowget['id'];
$usernamegrade = $rowget['grade'];

$post = $_POST['caption'];

if(isset($_POST['image'])){
	$now = DateTime::createFromFormat('U.u', microtime(true));
	$id = $now->format('YmdHisu');
	date_default_timezone_set("America/Los_Angeles");
	$date_added = date("Y/m/d");
	$added_by = $username;
	$time_added = time();

	$upload_folder = "../userdata/pictures/$username";
	if (!file_exists("../userdata/pictures/$username")){
		mkdir("../userdata/pictures/$username");
		mkdir("../userdata/pictures/$username/thumbnail");
	}
	$path = "$upload_folder/$id.jpg";
	$image = $_POST['image'];
	if(file_put_contents($path, base64_decode($image)) != false){
		$sql = "INSERT INTO posts VALUES ('', '$post', '$date_added', '$time_added', '$usernameid', '0', '', '', '', 'userdata/pictures/$username/$id', '', '$usernamegrade', '0', '', '', '0')";
		$response["success"] = true;  
			echo json_encode($response);

		if ($conn->query($sql) === TRUE) {
			

		}else{
			echo "didnt work";
		}
	}else{
		$response["success"] = file_put_contents($path, base64_decode($image));
		echo json_encode($response);
	}
}else{
	echo "image_not_in";
	exit;
}
?>