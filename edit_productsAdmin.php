<?php
// Include the database connection file
include 'database_admin.php';

session_start();

// Check if the admin is verified
if (!isset($_SESSION['verified_user_id']) || $_SESSION['verified_user_id'] != $_GET['edit']) {
    header('Location: verify_password_productsAdmin.php?product_id=' . $_GET['edit'] . '&redirect=edit_productsAdmin.php?edit=' . $_GET['edit']);
    exit();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the product ID from the URL
$productId = isset($_GET['edit']) ? intval($_GET['edit']) : 0;

// Check if a valid product ID is provided
if (!$productId) {
    echo "Invalid product ID.";
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
} else {
    echo "Product not found.";
    exit;
}

$stmt->close();
$result->close();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['product_name'];
    $price = floatval($_POST['price']);
    $discountedPrice = floatval($_POST['discounted_price']);
    $description = $_POST['description'];
    $availability = intval($_POST['availability']);
    $rating = floatval($_POST['rating']);

    // Handle image upload
    if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/'; // Directory to save uploaded files
        $uploadFile = $uploadDir . basename($_FILES['image_url']['name']);

        // Check if the directory exists and is writable
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Move uploaded file to the destination directory
        if (move_uploaded_file($_FILES['image_url']['tmp_name'], $uploadFile)) {
            $imageUrl = $uploadFile;
        } else {
            echo "Failed to upload image. Error details: ";
            print_r(error_get_last());
            exit;
        }
    } else {
        // Keep the existing image URL if no new image is uploaded
        $imageUrl = $_POST['existing_image_url'];
    }

    // Update product details
    $updateQuery = "UPDATE products SET product_name = ?, image_url = ?, price = ?, discounted_price = ?, description = ?, availability = ?, rating = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssddssii", $productName, $imageUrl, $price, $discountedPrice, $description, $availability, $rating, $productId);

    if ($stmt->execute()) {
        // Redirect to page with updated product_id
        header("Location: manage_productsAdmin.php?product_id={$productId}");
        exit();
    } else {
        echo "Failed to update product.";
    }

    $stmt->close();
}

// Display the form for editing the product
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <style>
        .star-rating {
            direction: rtl;
            display: inline-block;
            padding: 20px;
        }

        .star-rating input[type="radio"] {
            display: none;
        }

        .star-rating label {
            color: #bbb;
            font-size: 30px;
            padding: 0;
            cursor: pointer;
            -webkit-transition: all 0.3s;
            transition: all 0.3s;
        }

        .star-rating label:hover,
        .star-rating label:hover ~ label,
        .star-rating input[type="radio"]:checked ~ label {
            color: #f2b600;
        }
    </style>
</head>
<body>
    <h1>Edit Product</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($product['id'] ?? '') ?>">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" value="<?= htmlspecialchars($product['product_name'] ?? '') ?>"><br><br>
        
        <label for="image_url">Image URL:</label>
        <input type="file" name="image_url"><br><br>
        <input type="hidden" name="existing_image_url" value="<?= htmlspecialchars($product['image_url'] ?? '') ?>">
        <p>Product Image: <img src="<?= htmlspecialchars($product['image_url'] ?? '') ?>" alt="Product Image" width="100"></p>
        
        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" value="<?= htmlspecialchars($product['price'] ?? '') ?>"><br><br>
        
        <label for="discounted_price">Before Discounted Price:</label>
        <input type="number" name="discounted_price" step="0.01" value="<?= htmlspecialchars($product['discounted_price'] ?? '') ?>"><br><br>
        
        <label for="description">Description:</label><br>
        <textarea name="description" cols="30" rows="5"><?= htmlspecialchars($product['description'] ?? '') ?></textarea><br><br>
        
        <label for="availability">Availability:</label>
        <select name="availability">
            <option value="1" <?= ($product['availability'] == 1) ? 'selected' : '' ?>>In Stock</option>
            <option value="0" <?= ($product['availability'] == 0) ? 'selected' : '' ?>>Out of Stock</option>
        </select><br><br>
        
        <label for="rating">Rating:</label>
        <div class="star-rating">
            <?php for ($i = 5; $i >= 0.5; $i -= 0.5): ?>
                <input type="radio" name="rating" value="<?= $i ?>" id="star<?= $i ?>" <?= ($product['rating'] == $i) ? 'checked' : '' ?>><label for="star<?= $i ?>" title="<?= $i ?> stars">&#9733;</label>
            <?php endfor; ?>
        </div><br><br>
        
        <input type="submit" value="Update Product">
    </form>
</body>
</html>
