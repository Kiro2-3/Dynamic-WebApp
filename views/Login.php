<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/styles/LoginPage.css">
    <link rel="shortcut icon" href="../public/Icons/loginICon.png" type="image/x-icon">
    <title>Login</title>
</head>
<body>
    <img src="../public/image/cdm.jpg" class="imageBg" alt="">

    <div class="container">
        <form method="post">
            <h3>Login Now</h3>
            <div class="input__form">
                <div class="group__input">
                    <label for="studentNo">Student No:</label>
                    <input type="text" name="studentNo">
                </div>

                <div class="group__input">
                    <label for="email">Email:</label>
                    <input type="email" name="email">
                </div>

                <div class="group__input">
                    <label for="password">Password:</label>
                    <input type="password" name="password">
                </div>
            </div>
            <a href="/views/Home.php" class="btn__login">Login</a>
            <label class="btn__label">Don’t have an Account? <span style="color: hsl(145, 87%, 15%)">Enroll Now</span></label>
        </form>
        
        <div class="right__container">
            <img src="../public/image/cdmLogo.png" alt="">
            <h1 >Hello <span style="color: #FEAE00">CDMians</span> <br>Welcome to<br>Your <br>Support Hub</h1>
        </div>
    </div>
    
</body>
</html>