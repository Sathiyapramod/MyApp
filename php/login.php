<?php

ini_set('session.save_handler', 'redis');
ini_set('session.save_path', 'tcp://127.0.0.1:6379');
ini_set('session.gc_maxlifetime', 3600);

ini_set('session.cookie_secure', 1); 
ini_set('session.cookie_httponly', 1); 

session_start();

$host = 'localhost';
$username = 'root'; // Default username for XAMPP
$password = ''; // Default password for XAMPP
$database = 'users'; // Replace with your database name

// Create a new MySQLi connection
$mysqli = new mysqli($host, $username, $password, $database);


// Check the connection
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

// Retrieve the username and password from the POST data
$username = $_POST['username'];
$password = $_POST['password'];


// Prepare the SQL statement to retrieve the hashed password based on the provided username
$query = "SELECT password FROM users WHERE username = ?";

// Create a prepared statement
$stmt = $mysqli->prepare($query);

// Bind the parameter to the statement
$stmt->bind_param("s", $username);

// Execute the statement
$stmt->execute();

// Bind the result to a variable
$stmt->bind_result($hashedPassword);

// Fetch the result
$stmt->fetch();

// Verify the password
if (password_verify($password, $hashedPassword)) {
    $response = "Login successful!";
    echo $response;
} else {
    $response = "Login failed: Invalid username or password";
    echo $response;
}

// Close the prepared statement
$stmt->close();

// Close the database connection
$mysqli->close();


session_destroy();

?>
