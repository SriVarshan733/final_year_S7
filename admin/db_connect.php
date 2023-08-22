<?php
$conn = new mysqli('database-1.cwa1v3hdvy5b.us-east-1.rds.amazonaws.com', 'admin', 'admin123', 'bidding');

if ($conn->connect_error) {
    die("Could not connect to MySQL: " . $conn->connect_error);
}
?>
