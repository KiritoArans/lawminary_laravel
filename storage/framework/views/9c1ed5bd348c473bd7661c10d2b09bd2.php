<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Lawminary | Sign Up</title>
    <link rel="icon" href="../imgs/lawminarylogo_v3.png" type="image/png">
    <link rel="stylesheet" href="<?php echo e(asset ('css/signup_style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset ('css/nav_style.css')); ?>">
    <?php echo $__env->make('inclusions/libraryLinks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
    <section>
        <div class="wrapper">
            <div class="container">
                <h1>Sign Up</h1>
                
                <div class="signup-content">
                    <form class="signup-form">

                        <div class="left-column">
                            <div class="form-group">
                                <label for="first-name">First Name</label>
                                <input type="text" id="first-name" name="firstName" value="<?php echo e(old('firstName')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="last-name">Last Name</label>
                                <input type="text" id="last-name" name="lastName" value="<?php echo e(old('lastName')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="nationality" class="form-group">
                                    Nationality:
                                </label>
                                <select
                                    id="nationality"
                                    name="nationality"
                                    required
                                >
                                    <option value="">
                                        Select Nationality
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email-address">Email Address</label>
                                <input type="email" id="email-address" name="email" value="<?php echo e(old('email')); ?>">
                            </div>
                        </div>
                        <div class="middle-column">
                            <div class="form-group">
                                <label for="middle-name">Middle Name <span>(Optional)</span></label>
                                <input type="text" id="middle-name" name="middleName" value="<?php echo e(old('middleName')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="birth-date">Birth Date</label>
                                <input type="date" id="birth-date" name="birthDate" value="<?php echo e(old('birthDate')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="sex">Sex</label>
                                <select name="sex" id="" value="<?php echo e(old('sex')); ?>">
                                    <option value="" disabled <?php echo e(old('sex') === null ? 'selected' : ''); ?>>Option</option>
                                    <option value="Male" <?php echo e(old('sex') === 'Male' ? 'selected' : ''); ?>>Male</option>
                                    <option value="Female" <?php echo e(old('sex') === 'Female' ? 'selected' : ''); ?>>Female</option>
                                    <option value="Other" <?php echo e(old('sex') === 'Other' ? 'selected' : ''); ?>>Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="contact-number">Contact Number</label>
                                <div class="contact-number-wrapper">
                                    <span class="country-code">+63</span>
                                    <input
                                        type="tel"
                                        id="contactNumber"
                                        name="contactNumber"
                                        maxlength="10"
                                        value="<?php echo e(old('contactNumber')); ?>"
                                        placeholder="Enter phone number"
                                        pattern="[0-9]{10}"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="line"></div>
                        <div class="right-column">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" value="<?php echo e(old('username')); ?>">
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
        </section>
        <script src="js/loginandsignup.js"></script>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/users/signup.blade.php ENDPATH**/ ?>