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

$username = $_SESSION['username'];
$userId = $_GET['user_id'];

// Retrieve the user record from the database based on the user_id
$selectQuery = "SELECT * FROM users WHERE id = '$userId'";
$result = $conn->query($selectQuery);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $firstName = $row["first_name"];
    $lastName = $row["last_name"];
    $email = $row["email"];
    $phoneNumber = $row["phone_number"];
    $dateOfBirth = $row["date_of_birth"];
    $gender = $row["gender"];
} else {
    echo "No user found.";
    exit();
}

// Update user details if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phone_number"];
    $dateOfBirth = $_POST["date_of_birth"];
    $gender = $_POST["gender"];

    $updateQuery = "UPDATE users SET first_name = '$firstName', last_name = '$lastName', email = '$email', phone_number = '$phoneNumber', date_of_birth = '$dateOfBirth', gender = '$gender' WHERE id = '$userId'";

    if ($conn->query($updateQuery) === TRUE) {
        header("Location: edit_user.php?user_id=$userId&success=1");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <style>
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
        .edit-form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        .edit-form p {
            margin: 10px 0;
            color: #666666;
        }
        .edit-form input, .edit-form select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #cccccc;
            border-radius: 5px;
        }
        .edit-form button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .edit-form button:hover {
            background-color: #0056b3;
        }
        .back-button {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }
        .back-button:hover {
            text-decoration: underline;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Edit User Details</h2>
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <div class="success-message">User details updated successfully.</div>
    <?php endif; ?>
    <form class="edit-form" action="" method="POST">
        <p><strong>First Name:</strong></p>
        <input type="text" name="first_name" value="<?php echo htmlspecialchars($firstName); ?>" required>
        <p><strong>Last Name:</strong></p>
        <input type="text" name="last_name" value="<?php echo htmlspecialchars($lastName); ?>" required>
        <p><strong>Email:</strong></p>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
        <p><strong>Phone Number:</strong></p>
        <input type="text" name="phone_number" value="<?php echo htmlspecialchars($phoneNumber); ?>" required>
        <p><strong>Date of Birth:</strong></p>
        <input type="date" name="date_of_birth" value="<?php echo htmlspecialchars($dateOfBirth); ?>" required>
        <p><strong>Gender:</strong></p>
        <select name="gender" required>
            <option value="Male" <?php if ($gender == "Male") echo "selected"; ?>>Male</option>
            <option value="Female" <?php if ($gender == "Female") echo "selected"; ?>>Female</option>
        </select>
        <button type="submit">Update</button>
    </form>
    <a href="manage_users.php" class="back-button">Back to Manage Users</a>
</body>
</html>
