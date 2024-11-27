<?php
session_start();

function logout(){
    session_unset();  
    session_destroy();  
    header('Location: /controllers/studentLogin.php');  
    exit();
}

if (isset($_POST['logout'])) {
    logout();
}

// Check if user is logged in
$isLoggedIn = isset($_SESSION['studentNo']) && isset($_SESSION['email']);
?>

<link rel="stylesheet" href="../public/styles/topBar.css">
<div class="topbar__container">
    <div class="image-slider">
        <img src="../public/image/cdm.jpg" alt="CDM Background" class="slider__image">
        <img src="../public/image/cdmFaculty.jpg" alt="CDM Faculty" class="slider__image">
    </div>

    <div class="center__message">
        <h1>Your <span class="highlight">feedback</span> and <span class="highlight">concerns</span> matter. Together, we’ll make your college <span class="highlight">experience</span> the best it can be.</h1>
    </div>

    <div class="left__container">
        <img src="/public/image/cdmLogo.png" alt="Logo" class="cdmLogo">
        <h3><span style="color: #FEAE00;">CDM</span>CSS</h3>
    </div>

    <div class="middle__container">
        <a href="/views/home.php">Home</a>
        <a href="/controllers/TicketController.php">Ticket</a>
        <a href="#about">About</a>
    </div>

    <div class="right__container" style="z-index: 1000;">
        <?php if ($isLoggedIn): ?>
            <i class="fas fa-user profile__icon"></i>
            <div class="profile__modal">
                <p><strong>Student No:</strong> <?php echo htmlspecialchars($_SESSION['studentNo']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
                <form method="POST" action="">
                    <button class="logout__button" name="logout" type="submit">Log Out</button>
                </form>
            </div>
        <?php else: ?>
            <a href="/controllers/studentLogin.php">Login</a>
        <?php endif; ?>
    </div>
</div>

<script src="../js/ProfileModal.js"></script>
