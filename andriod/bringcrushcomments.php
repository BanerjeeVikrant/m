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

//it should be get
//$crushid = $_GET['crushid'];

$post = $conn->query("SELECT * FROM crush WHERE id='$crushid'");
$get_post = $post->fetch_assoc();

$commentsid = $get_post["commentsid"];

$commentsid_array = explode(",", $commentsid);
echo '
{
    "crushcomments": [';
    $i = 0;
$i = 0;
foreach ($commentsid_array as $value) {
	$comment = $conn->query("SELECT * FROM anoncomments WHERE id='$value'");
	$get_comment = $comemnt->fetch_assoc();

	$body = $get_comment['comment'];

	if($i == 0){
		echo '
		{
			"body:""'.$body.'"
		}
		';
		$i++;
	}else{
		echo '
		,{
			"body:""'.$body.'"
		}
		';
	}
}
echo "
    ]}
";


?>