<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/styles/AdminCss/Ticket.css">
    <title>Tickets</title>
</head>
<body>
<?php
// Sample ticket data with file attachments
$tickets = [
    [
        'id' => 1,
        'user_name' => 'John Doe',
        'institute' => 'Institute of Science',
        'concern' => 'Unable to access account asdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasd',
        'status' => 'Active',
        'file' => 'uploads/account_issue.pdf'
    ],
    [
        'id' => 2,
        'user_name' => 'Jane Smith',
        'institute' => 'Institute of Technology',
        'concern' => 'Error in submission form',
        'status' => 'Done',
        'file' => 'uploads/form_error_screenshot.png'
    ],
    [
        'id' => 3,
        'user_name' => 'Mike Johnson',
        'institute' => 'Institute of Engineering',
        'concern' => 'Slow loading times',
        'status' => 'Active',
        'file' => 'uploads/loading_issue_log.txt'
    ],
    [
        'id' => 4,
        'user_name' => 'Anna White',
        'institute' => 'Institute of Arts',
        'concern' => 'File upload issue',
        'status' => 'Done',
        'file' => 'uploads/upload_error_report.docx'
    ],
    [
        'id' => 5,
        'user_name' => 'Anna White',
        'institute' => 'Institute of Arts',
        'concern' => 'File upload issue',
        'status' => 'Done',
        'file' => 'uploads/upload_error_report.docx'
    ],
    [
        'id' => 6,
        'user_name' => 'Anna White',
        'institute' => 'Institute of Arts',
        'concern' => 'File upload issue',
        'status' => 'Done',
        'file' => 'uploads/upload_error_report.docx'
    ],
    [
        'id' => 7,
        'user_name' => 'Anna White',
        'institute' => 'Institute of Arts',
        'concern' => 'File upload issue',
        'status' => 'Done',
        'file' => 'uploads/upload_error_report.docx'
    ],
    [
        'id' => 8,
        'user_name' => 'Anna White',
        'institute' => 'Institute of Arts',
        'concern' => 'File upload issue',
        'status' => 'Done',
        'file' => 'uploads/upload_error_report.docx'
    ],
    [
        'id' => 9,
        'user_name' => 'Anna White',
        'institute' => 'Institute of Arts',
        'concern' => 'File upload issue',
        'status' => 'Done',
        'file' => 'uploads/upload_error_report.docx'
    ],
    [
        'id' => 10,
        'user_name' => 'Anna White',
        'institute' => 'Institute of Arts',
        'concern' => 'File upload issue',
        'status' => 'Done',
        'file' => 'uploads/upload_error_report.docx'
    ],
    [
        'id' => 11,
        'user_name' => 'Anna White',
        'institute' => 'Institute of Arts',
        'concern' => 'File upload issue',
        'status' => 'Done',
        'file' => 'uploads/upload_error_report.docx'
    ],
];

// Pagination logic
$rowsPerPage = 7;
$totalTickets = count($tickets);
$totalPages = ceil($totalTickets / $rowsPerPage);

// Get current page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$startIndex = ($page - 1) * $rowsPerPage;

// Slice the ticket array to show only the tickets for the current page
$paginatedTickets = array_slice($tickets, $startIndex, $rowsPerPage);

// Simple search filter logic
$search = isset($_GET['search']) ? $_GET['search'] : '';
$filteredTickets = array_filter($paginatedTickets, function ($ticket) use ($search) {
    return strpos(strtolower($ticket['user_name']), strtolower($search)) !== false ||
           strpos(strtolower($ticket['institute']), strtolower($search)) !== false ||
           strpos(strtolower($ticket['concern']), strtolower($search)) !== false;
});
?>

<?php require('../../components/sidebar.php') ?>

<div class="container">
    <div class="header" style=" box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
        Colegio de Montalban - <span style="color: white;">Tickets</span>
    </div>

    <div class="ticket-table">
        <div class="search-bar">
                <form method="get" action="">
                    <div class="search-icon-container">
                        <i class="fas fa-search"></i> 
                        <input type="text" name="search" placeholder="Search Credentials..." value="<?php echo htmlspecialchars($search); ?>">
                    </div>
                </form>
        </div>

        <table>
           <thead>
               <tr>
                   <th>Ticket ID</th>
                   <th>User Name</th>
                   <th>Institute</th>
                   <th>Concern</th>
                   <th>Attachment</th>
                   <th>Status</th>
                   <th>Actions</th>
               </tr>
           </thead>
            <tbody>
                <?php foreach ($filteredTickets as $ticket): ?>
                    <tr>
                        <td><?php echo $ticket['id']; ?></td>
                        <td><?php echo $ticket['user_name']; ?></td>
                        <td><?php echo $ticket['institute']; ?></td>
                        <td class="concern"><?php echo $ticket['concern']; ?></td>
                        <td class="file-attachment">
                            <?php if ($ticket['file']): ?>
                                <a href="<?php echo $ticket['file']; ?>" target="_blank">Download</a>
                            <?php else: ?>
                                No attachment
                            <?php endif; ?>
                        </td>
                        <td>
                            <select name="status"  onchange="updateTicketStatus(this, <?php echo $ticket['id']; ?>)"  style="background-color: <?php echo $ticket['status'] === 'Active' ? '#28a745' : '#007bff'; ?>;">
                                <option value="Active" <?php echo $ticket['status'] === 'Active' ? 'selected' : ''; ?>>Active</option>
                                <option value="Done" <?php echo $ticket['status'] === 'Done' ? 'selected' : ''; ?>>Done</option>
                            </select>
                        </td>

                        <td>
                            <button class="edit-button" onclick="openEditModal(<?php echo $ticket['id']; ?>)">Edit</button>
                            <button class="delete-button" onclick="deleteTicket(<?php echo $ticket['id']; ?>)">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="pagination">
            <button <?php if ($page <= 1) echo 'disabled'; ?> onclick="window.location.href='?page=<?php echo $page - 1; ?>&search=<?php echo htmlspecialchars($search); ?>'">Previous</button>
            <span>Page <?php echo $page; ?> of <?php echo $totalPages; ?></span>
            <button <?php if ($page >= $totalPages) echo 'disabled'; ?> onclick="window.location.href='?page=<?php echo $page + 1; ?>&search=<?php echo htmlspecialchars($search); ?>'">Next</button>
        </div>
    </div>
</div>

<!-- Modal for editing ticket -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <h2>Edit Ticket</h2>
        <form id="editTicketForm" method="post" action="edit_ticket.php">
            <input type="hidden" id="ticketId" name="ticketId">
            <label for="status">Status</label>
            <select name="status" id="status">
                <option value="Active">Active</option>
                <option value="Done">Done</option>
            </select>
            <label for="email">Send Email to User</label>
            <input type="email" id="email" name="email" placeholder="user@example.com">
            <button class="save-button" type="submit">Save Changes</button>
        </form>
    </div>
</div>

<script>
function openEditModal(ticketId) {
    document.getElementById('editModal').style.display = 'flex';
    document.getElementById('ticketId').value = ticketId;
}

function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}

function deleteTicket(ticketId) {
    if (confirm('Are you sure you want to delete this ticket?')) {
        alert(`Ticket with ID ${ticketId} deleted.`);
    }
}
function updateTicketStatus(selectElement, ticketId) {
    const selectedValue = selectElement.value;

    const activeColor = '#28a745'; 
    const doneColor = '#007bff'; 

  
    selectElement.style.backgroundColor = selectedValue === 'Active' ? activeColor : doneColor;
}

</script>


</body>
</html>
