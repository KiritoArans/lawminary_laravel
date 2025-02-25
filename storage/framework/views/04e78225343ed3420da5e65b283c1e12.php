<div class="profile-liked">
    <?php if($likes->isEmpty()): ?>
        <div class="empty">No likes yet.</div>
    <?php endif; ?>
    <?php $__currentLoopData = $likes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="posts">
            <div class="post-content">
                <div class="post-header">
                    <div class="user-info">
                        <img src="<?php echo e($post->user->userPhoto ? Storage::url($post->user->userPhoto) : '../imgs/user-img.png'); ?>" alt="Profile Picture" class="user-profile-photo" />
                        <div class="post-info">
                            <h2>
                                <a href="<?php echo e(Auth::check() && Auth::user()->user_id == $post->postedBy ? route('profile') : route('visit-profile', ['user_id' => $post->postedBy])); ?>">
                                    <?php echo e($post->user->accountType === 'Lawyer' ? 'Atty. ' : ''); ?><?php echo e($post->user->firstName); ?> <?php echo e($post->user->lastName); ?>

                                </a>
                            </h2>                            
                            <label>@<span><?php echo e($post->user->username ?? 'username'); ?></span></label>
                            <p>Posted: <?php echo e(\Carbon\Carbon::parse($post->created_at)->diffForHumans()); ?></p>
                        </div>
                    </div>
                    <div class="post-options">
                        <div class="options">
                            <?php if(Auth::check() && Auth::user()->user_id == $post->user->user_id): ?>
                                <button onclick="confirmDelete('<?php echo e($post->post_id); ?>')" class="btn-delete">
                                    Delete
                                </button>
                                <form
                                    id="delete-form-<?php echo e($post->post_id); ?>"
                                    action="<?php echo e(route('post.delete', $post->post_id)); ?>"
                                    method="POST"
                                    style="display: none"
                                >
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                </form>
                            <?php else: ?>
                                <a id="reportLink" data-post-id="<?php echo e($post->post_id); ?>">
                                    Report
                                </a>
                            <?php endif; ?>
                        </div>
                        <i class="fas fa-ellipsis-v"></i>
                    </div>
                </div>
                <hr>
                <div class="post-text">
                    <p><?php echo e($post->concern); ?></p>
                    <div>
                        <a href="home-search?query=<?php echo e($post->concernCategory); ?>"><?php echo e($post->concernCategory); ?></a>
                    </div>
                    <?php if($post->concernPhoto): ?>
                        <img
                            src="<?php echo e(Storage::url($post->concernPhoto)); ?>"
                            alt="Concern Photo"
                            onclick="openConPhoto('<?php echo e($post->post_id); ?>')"
                        />
                    <?php endif; ?>
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

                    <form class="like-form" data-post-id="<?php echo e($post->post_id); ?>" action="<?php echo e(route('post.like')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="post_id" value="<?php echo e($post->post_id); ?>" />
                        <button type="submit" class="btn-hit <?php echo e($hasLiked ? 'btn-hitted' : ''); ?>">
                            <i class="fa-solid fa-gavel"></i>Hit
                            <span id="likes-count-<?php echo e($post->post_id); ?>">(<?php echo e($post->likes_count); ?>)</span>
                        </button>
                    </form>

                    <button class="btn-comment" data-post-id="<?php echo e($post->post_id); ?>">
                        <i class="fas fa-comment"></i>Comment
                        <?php if($post->comments_count > 0): ?>
                            <span>(<?php echo e($post->comments_count); ?>)</span>
                        <?php endif; ?>
                    </button>

                    <form class="bookmark-form" data-post-id="<?php echo e($post->post_id); ?>" action="<?php echo e(route('post.bookmark')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="post_id" value="<?php echo e($post->post_id); ?>" />
                        <button type="submit" class="btn-bookmark <?php echo e($hasBookmarked ? 'btn-bookmarked' : ''); ?>">
                            <i class="fas fa-bookmark"></i> Bookmark
                            <span id="bookmark-count-<?php echo e($post->post_id); ?>">(<?php echo e($post->bookmarks_count); ?>)</span>
                        </button>
                    </form>

                </div>
            </div>
        </div>

        

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/inclusions/profile/profileLikes.blade.php ENDPATH**/ ?>