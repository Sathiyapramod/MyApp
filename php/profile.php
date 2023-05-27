<?php
ini_set('session.save_handler', 'redis');
ini_set('session.save_path', 'tcp://127.0.0.1:6379');

session_start();


require_once __DIR__ . '/../vendor/autoload.php';
Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../')->load();
echo $_ENV['MONGO_URL'];

//storing the data into the local mongodb database 



$username = $_POST['username'];
$dateOfBirth = $_POST['dateOfBirth'];
$contactNumber = $_POST['contactNumber'];
$age = $_POST['age'];
$address = $_POST['address'];

// Connect to MongoDB
$mongoClient = new MongoDB\Client('mongodb://localhost:27017');

// Select database and collection
$database = $mongoClient->selectDatabase('profile_users'); //database considered storing locally
$collection = $database->selectCollection('profile_users'); //collection considered storing locally


// Create a new document
$document = [
    'username' => $username,
    'dateOfBirth' => $dateOfBirth,
    'contactNumber' => $contactNumber,
    'age' => $age,
    'address' => $address
];

// Insert the document into the collection
$result = $collection->insertOne($document);

if ($result->getInsertedCount() > 0) {
    echo 'Data stored successfully!';
} else {
    echo 'Failed to store data.';
}


session_destroy(); 


?>