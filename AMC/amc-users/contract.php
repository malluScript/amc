<?php
// Start the session only if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include your database connection file here
include("conn.php");

if (isset($_SESSION['company_id'])) {
    $company_id = $_SESSION['company_id'];

    // Fetch the user's plan and payment details from the amc_payments table
    $sql = "SELECT selected_plan, start_date, end_date FROM amc_payments WHERE company_id = '$company_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if (isset($row['selected_plan']) && $row['selected_plan'] !== null) {
            $userPlan = $row['selected_plan'];
            $startDate = $row['start_date'];
            $endDate = $row['end_date'];

            echo "<h2>Contract Details</h2>";

            // Display contract details based on the user's plan
            switch ($userPlan) {
                case "basic":
                    // Display basic contract details
                    echo "<h3>Basic Contract Details:</h3>";
                    echo "<ul>";
                    echo "<li>Desktop</li>";
                    echo "<li>CPU</li>";
                    echo "<li>Mouse</li>";
                    echo "<li>Keyboard</li>";
                    echo "<li>Service Level: Standard</li>";
                    echo "<li>Usage Limits: Unlimited</li>";
                    echo "</ul>";
                    break;
                case "standard":
                    // Display standard contract details
                    echo "<h3>Standard Contract Details:</h3>";
                    echo "<ul>";
                    echo "<li>Desktop</li>";
                    echo "<li>CPU</li>";
                    echo "<li>Mouse</li>";
                    echo "<li>Keyboard</li>";
                    echo "<li>Printers, Scanners, Cameras</li>";
                    echo "<li>Speakers</li>";
                    echo "<li>Service Level: Enhanced</li>";
                    echo "<li>Usage Limits: 100 support requests/month</li>";
                    echo "</ul>";
                    break;
                case "premium":
                    // Display premium contract details
                    echo "<h3>Premium Contract Details:</h3>";
                    echo "<ul>";
                    echo "<li>Desktop</li>";
                    echo "<li>CPU</li>";
                    echo "<li>Mouse</li>";
                    echo "<li>Keyboard</li>";
                    echo "<li>Printers, Scanners, Cameras</li>";
                    echo "<li>Speakers</li>";
                    echo "<li>Multimedia Projectors</li>";
                    echo "<li>Disk Drives</li>";
                    echo "<li>Modems</li>";
                    echo "<li>Service Level: Premium</li>";
                    echo "<li>Usage Limits: 200 support requests/month</li>";
                    echo "</ul>";
                    break;
            }

            // Display contract start and end dates
            echo "<p>Contract Start Date: $startDate</p>";
            echo "<p>Contract End Date: $endDate</p>";

            // Display contract status
            $currentDate = date('Y-m-d');
            if ($currentDate <= $endDate) {
                echo "<p>Contract Status: Active</p>";
            } else {
                echo "<p>Contract Status: Expired</p>";
            }

            // Display renewal information (if applicable)
            // You can customize this part based on your business logic
            if ($currentDate <= $endDate) {
                echo "<p>Renewal Information: Your contract is eligible for renewal. Please check renewal terms.</p>";
            }

            // Display payment history (if applicable)
            // You can customize this part based on your business logic
            echo "<h3>Payment History:</h3>";
            $paymentHistorySql = "SELECT total_amount, payment_timestamp FROM amc_payments WHERE company_id = '$company_id'";
            $paymentHistoryResult = mysqli_query($conn, $paymentHistorySql);
            if ($paymentHistoryResult) {
                echo "<ul>";
                while ($paymentRow = mysqli_fetch_assoc($paymentHistoryResult)) {
                    $paymentAmount = $paymentRow['total_amount'];
                    $paymentTimestamp = $paymentRow['payment_timestamp'];
                    echo "<li>Payment Date: $paymentTimestamp - Amount: $$paymentAmount</li>";
                }
                echo "</ul>";
            } else {
                echo "Error fetching payment history: " . mysqli_error($conn);
            }

            // Display "Add a Contract" button if the user has a plan
            echo '<form method="post">';
            echo '<input type="hidden" name="add_contract" value="1">';
            echo '<label for="contract_name">Add a Contract:</label>';
            echo '<input type="text" name="contract_name" required>';
            echo '<button type="submit">Add a Contract</button>';
            echo '</form>';

            // ... (Your existing code)

// Display "Download Contract Details" button
echo '<form method="post" action="export_contract.php">';
echo '<button type="submit">Download Contract Details</button>';
echo '</form>';

// ... (Your existing code)

        } else {
            echo "No active plan. Please purchase a plan to access contracts.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    // Redirect the user to the login page if they are not authenticated
    header("Location: login.php");
    exit;
}
?>
