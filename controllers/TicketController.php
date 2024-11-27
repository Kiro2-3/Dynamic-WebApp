<?php
namespace App\Controllers;

use App\Models\StudentModel;


require '../model/StudentModel.php';


class TicketController {
    private $studentModel;


    public function __construct() {
        $this->studentModel = new StudentModel();
  
    }

    public function handleRequest() {
        session_start();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->processTicketSubmission();
        }

        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];
            $tickets = $this->studentModel->getTicketsByEmail($email);
        } else {
            $tickets = [];
            echo "<script>alert('You are not logged in. Please log in to view tickets.');</script>";
        }

        require '../views/Ticket.php';
    }

    private function processTicketSubmission() {
        $email = $_POST['Email'] ?? '';
        $institute = $_POST['institute'] ?? '';
        $concern = $_POST['concern'] ?? '';
        $fileName = $_FILES['attachment']['name'] ?? null;

        if (empty($email) || empty($institute) || empty($concern)) {
            echo "<script>alert('Please fill out all required fields.');</script>";
            return;
        }

        $fileData = null;
        $fileType = null;

        if (!empty($fileName)) {
            $fileTmpPath = $_FILES['attachment']['tmp_name'];
            $fileType = $_FILES['attachment']['type'];

            if (is_uploaded_file($fileTmpPath)) {
                $fileData = base64_encode(file_get_contents($fileTmpPath)); // Convert to base64
            } else {
                echo "<script>alert('Failed to upload the file.');</script>";
                return;
            }
        }

        $ticketInserted = $this->studentModel->insertTicketWithFile(
            $email,
            $institute,
            $concern,
            $fileName,
            $fileType,
            $fileData
        );

        if ($ticketInserted) {
            echo "<script>alert('Ticket successfully submitted.'); window.location.href = window.location.pathname;</script>";
        } else {
            echo "<script>alert('Error submitting ticket. Please try again.');</script>";
        }
    }


}


$controller = new TicketController();
$controller->handleRequest();
