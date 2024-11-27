<?php
use App\Models\StudentModel;
use App\Middleware\AuthMiddleware;

require_once dirname(__DIR__) . '/Middleware/AuthMiddleware.php';
require dirname(__DIR__) . '/model/StudentModel.php';

// Check if the student is already logged in
AuthMiddleware::checkStudentLoggedIn();

$studentModel = new StudentModel();

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $studentNo = $_POST['studentNo'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    try {
        if ($studentModel->validateStudent($studentNo, $email, $pass)) {
            session_start();
            // Store student ID and email in the session
            $_SESSION['studentNo'] = $studentNo;
            $_SESSION['email'] = $email;
            header('Location: /views/home.php');
            exit();
        } else {
            echo '<script>alert("Invalid Data")</script>';
        }
    } catch (\Throwable $th) {
        throw $th;
    }
}

require dirname(__DIR__) . '/views/login.php';
?>
