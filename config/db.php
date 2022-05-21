<?php
    // Enable us to use Headers
    ob_start();
    // Set sessions
    if(!isset($_SESSION)) {
        session_start();
    }
    $hostname = "127.0.0.1";
    $username = "root";
    $password = "password";
    $dbname = "social_media";

    $connection = mysqli_connect($hostname, $username, $password, $dbname) or die("Database connection not established.")
?>
