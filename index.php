<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'db.php'; // Connect to the database
?>

<?php
require 'db.php';

// Handle new message submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['message']) && !empty($_POST['sender'])) {
    $sender = $conn->real_escape_string($_POST['sender']);
    $message = $conn->real_escape_string($_POST['message']);
    
    $conn->query(query: "INSERT INTO messages (sender, message) VALUES ('$sender', '$message')");
    
    header("Location: index.php"); // Refresh page to show new message
    exit();
}

// Retrieve all messages (sorted)
$result = $conn->query("SELECT * FROM messages ORDER BY timestamp DESC");

if ($result->num_rows == 0) {
    echo "<p> No messages found in database.</p>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Chatroom</title>
    <link rel="stylesheet" href="chat.css">
</head>
<body>
    <div class="chat-container">
        <h2>💬 Simple Chatroom</h2>
        
        <!-- Chat Log -->
        <div class="chat-box">
            <?php while ($row = $result->fetch_assoc()): ?>
                <p><strong><?= htmlspecialchars($row['sender']) ?>:</strong> <?= htmlspecialchars($row['message']) ?> <small>(<?= $row['timestamp'] ?>)</small></p>
            <?php endwhile; ?>
        </div>

        <!-- Message Form -->
        <form action="index.php" method="post">
            <input type="text" name="sender" placeholder="Enter your name" required>
            <input type="text" name="message" placeholder="Type a message..." required>
            <button type="submit">Send</button>
        </form>
    </div>
</body>
</html>