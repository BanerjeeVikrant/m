<?php
    $servername = "localhost";
    $username1 = "root";
    $password = "";
    $dbname = "bruincaveData";

    // Create connection
    $conn = new mysqli($servername, $username1, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    include "../system/helpers.php";

    $postid = $_GET['postid'];

    $sql =  "SELECT * FROM crush WHERE id='$postid'";

    $getposts = $conn->query($sql) or die(mysql_error());

    if($getposts->num_rows > 0) {
        echo '
{
    "crush": [';
        $row = $getposts->fetch_assoc();
            $id = $row['id'];
            $body = $row['body'];
            $commentsid = $row['commentsid'];
            $commentsid_array = explode(",", $commentsid);
            $time_added = time_elapsed_string($row['time_added']);

            
                echo '
                {
                    "id":'.$id.',
                    "body": "'.$body.'",
                    "time_added":"'.$time_added.'",

                ';  

            $commentsArr = "";

            foreach ($commentsid_array as $value) {
                if ($value != '') {
                    $comment = $conn->query("SELECT * FROM anoncomments WHERE id='$value'");

                    $get_comment = $comment->fetch_assoc();

                    $body = $get_comment['comment'];


                    if ($commentsArr != "") {
                        $commentsArr = $commentsArr.",";
                    }
                    if ($body != "") {

                        $commentsArr .= "
                                        {
                                          'body':'$body'
                                        }";
                    }
                 }
            }
            echo'
                "comments": ['.$commentsArr.'
                            ]
            }'; 
    }
        
 echo "
    ]}
";
    

?>