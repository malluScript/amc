<?php
// Include your database connection file
include("conn.php");

// Start the session (if not already started)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in as an admin (you should have an admin authentication mechanism)
if (isset($_SESSION['admin_logged_in'])) {
    // Query the database to fetch payment information
    $paymentSQL = "SELECT * FROM amc_payments"; // You can adjust the query based on your database structure
    $paymentResult = mysqli_query($conn, $paymentSQL);

    ?>
    <!DOCTYPE html>
<html>
<head>
    <title>Manage Payments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            font-size: 24px;
            margin: 20px 0;
        }

        #payment-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
            color: #007BFF;
        }

        a:hover {
            text-decoration: underline;
        }

        hr {
            margin: 10px 0;
            border: none;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h2>Manage Payments</h2>

    <?php
    // Check if payments exist
    if (mysqli_num_rows($paymentResult) > 0) {
        // You can iterate through the results and display payment information here
        // Example:
        echo '<table id="payment-table">';
        echo '<tr><th>Company ID</th><th>Company Name</th><th>Selected Plan</th><th>Amount Paid</th><th>Payment Method</th></tr>';
        while ($row = mysqli_fetch_assoc($paymentResult)) {
            echo '<tr>';
            echo '<td>' . $row['company_id'] . '</td>';
            echo '<td>' . $row['company_name'] . '</td>';
            echo '<td>' . $row['selected_plan'] . '</td>';
            echo '<td>' . $row['total_amount'] . '</td>';
            echo '<td>' . $row['payment_method'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'No payments found.';
    }
    ?>

    <!-- You can add more content here for managing payments, such as options to edit or delete payments -->

    <a href="dashboard.php">Back to Admin Dashboard</a>
</body>
</html>

    <?php
} else {
    // Redirect the user to the admin login page if they are not authenticated as an admin
    header("Location: admin_login.php"); // Adjust the URL to your admin login page
    exit;
}
?>
