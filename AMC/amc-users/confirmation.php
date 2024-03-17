<?php
if (isset($_POST["selected_plan"], $_POST["total_amount"], $_POST["payment_method"], $_POST["name"], $_POST["company_id"])) {
    // Retrieve payment details from the form
    $selectedPlan = $_POST["selected_plan"];
    $totalAmount = $_POST["total_amount"];
    $paymentMethod = $_POST["payment_method"];
    $userName = $_POST["name"];
    $companyID = $_POST["company_id"];

    // Assuming you have established a database connection earlier
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

    // Calculate start and end dates
    $startDate = date('Y-m-d');
    $planDuration = 365; // Assuming 1 year duration, adjust as needed
    $endDate = date('Y-m-d', strtotime($startDate . ' + ' . $planDuration . ' days'));

    // Prepare the INSERT statement with placeholders
    $insertPaymentQuery = $conn->prepare("INSERT INTO amc_payments (company_id, company_name, selected_plan, total_amount, payment_method, start_date, end_date, payment_timestamp) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");

    // Check if the prepare statement succeeded
    if (!$insertPaymentQuery) {
        echo "Prepare statement failed: " . $conn->error;
    }

    // Bind parameters and execute the query
    $insertPaymentQuery->bind_param("sssdsss", $companyID, $userName, $selectedPlan, $totalAmount, $paymentMethod, $startDate, $endDate);
    if ($insertPaymentQuery->execute()) {
        // Payment data inserted successfully
        echo "<h2>Order Confirmation</h2>";
        echo "<p>Your order has been received. Thank you for your payment!</p>";
        echo "User's Name: " . $userName;
        echo "<br>";
        echo "Plan: $selectedPlan"; // Ensure the plan is displayed
        echo '<a href="dashboard.php">Back to Dashboard</a>';
    } else {
        // Handle the case where insertion fails and display the error
        echo "<h2>Error</h2>";
        echo "<p>Error: Payment data could not be recorded.</p>";
    }

    // Close the database connection
    $conn->close();
} else {
    // If the required data is not defined, display an error message
    echo "<h2>Error</h2>";
    echo "<p>Invalid request. Please select a plan, total amount, payment method, and company ID first.</p>";
}
?>
