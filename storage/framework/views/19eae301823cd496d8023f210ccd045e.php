<div class="profile-bookmarked">
    <?php $__currentLoopData = $bookmarks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="posts">
            <div class="post-content">
                <div class="post-header">
                    <div class="user-info">
                        <img src="<?php echo e($post->userPhoto ? Storage::url($post->userPhoto) : '../imgs/user-img.png'); ?>" alt="Profile Picture" class="user-profile-photo">
                        <div class="post-info">
                            <h2>
                                <a href="<?php echo e(Auth::check() && Auth::user()->user_id == $post->postedBy ? route('profile') : route('visit-profile', ['user_id' => $post->postedBy])); ?>">
                                    <?php echo e($post->firstName); ?> <?php echo e($post->lastName); ?>

                                </a>
                            </h2>
                            <label>@<span><?php echo e($post->username ?? 'username'); ?></span></label>
                            <p>Posted: <?php echo e(\Carbon\Carbon::parse($post->created_at)->diffForHumans()); ?></p>
                        </div>
                    </div>
                    <div class="post-options">
                        <i class="fas fa-ellipsis-v"></i>
                    </div>
                </div>
                <hr>
                <div class="post-text">
                    <p><?php echo e($post->concern ?? 'No content available'); ?></p> <!-- Post content -->
                </div>
                <hr>
                <div class="actions">
                    <button><i class="fa-solid fa-gavel"></i> Hit</button>
                    <button><i class="fas fa-comment"></i> Comment</button>
                    <button><i class="fas fa-bookmark"></i> Bookmark</button>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/inclusions/profileBookmarks.blade.php ENDPATH**/ ?>