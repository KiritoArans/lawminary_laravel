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
            href="<?php echo e(asset('css/admin/accountstyle.css')); ?>"
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
        <script src="<?php echo e(asset('js/library_js/sweetalertV2.js')); ?>"></script>
    </head>
    <body>
        <div class="container-fluid my-4">
            <aside>
                <?php echo $__env->make('includes_accounts.nav_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </aside>
            <main>
                <header>
                    <div class="header-top">
                        <?php echo $__env->make('includes_syscon.syscon_logo_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="spacer"></div>
                    </div>
                    <hr class="divider" />
                </header>
                <section class="filter-container">
                    <?php echo $__env->make('includes_accounts.search_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="action-buttons">
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
                                <!--filter accounts-->
                                <?php echo $__env->make('includes_accounts.filter_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                        <!-- add accounts -->
                        <?php echo $__env->make('includes_accounts.pending_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <button class="custom-button" id="addButton">
                            Add
                        </button>
                        <div id="addModal" class="modal">
                            <div class="modal-content">
                                <span class="close-button" id="closeAddModal">
                                    &times;
                                </span>
                                <h2>Add Account</h2>

                                <?php echo $__env->make('includes_accounts.add_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- display content on table -->
                <content class="table-container">
                    <?php echo $__env->make('includes_accounts.display_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </content>
            </main>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="<?php echo e(asset('js/admin_js/accounts_js.js')); ?>"></script>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/admin/account.blade.php ENDPATH**/ ?>