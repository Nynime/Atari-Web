<?php
// Include the database connection file
include 'database_admin.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

$error = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare the SQL query to retrieve the user's information
    $sql = "SELECT * FROM admins WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

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
            header("Location: A1-Dashboard-Admin.html");
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

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('cover.jpg'); 
            background-size: cover; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-form {
            width: 400px;
            height: auto;
            background-color: rgb(83, 103, 161);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        .login-form h2, .login-form h3, .login-form h4 {
            text-align: center;
        }
        .login-form input[type="text"], .login-form input[type="password"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 20px;
            border: 1px solid #f0f0f2;
        }
        .login-form button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #000000;
            color: white;
            border: none;
            border-radius: 20px;
            margin-top: 40px; /* Add space above the button */
        }
        .forgot-password {
            text-align: center;
            margin-bottom: 40px; /* Add space below the text */
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <h2>ATARI BEST ELECTRONIC</h2>
        <h2>Administrator</h2>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
        <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <h3>Username</h3>
            <input type="text" id="username" name="username" placeholder="Username" required>
            <h3>Password</h3>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <div class="forgot-password">
                <a href="index_Admin_Assignment2.html">Forgot Password?</a>
            </div>
            <button type="submit">LOGIN</button>
        </form>
    </div>
</body>
</html>
