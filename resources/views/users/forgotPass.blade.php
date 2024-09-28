<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lawminary | Forgot Password</title>
    <link rel="icon" href="../imgs/lawminarylogo.png" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/login_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav_style.css') }}">
    @include('inclusions/libraryLinks')
</head>
<body>
    <section>
        <div class="forgot-pass">
            <!-- Username and Email section -->
            <form id="forgotPassForm" class="forgot-pass-content">
                <h1>Forgot Password</h1>
                @if ($errors->has('loginError'))
                    <div class="error">
                        <span>{{ $errors->first('loginError') }}</span>
                    </div>
                @endif
                <label for="username">Username</label>
                <input type="text" id="usernameInput" required>
                <label for="email">Email</label>
                <input type="email" id="emailInput" required>
                <div class="btn">
                    <button id="backButton1" type="button">Back to Login</button>
                    <button id="nextButton" type="submit">Next</button>
                </div>
            </form>

            <!-- OTP Section -->
            <form id="otpForm" class="verify-otp" style="display: none;">
                <h1>Input One-Time Password</h1>
                <label for="otp">6 Digit OTP</label>
                <input type="text" id="otpInput" required>
                <div class="btn">
                    <button id="backButton2" type="button">Back</button>
                    <button id="submitOtpButton" type="submit">Submit</button>
                </div>
            </form>

            <!-- Password Reset Section -->
            <form id="newPassForm" class="new-pass" style="display: none;" action="/update-password" method="POST">
                @csrf
                <h1>Create New Password</h1>
                <label for="password">Password</label>
                <input type="password" name="password" required>
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" required>
                <div class="btn">
                    <button id="backButton3" type="button">Back</button>
                    <button type="submit" id="confirmButton">Confirm</button>
                </div>
            </form>
        </div>
    </section>
    <script src="{{ asset('js/forgotPass.js') }}"></script>
</body>
</html>
