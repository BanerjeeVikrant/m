<?php
require "../system/connect.php";

session_start();
if (isset($_SESSION['user_login'])) {
	$username = $_SESSION['user_login'];
}
else{
	$username = "";
}

if(isset($_GET['id'])){
	$id = $_GET['id'];

	$getphotos = $conn->query("SELECT * FROM photos WHERE id='$id'");

	if($getphotos->num_rows == 1) {
		$row = $getphotos->fetch_assoc();

		$postid = $row['post_id'];
		$photo_link = $row['photo_link'];
		$photoSender = $row['username'];
		$pic = "<img src = '$photo_link' class = 'posted-pic'></img>";

		$getUser = $conn->query("SELECT * FROM users WHERE username='$photoSender'");
		$getU = $getUser->fetch_assoc();

		$time_added = 
		$date_added = date("m/d/Y");
		$userpic = $getU['profile_pic'];
		$firstname = $getU['first_name'];
		$lastname = $getU['last_name'];
		$topName = "<a href = 'profile.php?u=$photoSender' class = 'samepostedby'>$firstname $lastname</a>";

		$sql = "SELECT * FROM posts WHERE id='$postid'";
		$getpost = $conn->query($sql);
		if($getpost->num_rows == 1) {
			$get = $getpost->fetch_assoc();
			$body = $get['body'];
			$time_added = $get['time_added'];
			$date_added = $get['date_added'];
			$commentsid = $get['commentsid'];
			$likedby = $get['liked_by'];

			$commentsArray = explode(",",$commentsid);
			$likedbyArray = explode(",",$likedby);

			if(in_array($username, $likedbyArray)){
				$userliked = "<div class = 'like-btn-div'><div id='like-btn-$id' class = 'liked' onclick = 'unlikePost($id);'></div></div>";
			}
			else{
				$userliked = "<div class = 'like-btn-div'><div id='like-btn-$id' class = 'notliked' onclick = 'likePost($id);'></div></div>";
			}

		}
		echo "
		<div class='topbar-userimages'>
			<div class='back-img' id='back-photos'></div>
			<div class='userimages-name'>$firstname's Photo Uploads</div>
		</div>
		<div class = 'profile-post'>
			<div style = 'position: relative;'>
				<div class = 'glyphicon glyphicon-option-vertical post-options'>
					<div class = 'postoptions-div' style = 'display: none; position: absolute;top: 19px;left:-113px;background-color: #F3F3F3;width: 126px;height: 90px;'>

						<div class = 'hide-post post-work' style = ''> <span class = 'glyphicon glyphicon-lock'></span> Hide</div>
						<div class = 'delete-post post-work' style = ''> <span class = 'glyphicon glyphicon-remove'></span> Delete</div>
						<div class = 'report-post post-work' style = ''> <span class = 'glyphicon glyphicon-flag'></span> Report</div>
					</div>
				</div>
			</div>
			<div class = 'posted-by-img' style = 'background-image: url($userpic);'></div>
			<span class = 'topName'>
				$topName<br>
				<span class = 'time'>$time_added<span>, </span>$date_added</span>
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
			";

				foreach ($commentsArray as $value) {
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
		<script>
			$('#back-photos').click(function(){
				$('#fullscreen-img-wrapper').hide('slide', { direction: 'left' }, 200);
			});
		</script>
		";
	}
}

?>
