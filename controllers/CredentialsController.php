<?php

require '../model/AdminModel.php';
use App\Models\AdminModel;

$adminModel = new AdminModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['import-file'])) {
    $fileTmpPath = $_FILES['import-file']['tmp_name'];
    $fileName = $_FILES['import-file']['name'];
    $fileSize = $_FILES['import-file']['size'];
    $fileType = $_FILES['import-file']['type'];
    

    if ($fileType !== 'application/json') {
        echo 'Please upload a valid JSON file.';
        exit;
    }


    $fileContent = file_get_contents($fileTmpPath);
    $students = json_decode($fileContent, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo 'Invalid JSON format.';
        exit;
    }

    $students = $students['students']; 

    try {
        $insertCount = $adminModel->insertCredentials($students); 
      
    } catch (Exception $e) {
        echo 'Error importing data: ' . $e->getMessage();
    }
}

if($_SERVER['REQUEST_METHOD']){
    $deleteID = isset($_POST['deleteStudentId'])? $_POST['deleteStudentId'] : null;
    
    try {
        if ($deleteID) {
            $adminModel->deleteCredentialsById($deleteID);
        }
    } catch (\Throwable $th) {
        echo 'Error deleting data: ' . $th->getMessage();
    }   
}
if ($_SERVER['REQUEST_METHOD']) {
    $deleteAll = isset($_POST['deleteAll']) ? $_POST['deleteAll'] : null;

    if ($deleteAll) {
        try {
            $adminModel->deleteAllCredentials();
           
        } catch (\Throwable $th) {
            echo 'Error deleting data: ' . $th->getMessage();
        }
    }
}




$studentsData = $adminModel->getCredentials();  


require '../views/Admin/credentials.php';
?>
