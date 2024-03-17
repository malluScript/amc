<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Overview</title>
    <style>
        /* Add your CSS styles here */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Dashboard Overview</h2>

    <div>
        <h3>User Information</h3>
        <?php
        if (isset($_SESSION['username'], $_SESSION['email'])) {
            echo "<p><strong>Username:</strong> {$_SESSION['username']}</p>";
            echo "<p><strong>Email:</strong> {$_SESSION['email']}</p>";
        } else {
            echo "User information not found.";
        }
        ?>
    </div>

    <div>
        <h3>Recent Activities</h3>
        <ul>
            <li>Logged in at 10:15 AM.</li>
            <li>Updated profile information.</li>
            <li>Posted a new article.</li>
        </ul>
    </div>

    <div>
        <h3>Recent Orders</h3>
        <?php
        // Database connection setup (replace with your database details)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "amc";

        // Create a new connection to the database
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to retrieve recent orders
        $query = "SELECT order_id, product_name, order_date, order_status FROM orders";

        // Execute the query
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo '<table>';
            echo '<tr><th>Order ID</th><th>Product Name</th><th>Order Date</th><th>Order Status</th></tr>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['order_id'] . '</td>';
                echo '<td>' . $row['product_name'] . '</td>';
                echo '<td>' . $row['order_date'] . '</td>';
                echo '<td>' . $row['order_status'] . '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo 'No recent orders found.';
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>
</html>
