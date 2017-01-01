<?php
    $servername = "localhost";
    $username1 = "root";
    $password = "H@ll054321";
    $dbname = "bruincavedata";


    // Create connection
    $conn = new mysqli($servername, $username1, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $fn = strip_tags(@$_POST['fn']);
    $ln = strip_tags(@$_POST['ln']);
    $usr = strip_tags(@$_POST['usr']);
    $em = strip_tags(@$_POST['email']);
    $pswd = strip_tags(@$_POST['psw']);
    $pswd2 = strip_tags(@$_POST['psw2']);
    $dob = strip_tags(@$_POST['dob']);
    $gender = strip_tags(@$_POST['gender']);
    if($gender == "Male"){
        $gender = 1;
    }
    else if($gender == "Female"){
        $gender = 2;
    }

    $grade = strip_tags(@$_POST['grade']);
    $stuid = strip_tags(@$_POST['stuid']);
    $num = strip_tags(@$_POST['num']);

    $d = date("m/d/y");
    $t = time();



    $statement = $conn->query("INSERT INTO users VALUES ('', '$usr', '$fn', '$ln', '$stuid', '$pswdmd5', '$d', '', '', '', '', '', '$gender', '$dob', '0', '', '', '', '', '0', '$grade', '$ip', '$ip', '$ip', '1', '$d', '$t', '0', '1', '', '')");

    
    $response = array();
    $response["success"] = true;  
    
    echo json_encode($response);
?>