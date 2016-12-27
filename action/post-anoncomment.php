<?php include '../system/connect.php';?>
<?php 

session_start();
if (isset($_SESSION['user_login'])) {
	$username = $_SESSION['user_login'];
	$query = $conn->query("SELECT * FROM users WHERE username='$username'");
	$row = $query->fetch_assoc();
	$usernameid = $row['id'];
}
else{
	$username = "";
}

$comment = $_POST['comment'];
$comment = str_replace("<","&lt;",$comment);
$comment = str_replace(">","&gt;",$comment);

$sql = "INSERT INTO anoncomments VALUES ('', '$comment', '$usernameid')";
if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$id = $_POST['id'];
$post_check = $conn->query("SELECT * FROM crush WHERE id='$id'");
$post_check_row = $post_check->fetch_assoc();
$post_sender = $post_check_row['by'];
$post_array = $post_check_row['commentsid'];
$post_explode = explode(",",$post_array);
$post_count = count($post_explode);

if ($post_count) {
	if ($post_array == "") {
		$post_array = $last_id;
	}  else {
		$post_array = "$post_array,$last_id";
	}
	$sql = "UPDATE crush SET commentsid='$post_array' WHERE id='$id'";
	$add_query = $conn->query($sql);
}
date_default_timezone_set("America/Los_Angeles");
$date_added = date("Y/m/d");
$time_added = time(); 

echo "$comment";
?>