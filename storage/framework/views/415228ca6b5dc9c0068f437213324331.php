<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Resources</title>
        <link rel="icon" href="../imgs/lawminarylogo_v3.png" type="image/png" />
        <link rel="stylesheet" href="<?php echo e(asset('css/resources_style.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('css/base_pagination.css')); ?>" />
        <link
            rel="stylesheet"
            href="<?php echo e(asset('css/moderator/base_moderator_table_style.css')); ?>"
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
                            <a href="notifications">
                                <i class="fas fa-bell bell-icon"></i>
                            </a>
                        </div>
                    </div>
                    <hr class="divider" />
                </header>

                <div class="container">
                    <div class="header-buttons-search">
                        <div class="header-buttons">
                            <!-- Search Form -->
                            <form
                                method="GET"
                                action="<?php echo e(route('user.resources')); ?>"
                                class="search-bar"
                            >
                                <input
                                    type="text"
                                    name="search"
                                    placeholder="Search resources..."
                                    value="<?php echo e(request()->query('search')); ?>"
                                />
                                <button type="submit">Search</button>
                            </form>
                        </div>
                    </div>

                    <!-- Resources Table -->
                    <table class="resources-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>File</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($resources->count() > 0): ?>
                                <?php $__currentLoopData = $resources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resource): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($resource->title); ?></td>
                                        <td><?php echo e($resource->description); ?></td>
                                        <td>
                                            <a
                                                href="<?php echo e(route('moderator.downloadResource', $resource->id)); ?>"
                                                class="btn-download"
                                            >
                                                Download
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center">
                                        No resources found
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="paginationContent">
                        <ul class="pagination">
                            <!-- Previous Page Button -->
                            <li
                                class="page-item <?php echo e($resources->currentPage() == 1 ? 'disabled' : ''); ?>"
                            >
                                <a
                                    href="<?php echo e($resources->appends(request()->input())->previousPageUrl()); ?>"
                                    rel="prev"
                                >
                                    &lt;
                                </a>
                            </li>

                            <!-- Page Numbers -->
                            <?php for($i = 1; $i <= $resources->lastPage(); $i++): ?>
                                <li
                                    class="page-item <?php echo e($resources->currentPage() == $i ? 'active' : ''); ?>"
                                >
                                    <a
                                        href="<?php echo e($resources->appends(request()->input())->url($i)); ?>"
                                    >
                                        <?php echo e($i); ?>

                                    </a>
                                </li>
                            <?php endfor; ?>

                            <!-- Next Page Button -->
                            <li
                                class="page-item <?php echo e($resources->hasMorePages() ? '' : 'disabled'); ?>"
                            >
                                <a
                                    href="<?php echo e($resources->appends(request()->input())->nextPageUrl()); ?>"
                                    rel="next"
                                >
                                    &gt;
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </main>
        </div>
        <script src="../js/settings.js"></script>
        <script src="js/logout.js"></script>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/users/resources.blade.php ENDPATH**/ ?>