<?php

function checkAuth(){
	include  "../../../Library/LoginFunctions.php";
	
	if(!isset(getallheaders()["Authorization"])){
		returnPasswordError(401);
	}

	parse_str(str_replace([', ', "OAuth", '"'], ['&', '', ''], getallheaders()["Authorization"]), $getOauthData);
	if(!isset($getOauthData["oauth_token"])){
		returnPasswordError(401);
	}

	$DBData = GetUserDataWithOAuthToken($getOauthData["oauth_token"]);
	
	return $DBData;
}