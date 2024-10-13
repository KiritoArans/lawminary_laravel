<div class="profile-comments">
    <?php if($comments->isEmpty()): ?>
        <div class="empty">No comments yet.</div>
    <?php else: ?>
        <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="comments">
                    <div class="comment-content">
                        <div class="comment-header">
                            <div class="user-info">
                                <img src="<?php echo e($comment->user->userPhoto ? Storage::url($comment->user->userPhoto) : '../imgs/user-img.png'); ?>" alt="Profile Picture" class="user-profile-photo">
                                <div class="comment-info">
                                    <h2><?php echo e($comment->user->accountType === 'Lawyer' ? 'Atty. ' : ''); ?><?php echo e($comment->user->firstName); ?> <?php echo e($comment->user->lastName); ?></h2>
                                    <label>@<span><?php echo e($comment->user->username); ?></span></label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="comment-text">
                            <p><?php echo e($comment->comment); ?></p>
                            <div class="date-time">
                                <p><?php echo e($comment->created_at->diffForHumans()); ?></p>
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
    <?php endif; ?>
</div><?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/inclusions/profile/profileCommsReps.blade.php ENDPATH**/ ?>