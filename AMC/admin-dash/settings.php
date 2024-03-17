<!DOCTYPE html>
<html>
<head>
    <title>Account Settings</title>
    <style>
    .section {
        margin: 20px;
        padding: 20px;
        border: 1px solid #ccc;
        background-color: #f9f9f9;
    }

    h2 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    form {
        max-width: 400px;
        margin: 0 auto;
    }

    label {
        display: block;
        font-weight: bold;
        margin-top: 10px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    input[type="submit"] {
        background-color: #007BFF;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    .success-message {
        color: #2ecc71;
        font-weight: bold;
    }

    .error-message {
        color: #e74c3c;
        font-weight: bold;
    }
</style>

</head>
<body>
    <div class="section" id="settings">
        <h2>Account Settings</h2>
        <?php
        if (isset($_GET["success"])) {
            echo '<p class="success-message">Account updated successfully!</p>';
        } elseif (isset($_GET["error"])) {
            echo '<p class="error-message">Passwords do not match. Please try again.</p>';
        }
        ?>
        <form action="update_account.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <label for="password">New Password:</label>
            <input type="password" name="password" required>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" required>
            <input type="submit" value="Update Account">
        </form>
    </div>
</body>
</html>
