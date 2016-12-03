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

//post_id, flagger
$reported_list = "";
$reported_ids = $conn->query("SELECT * FROM report WHERE 1");
if($reported_ids->num_rows > 0) {
    while ($row = $reported_ids->fetch_assoc()) {
        $reported_id = $row['post_id'];
        if($reported_list != ""){
            $reported_list = $reported_list. ",".strval($reported_id);
        }
        else{
            $reported_list = strval($reported_id);
        }
    }
    echo $reported_list;
    $reported_array = explode(",", $reported_list);

    foreach ($reported_array as $postid) {
        //Get post infomation
        //Create the post
    }
}


?>