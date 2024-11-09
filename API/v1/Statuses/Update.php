<?php
include  "../../../Config/Maintenance.php";
include  "../../../Config/DatabaseConnection.php";
include  "../../../Config/Users.php";
include "../../../Library/Middleware.php";

if(!isset($_POST["status"])) exit;

if(strlen($_POST["status"]) > $maxTweetLenght){
	http_response_code(400);
	die('{"message": "Tweet is too long!"}');
} 

$getUserData  =	 checkAuth();
$timestamp = time();

$RetrieveTweets = $DBReq->prepare("INSERT INTO `tweets` (`ID`, `PosterUserID`, `Timestamp`, `Text`) VALUES (NULL, ?, '$timestamp', ?);");
$RetrieveTweets->bind_param("ss", $getUserData["ID"], $_POST["status"]);
$RetrieveTweets->execute();

die(json_encode(array()));