<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "order_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$period = $_GET['period'];

if ($period == 'daily') {
    $sql = "SELECT * FROM transactions WHERE DATE(transaction_date) = CURDATE()";
} elseif ($period == 'weekly') {
    $sql = "SELECT * FROM transactions WHERE WEEK(transaction_date) = WEEK(CURDATE())";
} elseif ($period == 'monthly') {
    $sql = "SELECT * FROM transactions WHERE MONTH(transaction_date) = MONTH(CURDATE())";
} else {
    $sql = "SELECT * FROM transactions";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table table-striped'><tr><th>ID</th><th>Customer Name</th><th>Amount</th><th>Transaction Date</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["customer_name"]. "</td><td>" . $row["amount"]. "</td><td>" . $row["transaction_date"]. "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
