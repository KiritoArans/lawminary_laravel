<div class="profile-liked">
    <?php if($likes->isEmpty()): ?>
        <div class="empty">No likes yet.</div>
    <?php endif; ?>
    <?php $__currentLoopData = $likes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="posts">
            <div class="post-content">
                <div class="post-header">
                    <div class="user-info">
                        <img src="<?php echo e($post->userPhoto ? Storage::url($post->userPhoto) : '../imgs/user-img.png'); ?>" alt="Profile Picture" class="user-profile-photo">
                        <div class="post-info">
                            <h2>
                                <a href="<?php echo e(Auth::check() && Auth::user()->user_id == $post->postedBy ? route('profile') : route('visit-profile', ['user_id' => $post->postedBy])); ?>">
                                    <?php echo e($post->accountType === 'Attorney' ? 'Atty. ' : ''); ?><?php echo e($post->firstName); ?> <?php echo e($post->lastName); ?>

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
                                
                    <?php
                        $hasLiked = \App\Models\Like::where('user_id', Auth::user()->user_id)
                                    ->where('post_id', $post->post_id)
                                    ->exists();

                        $hasBookmarked = \App\Models\Bookmark::where('user_id', Auth::user()->user_id)
                                    ->where('post_id', $post->post_id)
                                    ->exists();
                    ?>
                    <form action="<?php echo e(route('post.like')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="post_id" value="<?php echo e($post->post_id); ?>">
                    
                        <button type="submit" class="btn-hit <?php echo e($hasLiked ? 'btn-hitted' : ""); ?>">
                            <i class="fa-solid fa-gavel"></i> Hit
                        </button>
                    </form>
                    
                    <button class="btn-comment" data-post-id="<?php echo e($post->post_id); ?>">
                        <i class="fas fa-comment"></i> Comment
                    </button>

                    <form action="<?php echo e(route('post.bookmark')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="post_id" value="<?php echo e($post->post_id); ?>">
                    
                        <button type="submit" class="btn-bookmark <?php echo e($hasBookmarked ? 'btn-bookmarked' : ""); ?>">
                            <i class="fas fa-bookmark"></i> Bookmark
                        </button>
                    </form>

                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/inclusions/profile/profileLikes.blade.php ENDPATH**/ ?>