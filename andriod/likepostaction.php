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

    $id = $_POST['postid'];
    $username = $_POST['username'];

    $query = $conn->query("SELECT * FROM users WHERE username='$username'");
	$row_id = $query->fetch_assoc();
	$usernameid = $row_id['id'];

    $check = $conn->query("SELECT * FROM posts WHERE id='$id'");
    if ($check->num_rows == 1) {
    	$get = $check->fetch_assoc();

    	$likedby = $get['liked_by'];
    	$likedbyArray = explode(",", $likedby);
    	$likedbyArrayCount = count($likedbyArray);
    	$likedbyArrayNow = []; 

    	$added_by = $get['added_by'];

    	$query = $conn->query("SELECT * FROM users WHERE id='$added_by'");
    	$row = $query->fetch_assoc();

    	$added_byid = $row['id'];
    }

    if(in_array($usernameid, $likedbyArray)){
    	$j = 0;
    	for ($i=0; $i < $likedbyArrayCount; $i++) {
    		if ($likedbyArray[$i] != $usernameid) {
    			$likedbyArrayNow[$j++] = $likedbyArray[$i];
    		}
    	}
    	$likedbyNow = join(',',$likedbyArrayNow);
    	$sql = "UPDATE posts SET liked_by='$likedbyNow' WHERE id='$id'";
    	$removeLikeQuery = $conn->query($sql);
    	$response["success"] = true; 
    }else{
	    if($likedby == "" || $likedby == NULL){
	    	$sqlcommand = $conn->query("UPDATE posts SET liked_by='$usernameid' WHERE id='$id'");
	    }
	    else{
	    	$addedList = $likedby . "," . $usernameid;
	    	$sqlcommand = $conn->query("UPDATE posts SET liked_by='$addedList' WHERE id='$id'");
	    }

    	$response["success"] = true;  
	}

    date_default_timezone_set("America/Los_Angeles");
    $date_added = date("Y/m/d");
    $time_added = time(); 

    $check = $conn->query("SELECT * FROM notifications WHERE (type='2' AND fromUser='$usernameid' AND toUser='$added_by' AND post_id='$id')");
    if ($check->num_rows == 0) {
        $query = $conn->query("INSERT INTO notifications VALUES ('', '2', '$usernameid', '$added_by', '', '$id', '$time_added', '$date_added')");
    }


    echo json_encode($response);


?>