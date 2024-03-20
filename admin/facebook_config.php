<?php
require_once(__DIR__.'/Facebook/autoload.php');

// values from facebook api developer
define('APP_ID', '1219099889063291');
define('APP_SECRET', 'fbf296189e302a19aa16f8b00f44f4af');
define('API_VERSION', 'v11.0');
define('FB_BASE_URL', 'http://localhost:3000/admin/'); // Make sure to include the trailing slash
define('BASE_URL', 'http://localhost:3000/admin/index.php'); // Make sure to include the full path

if(!session_id()){
    session_start();
}


// Call Facebook API
$fb = new Facebook\Facebook([
 'app_id' => APP_ID,
 'app_secret' => APP_SECRET,
 'default_graph_version' => API_VERSION,
]);


// Get redirect login helper
$fb_helper = $fb->getRedirectLoginHelper();


// Try to get access token
try {
    if(isset($_SESSION['facebook_access_token']))
		{$accessToken = $_SESSION['facebook_access_token'];}
	else
		{$accessToken = $fb_helper->getAccessToken();}
} catch(FacebookResponseException $e) {
     echo 'Facebook API Error: ' . $e->getMessage();
      exit;
} catch(FacebookSDKException $e) {
    echo 'Facebook SDK Error: ' . $e->getMessage();
      exit;
}

?>