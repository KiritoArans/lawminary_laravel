<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Admin</title>
        <link
            rel="icon"
            href="<?php echo e(asset('imgs/lawminarylogo.png')); ?>"
            type="image/png"
        />
        <link
            rel="stylesheet"
            href="<?php echo e(asset('css/admin/dashboardstyle.css')); ?>"
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
            rel="stylesheet"
        />
    </head>
    <body>
        <div class="container-fluid dashboard-content-wrapper">
            <!-- Header Section -->
            <header class="row">
                <div class="col-12 header-top">
                    <?php echo $__env->make('includes_syscon.syscon_logo_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php echo $__env->make('includes_accounts.nav_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <hr class="divider w-100" />
                <div class="col-12 header-line">
                    <h1 class="text-center">Dashboard</h1>
                    <!-- Centered heading below the logo -->
                </div>
            </header>
            <!-- Main Content Section -->
            <main class="col-lg-8 col-md-10 col-sm-12">
                <!-- Dashboard Cards and Chart -->
                <div class="col-12 dashboard-cards">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <?php echo $__env->make('includes_dashboard.pending_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>

                <!-- Chart Section -->
                <?php echo $__env->make('includes_dashboard.recent_act_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </main>
        </div>

        <!-- Close main -->

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-3d"></script>
        <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment@1.0.0"></script>
        <script src="<?php echo e(asset('js/admin_js/dashboard_js.js')); ?>"></script>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>