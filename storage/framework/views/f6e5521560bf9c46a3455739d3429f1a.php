<!-- Button to trigger modal -->
<button id="viewPendingButton" class="custom-button">
    View Pending Accounts
</button>

<!-- Modal structure -->
<div id="pendingAccountsModal" class="modal">
    <div class="modal-content">
        <span class="close-button" id="closeModal">&times;</span>

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
                                        <img
                                            src="<?php echo e(asset('imgs/buttons/approve.png')); ?>"
                                            alt="Approve Button"
                                            width="35"
                                        />
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
                                        class="btn-view-reject"
                                        data-account-id="<?php echo e($pending->id); ?>"
                                    >
                                        <img
                                            src="<?php echo e(asset('imgs/buttons/reject.png')); ?>"
                                            alt="Approve Button"
                                            width="35"
                                        />
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_accounts/pending_inc.blade.php ENDPATH**/ ?>