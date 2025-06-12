<?php
require_once 'database.php';

// Drop the old database
$dbname = DB_NAME;
mysqli_query($conn, "DROP DATABASE IF EXISTS `$dbname`") or die(mysqli_error($conn));
echo "Old database dropped.<br>";

// Create the new database
mysqli_query($conn, "CREATE DATABASE `$dbname`") or die(mysqli_error($conn));
echo "New database created.<br>";

// Select the new database
mysqli_select_db($conn, $dbname);

// Now create tables based on your ERD

function runQuery($sql, $desc) {
    global $conn;
    if (mysqli_query($conn, $sql)) {
        echo "$desc: Success<br>";
    } else {
        echo "$desc: " . mysqli_error($conn) . "<br>";
    }
}

// USERS
runQuery("CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    is_member BOOLEAN DEFAULT 1,
    date_joined TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)", "Users table");

// SESSIONS
runQuery("CREATE TABLE sessions (
    session_id INT AUTO_INCREMENT PRIMARY KEY,
    branch VARCHAR(100) NOT NULL,
    package VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    duration INT NOT NULL,
    available_dates TEXT
)", "Sessions table");

// ROOMS
runQuery("CREATE TABLE rooms (
    room_id INT AUTO_INCREMENT PRIMARY KEY,
    room_name VARCHAR(100) NOT NULL,
    status VARCHAR(50) NOT NULL
)", "Rooms table");

// BOOKINGS
runQuery("CREATE TABLE bookings (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    session_id INT,
    booking_date DATE NOT NULL,
    status VARCHAR(50) NOT NULL,
    room_id INT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (session_id) REFERENCES sessions(session_id),
    FOREIGN KEY (room_id) REFERENCES rooms(room_id)
)", "Bookings table");

// PAYMENTS
runQuery("CREATE TABLE payments (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT,
    amount DECIMAL(10,2) NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50) NOT NULL,
    receipt_number VARCHAR(100),
    FOREIGN KEY (booking_id) REFERENCES bookings(booking_id)
)", "Payments table");

// GIFTCARDS
runQuery("CREATE TABLE giftcards (
    giftcard_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    recipient_name VARCHAR(100) NOT NULL,
    recipient_email VARCHAR(100) NOT NULL,
    message TEXT,
    purchase_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(50) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
)", "Giftcards table");

echo "<br>Migration complete!";
?>
