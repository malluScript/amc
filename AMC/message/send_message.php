<?php
session_start();
require_once 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST["message"];
    $senderId = $_SESSION["user_id"];
    $receiverId = 2; // Set receiver's ID for the example (replace with actual logic)

    // Validate and save the message to the database
    if (!empty($message)) {
        $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $senderId, $receiverId, $message);
        $stmt->execute();
        $stmt->close();

        // Redirect back to messages page
        header("Location: messages.php");
        exit;
    }
}
?>
