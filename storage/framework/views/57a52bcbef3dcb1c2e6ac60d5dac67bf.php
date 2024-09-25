<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Post ID</th>
            <th>Concern</th>
            <th>Status</th>
            <th>Tags</th>
            <th>Posted By</th>
            <th>Updated By</th>
            <th>Reason for Rejection</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="postTableBody">
        <?php if($posts->isEmpty()): ?>
            <tr>
                <td colspan="7">No results found.</td>
            </tr>
        <?php else: ?>
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($activity->post_id); ?></td>
                    <td><?php echo e($activity->concern); ?></td>
                    <td><?php echo e($activity->status); ?></td>
                    <td><?php echo e($activity->tags); ?></td>
                    <td><?php echo e($activity->postedBy); ?></td>
                    <td><?php echo e($activity->approvedBy); ?></td>
                    <td><?php echo e($activity->reasonDisregard); ?></td>
                    <td>
                        <?php echo e(\Carbon\Carbon::parse($activity->updated_at)->format('Y-m-d')); ?>

                    </td>
                    <td>
                        <button
                            class="btn btn-warning editButton"
                            data-id="<?php echo e($activity->id); ?>"
                            data-concern="<?php echo e($activity->concern); ?>"
                            data-status="<?php echo e($activity->status); ?>"
                            data-tags="<?php echo e($activity->tags); ?>"
                            data-postedby="<?php echo e($activity->postedBy); ?>"
                            data-approvedby="<?php echo e($activity->approvedBy); ?>"
                        >
                            Edit
                        </button>
                        <?php echo $__env->make('includes_postpage.post_edit_inc', ['postDelete' => $activity], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </tbody>
</table>

<div class="paginationContent">
    <ul class="pagination">
        <li
            class="page-item <?php echo e($posts->currentPage() == 1 ? 'disabled' : ''); ?>"
            aria-disabled="<?php echo e($posts->currentPage() == 1); ?>"
        >
            <a
                class="page-link"
                href="<?php echo e($posts->appends(request()->input())->previousPageUrl()); ?>"
                rel="prev"
            >
                &laquo;
            </a>
        </li>

        <?php for($i = 1; $i <= $posts->lastPage(); $i++): ?>
            <li
                class="page-item <?php echo e($posts->currentPage() == $i ? 'active' : ''); ?>"
            >
                <a
                    class="page-link"
                    href="<?php echo e($posts->appends(request()->input())->url($i)); ?>"
                >
                    <?php echo e($i); ?>

                </a>
            </li>
        <?php endfor; ?>

        <li
            class="page-item <?php echo e($posts->hasMorePages() ? '' : 'disabled'); ?>"
            aria-disabled="<?php echo e(! $posts->hasMorePages()); ?>"
        >
            <a
                class="page-link"
                href="<?php echo e($posts->appends(request()->input())->nextPageUrl()); ?>"
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
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_postpage/post_table_inc.blade.php ENDPATH**/ ?>