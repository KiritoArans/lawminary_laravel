<!-- resources/views/admin/dashboard.blade.php -->
<table class="table" id="dashboardTableBody">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Action</th>
            <th>Date</th>
            <th>View</th>
        </tr>
    </thead>
    <h1>Recent Activities</h1>
    <tbody>
        <?php $__currentLoopData = $dashboardData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($activity->act_id); ?></td>
                <td><?php echo e($activity->act_username); ?></td>
                <td><?php echo e($activity->act_action); ?></td>
                <td>
                    <?php echo e(\Carbon\Carbon::parse($activity->act_date)->format('Y-m-d')); ?>

                </td>
                <td>
                    <button
                        class="btn btn-view btn-sm"
                        data-id="<?php echo e($activity->id); ?>"
                    >
                        View
                    </button>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<ul class="pagination">
    <li
        class="page-item <?php echo e($dashboardData->currentPage() == 1 ? 'disabled' : ''); ?>"
        aria-disabled="<?php echo e($dashboardData->currentPage() == 1); ?>"
    >
        <a
            class="page-link"
            href="<?php echo e($dashboardData->appends(request()->input())->previousPageUrl()); ?>"
            rel="prev"
        >
            &laquo;
        </a>
    </li>

    <?php for($i = 1; $i <= $dashboardData->lastPage(); $i++): ?>
        <li
            class="page-item <?php echo e($dashboardData->currentPage() == $i ? 'active' : ''); ?>"
        >
            <a
                class="page-link"
                href="<?php echo e($dashboardData->appends(request()->input())->url($i)); ?>"
            >
                <?php echo e($i); ?>

            </a>
        </li>
    <?php endfor; ?>

    <li
        class="page-item <?php echo e($dashboardData->hasMorePages() ? '' : 'disabled'); ?>"
        aria-disabled="<?php echo e(! $dashboardData->hasMorePages()); ?>"
    >
        <a
            class="page-link"
            href="<?php echo e($dashboardData->appends(request()->input())->nextPageUrl()); ?>"
            rel="next"
        >
            &raquo;
        </a>
    </li>
</ul>

<!-- Modal Structure -->
<div id="viewModal" class="modal">
    <div class="modal-content">
        <span class="close-buttonView" id="closeModal">&times;</span>
        <h2>Activity Details</h2>
        <div id="modalContent">
            <!-- Dynamic content will be loaded here -->
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_dashboard/recent_act_inc.blade.php ENDPATH**/ ?>