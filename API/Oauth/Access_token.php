<?php
include  "../../Config/Maintenance.php";
include  "../../Config/DatabaseConnection.php";
include  "../../Library/LoginFunctions.php";

if(!isset($_POST["x_auth_username"]) || !isset($_POST["x_auth_mode"]) || !isset($_POST["x_auth_password"])){
	exit(-1);
}

$DBFetchAccount = $DBReq->prepare("SELECT * FROM Accounts WHERE Username = ? || Email = ? LIMIT 1");
$DBFetchAccount->bind_param("ss", $_POST["x_auth_username"], $_POST["x_auth_username"]);
$DBFetchAccount->execute();
$DBResult = $DBFetchAccount->get_result();
if($DBResult->num_rows == 0){
	returnPasswordError();
}

$DBData = $DBResult->fetch_assoc();

if(!password_verify($DBData["Salt"] . $_POST["x_auth_password"] . $DBData["Salt"], $DBData["Password"]))	returnPasswordError();

$token = $token = sha1(time() . $DBData["Salt"]);
updateToken($DBData, $token);

die("oauth_token=$token&oauth_token_secret=$token&user_id=" . $DBData["ID"] ."&screen_name=" . $DBData["Username"]);
