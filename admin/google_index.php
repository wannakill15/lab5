<?php
require_once 'google_login.php';

if (isset($_SESSION['user_token'])) {
  header("Location: google_login.php");
} else {
  echo "<a href='" . $client->createAuthUrl() . "'>Google Login</a>";
}