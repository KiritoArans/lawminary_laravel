<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Lawminary is a law finder community based in the Philippines. Join now to access forums, posts, and a community of professionals.">
    <title>Lawminary | Login</title>
    <link rel="icon" href="../imgs/lawminarylogo_v3.png" type="image/png">
    <link rel="stylesheet" href="{{ asset ('css/login_style.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/nav_style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="{{ asset('js/library_js/sweetalertV2.js') }}"></script>
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