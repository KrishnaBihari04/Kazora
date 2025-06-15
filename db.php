<?php
$host = "localhost";
$db = "kazora";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);

// Check verbinding
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}
?>
