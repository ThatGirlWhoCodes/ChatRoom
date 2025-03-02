<?php
require 'config.php';

$conn = new mysqli("127.0.0.1", "root", "g!g0rigin@1s!", "chatroom");

// Check connection
if ($conn->connect_error) {
    die("❌ Database Connection Failed: " . $conn->connect_error);
} else {
    echo "✅ Database Connected Successfully!";
}
?>



<?php
require 'config.php';

$conn = new mysqli("127.0.0.1", "root", "g!g0rigin@1s!", "chatroom");

// Check connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>
