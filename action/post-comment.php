<?php include '../system/connect.php';?>
<?php 

session_start();
if (isset($_SESSION['user_login'])) {
	$username = $_SESSION['user_login'];
}
else{
	$username = "";
}

$comment = $_POST['comment'];
$comment = str_replace("<","&lt;",$comment);
$comment = str_replace(">","&gt;",$comment);

$sql = "INSERT INTO comments VALUES ('', '$comment', '$username')";
if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$id = $_POST['id'];
$post_check = $conn->query("SELECT * FROM posts WHERE id='$id'");
$post_check_row = $post_check->fetch_assoc();
$post_sender = $post_check_row['added_by'];
$post_array = $post_check_row['commentsid'];
$post_explode = explode(",",$post_array);
$post_count = count($post_explode);

if ($post_count) {
	if ($post_array == "") {
		$post_array = $last_id;
	}  else {
		$post_array = "$post_array,$last_id";
	}
	$sql = "UPDATE posts SET commentsid='$post_array' WHERE id='$id'";
	$add_query = $conn->query($sql);
}
date_default_timezone_set("America/Los_Angeles");
$date_added = date("Y/m/d");
$time_added = date("h:i:sa"); 

$query = $conn->query("INSERT INTO notifications VALUES ('', '3', '$username', '$post_sender', '$last_id', '$id', '$time_added', '$date_added')");

echo "$comment";
?>