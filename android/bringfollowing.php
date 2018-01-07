<?php 
include "connect.php";

// Create connection
$conn = new mysqli($servername, $username1, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

include "../system/helpers.php";

$username = $_POST['profileUser'];
$str = $_POST['s'];

function startsWith($haystack, $needle){
 $length = strlen($needle);
 return (strcasecmp(substr($haystack, 0, $length),$needle) == 0);
}

$check = $conn->query("SELECT * FROM users WHERE username='$username'");
if ($check->num_rows == 1) {

	$get = $check->fetch_assoc();

	$followings = $get['following'];
	$followers = $get['followers'];

	$followingArray = explode(",", $followings);
	$followersArray = explode(",", $followers);

	$followingCount = count($followingArray);
	$followersCount = count($followersArray);

	if($followings == ""){
		$followingCount = 0;
	}
	if($followers == ""){
		$followersCount = 0;
	}


}
echo '
{
    "following": [';
    $i = 0;
foreach ($followingArray as $value) {
	$sql = "SELECT * FROM users WHERE id='$value'";
	$results = $conn->query($sql);
	$row = $results->fetch_assoc();
	$tusername = $row["username"];
	$tid = $row["id"];
	$tfirstname = $row["first_name"];
	$tlastname = $row["last_name"];
	$tprofilepic = $row["profile_pic"];
	$tlastonline_date = $row["last_online_date"];
	$tlastonline_time = $row["last_online_time"];
	$ttime = time_elapsed_string($tlastonline_time);
	$tsex = $row['sex'];
	if($tprofilepic == "" || $tprofilepic == NULL){
		if($tsex == "1"){
			$tprofilepic = "https://upload.wikimedia.org/wikipedia/commons/3/34/PICA.jpg";
		}
		else{
			$tprofilepic = "http://www4.csudh.edu/Assets/CSUDH-Sites/History/images/Faculty-Profile-Pictures/Faculty%20Female%20Default%20Profile%20Picture.jpg";
		}
	}
	$chat_both_name = $tfirstname . " " . $tlastname;
	if (isset($str)) {
	    if (! (startsWith($tfirstname, $str) || startsWith($tlastname, $str) || startsWith($tusername, $str) || startsWith($chat_both_name, $str) ) ) {
	        continue;
	    }
	}
	if($followingCount != 0){
		if($i == 0){
			echo '
			{
				"id":'.$tid.',
		 		"username":"'.$tusername.'",
				"profilepic":"http://www.bruincave.com/m/'.$tprofilepic.'",
				"name":"'.$tfirstname." ".$tlastname.'",
				"time":"'.$ttime.'"
			}
			';
			$i = $i + 1;
	    } else {
	    	echo '
			,{
				"id":'.$tid.',
		 		"username":"'.$tusername.'",
				"profilepic":"http://www.bruincave.com/m/'.$tprofilepic.'",
				"name":"'.$tfirstname." ".$tlastname.'",
				"time":"'.$ttime.'"
			}
			';
	    }
	}
}
echo "
    ]}
";


?>