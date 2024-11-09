<?php
include  "../../../Config/Maintenance.php";
include  "../../../Config/DatabaseConnection.php";
include  "../../../Library/Middleware.php";

$getUserData = checkAuth();

die(json_encode(array(
    "contributors_enabled"=> true,
    "created_at"=> "Sat May 09 17=>58=>22 +0000 2009",
    "default_profile"=> false,
    "default_profile_image"=> false,
    "description"=> "",
    "favourites_count"=> 0,
    "follow_request_sent"=> null,
    "followers_count"=> 0,
    "following"=> null,
    "friends_count"=> 0,
    "geo_enabled"=> true,
    "id"=> $getUserData["ID"],
    "id_str"=> $getUserData["ID"],
    "is_translator"=> false,
    "lang"=> "en",
    "listed_count"=> 0,
    "location"=> "",
    "name"=> $getUserData["Username"], //not yet
    "notifications"=> null,
    "profile_background_color"=> "1A1B1F",
    "profile_background_image_url"=> "http=>//a0.twimg.com/profile_background_images/495742332/purty_wood.png",
    "profile_background_image_url_https"=> "https=>//si0.twimg.com/profile_background_images/495742332/purty_wood.png",
    "profile_background_tile"=> true,
    "profile_image_url"=> "http=>//a0.twimg.com/profile_images/1751506047/dead_sexy_normal.JPG",
    "profile_image_url_https"=> "https=>//si0.twimg.com/profile_images/1751506047/dead_sexy_normal.JPG",
    "profile_link_color"=> "2FC2EF",
    "profile_sidebar_border_color"=> "181A1E",
    "profile_sidebar_fill_color"=> "252429",
    "profile_text_color"=> "123",
    "profile_use_background_image"=> true,
    "protected"=> false,
    "screen_name"=> $getUserData["Username"],
    "show_all_inline_media"=> true,
    "status"=> [
    ],
    "statuses_count"=> 0,
    "time_zone"=> "Pacific Time (US & Canada)",
    "url"=> null,
    "utc_offset"=> -28800,
    "verified"=> false
 )));
