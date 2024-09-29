<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Login</title>
    <link rel="icon" href="../imgs/lawminarylogo.png" type="image/png">
    <link rel="stylesheet" href="{{ asset ('css/login_style.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/nav_style.css') }}">
    @include('inclusions/libraryLinks')
</head>
<body>
    <section>
        <div class="wrapper">
            <div class="logo-content">
                <img src="../imgs/lawminarylogo.png" alt="Lawminary Logo">
            </div>
            <div class="line"></div>
            <div class="login-content">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <h1>Login</h1>
                    @if ($errors->has('loginError'))
                        <div class="error">
                            <span>{{ $errors->first('loginError') }}</span>
                        </div>
                    @endif
                    <div class="username">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Type your username" value="{{ old('username') }}" required>
                    </div>
                    <div class="password">
                        <label for="password">Password</label>
                        <div class="password-container">
                            <input type="password" id="password" name="password" placeholder="Type your password" required>
                            <i class="fas fa-eye toggle-password" id="togglePassword"></i> <!-- Eye icon -->
                        </div>
                    </div>
                                      
                    <div class="buttons">
                        <a class="bn3637 bn36" id="signup-btn" href="signup">Sign Up</a>
                        <button class="bn3637 bn37" id="login-btn" type="submit">Login</button>
                    </div>
                    <div class="forgot">
                        <a href="/forgot-password">Forgot Password?</a>
                    </div>
                </form>                           
            </div>
        </div>
    </section>
    <script src="js/loginandsignup.js"></script>
</body>
</html>