<?php
// Include the database connection file
include 'database.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Retrieve records from the database
$selectQuery = "SELECT * FROM users";
$result = $conn->query($selectQuery);

if ($result->num_rows > 0) {
    echo "<!DOCTYPE html>
          <html>
          <head>
            <title>Manage Users Acc</title>
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
                .back-button {
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
                .back-button:hover {
                    background-color: #007b63;
                }
            </style>
          </head>
          <body>";
          
    echo "<table>
            <tr>
                <h2>Manage Users Accounts</h2>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row["id"]) . "</td>
                <td>" . htmlspecialchars($row["first_name"]) . "</td>
                <td>" . htmlspecialchars($row["last_name"]) . "</td>
                <td>" . htmlspecialchars($row["email"]) . "</td>
                <td>" . htmlspecialchars($row["phone_number"]) . "</td>
                <td>" . htmlspecialchars($row["date_of_birth"]) . "</td>
                <td>" . htmlspecialchars($row["gender"]) . "</td>
                <td>" . htmlspecialchars($row["username"]) . "</td>
                <td>
                    <a href='verify_password_forAdmintoUser.php?user_id=" . htmlspecialchars($row["id"]) . "&redirect=edit_userforAdmin.php?edit=" . htmlspecialchars($row["id"]) . "'>Update</a>
                    <a href='verify_password_forAdmintoUser.php?user_id=" . htmlspecialchars($row["id"]) . "&redirect=delete_user.php?delete=" . htmlspecialchars($row["id"]) . "'>Delete</a>
                </td>
            </tr>";
    }
    echo "</table>";

    echo "<a href='A1-Dashboard-Admin.html' class='back-button'>Back to Dashboard</a>";

    echo "</body></html>";
} else {
    echo "No records found.";
}

// Close the database connection
$conn->close();

