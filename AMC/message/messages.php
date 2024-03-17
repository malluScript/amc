<?php
session_start();
require_once 'db_connection.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST["message"];
    $receiver_id = $_POST["receiver_id"];

    $sql = "INSERT INTO messages (sender_id, receiver_id, message) VALUES ($user_id, $receiver_id, '$message')";
    if ($conn->query($sql) === TRUE) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM messages WHERE sender_id = $user_id OR receiver_id = $user_id ORDER BY timestamp DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Messages</h2>
        <form action="messages.php" method="post">
            <label for="receiver_id">Receiver ID:</label>
            <input type="number" name="receiver_id" required>

            <label for="message">Message:</label>
            <textarea name="message" required></textarea>

            <button type="submit">Send Message</button>
        </form>

        <h3>Message History:</h3>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <p><?= $row["message"] ?></p>
        <?php endwhile; ?>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>
