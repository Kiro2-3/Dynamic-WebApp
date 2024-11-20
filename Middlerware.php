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
}
