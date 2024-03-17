<?php
// Include your database connection file here
include("conn.php");

// Start the session (if not already started)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in as an admin (you should have an admin authentication mechanism)
if (isset($_SESSION['admin_logged_in'])) {
    // You can fetch admin-specific information here, if needed
    $adminName = "Milan Abraham"; // Replace with the actual admin name

    // Retrieve real-time user count
    $userCountQuery = "SELECT COUNT(*) as userCount FROM amc_users";
    $userCountResult = mysqli_query($conn, $userCountQuery);
    $userCountRow = mysqli_fetch_assoc($userCountResult);
    $userCount = $userCountRow['userCount'];

    $reportCountQuery = "SELECT COUNT(*) as reports FROM reports";
    $reportCountResult = mysqli_query($conn, $reportCountQuery);
    $reportCountRow = mysqli_fetch_assoc($reportCountResult);
    $reportCount = $reportCountRow['reports'];

    // Retrieve real-time payment count
    $paymentCountQuery = "SELECT COUNT(*) as paymentCount FROM amc_payments";
    $paymentCountResult = mysqli_query($conn, $paymentCountQuery);
    $paymentCountRow = mysqli_fetch_assoc($paymentCountResult);
    $paymentCount = $paymentCountRow['paymentCount'];

    ?>
    <style>
        

        .content {
            max-width: auto;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .welcome-section {
            background-color: #007BFF;
            color: white;
            padding: 20px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .welcome-section h2 {
            font-size: 24px;
            margin: 0;
        }

        .welcome-section p {
            font-size: 16px;
            margin: 0;
        }

        .stats-section {
            margin-top: 20px;
            padding: 20px;
            border-radius: 5px;
        }

        .stats-section h2 {
            font-size: 20px;
        }

        .stats-section ul {
            list-style: none;
            padding: 0;
        }

        .stats-section li {
            font-size: 18px;
            margin-bottom: 10px;
        }
    </style>
    
            <div class="content">
                <div class="welcome-section">
                    <h2>Welcome, <?php echo $adminName; ?></h2>
                    <!-- <p>This is your admin dashboard. You can manage users, reports, payments, and your admin settings here.</p> -->
                </div>

                <div class="stats-section">
                    <h2>Statistics</h2>
                    <ul>
                        <li>Total Users: <?php echo $userCount; ?></li>
                        <li>Total Payments: <?php echo $paymentCount; ?></li>
                        <li>Total Reports: <?php echo $reportCount ; ?></li>
                    </ul>
                </div>

                <!-- Add more widgets, sections, and content here -->

            
            </div>
     
    <?php
} else {
    // Redirect the user to the admin login page if they are not authenticated as an admin
    header("Location: login.php"); // Adjust the URL to your admin login page
    exit;
}
