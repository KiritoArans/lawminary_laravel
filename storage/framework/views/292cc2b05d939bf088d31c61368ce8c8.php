<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Forums</title>
        <link
            rel="icon"
            href="<?php echo e(asset('imgs/lawminarylogo.png')); ?>"
            type="image/png"
        />
        <link
            rel="stylesheet"
            href="<?php echo e(asset('css/admin/forumstyle.css')); ?>"
        />
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
        <!-- Include SweetAlert2 CDN -->
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
                        <div class="spacer"></div>
                    </div>
                    <hr class="divider" />
                </header>
                <section class="filter-container">
                    <?php echo $__env->make('includes_forums.forums_search_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="action-buttons">
                        <?php echo $__env->make('includes_forums.forums_filter_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('includes_forums.forums_add_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </section>
                <content class="table-container">
                    <?php echo $__env->make('includes_forums.forums_table_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div id="viewForumModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button" id="closeViewForumModal">
                                &times;
                            </span>
                            <h2>Forum Details</h2>
                            <p>
                                <strong>Forum ID:</strong>
                                <span id="viewForumId"></span>
                            </p>
                            <p>
                                <strong>Forum Name:</strong>
                                <span id="viewForumName"></span>
                            </p>
                            <p>
                                <strong>Forum Issue:</strong>
                                <span id="viewForumIssue"></span>
                            </p>
                            <p>
                                <strong>Forum Description:</strong>
                                <span id="viewForumDescription"></span>
                            </p>
                            <p>
                                <strong>Members Count:</strong>
                                <span id="viewMembersCount"></span>
                            </p>
                            <p>
                                <strong>Date Created:</strong>
                                <span id="viewDateCreated"></span>
                            </p>
                        </div>
                    </div>
                </content>
            </main>
        </div>
        <script src="<?php echo e(asset('js/admin_js/forums_js.js')); ?>"></script>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/admin/forums.blade.php ENDPATH**/ ?>