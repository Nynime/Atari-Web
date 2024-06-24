<?php
include 'database_admin.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adminId = $_POST['admin_id'];
    $password = $_POST['password'];
    
    $selectQuery = "SELECT password FROM admins WHERE id=?";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bind_param("i", $adminId);
    $stmt->execute();
    $stmt->bind_result($storedPassword);
    $stmt->fetch();
    $stmt->close();

    if (password_verify($password, $storedPassword)) {
        $_SESSION['verified_admin_id'] = $adminId;
        header('Location: ' . $_POST['redirect']);
        exit();
    } else {
        $error = "Invalid password. Please try again.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Verify Password</title>
</head>
<body>
    <h2>Enter your password to proceed</h2>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="post">
        <input type="hidden" name="admin_id" value="<?php echo $_GET['admin_id']; ?>">
        <input type="hidden" name="redirect" value="<?php echo $_GET['redirect']; ?>">
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Verify</button>
    </form>
</body>
</html>

