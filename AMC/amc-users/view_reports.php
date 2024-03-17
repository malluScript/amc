<?php
// Include your database connection file here
include("conn.php");

// Start the session (if not already started)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (isset($_SESSION['company_id'])) {
    $company_id = $_SESSION['company_id'];

    // Fetch report history for the user
    $fetchReportsSQL = "SELECT * FROM reports WHERE company_id = '$company_id'";
    $result = mysqli_query($conn, $fetchReportsSQL);

    if ($result) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Report History</title>
        </head>
        <body>
            <h2>Report History</h2>
            <table>
                <tr>
                    <th>Report ID</th>
                    <th>Report Type</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Timestamp</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['report_id'] . "</td>";
                    echo "<td>" . $row['report_type'] . "</td>";
                    echo "<td>" . $row['report_description'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "<td>" . $row['report_timestamp'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </body>
        </html>
        <?php
    } else {
        echo "Error: " . $fetchReportsSQL . "<br>" . mysqli_error($conn);
    }
} else {
    // Redirect the user to the login page if they are not authenticated
    header("Location: login.php");
    exit;
}
?>
