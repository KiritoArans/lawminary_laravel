<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>User ID</th>
            <th>Rank</th>
            <th>Name</th>
            <th>Points</th>
            <th>Badge</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="postTableBody">
        <?php if($lawyers->isEmpty()): ?>
            <tr>
                <td colspan="7">No results found.</td>
            </tr>
        <?php else: ?>
            <?php $__currentLoopData = $lawyers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($activity->user_id); ?></td>
                    <td>
                        <?php echo e($loop->iteration + $lawyers->perPage() * ($lawyers->currentPage() - 1)); ?>

                    </td>
                    <td><?php echo e($activity->username); ?></td>
                    <td><?php echo e($activity->points); ?></td>
                    <td><?php echo e($activity->badge); ?></td>
                    <td>
                        <button
                            class="view-btn"
                            data-user_id="<?php echo e($activity->user_id); ?>"
                            data-rank="<?php echo e($loop->iteration); ?>"
                            data-username="<?php echo e($activity->username); ?>"
                            data-points="<?php echo e($activity->points); ?>"
                            data-badge="<?php echo e($activity->badge); ?>"
                        >
                            View
                        </button>
                        <?php echo $__env->make('includes_leaderboards.view_lead_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </tbody>
</table>

<div class="paginationContent">
    <ul class="pagination">
        <li
            class="page-item <?php echo e($lawyers->currentPage() == 1 ? 'disabled' : ''); ?>"
            aria-disabled="<?php echo e($lawyers->currentPage() == 1); ?>"
        >
            <a
                class="page-link"
                href="<?php echo e($lawyers->appends(request()->input())->previousPageUrl()); ?>"
                rel="prev"
            >
                &laquo;
            </a>
        </li>

        <?php for($i = 1; $i <= $lawyers->lastPage(); $i++): ?>
            <li
                class="page-item <?php echo e($lawyers->currentPage() == $i ? 'active' : ''); ?>"
            >
                <a
                    class="page-link"
                    href="<?php echo e($lawyers->appends(request()->input())->url($i)); ?>"
                >
                    <?php echo e($i); ?>

                </a>
            </li>
        <?php endfor; ?>

        <li
            class="page-item <?php echo e($lawyers->hasMorePages() ? '' : 'disabled'); ?>"
            aria-disabled="<?php echo e(! $lawyers->hasMorePages()); ?>"
        >
            <a
                class="page-link"
                href="<?php echo e($lawyers->appends(request()->input())->nextPageUrl()); ?>"
                rel="next"
            >
                &raquo;
            </a>
        </li>
    </ul>
</div>

<div id="viewModal" class="modal">
    <div class="modal-content">
        <span class="close-button" id="closeModal">&times;</span>
        <h2>Activity Details</h2>
        <div id="modalContent">
            <!-- Dynamic content will be loaded here -->
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_leaderboards/display_lead_inc.blade.php ENDPATH**/ ?>