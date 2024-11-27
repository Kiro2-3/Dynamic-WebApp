<?php
require 'vendor/autoload.php'; // Include the MongoDB library

use MongoDB\Client;

class StudentModel {
    private $ticketCollection;

    public function __construct() {
        $mongoUri = 'mongodb+srv://ColegioDeMontalban_Chat-Support:ColegioDeMontalban_Chat-Support@webapp-cluster.jytyq.mongodb.net/?retryWrites=true&w=majority';
        $client = new Client($mongoUri);

        // Select the database and collection
        $this->ticketCollection = $client->webapp->tickets; // Replace 'webapp' with your actual database name
    }

    public function getTicketsByEmail($email) {
        try {
            // Fetch tickets by email
            return $this->ticketCollection->find(['Email' => $email])->toArray();
        } catch (\Throwable $e) {
            echo "Error fetching tickets: " . $e->getMessage();
            return [];
        }
    }
}

try {
    // Instantiate the model
    $studentModel = new StudentModel();

    // Test email
    $testEmail = "janedoe@example.com";

    // Fetch tickets for the given email
    $tickets = $studentModel->getTicketsByEmail($testEmail);

    // Output the tickets
    echo "<pre>";
    print_r($tickets);
    echo "</pre>";
} catch (\Throwable $e) {
    // Display error message if any
    echo "Error: " . $e->getMessage();
}
?>
