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
include "../system/helpers.php";


$username = $_POST['u'];

$query = $conn->query("SELECT * FROM users WHERE username='$username'");
$row = $query->fetch_assoc();
$usernameid = $row['id'];


$check = $conn->query("SELECT * FROM users WHERE username='$username'");
if ($check->num_rows == 1) {
    $get = $check->fetch_assoc();
    $following = $get['following'];
}


$remove = $_POST['rem'];

$followingArray = explode(",",$following);
$followingArrayCount = count($followingArray);
$followingArrayNow = []; 
$j = 0;

for ($i=0; $i < $followingArrayCount; $i++) {
    if ($followingArray[$i] != $remove) {
        $followingArrayNow[$j++] = $followingArray[$i];
    }
}
$followingNow = join(',',$followingArrayNow);


$sql = "UPDATE users SET following='$followingNow' WHERE username='$username'";

$removeFollowingQuery = $conn->query($sql);

/*-----------------*/
$check = $conn->query("SELECT * FROM users WHERE id='$remove'");
if ($check->num_rows == 1) {
    $get = $check->fetch_assoc();
    $followers = $get['followers'];
}

$followersArray = explode(",",$followers);
$followersArrayCount = count($followersArray);
$followersArrayNow = []; 
$j = 0;
for ($i=0; $i < $followersArrayCount; $i++) {
    if ($followersArray[$i] != $usernameid) {
        $followersArrayNow[$j++] = $followersArray[$i];
    }
}
$followersNow = join(',',$followersArrayNow);


$sql = "UPDATE users SET followers='$followersNow' WHERE id='$remove'";

$removeFollowersQuery = $conn->query($sql);

$response["success"] = true; 
echo json_encode($response);

?>