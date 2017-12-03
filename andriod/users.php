
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

	$lastPost = "";
	$s = "";
	$offset = 0;
    $search = $_GET['s'];
	if (isset($_GET['o'])) {
	   $offset = $_GET['o'];
	}
    $username = $_GET['user'];
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

    $results = $conn->query("SELECT * FROM users WHERE username='$username'");
    $rowget = $results->fetch_assoc();
    $usernameid = $rowget['id'];
    $search_parts = explode(" ", $search);
    if (count($search_parts) == 1) {
        $sql = "SELECT * FROM users WHERE (username LIKE '$search%') OR (first_name LIKE '$search%') OR (last_name LIKE '$search%')";
    } else {
        $exp_first_name = $search_parts[0];
        $exp_last_name = $search_parts[1];
        $sql = "SELECT * FROM users WHERE (first_name LIKE '$exp_first_name%') AND (last_name LIKE '$exp_last_name%')";
    }
    $results_a = $conn->query($sql);
    $rows = [];
    if($search != ""){
        while ($row = $results_a->fetch_assoc()) {
            $id_user = $row["id"];
            if(in_array($id_user, $name_array_explode)){
                
            }else{
                $rows[] = $id_user;
            }
        }
    }

    $array_merged = array_merge($name_array_explode, $rows);

            echo '
{
    "usersMsg": [';
    $i = 0;
    foreach ($array_merged as $value) {
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
                }else{
                    $chat_profile_pic = "http://www.bruincave.com/m/" . $chat_profile_pic;
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
                    $lasttext = $lastPost;
                    $chat_first_name = $chat_first_name;
                    $chat_last_name = $chat_last_name;
                }
                else if($lastPostid < $lastPostid2){
                    $lasttext = "You: " . $lastPost2;
                    $backgroundColorUpdate = "";
                }
                else{
                    $lasttext = "Start Conversation!";
                }
                

            if($i == 0){
                echo '
                {
                    "id":'.$chat_userid.',
                    "body": "'.$lasttext.'",
                    "fromPic": "'.$chat_profile_pic.'",
                    "name": "'.$chat_first_name." ".$chat_last_name.'"
                }
    ';          
                $i = $i + 1;
            }else{
                echo '
                ,{
                    "id":'.$chat_userid.',
                    "body": "'.$lasttext.'",
                    "fromPic": "'.$chat_profile_pic.'",
                    "name": "'.$chat_first_name." ".$chat_last_name.'"
                }
    ';
            }
        } 
    }

echo "
    ]}
";
?>