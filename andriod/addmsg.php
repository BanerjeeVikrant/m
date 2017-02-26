<?php
    $servername = "localhost";
    $username1 = "root";
    $password = "H@ll054321";
    $dbname = "bruincaveData";

    // Create connection
    $conn = new mysqli($servername, $username1, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    include "../system/helpers.php";

    $msg = $_POST['message'];
    $username = $_POST['u'];

    $checkme = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($checkme->num_rows == 1) {
        $getuser = $checkme->fetch_assoc();
        $usernameid = $getuser['id'];
    }

    $toUser = $_POST['touser'];

    $checkUser = $conn->query("SELECT * FROM users WHERE username='$toUser'");
    if ($checkme->num_rows == 1) {
        $getuser = $checkUser->fetch_assoc();
        $sendto = $getuser['id'];
    }

    $getSender = $conn->query("SELECT * FROM users WHERE id = '$sendto'");
    $get = $getSender->fetch_assoc();
    $sendingto = $get['username'];
    $sendingtoid = $get['id'];
    $dmfriends2 = $get['dmfriends'];

    $getSender = $conn->query("SELECT * FROM users WHERE username = '$username'");
    $get = $getSender->fetch_assoc();

    $dmfriends = $get['dmfriends'];
    $id = $get['id'];
    $time = time();

    $msg = str_replace("'","&apos;",$msg);
    $msg = str_replace("<","&lt;",$msg);
    $msg = str_replace(">","&gt;",$msg);

    if ($msg) {
        $getUser = $conn->query("INSERT INTO messages VALUES('', '$id', '$sendto', '$msg', '$time')");
    }


    $dmfriendsArray = explode(",",$dmfriends);
    $dmfriendsArrayCount = count($dmfriendsArray);
    $dmfriendsArrayNow = []; 
    $j = 0;

    for ($i=0; $i < $dmfriendsArrayCount; $i++) {
        if ($dmfriendsArray[$i] != $sendingtoid) {
            $dmfriendsArrayNow[$j++] = $dmfriendsArray[$i];
        }
    }
    $dmfriendsNow = join(',',$dmfriendsArrayNow);
    if($dmfriendsNow == ""){
        $dmfriendsNow1 = $sendingtoid;
    }
    else{
        $dmfriendsNow1 = $sendingtoid . "," . $dmfriendsNow;
    }


    $sql = "UPDATE users SET dmfriends='$dmfriendsNow1' WHERE id='$usernameid'";
    $removeFriendsQuery = $conn->query($sql);


    $dmfriends2Array = explode(",",$dmfriends2);
    $dmfriends2ArrayCount = count($dmfriends2Array);
    $dmfriends2ArrayNow = []; 
    $j = 0;

    for ($i=0; $i < $dmfriends2ArrayCount; $i++) {
        if ($dmfriends2Array[$i] != $usernameid) {
        $dmfriends2ArrayNow[$j++] = $dmfriends2Array[$i];
        }
    }
    $dmfriends2Now = join(',',$dmfriends2ArrayNow);

    if($dmfriends2Now == ""){
        $dmfriends2Now1 = $usernameid;
    }
    else{
        $dmfriends2Now1 = $usernameid . "," . $dmfriends2Now;
    }

    $sql = "UPDATE users SET dmfriends='$dmfriends2Now1' WHERE id='$sendingtoid'";

    $removeFriendsQuery = $conn->query($sql);

    $response["success"] = true; 
    echo json_encode($response);

?>