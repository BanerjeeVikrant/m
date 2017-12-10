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

            
                echo '
                { 
                    "body": "'.$body.'"
                }';  

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
            echo $commentsArr; 
    }
        
 echo "
    ]}
";
    

?>