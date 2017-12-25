<?php include '../system/connect.php';?>
<?php include '../system/helpers.php';?>
<?php 

$offset = $_GET['o'];
$username = $_GET['user'];
$query = $conn->query("SELECT * FROM users WHERE username='$username'");
$row = $query->fetch_assoc();
$usernameid = $row['id'];

$sql =  "SELECT * FROM notifications WHERE toUser='$usernameid' AND fromUser != '$usernameid' ORDER BY id DESC LIMIT $offset,5";

$getposts = $conn->query($sql) or die(mysql_error());

    if($getposts->num_rows > 0) {
        echo '
{
    "notifications": [';
    $i = 0;
        while ($row = $getposts->fetch_assoc()) {
            $id = $row['id'];
            $fromUser = $row['fromUser']; 
            $time_added = $row['time_added'];
            $date_added = $row['date_added'];
            $type = $row['type'];
            $toUser = $row['toUser'];
            $commentId = $row['comment_id'];
            $postId = $row['post_id'];

            $getFrom = $conn->query("SELECT * FROM users WHERE id='$fromUser'");
            $getInfo = $getFrom->fetch_assoc();
            $fromUser_urname = $getInfo['username'];
            $fromPic = $getInfo['profile_pic'];
            if($fromPic == "" || $fromPic == NULL){

            }else{
                $fromPic = "http://www.bruincave.com/m/" . $fromPic;
            }
            $fromFirst = $getInfo['first_name'];
            $fromsex = $getInfo['sex'];
            $getFrom = $conn->query("SELECT * FROM comments WHERE id='$commentId'");
            $getInfo = $getFrom->fetch_assoc();

            $comment = $getInfo['comment'];
            $comment = str_replace("&apos;","'",$comment);
            $comment = str_replace("&lt;","<",$comment);
            $comment = str_replace("&gt;",">",$comment);

            $notifierTime = time_elapsed_string($time_added);

            if($type == '1'){
                $message = "added you to Favorites";   
            }
            else if($type == '2'){
                $message = "roared at your post.";
            }
            else if($type == '3'){
                $message =  "commented: $comment";
            }
            if($fromPic == "" || $fromPic == NULL){
                if($fromsex == "0"){
                    $fromPic = "https://upload.wikimedia.org/wikipedia/commons/3/34/PICA.jpg";
                }
                else{
                    $fromPic = "http://www4.csudh.edu/Assets/CSUDH-Sites/History/images/Faculty-Profile-Pictures/Faculty%20Female%20Default%20Profile%20Picture.jpg";
                }
            }
            $mix = $fromFirst . " " . $message . " " . $notifierTime;
            if($i == 0){
                echo '
                {
                    "id":'.$id.',
                    "body": "'$fromFirst $message.'",
                    "fromPic": "'.$fromPic.'",
                    "postid":'.$postId.',
                    "fromFirst": "'.$fromFirst.'",
                    "from_user":"'.$fromUser_urname.'",
                    "time_added":"'.$notifierTime.'",
                    "type":'.$type.'
                }
    ';          
                $i = $i + 1;
            }else{
                echo '
                ,{
                    "id":'.$id.',
                    "body": "'$fromFirst $message.'",
                    "fromPic": "'.$fromPic.'",
                    "postid":'.$postId.',
                    "fromFirst": "'.$fromFirst.'",
                    "from_user":"'.$fromUser_urname.'",
                    "time_added":"'.$notifierTime.'",
                    "type":'.$type.'
                }
    ';
            }

        }  
echo "
    ]}
";   
    }
?>