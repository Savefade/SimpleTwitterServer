<?php
include  "../../Config/Maintenance.php";
include  "../../Config/DatabaseConnection.php";
include "../../Config/Users.php";
include "../../Library/LoginFunctions.php";

if(!isset($_POST["password"]) || !isset($_POST["screen_name"]) || !isset($_POST["email"]) || !isset($_POST["fullname"]) || !$isRegistrationEnabled){
	exit(-1);
}

if(checkUsernameRequirements($_POST["screen_name"]))	sendErrorMessage("Your username does't meet the requirements!");

if(GetUserData($_POST["screen_name"]) != false)		sendErrorMessage("Username in use!");

$token = sha1(time());
$salt = sha1(rand(0, 2147000000));
$lowerCaseUsername = strtolower($_POST["screen_name"]);
$password = password_hash($salt . $_POST["password"] . $salt, PASSWORD_BCRYPT);
$DBCreateAccount = $DBReq->prepare("INSERT INTO `accounts` (`ID`, `Username`, `Email`, `Password`, `Salt`, `Token`) VALUES (NULL, ?, ?, ?, ?, '$token')");
$DBCreateAccount->bind_param("ssss", $lowerCaseUsername, $_POST["email"], $password, $salt);
$DBCreateAccount->execute();

header("X-Twitter-New-Account-Oauth-Access-Token: $token");
header("X-Twitter-New-Account-Oauth-Secret: $token");
header("Content-Type: Application/json");
die('{
  "data": {
    "token": "'. $token . '",
    "secret": "'. $token .'"
  }
}
');


function sendErrorMessage($message){
	http_response_code(401);
	die('{"data": {},"error":"'. $message .'"}
'); //error
}