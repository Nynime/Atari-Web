<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "registration_user";

// Create connection
//$conn = new mysqli($servername, $username, $password, $database);
$conn = new mysqli("localhost", "root", "", "registration_user");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the users table if it doesn't exist
$createTableQuery = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    date_of_birth DATE NOT NULL,
    gender VARCHAR(10) NOT NULL,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

if ($conn->query($createTableQuery) === FALSE) {
    echo "Error creating table: " . $conn->error;
}
