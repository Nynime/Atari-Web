<?php
// Include the database connection file
include 'database_admin.php';

// Start the session
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login_admin.php");
    exit();
}

// Get the user ID from the URL
$adminId = isset($_GET['admin_id']) ? intval($_GET['admin_id']) : 0;  // Ensure integer and handle missing ID

// Check if a valid admin ID is provided
if (!$adminId) {
    echo "Invalid admin ID.";
    exit();
}

// Verify admin identity if necessary
if (!isset($_SESSION['verified_admin_id']) || $_SESSION['verified_admin_id'] != $adminId) {
    header('Location: verify_password_admin.php?admin_id=' . $adminId . '&redirect=delete_admin.php?admin_id=' . $adminId);
    exit();
}

// Handle delete confirmation and deletion
if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
    // Delete the admin record from the database using a prepared statement to prevent SQL injection
    $deleteQuery = "DELETE FROM admins WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $adminId);
    $stmt->execute();

    if ($stmt->affected_rows === 1) {
        echo "<script>
            alert('Admin deleted successfully.');
            window.location.href = 'index.html';
        </script>";
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    
    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // Show the confirmation dialog
    echo "<script>
        if (confirm('Are you sure you want to delete this admin account?')) {
            window.location.href = 'delete_admin.php?admin_id=$adminId&confirm=yes';
        } else {
            window.location.href = 'manage_admin.php';
        }
    </script>";
}
?>
