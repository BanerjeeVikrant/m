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

$sql =  "SELECT * FROM crush ORDER BY id DESC LIMIT $offset,20";

$getposts = $conn->query($sql) or die(mysql_error());

    if($getposts->num_rows > 0) {
        while ($row = $getposts->fetch_assoc()) {
            $id = $row['id'];
            $body = $row['body'];
            $pic =  $row['picture'];
            $time_added = $row['time_added'];
            $date_added = $row['date_added'];

            $pic_added  = "";
            if($pic != ""){
                //$pic_added = "<img src='$pic' class='crush_pic' />";
                $pic_added = "";
            }
            $back = array("#b04b16","#18177e","#7d4a17","#a3102a","#7749b5","#289f45");
            $randNo = rand(0, (count($back) - 1));
            $rand = $back[$randNo];
            echo "
            <div class = 'crush-post' style='background-color:$rand;'>
                <div style = 'position: relative;'>
                </div>
                <span class = 'topNameCrush'>
                    Anonymous<br>
                    <span class = 'timeCrush'>$time_added<span>, </span>$date_added</span>
                </span>

                <p class = 'msg-body-crush'><span style='font-family: Creepster Caps'>\"</span>$body<span style='font-family: Creepster Caps'>\"</span></p>
            </div>
            $pic_added";

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