<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Posts</title>
        <link
            rel="icon"
            href="<?php echo e(asset('imgs/lawminarylogo.png')); ?>"
            type="image/png"
        />
        <link
            rel="stylesheet"
            href="<?php echo e(asset('css/admin/postpagestyle.css')); ?>"
        />
        <link rel="stylesheet" href="<?php echo e(asset('css/base_pagination.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('css/nav_burger.css')); ?>" />
        <link
            rel="stylesheet"
            href="<?php echo e(asset('css/admin/base_admin_table_style.css')); ?>"
        />
        <link
            rel="stylesheet"
            href="<?php echo e(asset('css/admin/base_admin_modal_style.css')); ?>"
        />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
            integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <link
            href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
            rel="stylesheet"
        />
        <script src="<?php echo e(asset('js/library_js/sweetalertV2.js')); ?>"></script>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
            rel="stylesheet"
        />
    </head>
    <body>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <header>
                    <div
                        class="header-top d-flex justify-content-between align-items-center"
                    >
                        <?php echo $__env->make('includes_accounts.nav_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('includes_syscon.syscon_logo_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <hr class="divider w-100" />
                </header>

                <!-- Main Content Area -->
                <main class="col-lg-8 col-md-10 col-sm-12">
                    <!-- Filter Container with Buttons -->
                    <div class="filter-container">
                        <!-- Search and Edit Function -->
                        <?php echo $__env->make('includes_postpage.post_search_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <div
                            class="action-buttons d-flex flex-wrap justify-content-between"
                        >
                            <!-- View Pending Post Button -->
                            <?php echo $__env->make('includes_postpage.post_pending_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <!-- Report Section -->
                            <?php echo $__env->make('includes_postpage.post_report_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            <!-- Pending Posts Modal -->
                            <div id="pendingPostsModal" class="modal">
                                <div class="modal-content">
                                    <span
                                        class="close-button"
                                        id="closePendingPostsModal"
                                    >
                                        &times;
                                    </span>
                                    <h2>Pending Posts</h2>
                                    <div id="pendingPostsContainer">
                                        <!-- Dynamic content will be added here -->
                                    </div>
                                </div>
                            </div>

                            <!-- Filter Button -->
                            <?php echo $__env->make('includes_postpage.post_filter_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>

                    <!-- Table Section -->
                    <div class="table-responsive">
                        <?php echo $__env->make('includes_postpage.post_table_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </main>
            </div>
        </div>

        <script src="<?php echo e(asset('js/admin_js/postpage_js.js')); ?>"></script>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/admin/postpage.blade.php ENDPATH**/ ?>