<?php
include  "../../../Config/Maintenance.php";
include  "../../../Config/DatabaseConnection.php";
include "../../../Library/Middleware.php";

if(!isset($_POST["status"])) exit;

$getUserData  =	 checkAuth();
$timestamp = time();

$RetrieveTweets = $DBReq->prepare("INSERT INTO `tweets` (`ID`, `PosterUserID`, `Timestamp`, `Text`) VALUES (NULL, ?, '$timestamp', ?);");
$RetrieveTweets->bind_param("ss", $getUserData["ID"], $_POST["status"]);
$RetrieveTweets->execute();

die(json_encode(array()));