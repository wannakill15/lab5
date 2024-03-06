<?php

$hostname = "localhost";

$username = "root";

$password = "";

$db_name = "adminLTE";

$conn = mysqli_connect($hostname,$username,$password,$db_name);

if (!$conn) {
    echo "Connection failed!";
}