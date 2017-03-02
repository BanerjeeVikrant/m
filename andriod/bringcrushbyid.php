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

    $postid = $_POST['postid'];

    $sql =  "SELECT * FROM crush WHERE id='$postid'";

    $getposts = $conn->query($sql) or die(mysql_error());

    if($getposts->num_rows > 0) {
        echo '
{
    "crush": [';
        $row = $getposts->fetch_assoc();
            $id = $row['id'];
            $body = $row['body'];
            $time_added = time_elapsed_string($row['time_added']);

            
                echo '
                {
                    "id":'.$id.',
                    "body": "'.$body.'",
                    "time_added":"'.$time_added.'"
                }
    ';
            }
        
 echo "
    ]}
";
    

?>