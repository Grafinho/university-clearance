<?php
// Start session only if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Error reporting (TURN OFF in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database credentials
$host = '127.0.0.1';
$port = '3307';
$db_username = 'root';
$db_password = '';
$db_name = 'grafino';

// Create connection
$conn = new mysqli($host, $db_username, $db_password, $db_name, $port);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed.");
}

// Set charset (IMPORTANT for security & encoding)
$conn->set_charset("utf8mb4");
?>