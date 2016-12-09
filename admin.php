<html>

<head>
	<title>bruincave - admin console</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="theme-color" content="#1d2d4a" />
	<link rel="shortcut icon" href="img/bearpic.png">

	<!--other resourses, external source(help)-->
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=IM+Fell+English+SC" />
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Carter+One" />
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Alice" />
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=PT+Serif+Caption" />
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Creepster+Caps" />
	<link rel="stylesheet" type="text/css" href="css.css" />

	<!--jquery 2.2.0-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
	<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<script src="https://hammerjs.github.io/dist/hammer.js"></script>

	<!--angularjs 1.4.8-->
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>

	<!--bootstrap 3.3.6-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>

<style type="text/css">
#reportedposts {
	z-index: 3;
	height: 100vh;
	position: absolute;
	top: 0;
	padding-top: 80px;
	overflow-y: scroll;
}
</style>

 <div class="search-topbar">
  <div class="back-img" id="back-searchpeople"></div>
  <div class="searchbar-wrapper">
   <div class="search-tool-wrapper">
    <span class="search-tool glyphicon glyphicon-search"></span>
   </div>
   <input class="search" id = "searchpeople" type="text" placeholder="Search..." name="search" autocomplete="off">
  </div>
 </div>
 <div id="search-contentpeople">
  
 </div>
</div>

<div id="reportedposts"></div>


<script type="text/javascript">

function showReported() {
	console.log("opened reported")
	$("#reportedposts").css("height") = "50%";
}

</script>

<?php
require "system/connect.php";

$lifetime = 60 * 60 * 24 * 7 * 365;
session_set_cookie_params($lifetime);
session_start();

$allowed = false;

if (isset($_SESSION['user_login'])) {
	$username = $_SESSION['user_login'];
	$time = time();
	$sql = "UPDATE users SET last_online_time = '$time', online = '1' WHERE username = '$username'";
	$update = $conn->query($sql);

	$adminCheck = $conn->query("SELECT admin FROM users WHERE username='$username'");
	$find = $adminCheck->fetch_assoc();
	$found = $find['admin'];
	if($found == '1'){
		$allowed = true;
	}
}

if ($allowed) {

	echo " 
			<script type='text/javascript'>
			$.ajax({
				url: 'action/bringreported.php',
				success: function(data) {
					$('#reportedposts').prepend(data);
				},
				error: function(err) {
					console.log(err);
				}
			});
			</script>
	";

} else {
	echo "<meta http-equiv=\"refresh\" content=\"0; url=/bkm\">";
}
?>

</body>
</html>