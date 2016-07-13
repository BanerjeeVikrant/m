<?php include "../system/connect.php"; 

session_start();
$username = $_SESSION['user_login'];


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
	$result = $conn->query("SELECT * FROM users WHERE 1");
	for ($i=0; $i < $result->num_rows; $i++) {
        $row = $result->fetch_assoc();
        if ( $row["username"] != $username ) {
                $chat_profile_pic = $row["profile_pic"];
                $chat_first_name = $row["first_name"];
                $chat_last_name = $row["last_name"];
                $chat_user_name = $row["username"];
                $chat_userid = $row['id'];
                $chat_both_name = $chat_first_name . "%20" . $chat_last_name;
                if (isset($_GET['s'])) {
                    if (! (startsWith($chat_first_name, $_GET['s']) || startsWith($chat_last_name, $_GET['s']) || startsWith($chat_user_name, $_GET['s']) || startsWith($chat_both_name, $_GET['s']) ) ) {
                        continue;
                    }
                }
              /*  $getPost = $conn->query("SELECT * FROM messages WHERE to_user = '$chat_userid'");
                $get = $getPost->fetch_assoc();
                
                $lastPost = $get['message'];*/
                echo "
    <div class='each-user' uid='$chat_userid' >
    
               <div style='background-image:url($chat_profile_pic)' class='chat-user-img'></div>
               <div class='each-user-name'>$chat_first_name $chat_last_name</div>
    </div>";
        } 
    }
?>