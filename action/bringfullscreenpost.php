<?php
require "../system/connect.php";
require '../system/helpers.php';

session_start();
if (isset($_SESSION['user_login'])) {
	$username = $_SESSION['user_login'];
	$query = $conn->query("SELECT * FROM users WHERE username='$username'");
    $row = $query->fetch_assoc();
    $usernameid = $row['id'];
}
else{
	$username = "";
}

if(isset($_GET['id'])){
	$id = $_GET['id'];

	$getphotos = $conn->query("SELECT * FROM posts WHERE id='$id'");

	if($getphotos->num_rows == 1) {
		$row = $getphotos->fetch_assoc();

		$photo_link = $row['picture'];
		$photoSender = $row['added_by'];
		$body = $row['body'];
		$time_added = $row['time_added'];
		$date_added = $row['date_added'];
		$commentsid = $row['commentsid'];
		$likedby = $row['liked_by'];
		$commentsid = $row['commentsid'];

		$commentsArray = explode(",",$commentsid);
		$likedbyArray = explode(",",$likedby);

		$timesincestr = time_elapsed_string($time_added);

		if(in_array($usernameid, $likedbyArray)){
			$userliked = "<div class = 'like-btn-div'><div id='like-btn-$id' class = 'liked' onclick = 'unlikePost($id);'></div></div>";
		}
		else{
			$userliked = "<div class = 'like-btn-div'><div id='like-btn-$id' class = 'notliked' onclick = 'likePost($id);'></div></div>";
		}
		$pic = "";
		if($photo_link != ""){
			$pic = "<img src = '$photo_link' class = 'posted-pic'></img>";
		}

		$getUser = $conn->query("SELECT * FROM users WHERE id='$photoSender'");
		$getU = $getUser->fetch_assoc();
		$photoSender_usr = $getU['username'];
		$userpic = $getU['profile_pic'];
		$firstname = $getU['first_name'];
		$lastname = $getU['last_name'];
		$topName = "<a href = 'profile.php?u=$photoSender_usr' class = 'samepostedby'>$firstname $lastname</a>";

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
			<div class='topbar-userimages'>
				<div class='back-img' id='back-photos'></div>
				<div class='userimages-name'>$firstname's Post</div>
			</div>
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


                <div class = 'comment-body likers_$id' onclick='show_likers_$id()' style='font-size:13px;padding-left:10px;padding-bottom:10px;padding-top:10px'></div>

                <script>
                posturl = 'action/getlikers.php?id=$id';
                $.ajax({url: posturl, success: function(result){
                        $('.likers_$id').html(result);
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
					$getUser = $conn->query("SELECT * FROM users WHERE id = '$commentpostedby'");
					$getfetch = $getUser->fetch_assoc();
					$userpic = $getfetch['profile_pic'];
					$commentpostedby_user = $getfetch['username'];
					echo "                
					<div style = 'position: relative;'>                        
						<div class = 'comment-body'>
							<div class = 'comments-img'></div>
							<div class = 'comment-area'>
								<div style = 'position: relative;'>
									<div class = 'commentPosted'>
										<a style='position: relative;' href = 'profile.php?u=$commentpostedby_user'>$commentpostedby_user</a>&nbsp;&nbsp;&nbsp;$commentPost
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
                    $getUser = $conn->query("SELECT * FROM users WHERE id = '$commentpostedby'");
                    $getfetch = $getUser->fetch_assoc();
                    $userpic = $getfetch['profile_pic'];
                    $commentpostedby_user = $getfetch['username'];
                    echo "                
                    <div style = 'position: relative;'>                        
                        <div class = 'comment-body'>
                            <div class = 'comments-img'></div>
                            <div class = 'comment-area'>
                                <div style = 'position: relative;'>
                                    <div class = 'commentPosted'>
                                        <a style='position: relative;' href = 'profile.php?u=$commentpostedby_user'>$commentpostedby_user</a>&nbsp;&nbsp;&nbsp;$commentPost
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

			echo "        
		</div>
		<script>
			$('#back-photos').click(function(){
				$('#fullscreen-img-wrapper').hide('slide', { direction: 'left' }, 200);
			});
		</script>
		";
	}
}

?>
		<script>

			$('.post-comment').submit(function(e){
				e.preventDefault();
				var curr_position = $(this).closest('.post-comment');
				postcomment(curr_position);
				e.unbind();
			});

            var boxOpen = false;

			function openOptions(postid){
                var newElem="";
                newElem += "<div class='optionBox-wrapper'><div class='optionBox' pid='"+postid+"'>";
                newElem += "    <div class='optionsPost' id='deletepost' onclick='deletepost("+postid+");'>Delete<\/div>";
                newElem += "    <div class='optionsPost' id='reportpost' onclick='reportpost("+postid+");'>Report<\/div>";
                newElem += "<\/div><\/div>";

                if(boxOpen == false){
                    $("#anyreport").prepend(newElem);
                    boxOpen = true;
                }
            }


			$(".post-options").click(function() {
                var postid = $(this).attr("id");
                openOptions(postid);
			});

            $(".old-comment-box").hide();

            $(".view-more").click(function(){
                $(this).next().show();
                $(this).hide();
            });

		</script>
