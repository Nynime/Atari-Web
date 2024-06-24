<?php
// Include the database connection file
include 'database_products.php';

// Check if there is a search query
$search_query = '';
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
}

// Fetch items from the database based on the search query
$query = "SELECT * FROM items WHERE name LIKE '%$search_query%' OR description LIKE '%$search_query%'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Search</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('cover.jpg');
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

        /* Search Form Styles */
        .search-container {
            display: flex;
            justify-content: center;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .search-container input[type="text"] {
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 4px 0 0 4px;
            width: 300px;
        }

        .search-container button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 0 4px 4px 0;
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
        }

        /* Product List Styles */
        .product-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }

        .product {
            border: 1px solid #ccc;
            padding: 16px;
            margin: 16px;
            width: 300px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .product h2 {
            font-size: 1.5em;
            margin-top: 0;
        }

        .product p {
            margin: 8px 0;
        }

        .product a {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 16px;
            background-color: #144b73;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }

        .product button {
            padding: 8px 16px;
            background-color: #98AFC7;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        .product button:hover {
            background-color: #98AFC7;
        }
    </style>
</head>
<body>
    <header>
        <a href="A1-Dashboard-Test.html">Back to Home Page</a>
        <a href="cart_user.php"><i class="fa fa-shopping-cart"></i> MyCart</a>
    </header>

    <div class="search-container">
        <form method="get" action="">
            <input type="text" name="search" value="<?php echo htmlspecialchars($search_query); ?>" placeholder="Search products...">
            <button type="submit">Search</button>
        </form>
    </div>

    <?php if ($result->num_rows > 0) { ?>
        <div class="product-list">
            <?php while($row = $result->fetch_assoc()) { ?>
                <div class="product">
                    <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                    <p>Product ID: <?php echo htmlspecialchars($row['id']); ?></p>
                    <p>Price: RM <?php echo htmlspecialchars($row['price']); ?></p>
                    <a href="<?php echo htmlspecialchars($row['details_link']); ?>">View More</a>
                    <button onclick="addToCart(<?php echo $row['id']; ?>, '<?php echo $row['name']; ?>', <?php echo $row['price']; ?>)">Add to Cart</button>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <p style="text-align: center; margin-top: 20px;">No products found.</p>
    <?php } ?>

    <?php
    // Close the database connection
    $conn->close();
    ?>

    <script>
        function addToCart(id, name, price) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            cart.push({id, name, price});
            localStorage.setItem('cart', JSON.stringify(cart));
            alert(name + ' added to cart.');
        }
    </script>
</body>
</html>
