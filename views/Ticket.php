<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/styles/topBar.css">
    <link rel="stylesheet" href="../public/styles/userTicket.css">
</head>
<body>
    <?php  require('../components/Topbar.php') ?>

    <div class="container">
        <h1>Colegio de Montalban Ticketing System</h1>

        <!-- Submit Ticket Section -->
        <div class="section submit-ticket">
            <h2>Submit a Ticket</h2>
            <form action="submit_ticket.php" method="POST" enctype="multipart/form-data">
                <label for="fullName">Full Name</label>
                <input type="text" id="fullName" name="fullName" required>

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
            <div class="status-content">
                <ul>
                    <li>
                        <strong>Ticket ID:</strong> 001 - <strong>Status:</strong> In Progress
                    </li>
                    <li>
                        <strong>Ticket ID:</strong> 002 - <strong>Status:</strong> Completed
                    </li>
                    <li>
                        <strong>Ticket ID:</strong> 003 - <strong>Status:</strong> Pending Review
                    </li>
                </ul>
                <button onclick="checkTicket()">Check Ticket Status</button>
            </div>
        </div>
    </div>

    <script>
        function checkTicket() {
            alert("This will allow users to view or search their ticket status.");
        }
    </script>
</body>
</html>