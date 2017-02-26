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

    $post = $_POST['post'];
    $username = $_POST['u'];

    $checkme = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($checkme->num_rows == 1) {
        $getuser = $checkme->fetch_assoc();
        $usernameid = $getuser['id'];
    }
 
    if($post != ""){
        date_default_timezone_set("America/Los_Angeles");
        $date_added = '';
        $time_added = time(); 
        $added_by = $username;

        $sqlcommand = "INSERT INTO crush VALUES ('', '$post', '$usernameid', '', '$time_added', '$date_added','')";
        $query = $conn->query($sqlcommand);
    }

    $response["success"] = true; 
    echo json_encode($response);

?>