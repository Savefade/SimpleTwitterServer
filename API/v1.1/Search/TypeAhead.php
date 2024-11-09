<?php
include  "../../../Config/Maintenance.php";
include  "../../../Config/DatabaseConnection.php";
include  "../../../Library/Middleware.php";
include  "../../../Library/UserListFunctions.php";

$GetUserData = checkAuth();

if(!isset($_GET["q"])){
	exit(-1);
}

$usersData = array();

$RetrieveUsers = $DBReq->prepare("SELECT * FROM `accounts` WHERE Username Like CONCAT(? ,'%') || FullName Like CONCAT(? ,'%') LIMIT 20;");
$RetrieveUsers->bind_param("ss", $_GET["q"], $_GET["q"]);
$RetrieveUsers->execute();
$DBResult = $RetrieveUsers->get_result();

while($user = $DBResult->fetch_assoc()){ //!!!!DO NOT CHANGE TO DOUBLE == . I AM NOT CHECKING IF USER == TO SOMETHING. I AM CHECKING IF ITS POSSIBLE TO SET user TO SOMETHING.
	$usersData[] = array (
      'id' => $user["ID"],
      'id_str' => ''. $user["ID"],
      'verified' => $user["IsVerified"],
      'ext_is_blue_verified' => true,
      'badges' => 
      array (
      ),
      'is_dm_able' => false,
      'is_secret_dm_able' => false,
      'is_blocked' => false,
      'can_media_tag' => false,
      'name' => $user["FullName"],
      'screen_name' => $user["Username"],
      'profile_image_url' => 'http://example.com/idk.png',
      'profile_image_url_https' => 'http://example.com/idk.png',
      'location' => '',
      'is_protected' => false,
      'rounded_score' => 0,
      'social_proof' => 0,
      'connecting_user_count' => 0,
      'connecting_user_ids' => 
      array (
      ),
      'social_proofs_ordered' => 
      array (
      ),
      'social_context' => 
      array (
        'following' => false,
        'followed_by' => false,
      ),
      'tokens' => 
      array (
      ),
      'inline' => false,
    );
}

die(json_encode(array (
  'num_results' => $DBResult->num_rows,
  'users' => $usersData,
  'topics' => 
  array (
  ),
  'events' => 
  array (
  ),
  'lists' => 
  array (
  ),
  'ordered_sections' => 
  array (
  ),
  'oneclick' => 
  array (
  ),
  'hashtags' => 
  array (
  ),
  'completed_in' => 0.0,
  'query' => $_GET["q"],
)));