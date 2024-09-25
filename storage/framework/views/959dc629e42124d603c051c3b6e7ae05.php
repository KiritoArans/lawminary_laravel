<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | About Lawminary</title>
        <link rel="icon" href="../../imgs/lawminarylogo.png" type="image/png" />
        <link rel="stylesheet" href="<?php echo e(asset('css/about_style.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('css/nav_style.css')); ?>" />
        <?php echo $__env->make('inclusions/libraryLinks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </head>
    <body>
        <div class="container">
            <?php echo $__env->make('inclusions/userNav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <main>
                <header>
                    <div class="header-top">
                        <?php echo $__env->make('includes_syscon.syscon_logo_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="notification">
                            <a href="../notifications">
                                <i class="fas fa-bell bell-icon"></i>
                            </a>
                        </div>
                    </div>
                    <hr class="divider" />
                </header>
                <content class="about-content">
                    <?php echo $__env->make('includes_syscon.about_lawminary_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </content>
            </main>
        </div>
        <script src="../js/settings.js"></script>
        <script src="../js/logout.js"></script>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/settings/about_lawminary.blade.php ENDPATH**/ ?>