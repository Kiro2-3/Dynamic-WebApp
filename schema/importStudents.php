<?php
require '../model/AdminModel.php';
use App\Models\AdminModel; // Adjust this to match your namespace if needed

// Instantiate the AdminModel to access insertCredentials
$adminModel = new AdminModel();

// Student data for testing
$students = [
    [
        "user_id" => "001",
        "StudentID" => "S001",
        "username" => "johndoe",
        "email" => "johndoe@example.com",
        "password" => "password123"
    ],
    [
        "user_id" => "002",
        "StudentID" => "S002",
        "username" => "janedoe",
        "email" => "janedoe@example.com",
        "password" => "password123"
    ]
];

// Testing the insertCredentials method
try {
    $insertResult = $adminModel->insertCredentials($students);

    // Check if any documents were inserted
    if ($insertResult > 0) {
        echo $insertResult . ' documents inserted successfully!<br>';
    } else {
        echo 'No documents were inserted.<br>';
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage() . "<br>";
}
?>
