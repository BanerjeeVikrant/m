<?php
$servername = "localhost";
$username1 = "root";
$password = "H@ll054321";
$dbname = "bruincaveData";

function base64_to_jpeg($base64_string, $output_file) {
    $ifp = fopen($output_file, "w"); 

    $data = explode(',', $base64_string);

    fwrite($ifp, base64_decode($data[0])); 
    fclose($ifp); 

    return $output_file; 
}

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
	$path = "../userdata/pictures/$username/$id.jpeg";
	$image = $_POST['image'];

	$imageData = base64_decode($image);
	$source = imagecreatefromstring($imageData);
	$rotate = imagerotate($source, 0, 0); // if want to rotate the image
	$imageSave = imagejpeg($rotate,$path,100);
	
	$sql = "INSERT INTO posts VALUES ('', '$post', '$date_added', '$time_added', '$usernameid', '0', '', '', '', 'userdata/pictures/$username/$id.jpeg', '', '$usernamegrade', '0', '', '', '0')";

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