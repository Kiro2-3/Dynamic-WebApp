<?php
require '../vendor/autoload.php';

use MongoDB\Client;
use Dotenv\Dotenv;

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

try {
 
    $dbUri = getenv('DB_URI') ?: 'mongodb+srv://ColegioDeMontalban_Chat-Support:ColegioDeMontalban_Chat-Support@webapp-cluster.jytyq.mongodb.net/?retryWrites=true&w=majority';

    $client = new Client($dbUri);

   
    return $client;
} catch (Exception $e) {
   
    error_log('MongoDB connection error: ' . $e->getMessage());
    throw new Exception('Failed to connect to MongoDB. Check your configuration.');
}


