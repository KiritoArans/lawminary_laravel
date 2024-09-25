<div class="profile-posts">
    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="posts">
            <?php if($posts->isEmpty()): ?>
                <p>No posts yet.</p>
            <?php endif; ?>
            <div class="post-content">
                <div class="post-header">
                    <div class="user-info">
                        <img src="<?php echo e(Auth::user()->userPhoto ? Storage::url(Auth::user()->userPhoto) : asset('imgs/user-img.png')); ?>" class="user-profile-photo" alt="Profile Picture">
                        <div class="post-info">
                            <h2>
                                <a href="<?php echo e(Auth::check() && Auth::user()->user_id == $post->user->user_id ? route('profile') : route('visit-profile', ['user_id' => $post->user->user_id])); ?>">
                                    <?php echo e($post->user->firstName); ?> <?php echo e($post->user->lastName); ?>

                                </a>                                
                            </h2>                            
                            <label>@<span><?php echo e($user->username); ?></span></label>
                            <p for="">Posted: <?php echo e($post->created_at->diffForHumans()); ?></p>
                        </div>
                    </div>
                    <div class="post-options">
                        <div class="options">
                            <a href="">Delete</a>
                            <a href="">Report</a>
                        </div>
                        <i class="fas fa-ellipsis-v"></i>
                    </div>
                </div>
                <hr>
                <div class="post-text">
                    <p><?php echo e($post->concern); ?></p>
                    <?php if($post->concernPhoto): ?>
                        <img src="<?php echo e(Storage::url($post->concernPhoto)); ?>" alt="Concern Photo">
                    <?php endif; ?>
                </div>
                <hr>
                <div class="actions">
                    <button><i class="fa-solid fa-gavel"></i> Hit</button>
                    <button class="btn-comment" data-post-id="<?php echo e($post->post_id); ?>">
                        <i class="fas fa-comment"></i> Comment
                    </button>
                    <button><i class="fas fa-bookmark"></i> Bookmark</button>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/inclusions/profilePosts.blade.php ENDPATH**/ ?>