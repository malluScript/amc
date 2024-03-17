<?php
if (isset($_POST["selected_plan"], $_POST["total_amount"], $_POST["payment_method"], $_POST["name"])) {
    // Retrieve payment details from the form
    $selectedPlan = $_POST["selected_plan"];
    $totalAmount = $_POST["total_amount"];
    $paymentMethod = $_POST["payment_method"];
    $userName = $_POST["name"];

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

    // Insert payment data into the "payments" table
    $insertPaymentQuery = "INSERT INTO payments (user_name, selected_plan, total_amount, payment_method, payment_timestamp) VALUES ('$userName', '$selectedPlan', '$totalAmount', '$paymentMethod', NOW())";

    // Execute the query to insert the payment data
    if ($conn->query($insertPaymentQuery) === TRUE) {
        // Payment data inserted successfully
        echo "<h2>Order Confirmation</h2>";
        echo "<p>Your order has been received. Thank you for your payment!</p>";
        echo "User's Name: " . $userName;

        // Add a link/button to add a contract
        echo '<a href="add_contract.php?username='.$userName.'&selected_plan='.$selectedPlan.'">Add Contract</a>';
    } else {
        // Handle the case where insertion fails
        echo "<h2>Error</h2>";
        echo "<p>Error: Payment data could not be recorded.</p>";
    }

    // Close the database connection
    $conn->close();
} else {
    // If the required data is not defined, display an error message
    echo "<h2>Error</h2>";
    echo "<p>Invalid request. Please select a plan, total amount, and payment method first.</p>";
}
?>
