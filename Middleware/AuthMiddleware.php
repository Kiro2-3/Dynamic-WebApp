<?php
namespace App\Middleware;

class AuthMiddleware {
    public static function checkAuthenticated() {
        session_start();

        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header('Location: /AdminController.php');
            exit;
        }
    }
    public static function checkStudentLoggedIn() {
        session_start();
        
        // If the student is already logged in, redirect to homepage
        if (isset($_SESSION['studentNo']) && isset($_SESSION['email'])) {
            header('Location: /views/home.php');  // Redirect to homepage if already logged in
            exit();
        }
    }

    public static function checkStudentNotLoggedIn() {
        session_start();
        
        // If the student is not logged in, redirect to login page
        if (!isset($_SESSION['studentNo']) || !isset($_SESSION['email'])) {
            header('Location: /controllers/studentLogin.php');
            exit();
        }
    }
   
}
