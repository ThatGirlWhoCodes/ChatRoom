<?php
    $url = 'localhost';
    $username = 'root';
    $password = '12345';
    $server= 'chatroom';

    if (isset($_POST["send-message"])) {
        //instantiate connection
        $conn = new mysqli($url, $username, $password, $server);

        if ($conn->connect_error) {
            die('Database Connection Failed: '.$conn->connect_error);
        }
        echo'Connected Successfully!';

        //$query = "SELECT name, message, date_epoch FROM messages ORDER BY date_epoch DESC";
        $query = "INSERT INTO messages (name, message, date_epoch) VALUES ('{$_POST ['name']}', '{$_POST ['message']}', UNIX_TIMESTAMP());";
        $result = mysqli_query($conn, $query);
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

        h1 {
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
        <?php 
        
            $conn = new mysqli($url, $username, $password, $server);
            $query = "SELECT name, message, date_epoch FROM messages ORDER BY date_epoch DESC";
            $result = mysqli_query($conn, $query);
                
            while ($row = mysqli_fetch_array($result)) {
                $_name = $row['name'];
                $_message = $row['message'];
                $_date = $row['date_epoch'];

                //make look prettier
                echo"<h1>$_name</h1>";
                echo"<h4>$_message</h4>";
                echo"<h6>$_date</h6>";
                echo "<br>";
            }
            
            $conn-> close();
        ?>
    </div>
    <form method="POST" action="index.php">

        <label for="name">Name:</label>
        <input type="text" name="name" class="form-control" id="source-edit" placeholder="Enter your name" required>

        <label for="message">Name:</label>
        <input type="text" name="message" placeholder="Type your message..." required>
        <button type="submit" name="send-message" value="true">Submit</button>
    </form>
</body>

</html>
 