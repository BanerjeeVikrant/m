<?php
    $servername = "localhost";
    $username1 = "root";
    $password = "";
    $dbname = "bruincaveData";

    // Create connection
    $conn = new mysqli($servername, $username1, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    include "../system/helpers.php";

	$username = $_GET['u'];
	$id = $_GET['id'];
	$comment = $_GET['c'];

    $checkme = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($checkme->num_rows == 1) {
        $getuser = $checkme->fetch_assoc();
        $usernameid = $getuser['id'];
    }

    $sql = "INSERT INTO comments VALUES ('', '$comment', '$usernameid')";
    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $post_check = $conn->query("SELECT * FROM posts WHERE id='$id'");
    $post_check_row = $post_check->fetch_assoc();
    $post_sender = $post_check_row['added_by'];
    $query = $conn->query("SELECT * FROM users WHERE id='$post_sender'");
    $row = $query->fetch_assoc();
    $post_senderid = $row['id'];
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
    $time_added = time(); 

    $query = $conn->query("INSERT INTO notifications VALUES ('', '3', '$usernameid', '$post_senderid', '$last_id', '$id', '$time_added', '$date_added')");

    echo "$comment";

?>