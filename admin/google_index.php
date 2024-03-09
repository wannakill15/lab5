<?php
include_once 'google_config.php';

if (isset($_SESSION['user_token'])) {
  header("Location: index.php");
  exit;
} else {
  $auth_url = $client->createAuthUrl();
  header("Location: " . $auth_url);
  exit;
}