<?php
$host = "localhost";
$user = "root";
$pass = "passowrd";
$db = "orizon_travel";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>