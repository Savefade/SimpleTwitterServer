<?php
include  "../../../Config/Maintenance.php";
include  "../../../Config/DatabaseConnection.php";
include  "../../../Library/Middleware.php";
include  "../../../Library/UserListFunctions.php";

$GetUserData = checkAuth();

$requestedUserData = (isset($_GET["screen_name"]))? GetUserData($_GET["screen_name"]) : ((isset($_GET["user_id"]))? GetUserDataWithUserID($_GET["user_id"]) : exit);

die(json_encode(array (
      'id' => $requestedUserData["ID"],
      'id_str' => ''. $requestedUserData["ID"],
      'verified' => $requestedUserData["IsVerified"],
      'ext_is_blue_verified' => true,
      'badges' => 
      array (
      ),
      'is_dm_able' => false,
      'is_secret_dm_able' => false,
      'is_blocked' => false,
      'can_media_tag' => false,
      'name' => $requestedUserData["FullName"],
      'screen_name' => $requestedUserData["Username"],
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
    ))); // more fields can be added