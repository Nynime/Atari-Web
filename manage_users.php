<?php
// Include the database connection file
include 'database.php';

// Start the session or retrieve the existing session data
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Retrieve the user record from the database based on the session username
    $selectQuery = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($selectQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userId = $row["id"];
        $firstName = $row["first_name"];
        $lastName = $row["last_name"];
        $email = $row["email"];
        $phoneNumber = $row["phone_number"];
        $dateOfBirth = $row["date_of_birth"];
        $gender = $row["gender"];

        echo "<!DOCTYPE html>
              <html>
              <head>
                <title>Manage User</title>
                <style>
                    /* CSS styles go here */
                    body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 20px;
                }
                h2 {
                    color: #333333;
                    text-align: center;
                }
                .user-details {
                    background-color: #ffffff;
                    padding: 20px;
                    border-radius: 5px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    max-width: 600px;
                    margin: 0 auto;
                }
                .user-details p {
                    margin: 10px 0;
                    color: #666666;
                }
                .logout-link {
                    display: block;
                    text-align: center;
                    margin-top: 20px;
                    color: #007bff;
                    text-decoration: none;
                }
                .logout-link:hover {
                    text-decoration: underline;
                }
                </style>
              </head>
              <body>
                <h2>User Details</h2>
                <div class='user-details'>
                    <p><strong>ID:</strong> $userId</p>
                    <p><strong>Username:</strong> $username</p>
                    <p><strong>First Name:</strong> $firstName</p>
                    <p><strong>Last Name:</strong> $lastName</p>
                    <p><strong>Email:</strong> $email</p>
                    <p><strong>Phone Number:</strong> $phoneNumber</p>
                    <p><strong>Date of Birth:</strong> $dateOfBirth</p>
                    <p><strong>Gender:</strong> $gender</p>
                    <a href='edit_user.php?user_id=$userId'>Edit</a>
                    <a href='delete_user.php?user_id=$userId'>Delete</a>
                    <a href='logout.php' class='logout-link'>Logout</a>
                    <a href='A1-Dashboard-Test.html' class='back-button'>Back to Dashboard</a>
                </div>
              </body>
              </html>";
    } else {
        echo "No User found.";
    }
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}

// Close the database connection
$conn->close();