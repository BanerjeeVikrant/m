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

    $type = $_POST['type'];
    $offset = $_POST['o'];
    $username = $_POST['user'];
    $profileUser = $_POST['puser'];
    $group = $_POST['group'];

    if ($profileUser != "") {
        $check = $conn->query("SELECT * FROM users WHERE username='$profileUser'");
        if ($check->num_rows == 1) {

            $get = $check->fetch_assoc();
            $profileUserid = $get['id'];
            $firstname = $get['first_name'];
            $lastname = $get['last_name'];
            $profilepic = $get['profile_pic'];
            $followers = $get['followers'];        
            $following = $get['following'];
        }
    }else{
        $profileUser  == "";
    }

    $checkme = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($checkme->num_rows == 1) {

        $getuser = $checkme->fetch_assoc();
        $yourid = $getuser['id'];
        $yourfirstname = $getuser['first_name'];
        $yourlastname = $getuser['last_name'];
        $yourprofilepic = $getuser['profile_pic'];
        $yourfollowers = $getuser['followers'];
        $yourfollowing = $getuser['following'];
    }

    if ($profileUser == "") {
        $yourfollowing_arr =  explode(',',$yourfollowing);
        $yourfollowing_quoted = "'".implode("','",$yourfollowing_arr)."'";
        if ($group == 0) {
            if($type == 0){
                $sql = "SELECT * FROM posts WHERE ((added_by IN ($yourfollowing_quoted) AND posted_to = '0') OR (added_by = '$yourid' AND posted_to = '0') AND (post_group = '0')) ORDER BY id DESC LIMIT $offset,5";
            }else{
                $sql = "SELECT * FROM posts WHERE (post_group = '0') ORDER BY id DESC LIMIT $offset,5";
            }
        }
        else {
            $sql = "SELECT * FROM posts WHERE (post_group = '$group') ORDER BY id DESC LIMIT $offset,5";
        }
       
    } else {
        $sql =  "SELECT * FROM posts WHERE (added_by = '$profileUserid' AND posted_to = '1') OR (user_posted_to = '$profileUserid') ORDER BY id DESC LIMIT $offset,5";
    }
    $getposts = $conn->query($sql) or die(mysql_error());

    if($getposts->num_rows > 0) {
        echo '
{
    "home": [';
    $i = 0;
        while ($row = $getposts->fetch_assoc()) {

            $id =  -1;
            $body =  "";
            $likedby = "";
            $picture_added = "";
            $time_added = "";

            $id =  $row['id'];
            $body =  $row['body'];
            $likedby = $row['liked_by'];
            $likedbyArray = explode(",",$likedby);
            $countLikes = count($likedbyArray);
            
            if($countLikes > 3){
                $moreThanThreeLiker = 1;
            }else if($likedby == ""){
                $moreThanThreeLiker = 2;
            }else{
                $moreThanThreeLiker = 0;
            }
            if(in_array($yourid, $likedbyArray)){
                $likedByMe = 1;
            }else{
                $likedByMe = 0;
            }

            $hidden_post = $row['hidden'];
            if($hidden_post == '1'){
                continue;
            }
            $picture_added = "";
            $picture_added = $row['picture'];
            $time_added = $row['time_added'];
            $timestr = time_elapsed_string($time_added);
            $added_by = $row['added_by'];
            $username_posted_to = $row['user_posted_to'];
            $commentsid = $row['commentsid'];

            $sql = "SELECT * FROM users WHERE id='$added_by'"; 
            $result = $conn->query($sql);
            $pic_row  = $result->fetch_assoc();
            $userpic =  "";
            $userpic =  $pic_row['profile_pic'];
            
            $userfirstname = $pic_row['first_name'];
            $userlastname = $pic_row['last_name'];
            //$commentsid = $row['commentsid'];

            $post = $conn->query("SELECT * FROM posts WHERE id='$id'");
            $get_post = $post->fetch_assoc();

            $commentsid = $get_post["commentsid"];

            $commentsid_array = explode(",", $commentsid);

            $commentsid_arrayCount = count($commentsid_array);

            if($commentsid_arrayCount > 3){
                $moreThanThreeComments = 1;
            }else{
                $moreThanThreeComments = 0;
            }

            if($i != 0){
                echo ',';
            }
            echo '{
                "id":'.$id.',
                "body": "'.$body.'",
                "picture_added": "http://www.bruincave.com/m/'.$picture_added.'",
                "userpic": "http://www.bruincave.com/m/'.$userpic.'",
                "name": "'.$userfirstname." ".$userlastname.'",
                "time_added":"'.$timestr.'",
                "moreThanThreeComments":'.$moreThanThreeComments.',
                "likedByMe":'.$likedByMe.',
                "moreThanThreeLiker":'.$moreThanThreeLiker.',
                "likedby":"'.$likedby.'",
                "likesCount":'.$countLikes.',
                
            ';  
            $commentsArr = "";

            foreach ($commentsid_array as $value) {
                if ($value != '') {
                    $comment = $conn->query("SELECT * FROM comments WHERE id='$value'");

                    $get_comment = $comment->fetch_assoc();

                    $body = $get_comment['comment'];
                    $from_ = $get_comment['from'];

                    $query = $conn->query("SELECT * FROM users WHERE id='$from_'");
                    $row = $query->fetch_assoc();
                    $from = $row['username'];

                    if ($commentsArr != "") {
                        $commentsArr = $commentsArr.",";
                    }
                    if ($body != "") {

                        $commentsArr .= "
                                        {
                                          'body':'$body',
                                          'from':'$from'
                                        }";
                    }
                 }
            }
            echo'
                "comments": ['.$commentsArr.'
                            ]
            }';      

            $i = $i + 1;
        }
                
        echo "
    ]}
";
    }
?>

