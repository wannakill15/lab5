<?php
require_once 'vendor/autoload.php';
include('config/dbcon.php');
session_start();

//values from google api console
// init configuration
$clientID = '908459172487-ltp0g4sq7a1k1dj87tnj2jtd1pv5g7j3.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost:3000/admin/index.php';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");
