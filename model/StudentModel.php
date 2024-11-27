<?php
    namespace App\Models;
    use App\Middleware\AuthMiddleware;

    class studentModel{
        private $ticketCollection;
        private $credentialsCollection;
        public function __construct(){
            $client = require dirname(__DIR__) . '/config/database.php';

            $this->ticketCollection = $client->webapp->tickets;
            $this->credentialsCollection = $client->webapp->credentials;
        }

        public function validateStudent($studentNo, $email, $password) {
            try {
                   $student = $this->credentialsCollection->findOne([
                    'StudentID' => $studentNo,
                    'email' => $email
                ]);
        
              
                if ($student && password_verify($password, $student['password'])) {
                    return true;
                }
                
                return false;
            } catch (\Throwable $th) {
                echo $th;
                return false;
            }
        }
        
        public function insertTicket($email, $institute, $concern, $file = null)
        {
            try {
                $ticketData = [
                    'Email' => $email,
                    'institute' => $institute,
                    'concern' => $concern,
                    'file' => $file, 
                    'status' => 'Active', 
                ];
                $result = $this->ticketCollection->insertOne($ticketData);

                // Debugging line
                if ($result->getInsertedCount() > 0) {
                    return true;
                } else {
                    return false;
                }
                
                return $result->getInsertedCount() > 0;
            } catch (\Throwable $e) {
               
                echo 'Error inserting ticket: ' . $e->getMessage();
                return false;
            }
        }
        
        public function getTicketsByEmail($email)
        {
            try {
                $tickets = $this->ticketCollection->find(['Email' => $email])->toArray();
             
                return $tickets;
            } catch (\Throwable $e) {
                echo 'Error fetching tickets: ' . $e->getMessage();
                return [];
            }
        }
        
        public function insertTicketWithFile($email, $institute, $concern, $fileName, $fileType, $fileContent)
            {
                try {
                    $ticketId = uniqid(); // Generate a unique ID
                    $ticketData = [
                        'ticketId' => $ticketId, // Custom unique ID
                        'Email' => $email,
                        'institute' => $institute,
                        'concern' => $concern,
                        'fileName' => $fileName,
                        'fileType' => $fileType,
                        'fileContent' => $fileContent, // Store as base64 string
                        'status' => 'Active',
                    ];

                    $result = $this->ticketCollection->insertOne($ticketData);

                    return $result->getInsertedCount() > 0;
                } catch (\Throwable $e) {
                    echo 'Error inserting ticket: ' . $e->getMessage();
                    return false;
                }
            }


            
            public function deleteTicket($ticketId) {
                try {
                    $result = $this->ticketCollection->deleteOne(['_id' => $ticketId]);
                    return $result->getDeletedCount() > 0;
                } catch (\Throwable $e) {
                    echo 'Error deleting ticket: ' . $e->getMessage();
                    return false;
                }
            }
            

}
?>