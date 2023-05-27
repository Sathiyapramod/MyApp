<?php

// $redis = new Redis();
// $redis->connect('127.0.0.1', 6379); 

ini_set('session.save_handler', 'redis');
ini_set('session.save_path', 'tcp://127.0.0.1:6379');

session_start();


$host = 'localhost';
$username = 'root';
$password = '';
$database = 'users';

// Create a new MySQLi connection
$mysqli = new mysqli($host, $username, $password, $database);

// Check the connection
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];


// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);


// Prepare the SQL statement with placeholders
$query = "INSERT INTO users (username, password) VALUES (?, ?)";

// Create a prepared statement
$stmt = $mysqli->prepare($query);


// Bind the parameters to the statement
$stmt->bind_param("ss", $username, $hashedPassword);


// Execute the statement
if ($stmt->execute()) {
    $response = "Registration successful!";
    echo $response;
} else {
    $response = "Registration failed: " . $stmt->error;
    echo $response;
}

// Close the prepared statement
$stmt->close();

// Close the database connection
$mysqli->close();
  
session_destroy();

?>