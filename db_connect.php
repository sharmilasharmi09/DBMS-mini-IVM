<?php
$servername = "localhost";
$username = "root";
$password = ""; // replace with your actual password
$dbname = "inventory_db";
$port = 4308;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
} else {
    echo "✅ Connected to MySQL successfully!";
}
?>
