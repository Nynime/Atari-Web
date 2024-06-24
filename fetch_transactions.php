<?php
// fetch_transactions.php

// Database connection details
$host = 'localhost';
$db = 'order_db';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if 'period' is set in $_POST
if (isset($_POST['period'])) {
    $period = $_POST['period'];

    // Define date ranges based on the selected period
    $dateRanges = [
        'daily' => '1 DAY',
        'weekly' => '1 WEEK',
        'monthly' => '1 MONTH'
    ];

    if (array_key_exists($period, $dateRanges)) {
        $dateRange = $dateRanges[$period];

        // Prepare and execute SQL query to fetch customer_name, transaction_date, amount
        $query = $pdo->prepare("
            SELECT customer_name, transaction_date, amount 
            FROM transactions 
            WHERE transaction_date >= NOW() - INTERVAL $dateRange
        ");
        $query->execute();

        $transactions = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($transactions) {
            echo '<table class="table table-striped">';
            echo '<thead><tr><th>Customer Name</th><th>Date</th><th>Amount (RM)</th></tr></thead><tbody>';
            foreach ($transactions as $transaction) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($transaction['customer_name']) . '</td>';
                echo '<td>' . htmlspecialchars($transaction['transaction_date']) . '</td>';
                echo '<td>' . htmlspecialchars($transaction['amount']) . '</td>';
                echo '</tr>';
            }
            echo '</tbody></table>';
        } else {
            echo '<p>No transactions found for the selected period.</p>';
        }
    } else {
        echo '<p>Invalid period selected.</p>';
    }
} else {
    echo '<p>Period parameter not received.</p>';
}
?>
