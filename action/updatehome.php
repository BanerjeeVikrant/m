<?php include '../system/helpers.php';?>
<?php 
require "../system/connect.php"; 

session_start();
if (isset($_SESSION['user_login'])) {
	$username = $_SESSION['user_login'];
}
else{
	$username = "";
}

$lasthome = $_GET['hid'];
$group = $_GET['g'];

$checkme = $conn->query("SELECT * FROM users WHERE username='$username'");
if ($checkme->num_rows == 1) {

    $getuser = $checkme->fetch_assoc();

    $yourfirstname = $getuser['first_name'];
    $yourgrade = $getuser['grade'];
    if($yourgrade == 9){
        $yourgrade = "Freshman";
    }else if($yourgrade == 10){
        $yourgrade = "Sophomore";
    }else if($yourgrade == 11){
        $yourgrade = "Junior";
    }else if($yourgrade == 12){
        $yourgrade = "Senior";
    }
    $yourlastname = $getuser['last_name'];
    $yoursignupdate= $getuser['sign_up_date'];
    $yourprofilepic = $getuser['profile_pic'];
    $yourbio = $getuser['bio'];
    $yoursex = $getuser['sex'];
    $yourinterests = $getuser['interests'];
    $yourdob = $getuser['dob'];
    $yourfollowers = $getuser['followers'];
    $yourfollowing = $getuser['following'];
}

if (!isset($_GET['u'])) {
    $yourfollowing_arr =  explode(',',$yourfollowing);
    $yourfollowing_quoted = "'".implode("','",$yourfollowing_arr)."'";
    if ($group == 0) {
        $sql = "SELECT * FROM posts WHERE ((added_by IN ($yourfollowing_quoted) AND posted_to = '0') OR (added_by = '$username' AND posted_to = '0') AND (post_group = '0')) AND id > '$lasthome' ORDER BY id DESC";
    }
    else {
        $sql = "SELECT * FROM posts WHERE (post_group = '$group') ORDER BY id DESC";
    }
   
}

$getposts = $conn->query($sql) or die(mysql_error());

    if($getposts->num_rows > 0) {
        while ($row = $getposts->fetch_assoc()) {
            $id = $row['id'];

            $hidden = $row['hidden'];
            if($hidden == '1'){
                continue;
            }
            $body = $row['body'];        

            //$body = identifyTagsInMsg($body);
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


            // $likedbyFull = "<img src='img/liked-paw.png' width=18> <span class='likedby-names'>Liked by ";
            // for ($i=0;$i<count($likedbyArray);$i++) {
            //     $u = $likedbyArray[$i];
            //     $likedbyFull = $likedbyFull . "<a style='color:black;font-style: italic' href='profile.php?u=$u'>" . $u . "</a>, ";
            // }
            // $likedbyFull = rtrim($likedbyFull, ", ");  //Trim ", " from end of string

            // if ($likedby == "") {
            //     $likedbyStr = "<img src='img/liked-paw.png' width=18> <span class='likedby-names'>Be the first to like</span>";
            // }
            // else if (count($likedbyArray) > 5) {
            //     $likes = count($likedbyArray);
            //     $toreplace = '"' . $likedbyFull . '"';
            //     $likedbyStr = "
            //     <script>
            //     function show_likers_$id() {
            //         $('#likers_$id').html($toreplace)
            //     }
            //     </script>
            //     <img src='img/liked-paw.png' width=18> <span class='likedby-names'>$likes likes";
            // }
            // else {
            //     //http://localhost/bkm/profile.php?u=test
            //     $likedbyStr = $likedbyFull;
            // }
//            echo "</span>";

            $picture_added = $row['picture'];
            $video_link = $row['youtubevideo'];
            $video_added = $row['video'];
            if($picture_added != NULL || $picture_added != ""){
                $pic = "<img src = '$picture_added' class = 'posted-pic'></img>";
            }else if($video_added != NULL || $video_added != ""){
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

                    // $timesincestr = '';
                    // if ($dys_since) {
                    //     $timesincestr = $timesincestr . $dys_since . "d";
                    // } if ($hrs_since) {
                    //     $timesincestr = $timesincestr . " " . $hrs_since - ($dys_since * 24) . "h";
                    // } if ($min_since) {
                    //     $timesincestr = $timesincestr . " " . $min_since - ($hrs_since * 60) . "m";
                    // } if ($sec_since) {
                    //     $timesincestr = $timesincestr . " " . $sec_since - ($min_since * 60) . "s";
                    // }
                    // $timesincestr = $timesincestr . " ago";

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
                        $admincode = "<font color='red' style='font-size:10px'>(admin)</font>";
                    }

                    $topName = "<a href = 'profile.php?u=$added_by' class = 'samepostedby'>$userfirstname $userlastname $admincode</a>";
                    

                    $commentsArray = [];

                    if ($commentsid != "") {
                        $commentsArray = explode(",",$commentsid);
                    }
                    $commentsCount = count($commentsArray);
                    $commentsCountShow = 0;
                    if($commentsCount > 3){
                        $commentsCountShow = $commentsCount - 3;
                    }
                    if($commentsCountShow != 0){
                    $commentShownBox = "<div style = 'position: relative;' class='view-more'>                      
                            <div class = 'comment-body'>
                                <div class = 'comments-img'></div>
                                <div class = 'comment-area'>
                                    <div style = 'position: relative;'>
                                        <div class = 'commentPosted'>
                                            &nbsp;&nbsp;&nbsp;View $commentsCountShow more comments
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";
                    }
                    else{
                        $commentShownBox = "";
                    }
                    $defaultCommentsCount = 3;
                    echo "
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
                    <textarea style = 'display: none;' id = 'comments-send'></textarea>
                    <div class = 'comments-input'>
                            $userliked
                        <div style = 'position: relative;'>
                            <form method = 'POST' class='post-comment'>
                                <input type = 'text' name = 'comment' placeholder = 'Write a Comment&hellip;' class = 'comment-inputs' autocomplete = 'off' />
                                <input type = 'text' name = 'id' value = '$id' style = 'display: none;' />
                                <input type = 'submit' id = 'commentid' name = 'commentid' style = 'display: none;'/>        
                            </form>        
                        </div>        
                    </div>
                    <div class = 'comments-box'>


                        <!--PEOPLE WHO LIKED-->


                        <div class = 'comment-body' id='likers_$id' onclick='show_likers_$id()' style='font-size:13px;padding-left:10px;padding-bottom:10px;padding-top:10px'></div>

                        <script>
                        posturl = 'action/getlikers.php?id=$id';
                        $.ajax({url: posturl, success: function(result){
                                $('#likers_$id').html(result);
                            }
                        });
                        </script>


                        $commentShownBox
                        <div class = 'old-comment-box'>";

                        for ($i = 0; $i < $commentsCount - $defaultCommentsCount; $i++) {
                            $value = $commentsArray[$i];
                            $getCommentQuery = $conn->query("SELECT * FROM comments WHERE id='$value' LIMIT 1");
                            $getCommentRow = $getCommentQuery->fetch_assoc();
                            $commentPost = $getCommentRow['comment'];
                            $commentpostedby =  $getCommentRow['from'];
                            $getUser = $conn->query("SELECT * FROM users WHERE username = '$commentpostedby'");
                            $getfetch = $getUser->fetch_assoc();
                            $userpic = $getfetch['profile_pic'];
                            echo "                
                            <div style = 'position: relative;'>                        
                                <div class = 'comment-body'>
                                    <div class = 'comments-img'></div>
                                    <div class = 'comment-area'>
                                        <div style = 'position: relative;'>
                                            <div class = 'commentPosted'>
                                                <a style='position: relative;' href = 'profile.php?u=$commentpostedby'>$commentpostedby</a>&nbsp;&nbsp;&nbsp;$commentPost
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            ";
                        }
                        echo "
                        </div>
                        ";
                        for ($i = max(0,$commentsCount - $defaultCommentsCount); $i < $commentsCount; $i++) {
                            $value = $commentsArray[$i];
                            $getCommentQuery = $conn->query("SELECT * FROM comments WHERE id='$value' LIMIT 1");
                            $getCommentRow = $getCommentQuery->fetch_assoc();
                            $commentPost = $getCommentRow['comment'];
                            $commentpostedby =  $getCommentRow['from'];
                            $getUser = $conn->query("SELECT * FROM users WHERE username = '$commentpostedby'");
                            $getfetch = $getUser->fetch_assoc();
                            $userpic = $getfetch['profile_pic'];
                            echo "                
                            <div style = 'position: relative;'>                        
                                <div class = 'comment-body'>
                                    <div class = 'comments-img'></div>
                                    <div class = 'comment-area'>
                                        <div style = 'position: relative;'>
                                            <div class = 'commentPosted'>
                                                <a style='position: relative;' href = 'profile.php?u=$commentpostedby'>$commentpostedby</a>&nbsp;&nbsp;&nbsp;$commentPost
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            ";
                        }

                        echo "        
                    </div>
                    ";

        }        
    }
?>