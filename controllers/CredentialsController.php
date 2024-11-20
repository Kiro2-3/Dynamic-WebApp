<?php

require '../model/AdminModel.php';
use App\Models\AdminModel;

$adminModel = new AdminModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['import-file'])) {
    $fileTmpPath = $_FILES['import-file']['tmp_name'];
    $fileName = $_FILES['import-file']['name'];
    $fileSize = $_FILES['import-file']['size'];
    $fileType = $_FILES['import-file']['type'];
    
    // Check if it's a valid JSON file
    if ($fileType !== 'application/json') {
        echo 'Please upload a valid JSON file.';
        exit;
    }

    // Read and decode the JSON file
    $fileContent = file_get_contents($fileTmpPath);
    $students = json_decode($fileContent, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo 'Invalid JSON format.';
        exit;
    }

    // Flatten the data to remove the "students" wrapper
    $students = $students['students']; // Extract the array from the "students" key

    // Insert data into MongoDB using the AdminModel's insertCredentials method
    try {
        $insertCount = $adminModel->insertCredentials($students);  // Call the method from AdminModel
      
    } catch (Exception $e) {
        echo 'Error importing data: ' . $e->getMessage();
    }
}

// Fetch all credentials after the insertion
$studentsData = $adminModel->getCredentials();  // Method to fetch credentials from MongoDB

// Pass the data to the view
require '../views/Admin/credentials.php';
?>
