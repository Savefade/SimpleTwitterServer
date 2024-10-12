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
	include "../../Config/DatabaseConnection.php";
	
	$DBGetAccount = $DBReq->prepare("SELECT * FROM accounts WHERE Username = ? || Email = ? LIMIT 1;");
	$DBGetAccount->bind_param("ss", $username, $username);
	$DBGetAccount->execute();
	$DBResult = $DBGetAccount->get_result();
	if($DBResult->num_rows == 0)	return false;
	return $DBResult->fetch_assoc();
}