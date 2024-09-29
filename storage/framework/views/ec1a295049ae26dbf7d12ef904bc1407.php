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
        <link rel="stylesheet" href="<?php echo e(asset('css/nav_style.css')); ?>" />
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
    </head>
    <body>
        <div class="container">
            <aside>
                <?php echo $__env->make('includes_accounts.nav_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </aside>
            <main>
                <header>
                    <div class="header-top">
                        <?php echo $__env->make('includes_syscon.syscon_logo_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <hr class="divider" />

                    <div class="header-line">
                        <div class="header-ttl">
                            <h1>Dashboard</h1>
                        </div>

                        <!-- Search Form -->
                        <div class="search-container">
                            <form
                                action="<?php echo e(route('admin.dashboard')); ?>"
                                method="GET"
                            >
                                <div class="input-group">
                                    <input
                                        type="text"
                                        name="search"
                                        class="form-control"
                                        placeholder="Search for activities"
                                        value="<?php echo e(request('search')); ?>"
                                    />
                                    <button
                                        class="btn btn-primary"
                                        type="submit"
                                    >
                                        Search
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Filter Button -->
                        <div class="filter-container">
                            <button class="custom-button" id="filterButton">
                                Filter
                            </button>
                            <div id="filterModal" class="modal">
                                <div class="modal-content">
                                    <span
                                        class="close-button"
                                        id="closeFilterModal"
                                    >
                                        &times;
                                    </span>
                                    <h2>Filter Accounts</h2>
                                    <?php echo $__env->make('includes_dashboard.dash_filter_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Close .header-line -->
                </header>
                <!-- Correctly close header tag -->

                <div class="content">
                    <div class="dash-content">
                        <div class="box-content">
                            <div class="boxes">
                                <?php echo $__env->make('includes_dashboard.pending_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <div class="container-table-2">
                                    <!-- recent activity table -->
                                    <?php echo $__env->make('includes_dashboard.recent_act_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                                <!-- Close .container-table-2 -->
                            </div>
                            <!-- Close .boxes -->
                        </div>
                        <!-- Close .box-content -->
                    </div>
                    <!-- Close .dash-content -->
                </div>
                <!-- Close .content -->
            </main>
            <!-- Close main -->

            <script src="<?php echo e(asset('js/admin_js/dashboard_js.js')); ?>"></script>
        </div>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>