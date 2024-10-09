<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lawminary | Forgot Password</title>
    <link rel="icon" href="../imgs/lawminarylogo_v3.png" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/login_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav_style.css') }}">
    @include('inclusions/libraryLinks')
</head>
<body>
    <section>
        <div class="forgot-pass">
            
            <form id="forgotPassForm" class="forgot-pass-content">
                <h1>Forgot Password</h1>
                @if ($errors->has('loginError'))
                    <div class="error">
                        <span>{{ $errors->first('loginError') }}</span>
                    </div>
                @endif
                <label for="username">Username</label>
                <input type="text" id="usernameInput" placeholder="Type your username" required>
                <label for="email">Email</label>
                <input type="email" id="emailInput" placeholder="Type your email" required>
                <div class="btn">
                    <button id="backButton1" type="button">Back to Login</button>
                    <button id="nextButton" type="submit">Next</button>
                </div>
            </form>

            <form id="otpForm" class="verify-otp" style="display: none;">
                <h1>Input One-Time Password</h1>
                <div class="otp-input">
                    <label for="otpInput">6-Digit OTP</label>
                    <div>
                        <input type="text" class="otpInput" maxlength="1" required>
                        <input type="text" class="otpInput" maxlength="1" required>
                        <input type="text" class="otpInput" maxlength="1" required>
                        <input type="text" class="otpInput" maxlength="1" required>
                        <input type="text" class="otpInput" maxlength="1" required>
                        <input type="text" class="otpInput" maxlength="1" required>
                    </div>
                </div>
                <div class="btn">
                    <button id="backButton2" type="button">Back</button>
                    <button id="submitOtpButton" type="submit">Submit</button>
                </div>
                <div class="btn2">
                    <label for="">Haven't received it yet?</label>
                    <a id="resendOtpButton" type="button">Resend OTP</a>
                </div>
            </form>
            

            <form id="newPassForm" class="new-pass" style="display: none;" action="/update-password" method="POST">
                @csrf
                <h1>Create New Password</h1>
                <label for="password">Password</label>
                <div>
                    <input type="password" name="password" required placeholder="Type new password" id="newPassword">
                    <i class="fas fa-eye toggle-password" id="toggleNewPassword"></i>
                </div>

                <label for="password_confirmation">Confirm Password</label>
                <div>
                    <input type="password" name="password_confirmation" required placeholder="Confirm new password" id="newPasswordConfirmation">
                    <i class="fas fa-eye toggle-password" id="toggleNewPasswordConfirmation"></i>
                </div>

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
