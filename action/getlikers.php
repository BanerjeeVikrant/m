<?php include '../system/connect.php';?>
<?php
$id = 0;
if (isset($_GET['id'])) {
	$id = $_GET['id'];
}

$sql = "SELECT liked_by FROM posts WHERE id = $id";
$post = $conn->query($sql);
$likedby = $post->fetch_assoc();
$likedby = $likedby['liked_by'];

$likedbyArray = explode(",",$likedby);


$likedbyFull = "<img src='img/liked-paw.png' width=18> <span class='likedby-names'>Liked by ";
for ($i=0;$i<count($likedbyArray);$i++) {
    $user = $likedbyArray[$i];
    $query = $conn->query("SELECT id FROM users WHERE id='$user'");
    $row = $query->fetch_assoc();
    $u = $row['id'];
    $likedbyFull = $likedbyFull . "<a style='color:black;font-style: italic' href='profile.php?u=$u'>" . $u . "</a>, ";
}
$likedbyFull = rtrim($likedbyFull, ", ");  //Trim ", " from end of string

if ($likedby == "") {
    $likedbyStr = "<img src='img/liked-paw.png' width=18> <span class='likedby-names'>Be the first to like</span>";
}
else if (count($likedbyArray) > 5) {
    $likes = count($likedbyArray);
    $toreplace = '"' . $likedbyFull . '"';
    $likedbyStr = "
    <script>
    function show_likers_$id() {
        $('.likers_$id').html($toreplace)
    }
    </script>
    <img src='img/liked-paw.png' width=18> <span class='likedby-names'>$likes likes</span>";
}
else {
    //http://localhost/bkm/profile.php?u=test
    $likedbyStr = $likedbyFull;
}

echo $likedbyStr;
?>