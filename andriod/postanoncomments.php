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

	$username = $_POST['u'];
	$id = $_POST['id'];
	$comment = $_POST['c'];


	$checkme = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($checkme->num_rows == 1) {
        $getuser = $checkme->fetch_assoc();
        $usernameid = $getuser['id'];
    }


	$sql = "INSERT INTO anoncomments VALUES ('', '$comment', '$usernameid')";
	if ($conn->query($sql) === TRUE) {
	    $last_id = $conn->insert_id;
	    $success = true;
	    echo '
		{
		    "success": [';
		    
		                echo '
		                {
		                    "successError":'.$success.'
		                }
		    ';          
		 echo "
		    ]}
		";	
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

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
?>