<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and validate form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $newPassword = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];

    if ($newPassword === $confirmPassword) {
        // Passwords match, proceed with the update
        // Implement code to update the user's account details in your database

        // Database connection details
        $servername = "localhost";
        $db_username = "root";
        $db_password = "";
        $dbname = "amc";

        // Create a new connection to the database
        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Hash the new password (for security)
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // SQL query to update the user's information in the 'signup' table
        $updateQuery = "UPDATE signup SET email = '$email', password = '$hashedPassword' WHERE username = '$username'";

        if ($conn->query($updateQuery) === TRUE) {
            // User's account details updated successfully
            header("Location: settings.php?success=1");
        } else {
            // Handle the case where the update fails
            header("Location: settings.php?error=2");
        }

        // Close the database connection
        $conn->close();
    } else {
        // Passwords do not match, display an error message
        header("Location: settings.php?error=1");
    }
}
?>
