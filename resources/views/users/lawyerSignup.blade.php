<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Lawminary is a law finder community based in the Philippines. Join now to access forums, posts, and a community of professionals.">
    <title>Lawminary | Lawyer Sign Up</title>
    <link rel="icon" href="../imgs/lawminarylogo_v3.png" type="image/png">
    <link rel="stylesheet" href="{{ asset ('css/signup_style.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/nav_style.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<script src="{{ asset('js/library_js/sweetalertV2.js') }}"></script>
</head>
<body>
    <section>
        <div class="wrapper">
            <div class="container">
                <h1>Lawyer Sign Up</h1>
                
                <div class="signup-content">
                    <form class="signup-form">
                        <input type="text" id="accountType" name="accountType" value="Lawyer" hidden>
                        <input type="text" id="userPhoto" name="userPhoto" value="public/files/profile_pics/user-img.png" hidden>
                        <input type="text" id="status" name="status" value="Pending" hidden>
                        <div class="left-column">
                            <div class="form-group">
                                <label for="first-name">First Name <span id="reqField">*</span></label>
                                <input type="text" id="first-name" name="firstName" value="{{ old('firstName') }}">
                            </div>
                            <div class="form-group">
                                <label for="middle-name">Middle Name <span>(Optional)</span></label>
                                <input type="text" id="middle-name" name="middleName" value="{{ old('middleName') }}">
                            </div>
                            <div class="form-group">
                                <label for="last-name">Last Name <span id="reqField">*</span></label>
                                <input type="text" id="last-name" name="lastName" value="{{ old('lastName') }}">
                            </div>
                            <div class="form-group">
                                <label for="sex">Sex <span id="reqField">*</span></label>
                                <select name="sex" id="" value="{{ old('sex') }}">
                                    <option value="" disabled {{ old('sex') === null ? 'selected' : '' }}>Option</option>
                                    <option value="Male" {{ old('sex') === 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('sex') === 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="middle-column">
                            <div class="form-group">
                                <label for="birth-date">Birth Date <span id="reqField">*</span></label>
                                <input type="date" id="birth-date" name="birthDate" value="{{ old('birthDate') }}">
                            </div>
                            <div class="form-group">
                                <label for="email-address">Email Address <span id="reqField">*</span></label>
                                <input type="email" id="email-address" name="email" value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <label for="lawyerID">Roll ID <span>(Optional)</span></label>
                                <input type="lawyerID" id="lawyerID" name="lawyerID" value="{{ old('lawyerID') }}" maxlength="10">
                            </div>
                            <div class="form-group">
                                <label for="fieldExpertise">Field Expertise <span id="reqField">*</span></label>
                                <select id="fieldExpertise" name="fieldExpertise">
                                    <option value="">Select Expertise</option>
                                </select>                                
                            </div>
                        </div>

                        <div class="line"></div>

                        <div class="right-column">
                            <div class="form-group">
                                <label for="username">Username <span id="reqField">*</span></label>
                                <input type="text" id="username" name="username" value="{{ old('username') }}" maxlength="15">
                            </div>
                            <div class="form-group">
                                <label for="password">Password <span id="reqField">*</span></label>
                                <div class="password-container">
                                    <input type="password" id="password" name="password" required>
                                    <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password <span id="reqField">*</span></label>
                                <div class="password-container">
                                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                                    <i class="fas fa-eye toggle-password" id="togglePasswordConfirmation"></i>
                                </div>
                                <div class="user-agreement">
                                    <div class="terms">
                                        <label for="agreeTerms" id="terms-label">
                                            I agree to the <a id="openAgreementModal">User Agreement</a>
                                        </label>
                                        <input type="checkbox" id="agreeTerms" name="agreeTerms">
                                    </div>
                                </div>
                                <div class="buttons">
                                    <a href="login" class="back-home">
                                        Back to Login
                                    </a>
                                    <button id="create-btn">
                                        Create Account
                                    </button>
                                </div>
                            </div>
                    </form>
                        </div>

                    <div class="otp-section" style="display: none">
                        <h2>Enter Your OTP</h2>
                        <div class="otp-input">
                            <label for="otpInput">6-Digit OTP</label>
                            <div>
                                <input
                                    type="text" class="otpInput" maxlength="1" required/>
                                <input
                                    type="text" class="otpInput" maxlength="1" required/>
                                <input
                                    type="text" class="otpInput" maxlength="1" required/>
                                <input
                                    type="text" class="otpInput" maxlength="1" required/>
                                <input
                                    type="text" class="otpInput" maxlength="1" required/>
                                <input
                                    type="text" class="otpInput" maxlength="1" required/>
                            </div>
                        </div>

                        <div class="btn">
                            <button id="back-btn">Back</button>
                            <button id="verifyOtpButton">Verify OTP</button>
                        </div>
                        <div class="btn2">
                            <label for="">Haven't recieved yet?</label>
                            <a id="resendOtpButton" type="button">Resend OTP</a>
                        </div>
                    </div>
                </div>
            </div>
            
            @include('inclusions/agreementModal')

        </section>
        <script src="js/openAgreementModal.js"></script>
        <script src="js/lawyerLoginSignup.js"></script>
    </body>
</html>
