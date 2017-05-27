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
    $username = $_GET['u'];

    $checkme = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($checkme->num_rows == 1) {

        $getuser = $checkme->fetch_assoc();
        $yourid = $getuser['id'];
    }else{
        $yourid = "";
    }

    $sql = "SELECT * FROM posts WHERE id='$postid'";
    $getposts = $conn->query($sql);

    $row = $getposts->fetch_assoc();
    $id =  $row['id'];
    $body =  $row['body'];
    $body = str_replace("&apos;","'",$body);
    $body = str_replace("&lt;","<",$body);
    $body = str_replace("&gt;",">",$body);

    $likedby = $row['liked_by'];
    $likedbyArray = explode(",",$likedby);
    $countLikes = count($likedbyArray);
    $likedbynames = "";
    foreach ($likedbyArray as $value) {
        $query = $conn->query("SELECT * FROM users WHERE id='$value'");
        $fetch = $query->fetch_assoc();
        $username = $fetch['username'];
        if($likedbynames != ""){
            $likedbynames =$likedbynames.", ".$username;
        }else{
            $likedbynames =$username;
        }
    }
    
    if($countLikes > 3){
        $moreThanThreeLiker = 1;
    }else if($likedby == ""){
        $moreThanThreeLiker = 2;
    }else{
        $moreThanThreeLiker = 0;
    }
    if(in_array($yourid, $likedbyArray)){
        $likedByMe = 1;
    }else{
        $likedByMe = 0;
    }

    $hidden_post = $row['hidden'];
    $picture_added = "";
    $picture_added = $row['picture'];
    $time_added = $row['time_added'];
    $timestr = time_elapsed_string($time_added);
    $added_by = $row['added_by'];
    $username_posted_to = $row['user_posted_to'];
    $commentsid = $row['commentsid'];

    $sql = "SELECT * FROM users WHERE id='$added_by'"; 
    $result = $conn->query($sql);
    $pic_row  = $result->fetch_assoc();
    $userpic =  "";
    $userpic =  $pic_row['profile_pic'];
    $added_by_username = $pic_row['username'];
    
    $userfirstname = $pic_row['first_name'];
    $userlastname = $pic_row['last_name'];
    //$commentsid = $row['commentsid'];

    $post = $conn->query("SELECT * FROM posts WHERE id='$id'");
    $get_post = $post->fetch_assoc();

    $commentsid = $get_post["commentsid"];

    $commentsid_array = explode(",", $commentsid);

    $commentsid_arrayCount = count($commentsid_array);

    if($commentsid_arrayCount > 3){
        $moreThanThreeComments = 1;
    }else{
        $moreThanThreeComments = 0;
    }
echo '
{
    "post": 
    [';

    echo '{
                "id":'.$id.',
                "body": "'.$body.'",
                "picture_added": "http://www.bruincave.com/m/'.$picture_added.'",
                "userpic": "http://www.bruincave.com/m/'.$userpic.'",
                "name": "'.$userfirstname." ".$userlastname.'",
                "time_added":"'.$timestr.'",
                "moreThanThreeComments":'.$moreThanThreeComments.',
                "likedByMe":'.$likedByMe.',
                "moreThanThreeLiker":'.$moreThanThreeLiker.',
                "likedby":"'.$likedbynames.'",
                "likesCount":'.$countLikes.',
                "username":"'.$added_by_username.'",
                
            ';  

            $commentsArr = "";

            foreach ($commentsid_array as $value) {
                if ($value != '') {
                    $comment = $conn->query("SELECT * FROM comments WHERE id='$value'");

                    $get_comment = $comment->fetch_assoc();

                    $body = $get_comment['comment'];
                    $body = str_replace("&apos;","'",$body);
                    $body = str_replace("&lt;","<",$body);
                    $body = str_replace("&gt;",">",$body);
                    $from_ = $get_comment['from'];

                    $query = $conn->query("SELECT * FROM users WHERE id='$from_'");
                    $row = $query->fetch_assoc();
                    $user = $row['username'];
                    $fromFirst = $row['first_name'];
                    $fromLast = $row['last_name'];
                    $from = $fromFirst." ".$fromLast;
                    $pic = $row['profile_pic'];

                    if ($commentsArr != "") {
                        $commentsArr = $commentsArr.",";
                    }
                    if ($body != "") {

                        $commentsArr .= '
                                        {
                                          "body":"'.$body.'",
                                          "from":"'.$from.'",
                                          "username":"'.$user.'",
                                          "pic":"http://www.bruincave.com/m/'.$pic.'"
                                        }';
                    }
                 }
            }
            echo'
                "comments": ['.$commentsArr.'
                            ]
            }'; 

echo "
    ]
}
";

?>

