<?php
include  "../../../Config/Maintenance.php";
include  "../../../Config/DatabaseConnection.php";

$tweets = array();

$RetrieveTweets = $DBReq->prepare("SELECT * FROM `tweets` ORDER BY `tweets`.`Timestamp` ASC LIMIT 20;");
$RetrieveTweets->execute();
$DBResult = $RetrieveTweets->get_result();

while($tweet = mysqli_fetch_assoc($DBResult)){
	$tweets[] =   array (
    'coordinates' => NULL,
    'favorited' => false,
    'created_at' => 'Fri Jan 1 00:00:01 +0000 1970',
    'truncated' => false,
    'entities' => 
    array (
     // 'urls' => 
     // array (
    //    0 => 
     //   array (
     //     'expanded_url' => NULL,
      //    'url' => 'http://www.flickr.com/photos/cindyli/4799054041/',
      //    'indices' => 
      //    array (
      //      0 => 75,
      //      1 => 123,
      //    ),
      //  ),
      ),
      'hashtags' => 
      array (
      ),
      'user_mentions' => 
      array (
        //0 => 
       // array (
       //   'name' => 'Stephanie',
      //    'id' => 15473839,
       //   'indices' => 
       //   array (
       //     0 => 27,
       //     1 => 39,
       //   ),
       //   'screen_name' => 'craftybeans',
       // ),
      //),
    ),
    'text' => $tweet["Text"],
    'annotations' => NULL,
    'contributors' => NULL,
    'id' => $tweet["ID"],
    'geo' => NULL,
    'in_reply_to_user_id' => NULL,
    'place' => NULL,
    'in_reply_to_screen_name' => NULL,
    'user' => 
    array (
      'name' => 'test',
      'profile_sidebar_border_color' => 'AD0066',
      'profile_background_tile' => false,
      'profile_sidebar_fill_color' => 'AD0066',
      'created_at' => 'Wed Nov 29 06:08:08 +0000 2006',
      'profile_image_url' => '',
      'location' => 'San Francisco, CA',
      'profile_link_color' => 'FF8500',
      'follow_request_sent' => false,
      'url' => '',
      'favourites_count' => 465,
      'contributors_enabled' => false,
      'utc_offset' => -28800,
      'id' => 29733,
      'profile_use_background_image' => true,
      'profile_text_color' => '000000',
      'protected' => false,
      'followers_count' => 3395,
      'lang' => 'en',
      'notifications' => true,
      'time_zone' => 'Pacific Time (US & Canada)',
      'verified' => false,
      'profile_background_color' => 'cfe8f6',
      'geo_enabled' => true,
      'description' => '',
      'friends_count' => 542,
      'statuses_count' => 4847,
      'profile_background_image_url' => '',
      'following' => true,
      'screen_name' => 'test',
    ),
    'source' => 'ios app',
    'in_reply_to_status_id' => NULL,
  );
}

die(json_encode($tweets));