<?php

function getUsersByID($IDs){
	include  "../../../Config/DatabaseConnection.php";
	
	$userData = array();
	
	$RetrieveUsersData = $DBReq->prepare("SELECT * FROM accounts WHERE ID IN($IDs) ORDER BY FIELD(ID, $IDs);");
	$RetrieveUsersData->execute();
	$DBResult = $RetrieveUsersData->get_result();
	
	while($user = mysqli_fetch_assoc($DBResult)){
		$userData[$user["ID"]] = $user;
	}
	
	return $userData;
}