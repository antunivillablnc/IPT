<?php
// Database configuration
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'ipt_db');

// Error reporting for development (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Attempt to connect to MySQL database
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
if (mysqli_query($conn, $sql)) {
    // Select the database
    mysqli_select_db($conn, DB_NAME);
    
    // Set charset to ensure proper encoding
    mysqli_set_charset($conn, "utf8mb4");
    
    // Set timezone
    date_default_timezone_set('Asia/Manila');
} else {
    die("Error creating database: " . mysqli_error($conn));
}

// Function to sanitize input data
function sanitize_input($data) {
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return mysqli_real_escape_string($conn, $data);
}

// Function to handle database errors
function handle_db_error($error) {
    // Log error (in production, log to file instead of displaying)
    error_log("Database Error: " . $error);
    
    // Return user-friendly message
    return "A database error occurred. Please try again later.";
}
?>