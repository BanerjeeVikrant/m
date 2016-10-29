<?php
require "system/connect.php";

ini_set('session.cookie_lifetime', 60 * 60 * 24 * 7);
//ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 7);
//ini_set('session.save_path', '/sessions');
session_start();
if (isset($_SESSION['user_login'])) {
	$username = $_SESSION['user_login'];
}
else{
	$username = "";
}
	$fp = fopen("bruinfeedback.txt", "a");
	fputs($fp,"Name: ");
	fputs($fp,$_POST["name"]);
	fputs($fp,"\n");
	fputs($fp,"\n");
	fputs($fp,"Email: ");
	fputs($fp,$_POST["email"]);
	fputs($fp,"\n");
	fputs($fp,"\n");
	fputs($fp,"Message: ");
	fputs($fp,$_POST["message"]);
	fputs($fp,"\n");
	fputs($fp,"\n");
	fputs($fp,"\n");
	
	fclose($fp);
?>