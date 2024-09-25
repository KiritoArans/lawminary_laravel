<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Notifications</title>
    <link rel="icon" href="../imgs/lawminarylogo.png" type="image/png">
    <link rel="stylesheet" href="<?php echo e(asset ('css/notification_style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset ('css/nav_style.css')); ?>">
    <?php echo $__env->make('inclusions/libraryLinks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
    <div class="container">
        <?php echo $__env->make('inclusions/userNav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <main>
        <header>
            <div class="header-top">
                <img src="../imgs/Lawminary_Logo_2-Gold.png" alt="">
                <div class="notification">
                    <a href="notifications"><i class="fas fa-bell bell-icon current"></i></a>
                </div>
            </div>
            <hr class="divider">
        </header>
        <content>
            <h1>Notifications</h1>
            <div class="notifs">
                <div class="notifs-content">
                    <div class="user-info">
                        <img src="../imgs/user-img.png" alt="Profile Picture" class="profile-pic">
                        <div class="post-info">
                            <h2>Name Surname</h2>
                            <p>@username</p>
                        </div>
                    </div>
                    <div class="notifs-divider"></div>
                    <div class="notifs-action">
                        <span>Action your concern.</span>
                    </div>
                    <span class="notifs-date">00/00/00</span>
                </div>
            </div>
        </content>
    <script src="../js/settings.js"></script>    
    <script src="js/logout.js"></script>
</body>
</html><?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/users/notification.blade.php ENDPATH**/ ?>