<?php
require_once 'conn.php';

// Load and display messages
$userId = $_SESSION["user_id"];
$sql = "SELECT * FROM messages WHERE sender_id = $userId OR receiver_id = $userId ORDER BY timestamp DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p>{$row['timestamp']} - {$row['message']}</p>";
    }
} else {
    echo "No messages yet.";
}

$conn->close();
?>
