<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    // If the admin is not authenticated, redirect to the login page
    header("Location: login.php"); // Change this to the admin login page URL
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMC Admin Dashboard</title>
    <link rel="stylesheet" href="../amc-users/styles.css"> <!-- Adjust the path as needed -->
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">AMC Admin Dashboard</div>
            <ul class="nav-items">
                <li class="nav-item active"><a href="?section=overview">Home</a></li>
                <li class="nav-item"><a href="?section=contracts">Manage Users</a></li>
                <li class="nav-item"><a href="?section=payment">Manage Payments</a></li>
                <li class="nav-item"><a href="?section=reports">Manage Reports</a></li>
                <li class="nav-item"><a href="?section=settings">Log out</a></li>
            </ul>
        </div>
        <div class="content">
        <?php
            // Check if a section is selected
            if (isset($_GET['section'])) {
                $section = $_GET['section'];

                // Load the corresponding section based on the parameter
                switch ($section) {
                    case 'overview':
                        include('admin-home.php');
                        break;
                    case 'contracts':
                        include('manage_users.php');
                        break;
                    case 'payment':
                        include('Manage_payment.php'); // Allow the user to purchase a plan
                        break;
                    case 'reports':
                        include('manage-report.php');
                        break;
                    case 'settings':
                        include('settings.php');
                        break;
                    default:
                        echo 'Invalid section selected.';
                        break;
                }
            } else {
                // Load the default section (e.g., home or overview)
                include('admin-home.php');
            }
            ?>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
