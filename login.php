<?php
// Include the database connection file
include 'database.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare the SQL query to retrieve the user's information
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User exists, verify the password
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password"];

        if (password_verify($password, $hashedPassword)) {
            // Password is correct, start a new session and store user details
            session_start();
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["first_name"] = $row["first_name"];
            $_SESSION["last_name"] = $row["last_name"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["phone_number"] = $row["phone_number"];
            $_SESSION["date_of_birth"] = $row["date_of_birth"];
            $_SESSION["gender"] = $row["gender"];

            // Redirect to the desired page after successful login
            header("Location: manage_users.php");
            exit();
        } else {
            // Password is incorrect
            $error = "Invalid username or password";
        }
    } else {
        // User does not exist
        $error = "Invalid username or password";
    }
}
?>

<!-- HTML form for user login -->
<!DOCTYPE html>
<html>
<head>
  <title>User Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    form {
      max-width: 300px;
      margin: 0 auto;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-bottom: 15px;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .error {
      color: red;
      margin-bottom: 10px;
    }
    .back-button-container {
      position: absolute;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
      text-align: center;
    }
  </style>
</head>
<body>
  <h2>User Login</h2>
  <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="username">Username:</label>
    <input type="text" name="username" required><br>
    <label for="password">Password:</label>
    <input type="password" name="password" required><br>
    <input type="submit" name="submit" value="Login">
  </form>
  <div class="back-button-container">
    <a href='A1-Dashboard-Test.html' class='back-button'>Back to Dashboard</a>
  </div>

</body>
</html>
