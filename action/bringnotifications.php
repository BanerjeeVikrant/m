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


?>
<?php

$offset = $_GET['o'];

$sql =  "SELECT * FROM notifications WHERE toUser='$username' AND fromUser != '$username' ORDER BY id DESC LIMIT $offset,20";

$getposts = $conn->query($sql) or die(mysql_error());

    if($getposts->num_rows > 0) {
        while ($row = $getposts->fetch_assoc()) {
            $id = $row['id'];
            $fromUser = $row['fromUser']; 
            $time_added = $row['time_added'];
            $date_added = $row['date_added'];
            $type = $row['type'];
            $toUser = $row['toUser'];
            $commentId = $row['comment_id'];
            $postId = $row['post_id'];

            $getFrom = $conn->query("SELECT * FROM users WHERE username='$fromUser'");
            $getInfo = $getFrom->fetch_assoc();

            $fromPic = $getInfo['profile_pic'];
            $fromFirst = $getInfo['first_name'];
            $fromsex = $getInfo['sex'];

            $getFrom = $conn->query("SELECT * FROM comments WHERE id='$commentId'");
            $getInfo = $getFrom->fetch_assoc();

            $comment = $getInfo['comment'];

            $notifierTime = time_elapsed_string($time_added);

            if($type == '1'){
                $message = "started following you.";   
            }
            else if($type == '2'){
                $message = "liked your post.";
            }
            else if($type == '3'){
                $message =  "commented: $comment";
            }
            if($fromPic == "" || $fromPic == NULL){
                if($fromsex == "1"){
                    $fromPic = "https://upload.wikimedia.org/wikipedia/commons/3/34/PICA.jpg";
                }
                else{
                    $fromPic = "http://www4.csudh.edu/Assets/CSUDH-Sites/History/images/Faculty-Profile-Pictures/Faculty%20Female%20Default%20Profile%20Picture.jpg";
                }
            }
            echo "
            <div class = 'notification-post' nid='$id' postid='$postId'>
                <div style='position: relative;'>
                <div class='fromPicNotification' style='background-image:url($fromPic);'></div>
                </div>
                <div class='notificationBox'>
                    <a href='profile.php?u=$fromUser'><span class='notifier'>$fromFirst</span></a>
                    
                    <span class='notificationInfo'>$message</span>
                    <span class='notifier-time'>$notifierTime</span>
               </div>
            </div>";

        }     
    }
      else {
        echo "        
        <div style = 'position: relative;'>
            <div class = 'notification-post' id='last_notification' style ='position: absolute;'>
                <span><span class  = 'glyphicon glyphicon-share-alt'></span> No more Notifications!<span>
            </div>
        </div><script>document.getElementById('loading-img-notifications').remove();</script>
        ";
    }
?>