<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
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

        /* Checkout Container */
        .checkout-container {
            padding: 20px;
            background-color: #fff;
            margin: 20px auto;
            width: 80%;
            max-width: 800px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .checkout-container h1 {
            margin-bottom: 20px;
            font-size: 2em;
            text-align: center;
        }

        .checkout-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #ccc;
        }

        .checkout-item:last-child {
            border-bottom: none;
        }

        .checkout-item p {
            margin: 0;
        }

        .total {
            text-align: right;
            font-size: 1.2em;
            margin-top: 20px;
        }

        .payment-info {
            margin-top: 20px;
        }

        .payment-info label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .payment-info input,
        .payment-info select {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .checkout-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 1em;
            cursor: pointer;
        }

        .checkout-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <a href="index.html">Home</a>
        <a href="browse_items.php">Continue Shopping</a>
    </header>

    <div class="checkout-container">
        <h1>Checkout</h1>
        <div id="checkout-items"></div>
        <div class="total" id="total-amount"></div>
        
        <div class="payment-info">
            <label for="card-name">Cardholder Name</label>
            <input type="text" id="card-name" name="card_name" required>

            <label for="card-number">Card Number</label>
            <input type="text" id="card-number" name="card_number" required pattern="\d{16}" title="Please enter a valid 16-digit card number">

            <label for="expiry-date">Expiry Date</label>
            <input type="month" id="expiry-date" name="expiry_date" required>

            <label for="cvv">CVV</label>
            <input type="text" id="cvv" name="cvv" required pattern="\d{3}" title="Please enter a valid 3-digit CVV">
        </div>

        <button class="checkout-button" onclick="completeCheckout()">Complete Purchase</button>
    </div>

    <script>
        function loadCheckoutItems() {
            const checkoutItems = document.getElementById('checkout-items');
            const totalAmount = document.getElementById('total-amount');
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            checkoutItems.innerHTML = '';
            let total = 0;
            cart.forEach((item) => {
                checkoutItems.innerHTML += `
                    <div class="checkout-item">
                        <p>${item.name} - RM ${item.price.toFixed(2)}</p>
                        <p>Quantity: ${item.quantity}</p>
                    </div>
                `;
                total += item.price * item.quantity;
            });
            totalAmount.innerHTML = `Total: RM ${total.toFixed(2)}`;
        }

        function completeCheckout() {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const user = JSON.parse(localStorage.getItem('user'));
            const order = {
                items: cart,
                date: new Date().toLocaleString(),
                total: cart.reduce((sum, item) => sum + item.price * item.quantity, 0)
            };

            let orders = JSON.parse(localStorage.getItem('orders')) || [];
            orders.push(order);
            localStorage.setItem('orders', JSON.stringify(orders));
            
            localStorage.removeItem('cart');
            alert('Thank you for your purchase!');
            window.location.href = 'order_summary.php';
        }

        window.onload = loadCheckoutItems;
    </script>
</body>
</html>
