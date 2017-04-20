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

    $query = $conn->query("SELECT * FROM users WHERE username='$username'");
    $fetch_info = $query->fetch_assoc();
    $usernameid = $fetch_info['id'];

    $sql =  "SELECT * FROM livenotify WHERE notifyUser='$usernameid'";

    $getposts = $conn->query($sql) or die(mysql_error());
    $i = 0;
echo '
{
    "notifyInfo": [';

    if($getposts->num_rows > 0) {
        while ($row = $getposts->fetch_assoc()) {
            $id = $row['id'];
            $type = $row['about'];
            $postid = $row['postid'];
            $touser = $row['notifyUser'];
            if($type == 0){
                $findMessage = $conn->query("SELECT * FROM messages WHERE id='$postid'");
                if($findMessage->num_rows > 0) {
                    while ($row = $findMessage->fetch_assoc()) {
                        $fromuserid = $row['fromUser'];
                        $query = $conn->query("SELECT * FROM users WHERE id='$fromuserid'");
                        $query_fetch = $query->fetch_assoc();
                        $fromid = $query_fetch['id'];
                        $fromuser = $query_fetch['first_name'];
                        $fullfromuser = $query_fetch['first_name']." ".$query_fetch['last_name'];
                        $fromprofile_pic = "http://www.bruincave.com/m/".$query_fetch['profile_pic'];

                        $touser = $row['toUser'];
                        $message = $row['message'];
                        $time = $row['time'];

                        if($i != 0){
                            echo ',';
                        }else{
                            $i = $i + 1;
                        }

                        echo '
                        {
                            "type":'.$type.',
                            "fromid":'.$fromid.',
                            "fromuser":"'.$fromuser.'",
                            "fullfromuser":"'.$fullfromuser.'",
                            "frompic":"'.$fromprofile_pic .'",
                            "touser": "'.$touser.'",
                            "message":"'.$message.'",
                            "time":"'.$time.'"
                        }';  
                    }
                }
                $deleteNotifyQuery = $conn->query("DELETE FROM livenotify WHERE notifyUser='$usernameid' AND id='$id' AND about='$type'");
            } else if($type == 1){
                $findComment = $conn->query("SELECT * FROM comments WHERE id='$postid'");
                if($findComment->num_rows > 0) {
                    $row = $findComment->fetch_assoc();
                    $fromid = $row['from'];
                    $comment = $row['comment'];

                    $findUser = $conn->query("SELECT * FROM users WHERE id='$fromid'");
                    $rows = $findUser->fetch_assoc();
                    $fromuser = $rows['first_name'];
                    $fullfromuser = $rows['first_name']." ".$rows['last_name'];
                    $fromprofile_pic = "http://www.bruincave.com/m/".$rows['profile_pic'];

                    $message = "replied:".$comment;
                    $time = "";

                }
                echo '
                {
                    "type":'.$type.',
                    "fromid":'.$fromid.',
                    "fromuser":"'.$fromuser.'",
                    "fullfromuser":"'.$fullfromuser.'",
                    "frompic":"'.$fromprofile_pic .'",
                    "touser": "'.$touser.'",
                    "message":"'.$message.'",
                    "time":"'.$time.'"
                }'; 

                $deleteNotifyQuery = $conn->query("DELETE FROM livenotify WHERE notifyUser='$usernameid' AND id='$id' AND about='$type'"); 
            }

        }
    }     
        
 echo "
    ]}
";


    

?>