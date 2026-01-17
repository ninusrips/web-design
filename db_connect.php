<?php
$host = 'localhost';
$db_name = 'web_app_db';
$username = 'root'; // Change this if you have a different database username
$password = '';     // Change this if you have a different database password

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully"; 
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>
