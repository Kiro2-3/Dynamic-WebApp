<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/styles/AdminCss/ChatSupport.css">
    <title>Chat Support</title>
</head>
<body>
<?php require('../../components/sidebar.php') ?>

<div class="container">
    <div class="header" style=" box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
        Colegio de Montalban - <span style="color: white;">Chat Support</span>
    </div>
    <div class="main-content">
        <!-- User Profiles Section -->
        <div class="user-profiles">
            <div class="searbar__container">
                <input type="text" class="search-input" placeholder="Search user...">
                <span class="search-icon">&#128269;</span>
            </div>
            <h2>Users</h2>
            <!-- List of user profiles goes here -->
            <div class="user-profile">User 1</div>
            <div class="user-profile">User 2</div>
            <!-- Repeat for each user -->
        </div>

        <!-- Chat Box Section -->
        <div class="chat-box">
            <div class="chat-messages">
                <p><strong>User 1:</strong> Hello, I need help with my account.</p>
                <p><strong>Admin:</strong> Sure, let me assist you with that.</p>
                <!-- Repeat for each message -->
            </div>
            <div class="message-input">
                <textarea rows="2" placeholder="Type a message..."></textarea>
                <button type="button">Send</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>