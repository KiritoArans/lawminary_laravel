<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | FAQs</title>
        <link
            rel="icon"
            href="<?php echo e(asset('imgs/lawminarylogo.png')); ?>"
            type="image/png"
        />
        <link
            rel="stylesheet"
            href="<?php echo e(asset('css/moderator/mfaqsstyle.css')); ?>"
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

                    <div class="search-bar">
                        <input type="text" placeholder="Search FAQs..." />
                        <div class="filter-btn">
                            <button id="filterButton" class="custom-button">
                                Filter
                            </button>
                        </div>
                    </div>
                </header>
                <content>
                    <h1>Frequently Asked Questions</h1>
                    <div class="container">
                        <?php if($faqs->isNotEmpty()): ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Question</th>
                                        <th>View Related Question/s</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyword => $questions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($keyword); ?></td>
                                            <td>
                                                <button
                                                    class="custom-button view-related"
                                                    data-questions="<?php echo e(json_encode($questions)); ?>"
                                                >
                                                    View
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                            <!-- Move Pagination Outside of the Table -->
                            <div class="paginationContent">
                                <ul class="pagination">
                                    <li
                                        class="page-item <?php echo e($faqs->currentPage() == 1 ? 'disabled' : ''); ?>"
                                    >
                                        <a
                                            class="page-link"
                                            href="<?php echo e($faqs->appends(request()->input())->previousPageUrl()); ?>"
                                            rel="prev"
                                        >
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                    </li>
                                    <?php for($i = 1; $i <= $faqs->lastPage(); $i++): ?>
                                        <li
                                            class="page-item <?php echo e($faqs->currentPage() == $i ? 'active' : ''); ?>"
                                        >
                                            <a
                                                class="page-link"
                                                href="<?php echo e($faqs->appends(request()->input())->url($i)); ?>"
                                            >
                                                <?php echo e($i); ?>

                                            </a>
                                        </li>
                                    <?php endfor; ?>

                                    <li
                                        class="page-item <?php echo e($faqs->hasMorePages() ? '' : 'disabled'); ?>"
                                    >
                                        <a
                                            class="page-link"
                                            href="<?php echo e($faqs->appends(request()->input())->nextPageUrl()); ?>"
                                            rel="next"
                                        >
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        <?php else: ?>
                            <p>No FAQs found.</p>
                        <?php endif; ?>
                    </div>

                    <!-- Modal remains unchanged -->
                    <div id="relatedFaqModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button">&times;</span>
                            <h2>Related Questions</h2>
                            <div id="relatedQuestionsContent">
                                <!-- Dynamic related questions will be loaded here -->
                            </div>
                        </div>
                    </div>
                </content>
            </main>
        </div>
        <script src="<?php echo e(asset('js/moderator_js/mfaqs_js.js')); ?>"></script>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/moderator/mfaqs.blade.php ENDPATH**/ ?>