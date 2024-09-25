<!-- Button to trigger modal -->
<button id="viewPendingButton" class="custom-button">
    View Pending Accounts
</button>

<!-- Modal structure -->
<div id="pendingAccountsModal" class="modal">
    <div class="modal-content">
        <span class="close-button" id="closeModal">&times;</span>
        <h2>Pending Accounts</h2>

        <!-- Pending Accounts Table -->
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Account ID</th>
                    <th>Username</th>
                    <th>LN, FN, MI</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $pendingAcc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pending): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('inclusions.response', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <tr>
                        <td><?php echo e($pending->id); ?></td>
                        <td><?php echo e($pending->username); ?></td>
                        <td>
                            <?php echo e($pending->lastName . ', ' . $pending->firstName . ', ' . $pending->middleName); ?>

                        </td>
                        <td><?php echo e($pending->email); ?></td>
                        <td><?php echo e($pending->status); ?></td>
                        <td><?php echo e($pending->created_at); ?></td>
                        <td>
                            <div class="action-cell">
                                <!-- Approve Form -->
                                <form
                                    action="<?php echo e(route('admin.approveAccount', $pending->id)); ?>"
                                    method="POST"
                                    style="display: inline-block"
                                >
                                    <?php echo csrf_field(); ?>
                                    <button
                                        type="submit"
                                        name="approve"
                                        class="btn-view-approve"
                                    >
                                        Approve
                                    </button>
                                </form>

                                <!-- Delete Form -->
                                <form
                                    id="delete-form-<?php echo e($pending->id); ?>"
                                    method="POST"
                                    style="display: inline"
                                    action="<?php echo e(request()->is('moderator*') ? route('moderator.destroyAccount', $pending->id) : route('admin.destroyAccount', $pending->id)); ?>"
                                >
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <?php echo $__env->make('inclusions.response', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <button
                                        type="button"
                                        class="delete-button"
                                        data-account-id="<?php echo e($pending->id); ?>"
                                    >
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <!-- Pagination inside the modal -->
        <div class="paginationContent">
            <ul class="pagination">
                <li
                    class="page-item <?php echo e($pendingAcc->currentPage() == 1 ? 'disabled' : ''); ?>"
                    aria-disabled="<?php echo e($pendingAcc->currentPage() == 1); ?>"
                >
                    <a
                        class="page-link"
                        href="<?php echo e($pendingAcc->appends(request()->input())->previousPageUrl()); ?>&modal=true"
                        rel="prev"
                    >
                        &laquo;
                    </a>
                </li>

                <?php for($i = 1; $i <= $pendingAcc->lastPage(); $i++): ?>
                    <li
                        class="page-item <?php echo e($pendingAcc->currentPage() == $i ? 'active' : ''); ?>"
                    >
                        <a
                            class="page-link"
                            href="<?php echo e($pendingAcc->appends(request()->input())->url($i)); ?>&modal=true"
                        >
                            <?php echo e($i); ?>

                        </a>
                    </li>
                <?php endfor; ?>

                <li
                    class="page-item <?php echo e($pendingAcc->hasMorePages() ? '' : 'disabled'); ?>"
                    aria-disabled="<?php echo e(! $pendingAcc->hasMorePages()); ?>"
                >
                    <a
                        class="page-link"
                        href="<?php echo e($pendingAcc->appends(request()->input())->nextPageUrl()); ?>&modal=true"
                        rel="next"
                    >
                        &raquo;
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_accounts/pending_inc.blade.php ENDPATH**/ ?>