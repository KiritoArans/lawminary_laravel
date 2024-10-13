<div id="pendingModal" class="pendingModal" style="display: none;">
    <div class="pendingModal-content">
        <span class="pen-post-close">&times;</span>
    
        <div class="pendingModal-nav">
            <span id="pending-posts-tab" class="active">Pending Posts (<?php echo e($pendingPosts->count()); ?>)</span>
            <span id="disregarded-posts-tab">Disregarded Posts (<?php echo e($disregardPosts->count()); ?>)</span>
        </div>
    
        <div id="pending-posts" class="tab-content active">
            <?php if($pendingPosts->isEmpty()): ?>
                <p>No pending posts yet.</p>
            <?php else: ?>
            <?php $__currentLoopData = $pendingPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="pending-post-content">
                    <div class="pending-post-details">
                        <p><?php echo e($post->concern); ?></p>
                        <p class="pending-post-date"><?php echo e($post->created_at->diffForHumans()); ?></p>
                    </div>
                    <div class="pending-post-details">
                        <p class="pending-post-status">Status:</p>
                        <p class="status-text" data-status="<?php echo e($post->status); ?>"><?php echo e($post->status); ?></p>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    
        <div id="disregarded-posts" class="tab-content" style="display: none;">
            <?php if($disregardPosts->isEmpty()): ?>
                <p>No disregarded posts yet.</p>
            <?php else: ?>
            <?php $__currentLoopData = $disregardPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="disregard-post-content">
                    <div class="pending-post-details">
                        <p><?php echo e($post->concern); ?></p>
                        <p class="pending-post-date"><?php echo e($post->created_at->diffForHumans()); ?></p>
                    </div>
                    <div class="pending-post-details">
                        <p class="pending-post-status">Status:</p>
                        <p class="status-text" data-status="<?php echo e($post->status); ?>"><?php echo e($post->status); ?></p>
                    </div>
                </div>
                <div class="disregard-reason">
                    <p>Reason: <?php echo e($post->reasonDisregard); ?></p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
    
</div><?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/inclusions/profile/penPostModal.blade.php ENDPATH**/ ?>