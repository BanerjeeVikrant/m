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
$username = $_GET['u'];
$results = $conn->query("SELECT * FROM users WHERE username='$username'");
$rowget = $results->fetch_assoc();
$usernameid = $rowget['id'];
$usernamegrade = $rowget['grade'];

$post = $_GET['caption'];

if(isset($_GET['image'])){
	$now = DateTime::createFromFormat('U.u', microtime(true));
	$id = $now->format('YmdHisu');
	date_default_timezone_set("America/Los_Angeles");
	$date_added = date("Y/m/d");
	$added_by = $username;
	$time_added = time();

	$upload_folder = "../userdata/pictures/$username";
	if (!file_exists("../userdata/pictures/$username")){
		mkdir("../userdata/pictures/$username");
		mkdir("../userdata/pictures/$username/thumbnail");
	}
	$path = "../userdata/pictures/$username/$randomtest.jpg";
	$image = '/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEB
AQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/2wBDAQEBAQEBAQEBAQEBAQEBAQEBAQEB
AQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/wAARCAAkACQDASIA
AhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQA
AAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3
ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWm
p6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEA
AwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSEx
BhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElK
U1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3
uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD+zzX9
f8OeEND1XxL4p1nTPDvh/RbOXUdY1zWr620zSdM0+3Rnub3UNRvJobaztoUw0k88ixqPvuDtWv5+
v2lv+C+Pw/8ABmrvoP7Ofw5uPGUdhq1zZ6l47+IsF1onhK4gtLmGBW0fR9P1a21zytRW6glt5dcm
0nW7JpLe3vvCgubmKI+Df8F0/wDgoppNt4e1L9kT4W6u8OpWeoaLcfFrxK+q6Ta+HRe6m81p4U8C
PeW93e3EVzYak7eKvEbalb6VFpV7omg2h1B4p9Tlt/5Pr7xBezaHruq6xeynWLUXEkljGbm2jgs0
twk15ZxXEdnJHb3flNKm1Zhpt0lzNaJeah54mAP7c/gd/wAF+/2XvHWm2/8Awtzwxrfw21EzW8Nx
e+G7x/iB4cRBJFb3t6/2fTdB8R2yW8hluRZQ6BqNwLKKRYri4vRHbSfsL8Kvj/8ABz41/Dm2+K/w
18daJ4l8DXH21W123neCGxm05XbUbTWLe+jtbvRLyy2tJPbarDbTC1e0vVU21xaTP/lWLrWn+IL6
41e7v9R0++ZEsIrwX0Wy5to3Zlu7W5MYigYwsLeW0IkjkuI47g3EKSz3kfsPww/ae+NvwCbUfD/w
/wDih4t8N+DNY1vTrzxLoJ1S5n03Xp9F1J77SjrWkoY9Ov7iyuYWlOnanC9v5iEsJcTPQB/qneXG
+WUjBwQSI+cmQ5G5s/zGQwySCaK/Ej/gnZ/wVQ8BfFf9mjTNb/aV+K/gTw18TNH8T654cu5NZ1PT
NGvPEeiWsGlalofiNrNHSBjcWmrf2Zc3NtFBBNf6bdE20U6zJRQB/Fl+0lp3xa+Jv7WP7QVxr2gz
+GtT1L4l/Efxj478MQpcWdj4G13WfEWs3tx4d1m1mknfT5dOuTc2Ysbplkt3OoWMjJqEV8lcLN4b
+E91anw/B4wgHi3Rri7ms7i21tb+W6tmvZRaWCWujXl7c/aTbC6N5tshfYuYIWj+2wwGv63fiR+y
Z4c8Xf8ABTH/AIKb+FbTwboQ0jxhH+zBrMNrr1nfapobXuv/AA/17Xta1+dLy7s7i9S78QS3+o3u
nrex6fdX0d1oyyRaVHhfzK8df8Emh4I+Lvg7RtU+LXgy7vtd8SRweGfD3w0+H+nabqmuX9rBe6xe
Sp4f0fT47nSbfSrSym1bUbq48R6tZW+j295c6pqcFlFLdsAfht4o8H+Gfh5oKX/jS+uraTVYsaHp
F1osdpcQm3+0z/LbR2yXUsF3NdrDO97HavFNBcJbyrGGkPMXXwq1LW/h7rfxX0e8g1fw1olvpdzr
EDJfpfK17rdtocs7Q3NpGJIp7q8srpZYpwq2UjeexureYH+qX9rb/gmN8E9N8I+APiCviLxNoCeF
dPuX8a3+gWFvd6V4at3dZZ/FGq6Xo2rx6qNCsZYJm8Q+IbNbkaVpTR+JdWtdO0Gw8Q6ym74i/YV8
PwfsjfEnwb4a8f3PxVvdb8C+JxoBv7gzpc6vc6Fey6DHoVvJJdm1tp9TGnLEgu5ZJLmC0vbgPL+/
oA1f+CK3wHsPiz+xJb+KtM/ZG8JfFGVPib4w0nVfFnjrxZommST39jpXhNrey8N2Fx8Kteurfw/Z
6TPpiyi51i+lm8Uv4nuElt7aSHT4iv6Hf+Ca37KN9+zP+xN8D/g/8RofDGv+KfD/AIdN1fT2Whxw
2ljHrF1NqlrpaDUdIsNRkurWG4V9Yn1C3W6n12bVpcLbmCJSgDG/4KIW0Hh/wv4Q8aaNDDYeIr6+
ufDGo6rbW9vFe6losNpfatp1lqN5HEl3eW+jag17d6RaT3D2NnPqmsyC1d724Y/ynW+s+J/Hvjr9
ozxrqvjHxZp3iDwlY6f4R8P3/h3xDqWhvYeHNR1OPVdV0xDZTqzw6xeaPpz6p5js17Ha20FwWhhh
RSigDiv2TPEPir45+OrrSvih4u8TeKdA8PajqHhhPDOo61e3Xh/V9GudKuNMmtdfsLqS5/tNWtQB
teSOPzgtwY2uF80/XP7AuvarH8ZYfhJ9rll8D+G/jV4b0LRdGuJZrhbLQrzxPaxSaOk88skr2EUT
NDbQysxt4CsMbBI4AhRQB/a0HI9Py+vof8TyeTzkoooA/9k=
';

	$ext='jpeg';
    $data = base64_decode( $image );

    file_put_contents($path, $data );
	
	$sql = "INSERT INTO posts VALUES ('', '$post', '$date_added', '$time_added', '$usernameid', '0', '', '', '', 'userdata/pictures/$username/randomtest.jpg', '', '$usernamegrade', '0', '', '', '0')";

	if ($conn->query($sql) === TRUE) {
		$response["success"] = true;  
		echo json_encode($response);
	}else{
		$response["success"] = false;  
		echo json_encode($response);
	}

}else{
	echo "image_not_in";
	exit;
}

?>