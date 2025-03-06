<?php
if (isset($_POST["send-message"])) {
$url = 'localhost';
$username = 'root';
$password = 'g!g0rigin@1s!';
$dbname = 'chatroom';
$server= '455-application-design';

//instantiate connection
$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Database Connection Failed: '.$conn->connect_error);
}
echo'Connected Successfully!';

$query = "SELECT name, message, date_epoch FROM messages ORDER BY date_epoch DESC";
//$result = mysqli_query($conn, $query);
$result = $conn->query("SELECT * FROM messages ORDER BY date_epoch DESC");

while ($row = mysqli_fetch_array($result)) {
    $_name = $row['name'];
    $_message = $row['message'];
    $_date = $row['date_epoch'];

    //make look prettier
    echo"<h1>$_name</h1>";
    echo"<h4>$_message</h4>";
    echo"<h6>$_date_epoch</h6>";
    echo "<br>";
}

$conn-> close();
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
        }
        h1{
            text-align: center;
            color: blue;
        }
        .chat-box {
            width: 90%;
            height: 300px;
            overflow-y: auto;
            border: 3px solid blue;
            padding: 10px;
            margin-bottom: 10px;
            align-items: center;
        }
        .chat-message {
            margin-bottom: 10px;
            padding: 5px;
            border-bottom: 1px solid black;
        }
        .chat-message strong {
            color: black;
        }
        .chat-message small {
            color: black;
        }
    </style>
</head>

<body>
    <h1>Chat</h1>
    <div class="chat-box">
    <!-- display message user sent -->
    <?php while ($row = $result->fetch_assoc()): ?>
            <div class="chat-message">
                <strong><?php echo htmlspecialchars($row['name']); ?>:</strong>
                <p><?php echo nl2br(htmlspecialchars($row['message'])); ?></p>
                <small><?php echo date("Y-m-d H:i:s", strtotime($row['date_epoch'])); ?></small>
            </div>
            <!-- loop until no more messages -->
        <?php endwhile; ?>
    </div>  
    <form method="POST" action="index.php"> 

            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" id="source-edit" placeholder="Enter your name" required >

            <label for="message">Name:</label>
            <input type="text" name="message" placeholder="Type your message..." required>
            <button type="submit">Submit</button>
    </form>
</body>

</html> 