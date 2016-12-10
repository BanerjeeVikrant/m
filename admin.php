<?php
require "system/connect.php";

$lifetime = 60 * 60 * 24 * 7 * 365;
session_set_cookie_params($lifetime);
session_start();

?>
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

	<style type="text/css">
	#reportedposts {
		z-index: 3;
		height: 100vh;
		position: absolute;
		top: 0;
		padding-top: 65px;
		overflow-y: scroll;
	}
	*{
		font-family: 'PT Serif Caption';
	}
	body{
		overflow: hidden;
		background-color: #e6e6e6;
	}

	.top-bar{
		display: inline-block;
		position: fixed;
		top:0px;
		z-index: 9;
		padding: 15px;
		width: 100vw;
		height: 60px;
		background-color: #1d2d4a;
	}
	.searchbar-wrapper{
		display: inline-block;
	}
	.search-tool-wrapper {
		display: inline-block;
		color: #e0dfdf;
		width: 29px;
		padding-left: 4px;
		font-size: 15px;
		position: relative;
		top: 3px;
		left: 56px;
	}

	.search{
		background: transparent;
		border: 0;
		border-bottom: 1px solid #fff;
		position: relative;
		left: 20px;
		top: 3px;
		font-size: 16px;
		outline: 0;
		color: white;
		width: 70vw;
		padding-left: 30px;
	}
	.options-tabs {
	    height: 40px;
	    border-bottom: 1px solid #e6e6e6;
	    z-index: 6;
	    background-color: white;
	    margin-bottom: 10px;
	}
	.tabs {
	    position: relative;
	    display: inline-block;
	    width: calc((100vw / 3) + 1px);
	    height: 40px;
	    text-align: center;
	    line-height: 40px;
	    font-size: 15px;
	    background: #cecece;
	    margin-left: -5px;
	    border: 1px solid #e4e4e4;
	}
	.ignore-tab {
	    width: calc((100vw / 3) + 5px);
	}
	.crush-tab{
		margin-left: -5px;
	}
	.notifications-tab{
		margin-left: -5px;
	}
	.messages-tab{
		margin-left: -5px;
		width: calc((100vw / 4) + 0px);
	}
	.home-img{
		display: inline-block;
		height: 32px;
		width: 32px;
		background-image: url(img/home-blue.png);
		background-size: cover;
		background-repeat: no-repeat;

	}
	.crush-img{
		display: inline-block;
		height: 32px;
		width: 32px;
		background-image: url("img/anonymous-logo-white.png");
		background-size: cover;
		background-repeat: no-repeat;

	}
	.notifications-img{
		display: inline-block;
		height: 32px;
		width: 32px;
		background-image: url("img/notification-bell-grey.png");
		background-size: cover;
		background-repeat: no-repeat;

	}
	.messages-img{
		display: inline-block;
		height: 32px;
		width: 32px;
		background-image: url("img/message-grey.png");
		background-size: cover;
		background-repeat: no-repeat;

	}
	.profile-post {
	    background-color: white;
	    position: relative;
	    width: 100vw;
	    padding: 1px;
	    margin-bottom: -20px;
	}
	.post-breaker{
		margin: 0;
		margin-bottom: 2px;
		position: relative;
		top: -5px;
		border-color: #dad4d4;
		margin-left: 15px;
		margin-right: 15px;
	}
	.crush-post {
		position: relative;
		width: 95vw;
		left: 2.5vw;
		margin-bottom: 15px;
		border-top: 1px solid #bbb;
		border-bottom: 1px solid #bbb;
		color: white;
	}

	.posted-by-img{
		display: inline-block;
		width: 50px;
		height: 50px;
		border-radius: 45px;
		background-repeat: no-repeat;
		background-position: center;
		background-size: cover;
		position: relative;
		top: 10px;
		left: 15px;
	}
	.posted-pic {
		width: 100%;
	}
	.samepostedby {
		margin: 10px;
		font-size: 16px;
		text-decoration: none !important;
		color: black;
		font-family: 'PT Serif Caption';
		position: relative;
		top: -11px;
		left: 10px;
	}
	.posted-by-name{
		margin: 10px;
		font-size: 16px;
		text-decoration: none !important;
		color: black;
		font-family: 'PT Serif Caption';
		position: relative;
		top: -11px;
		left: 10px;
	}
	.posted-to-name{
		display: none;
		/*margin: 10px;
		font-size: 16px;
		text-decoration: none !important;
		color: black;
		font-family: 'PT Serif Caption';*/
	}
	.topNameCrush{
		position: relative;
		left: 30px;
		top: 10px;
	}
	.timeCrush{

	}
	.msg-body-crush {
	    font-size: 23px;
	    padding-left: 10px;
	    padding-right: 10px;
	    margin-left: 5px;
	    margin-top: 10px;
	    margin-bottom: 10px;
	    padding-bottom: 10px;
	}
	.crush_pic {
		width: 95vw;
		position: relative;
		left: 2.5vw;
		max-height: 400px;
		margin-top: -15px;
		margin-bottom: 15px;
	}
	.arrow{
		display: none;
		/*
		margin: 5px;
		font-size: 16px;
		*/
	}

	.post-options{
		font-size: 17px;
		color: #cdcdcd;
		float: right;
		position: relative;
		top: 25px;
		right: 18px;
	}
	.time{
		font-family: 'Alice';
		position: relative;
		top: -13px;
		left: 70px;
	}
	.msg-body{
		font-size: 15px;
		color: black;
		padding-left: 10px;
		padding-right: 10px;
	}
	.comment-inputs{
		position: absolute;
		left: 57px;
		top: -72px;
		width: calc(100vw - 57px);
		height: 57px;
		border: 0;
		padding-left: 15px;
		font-size: 15px;
		background-color: #fff;
		outline-width: 0;
		font-family: Verdana;
	}
	.like-btn-div{
		position: absolute;
		display: inline-block;
		width: 58px;
		height: 57px;
		background-color: white;
		position: relative;
		top: -15px;
	}	
	.notliked{
		display: inline-block;
		height: 38px;
		width: 38px;
		margin-top:10px;
		margin-left: 10px;
		background-image: url(img/notliked-paw.png);
		z-index: 2;
		background-repeat: no-repeat;
		background-size: cover;
		cursor: pointer;
	}
	.liked{
		display: inline-block;
		height: 38px;
		width: 38px;
		margin-top:10px;
		margin-left: 10px;
		background-image: url(img/liked-paw.png);
		z-index: 2;
		background-repeat: no-repeat;
		background-size: cover;
		cursor: pointer;
	}
	.comment-body{
		background-color: #f9f9f9;
		width: 100vw;
		margin-top: -4px;
	}
	.comments-img{
		width:35px;
		height: 35px;
		padding: 5px;
		background-repeat: no-repeat;
		background-size: cover;
		border-radius: 45px;
		display:inline-block;

	}
	.commentPosted{
		padding-left: 0px;
		font-size: 14px;
		margin-top: -30px;
		position: relative;
		font-family: 'PT Serif Caption';
		top: -7px;
		left: 11px;
	}
	.comment-area{
		width: 90vw;
	}
	#last_post{
		padding: 20px;
		border-top: 1px solid #bbb;
		border-bottom: 1px solid #bbb;
	}
	.youtube-link-iframe{
		width: 100vw;
		height: 300px;
		position: relative;
		margin-top:-6px;
		top: 6px;
	}
	.posted-video{
		width: 100vw;
		margin-left: -20px;
		position: relative;
		margin-top:-6px;
		top: 6px;
	}
	.count-likes{
		font-size: 13px;

		font-family: 'PT Serif Caption';
		float: right;
		position: relative;
		right: 25px;
		top: -23px;

	}
	.comments-box {
		position: relative;
		top: -11px;
	}
	.top-pusher{
		position: relative;
		height:125px;
	} 
	#last_crush{
		background-color: white;
		padding: 20px;
		position: relative;
		width: 95vw;
		left: 2.5vw;
		margin-bottom: 15px;
		border-top: 1px solid #bbb;
		border-bottom: 1px solid #bbb;
	}
	.bottom-message-wrapper{
		position: fixed;
		height: 50px;
		width: 100vw;
		top: calc(100vh - 50px);
		background-color: #222;
	}
	input#sendingText {
		width: 90vw;
		height: 30px;
		position: relative;
		left: 5vw;
		top: calc(50% - 15px);
		border-radius: 45px;
		border: 0;
		padding-left: 15px;
		outline: 0;
	}
	input#search-users {
		width: 90vw;
		height: 30px;
		border: 0;
		outline: 0;
		padding-left: 33px;
		margin-bottom: 10px;
	}
	span.usersearch-tool {
		position: relative;
		left: 30px;
		top: 3px;
		color: #b0b0b0;
	}
	input#search-users-g {
	    width: 85vw;
	    height: 30px;
	    border: 0;
	    outline: 0;
	    padding-left: 33px;
	    margin-bottom: 10px;
	    position: relative;
	}

	span.usersearch-tool-g {
	    position: relative;
	    left: 13px;
	    top: 27px;
	    color: #b0b0b0;
	    z-index: 2;
	}
	.each-user {
	    position: relative;
	    width: 100vw;
	    height: 53px;
	    padding: 13px;
	    border-bottom: 1px solid #d7d7d7;
	}
	.each-user-text {
	    position: absolute;
	    display: inline-block;
	    top: 30px;
	    left: 68px;
	    font-size: 13px;
	}
	.chat-user-img {
		display: inline-block;
		width: 40px;
		height: 40px;
		background-size: cover;
		background-repeat: no-repeat;
		background-position: center;
		position: relative;
		top: -6px;
		border-radius: 45px;
	}
	.each-user-name {
		display: inline-block;
		position: relative;
		top: -27px;
		margin-left: 10px;
		font-size: 15px;
	}
	#messenger-pic{
		display: inline-block;
		width: 50px;
		height: 50px;
		border-radius: 45px;
		background-size: cover;
		background-repeat: no-repeat;
		position: relative;
		left: 0px;
		top: 7px;
		display: none;
	}
	#messenger-name{
		position: relative;
		left: 3px;
		top: 3px;
		font-size: 20px;
		font-family: 'PT Serif Caption';
	}
	.arrow-back{
		font-size: 27px;
		position: relative;
		left: 20px;
		top: 15px;
		cursor: pointer;
		z-index: 12;
	}
	.messenger-info{
		display: inline-block;
		text-align: center;
		height: 27px;
		width: 100vw;
		position: relative;
		top: -20px;
	}
	.your-message{
		background-color: white;
		color: black;
		display: inline-block;
		padding-left: 10px;
		padding-right: 10px;
		max-width: 70%;
		padding-top: 6px;
		padding-bottom: 6px;
		border-radius: 5px;
		margin-top:5px;
		margin-right: 10px;
		float: right;
	}
	.your-message-box{
		float: right;
		width: 100%;
		font-size: 14px;
		font-family: 'PT Serif Caption';
	}
	.their-message-box{
		float: left;
		width: 100%;
		font-size: 14px;
		font-family: 'PT Serif Caption';
		padding-left: 10px;
	}
	.their-message{
		background-color: white;
		color: black;
		display: inline-block;
		padding-left: 10px;
		padding-right: 10px;
		max-width: 70%;
		padding-top: 6px;
		padding-bottom: 6px;
		border-radius: 5px;
		margin-top:5px;
	}
	.toPic{
		display: inline-block;
		width: 35px;
		height: 35px;
		background-size: cover;
		background-repeat: no-repeat;
		float: left;
		margin-right: 10px;
		border-radius: 45px;
		margin-top:5px;	
	}
	.sendingText::-webkit-input-placeholder{
		color: grey;
	}
	.sendingText{
		width: 360px;
		height: 29px;
		position: relative;
		left: 20px;
		top: 11px;
		border-radius: 30px;
		border: 0;
		padding-left: 16px;
		color:black;
		outline: 0;
		font-family: 'PT Serif Caption';
		font-size: 15px;
	}
	.message-box-close{
		color: white;
		font-size: 25px;
		position: relative;
		top: 7px;
		left: 7px;
		cursor: pointer;
	}
	.messages-wrapper {
		width: 100vw;
		position: absolute;
		top: 0;
		background: rgba(0,0,0,0.9);
		z-index: 9;
		color: white;
	}
	#messages{
		height: calc(100vh - 100px);
		overflow: scroll;
		padding-bottom:50px;
	}
	.notification-post {
		background: white;
		min-height: 45px;
		margin-bottom: 1px;
		width: 100vw;
	}
	.notificationBox {
	    display: inline-block;
	    width: calc(100vw - 60px);
	    position: relative;
	    padding-top: 15px;
	    top: 0px;
	    left: 53px;
	    padding-bottom: 10px;
	}
	.fromPicNotification {
	    height: 35px;
	    width: 35px;
	    background-size: cover;
	    background-repeat: no-repeat;
	    background-position: center;
	    border-radius: 45px;
	    position: absolute;
	    left: 10px;
	    top: 6px;
	}
	span.notifier {
		font-weight: bold;
		font-size: 13px;
		color: black;
	}
	span.notificationInfo {
		color: #414040;
	}
	span.notifier-time {
		color: #939393;
	}
	.home-sidebody{
		position: fixed;
		width: 85vw;
		height: 100vh;
		top: 0px;
		z-index: 20;
		background: #e6e6e6;
		border-right: 1px solid #b5b5b5;
		overflow-y: scroll;
		overflow-x: hidden;
		padding-bottom: 15px;
	}

	.info-sidebody {
		color: white;
		font-size: 16px;
		position: relative;
		width: 70vw;
		top: 50px;
		left: calc(50% - 35vw);
	}
	.sidebody-tab {
		width: 100%;
		height: 40px;
		vertical-align: middle;
		background: #fff;
		line-height: 40px;
		padding-left: 17px;
		border-top: 1px solid #e6e6e6;
		border-right: 1px solid #e6e6e6;
		color: black;		
	}
	a{
		text-decoration: none !important;
	}
	.body-content {
		z-index: 3;
		height: 100vh;
		position: absolute;
		top: 0;
		padding-top: 110px;
		overflow-y: scroll;
	}
	.crush-content{
		z-index: 3;
		height: 100vh;
		width: 100vw;
		position: absolute;
		top: 0;
		padding-top: 125px;
		overflow-x: hidden;
		overflow-y: scroll;
		background:url(img/confessionbackground.jpg);
		background-size: cover;
		opacity: 0.9; 
	}
	.notifications-content{
		z-index: 0;
		height: 100vh;
		position: absolute;
		top: 0;
		padding-top: 110px;
		overflow-y: scroll;
	}
	.message-content{
		z-index: 3;
	}
	.add-post{
		display: inline-block;
		width: 55px;
		height: 55px;
		position: fixed;
		z-index: 8;
		top: calc(100vh - 70px);
		left: calc(100vw - 70px);
		background-color: orange;
		padding: 10px;
		border-radius: 90px;
	}
	.add-crush{
		display: inline-block;
		width: 55px;
		height: 55px;
		position: fixed;
		z-index: 8;
		top: calc(100vh - 70px);
		left: calc(100vw - 70px);
		background-color: #ebdbd8;
		padding: 10px;
		border-radius: 90px;
	}
	.add-people{
		display: inline-block;
		width: 55px;
		height: 55px;
		position: fixed;
		z-index: 8;
		top: calc(100vh - 70px);
		left: calc(100vw - 70px);
		background-color: orange;
		padding: 10px;
		border-radius: 90px;
	}
	.add-people-plus{
		display: inline-block;
		height: 30px;
		width: 30px;
		background-size: cover;
		background-repeat: no-repeat;
		color: white;
		font-size: 28px;
		position: relative;
		left: 5px;
		top: 3px;
	}
	.add-post-pen {
	    display: inline-block;
	    height: 30px;
	    width: 30px;
	    background-image: url(img/edit.png);
	    background-size: cover;
	    background-repeat: no-repeat;
	    position: relative;
	    left: 3px;
	    top: 2px;
	}
	.add-post-crush{
		display: inline-block;
		height: 30px;
		width: 30px;
		background-image: url(img/anonymous-logo-blue.png);
		background-size: cover;
		background-repeat: no-repeat;
		position: relative;
		left: 3px;
		top: 4px;
	}

	.posthome {
		position: fixed;
		top: 0;
		height: 100vh;
		width: 100vw;
		background-color: #1d2d4a;
		z-index: 20;
		overflow: hidden;
	}
	.addpeoplesearch{
		position: fixed;
		top: 0;
		height: 100vh;
		width: 100vw;
		background-color: #e6e6e6;
		z-index: 20;
		overflow-y: scroll;
		overflow-x: hidden;
	}
	.feedbackhome {
		position: fixed;
		top: 0;
		height: 100vh;
		width: 100vw;
		background-color: #1d2d4a;
		z-index: 30;
		overflow: hidden;
	}
	.newgrouphome {
		position: fixed;
		top: 0;
		height: 100vh;
		width: 100vw;
		background-color: #1d2d4a;
		z-index: 30;
		overflow: hidden;
	}
	.postcrush {
		position: fixed;
		top: 0;
		height: 100vh;
		width: 100vw;
		background-color: #1d2d4a;
		z-index: 20;
		overflow: hidden;
	}
	textarea.posttext {
		position: relative;
		top: 50px;
		height: calc(100vh - 100px);
		width: 100vw;
		border: 0;
		resize: none;
		border-top: 1px solid #cec9c9;
		padding: 16px;
		font-size: 17px;
	}
	textarea.feedbacktext {
		position: relative;
		top: 50px;
		height: 100vh;
		width: 100vw;
		border: 0;
		resize: none;
		border-top: 1px solid #cec9c9;
		padding: 16px;
		font-size: 17px;
	}
	textarea.posttextcrush {
		position: relative;
		top: 50px;
		height: 100vh;
		width: 100vw;
		border: 0;
		resize: none;
		border-top: 1px solid #cec9c9;
		padding: 16px;
		font-size: 17px;
	}

	.crushoptions-cover {
		position: relative;
		height: 50px;
		top: 45px;
		background: #e6e6e6;
	}
	.photooption {
		border-right: 1px solid #cec9c9;
	}
	.postoptions {
		display: inline-block;
		line-height: 50px;
		width: 49vw;
		text-align: center;
		font-size: 18px;
	}
	.back-img{
		position: fixed;
		display: inline-block;
		height: 32px;
		width: 32px;
		background-image: url(img/back.png);
		background-size: cover;
		background-repeat: no-repeat;
		top: 10px;
		left: 15px;
	}
	.topbar-userimages{
		background-color: #1d2d4a;
		width: 100vw;
		height: 60px;
	}
	.userimages-name {
	    color: white;
	    font-size: 15px;
	    position: fixed;
	    top: 19px;
	    left: 59px;
	}
	.inputfile {
		width: 0.1px;
		height: 0.1px;
		opacity: 0;
		overflow: hidden;
		position: absolute;
		z-index: -1;
	}
	.inputfile + label {
		width: 49vw;
		height: 50px;
		font-size: 15px;
		display: inline-block;
		overflow: hidden;
		text-align: center;
		position: relative;
		top: 0px;
		left: 0;
		line-height: 50px;
	}

	.no-js .inputfile + label {
		display: none;
	}

	.inputfile:focus + label,
	.inputfile.has-focus + label {
		outline: 1px dotted #000;
		outline: -webkit-focus-ring-color auto 5px;
	}

	.inputfile + label svg {
		width: 1em;
		height: 1em;
		vertical-align: middle;
		fill: currentColor;
		margin-top: -0.25em;
		/* 4px */
		margin-right: 0.25em;
		/* 4px */
	}

	.inputfile-1 + label {
		color: black;
		background-color: transparent;
	}
	.submitpost{
		position: fixed;
		width: 100px;
		height: 50px;
		left: calc(100vw - 100px);
		font-size: 17px;
		background: transparent;
		color: white;
		border: 0;
	}
	.search-body{
		position: absolute;
		top: 0;
		height: 100vh;
		width: 100vw;
		background-color: #e6e6e6;
		z-index: 10;
	}
	.search-topbar{
		display: inline-block;
		position: fixed;
		top:0px;
		z-index: 9;
		padding: 15px;
		width: 100vw;
		height: 60px;
		background-color: #1d2d4a;
	}
	div#search-content {
		margin-top: 60px;
	}
	div#search-contentpeople {
		margin-top: 60px;
	}
	.search-layer {
		background: white;
		padding: 7px;
	}
	.search-userpic {
		display: inline-block;
		height: 50px;
		width: 50px;
		background-size: cover;
		position: absolute;
		top: -9px;
	}
	.search-name {
		position: relative;
		left: 60px;
		top: -8px;
		font-size: 15px;
		font-weight: bold;
		color: black;
		text-decoration: none !important;
	}
	.search-time {
		position: relative;
		left: 60px;
		top: -8px;
		color: black;
		text-decoration: none !important;
	}
	.search-layer {
		background: white;
		padding: 7px;
		border-bottom: 1px solid #b5b4b4;
	}
	div#last_notification {
		padding: 15px;
		padding-left: calc(50vw - 89px);
	}
	.post-write-tabs {
		display: inline-block;
		width: calc((100vw / 2) - 6px);
		font-size: 18px;
		text-align: center;
		line-height: 50px;
		border-left: 1px solid #c6c8cd;
	}
	.link-div{
		width: 49vw;
		height: 50px;
		font-size: 15px;
		display: inline-block;
		overflow: hidden;
		text-align: center;
		position: relative;
		top: -6px;
		left: 0;
		line-height: 50px;
		font-weight: bold;
	}
	.reported{
		position: fixed;
		background-color: lightgray;
		height: 50px;
		width: 80vw;
		border-radius: 5px;
		z-index: 25;
		top: calc(50vh - 25px);
		left: 10vw;
		text-align: center;
		font-size: 20px;
	}
	.flag-reported{
		color: black;
		font-size: 35px;
		position: relative;
		left: -15px;
		top: 9px;
	}
	#top-content{
		height: 0px;
		z-index: 50;
	}
	div#fullscreen-img-wrapper {
	    position: absolute;
	    top: 0;
	    height: 100%;
	    overflow: scroll;
	 	background-color: white;
	 	z-index: 9;
	}
	.postoptions-cover {
	    position: relative;
	    background: #e6e6e6;
	    top: 45px;
	}
	.add-people-tip {
	    position: fixed;
	    top: calc(100vh - 59px);
	    left: calc(100vw - 193px);
	    background: #1d2d4a;
	    color: white;
	    padding: 7px;
	    padding-left: 15px;
	    padding-right: 25px;
	    border-top-right-radius: 50px;
	    border-bottom-right-radius: 50px;
	}
	span.likedby-names {
	    position: relative;
	    top: 3px;
	    left: 5px;
	}
	.add-group {
	    float: right;
	}
	.optionBox {
	    background: #e6e6e6;
	    position: fixed;
	    top: calc(50vh - 45px);
	    left: calc(50vw - 40vw);
	    z-index: 11;
	    width: 80vw;
	    box-shadow: 1px 1px 21px #e6e6e6;
	}
	.optionsPost {
	    background: white;
	    height: 43px;
	    line-height: 43px;
	    text-align: center;
	    margin-top: 1px;
	    font-size: 16px;
	}
	.optionBox-wrapper {
	    height: 100vh;
	    width: 100vw;
	    position: fixed;
	    z-index: 15;
	    background: rgba(222,215,215,0.3);
	}
	input.anoncomment-inputs {
	    width: 95vw;
	    height: 35px;
	    position: relative;
	    top: -15px;
	    border: 0;
	    left: 2.5vw;
	    padding: 15px;
	    outline-width: 0;
	}
	.anoncomment-body {
	    width: 95vw;
	    position: relative;
	    left: 2.5vw;
	    background: #eaecef;
	    top: -15px;
	}
	</style>
</head>

<body>

 <div class="search-topbar">
  <div class="back-img" id="back-searchpeople"></div>
  <div class="userimages-name">Admin Console</div>
   
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