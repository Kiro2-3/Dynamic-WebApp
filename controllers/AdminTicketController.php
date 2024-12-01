<?php
namespace App\Controllers;

use App\Models\AdminModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../model/AdminModel.php';

class AdminTicketController {
    private $adminModel;

    public function __construct() {
        $this->adminModel = new AdminModel();
    }

    public function handleRequest() {
        session_start();

        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            echo "<script>alert('You are not logged in as an admin.'); window.location.href = '/login.php';</script>";
            return;
        }
        
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (isset($_POST['sendEmail'])) {
                $this->sendEmail();
            } elseif (isset($_POST['delete_ticket'])) {
                $this->deleteTicket();
            } elseif (isset($_POST['update_status'])) {
                $this->updateTicketStatus();
            }
        }

        $tickets = $this->adminModel->getAllTickets();
        require '../views/Admin/tickets.php';
    }

    private function updateTicketStatus() {
        $ticketId = $_POST['ticketId'] ?? '';
        $status = $_POST['status'] ?? '';

        if (empty($ticketId) || empty($status)) {
            echo "<script>alert('Invalid ticket data.');</script>";
            return;
        }

        $statusUpdated = $this->adminModel->updateTicketStatus($ticketId, $status);

        if ($statusUpdated) {
            echo "<script>alert('Ticket status updated successfully.'); window.location.href = window.location.pathname;</script>";
        } else {
            echo "<script>alert('Failed to update ticket status.');</script>";
        }
    }

    private function deleteTicket() {
        $ticketId = $_POST['ticketId'] ?? '';

        if (empty($ticketId)) {
            echo "<script>alert('Invalid ticket data.');</script>";
            return;
        }

        $ticketDeleted = $this->adminModel->deleteTicketById($ticketId);

        if ($ticketDeleted) {
            echo "<script>alert('Ticket deleted successfully.');</script>";
        } else {
            echo "<script>alert('Failed to delete ticket.');</script>";
        }
    }

    private function sendEmail() {
     
        $recipient = $_POST['emailRecipient']; 
        $subject = $_POST['emailSubject'];     
        $message = $_POST['emailMessage'];      

       
        if (!filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Invalid email address.'); </script>";
            exit;
        }

      
        $mail = new PHPMailer(true);

        try {
         
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  
            $mail->SMTPAuth = true;  
            $mail->Username = 'colegiodemontalban123@gmail.com';  
            $mail->Password = 'kxjn nkjv uolf pxfa';  
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
            $mail->Port = 587;  
           
            $mail->setFrom('colegiodemontalban123@gmail.com', 'CDMCSS');  
            $mail->addAddress($recipient);  
        
            $mail->isHTML(true);  
            $mail->Subject = $subject;  
            $mail->Body = nl2br($message);  
        

            if ($mail->send()) {
                echo "<script>alert('Email sent successfully!');</script>";
            } else {
                echo "<script>alert('Failed to send email.');</script>";
            }
        } catch (Exception $e) {
            echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
        }
    }
}

$controller = new AdminTicketController();
$controller->handleRequest();
