<!-- MySQL connection -->
<?php
if (isset($_REQUEST["send message"])) {
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

$query = 'SELECT name, message, date_epoch FROM messages ORDER BY date_epoch DESC';
//$result = mysqli_query($conn, $query);
$result = $conn->query("SELECT * FROM messages ORDER BY date_epoch DESC");

while ($row = mysqli_fetch_array($result)) {
    $_name = $row['name'];
    $_message = $row['message'];
    $_date = $row['date_epoch'];

    //make look prettier
    echo'Hello world';
    echo'<h1>$_name</h1>';
    echo'<h4>$_message</h4>';
    echo'<h6>$_date_epoch</h6>';
    echo '</br>';

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
            background-color: black;
        }
        h1{
            text-align: center;
            color: red;
        }
        .chat-box {
            width: 100%;
            height: 300px;
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }
        .chat-message {
            margin-bottom: 10px;
            padding: 5px;
            border-bottom: 1px solid whitesmoke;
        }
        .chat-message strong {
            color: whitesmoke;
        }
        .chat-message small {
            color: whitesmoke;
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
    <form method="_POST"> 
            <input type="text" name="name" class="form-control" id="source-edit" placeholder="Enter your name" required >
            <input type="text" name="message" placeholder="Type your message..." required>
            <button type="submit">Submit</button>
    </form>
</body>

</html> 