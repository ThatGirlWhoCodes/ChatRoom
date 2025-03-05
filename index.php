<!-- MySQL connection -->
<?php
if (isset($_REQUEST["send message"])) {
    $url = 'localhost';
$user = 'root';
$pass = 'g!g0rigin@1s!';
$dbname = 'Chatroom';
$server = 'app-design';

//create connection
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die('Database Connection Failed: '.$conn->connect_error);
}
echo'Connected Successfully!';

// Do below query to load
// $query= 'SELECT name, message, date_epoch FROM  message(name, message, date_epoch) values('$name', '$message', '$date-$date_epoch' );';
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


    <h1>hello test</h1>
    <!-- Inject PHP here -->
    
    
    <form action=" "> </form>
    <input type="text" class="form-control" id="source-edit" placeholder="Enter Source" required >
    <button type="button">
        Enter
    </button>
</body>

</html> 