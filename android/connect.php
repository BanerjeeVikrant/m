<?php
	$servername = "localhost";
	$username1 = "root";
	$password = "VB2002yoyo1D";
	$dbname = "test";

	// Create connection
    $conn = new mysqli($servername, $username1, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>