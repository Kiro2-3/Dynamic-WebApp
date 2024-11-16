<?php

$rowsPerPage = 7;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$startRow = ($currentPage - 1) * $rowsPerPage;

$totalRows = 0; // Default to 0, will be updated based on the imported data
$totalPages = ceil($totalRows / $rowsPerPage);

$paginatedData = []; // Initially empty, will be populated from data source

// Check if a file was uploaded
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['import-file']) && $_FILES['import-file']['error'] == 0) {
    $jsonFile = $_FILES['import-file']['tmp_name'];
    
  
    $jsonData = file_get_contents($jsonFile);
    $students = json_decode($jsonData, true)['students'];  

    foreach ($students as &$student) {

        if (isset($student['password'])) {
            $student['password'] = password_hash($student['password'], PASSWORD_DEFAULT);
        }
    }

 
    $totalRows = count($students);
    $totalPages = ceil($totalRows / $rowsPerPage);
    $paginatedData = array_slice($students, $startRow, $rowsPerPage);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/styles/sideBar.css">
    <link rel="stylesheet" href="/public/styles/AdminCss/Credentials.css">
    <title>Credentials</title>
</head>
<body>

<?php require('../../components/sidebar.php') ?>

<div class="container">
    <div class="header" style=" box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
        Colegio de Montalban - <span style="color: white;">Credentials</span>
    </div>
    <div class="credentials-content">
        <div class="actions-section">
            <div class="button-group">
                <button class="add-user-button">Add New User</button>
                <label for="import-file" class="import-button">Import JSON</label>
                <form method="POST" enctype="multipart/form-data">
                    <input type="file" id="import-file" name="import-file" accept=".json" style="display: none;" onchange="this.form.submit();">
                </form>
            </div>
            <div class="search-bar">
                <form method="get" action="">
                    <div class="search-icon-container">
                        <i class="fas fa-search"></i> 
                        <input type="text" name="search" placeholder="Search tickets..." value="<?php echo htmlspecialchars($search); ?>">
                    </div>
                </form>
            </div>
        </div>

        <div class="credentials-table">
            <table>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Student No</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Display data rows for the current page
                    if (!empty($paginatedData)) {
                        foreach ($paginatedData as $user) {
                            echo "<tr>
                                <td>" . $user['user_id'] . "</td>
                                <td>" . $user['StudentID'] . "</td>
                                <td>" . $user['username'] . "</td>
                                <td>" . $user['email'] . "</td>
                                <td>" . $user['password'] . "</td>
                                <td>
                                    <button class='edit-button'>Edit</button>
                                    <button class='delete-button'>Delete</button>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- Pagination Controls -->
            <div class="pagination">
                <button 
                    <?php if ($currentPage <= 1) echo 'disabled'; ?>
                    onclick="window.location.href='?page=<?php echo $currentPage - 1; ?>'">
                    Previous
                </button>
                <span id="page-info">Page <?php echo $currentPage; ?> of <?php echo $totalPages; ?></span>
                <button 
                    <?php if ($currentPage >= $totalPages) echo 'disabled'; ?>
                    onclick="window.location.href='?page=<?php echo $currentPage + 1; ?>'">
                    Next
                </button>
            </div>
        </div>

    </div>
</div>

<script>
    document.getElementById('import-file').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file && file.type === 'application/json') {
            console.log("JSON file selected:", file.name);
        } else {
            alert("Please upload a valid JSON file.");
        }
    });

    document.querySelector('.add-user-button').addEventListener('click', function() {
        alert("Add New User functionality coming soon!");
    });
</script>

</body>
</html>
