<?php
session_start();

if (isset($_SESSION['auth'])) {
    $_SESSION['status'] = "Login to Access Dashboard";
    header("Location: loginform.php");
    exit(0);
}
