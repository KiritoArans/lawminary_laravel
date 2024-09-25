<div class="table-content">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>File</th>
                <th>Date Uploaded</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $resources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resource): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($resource->id); ?></td>
                    <td><?php echo e($resource->documentTitle); ?></td>
                    <td><?php echo e($resource->documentDesc); ?></td>
                    <td>
                        <a
                            href="<?php echo e(route('moderator.downloadResource', $resource->id)); ?>"
                        >
                            Download File
                        </a>
                    </td>
                    <td><?php echo e($resource->created_at->format('Y-m-d')); ?></td>
                    <td>
                        <!-- Include the edit button and modal here -->
                        <?php echo $__env->make('includes_resources.update_res_inc', ['resource' => $resource], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <form
                            method="POST"
                            action="<?php echo e(route('admin.deleteResource', $resource->id)); ?>"
                            onsubmit="return confirm('Are you sure you want to delete this resource?');"
                        >
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="custom-button">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6">No resources found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="paginationContent">
        <ul class="pagination">
            <!-- Previous Page Button -->
            <li
                class="page-item <?php echo e($resources->currentPage() == 1 ? 'disabled' : ''); ?>"
                aria-disabled="<?php echo e($resources->currentPage() == 1); ?>"
            >
                <a
                    class="page-link"
                    href="<?php echo e($resources->appends(request()->input())->previousPageUrl()); ?>"
                    rel="prev"
                >
                    <i class="fas fa-chevron-left"></i>
                    <!-- Left Arrow Icon -->
                </a>
            </li>

            <!-- Page Numbers -->
            <?php for($i = 1; $i <= $resources->lastPage(); $i++): ?>
                <li
                    class="page-item <?php echo e($resources->currentPage() == $i ? 'active' : ''); ?>"
                >
                    <a
                        class="page-link"
                        href="<?php echo e($resources->appends(request()->input())->url($i)); ?>"
                    >
                        <?php echo e($i); ?>

                    </a>
                </li>
            <?php endfor; ?>

            <!-- Next Page Button -->
            <li
                class="page-item <?php echo e($resources->hasMorePages() ? '' : 'disabled'); ?>"
                aria-disabled="<?php echo e(! $resources->hasMorePages()); ?>"
            >
                <a
                    class="page-link"
                    href="<?php echo e($resources->appends(request()->input())->nextPageUrl()); ?>"
                    rel="next"
                >
                    <i class="fas fa-chevron-right"></i>
                    <!-- Right Arrow Icon -->
                </a>
            </li>
        </ul>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_resources/display_res_inc.blade.php ENDPATH**/ ?>