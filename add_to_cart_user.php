<?php
// Include the database connection file
include 'database_products.php';

// Start the session
session_start();

// Check if item_id is set
if (isset($_POST['item_id'])) {
    $itemId = mysqli_real_escape_string($conn, $_POST['item_id']);

    // Retrieve the item from the database
    $selectQuery = "SELECT * FROM items WHERE id = '$itemId'";
    $result = $conn->query($selectQuery);

    if ($result->num_rows > 0) {
        $item = $result->fetch_assoc();

        // Add item to the session cart
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Check if item is already in the cart
        $found = false;
        foreach ($_SESSION['cart'] as &$cartItem) {
            if ($cartItem['id'] == $itemId) {
                $cartItem['quantity'] += 1;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $item['quantity'] = 1;
            $_SESSION['cart'][] = $item;
        }

        echo "Item added to cart successfully.";
    } else {
        echo "Item not found.";
    }
} else {
    echo "No item ID provided.";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add to Cart</title>
</head>
<body>
    <h1>Add to Cart</h1>
    <p>
        <a href="cart_user.php">View Cart</a>
    </p>
</body>
</html>
