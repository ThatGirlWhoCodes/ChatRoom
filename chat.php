<?php
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sender = isset($_POST['sender']) ? trim($_POST['sender']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    if (!empty($sender) && !empty($message)) {
        $stmt = $conn->prepare("INSERT INTO messages (sender, message) VALUES (?, ?)");
        $stmt->bind_param("ss", $sender, $message);
        $stmt->execute();
        $stmt->close();

        echo json_encode(["success" => true]);
        exit;
    } else {
        echo json_encode(["success" => false, "error" => "Invalid input"]);
        exit;
    }
}

// Fetch messages
$result = $conn->query("SELECT sender, message, timestamp FROM messages ORDER BY timestamp DESC LIMIT 20");

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

echo json_encode($messages);
?>
