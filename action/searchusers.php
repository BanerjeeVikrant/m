<?php
	require "../system/connect.php";
	session_start();

	$search = $_GET["search"];
	$search_parts = explode(" ", $search);
	if (count($search_parts) == 1) {
		$sql = "SELECT * FROM users WHERE (username LIKE '$search%') OR (first_name LIKE '$search%') OR (last_name LIKE '$search%')";
	} else {
		$exp_first_name = $search_parts[0];
		$exp_last_name = $search_parts[1];
		$sql = "SELECT * FROM users WHERE (first_name LIKE '$exp_first_name%') AND (last_name LIKE '$exp_last_name%')";
	}
	$results = $conn->query($sql);
	if($results->num_rows > 0) {
		while ($row = $results->fetch_assoc()) {
			if  ($row["username"] == $_SESSION["user_login"]) {
			    continue;
			}
			$username = $row["username"];
			$firstname = $row["first_name"];
			$lastname = $row["last_name"];
			$profilepic = $row["profile_pic"];

			$lastonline_date = $row["last_online_date"];
			$lastonline_time = $row["last_online_time"];
			$sex = $row['sex'];
			if($profilepic == "" || $profilepic == NULL){
				if($sex == "1"){
					$profilepic = "https://upload.wikimedia.org/wikipedia/commons/3/34/PICA.jpg";
				}
				else{
					$profilepic = "http://www4.csudh.edu/Assets/CSUDH-Sites/History/images/Faculty-Profile-Pictures/Faculty%20Female%20Default%20Profile%20Picture.jpg";
				}
			}
			echo "
			<div user='$username' class='search-layer'>
				<div style='position:relative;display: inline-block;'>
				<div class='search-userpic' style='background-image:url($profilepic)'></div>
				</div>
				<div class='search-name'>$firstname $lastname</div>
				<div class='search-time'>Last online 3h ago</div>
			</div>
			";
		}
	} else  {
		echo "No users found...";
	}

?>