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

    $username = $_POST['user'];
    //$profileUser = $_GET['puser'];

/*
    if ($profileUser) {
        $check = $conn->query("SELECT * FROM users WHERE username='$profileUser'");
        if ($check->num_rows == 1) {

            $get = $check->fetch_assoc();
            $id = $get['id'];
            $firstname = $get['first_name'];
            $lastname = $get['last_name'];
            $profilepic = $get['profile_pic'];
            $bannerpic = $get['bannerimg'];
            $followers = $get['followers'];        
            $following = $get['following'];
            $sex = $get['sex'];
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
        }
        if($bannerpic == "" || $bannerpic == NULL){
            
        }else{
            $bannerpic = "http://www.bruincave.com/m/" . $bannerpic;
        }
    }
    */
    $checkme = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($checkme->num_rows == 1) {

        $getuser = $checkme->fetch_assoc();
        $yourid = $getuser['id'];
        $yourfirstname = $getuser['first_name'];
        $yourlastname = $getuser['last_name'];
        $yourprofilepic = $getuser['profile_pic'];
        $yourbannerpic = $getuser['bannerimg'];
        $yourfollowers = $getuser['followers'];
        $yourfollowing = $getuser['following'];
        $yoursex = $getuser['sex'];
        if($yourprofilepic == "" || $yourprofilepic == NULL){
            if($yoursex == "1"){
                $yourprofilepic = "https://upload.wikimedia.org/wikipedia/commons/3/34/PICA.jpg";
            }
            else{
                $yourprofilepic = "http://www4.csudh.edu/Assets/CSUDH-Sites/History/images/Faculty-Profile-Pictures/Faculty%20Female%20Default%20Profile%20Picture.jpg";
            }
        }else{
            $yourprofilepic = "http://www.bruincave.com/m/" . $yourprofilepic;
        }

        if($yourbannerpic == "" || $yourbannerpic == NULL){
            
        }else{
            $yourbannerpic = "http://www.bruincave.com/m/" . $yourbannerpic;
        }
    }

        echo '
{
    "userdata": [
                {
                    "id":'.$yourid.',
                    "firstname": "'.$yourfirstname.'",
                    "lastname": "'.$yourlastname.'",
                    "bannerpic": "'.$yourbannerpic.'",
                    "userpic": "'.$yourprofilepic.'",
                    "name": "'.$yourfirstname. " " .$yourlastname.'"
                }  
    ]
}

';
/*

{
    "profileuserdata": [
                {

                    "id":'.$id.',
                    "firstname": "'.$firstname.'",
                    "lastname": "'.$lastname.'",
                    "bannerpic": "'.$bannerpic.'",
                    "userpic": "'.$profilepic.'",
                    "name": "'.$firstname. " " .$lastname.'"
                }
    ]
}
*/


?>

