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

$lastanonymous = $_GET['aid'];


$sql =  "SELECT * FROM crush WHERE id > '$lastanonymous' ORDER BY id DESC";

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
        $pic_added";

    }     
}

?>