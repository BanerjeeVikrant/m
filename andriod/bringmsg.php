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

$results = $conn->query("SELECT * FROM messages WHERE ((fromUser='$friend' toUser='$me') OR (fromUser='$me' toUser='$friend')) AND (id > '$offset_id') ORDER BY id DESC LIMIT 15");

$n = 0;
for($i=0; $i<$results->num_rows; $i++) {
    $row = $results->fetch_assoc();
    $message = $row['message'];
    $side = -1; //left or right

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





?>