<?php
$host = 'localhost';
$user = 'root';
$pass = ''; 
$db   = 'kazora';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Verbinding met database mislukt: " . $conn->connect_error);
}
?>
