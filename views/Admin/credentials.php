<?php
// Sample data array for credentials
$credentialsData = [
    ['user_id' => '001', 'username' => 'johndoe', 'email' => 'johndoe@example.com', 'role' => 'Admin'],
    ['user_id' => '002', 'username' => 'janedoe', 'email' => 'janedoe@example.com', 'role' => 'User'],
    ['user_id' => '003', 'username' => 'alice', 'email' => 'alice@example.com', 'role' => 'User'],
    ['user_id' => '004', 'username' => 'bob', 'email' => 'bob@example.com', 'role' => 'Admin'],
    ['user_id' => '005', 'username' => 'charlie', 'email' => 'charlie@example.com', 'role' => 'User'],
    ['user_id' => '006', 'username' => 'dave', 'email' => 'dave@example.com', 'role' => 'Admin'],
    ['user_id' => '007', 'username' => 'eve', 'email' => 'eve@example.com', 'role' => 'User'],
    ['user_id' => '008', 'username' => 'frank', 'email' => 'frank@example.com', 'role' => 'User'],
    ['user_id' => '009', 'username' => 'grace', 'email' => 'grace@example.com', 'role' => 'Admin'],
    ['user_id' => '010', 'username' => 'hank', 'email' => 'hank@example.com', 'role' => 'User'],
    ['user_id' => '011', 'username' => 'irene', 'email' => 'irene@example.com', 'role' => 'User'],
    ['user_id' => '012', 'username' => 'jack', 'email' => 'jack@example.com', 'role' => 'Admin'],
    // Add more as needed...
];

// Pagination settings
$rowsPerPage = 7;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$startRow = ($currentPage - 1) * $rowsPerPage;

// Calculate the total number of pages
$totalRows = count($credentialsData);
$totalPages = ceil($totalRows / $rowsPerPage);

// Get the data for the current page
$paginatedData = array_slice($credentialsData, $startRow, $rowsPerPage);
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
    <div class="header">
        Colegio de Montalban - <span style="color: white;">Credentials</span>
    </div>
    <div class="credentials-content">
        <div class="actions-section">
            <div class="button-group">
                <button class="add-user-button">Add New User</button>
                <label for="import-file" class="import-button">Import JSON</label>
                <input type="file" id="import-file" accept=".json" style="display: none;">
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
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
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
                                <td>" . $user['username'] . "</td>
                                <td>" . $user['email'] . "</td>
                                <td>" . $user['role'] . "</td>
                                <td>
                                    <button class='edit-button'>Edit</button>
                                    <button class='delete-button'>Delete</button>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- Pagination Controls -->
            <div class="pagination">
                <button 
                    <?php if ($currentPage <= 1) echo 'disabled'; ?>
                    onclick="window.location.href='?page=<?php echo $currentPage - 1; ?>&search=<?php echo htmlspecialchars($search); ?>'">
                    Previous
                </button>
                <span id="page-info">Page <?php echo $currentPage; ?> of <?php echo $totalPages; ?></span>
                <button 
                    <?php if ($currentPage >= $totalPages) echo 'disabled'; ?>
                    onclick="window.location.href='?page=<?php echo $currentPage + 1; ?>&search=<?php echo htmlspecialchars($search); ?>'">
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
