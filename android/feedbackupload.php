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

if($_POST['image'] != ""){
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
	$path = "../userdata/pictures/$username/$id.jpg";
	$image = $_POST['image'];

	$ext='jpeg';
    $data = base64_decode( $image );

    file_put_contents($path, $data);
	
	$sql = "INSERT INTO feedback_table VALUES ('', '$usernameid', '$post', 'userdata/pictures/$username/$id.jpg')";

}else{
	$sql = "INSERT INTO feedback_table VALUES ('', '$usernameid', '$post', '')";
}



if ($conn->query($sql) === TRUE) {
	$response["success"] = "true";  
	echo json_encode($response);
}else{
	$response["success"] = $sql;  
	echo json_encode($response);
}

?>