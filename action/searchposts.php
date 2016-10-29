<?php
require "../system/connect.php";
session_start();
if (isset($_SESSION['user_login'])) {
	$username = $_SESSION['user_login'];
}
else{
	$username = "";
}
$search = $_GET["search"];
$hashtag = "#".$search;
$search_parts = explode(" ", $search);
if (count($search_parts) == 1) {
	$sql = "SELECT * FROM hashtags WHERE (word LIKE '$hashtag%')";
	$results = $conn->query($sql);
	if($results->num_rows == 1){
		$get = $results->fetch_assoc();
		$postids = $get["post_ids"];

		$sql = "SELECT * FROM posts WHERE id IN ($postids) ORDER BY id DESC";


		$getposts = $conn->query($sql) or die(mysql_error());
		$tags = array();

		if($getposts->num_rows > 0) {
			while ($row = $getposts->fetch_assoc()) {
				$id = $row['id'];
				$hidden = $row['hidden'];
				if($hidden == '1'){
					continue;
				}
				$body = $row['body'];        

				/* //$body = identifyTagsInMsg($body);*/
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


						$topName = "<a href = 'profile.php?u=$added_by' class = 'samepostedby'>$userfirstname $userlastname</a>";


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
						$vid
						$youtube
					</div>

					<div class = 'comments-box'>
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
					</div>";

				}        
			}

		}
	} else {
		echo "";
	}
	
	if($results->num_rows > 0){
		while ($row = $results->fetch_assoc()) {
			$username = $row["username"];
			$firstname = $row["first_name"];
			$lastname = $row["last_name"];
			$profilepic = $row["profile_pic"];
			$lastonline_date = $row["last_online_date"];
			$lastonline_time = $row["last_online_time"];

			echo "
			<a href='profile.php?u=$username'><div class='search-layer'>
				<div style='position:relative;display: inline-block;'>
					<div class='search-userpic' style='background-image:url($profilepic)'></div>
				</div>
				<div class='search-name'>$firstname $lastname</div>
				<div class='search-time'>Last online 3h ago</div>
			</div></a>
			";
		}
	}
	?>