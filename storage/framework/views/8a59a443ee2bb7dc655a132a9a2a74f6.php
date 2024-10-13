<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Login</title>
    <link rel="icon" href="../imgs/lawminarylogo_v3.png" type="image/png">
    <link rel="stylesheet" href="<?php echo e(asset ('css/login_style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset ('css/nav_style.css')); ?>">
    <?php echo $__env->make('inclusions/libraryLinks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
    <section>
        <div class="wrapper">
            <div class="logo-content">
                <img src="../imgs/lawminarylogo.png" alt="Lawminary Logo">
            </div>
            <div class="line"></div>
            <div class="login-content">
                <form action="<?php echo e(route('login')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <h1>Login</h1>
                    <?php if($errors->has('loginError')): ?>
                        <div class="error">
                            <span><?php echo e($errors->first('loginError')); ?></span>
                        </div>
                    <?php endif; ?>
                    <div class="username">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Type your username" value="<?php echo e(old('username')); ?>" required>
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
</html><?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/users/login.blade.php ENDPATH**/ ?>