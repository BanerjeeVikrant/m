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

$sql =  "SELECT * FROM crush ORDER BY id DESC LIMIT $offset,20";

$getposts = $conn->query($sql) or die(mysql_error());

    if($getposts->num_rows > 0) {
        while ($row = $getposts->fetch_assoc()) {
            $id = $row['id'];
            $body = $row['body'];
            $pic =  $row['picture'];
            $time_added = time_elapsed_string($row['time_added']);

            $pic_added  = "";
            if($pic != ""){
                //$pic_added = "<img src='$pic' class='crush_pic' />";
                $pic_added = "";
            }
            $back = array("#1E2F4E","#465876","#687791"); //,"#7749b5","#289f45");
            $randNo = rand(0, (count($back) - 1));
            $rand = $back[$randNo];

            $commentsid = $row['commentsid'];

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
                    <div class = 'anoncomment-body'>
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
            <div class = 'crush-post' style='background-color:$rand;' anonid = '$id'>
                <div style = 'position: relative;'>
                </div>
                <span class = 'topNameCrush'>
                    Anonymous<br>
                    <span class = 'timeCrush'>$time_added<span>
                </span>

                <p class = 'msg-body-crush'><span style='font-family: Creepster Caps'>\"</span>$body<span style='font-family: Creepster Caps'>\"</span></p>
            </div>
            <textarea style = 'display: none;' id = 'comments-send'></textarea>
            <div class = 'comments-input'>
                <div style = 'position: relative;'>
                    <form method = 'POST' class='post-comment'>
                        <input type = 'text' name = 'comment' placeholder = 'Write a Comment&hellip;' class = 'anoncomment-inputs' autocomplete = 'off' />
                        <input type = 'text' name = 'id' value = '$id' style = 'display: none;' />
                        <input type = 'submit' id = 'commentid' name = 'commentid' style = 'display: none;'/>        
                    </form>        
                </div>        
            </div>
            $commentShownBox

            <div class = 'old-comment-box'>";

            for ($i = 0; $i < $commentsCount - $defaultCommentsCount; $i++) {
                $value = $commentsArray[$i];
                $getCommentQuery = $conn->query("SELECT * FROM anoncomments WHERE id='$value' LIMIT 1");
                $getCommentRow = $getCommentQuery->fetch_assoc();
                $commentPost = $getCommentRow['comment'];
                $commentpostedby =  $getCommentRow['from'];
                echo "                
                <div style = 'position: relative;'>                        
                    <div class = 'anoncomment-body'>
                        <div class = 'comments-img'></div>
                        <div class = 'comment-area'>
                            <div style = 'position: relative;'>
                                <div class = 'commentPosted'>
                                    <a style='position: relative;'>Anonymous</a>&nbsp;&nbsp;&nbsp;$commentPost
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
                $getCommentQuery = $conn->query("SELECT * FROM anoncomments WHERE id='$value' LIMIT 1");
                $getCommentRow = $getCommentQuery->fetch_assoc();
                $commentPost = $getCommentRow['comment'];
                $commentpostedby =  $getCommentRow['from'];
                $getUser = $conn->query("SELECT * FROM users WHERE username = '$commentpostedby'");
                $getfetch = $getUser->fetch_assoc();
                $userpic = $getfetch['profile_pic'];
                echo "                
                <div style = 'position: relative;'>                        
                    <div class = 'anoncomment-body'>
                        <div class = 'comments-img'></div>
                        <div class = 'comment-area'>
                            <div style = 'position: relative;'>
                                <div class = 'commentPosted'>
                                    <a style='position: relative;'>Anonymous</a>&nbsp;&nbsp;&nbsp;$commentPost
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                ";
            }

            echo "        
        </div>
        </div>
        ";


        }     
    } else {
        echo "        
        <div style = 'position: relative;'>
            <div class = 'profile-post' id='last_crush' style ='position: absolute;'>
                <span><span class  = 'glyphicon glyphicon-share-alt'></span> No more Feeds!<span>
            </div>
        </div><script>document.getElementById('loading-img-crush').remove();</script>
        ";
    }
?>

<script type="text/javascript">
    $('.post-comment').submit(function(e){
        e.preventDefault();
        var curr_position = $(this).closest('.post-comment');
        postanoncomment(curr_position);
        e.unbind();
    });
</script>