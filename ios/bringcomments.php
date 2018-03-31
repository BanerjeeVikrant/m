<?php 
include "connect.php";

// Create connection
$conn = new mysqli($servername, $username1, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

include "../system/helpers.php";

$username = $_POST['u'];
$postid = $_POST['postid'];

function startsWith($haystack, $needle){
 $length = strlen($needle);
 return (strcasecmp(substr($haystack, 0, $length),$needle) == 0);
}

$check = $conn->query("SELECT * FROM posts WHERE id='$postid'");
if ($check->num_rows == 1) {

	$get = $check->fetch_assoc();

	$comments = $get['commentsid'];

	$commentsArray = explode(",", $comments);

	$commentsCount = count($commentsArray);

	if($comments == ""){
		$commentsCount = 0;
	}
	


}
echo '
{
    "info": [';
    $i = 0;
foreach ($commentsArray as $value) {
	$sql = "SELECT * FROM comments WHERE id='$value'";
	$results = $conn->query($sql);
	$row = $results->fetch_assoc();
	$userid = $row["from"];
	$comment = $row["comment"];
	$sql = "SELECT * FROM users WHERE id='$userid'";
	$results = $conn->query($sql);
	$row = $results->fetch_assoc();
	$tid = $row["id"];
	$tfirstname = $row["first_name"];
	$tlastname = $row["last_name"];
	$tprofilepic = $row["profile_pic"];
	if($commentsCount != 0){
		if($i == 0){
			echo '
			{
				"id":'.$tid.',
				"image":"http://www.bruincave.com/m/'.$tprofilepic.'",
				"name":"'.$tfirstname." ".$tlastname.'",
				"comment":"'.$comment.'"
			}
			';
			$i = $i + 1;
	    } else {
	    	echo '
			,{
				"id":'.$tid.',
				"image":"http://www.bruincave.com/m/'.$tprofilepic.'",
				"name":"'.$tfirstname." ".$tlastname.'",
				"comment":"'.$comment.'"
			}
			';
	    }
	}
}
echo "
    ]}
";


?>