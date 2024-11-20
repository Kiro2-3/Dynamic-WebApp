<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/styles/AdminCss/AdminLogin.css">
    <title>Admin Login</title>
</head>
<body>
    <img src="/public/image/cdm.jpg" class="imageBg" alt="">
    
    <form method="POST">
        <h3>Login as Admin</h3>
        <div class="input__form">
            <div class="group__input">
                <label for="email">Email:</label>
                <input type="email" name="email">
            </div>
            <div class="group__input">
                <label for="password">Password:</label>
                <input type="password" name="password">
            </div>
        </div>
        <button class="btn__login" type="submit">Login</button>
    </form>

</body>
</html>
