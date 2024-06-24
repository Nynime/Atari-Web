<?php
include 'database_admin.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check for duplicate username or email
    $check_stmt = $conn->prepare("SELECT * FROM admins WHERE username = ? OR email = ?");
    if ($check_stmt === false) {
        echo "Prepare failed: " . htmlspecialchars($conn->error);
        exit;
    }

    $check_bind = $check_stmt->bind_param("ss", $username, $email);
    if ($check_bind === false) {
        echo "Bind failed: " . htmlspecialchars($check_stmt->error);
        exit;
    }

    $check_execute = $check_stmt->execute();
    if ($check_execute === false) {
        echo "Execute failed: " . htmlspecialchars($check_stmt->error);
        exit;
    }

    $check_stmt->store_result();
    if ($check_stmt->num_rows > 0) {
        echo "Username or email already exists.";
        $check_stmt->close();
        $conn->close();
        exit;
    }

    $check_stmt->close();

    // Insert new admin
    $stmt = $conn->prepare("INSERT INTO admins (first_name, last_name, email, phone_number, date_of_birth, gender, username, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        echo "Prepare failed: " . htmlspecialchars($conn->error);
        exit;
    }

    $bind = $stmt->bind_param("ssssssss", $first_name, $last_name, $email, $phone_number, $date_of_birth, $gender, $username, $password);
    if ($bind === false) {
        echo "Bind failed: " . htmlspecialchars($stmt->error);
        exit;
    }

    $execute = $stmt->execute();
    if ($execute) {
        echo "success";
    } else {
        echo "Execute failed: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}

