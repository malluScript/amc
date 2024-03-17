<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .content {
            max-width: auto;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        h2 {
            font-size: 24px;
            margin: 0 0 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
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
    </style>
</head>
<body>
    <div class="content">
        <!-- Your PHP code and content here -->
 





<?php
// Include your database connection file
include("conn.php");

// Start the session (if not already started)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is authenticated
if (isset($_SESSION['admin_logged_in'])) {
    // Admin is authenticated

    // Fetch and display reports
    $getReportsSQL = "SELECT * FROM reports";
    $result = mysqli_query($conn, $getReportsSQL);

    if ($result) {
        // Display the reports in a table
        echo "<h2>Manage Reports</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Report ID</th><th>Company ID</th><th>Report Type</th><th>Report Description</th><th>Timestamp</th><th>Actions</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['report_id'] . "</td>";
            echo "<td>" . $row['company_id'] . "</td>";
            echo "<td>" . $row['report_type'] . "</td>";
            echo "<td>" . $row['report_description'] . "</td>";
            echo "<td>" . $row['report_timestamp'] . "</td>";
            echo "<td><a href='edit_report.php?report_id=" . $row['report_id'] . "'>Edit</a> | <a href='delete_report.php?report_id=" . $row['report_id'] . "'>Delete</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // If the user is not authenticated, redirect to the login page
    header("Location: admin_login.php");
    exit;
}
?>
   </div>
</body>
</html>