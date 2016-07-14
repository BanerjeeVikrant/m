<?php include '../system/connect.php';?>
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

$sql =  "SELECT * FROM notifications WHERE toUser='test' ORDER BY id DESC LIMIT $offset,20";

$getposts = $conn->query($sql) or die(mysql_error());

    if($getposts->num_rows > 0) {
        while ($row = $getposts->fetch_assoc()) {
            $id = $row['id'];
            $type = $row['type'];
            $fromUser = $row['fromUser']; 
            $toUser = $row['toUser'];
            $commentId = $row['comment_id'];
            $postId = $row['post_id'];
            $time_added = $row['time_added'];
            $date_added = $row['date_added'];

            $getFrom = $conn->query("SELECT * FROM users WHERE username='$fromUser'");
            $getInfo = $getFrom->fetch_assoc();

            $fromPic = $getInfo['profile_pic'];
            $fromFirst = $getInfo['first_name'];;

            $getFrom = $conn->query("SELECT * FROM comments WHERE id='$commentId'");
            $getInfo = $getFrom->fetch_assoc();

            $commentBody = $getInfo['comment'];

            $notifierTime = "3h";

            if($type == '1'){
                $message = "started following you.";   
            }
            else if($type == '2'){
                $message = "liked your post.";
            }
            else if($type == '3'){
                $message =  "commented on your post.";
            }

            echo "
            <div class = 'notification-post'>
                
                <div class='fromPicNotification' style='background-image:url($fromPic);'></div>
                
                <div class='notificationBox'>
                    <span class='notifier'>$fromFirst</span>
                    
                    <span class='notificationInfo'>$message</span>
                    <span class='notifier-time'>$notifierTime</span>
               </div>
            </div>";

        }     
    } else {
        echo "        
        </div><script>document.getElementById('loading-img').remove();</script>
        ";
    }
?>