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

    $ip = "";

    // Without a proper internet server $ip is not going to work

    if ($_SERVER['HTTP_CLIENT_IP']!="") {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } 
    elseif ($_SERVER['HTTP_X_FORWARDED_FOR']!="") {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    $offset = $_POST['o'];
    $username = $_POST['user'];
    $profileUser = $_POST['puser'];
    $group = $_POST['group'];

    if ($profileUser) {
        $check = $conn->query("SELECT * FROM users WHERE username='$profileUser'");
        if ($check->num_rows == 1) {

            $get = $check->fetch_assoc();
            $firstname = $get['first_name'];
            $lastname = $get['last_name'];
            $profilepic = $get['profile_pic'];
            $followers = $get['followers'];        
            $following = $get['following'];
        }
    }
    $checkme = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($checkme->num_rows == 1) {

        $getuser = $checkme->fetch_assoc();
        $yourfirstname = $getuser['first_name'];
        $yourlastname = $getuser['last_name'];
        $yourprofilepic = $getuser['profile_pic'];
        $yourfollowers = $getuser['followers'];
        $yourfollowing = $getuser['following'];
    }

    if (!isset($profileUser)) {
        $yourfollowing_arr =  explode(',',$yourfollowing);
        $yourfollowing_quoted = "'".implode("','",$yourfollowing_arr)."'";
        if (!$group) {
            $sql = "SELECT * FROM posts WHERE ((added_by IN ($yourfollowing_quoted) AND posted_to = '0') OR (added_by = '$usernameid' AND posted_to = '0') AND (post_group = '0')) ORDER BY id DESC LIMIT $offset,20";
        }
        else {
            $sql = "SELECT * FROM posts WHERE (post_group = '$group') ORDER BY id DESC LIMIT $offset,20";
        }
       
    } else {
        $sql =  "SELECT * FROM posts WHERE (added_by = '$profileUserid' AND posted_to = '1') OR (user_posted_to = '$profileUserid') ORDER BY id DESC LIMIT $offset,20";

    }
    $getposts = $conn->query($sql) or die(mysql_error());

    if($getposts->num_rows > 0) {
        echo "
{
    'home': [";
        while ($row = $getposts->fetch_assoc()) {

            $id =  $row['id'];
            $body =  $row['body'];
            $likedby = $row['liked_by'];
            $picture_added = $row['picture'];
            $time_added = $row['time_added'];
            //$commentsid = $row['commentsid'];
            echo "
            {
                'id': '$id',
                'body': '$body',
                'picture_added': '$picture_added',
                'time_added': '$time_added',
            },
";
        }
        echo "
    ]
}";
    }

?>