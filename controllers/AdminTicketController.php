<?php
namespace App\Controllers;

use App\Models\AdminModel;

require '../model/AdminModel.php';

class AdminTicketController {
    private $adminModel;

    public function __construct() {
        $this->adminModel = new AdminModel();
    }

    public function handleRequest() {
        session_start();
    
        // Check if admin is logged in
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            echo "<script>alert('You are not logged in as an admin.'); window.location.href = '/login.php';</script>";
            return;
        }
    
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->updateTicketStatus();
        }
    
        // Fetch all tickets for the admin dashboard
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
}

$controller = new AdminTicketController();
$controller->handleRequest();

