<?php
// Include the database connection file
include 'database_admin.php';

// Get the product ID from the URL
$productId = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;

// Check if a valid product ID is provided
if (!$productId) {
    echo json_encode(['error' => 'Invalid product ID.']);
    exit;
}

// Fetch product details
$selectQuery = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($selectQuery);
$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $product = $result->fetch_assoc();
    echo json_encode($product);
} else {
    echo json_encode(['error' => 'Product not found.']);
}

$stmt->close();
$result->close();
?>
