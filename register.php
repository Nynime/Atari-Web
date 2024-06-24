<?php
// Include the database connection file
include 'database.php';

// Enable error reporting (comment out for production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Registration process
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = isset($_POST["first_name"]) ? trim($_POST["first_name"]) : "";
    $last_name = isset($_POST["last_name"]) ? trim($_POST["last_name"]) : "";
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : "";
    $phone_number = isset($_POST["phone_number"]) ? trim($_POST["phone_number"]) : "";
    $date_of_birth = isset($_POST["date_of_birth"]) ? trim($_POST["date_of_birth"]) : "";
    $gender = isset($_POST["gender"]) ? trim($_POST["gender"]) : "";
    $username = isset($_POST["username"]) ? trim($_POST["username"]) : "";
    $password = isset($_POST["password"]) ? trim($_POST["password"]) : "";

    // Validate data
    if (empty($first_name) || empty($last_name) || empty($email) || empty($phone_number) || empty($date_of_birth) || empty($gender) || empty($username) || empty($password)) {
        echo "Please fill in all the fields.";
        exit();
    }

    // Additional email validation using filter_var
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format.";
    exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, phone_number, date_of_birth, gender, username, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        echo "Error preparing statement: " . htmlspecialchars($conn->error);
        exit();
    }

    $stmt->bind_param("ssssssss", $first_name, $last_name, $email, $phone_number, $date_of_birth, $gender, $username, $hashed_password);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        echo "success"; // Send success message back to JavaScript
    } else {
        echo "Error: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
}

$conn->close();

