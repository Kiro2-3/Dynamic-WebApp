<?php

use App\Models\AdminModel;
session_start();

require '../model/AdminModel.php';

$adminModel = new AdminModel();

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: /views/Admin/statistics.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        if($adminModel->validateAdminLogin($email, $password)){
            header('Location: /views/Admin/statistics.php');
        }
        else {
            echo "<script>alert('Invalid Credentials');</script>";
        }
      
    } catch (\Throwable $th) {
        echo 'error';
    }
}

require '../views/Admin/AdminLogin.php';
?>