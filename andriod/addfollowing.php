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
$following_row = $row['following'];
$following_array = explode(",", $following_row);
if(in_array($_POST['puser'], $following_array)){
    $type = 1;
}else{
    $type = 0;
}


if($type == 0){
    $addtoid = $_POST['puser'];
    $check = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($check->num_rows == 1) {

        $get = $check->fetch_assoc();

        $fromId = $get['id'];
        $following = $get['following'];

    }
    $check = $conn->query("SELECT * FROM users WHERE id='$addtoid'");
    if ($check->num_rows == 1) {

        $get = $check->fetch_assoc();

        $toId = $get['id'];
        $followers = $get['followers'];

    }


    if($following == "" || $following == NULL){
        $sqlcommand = $conn->query("UPDATE users SET following='$addtoid' WHERE username='$username'");
    }
    else{
        $addedList = $following . "," . $addtoid;
        $sqlcommand = $conn->query("UPDATE users SET following='$addedList' WHERE username='$username'");
    }

    if($followers == "" || $followers == NULL){
        $sqlcommand = $conn->query("UPDATE users SET followers='$usernameid' WHERE id='$addtoid'");
    }
    else{
        $addedList = $followers . "," . $usernameid;
        $sqlcommand = $conn->query("UPDATE users SET followers='$addedList' WHERE id='$addtoid'");
    }
    date_default_timezone_set("America/Los_Angeles");
    $date_added = date("Y/m/d");
    $time_added = time(); 

    $check = $conn->query("SELECT * FROM notifications WHERE (toUser='$addtoid' AND fromUser='$usernameid')");
    if ($check->num_rows == 0) {
        $query = $conn->query("INSERT INTO notifications VALUES ('', '1', '$usernameid', '$addtoid', '', '', '$time_added', '$date_added')");
    }

    $response["success"] = true; 
    echo json_encode($response);
}else{
    $remove = $_POST['puser'];

    $check = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($check->num_rows == 1) {
        $get = $check->fetch_assoc();
        $following = $get['following'];
    }

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

}

?>