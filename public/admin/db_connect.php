<?php

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "aclmsloan";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to UTF-8 (optional)
$conn->set_charset("utf8");

?>
