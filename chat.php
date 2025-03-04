<?php
header("Content-Type: application/json");
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       // Decode JSON input (if using JSON)
       $data = json_decode(file_get_contents("php://input"), true);

       // Debugging: Log received data
       error_log("Received: " . print_r($data, true));  // Use $data instead of $_POST
   
       $sender = $data['sender'] ?? null;
       $message = $data['message'] ?? null;
   
       if ($sender && $message) {
           $stmt = $conn->prepare("INSERT INTO messages (sender, message) VALUES (?, ?)");
           $stmt->bind_param("ss", $sender, $message);
           if ($stmt->execute()) {
               echo json_encode(["status" => "success"]);
           } else {
               echo json_encode(["status" => "error", "message" => $conn->error]);
           }
           $stmt->close();
       } else {
           echo json_encode(["status" => "error", "message" => "Missing sender or message"]);
       }
       exit;
   }

// Fetch messages
$result = $conn->query("SELECT sender, message  FROM messages ORDER BY is DESC");

$result = $conn->query("SELECT sender, message FROM messages ORDER BY id DESC");
$messages = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($messages);
?>
