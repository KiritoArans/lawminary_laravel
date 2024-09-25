<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Sign Up</title>
    <link rel="icon" href="../imgs/lawminarylogo.png" type="image/png">
    <link rel="stylesheet" href="<?php echo e(asset ('css/signup_style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset ('css/nav_style.css')); ?>">
    <?php echo $__env->make('inclusions/libraryLinks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
    <section>
        <div class="wrapper">
            <div class="container">
                <h1>Sign Up</h1>
                
                <form class="signup-form" method="post" action="<?php echo e(route('signup')); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('post'); ?>
                    <?php echo $__env->make('inclusions/response', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
                            <label for="nationality">Nationality</label>
                            <input type="text" id="nationality" name="nationality" value="<?php echo e(old('nationality')); ?>">
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
                                <option value="male" <?php echo e(old('sex') === 'male' ? 'selected' : ''); ?>>Male</option>
                                <option value="female" <?php echo e(old('sex') === 'female' ? 'selected' : ''); ?>>Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="contact-number">Contact Number</label>
                            <input type="tel" id="contact-number" name="contactNumber" value="<?php echo e(old('contactNumber')); ?>">
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
                        </div>                        
                        <div class="buttons">
                            <a href="login" class="back-home">Back to Login</a>
                            <button type="submit">Create Account</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="js/loginandsignup.js"></script>
</body>
</html><?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/users/signup.blade.php ENDPATH**/ ?>