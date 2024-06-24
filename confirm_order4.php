<?php
// Database configuration
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

// Start session to retrieve stored data
session_start();

// Retrieve data from session
$orderSummary = json_decode($_SESSION['orderSummary'], true);
$deliveryInfo = json_decode($_SESSION['deliveryInfo'], true);
$paymentInfo = json_decode($_SESSION['paymentInfo'], true);

$product = $orderSummary['product'];
$quantity = $orderSummary['quantity'];
$total = $orderSummary['total'];
$name = $deliveryInfo['name'];
$address = $deliveryInfo['address'];
$phone = $deliveryInfo['phone'];
$email = $deliveryInfo['email'];
$card = $paymentInfo['card'];
$expiry_date = $paymentInfo['expiryDate'];

// Save order details to the database
$sql = "INSERT INTO orders (product, quantity, total, name, address, phone, email, card, expiry_date)
VALUES ('$product', '$quantity', '$total', '$name', '$address', '$phone', '$email', '$card', '$expiry_date')";

if ($conn->query($sql) === TRUE) {
    // Send receipt email
    $to = $email;
    $subject = "Receipt for Your Purchase";
    $message = "
    <html>
    <head>
    <title>Receipt for Your Purchase</title>
    </head>
    <body>
    <p>Thank you for your purchase!</p>
    <table>
    <tr><th>Product Name</th><th>Quantity</th><th>Total (RM)</th></tr>
    <tr><td>$product</td><td>$quantity</td><td>$total</td></tr>
    </table>
    <p>Name: $name</p>
    <p>Address: $address</p>
    <p>Phone: $phone</p>
    <p>Email: $email</p>
    </body>
    </html>
    ";

    // Set content-type header for HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // Additional headers
    $headers .= 'From: noreply@yourdomain.com' . "\r\n";

    mail($to, $subject, $message, $headers);

    echo "Order confirmed and receipt emailed!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
