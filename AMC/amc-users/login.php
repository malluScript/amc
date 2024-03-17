<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_company_id = $_POST["email_company_id"];
    $password = $_POST["password"];

    // Include your database connection file here
    include("conn.php");

    // Determine if it's an email or company ID
    $login_field = filter_var($email_company_id, FILTER_VALIDATE_EMAIL) ? "email" : "company_id";

    // Prepare a SQL statement with a placeholder for security
    $sql = "SELECT * FROM amc_users WHERE $login_field = ?";

    // Create a prepared statement
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        // Bind the parameters to the statement
        mysqli_stmt_bind_param($stmt, "s", $email_company_id);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            $row = mysqli_fetch_assoc($result);

            if ($row && password_verify($password, $row["password"])) {
                // Store the company_id in the session
                $_SESSION['company_id'] = $row["company_id"];

                // Redirect to the dashboard
                header("Location: dashboard.php?section=overview"); 
                exit;
            } else {
                $login_error = "Invalid email or password. Please try again.";
            }
        } else {
            $login_error = "Database query error.";
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } else {
        $login_error = "Failed to prepare the statement.";
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <form action="" method="post">
        <label for="email_company_id">Email or Company ID:</label>
        <input type="text" name="email_company_id" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Login">

        <a href="signup.html">signup</a>
    </form>

    <?php
    if (isset($login_error)) {
        echo "<p>$login_error</p>";
    }
    ?>
</body>
</html>
