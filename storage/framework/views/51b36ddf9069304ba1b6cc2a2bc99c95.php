<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Resources</title>
        <link
            rel="icon"
            href="<?php echo e(asset('imgs/lawminarylogo.png')); ?>"
            type="image/png"
        />
        <link
            rel="stylesheet"
            href="<?php echo e(asset('css/moderator/mrecourcesstyle.css')); ?>"
        />

        <link rel="stylesheet" href="<?php echo e(asset('css/base_pagination.css')); ?>" />

        <link rel="stylesheet" href="<?php echo e(asset('css/nav_style.css')); ?>" />
        <link
            rel="stylesheet"
            href="<?php echo e(asset('css/moderator/base_moderator_table_style.css')); ?>"
        />
        <link
            rel="stylesheet"
            href="<?php echo e(asset('css/moderator/base_moderator_modal_style.css')); ?>"
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
        <div class="container">
            <aside>
                <?php echo $__env->make('includes_accounts.mod_nav_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </aside>
            <main>
                <header>
                    <div class="header-top">
                        <?php echo $__env->make('includes_syscon.syscon_logo_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <hr class="divider" />
                    <div class="filter-container">
                        <?php echo $__env->make('includes_resources.search_res_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <div class="add-container">
                        <div class="filter-btn">
                            <button id="filterButton">Filter</button>
                        </div>
                        <div id="filterModal" class="modal">
                            <div class="modal-content">
                                <span class="close-button">&times;</span>
                                <h2>Filter Resources</h2>
                                <?php echo $__env->make('includes_resources.filter_res_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                        <button class="custom-button" id="addButton">
                            Add
                        </button>
                    </div>
                    <div id="addModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button">&times;</span>
                            <h2>Add Resource</h2>
                            <div class="error">
                                <?php if($errors->any()): ?>
                                    <ul>
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                            <?php echo $__env->make('includes_resources.add_res_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>
                </header>
                <content>
                    <?php echo $__env->make('includes_resources.display_res_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div id="viewModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button" id="closeButton">
                                &times;
                            </span>
                            <h2>View Resource</h2>
                            <div class="error"></div>
                        </div>
                    </div>
                </content>
            </main>
        </div>
        <script src="<?php echo e(asset('js/moderator_js/mresources_js.js')); ?>"></script>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/moderator/resources.blade.php ENDPATH**/ ?>