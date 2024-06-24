<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
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

        /* Cart Styles */
        .cart-container {
            padding: 20px;
            background-color: #fff;
            margin: 20px auto;
            width: 80%;
            max-width: 800px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #ccc;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .cart-item p {
            margin: 0;
        }

        .cart-item input {
            width: 60px;
            text-align: center;
        }

        .cart-item button {
            padding: 8px 16px;
            background-color: #f44336;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .cart-item button:hover {
            background-color: #e53935;
        }

        .total {
            text-align: right;
            font-size: 1.2em;
            margin-top: 20px;
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
        <a href="A1-Dashboard-Test.html">Home</a>
        <a href="browse_items_user.php">Continue Shopping</a>
    </header>

    <div class="cart-container">
        <h1>Your Cart</h1>
        <div id="cart-items"></div>
        <div class="total" id="total-amount"></div>
        <button class="checkout-button" onclick="proceedToCheckout()">Proceed to Checkout</button>
    </div>

    <script>
        function loadCart() {
            const cartItems = document.getElementById('cart-items');
            const totalAmount = document.getElementById('total-amount');
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            cartItems.innerHTML = '';
            let total = 0;
            cart.forEach((item, index) => {
                cartItems.innerHTML += `
                    <div class="cart-item">
                        <p>${item.name} - RM ${item.price.toFixed(2)}</p>
                        <input type="number" min="1" value="${item.quantity}" onchange="updateQuantity(${index}, this.value)">
                        <button onclick="removeFromCart(${index})">Remove</button>
                    </div>
                `;
                total += item.price * item.quantity;
            });
            totalAmount.innerHTML = `Total: RM ${total.toFixed(2)}`;
        }

        function updateQuantity(index, newQuantity) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            cart[index].quantity = parseInt(newQuantity);
            localStorage.setItem('cart', JSON.stringify(cart));
            loadCart();
        }

        function removeFromCart(index) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            cart.splice(index, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            loadCart();
        }

        function proceedToCheckout() {
            const user = JSON.parse(localStorage.getItem('user'));
            if (user) {
                window.location.href = 'checkout_member.php';
            } else {
                window.location.href = 'checkout_public.php';  // redirect to a public checkout if the user is not logged in
            }
        }

        window.onload = loadCart;
    </script>
</body>
</html>
