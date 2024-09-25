<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Forums</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Forum ID</th>
                    <th>Forum Name</th>
                    <th>Forum Description</th>
                    <th>Members Count</th>
                    <th>Date Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $forums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $forum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($forum->id); ?></td>
                        <td><?php echo e($forum->forum_name); ?></td>
                        <td><?php echo e($forum->forum_desc); ?></td>
                        <td><?php echo e($forum->mem_count); ?></td>
                        <td><?php echo e($forum->created_at); ?></td>
                        <td>
                            <button
                                class="btn btn-primary editButton"
                                data-id="<?php echo e($forum->id); ?>"
                                data-name="<?php echo e($forum->forum_name); ?>"
                                data-desc="<?php echo e($forum->forum_desc); ?>"
                                data-members="<?php echo e($forum->mem_count); ?>"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal"
                            >
                                Edit
                            </button>
                            <form
                                action="<?php echo e(route('admin.forums.delete', $forum->id)); ?>"
                                method="POST"
                                style="display: inline-block"
                            >
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button
                                    type="submit"
                                    class="btn btn-danger deleteButton"
                                >
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('includes_forums.forums_edit_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_forums/forums_table_inc.blade.php ENDPATH**/ ?>