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

    $offset = $_POST['o'];
    $username = $_POST['user'];
    $profileUser = $_POST['puser'];
    $group = $_POST['group'];

    if ($profileUser) {
        $check = $conn->query("SELECT * FROM users WHERE username='$profileUser'");
        if ($check->num_rows == 1) {

            $get = $check->fetch_assoc();
            $firstname = $get['first_name'];
            $lastname = $get['last_name'];
            $profilepic = $get['profile_pic'];
            $followers = $get['followers'];        
            $following = $get['following'];
        }
    }
    $checkme = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($checkme->num_rows == 1) {

        $getuser = $checkme->fetch_assoc();
        $yourfirstname = $getuser['first_name'];
        $yourlastname = $getuser['last_name'];
        $yourprofilepic = $getuser['profile_pic'];
        $yourfollowers = $getuser['followers'];
        $yourfollowing = $getuser['following'];
    }

    if (!isset($profileUser)) {
        $yourfollowing_arr =  explode(',',$yourfollowing);
        $yourfollowing_quoted = "'".implode("','",$yourfollowing_arr)."'";
        if (!$group) {
            $sql = "SELECT * FROM posts WHERE ((added_by IN ($yourfollowing_quoted) AND posted_to = '0') OR (added_by = '$usernameid' AND posted_to = '0') AND (post_group = '0')) ORDER BY id DESC LIMIT $offset,20";
        }
        else {
            $sql = "SELECT * FROM posts WHERE (post_group = '$group') ORDER BY id DESC LIMIT $offset,20";
        }
       
    } else {
        $sql =  "SELECT * FROM posts WHERE (added_by = '$profileUserid' AND posted_to = '1') OR (user_posted_to = '$profileUserid') ORDER BY id DESC LIMIT $offset,20";

    }
    $getposts = $conn->query($sql) or die(mysql_error());
/*
    if($getposts->num_rows > 0) {
        echo "
{
    'home': [";
        while ($row = $getposts->fetch_assoc()) {

            $id =  $row['id'];
            $body =  $row['body'];
            $likedby = $row['liked_by'];
            $picture_added = $row['picture'];
            $time_added = $row['time_added'];
            //$commentsid = $row['commentsid'];
            echo "
            {
                'id': '$id',
                'body': '$body',
                'picture_added': '$picture_added',
                'time_added': '$time_added',
            },
";
        }
        echo "
    ]
}";
    }
*/

echo '
{
    "feed": [
        {
            "id": 1,
            "name": "National Geographic Channel",
            "image": "http://api.androidhive.info/feed/img/cosmos.jpg",
            "status": "\"Science is a beautiful and emotional human endeavor,\" says Brannon Braga, executive producer and director. \"And Cosmos is all about making science an experience.\"",
            "profilePic": "http://api.androidhive.info/feed/img/nat.jpg",
            "timeStamp": "1403375851930",
            "url": null
        },
        {
            "id": 2,
            "name": "TIME",
            "image": "http://api.androidhive.info/feed/img/time_best.jpg",
            "status": "30 years of Cirque du Soleil's best photos",
            "profilePic": "http://api.androidhive.info/feed/img/time.png",
            "timeStamp": "1403375851930",
            "url": "http://ti.me/1qW8MLB"
        },
        {
            "id": 5,
            "name": "Abraham Lincoln",
            "image": null,
            "status": "That some achieve great success, is proof to all that others can achieve it as well",
            "profilePic": "http://api.androidhive.info/feed/img/lincoln.jpg",
            "timeStamp": "1403375851930",
            "url": null
        },
        {
            "id": 3,
            "name": "Discovery",
            "image": "http://api.androidhive.info/feed/img/discovery_mos.jpg",
            "status": "A team of Austrian scientists has developed a laser system that causes fruit flies to dance.",
            "profilePic": "http://api.androidhive.info/feed/img/discovery.jpg",
            "timeStamp": "1403375851930",
            "url": "http://dsc.tv/xmMxD"
        },
        {
            "id": 4,
            "name": "Ravi Tamada",
            "image": "http://api.androidhive.info/feed/img/nav_drawer.jpg",
            "status": "Android Sliding Menu using Navigation Drawer",
            "profilePic": "http://api.androidhive.info/feed/img/ravi_tamada.jpg",
            "timeStamp": "1403375851930",
            "url": "http://www.androidhive.info/2013/11/android-sliding-menu-using-navigation-drawer/"
        },
        {
            "id": 6,
            "name": "KTM",
            "image": "http://api.androidhive.info/feed/img/ktm_1290.jpg",
            "status": "\"The Beast\" KTM 1290 Super Duke",
            "profilePic": "http://api.androidhive.info/feed/img/ktm.png",
            "timeStamp": "1403375851930",
            "url": ""
        },
        {
            "id": 7,
            "name": "Harley-Davidson",
            "image": "http://api.androidhive.info/feed/img/harley_bike.jpg",
            "status": "Weâ€™re assembling riders of every style, bike, and passion. If you ride with conviction, ride with us. You have 24 days to get ready for World Ride. Prepare by visiting:",
            "profilePic": "http://api.androidhive.info/feed/img/harley.jpg",
            "timeStamp": "1403375851930",
            "url": "http://bit.ly/1wmBWaN"
        },
        {
            "id": 8,
            "name": "Rock & Girl",
            "image": "http://api.androidhive.info/feed/img/rock.jpg",
            "status": "A long time back...",
            "profilePic": "http://api.androidhive.info/feed/img/rock_girl.jpg",
            "timeStamp": "1403375851930",
            "url": ""
        },
        {
            "id": 8,
            "name": "Gandhi",
            "image": null,
            "status": "An eye for an eye will make the whole world blind.",
            "profilePic": "http://api.androidhive.info/feed/img/gandhi.jpg",
            "timeStamp": "1403375851930",
            "url": ""
        },
        {
            "id": 9,
            "name": "LIFE",
            "image": "http://api.androidhive.info/feed/img/life_photo.jpg",
            "status": "In 1965, LIFE photographer Bill Ray spent weeks with the Hells Angels, but his amazing photos never ran in the magazine",
            "profilePic": "http://api.androidhive.info/feed/img/life.jpg",
            "timeStamp": "1403375851930",
            "url": "http://ti.me/1rfcQa4"
        },
        {
            "id": 10,
            "name": "Shakira",
            "image": "http://api.androidhive.info/feed/img/shakira_la_la.png",
            "status": "Download La La La (Brazil 2014) from iTunes:",
            "profilePic": "http://api.androidhive.info/feed/img/shakira.jpg",
            "timeStamp": "1403375851930",
            "url": "http://smarturl.it/FWCalbum?IQid=sh"
        },
        {
            "id": 11,
            "name": "A. R. rahman",
            "image": "http://api.androidhive.info/feed/img/ar_bw.jpg",
            "status": "",
            "profilePic": "http://api.androidhive.info/feed/img/ar.jpg",
            "timeStamp": "1403375851930",
            "url": ""
        }
    ]
}
';
?>