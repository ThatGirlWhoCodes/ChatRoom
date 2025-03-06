<!-- MySQL connection -->
<?php
// Database connection parameters
$server = 'localhost';
$username = 'root';
$password = 'g!g0rigin@1s!';
$dbname = 'chatroom';

// Instantiate connection
$conn = new mysqli($server, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die('Database Connection Failed: '.$conn->connect_error);
}

// Fetch messages from database
$query = "SELECT * FROM messages ORDER BY date_epoch DESC";
$result = $conn->query($query);

// Handle form submission
if (isset($_POST["send_message"])) {
    $name = $conn->real_escape_string($_POST["name"]);
    $message = $conn->real_escape_string($_POST["message"]);
    $date_epoch = time(); // Use current timestamp

    $insert_query = "INSERT INTO messages (name, message, date_epoch) VALUES ('$name', '$message', '$date_epoch')";
    
    if (!$conn->query($insert_query)) {
        die("Error inserting message: " . $conn->error);
    }

    // Reload page to show new message
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Box</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: black;
        }
        h1 {
            text-align: center;
            color: red;
        }
        .chat-box {
            width: 90%;
            height: 300px;
            overflow-y: auto;
            border: 3px solid whitesmoke;
            padding: 10px;
            margin-bottom: 10px;
            align-items: center;
        }
        .chat-message {
            margin-bottom: 10px;
            padding: 5px;
            border-bottom: 1px solid whitesmoke;
        }
        .chat-message strong, .chat-message small {
            color: whitesmoke;
        }
    </style>
</head>
<body>
    <h1>Chat</h1>
    <div class="chat-box">
        <!-- Display messages from the database -->
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="chat-message">
                <strong><?php echo htmlspecialchars($row['name']); ?>:</strong>
                <p><?php echo nl2br(htmlspecialchars($row['message'])); ?></p>
                <small><?php echo date("Y-m-d H:i:s", $row['date_epoch']); ?></small>
            </div>
        <?php endwhile; ?>
    </div>    

    <!-- Message form -->
    <form method="POST" action="index.php"> 
        <label for="name">Name:</label>
        <input type="text" name="name" class="form-control" placeholder="Enter your name" required>

        <label for="message">Message:</label>
        <input type="text" name="message" placeholder="Type your message..." required>

        <button type="submit" name="send_message">Submit</button>
    </form>
</body>
</html>
