<?php
include 'database_admin.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $selectQuery = "SELECT id, password FROM admins WHERE username=?";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($adminId, $storedPassword);
    $stmt->fetch();
    $stmt->close();

    if (password_verify($password, $storedPassword)) {
        $_SESSION['admin_id'] = $adminId;
        header('Location: A1-Dashboard-Admin.html');
        exit();
    } else {
        $error = "Invalid username or password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>
    <h2>Admin Login</h2>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
