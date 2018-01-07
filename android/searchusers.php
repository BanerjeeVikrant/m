<?php
include "connect.php";
    // Create connection
    $conn = new mysqli($servername, $username1, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $search = $_POST["s"];
    $username = $_POST['user'];
    $results = $conn->query("SELECT * FROM users WHERE username='$username'");
    $rowget = $results->fetch_assoc();
    $usernameid = $rowget['id'];

    $search_parts = explode(" ", $search);
    if (count($search_parts) == 1) {
        $sql = "SELECT * FROM users WHERE (username LIKE '$search%') OR (first_name LIKE '$search%') OR (last_name LIKE '$search%')";
    } else {
        $exp_first_name = $search_parts[0];
        $exp_last_name = $search_parts[1];
        $sql = "SELECT * FROM users WHERE (first_name LIKE '$exp_first_name%') AND (last_name LIKE '$exp_last_name%')";
    }
            echo '
{
    "usersMsg": [';
    $i = 0;
    $results = $conn->query($sql);
    if($results->num_rows > 0) {
        while ($row = $results->fetch_assoc()) {
            $id = $row["id"];
            $usernamenew = $row["username"];
            if($username == $usernamenew){
                continue;
            }
            $firstname = $row["first_name"];
            $lastname = $row["last_name"];
            $profilepic = $row["profile_pic"];
            if($profilepic == "" || $profilepic == NULL){
                if($sex == "1"){
                    $profilepic = "https://upload.wikimedia.org/wikipedia/commons/3/34/PICA.jpg";
                }
                else{
                    $profilepic = "http://www4.csudh.edu/Assets/CSUDH-Sites/History/images/Faculty-Profile-Pictures/Faculty%20Female%20Default%20Profile%20Picture.jpg";
                }
            }else{
                $profilepic = "http://www.bruincave.com/m/" . $profilepic;
            }

            $followersList = $row["followers"];

            $followersList_array = explode(",", $followersList);
            $grade = $row['grade'];
            if($grade == 9){
                $grade = "Freshman";
            }else if($grade == 10){
                $grade = "Sophomore";
            }else if($grade == 11){
                $grade = "Junior";
            }else if($grade == 12){
                $grade = "Senior";
            }
            if(in_array($usernameid, $followersList_array)){
                $followingUser = 1;
            } else {
                $followingUser = 0;
            }

            $lastonline_date = $row["last_online_date"];
            $lastonline_time = $row["last_online_time"];
            $sex = $row['sex'];
            if($profilepic == "" || $profilepic == NULL){
                if($sex == "1"){
                    $profilepic = "https://upload.wikimedia.org/wikipedia/commons/3/34/PICA.jpg";
                }
                else{
                    $profilepic = "http://www4.csudh.edu/Assets/CSUDH-Sites/History/images/Faculty-Profile-Pictures/Faculty%20Female%20Default%20Profile%20Picture.jpg";
                }
            }
            if($i == 0){
                echo '
                {
                    "id":'.$id.',
                    "fromPic": "'.$profilepic.'",
                    "name": "'.$firstname." ".$lastname.'",
                    "class": "'.$grade.'",
                    "following":'.$followingUser.'
                }
    ';          
                $i = $i + 1;
            }else{
                echo '
                ,{
                    "id":'.$id.',
                    "fromPic": "'.$profilepic.'",
                    "name": "'.$firstname." ".$lastname.'",
                    "class": "'.$grade.'",
                    "following":'.$followingUser.'
                }
    ';
            }
        }
    } 
echo "
    ]}
";
?>