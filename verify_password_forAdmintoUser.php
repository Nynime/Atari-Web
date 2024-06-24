<?php
include 'database_admin.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adminPassword = $_POST['password'];

    // Ensure admin_id is retrieved from the session
    if (!isset($_SESSION['admin_id'])) {
        echo "Admin not logged in.";
        exit();
    }

    $adminId = $_SESSION['admin_id'];

    $selectQuery = "SELECT password FROM admins WHERE id=?";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bind_param("i", $adminId);
    $stmt->execute();
    $stmt->bind_result($storedPassword);
    $stmt->fetch();
    $stmt->close();

    if (password_verify($adminPassword, $storedPassword)) {
        $_SESSION['verified_user_id'] = $_POST['user_id'];
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
    <h2>Enter your admin password to proceed</h2>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <form method="post">
        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_GET['user_id']); ?>">
        <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($_GET['redirect']); ?>">
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Verify</button>
    </form>
</body>
</html>
