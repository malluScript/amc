<?php
// Include your database connection file
include("conn.php");

// Check if the user's company ID is set
if (isset($_GET['company_id'])) {
    $companyID = $_GET['company_id'];

    // Delete the user from the database
    $deleteUserSQL = "DELETE FROM amc_users WHERE company_id = '$companyID'";
    if (mysqli_query($conn, $deleteUserSQL)) {
        // Deletion successful

        // Redirect back to the manage users page
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Error: " . $deleteUserSQL . "<br>" . mysqli_error($conn);
    }
}
?>
