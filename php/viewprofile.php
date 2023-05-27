<?php
ini_set('session.save_handler', 'redis');
ini_set('session.save_path', 'tcp://127.0.0.1:6379');

session_start();


require_once __DIR__ . '/../vendor/autoload.php';
Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../')->load();
echo $_ENV['MONGO_URL'];

$username = $_GET['username'];

// Connect to MongoDB
$mongoClient = new MongoDB\Client('mongodb://localhost:27017');

// Select database and collection
$database = $mongoClient->selectDatabase('profile_users'); //database considered storing locally
$collection = $database->selectCollection('profile_users'); //collection considered storing locally


// Find the document matching the username
$document = $collection->findOne(['username' => $username]);

// Check if the document exists
if ($document) {
    // Convert the document to JSON and send the response
    echo json_encode($document);
} else {
    echo 'No data found for the provided username.';
}


session_destroy(); 


?>