<!-- MySQL connection -->
<?php
if (isset($_REQUEST["send message"])) {
    $url = 'localhost';
$user = 'root';
$pass = 'g!g0rigin@1s!';
$dbname = 'Chatroom';
$server = '455-application-design';

//create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Database Connection Failed: '.$conn->connect_error);
}
echo'Connected Successfully!';

// Do below query to load
 $query= 'SELECT name, message, date_epoch FROM messages ORDER BY date_epoch DESC';
$result = mysqli_query($conn,$query);

while ($row = mysqli_fetch_array($result)) {
    $_name = $row['name'];
    $_message = $row['message'];
    $_date = $row['date_epoch'];

    //make look prettier
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
    <link rel="stylesheet" href="style.css">
</head>

<body>

</body> 

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

    <form method="POST" action="#"> </form>
    <input type="text" class="form-control" id="source-edit" placeholder="Enter Source" required >
    <input type="text" name="message" placeholder="Type your message..." required>
    <button type="button">
        Type message here
    </button>
</body>

</html> 