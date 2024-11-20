<?php
namespace App\Models;
use App\Middleware\AuthMiddleware;



class AdminModel {
    private $adminCollection;
    private $credentialsCollection;

    public function __construct() {
        $client = require '../config/database.php';

       
        $this->adminCollection = $client->webapp->admin;
        $this->credentialsCollection = $client->webapp->credentials;
    }

    public function createAdmin($email, $password) {
        AuthMiddleware::checkAuthenticated();

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $result = $this->adminCollection->insertOne(['email' => $email, 'password' => $hashedPassword]);
        return $result->getInsertedId();
    }

    public function validateAdminLogin($email, $password) {
        $admin = $this->adminCollection->findOne(['email' => $email]);

        if ($admin && password_verify($password, $admin['password'])) {
            session_start();
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_email'] = $email;
            return true;
        }

        return false; 
    }
    public function insertCredentials($students) {
        $insertedCount = 0;
    
        // Process each student and insert into MongoDB
        foreach ($students as $student) {
            if (isset($student['password'])) {
                // Hash password before saving
                $student['password'] = password_hash($student['password'], PASSWORD_DEFAULT);
            }
    
            // Check if the student already exists in the database by StudentID (or other unique field)
            $existingStudent = $this->credentialsCollection->findOne(['StudentID' => $student['StudentID']]);
    
            // If the student does not exist, insert into MongoDB
            if ($existingStudent === null) {
                try {
                    // Insert the student document
                    $result = $this->credentialsCollection->insertOne($student);
                    
                    // Check if insertion was successful
                    if ($result->getInsertedCount() === 1) {
                        $insertedCount++;
                    }
                } catch (\Throwable $e) {
                    // Log any errors during insertion
                    error_log('Insert failed: ' . $e->getMessage());
                }
            } else {
                // Debug: Log that this student already exists and was skipped
                error_log('Student with StudentID ' . $student['StudentID'] . ' already exists. Skipping.');
            }
        }
    
        return $insertedCount;
    }
    
    public function getCredentials() {
        try {
            // Fetch all students from the credentials collection
            return $this->credentialsCollection->find()->toArray(); // Returns an array of documents
        } catch (\Throwable $e) {
            // Log the error if the fetch fails
            error_log('Failed to fetch credentials: ' . $e->getMessage());
            return []; // Return an empty array if there's an error
        }
    }
    
    
}

