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

	$source_image = $data;
	$src_w= imagesx($source_image);
	$src_h= imagesy($source_image);
	$dest_image = imagecreatetruecolor(100, 100); //targeted width and height

	imagecopyresampled($dest_image, $source_image, 0, 0, 0, 0, 100, 100, $source_w, $source_h);
	imagejpeg($dest_image,$thumb_filename,80); 

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