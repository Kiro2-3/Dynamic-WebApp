<?php
require '../vendor/autoload.php';
require '../model/AdminModel.php';

use App\Models\AdminModel;


$adminModel = new AdminModel();

$email = 'colegiodemontalban123@gmail.com';
$password = 'colegiodemontalban123__';

$adminId = $adminModel->createAdmin($email, $password);    

echo 'Admin created with ID: ' . $adminId;
?>