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

    $id = $_GET['postid'];
    $username = $_GET['username'];

    $query = $conn->query("SELECT * FROM users WHERE id='$username'");
	$row_id = $query->fetch_assoc();
	$usernameid = $row_id['id'];

    $check = $conn->query("SELECT * FROM posts WHERE id='$id'");
    if ($check->num_rows == 1) {

    	$get = $check->fetch_assoc();

    	$added_by = $get['added_by'];

    	$query = $conn->query("SELECT * FROM users WHERE id='$added_by'");
    	$row = $query->fetch_assoc();
    	$added_byid = $row['id'];

    	$likedby = $get['liked_by'];

    }


    if($likedby == "" || $likedby == NULL){
    	$sqlcommand = $conn->query("UPDATE posts SET liked_by='$usernameid' WHERE id='$id'");
    }
    else{
    	$addedList = $likedby . "," . $usernameid;
    	$sqlcommand = $conn->query("UPDATE posts SET liked_by='$addedList' WHERE id='$id'");
    }

    $response["success"] = true;  
    
    echo json_encode($response);


?>