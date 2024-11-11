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
        'concern' => 'Unable to access account',
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
];
?>


<?php require('../../components/sidebar.php') ?>

<div class="container">
    <div class="header">
        Colegio de Montalban - <span style="color: white;">Tickets</span>
    </div>

    <div class="ticket-table">
        <table>
            <thead>
                <tr>
                    <th>Ticket ID</th>
                    <th>User</th>
                    <th>Institute</th>
                    <th>Concern</th>
                    <th>File</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example data for demonstration, replace with PHP loop fetching tickets from database -->
                <?php foreach ($tickets as $ticket): ?>
                    <tr>
                        <td><?php echo $ticket['id']; ?></td>
                        <td><?php echo $ticket['user_name']; ?></td>
                        <td><?php echo $ticket['institute']; ?></td>
                        <td><?php echo $ticket['concern']; ?></td>
                        <td class="file-attachment">
                        <?php if ($ticket['file']): ?>
                            <a href="<?php echo $ticket['file']; ?>" target="_blank">Download</a>
                        <?php else: ?>
                            No attachment
                        <?php endif; ?>
                    </td>
                        <td><?php echo $ticket['status']; ?></td>
                        <td>
                            <button onclick="openEditModal(<?php echo $ticket['id']; ?>)">Edit</button>
                            <button onclick="deleteTicket(<?php echo $ticket['id']; ?>)">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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
            <button type="submit">Save Changes</button>
        </form>
    </div>
</div>
<script>function openEditModal(ticketId) {
    document.getElementById('editModal').style.display = 'flex';
    document.getElementById('ticketId').value = ticketId;
    // Populate email field based on ticket data if needed
}

function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}

function deleteTicket(ticketId) {
    if (confirm('Are you sure you want to delete this ticket?')) {
        // Add code here to delete ticket from database
        alert(`Ticket with ID ${ticketId} deleted.`);
    }
}
</script>

</body>
</html>
