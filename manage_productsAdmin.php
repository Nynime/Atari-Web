<?php
include 'database_admin.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Retrieve records from the database
$selectQuery = "SELECT * FROM products";
$result = $conn->query($selectQuery);

echo "<!DOCTYPE html>
<html>
<head>
    <title>Manage Products</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 1em;
            font-family: Arial, sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #009879;
            color: #ffffff;
        }
        tr:nth-child(even) {
            background-color: #f3f3f3;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a {
            color: #009879;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .back-button, .create-button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            font-size: 1em;
            font-family: Arial, sans-serif;
            background-color: #009879;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-button:hover, .create-button:hover {
            background-color: #007b63;
        }
    </style>
</head>
<body>";

echo "<h1>Manage Products</h1>";

echo "<a href='create_productsAdmin.php' class='create-button'>Create New Product</a>";

if ($result->num_rows > 0) {
    echo "<table>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Actions</th>
        </tr>";
        while($row = $result->fetch_assoc()) {
        echo "<tr>
              <td>" . htmlspecialchars($row["id"]) . "</td>
                    <td>" . htmlspecialchars($row["product_name"]) . "</td>
                    <td>
                        <a href='get_product_detailsAdmin.php?product_id=" . htmlspecialchars($row["id"]) . "'>View Details</a>
                        <a href='verify_password_productsAdmin.php?product_id=" . htmlspecialchars($row["id"]) . "&redirect=edit_productsAdmin.php?edit=" . htmlspecialchars($row["id"]) . "'>Update</a>
                        <a href='verify_password_productsAdmin.php?product_id=" . htmlspecialchars($row["id"]) . "&redirect=delete_productsAdmin.php?delete=" . htmlspecialchars($row["id"]) . "'>Delete</a>
              </td>
        
        </tr>";
        }
    echo "</table>";
} else {
    echo "No records found.";
}

echo "<a href='A1-Dashboard-Admin.html' class='back-button'>Back to Dashboard</a>";

echo "</body></html>";

// Close the database connection
$conn->close();
?>
