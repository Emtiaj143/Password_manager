<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection file
require_once __DIR__ . '/DB/database.php';

// Create a new database connection
$db = new Database();
$conn = $db->getConnection();

// Check if the connection is successful
if ($conn) {
    echo "Database connection successful!";
} else {
    echo "Database connection failed.";
}
?>
