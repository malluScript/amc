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

    // Check if the form is submitted to update user information
    if (isset($_POST['update'])) {
        $newName = $_POST['new_name'];
        $newEmail = $_POST['new_email'];
        $newAddress = $_POST['new_address'];
        $newPassword = password_hash($_POST['new_pass'], PASSWORD_DEFAULT); // Hash the password

        // Update the user's information in the database
        $updateUserSQL = "UPDATE amc_users SET company_name = '$newName', email = '$newEmail', company_address = '$newAddress', password = '$newPassword' WHERE company_id = '$company_id'";

        if (mysqli_query($conn, $updateUserSQL)) {
            echo "User information updated successfully!";
        } else {
            echo "Error: " . $updateUserSQL . "<br>" . mysqli_error($conn);
        }
    }

    // Check if the form is submitted to delete the user account
    if (isset($_POST['delete'])) {
        // You may want to prompt the user for confirmation before deleting their account
        $deleteUserSQL = "DELETE FROM amc_users WHERE company_id = '$company_id'";
        if (mysqli_query($conn, $deleteUserSQL)) {
            // User account deleted, you can also add a confirmation message
            header("Location: logout.php"); // Redirect to logout
            exit;
        } else {
            echo "Error: " . $deleteUserSQL . "<br>" . mysqli_error($conn);
        }
    }

    // Rest of your code...
   
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Settings</title>

        <script>
            function deleteBtn()
            {
                const dltBtn = document.getElementById("dlt");
                alert("when delete all data should be removed from our server ")

            }
            </script>
    </head>
    <body>
        <h2>Settings</h2>
        <form method="post" action="settings.php">
            <h3>Update User Information</h3>
            <label for="new_name">Company Name:</label>
            <input type="text" name="new_name" ><br><br>

            <label for="new_email">Email:</label>
            <input type="email" name="new_email" ><br><br>

            <label for="new_address">Address:</label>
            <textarea name="new_address" rows="4"></textarea><br><br>
            <label for="new_password">Password:</label>
            <input type="password" name="new_pass" ><br><br>

            <input type="submit" name="update" value="Update Information">
            <input type="reset" name="reset" >
        </form>

        <form method="post" action="settings.php">
            <h3>Delete Your Account</h3>
            <label for="delete_confirmation">To delete your account, please type 'DELETE':</label>
            <input type="text" name="delete_confirmation" required><br><br>

            <input type="submit" name="delete" id="dlt" value="Delete Your Account" onclick="deleteBtn()">
        </form>

        <br>

        <!-- Logout Button -->
        <form method="post" action="logout.php">
            <input type="submit" name="logout" value="Logout">
        </form>
    </body>
    </html>
    <?php
} else {
    // Redirect the user to the login page if they are not authenticated
    header("Location: login.php");
    exit;
}
?>
