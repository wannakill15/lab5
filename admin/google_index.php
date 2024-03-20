<?php
include_once 'google_config.php';

//pass the velues from user_token to index.php
if (isset($_SESSION['user_token'])) {
  header("Location: index.php");
  exit;
} else {
  $auth_url = $client->createAuthUrl();
  header("Location: " . $auth_url);
  exit;
}