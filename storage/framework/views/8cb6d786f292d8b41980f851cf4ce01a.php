<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Search</title>
        <link rel="icon" href="../imgs/lawminarylogo.png" type="image/png" />
        <link rel="stylesheet" href="<?php echo e(asset('css/search_style.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('css/nav_style.css')); ?>" />
        <?php echo $__env->make('inclusions/libraryLinks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </head>
    <body>
        <div class="container">
            <!-- Include navigation bar for users -->
            <?php echo $__env->make('inclusions/userNav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <main>
                <!-- Header section -->
                <header>
                    <div class="header-top">
                        <?php echo $__env->make('includes_syscon.syscon_logo_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="notification">
                            <a href="notifications">
                                <i class="fas fa-bell bell-icon"></i>
                            </a>
                        </div>
                    </div>
                    <hr class="divider" />
                </header>

                <!-- Main content area -->
                <section class="content-area">
                    <div class="concern-title">
                        <h1>Raise Your Concern</h1>
                        <h3>Get an immediate response to your query.</h3>
                    </div>
                    <div class="concern-area">
                        <!-- Form for submitting concern -->
                        <form
                            action="<?php echo e(route('find.charges')); ?>"
                            method="POST"
                        >
                            <?php echo csrf_field(); ?>
                            <div class="concern-input">
                                <textarea
                                    name="user_concern"
                                    id="user_concern"
                                    placeholder="Type your concern here..."
                                    required
                                ></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="custom-button">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                    <p>
                        <strong>Disclaimer:</strong>
                        <br />
                        The possible charges listed are based on the information
                        you provided and are for reference purposes only. They
                        do not constitute legal advice or a final determination
                        of your case. For accurate legal consultation and
                        representation, please consult with a qualified
                        attorney. The charges shown may not cover all aspects of
                        the law and may not apply in every scenario.
                    </p>
                    <!-- Possible charges section -->
                    <div class="charges">
                        <div class="charges-content">
                            <div class="charges-header">
                                <h1>Possible Charges</h1>
                                <hr />
                            </div>

                            <!-- Display possible charges -->
                            <?php if(isset($possibleCharges) && count($possibleCharges) > 0): ?>
                                <?php $__currentLoopData = $possibleCharges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $charge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="charges-info">
                                        <div class="possible-charges">
                                            <h2>
                                                <?php echo e($charge->article_name); ?>

                                            </h2>
                                            <p><?php echo e($charge->description); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <p>
                                    No possible charges found for your concern.
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/users/search.blade.php ENDPATH**/ ?>