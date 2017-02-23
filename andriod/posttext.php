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
    $post = $_GET['post'];
    $username = $_GET['u'];
    $view_group_id = $_GET['group'];
    $profileUser = $_GET['puser'];

    $checkme = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($checkme->num_rows == 1) {
        $getuser = $checkme->fetch_assoc();
        $usernameid = $getuser['id'];
    }

    $checkyou = $conn->query("SELECT * FROM users WHERE username='$profileUser'");
    if ($checkyou->num_rows == 1) {
        $getyou = $checkyou->fetch_assoc();
        $profileUserid = $getyou['id'];
    }

    if($post != ""){
        date_default_timezone_set("America/Los_Angeles");
        $date_added = '';
        $time_added = time(); 
        $added_by = $username;
        
        //(`id`, `body`, `date_added`, `time_added`, `added_by`, `posted_to`, `tags`, `user_posted_to`, `commentsid`, `picture`, `video`, `youtubevideo`, `hidden`, `hidden_by`, `liked_by`, `post_group`)
        if($profileUser == ""){
            $sqlcommand = "INSERT INTO posts VALUES ( '', '$post', '$date_added', '$time_added', '$usernameid', '0', '', '', '', '', '', '', '0', '', '', '$view_group_id')";
        }else{
            $sqlcommand = "INSERT INTO posts VALUES ( '', '$post', '$date_added', '$time_added', '$usernameid', '1', '', '$profileUserid', '', '', '', '', '0', '', '', '0')";
        }
        if ($conn->query($sqlcommand) === TRUE) {
            $last_id = $conn->insert_id;
            $words_array = explode(" ", $post);

            foreach ($words_array as $value) {
                if (preg_match("/#.+/", $value)) {
                    $check = $conn->query("SELECT * FROM hashtags WHERE word='$value'");
                    if($check->num_rows == 1){
                        $get = $check->fetch_assoc();
                        $postids = $get["post_ids"];
                        $postsid = $postids . ",". $last_id;
                        $query = $conn->query("UPDATE hashtags SET post_ids='$postsid' WHERE word='$value'");
                    }
                    else{
                        $query = $conn->query("INSERT INTO hashtags VALUES ('$value', '$last_id')");
                    }
                } else {

                }
            }
        } else {
            echo "Error: " . $sqlcommand . "<br>" . $conn->error;
        }

    }

?>