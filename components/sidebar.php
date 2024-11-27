<?php

session_start();


function logout(){
    session_unset();  
    session_destroy();  
    header('Location: /controllers/AdminController.php');  
    exit();
}

if (isset($_POST['logout'])) {
    logout();
}

?>



<link rel="stylesheet" href="/public/styles/sideBar.css">
<div class="sidebar__container">
    <img src="/public/image/cdmLogo.png" alt="Logo">
    <h2><span style="color: #FEAE00;">CDM</span>CSS <br><span style="font-size: medium;">Admin Dashboard</span></h2>
    <ul style="list-style-type: none;">
        <li><a href="/views/Admin/statistics.php"><i class="fa fa-chart-bar"></i> Statistics</a></li>
        <li><a href="/views/Admin/chatsupport.php"><i class="fa fa-comments"></i> Chat Support</a></li>
        <li><a href="/controllers/AdminTicketController.php"><i class="fa fa-ticket-alt"></i> Tickets</a></li>
        <li><a href="/controllers/CredentialsController.php"><i class="fa fa-user-shield"></i> Credentials</a></li>
    </ul>

    <!-- Logout form -->
    <form method="POST">
        <button type="submit" name="logout" class="logout__btn">
            <i class="fa fa-sign-out-alt"></i> Logout
        </button>
    </form>
</div>

