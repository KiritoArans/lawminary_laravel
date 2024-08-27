<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Login</title>
    <link rel="icon" href="../imgs/lawminarylogo.png" type="image/png">
    <link rel="stylesheet" href="{{ asset ('css/login_style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <section>
        <div class="wrapper">
            <div class="logo-content">
                <img src="../imgs/lawminarylogo.png" alt="Lawminary Logo">
            </div>
            <div class="line"></div>
            <div class="login-content">
                <h1>Login</h1>
                <div class="username">
                    <label for="username">Username</label>
                    <input type="text" id="username" placeholder="Type your username">
                </div>
                <div class="password">
                    <label for="password">Password</label>
                    <input type="password" id="password" placeholder="Type your password">
                </div>
                <div class="buttons">
                    <a class="bn3637 bn36" href="signup.html">Sign Up</a>
                    <button class="bn3637 bn37">Login</button>
                </div>
                <div class="forgot">
                    <a href="#">Forgot Password?</a>
                </div>
            </div>
        </div>
    </section>
</body>
</html>