<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase History</title>
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

        /* Purchase History Container */
        .purchase-history-container {
            padding: 20px;
            background-color: #fff;
            margin: 20px auto;
            width: 80%;
            max-width: 800px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .purchase-history-container h1 {
            margin-bottom: 20px;
            font-size: 2em;
            text-align: center;
        }

        .purchase-history-item {
            margin-bottom: 20px;
        }

        .order {
            padding: 10px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
            background-color: #f9f9f9;
        }

        .order h2 {
            margin-top: 0;
            font-size: 1.2em;
        }

        .order p {
            margin: 5px 0;
        }

        .total {
            text-align: right;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <header>
        <a href="index.html">Home</a>
        <a href="browse_items.php">Continue Shopping</a>
        <a href="order_summary.php">Order Summary</a>
    </header>

    <div class="purchase-history-container">
        <h1>Purchase History</h1>
        <div id="purchase-history"></div>
    </div>

    <script>
        function loadPurchaseHistory() {
            const purchaseHistoryContainer = document.getElementById('purchase-history');
            let orders = JSON.parse(localStorage.getItem('orders')) || [];

            purchaseHistoryContainer.innerHTML = '';
            if (orders.length === 0) {
                purchaseHistoryContainer.innerHTML = '<p>No purchase history available.</p>';
                return;
            }

            orders.forEach((order, index) => {
                let orderHTML = `
                    <div class="purchase-history-item">
                        <div class="order">
                            <h2>Order ${index + 1}</h2>
                            <p>Date: ${order.date}</p>
                `;
                let total = 0;
                order.items.forEach((item) => {
                    orderHTML += `
                        <p>${item.name} - RM ${item.price.toFixed(2)} (Quantity: ${item.quantity})</p>
                    `;
                    total += item.price * item.quantity;
                });
                orderHTML += `
                            <div class="total">Total: RM ${total.toFixed(2)}</div>
                        </div>
                    </div>
                `;
                purchaseHistoryContainer.innerHTML += orderHTML;
            });
        }

        window.onload = loadPurchaseHistory;
    </script>
</body>
</html>
