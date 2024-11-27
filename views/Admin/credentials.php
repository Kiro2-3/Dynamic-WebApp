<?php

$rowsPerPage = 7;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$startRow = ($currentPage - 1) * $rowsPerPage;

$totalRows = count($studentsData); // Total records fetched from MongoDB
$totalPages = ceil($totalRows / $rowsPerPage);

$paginatedData = array_slice($studentsData, $startRow, $rowsPerPage); // Slice data for pagination

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/styles/sideBar.css">
    <link rel="stylesheet" href="/public/styles/AdminCss/Credentials.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Credentials</title>
</head>
<body>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/components/sidebar.php') ?>

<div class="container">
    <div class="header" style=" box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
        Colegio de Montalban - <span style="color: white;">Credentials</span>
    </div>
    <div class="credentials-content">
        <div class="actions-section">
            <div class="button-group">
                <label for="import-file" class="import-button">Import JSON</label>
                <form method="POST" enctype="multipart/form-data">
                    <input type="file" id="import-file" name="import-file" accept=".json" style="display: none;" onchange="this.form.submit();">
                </form>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="deleteAllForm">
                    <button type="button" id="deleteAllBtn" class="DeleteAll" value="true">Delete All</button>
                </form>

            </div>
            <div class="search-bar">
                <form method="get" action="">
                    <div class="search-icon-container">
                        <i class="fas fa-search"></i> 
                        <input type="text" id="searchInput" placeholder="Search tickets..." onkeyup="filterTable()" />
                    </div>
                </form>
            </div>
        </div>

        <div class="credentials-table">
            <table>
                <thead>
                    <tr>
                      
                        <th>Student No</th>
                        <th>Name</th>
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
                                    <td>" . htmlspecialchars($user['StudentID']) . "</td>
                                    <td>" . htmlspecialchars($user['username']) . "</td>
                                    <td>" . htmlspecialchars($user['email']) . "</td>
                                    <td>" . htmlspecialchars($user['password']) . "</td>
                                    <td>
                                        <form action='' method='POST' id='deleteForm-" . htmlspecialchars($user['StudentID']) . "'>
                                            <input type='hidden' name='deleteStudentId' value='" . htmlspecialchars($user['StudentID']) . "'>
                                            <button type='button' class='delete-button' data-student-id='" . htmlspecialchars($user['StudentID']) . "'>Delete</button>
                                        </form>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No records found</td></tr>";
                        }
                    ?>
                </tbody>
                <div id="deleteModal" class="modal">
                <div class="modal-content">
                    <h4>Are you sure you want to delete this?</h4>
                    <p>This action cannot be undone.</p>
                    <div class="modal-footer">
                        <button class="modal-close btn-cancel">Cancel</button>
                        <button id="confirmDeleteBtn" class="btn-delete">Yes, Delete</button>
                    </div>
                </div>
            </div>


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
        <!-- Modal for delete all confirmation -->
<div id="deleteAllModal" class="modal">
    <div class="modal-content">
        <h4>Are you sure you want to delete all credentials?</h4>
        <p>This action cannot be undone.</p>
        <div class="modal-footer">
            <button class="modal-close btn-cancel">Cancel</button>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="deleteAllForm">
                <input type="hidden" name="deleteAll" value="true">
                <button type="submit" class="btn-delete">Yes, Delete All</button>
            </form>
        </div>
    </div>
</div>
<script src="/js/SearchBar.js" ></script>

<script>
    document.getElementById('deleteAllBtn').addEventListener('click', function() {
        document.getElementById('deleteAllModal').style.display = 'block'; 
    });
    document.addEventListener('DOMContentLoaded', function () {
   
    document.querySelector('.modal-close').addEventListener('click', function() {
        document.getElementById('deleteAllModal').style.display = 'none'; 
    });
    
  
    document.querySelectorAll('.modal-close').forEach(button => {
        button.addEventListener('click', function() {
            const modal = this.closest('.modal');
            modal.style.display = 'none'; // Close the modal
        });
    });
});

</script>

<script>
    document.getElementById('import-file').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file && file.type === 'application/json') {
            console.log("JSON file selected:", file.name);
        } else {
            alert("Please upload a valid JSON file.");
        }
    });

  
  
        document.addEventListener('DOMContentLoaded', function () {
        // Add event listener for all delete buttons
        const deleteButtons = document.querySelectorAll('.delete-button');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const studentID = this.getAttribute('data-student-id');
                openModal(studentID); // Open the modal and pass studentID
            });
        });

        // Close modal
        document.querySelector('.modal-close').addEventListener('click', closeModal);
        
        // Confirm delete
        document.querySelector('#confirmDeleteBtn').addEventListener('click', confirmDelete);
    });

    // Open Modal
    function openModal(studentID) {
        document.getElementById('deleteModal').style.display = 'block'; 
        window.currentDeleteID = studentID;
    }

    // Close Modal
    function closeModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }

    // Confirm delete and submit the form
    function confirmDelete() {
        const form = document.getElementById('deleteForm-' + window.currentDeleteID);
        form.submit();
        closeModal(); 
    }

    
              
</script>

</body>
</html>
