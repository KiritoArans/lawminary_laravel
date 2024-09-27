<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Forgot Password</title>
    <link rel="icon" href="../imgs/lawminarylogo.png" type="image/png">
    <link rel="stylesheet" href="{{ asset ('css/login_style.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/nav_style.css') }}">
    @include('inclusions/libraryLinks')
</head>
<body>
    <section>
        <div class="forgot-pass">
            <div class="forgot-pass-content">
                <h1>Forgot Password</h1>
                <label for="">Username</label>
                <input type="text">
                <label for="">Email</label>
                <input type="text">
                <div class="btn">
                    <button id="backButton1">Back to Login</button>
                    <button id="nextButton">Next</button>
                </div>
            </div>
            <div class="verify-otp" style="display: none;">
                <h1>Input One-Time Password</h1>
                <label for="">6 Digit OTP</label>
                <input type="text">
                <div class="btn">
                    <button id="backButton2">Back</button>
                    <button id="sumbitButton">Submit</button>     
                </div>
            </div>
            <div class="new-pass" style="display: none;">
                <h1>Create New Password</h1>
                <label for="">Password</label>
                <input type="text">
                <label for="">Confirm Password</label>
                <input type="text">             
                <div class="btn">
                    <button id="backButton3">Back</button>
                    <button id="confirmButton">Confirm</button>   
                </div>
            </div>
        </div>
        
    </section>
    <script src="js/forgotPass.js"></script>
</body>
</html>