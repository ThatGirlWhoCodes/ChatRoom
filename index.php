<!-- MySQL connection -->
<?php
$host = 'localhost';
$user = 'root';
$pass = 'g!g0rigin@1s!';
$dbname = 'chatroom';

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die('Database Connection Failed: '.$conn->connect_error);
}
echo'Connected Successfully!';
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
    
    

    <input type="text" class="form-control" id="source-edit" placeholder="Enter Source" required >
    <button type="button">
        Enter
    </button>
</body>

</html> 