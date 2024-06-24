<?php
// Include the database connection file
include 'database.php';

session_start();

if (!isset($_SESSION['verified_user_id']) || $_SESSION['verified_user_id'] != $_GET['edit']) {
    header('Location: verify_password_forAdmintoUser.php?user_id=' . $_GET['edit'] . '&redirect=edit_userforAdmin.php?edit=' . $_GET['edit']);
    exit();
}

// Enable error reporting (optional for development)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the user ID from the URL
$userId = isset($_GET['edit']) ? intval($_GET['edit']) : 0;  // Ensure integer and handle missing ID

// Check if a valid user ID is provided
if (!$userId) {
  echo "Invalid user ID.";
  exit;
}

// Fetch user details
$selectQuery = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($selectQuery);  // Prepare to prevent SQL injection
$stmt->bind_param("i", $userId);  // Bind user ID as integer parameter
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
  $user = $result->fetch_assoc();
} else {
  echo "User not found.";
  exit;
}

// Close prepared statement and result set
$stmt->close();
$result->close();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Capture updated user information
  $firstName = $_POST['first_name'];
  $lastName = $_POST['last_name'];
  $email = $_POST['email'];
  $phoneNumber = $_POST['phone_number'];
  $dateOfBirth = $_POST['date_of_birth'];
  $gender = $_POST['gender'];
  $originalGender = $_POST['original_gender'];
  $username = $_POST['username'];

  // Update user details (remember to escape user input)
  if ($gender !== $originalGender) {
    $updateQuery = "UPDATE users SET first_name = ?, last_name = ?, email = ?, phone_number = ?, date_of_birth = ?, gender = ?, username = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("sssssssi", $firstName, $lastName, $email, $phoneNumber, $dateOfBirth, $gender, $username, $userId);
  } else {
    $updateQuery = "UPDATE users SET first_name = ?, last_name = ?, email = ?, phone_number = ?, date_of_birth = ?, username = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssssssi", $firstName, $lastName, $email, $phoneNumber, $dateOfBirth, $username, $userId);
  }

  // Execute update query and handle success/failure
  if ($stmt->execute()) {
    echo "<script>
          alert('User updated successfully!');
          window.location.href = 'A1-Dashboard-Admin.html';
          </script>";
          exit();
  } else {
    echo "Failed to update user.";
    // Optional: Include error details from $stmt->error
  }

  // Close prepared statement
  $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit User</title>
</head>
<body>
  <h1>Edit User</h1>
  <?php if (isset($user)): ?>
  <form action="" method="post">
    <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
    <label for="first_name">First Name:</label>
    <input type="text" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>"><br><br>
    <label for="last_name">Last Name:</label>
    <input type="text" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>"><br><br>
    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>"><br><br>
    <label for="phone_number">Phone Number:</label>
    <input type="tel" name="phone_number" value="<?php echo htmlspecialchars($user['phone_number']); ?>"><br><br>
    <label for="date_of_birth">Date of Birth:</label>
    <input type="date" name="date_of_birth" value="<?php echo htmlspecialchars($user['date_of_birth']); ?>"><br><br>
    <label for="gender">Gender:</label>
    <select name="gender">
      <option value="male" <?= ($user['gender'] === 'Male') ? 'selected' : '' ?>>Male</option>
      <option value="female" <?= ($user['gender'] === 'Female') ? 'selected' : '' ?>>Female</option>
    </select>
    <input type="hidden" name="original_gender" value="<?= htmlspecialchars($user['gender']); ?>"><br><br>
    <label for="username">Username:</label>
    <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>">  <br><br>
    <button type="submit">Save Changes</button>
  </form>
  <?php endif; ?>
</body>
</html>
