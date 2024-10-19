<?php

function getUsersByID($IDs){
	include  "../../../Config/DatabaseConnection.php";
	
	$RetriveUsersData = $DBReq->prepare("SELECT * FROM accounts WHERE ID IN(?) ORDER BY FIELD(ID, ?);");
	$RetriveUsersData->bind_param("ss", $IDs, $IDs);
	$RetriveUsersData->execute();
	
	return
}