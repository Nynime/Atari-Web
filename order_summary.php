<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Summary</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        /* Header Styles */
        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            padding: 10px;
        }

        /* Order Summary Container */
        .order-summary-container {
            padding: 20px;
            background-color: #fff;
            margin: 20px auto;
            width: 80%;
            max-width: 800px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .order-summary-container h1 {
            margin-bottom: 20px;
            font-size: 2em;
            text-align: center;
        }

        .order-summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #ccc;
        }

        .order-summary-item:last-child {
            border-bottom: none;
        }

        .order-summary-item p {
            margin: 0;
        }

        .total {
            text-align: right;
            font-size: 1.2em;
            margin-top: 20px;
        }

        .thank-you {
            text-align: center;
            font-size: 1.5em;
            margin-top: 20px;
            color: #4CAF50;
        }
    </style>
</head>
<body>
    <header>
        <a href="index.html">Home</a>
        <a href="browse_items.php">Continue Shopping</a>
        <a href="purchase_history.php">Purchase History</a>
    </header>

    <div class="order-summary-container">
        <h1>Order Summary</h1>
        <div id="order-summary-items"></div>
        <div class="total" id="total-amount"></div>
        <div class="thank-you">Thank you for your purchase!</div>
    </div>

    <script>
        function loadOrderSummary() {
            const orderSummaryItems = document.getElementById('order-summary-items');
            const totalAmount = document.getElementById('total-amount');
            let orders = JSON.parse(localStorage.getItem('orders')) || [];
            const lastOrder = orders[orders.length - 1];
            
            orderSummaryItems.innerHTML = '';
            let total = 0;
            lastOrder.items.forEach((item) => {
                orderSummaryItems.innerHTML += `
                    <div class="order-summary-item">
                        <p>${item.name} - RM ${item.price.toFixed(2)}</p>
                        <p>Quantity: ${item.quantity}</p>
                    </div>
                `;
                total += item.price * item.quantity;
            });
            totalAmount.innerHTML = `Total: RM ${total.toFixed(2)}`;
        }

        window.onload = loadOrderSummary;
    </script>
</body>
</html>
