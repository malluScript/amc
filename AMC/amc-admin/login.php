<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_company_id = $_POST["email_company_id"];
    $password = $_POST["password"];

    // Fixed admin username and password
    $admin_username = "milan";
    $admin_password = "000";

    if ($email_company_id === $admin_username && $password === $admin_password) {
        // If the entered username and password match the admin's, redirect to the admin dashboard
        $_SESSION['admin_logged_in'] = true;
        header("Location: dashboard.php"); // Change this to the admin dashboard page
        exit;
    } else {
        $login_error = "Invalid username or password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    
</head>
<body>
    <h2>Admin Login</h2>

    <form action="" method="post">
        <label for="email_company_id">Username:</label>
        <input type="text" name="email_company_id" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Login">

        
    </form>

    <?php
    if (isset($login_error)) {
        echo "<p>$login_error</p>";
    }
    ?>
</body>
</html>
