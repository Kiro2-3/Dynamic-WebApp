<?php
use App\Middleware\AuthMiddleware;
require_once dirname(__DIR__) . '/Middleware/AuthMiddleware.php';

// Check if the student is not logged in, if so, redirect to login page
AuthMiddleware::checkStudentNotLoggedIn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketing System</title>
    <link rel="stylesheet" href="../public/styles/topBar.css">
    <link rel="stylesheet" href="../public/styles/userTicket.css">
    <style>
        /* Style for the alert message */
        .alert {
            position: fixed;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            z-index: 1000;
        }
    </style>
</head>
<body>
    <?php require('../components/Topbar.php') ?>

    <div class="container">
        <h1 style="color: #054721;">Colegio de Montalban Ticketing System</h1>

        <!-- Submit Ticket Section -->
        <div class="section submit-ticket">
            <h2>Submit a Ticket</h2>
            <form method="POST" enctype="multipart/form-data">
                <label for="email">Email Address</label>
                <input type="text" id="email" name="email" required placeholder="Email must be same as your credentials">

                <label for="institute">Institute</label>
                <select id="institute" name="institute" required>
                    <option value="" disabled selected>Select your institute</option>
                    <option value="IT">Institute of Technology</option>
                    <option value="Business">Institute of Business</option>
                    <option value="Education">Institute of Education</option>
                </select>

                <label for="concern">Concern</label>
                <textarea id="concern" name="concern" rows="4" placeholder="Describe your concern..." required></textarea>

                <label for="attachment">Attachment (Optional)</label>
                <input type="file" id="attachment" name="attachment">

                <button type="submit">Submit Ticket</button>
            </form>
        </div>

        <!-- Ticket Status Section -->
        <div class="section ticket-status">
            <h2>Ticket Status</h2>
            <table>
                <thead>
                    <tr>
                        <th>Ticket ID</th>
                        <th>Concern</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($tickets)): ?>
                        <?php foreach ($tickets as $ticket): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($ticket['_id']); ?></td>
                                <td><?php echo htmlspecialchars($ticket['concern']); ?></td>
                                <td><?php echo htmlspecialchars($ticket['status']); ?></td>
                                <td>
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="deleteTicketId" value="<?php echo htmlspecialchars($ticket['_id']); ?>">
                                        <button type="submit"">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align: center;">No tickets found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>

    </div>

    <script>
        // Handle alert message
        window.onload = function() {
            const alertMessage = document.querySelector('.alert');
            if (alertMessage) {
                setTimeout(function() {
                    alertMessage.style.display = 'none';
                }, 3000); // Hide alert after 3 seconds
            }
        }
    </script>
</body>
</html>
