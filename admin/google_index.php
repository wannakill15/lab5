<?php
include_once 'google_config.php';


if (isset($_SESSION['user_token'])) {
  header("Location: index.php");
} else {
  echo "<a href='" . $client->createAuthUrl() . "'>Google Login</a>";
}