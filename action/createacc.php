<?php

require "../system/connect.php";

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


//declaring variables to prevent errors
$fn = "";
$ln = "";
$un = "";
$em = "";
$pswd = "";
$pswd2 = "";
$dob = "";
$gender = "";
$grade = "";
$stuid = "";
$num = "";
//registration form
$fn = strip_tags(@$_POST['fn']);
$ln = strip_tags(@$_POST['ln']);
$usr = strip_tags(@$_POST['usr']);
$em = strip_tags(@$_POST['email']);
$pswd = strip_tags(@$_POST['psw']);
$pswd2 = strip_tags(@$_POST['psw2']);
$dob = strip_tags(@$_POST['dob']);
$gender = strip_tags(@$_POST['gender']);
$grade = strip_tags(@$_POST['grade']);
$stuid = strip_tags(@$_POST['stuid']);
$num = strip_tags(@$_POST['num']);

$d = date("m/d/y");
$t = time();
        

$pswdmd5 = md5($pswd);
$sql = "INSERT INTO users VALUES ('', '$usr', '$fn', '$ln', '$stuid', '$pswdmd5', '$d', '', '', '', '', '', '$gender', '$dob', '0', '', '', '', '', '$grade', '$ip', '$ip', '$ip', '1', '$d', '$t', '0', '1', '', '')";
$conn->query($sql);


