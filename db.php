<?php
$host = '127.0.0.1';
$user = 'root';
$pass = 'g!g0rigin@1s!';
$dbname = 'chatroom';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die('Database Connection Failed: '.$conn->connect_error);
}
