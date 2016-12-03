<?php include '../system/connect.php';?>
<?php include '../system/helpers.php';?>
<?php 
session_start();
if (isset($_SESSION['user_login'])) {
      $username = $_SESSION['user_login'];
}
else{
      $username = "";
}

function identifyTagsInMsg($msg) {
    $tags = array();
    $msg_space = explode(' ',$msg);
    for($i=0; $i < count($msg_space); $i++) {
        $msg_comma = explode(',',$msg_space[$i]);
        for($j=0; $j < count($msg_comma); $j++) {
                    $new_msg_comma = $msg_comma[$j];
                if (preg_match('/^http:/',$msg_comma[$j]) || preg_match('/^https:/',$msg_comma[$j])) {
                        $new_msg_comma = "<a href=\'".$msg_comma[$j]."\'>".$msg_comma[$j]."</a>";
                } else {
                        $msg_dot = explode('\.',$msg_comma[$j]);
                    for($k=0; $k < count($msg_dot); $k++) {
                            if (preg_match('/^\#/',$msg_dot[$k])) {
                                array_push($tags, $msg_dot[$k]);
                                $new_msg_dot = "<a class='msg-tag' onclick=searchtag('hi')>".$msg_dot[$k]."</a>";
                            } elseif (preg_match('/^\@/',$msg_dot[$k])) {
                                $new_msg_dot = "<a href='profile.php?u=".substr($msg_dot[$k],1)."'>".$msg_dot[$k]."</a>";
                            } else {
                                $new_msg_dot = $msg_dot[$k];
                            }
                            if ($k == 0) {
                                $new_msg_comma = $new_msg_dot;
                            } else {
                                $new_msg_comma = $new_msg_comma.".".$new_msg_dot;
                            }
                    }
                }
                $msg_comma[$j] = $new_msg_comma;
        }
        $msg_space[$i] = join(',',$msg_comma);
    }
    $msg = join(' ',$msg_space);
    return $msg;
}

//post_id, flagger
$reported_list = "";
$reported_ids = $conn->query("SELECT * FROM report WHERE 1");
if($reported_ids->num_rows > 0) {
    while ($row = $reported_ids->fetch_assoc()) {
        $reported_id = $row['post_id'];
        if($reported_list != ""){
            $reported_list = $reported_list. ",".strval($reported_id);
        }
        else{
            $reported_list = strval($reported_id);
        }
    }
    $reported_array = explode(",", $reported_list);

    foreach ($reported_array as $postid) {
        $sql = "SELECT * FROM posts WHERE (id = '$postid')";
        $getposts = $conn->query($sql) or die(mysql_error());
        if($getposts->num_rows > 0) {
            $row = $getposts->fetch_assoc();
            $id = $postid;
            $body = $row['body'];        
            $body = identifyTagsInMsg($body);
            $pic = '';
            $vid = '';
            $youtube = '';
            $likedby = $row['liked_by'];
            $likedbyArray = explode(",",$likedby);
            $countLikes = count($likedbyArray);
            if($countLikes > 1){
                $numberLikes = "<span class='count-likes'>$countLikes likes</span>";
            }
            else if($countLikes == 1){
                $numberLikes = "<span class='count-likes'>$countLikes like</span>";
            }
            else{
                $numberLikes = "";
            }
            if(in_array($username, $likedbyArray)){
                $userliked = "<div class = 'like-btn-div'><div id='like-btn-$id' class = 'liked' onclick = 'unlikePost($id);'></div></div>";
            }
            else{
                $userliked = "<div class = 'like-btn-div'><div id='like-btn-$id' class = 'notliked' onclick = 'likePost($id);'></div></div>";
            }

            $picture_added = $row['picture'];
            $video_link = $row['youtubevideo'];
            $video_added = $row['video'];
            if($picture_added != NULL || $picture_added != ""){
                $pic = "<img src = '$picture_added' class = 'posted-pic'></img>";
            }else if($video_added != NULL || $video_added != "") {
                $vid = "
                <video class = 'posted-video' controls loop>
                    <source src='$video_added' type='video/mp4'>
                        <source src='$video_added' type='video/ogg'>
                            Your browser does not support HTML5 video.
                        </video>";
            }else if($video_link != NULL || $video_link != ""){
                $youtube = "<iframe class = 'youtube-link-iframe' src='$video_link' frameborder='0' allowfullscreen></iframe>";
            }
            $date_added = $row['date_added'];
            $added_by = $row['added_by'];
            $time_added = $row['time_added'];
            $username_posted_to = $row['user_posted_to'];
            $commentsid = $row['commentsid'];

            $sql = "SELECT * FROM users WHERE username='$added_by'"; 
            $result = $conn->query($sql);
            $pic_row  = $result->fetch_assoc();
            $userpic =  $pic_row['profile_pic'];
            $usersex = $pic_row['sex'];
            $admin = $pic_row['admin'];

            $timesincestr = time_elapsed_string($time_added);

            if($userpic == "" || $userpic == NULL){
                if($usersex == "1"){
                    $userpic = "https://upload.wikimedia.org/wikipedia/commons/3/34/PICA.jpg";
                }
                else{
                    $userpic = "http://ieeemjcet.org/wp-content/uploads/2014/11/default-girl.jpg";
                }
            }
            $userfirstname = $pic_row['first_name'];
            $userlastname = $pic_row['last_name'];
            $topName = '';
            if (isset($_GET['u'])) {
                if($username == $profileUser){
                    $hide = "<a href = 'deleteposts.php?p=$id' class = 'glyphicon glyphicon-remove'></a>";
                }
            }
            $admincode = "";
            if ($admin) {
                $admincode = '<font style="font-size: 9px;position: relative;top: 5px;left: -2px;color: #1d2d4a;">Help</font>';
            }
            $topName = "<a href = 'profile.php?u=$added_by' class = 'samepostedby'>$userfirstname $userlastname $admincode</a>";
            echo "
            <div id = 'profile-post-$id' style='display:inline-block;'>
            <div class = 'profile-post' homeid='$id'>
                <div style = 'position: relative;'>
                    <div class = 'glyphicon glyphicon-option-vertical post-options' id='$id'></div>
                </div>
                <div class = 'posted-by-img' style = 'background-image: url($userpic);'></div>
                <span class = 'topName'>
                    $topName<br>
                    <span class = 'time'>$timesincestr</span>
                </span>
                <hr class='post-breaker'>
                <p class = 'msg-body'>$body</p>
                $pic
                $vid
                $youtube
            </div>
            </div>
            ";

        }
    }
}


?>