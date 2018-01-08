<?php
    require "/connect.php";

    $ip = "";

    // Without a proper internet server $ip is not going to work

    if ($_SERVER['HTTP_CLIENT_IP']!="") {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } 
    elseif ($_SERVER['HTTP_X_FORWARDED_FOR']!="") {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    $response = array();
    $user_login = strip_tags(@$_GET['usr']);
    $password_login = strip_tags(@$_GET['psw']);
    $md5password_login = md5($password_login);

    $result = $conn->query("SELECT id FROM users WHERE username='$user_login' AND password='$md5password_login' AND activated='1' LIMIT 1");

    $userCount = $result->num_rows;
    if ($userCount == 1) {
        $response["success"] = true;  
    } 
    echo json_encode($response);
?>