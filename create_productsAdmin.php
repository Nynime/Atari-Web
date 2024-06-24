<?php
include 'database_admin.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Upload photo
$target_dir = "uploads/";
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$photo_path = null; // Initialize photo path variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if photo file was uploaded
    if (isset($_FILES["image_url"]) && $_FILES["image_url"]["error"] === UPLOAD_ERR_OK) {
        $target_file = $target_dir . basename($_FILES["image_url"]["name"]);
        if (move_uploaded_file($_FILES["image_url"]["tmp_name"], $target_file)) {
            $photo_path = $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Get form data
    $productName = $_POST['product_name'];
    $imageUrl = isset($photo_path) ? $photo_path : (isset($_POST['image_url']) ? $_POST['image_url'] : null); // Use uploaded file path or provided image URL
    $price = floatval($_POST['price']);
    $discountedPrice = floatval($_POST['discounted_price']);
    $description = $_POST['description'];
    $availability = intval($_POST['availability']);
    $rating = floatval($_POST['rating']);
    
    // Validate input
    if (empty($productName)) {
        $error = "Product name is required.";
    } else {
        // Insert new product into the database
        $insertQuery = "INSERT INTO products (product_name, image_url, price, discounted_price, description, availability, rating) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ssddssi", $productName, $imageUrl, $price, $discountedPrice, $description, $availability, $rating);

        if ($stmt->execute()) {
            // Redirect to added product for display after successful insertion
            header("Location: add_productToDisplay.php?product_id=". $conn->insert_id);
            exit();
        } else {
            $error = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"], select, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        input[type="file"] {
            margin-top: 5px;
        }
        input[type="submit"] {
            background-color: #009879;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }
        input[type="submit"]:hover {
            background-color: #007b63;
        }
        .back-button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            font-size: 1em;
            background-color: #009879;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-button:hover {
            background-color: #007b63;
        }
        .message {
            margin-bottom: 20px;
            font-size: 1em;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
    </style>
</head>
<body>
    <h1>Create New Product</h1>
    <?php
    if (!empty($error)) {
        echo "<div class='message error'>$error</div>";
    }
    ?>
    <form method="post" action="create_productsAdmin.php" enctype="multipart/form-data">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name">
        
        <label for="image_url">Image URL or Upload:</label>
        <input type="file" id="image_url" name="image_url"><br><br>
        
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01">
        
        <label for="discounted_price"> Before Discounted Price:</label>
        <input type="number" id="discounted_price" name="discounted_price" step="0.01">
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="5"></textarea>
        
        <label for="availability">Availability:</label>
        <select id="availability" name="availability">
            <option value="1">In Stock</option>
            <option value="0">Out of Stock</option>
        </select>
        
        <label for="rating">Rating:</label>
        <input type="number" id="rating" name="rating" step="0.1" min="0" max="5">
        
        <input type="submit" value="Create Product">
    </form>
    <a href="manage_productsAdmin.php" class='back-button'>Back to Manage Products</a>
</body>
</html>
