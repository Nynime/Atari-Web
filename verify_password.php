<?php
include 'database.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    $password = $_POST['password'];
    
    $selectQuery = "SELECT password FROM users WHERE id=?";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($storedPassword);
    $stmt->fetch();
    $stmt->close();

    if (password_verify($password, $storedPassword)) {
        $_SESSION['verified_user_id'] = $userId;
        header('Location: ' . $_POST['redirect']);
        exit();
    } else {
        $error = "Invalid password. Please try again.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    $password = $_POST['password'];
  
    $selectQuery = "SELECT password FROM users WHERE id=?";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($storedPassword);
    $stmt->fetch();
    $stmt->close();
  
    if (password_verify($password, $storedPassword)) {
      // Password is correct
      $_SESSION['verified_user_id'] = $userId;
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
        <input type="hidden" name="user_id" value="<?php echo $_GET['user_id']; ?>">
        <input type="hidden" name="redirect" value="<?php echo $_GET['redirect']; ?>">
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Verify</button>
    </form>
</body>
</html>

