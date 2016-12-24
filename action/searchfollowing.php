<?php
require "../system/connect.php";
session_start();

if(isset($_GET['u'])){
	$profileUser = $_GET['u'];
	if($profileUser == ""){
		echo "<meta http-equiv=\"refresh\" content=\"0; url=profile.php?u=$username\">";
	}
	function startsWith($haystack, $needle){
	 $length = strlen($needle);
	 return (strcasecmp(substr($haystack, 0, $length),$needle) == 0);
	}
//check user exists
//error max 40 users
	$check = $conn->query("SELECT * FROM users WHERE username='$profileUser'");
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


	} else {
		//echo "<meta http-equiv=\"refresh\" content=\"0; url=/bruinskave/index.php\">";
		exit();
	}
}
foreach ($followingArray as $value) {
	$sql = "SELECT * FROM users WHERE username='$value'";
	$results = $conn->query($sql);
	$row = $results->fetch_assoc();
	$tusername = $row["username"];
	$tfirstname = $row["first_name"];
	$tlastname = $row["last_name"];
	$tprofilepic = $row["profile_pic"];
	$tlastonline_date = $row["last_online_date"];
	$tlastonline_time = $row["last_online_time"];
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
	if (isset($_GET['s'])) {
	    if (! (startsWith($tfirstname, $_GET['s']) || startsWith($tlastname, $_GET['s']) || startsWith($tusername, $_GET['s']) || startsWith($chat_both_name, $_GET['s']) ) ) {
	        continue;
	    }
	}
	echo "
		<a href='profile.php?u=$tusername'><div class='search-layer'>
			<div style='position:relative;display: inline-block;'>
			<div class='search-userpic' style='background-image:url($tprofilepic)'></div>
			</div>
			<div class='search-name'>$tfirstname $tlastname</div>
			<div class='search-time'>Last online 3h ago</div>
		</div></a>
	";
}
?>