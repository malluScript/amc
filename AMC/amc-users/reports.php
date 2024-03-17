<?php
// Check if a session is not already active
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['message'])) {
    $message = $_GET['message'];
    $class = "success-message";

    // Check if the message is an error message (ID already exists)
    if (strpos($message, "already exists") !== false) {
        $class = "error-message";
    }

    echo "<p class='$class'>$message</p>";
}

// Include your database connection file here
include("conn.php");

// Check if the user is logged in
if (isset($_SESSION['company_id'])) {
    $company_id = $_SESSION['company_id'];

    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        $report_type = $_POST['report_type'];
        $report_description = $_POST['report_description'];

        // You can add more detailed fields for different report types
        // For now, we'll keep it simple.

        // Insert the report into the database
        $insertReportSQL = "INSERT INTO reports (company_id, report_type, report_description, report_timestamp) VALUES ('$company_id', '$report_type', '$report_description', NOW())";

        if (mysqli_query($conn, $insertReportSQL)) {
            $message = "Complaint registered successfully!";
            header("Location: dashboard.php?section=reports&message=" . urlencode($message));
        } else {
            echo "Error: " . $insertReportSQL . "<br>" . mysqli_error($conn);
        }
        
    }

    // Display the reporting form
    ?>
   <div class="content">
        <h2>Submit a Report</h2>
        <form method="post" action="reports.php">
            <label for="report_type">Report Type:</label>
            <select name="report_type">
                <option value="General Feedback">General Feedback</option>
                <option value="Bug Report">Bug Report</option>
                <!-- Add more report types as needed -->
            </select><br><br>

            <label for="report_description">Report Description:</label><br>
            <textarea name="report_description" rows="4" required></textarea><br><br>

            <input type="submit" name="submit" value="Submit Report">

            <!-- Add a link to check the report status -->
            <a href="view_reports.php">Check Report Status</a>
        </form>
</div>
    <?php
} else {
    // Redirect the user to the login page if they are not authenticated
    header("Location: login.php");
    exit;
}
?>
