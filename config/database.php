<?php
require '../vendor/autoload.php';

$dbUri = 'mongodb+srv://<db_username>:<db_password>@webapp-cluster.jytyq.mongodb.net/?retryWrites=true&w=majority&appName=webapp-cluster';
$db_name = 'webapp';
try {
  
    $client = new MongoDB\Client($dbUri);
    $database = $client->webapp;

    echo 'Youve successfully connected to the database!' .$db_name;
} catch (Exception $e) {
    echo 'Connection error: ' . $e->getMessage();
}

?>