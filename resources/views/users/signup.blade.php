<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lawminary | Sign Up</title>
    <link rel="icon" href="../imgs/lawminarylogo.png" type="image/png">
    <link rel="stylesheet" href="{{ asset ('css/signup_style.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/nav_style.css') }}">
    @include('inclusions/libraryLinks')
</head>
<body>
    <section>
        <div class="wrapper">
            <div class="container">
                <h1>Sign Up</h1>
                {{-- <div class="error">
                    @if($errors->any())
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
                </div> --}}

                <form class="signup-form" method="post" action="{{route('signup')}}">
                    @csrf
                    @method('post')
                    @include('inclusions/response')
                    <div class="left-column">
                        <div class="form-group">
                            <label for="first-name">First Name</label>
                            <input type="text" id="first-name" name="firstName" value="{{ old('firstName') }}">
                        </div>
                        <div class="form-group">
                            <label for="last-name">Last Name</label>
                            <input type="text" id="last-name" name="lastName" value="{{ old('lastName') }}">
                        </div>
                        <div class="form-group">
                            <label for="nationality">Nationality</label>
                            <input type="text" id="nationality" name="nationality" value="{{ old('nationality') }}">
                        </div>
                        <div class="form-group">
                            <label for="email-address">Email Address</label>
                            <input type="email" id="email-address" name="email" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="middle-column">
                        <div class="form-group">
                            <label for="middle-name">Middle Name <span>(Optional)</span></label>
                            <input type="text" id="middle-name" name="middleName" value="{{ old('middleName') }}">
                        </div>
                        <div class="form-group">
                            <label for="birth-date">Birth Date</label>
                            <input type="date" id="birth-date" name="birthDate" value="{{ old('birthDate') }}">
                        </div>
                        <div class="form-group">
                            <label for="sex">Sex</label>
                            <select name="sex" id="" value="{{ old('sex') }}">
                                <option value="" disabled {{ old('sex') === null ? 'selected' : '' }}>Option</option>
                                <option value="male" {{ old('sex') === 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('sex') === 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="contact-number">Contact Number</label>
                            <input type="tel" id="contact-number" name="contactNumber" value="{{ old('contactNumber') }}">
                        </div>
                    </div>
                    <div class="line"></div>
                    <div class="right-column">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" value="{{ old('username') }}">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="password-container">
                                <input type="password" id="password" name="password" required>
                                <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <div class="password-container">
                                <input type="password" id="password_confirmation" name="password_confirmation" required>
                                <i class="fas fa-eye toggle-password" id="togglePasswordConfirmation"></i>
                            </div>
                        </div>                        
                        <div class="buttons">
                            <a href="login" class="back-home">Back to Login</a>
                            <button type="submit">Create Account</button>
                        </div>
                    </div>
                </form>

                <!-- OTP Modal -->
<div id="otpModal" class="modal" style="display: flex;">
    <div class="modal-content">
        <h2>Enter Your OTP</h2>
        <label for="otpInput">6-Digit OTP</label>
        <input type="text" id="otpInput" maxlength="6" required>

        <div class="modal-buttons">
            <button id="resendOtpButton">Resend OTP</button>
            <button id="verifyOtpButton">Verify OTP</button>
        </div>

        <div id="otpError" class="error-message" style="display: none; color: red;"></div>
    </div>
</div>

<style>
    /* Add some basic styling for the modal */
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .modal-content {
        background: white;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        max-width: 400px;
        width: 100%;
    }
    .modal-buttons button {
        margin: 10px;
    }
</style>


            </div>
        </div>
    </section>
    <script src="js/loginandsignup.js"></script>
</body>
</html>