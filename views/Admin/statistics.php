<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/styles/sideBar.css">
    <link rel="stylesheet" href="/public/styles/AdminCss/Statistics.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Include Chart.js -->
</head>
<body>

    <?php require('../../components/sidebar.php') ?>

    <div class="container">
        <div class="header">
            Colegio de Montalban - <span style="color: white;">Statistics</span>
        </div>
        
        <div class="stats-section">
            <div class="stat-card">
                <i class="fas fa-ticket-alt stat-icon"></i>
                <h4>Total Tickets</h4>
                <p>123</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-tasks stat-icon"></i>
                <h4>Active Tickets</h4>
                <p>45</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-check-circle stat-icon"></i>
                <h4>Closed Tickets</h4>
                <p>78</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-comments stat-icon"></i>
                <h4>Total Chats</h4>
                <p>10</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-comment-dots stat-icon"></i>
                <h4>Active Chats</h4>
                <p>10</p>
            </div>
        </div>
        
        <div class="chart-section">
            <div class="chart" id="ticketChartContainer">
                <canvas id="ticketChart"></canvas> <!-- Canvas for Ticket Trend Chart -->
            </div>
            <div class="chart" id="responseChartContainer">
                <canvas id="responseChart"></canvas> <!-- Canvas for Response Time Chart -->
            </div>
        </div>
    </div>

    <script>
        // Ticket Trend (Monthly) Chart
        const ticketCtx = document.getElementById('ticketChart').getContext('2d');
        const ticketChart = new Chart(ticketCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Tickets Created',
                    data: [10, 15, 8, 20, 25, 18, 30, 24, 15, 22, 19, 27], // Demo data
                    backgroundColor: '#FEAE00',
                    borderColor: '#054721',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: true, position: 'top' }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Number of Tickets' }
                    }
                }
            }
        });

        // Response Time (Average) Chart
        const responseCtx = document.getElementById('responseChart').getContext('2d');
        const responseChart = new Chart(responseCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Average Response Time (minutes)',
                    data: [30, 25, 20, 18, 22, 17, 19, 23, 24, 21, 20, 18],
                    backgroundColor: 'rgba(254, 174, 0, 0.2)',
                    borderColor: '#FEAE00',
                    borderWidth: 2,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: true, position: 'top' }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Response Time (minutes)' }
                    }
                }
            }
        });
    </script>
</body>
</html>
