<?php
namespace App\Models;
use App\Middleware\AuthMiddleware;
use MongoDB\BSON\ObjectId;
require ($_SERVER['DOCUMENT_ROOT']) . '/vendor/autoload.php';


class AdminModel {
    private $adminCollection;
    private $credentialsCollection;
    private $ticketsCollection;

    public function __construct() {
        $client = require ($_SERVER['DOCUMENT_ROOT']) . '/config/database.php';

        $this->ticketsCollection = $client->webapp->tickets;
        $this->adminCollection = $client->webapp->admin;
        $this->credentialsCollection = $client->webapp->credentials;
    }

    public function createAdmin($email, $password) {
     

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
       
        foreach ($students as $student) {
            if (isset($student['password'])) {

                $student['password'] = password_hash($student['password'], PASSWORD_DEFAULT);
            }
    
            $existingStudent = $this->credentialsCollection->findOne(['StudentID' => $student['StudentID']]);
    
            if ($existingStudent === null) {
                try {
                  
                    $result = $this->credentialsCollection->insertOne($student);
                    
                    if ($result->getInsertedCount() === 1) {
                        $insertedCount++;
                    }
                } catch (\Throwable $e) {
                    error_log('Insert failed: ' . $e->getMessage());
                }
            } else {
                error_log('Student with StudentID ' . $student['StudentID'] . ' already exists. Skipping.');
            }
        }
    
        return $insertedCount;
    }
    
    public function getCredentials() {
        try {
            return $this->credentialsCollection->find()->toArray(); 
        } catch (\Throwable $e) {
            error_log('Failed to fetch credentials: ' . $e->getMessage());
            return []; 
        }
    }
    
    public function deleteCredentialsById($studentId) {
        try {

            $result = $this->credentialsCollection->deleteOne(['StudentID' => $studentId]);
    
            if ($result->getDeletedCount() === 1) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $e) {
      
            error_log('Failed to delete credentials: ' . $e->getMessage());
            return false; 
        }
    }
    

    public function deleteAllCredentials() {
        try {
            $count = $this->credentialsCollection->countDocuments();  
            error_log('Count before deletion: ' . $count);
            
            $result = $this->credentialsCollection->deleteMany([]);
            error_log('Deleted count: ' . $result->getDeletedCount());  
             
            if ($result->getDeletedCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $e) {
            error_log('Failed to delete all credentials: ' . $e->getMessage());
            return false; 
        }
    }

    public function getAllTickets() {
    try {
        $tickets = $this->ticketsCollection->find()->toArray();

        foreach ($tickets as &$ticket) {

            if (isset($ticket['fileContent']) && !empty($ticket['fileContent'])) {
                $fileContent = base64_decode($ticket['fileContent']);
                
                $filePath = '\Users\visay\OneDrive\Pictures\Camera Roll/' . $ticket['fileName'];
                
                file_put_contents($filePath, $fileContent);

                $ticket['filePath'] = $filePath;
            }
        }

        return $tickets;
    } catch (\Throwable $e) {
        error_log('Failed to fetch tickets: ' . $e->getMessage());
        return [];
    }
}

    public function updateTicketStatus($ticketId, $status) {
        try {
            $objectId = new ObjectId($ticketId);
            $result = $this->ticketsCollection->updateOne(
                ['_id' => $objectId],
                ['$set' => ['status' => $status]]
            );
    
            return $result->getModifiedCount() > 0;
        } catch (\Throwable $e) {
            error_log("Failed to update ticket status: " . $e->getMessage());
            return false;
        }
    }
    
    
    
    public function deleteTicketById($ticketId) {
        try {
             $objectId = new ObjectId($ticketId);
             $result = $this->ticketsCollection->deleteOne(['_id' => $objectId]);
    
            if ($result->getDeletedCount() > 0) {
                return true; 
            } else {
                error_log("No ticket found with ID: " . $ticketId);
                return false; 
            }
        } catch (\Throwable $e) {
            error_log("Failed to delete ticket: " . $e->getMessage());
            return false;
        }
    }
    public function getTicketCounts() {
        try {
            // Total Tickets
            $totalTickets = $this->ticketsCollection->countDocuments();
    
            // Active Tickets
            $activeTickets = $this->ticketsCollection->countDocuments(['status' => 'Active']);
    
            // Done Tickets
            $doneTickets = $this->ticketsCollection->countDocuments(['status' => 'Done']);
    
            return [
                'total' => $totalTickets,
                'active' => $activeTickets,
                'done' => $doneTickets
            ];
        } catch (\Throwable $e) {
            error_log("Failed to fetch ticket counts: " . $e->getMessage());
            return [
                'total' => 0,
                'active' => 0,
                'done' => 0
            ];
        }
    }
    public function getMonthlyTicketCounts() {
        try {
            $pipeline = [
                [
                    '$group' => [
                        '_id' => ['$month' => '$createdAt'], 
                        'count' => ['$sum' => 1]          
                    ]
                ],
                ['$sort' => ['_id' => 1]]             
            ];
    
            $result = $this->ticketsCollection->aggregate($pipeline);
            $monthlyCounts = [];
    
            foreach ($result as $entry) {
                $monthlyCounts[$entry['_id']] = $entry['count'];
            }
    
     
            for ($i = 1; $i <= 12; $i++) {
                if (!isset($monthlyCounts[$i])) {
                    $monthlyCounts[$i] = 0;
                }
            }
    
            ksort($monthlyCounts); 
            return $monthlyCounts;
        } catch (\Throwable $e) {
            error_log("Failed to fetch monthly ticket counts: " . $e->getMessage());
            return array_fill(1, 12, 0); 
        }
    }
    
    
  
}

