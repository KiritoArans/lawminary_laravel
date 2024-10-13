<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Provide Feedback</title>
        <link rel="icon" href="../../imgs/lawminarylogo_v3.png" type="image/png" />
        <link
            rel="stylesheet"
            href="<?php echo e(asset('css/settings/provide_feedback_style.css')); ?>"
        />
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
                <content class="feedback-section">
                    <div class="feedback-form">

                        <form method="POST" action="<?php echo e(route('users.createFeedback')); ?>">
                            <?php echo csrf_field(); ?> 
                            <?php echo $__env->make('inclusions/response', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <label for="email">Email:</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="<?php echo e(Auth::user()->email); ?>"
                                required
                                readonly
                            />

                            <label for="feedback">Feedback:</label>
                            <textarea
                                id="feedback"
                                name="feedback"
                                rows="4"
                                required
                            ></textarea>

                            <button type="submit">Submit Feedback</button>
                        </form>

                    </div>
                </content>
            </main>
        </div>
        <script src="../js/settings.js"></script>
        <script src="../js/logout.js"></script>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/settings/provide_feedback.blade.php ENDPATH**/ ?>