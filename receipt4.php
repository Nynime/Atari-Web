<?php
// Start session to store data
session_start();

// Check if data was posted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Store data in session
    $_SESSION['orderSummary'] = json_encode($data['orderSummary']);
    $_SESSION['deliveryInfo'] = json_encode($data['deliveryInfo']);
    $_SESSION['paymentInfo'] = json_encode($data['paymentInfo']);

    $productName = $data['orderSummary']['product'];
    $quantity = $data['orderSummary']['quantity'];
    $total = $data['orderSummary']['total'];
    $name = $data['deliveryInfo']['name'];
    $address = $data['deliveryInfo']['address'];
    $phone = $data['deliveryInfo']['phone'];
    $email = $data['deliveryInfo']['email'];
    $card = $data['paymentInfo']['card'];
    $expiryDate = $data['paymentInfo']['expiryDate'];

    // Generate receipt HTML content
    $receiptContent = "
    <h1>Receipt</h1>
    
    <table>
    <tr><th>Product Name</th><th>Quantity</th><th>Total (RM)</th></tr>
    <tr><td>$productName</td><td>$quantity</td><td>$total</td></tr>
    </table>
    <p>Name: $name</p>
    <p>Address: $address</p>
    <p>Phone: $phone</p>
    <p>Email: $email</p>
    <button onclick='confirmOrder()'>OK</button>
    ";

    // Return the receipt HTML content
    echo json_encode(['htmlContent' => $receiptContent]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .receipt {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    
    <div class="receipt" id="receiptContent"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const orderSummary = JSON.parse(localStorage.getItem("orderSummary"));
            const deliveryInfo = JSON.parse(localStorage.getItem("deliveryInfo"));
            const paymentInfo = JSON.parse(localStorage.getItem("paymentInfo"));

            fetch('receipt4.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    orderSummary: orderSummary,
                    deliveryInfo: deliveryInfo,
                    paymentInfo: paymentInfo
                })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById("receiptContent").innerHTML = data.htmlContent;
            })
            .catch(error => console.error('Error:', error));
        });

        function confirmOrder() {
            fetch('confirm_order4.php', {
                method: 'POST'
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                window.location.href = 'thank_you4.html';
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>
