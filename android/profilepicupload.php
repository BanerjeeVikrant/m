<?php
include "connect.php";

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

	$upload_folder = "../userdata/pictures/$usernameid";
	if (!file_exists("../userdata/pictures/$usernameid")){
		mkdir("../userdata/pictures/$usernameid");
		mkdir("../userdata/pictures/$usernameid/thumbnail");
	}
	$path = "../userdata/pictures/$usernameid/$id.jpg";
	$thumb_filename = "../userdata/pictures/$usernameid/thumbnail/$id.jpg";
	$image = $_POST['image'];

	$ext='jpeg';
    $data = base64_decode( $image );
	file_put_contents($path, $data);
	
	$sql = "UPDATE users SET profile_pic='userdata/pictures/$usernameid/$id.jpg' WHERE username='$username'";
/*
	$original_info = getimagesize($data);
	$original_w = $original_info[0];
	$original_h = $original_info[1];
	$original_img = imagecreatefromjpg($data);
	$thumb_w = 50;
	$thumb_h = 50;
	$thumb_img = imagecreatetruecolor($thumb_w, $thumb_h);
	imagecopyresampled($thumb_img, $original_img,
	                   0, 0,
	                   0, 0,
	                   $thumb_w, $thumb_h,
	                   $original_w, $original_h);
	imagejpeg($thumb_img, $thumb_filename);
	imagedestroy($thumb_img);
	imagedestroy($original_img);
*/
	if ($conn->query($sql) === TRUE) {
		$response["success"] = true;  
		echo json_encode($response);
	}else{
		$response["success"] = false;  
		echo json_encode($response);
	}

}else{
	echo "image_not_in";
	exit;
}

?>