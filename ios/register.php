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

    $fn = strip_tags(@$_POST['fn']);
    $ln = strip_tags(@$_POST['ln']);
    $usr = strip_tags(@$_POST['usr']);
    $em = strip_tags(@$_POST['email']);
    $pswd = strip_tags(@$_POST['psw']);
    $pswd2 = strip_tags(@$_POST['psw2']);
    $dob = strip_tags(@$_POST['dob']);
    $grade = strip_tags(@$_POST['grade']);
    $stuid = strip_tags(@$_POST['stuid']);

    if($grade == "Freshman"){
        $grade = 9;
    }else if($grade == "Sophomore"){
        $grade = 10;
    }else if($grade == "Junior"){
        $grade = 11;
    }else{
        $grade = 12;
    }

    $d = date("m/d/y");
    $t = time();

    $pswd_md5 = md5($pswd);



    $statement = $conn->query("INSERT INTO users VALUES ('', '$usr', '$fn', '$ln', '$stuid', '$pswd_md5', '$d', '', '', '', '', '', '', '$dob', '0', '', '', '', '', '0', '$grade', '$ip', '$ip', '$ip', '1', '$d', '$t', '0', '1', '', '')");

$success = true;
    
echo '
{
    "register": [';
    
                echo '
                {
                    "loginError":'.$success.'
                }
    ';          
 echo "
    ]}
";
?>