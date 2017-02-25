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

$offset_id = $_POST['o'];
$me = $_POST['me'];
$friend = $_POST['friend'];

$findMeId = $conn->query("SELECT * FROM users WHERE username='$me'");
$findMeId_get = $findMeId->fetch_assoc();
$meId = $findMeId_get['id'];

$findFriendId = $conn->query("SELECT * FROM users WHERE username='$friend'");
$findFriendId_get = $findFriendId->fetch_assoc();
$friendId = $findFriendId_get['id'];
$userpic = "http://www.bruincave.com/m/" . $findFriendId_get['profile_pic'];

$results = $conn->query("SELECT * FROM messages WHERE ((fromUser='$friendId' AND toUser='$meId') OR (fromUser='$meId' AND toUser='$friendId')) AND (id > '$offset_id') ORDER BY id ASC LIMIT 1000");

$n = 0;
echo '
{
    "messages": [';
for($i=0; $i<$results->num_rows; $i++) {
    $side = -1;

    $row = $results->fetch_assoc();
    $message = $row['message'];
    $fromUser = $row['fromUser'];
    $toUser = $row['toUser'];

    
    if($fromUser == $friendId){
        $side = 1;
    }
    else{
        $side = 0;
    }
    



    if($n == 0){
        echo '
            {
                "message":"'.$message.'",
                "side":"'.$side.'",
                "userpic":"'.$userpic.'"
            }
        ';
        $n++;
    } else {
        echo '
            ,{
                "message":"'.$message.'",
                "side":"'.$side.'",
                "userpic":"'.$userpic.'"
            }
        ';
    }
}
echo "
    ]}
";  





?>