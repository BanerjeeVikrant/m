<?php include "../system/connect.php"; 

ini_set('session.cookie_lifetime', 60 * 60 * 24 * 7);
session_start();
$username = $_SESSION['user_login'];
$query = $conn->query("SELECT * FROM users WHERE username='$username'");
$row = $query->fetch_assoc();
$usernameid = $row['id'];

?>
<?php
	$lastPost = "";
	$s = "";
	$offset = 0;
	if (isset($_GET['o'])) {
		   $offset = $_GET['o'];
	}
	function startsWith($haystack, $needle){
	 $length = strlen($needle);
	 return (strcasecmp(substr($haystack, 0, $length),$needle) == 0);
	}
	if ($s) {
	   $sql = "SELECT * FROM users WHERE 1";
	} else {
	   $sql = "SELECT * FROM users WHERE 1 LIMIT $offset,20";
	}
    $results = $conn->query("SELECT * FROM users WHERE username='$username'");
    $rowget = $results->fetch_assoc();
    $userid = $rowget['id'];
    $name_array = $rowget['dmfriends'];
    $name_array_explode = [];
    if($name_array != ""){
        $name_array_explode = explode(",", $name_array);
    }
    foreach ($name_array_explode as $value) {
        $result = $conn->query("SELECT * FROM users WHERE id='$value'");
        $row = $result->fetch_assoc();
        if ( strcasecmp($row["username"],$username) !=0 ) {
                $chat_profile_pic = $row["profile_pic"];
                $chat_first_name = $row["first_name"];
                $chat_last_name = $row["last_name"];
                $chat_user_name = $row["username"];
                $chat_userid = $row['id'];
                $sex = $row['sex'];
                if($chat_profile_pic == "" || $chat_profile_pic == NULL){
                    if($sex == "1"){
                        $chat_profile_pic = "https://upload.wikimedia.org/wikipedia/commons/3/34/PICA.jpg";
                    }
                    else{
                        $chat_profile_pic = "http://www4.csudh.edu/Assets/CSUDH-Sites/History/images/Faculty-Profile-Pictures/Faculty%20Female%20Default%20Profile%20Picture.jpg";
                    }
                }
                $chat_both_name = $chat_first_name . " " . $chat_last_name;
                if (isset($_GET['s'])) {
                    if (! (startsWith($chat_first_name, $_GET['s']) || startsWith($chat_last_name, $_GET['s']) || startsWith($chat_user_name, $_GET['s']) || startsWith($chat_both_name, $_GET['s']) ) ) {
                        continue;
                    }
                }
                $getPost = $conn->query("SELECT * FROM messages WHERE (fromUser = '$chat_userid' AND toUser = '$userid') ORDER BY id DESC LIMIT 1");
                $get = $getPost->fetch_assoc();
                
                $lastPost = $get['message'];
                $lastPostid = $get['id'];

                $getPost = $conn->query("SELECT * FROM messages WHERE (fromUser = '$userid' AND toUser = '$chat_userid') ORDER BY id DESC LIMIT 1");
                $get = $getPost->fetch_assoc();
                
                $lastPost2 = $get['message'];
                $lastPostid2 = $get['id'];

                if($lastPostid > $lastPostid2){
                    $lasttext = "<b>".$lastPost."</b>";
                    $chat_first_name = "<b>".$chat_first_name;
                    $chat_last_name = $chat_last_name."</b>";
                    $backgroundColorUpdate = "style='background-color:white;'";
                }
                else{
                    $lasttext = "You:" . $lastPost2;
                    $backgroundColorUpdate = "";
                }

                echo "
    <div class='each-user' uid='$chat_userid' $backgroundColorUpdate>
    
               <div style='background-image:url($chat_profile_pic)' class='chat-user-img'></div>
               <div class='each-user-name'>$chat_first_name $chat_last_name</div>
               <div class='each-user-text'>$lasttext</div>
    </div>";
        } 
    }
?>