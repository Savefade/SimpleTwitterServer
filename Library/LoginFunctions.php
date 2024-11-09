<?php

function updateToken($accountDataArray, $token){
	include "../../Config/DatabaseConnection.php";
	
	$DBGetAccount = $DBReq->prepare("UPDATE accounts SET Token = ? WHERE Username = ? LIMIT 1;");
	$DBGetAccount->bind_param("ss", $token, $accountDataArray["Username"]);
	$DBGetAccount->execute();
	return;
}

function checkUsernameRequirements($username){
	if(!ctype_alnum($username) || strlen($username) > 15 || strlen($username) < 3){
		return true;
	}
	return false;
}

function GetUserData($username){
	include "../../../Config/DatabaseConnection.php";
	
	$DBGetAccount = $DBReq->prepare("SELECT * FROM accounts WHERE Username = ? || Email = ? LIMIT 1;");
	$DBGetAccount->bind_param("ss", $username, $username);
	$DBGetAccount->execute();
	$DBResult = $DBGetAccount->get_result();
	if($DBResult->num_rows == 0)	return false;
	return $DBResult->fetch_assoc();
}

function GetUserDataWithUserID($ID){
	include "../../../Config/DatabaseConnection.php";
	
	$DBGetAccount = $DBReq->prepare("SELECT * FROM accounts WHERE ID = ? LIMIT 1;");
	$DBGetAccount->bind_param("s", $ID);
	$DBGetAccount->execute();
	$DBResult = $DBGetAccount->get_result();
	if($DBResult->num_rows == 0){exit;}
	return $DBResult->fetch_assoc();
}

function GetUserDataWithOAuthToken($token){
	include "../../../Config/DatabaseConnection.php";
	
	$DBGetAccount = $DBReq->prepare("SELECT * FROM accounts WHERE Token = ?;");
	$DBGetAccount->bind_param("s", $token);
	$DBGetAccount->execute();
	$DBResult = $DBGetAccount->get_result();
	if($DBResult->num_rows == 0)	returnPasswordError();
	return $DBResult->fetch_assoc();
}

function RegisterNewAccount($lowerCaseUsername, $fullName, $email, $password, $salt, $token){
	include "../../../Config/DatabaseConnection.php";
	include "../../../Config/Users.php";
	
	$timestamp = time();
	$DBCreateAccount = $DBReq->prepare("INSERT INTO `accounts` (`ID`, `Username`, `FullName`, `Email`, `IsVerified`, `Password`, `Salt`, `Token`, `RegistrationTS`) VALUES (NULL, ?, ?, ?, $verifyNewUsers, ?, ?, '$token', $timestamp)");
	$DBCreateAccount->bind_param("sssss", $lowerCaseUsername, $fullName, $_POST["email"], $password, $salt);
	$DBCreateAccount->execute();
	return;
}

function returnPasswordError(){
	http_response_code(401);
	exit;
}