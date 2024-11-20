<?php
require '../vendor/autoload.php';
require '../model/AdminModel.php';

use App\Models\AdminModel;


$adminModel = new AdminModel();

$email = 'colegiodemontalban@gmail.com';
$password = 'colegiodemontalban';

$adminId = $adminModel->createAdmin($email, $password);    

echo 'Admin created with ID: ' . $adminId;
?>