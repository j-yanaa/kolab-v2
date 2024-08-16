<?php
require("config.php");
// Create connection
$conn = new mysqli($database_host, $database_user, $database_pass, $database_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>