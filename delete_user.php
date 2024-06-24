<?php
// Include the database connection file
include 'database.php';

// Start the session
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$userId = $_GET['user_id'];

if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
    // Delete the user record from the database based on the user_id
    $deleteQuery = "DELETE FROM users WHERE id = '$userId'";

    if ($conn->query($deleteQuery) === TRUE) {
        echo "User deleted successfully.";
        header("Location: manage_users.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    
    // Close the database connection
    $conn->close();
} else {
    // Show the confirmation dialog
    echo "<script>
        if (confirm('Are you sure you want to delete this user?')) {
            window.location.href = 'delete_user.php?user_id=$userId&confirm=yes';
        } else {
            window.location.href = 'index.html';
        }
    </script>";
}

