<?php
// Include the database connection file
include 'database_products.php';

// Handle form submission for new product creation
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Insert new product into the database
    $query = "INSERT INTO items (name, description, price) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssd", $name, $description, $price);
    
    if ($stmt->execute()) {
        // Retrieve the auto-generated product ID
        $product_id = $stmt->insert_id;

        // Generate the details link based on the product ID
        $details_link = 'get_product_detailsAdmin.php?product_id=' . $product_id;

        // Update the details_link in the database
        $updateQuery = "UPDATE items SET details_link = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("si", $details_link, $product_id);
        $updateStmt->execute();
        
        echo "Product added successfully!";
    } else {
        echo "Error adding product: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Products</title>
</head>
<body>
    <h1>New Product details</h1>
    <form method="post" action="">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required><br><br>

        <button type="submit">Add Product</button>
    </form>
    <a href="manage_productsAdmin.php" class='back-button'>Back to Manage Products</a>
</body>
</html>
