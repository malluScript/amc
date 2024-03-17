<?php
session_start();
include("conn.php");

$username = $_POST["user"];
$password = $_POST["pass"];

$sql = "SELECT * FROM signup WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];

        header("Location: ../admin-dash/dashboard.php");
        exit;
    } else {
        echo "Invalid username or password";
    }
} else {
    echo "Query error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
