<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="profile-comments">
        <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="comments">
            <div class="comment-content">
                <div class="comment-header">
                    <div class="user-info">
                        <?php if(Auth::user()->userPhoto): ?>
                            <img src="<?php echo e(Storage::url(Auth::user()->userPhoto)); ?>" class="user-profile-photo" alt="Profile Picture">
                        <?php else: ?>
                            <img src="../../imgs/user-img.png" class="user-profile-photo" alt="Profile Picture">
                        <?php endif; ?>
                        <div class="comment-info">
                            <h2><?php echo e($user->firstName); ?> <?php echo e($user->lastName); ?></h2>
                            <label>@<span><?php echo e($user->username); ?></span></label>
                        </div>
                    </div>
                        
                </div>
                <hr>
                <div class="comment-text">
                    <p><?php echo e($comment->comment); ?></p>
                    <div class="date-time">
                        <p for=""><?php echo e($comment->created_at->diffForHumans()); ?></p>
                    </div>
                </div>
                <hr>
                <div class="actions">
                    <button class="btn-comment" data-post-id="<?php echo e($comment->post_id); ?>">
                        View Post
                    </button>
                </div>            
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/inclusions/profileCommsReps.blade.php ENDPATH**/ ?>