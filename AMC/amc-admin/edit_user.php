<?php
// Include your database connection file
include("conn.php");

// Start the session
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php"); // Redirect to admin login page
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $companyID = $_POST["company_id"];
    $newName = $_POST["new_name"];
    $newEmail = $_POST["new_email"];
    
    // Update the user's information in the database
    $updateUserSQL = "UPDATE amc_users SET company_name = '$newName', email = '$newEmail' WHERE company_id = '$companyID'";
    
    if (mysqli_query($conn, $updateUserSQL)) {
        // Update successful
        header("Location: manage_users.php"); // Redirect back to manage users page
        exit;
    } else {
        echo "Error: " . $updateUserSQL . "<br>" . mysqli_error($conn);
    }
} else {
    // Fetch the user's existing information
    if (isset($_GET['company_id'])) {
        $companyID = $_GET['company_id'];
        
        // Query the database to retrieve user information
        $userQuery = "SELECT company_id, company_name, email FROM amc_users WHERE company_id = '$companyID'";
        $userResult = mysqli_query($conn, $userQuery);
        
        if ($userResult && mysqli_num_rows($userResult) > 0) {
            $row = mysqli_fetch_assoc($userResult);
            $companyID = $row['company_id'];
            $companyName = $row['company_name'];
            $email = $row['email'];
        } else {
            // User not found
            echo "User not found.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - AMC Admin Dashboard</title>
    <link rel="stylesheet" href="../amc-users/styles.css"> <!-- Adjust the path as needed -->
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <!-- Sidebar content -->
        </div>
        <div class="content">
            <h2>Edit User</h2>
            <form action="" method="post">
                <input type="hidden" name="company_id" value="<?php echo $companyID; ?>">
                <label for="new_name">Company Name:</label>
                <input type="text" name="new_name" value="<?php echo $companyName; ?>"><br><br>
                <label for="new_email">Email:</label>
                <input type="email" name="new_email" value="<?php echo $email; ?>"><br><br>
                <input type="submit" value="Update User">
            </form>
        </div>
    </div>
</body>
</html>
