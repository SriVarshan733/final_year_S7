<?php
$conn = new mysqli('localhost', 'root', '', 'bidding-test_db');

if ($conn->connect_error) {
    die("Could not connect to MySQL: " . $conn->connect_error);
}
?>
