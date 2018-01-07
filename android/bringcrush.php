<?php
include "connect.php";

    // Create connection
    $conn = new mysqli($servername, $username1, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    include "../system/helpers.php";

    $offset = $_POST['o'];

    $sql =  "SELECT * FROM crush ORDER BY id DESC LIMIT $offset,5";

    $getposts = $conn->query($sql) or die(mysql_error());

    if($getposts->num_rows > 0) {
        echo '
{
    "crush": [';
    $i = 0;
        while ($row = $getposts->fetch_assoc()) {
            $id = $row['id'];
            $body = $row['body'];
            $body = str_replace("&apos;","'",$body);
            $body = str_replace("&lt;","<",$body);
            $body = str_replace("&gt;",">",$body);
            
            $commentsid = $row['commentsid'];
            $commentsid_array = explode(",", $commentsid);
            $commentsid_count = 0;

            if($commentsid != ""){
                $commentsid_count = count($commentsid_array);
            }

            $time_added = time_elapsed_string($row['time_added']);

            if($i == 0){
                echo '
                {
                    "id":'.$id.',
                    "body": "'.$body.'",
                    "time_added":"'.$time_added.'",
                    "commentscount":"'.$commentsid_count.'"
                }
    ';          
                $i = $i + 1;
            }else{
                echo '
                ,{
                    "id":'.$id.',
                    "body": "'.$body.'",
                    "time_added":"'.$time_added.'",
                    "commentscount":"'.$commentsid_count.'"
                }
    ';
            }
        }
 echo "
    ]}
";
    }

?>