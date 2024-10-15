<!-- Button to trigger modal -->
<button id="viewPendingButton" class="custom-button">View Pending Posts</button>

<!-- Modal structure -->
<div id="pendingPostsModal" class="modal">
    <div class="modal-content">
        <span class="close-button" id="closeModal">&times;</span>

        <!-- Your Pending Posts Table goes here -->
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Post ID</th>
                    <th>Content</th>
                    <th>Tags</th>
                    <th>Posted By</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $pendingPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('inclusions.response', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <tr>
                        <td><?php echo e($post->post_id); ?></td>
                        <td><?php echo e($post->concern); ?></td>
                        <td><?php echo e($post->tags); ?></td>
                        <td><?php echo e($post->postedBy); ?></td>
                        <td>
                            <?php echo e(\Carbon\Carbon::parse($post->updated_at)->format('Y-m-d')); ?>

                        </td>
                        <td>
                            <div class="action-cell">
                                <!-- Approve Form -->
                                <form
                                    action="<?php echo e(request()->is('admin*') ? route('admin.postpage') : route('moderator.postpage')); ?>"
                                    method="POST"
                                    style="display: inline-block"
                                >
                                    <?php echo csrf_field(); ?>
                                    <input
                                        type="hidden"
                                        name="post_id"
                                        value="<?php echo e($post->post_id); ?>"
                                    />
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

                                <!-- Disregard Form -->
                                <form
                                    action="<?php echo e(request()->is('admin*') ? route('admin.postpage') : route('moderator.postpage')); ?>"
                                    method="POST"
                                    style="display: inline-block"
                                >
                                    <?php echo csrf_field(); ?>
                                    <input
                                        type="hidden"
                                        name="post_id"
                                        value="<?php echo e($post->post_id); ?>"
                                    />
                                    <?php echo $__env->make('includes_postpage.post_reject_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_postpage/post_pending_inc.blade.php ENDPATH**/ ?>