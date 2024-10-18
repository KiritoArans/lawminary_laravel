<div class="posts">
    <?php if($posts->isEmpty()): ?>
    <div class="empty">No posts available.</div>
    <?php endif; ?>

    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="post-content">
            <div class="post-header">
                <div class="user-info">
                    <img src="<?php echo e($post->user->userPhoto ? Storage::url($post->user->userPhoto) : '../imgs/user-img.png'); ?>" alt="Profile Picture" class="user-profile-photo" />
                    <div class="post-info">
                        <div class="name-follow">
                            <h2>
                                <a href="<?php echo e(Auth::check() && Auth::user()->user_id == $post->user->user_id ? route('profile') : route('visit-profile', ['user_id' => $post->user->user_id])); ?>">
                                    <?php echo e($post->user ? ($post->user->accountType === 'Lawyer' ? 'Atty. ' : '') . $post->user->firstName . ' ' . $post->user->lastName : 'Unknown User'); ?>

                                </a>
                            </h2>
                            <?php if(Auth::user()->user_id != $post->user->user_id): ?>
                            <label>|</label>
                            <?php
                                $haveFollowed = \App\Models\Follow::where('follower', Auth::user()->user_id)->where('following', $post->postedBy)->exists();
                            ?>

                            <form class="follow-form" action="<?php echo e(route('followUser')); ?>" method="POST" style="display: inline">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="following" value="<?php echo e($post->user->user_id); ?>" />
                                <button type="submit" class="follow-btn <?php echo e($haveFollowed ? 'following' : ''); ?>"><?php echo e($haveFollowed ? 'Unfollow' : 'Follow'); ?></button>
                            </form>

                            <?php endif; ?>
                        </div>
                        <label>@<span><?php echo e($post->user->username ?? 'unknownuser'); ?></span></label>
                        <p>Posted: <?php echo e($post->created_at->diffForHumans()); ?></p>
                    </div>
                </div>

                <div class="post-options">
                    <div class="options">
                        <?php if(Auth::check() && Auth::user()->user_id == $post->user->user_id): ?>

                            <button onclick="confirmDelete('<?php echo e($post->post_id); ?>')" class="btn-delete">
                                Delete
                            </button>

                            <form id="delete-form-<?php echo e($post->post_id); ?>" action="<?php echo e(route('post.delete', $post->post_id)); ?>" method="POST" style="display: none;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                            </form>                                                      

                        <?php else: ?>
                            <a id="reportLink" data-post-id="<?php echo e($post->post_id); ?>">Report</a>
                        <?php endif; ?>
                    </div>
                    <i class="fas fa-ellipsis-v"></i>
                </div>                            

            </div>
            <hr />
            <div class="post-text">
                <p><?php echo e($post->concern); ?></p>
                <?php if($post->concernPhoto): ?>
                <img src="<?php echo e(Storage::url($post->concernPhoto)); ?>" alt="Post Image" style="max-width: 100%; height: auto;" />
                <?php endif; ?>
            </div>
            <hr />
            <div class="actions">
                <?php
                    $hasLiked = \App\Models\Like::where('user_id', Auth::user()->user_id)->where('post_id', $post->post_id)->exists();
                    $hasBookmarked = \App\Models\Bookmark::where('user_id', Auth::user()->user_id)->where('post_id', $post->post_id)->exists();
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
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/inclusions/showPosts.blade.php ENDPATH**/ ?>