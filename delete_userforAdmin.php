<?php
// Include the database connection file
include 'database.php';

session_start();

if (!isset($_SESSION['verified_user_id']) || $_SESSION['verified_user_id'] != $_GET['delete']) {
    header('Location: verify_password_forAdmintoUser.php?user_id=' . $_GET['delete'] . '&redirect=delete_userforAdmin.php?delete=' . $_GET['delete']);
    exit();
}

// Enable error reporting (optional for development)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the user ID from the URL
$userId = isset($_GET['delete']) ? intval($_GET['delete']) : 0;  // Ensure integer and handle missing ID

// Check if a valid user ID is provided
if (!$userId) {
  echo "Invalid user ID.";
  exit;
}

// Confirmation Prompt (optional for security)
if (isset($_POST['confirm_delete'])) {
  // Delete user if confirmed
  $deleteQuery = "DELETE FROM users WHERE id = ?";
  $stmt = $conn->prepare($deleteQuery);  // Prepare to prevent SQL injection
  $stmt->bind_param("i", $userId);
  $stmt->execute();

  if ($stmt->affected_rows === 1) {
    // JavaScript alert and redirect
    echo "<script>
            alert('User deleted successfully!');
            window.location.href = 'A1-Dashboard-Admin.html';
          </script>";
    exit();
  } else {
    echo "Failed to delete user.";
  }
  // Close prepared statement
  $stmt->close();
} else {
  // Display confirmation message before deleting
  echo "Are you sure you want to delete user with ID: $userId?";
  echo "<form action='' method='post'>";
  echo "<button type='submit' name='confirm_delete'>Yes</button>";
  echo "<a href='A1-Dashboard-Admin.html'>No</a>"; // Link back to dashboard
  echo "</form>";
}

