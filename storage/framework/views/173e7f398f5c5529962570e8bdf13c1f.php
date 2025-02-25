<div class="posts">
    <div class="post-content">
        <div class="post-header">
            <div class="user-info">
                <img
                    src="<?php echo e($post->user->userPhoto ? Storage::url($post->user->userPhoto) : '../imgs/user-img.png'); ?>"
                    alt="Profile Picture"
                    class="user-profile-photo"
                />
                <div class="post-info">
                    <h2>
                        <a
                            href="<?php echo e(Auth::check() && Auth::user()->user_id == $post->user->user_id ? route('profile') : route('visit-profile', ['user_id' => $post->user->user_id])); ?>"
                        >
                            <?php echo e($post->user ? ($post->user->accountType === 'Lawyer' ? 'Atty. ' : '') . $post->user->firstName . ' ' . $post->user->lastName : 'Unknown User'); ?>

                        </a>
                    </h2>
                    <label>@<span><?php echo e($post->user->username); ?></span></label>
                    <p for="">
                        Posted:
                        <?php echo e($post->created_at->diffForHumans()); ?>

                    </p>
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

        <hr />

        <div class="post-text">
            <p><?php echo e($post->concern); ?></p>
            <div class="post-category-privacy">
                <a href="home-search?query=<?php echo e($post->concernCategory); ?>"><?php echo e($post->concernCategory); ?></a>
                <span><?php echo e($post->privacy); ?></span>
            </div>
            <?php if($post->concernPhoto): ?>
                <img
                    src="<?php echo e(Storage::url($post->concernPhoto)); ?>"
                    alt="Concern Photo"
                    onclick="openConPhoto('<?php echo e($post->post_id); ?>')"
                />
            <?php endif; ?>
        </div>

        <hr />

        <div class="actions">
            <?php
                $hasLiked = \App\Models\Like::where('user_id', Auth::user()->user_id)
                    ->where('post_id', $post->post_id)
                    ->exists();

                $hasBookmarked = \App\Models\Bookmark::where('user_id', Auth::user()->user_id)
                    ->where('post_id', $post->post_id)
                    ->exists();
            ?>

            <form
                class="like-form"
                data-post-id="<?php echo e($post->post_id); ?>"
                action="<?php echo e(route('post.like')); ?>"
                method="POST"
            >
                <?php echo csrf_field(); ?>
                <input
                    type="hidden"
                    name="post_id"
                    value="<?php echo e($post->post_id); ?>"
                />
                <button
                    type="submit"
                    class="btn-hit <?php echo e($hasLiked ? 'btn-hitted' : ''); ?>"
                >
                    <i class="fa-solid fa-gavel"></i>
                    <span>Hit</span>
                    <span id="likes-count-<?php echo e($post->post_id); ?>">
                        (<?php echo e($post->likes_count); ?>)
                    </span>
                </button>
            </form>

            <button
                class="btn-comment"
                data-post-id="<?php echo e($post->post_id); ?>"
            >
                <i class="fas fa-comment"></i>
                <span>Comment</span>
                <?php if($post->comments_count > 0): ?>
                    <span>(<?php echo e($post->comments_count); ?>)</span>
                <?php endif; ?>
            </button>

            <form
                class="bookmark-form"
                data-post-id="<?php echo e($post->post_id); ?>"
                action="<?php echo e(route('post.bookmark')); ?>"
                method="POST"
            >
                <?php echo csrf_field(); ?>
                <input
                    type="hidden"
                    name="post_id"
                    value="<?php echo e($post->post_id); ?>"
                />
                <button
                    type="submit"
                    class="btn-bookmark <?php echo e($hasBookmarked ? 'btn-bookmarked' : ''); ?>"
                >
                    <i class="fas fa-bookmark"></i>
                    <span>Bookmark</span>
                    <span id="bookmark-count-<?php echo e($post->post_id); ?>">
                        (<?php echo e($post->bookmarks_count); ?>)
                    </span>
                </button>
            </form>
        </div>
        <?php if(Auth::check() && Auth::user()->user_id == $post->user->user_id && $post->privacy != 'Public'): ?>
            <div class="publish-public">
                <form action="">
                    <button type="button" class="publishToPublicBtn" data-post-id="<?php echo e($post->post_id); ?>">
                        <span>Publish to Public</span>
                        <i class="fa-solid fa-check"></i>
                    </button>
                </form>
            </div>
            
        <?php endif; ?>
    </div>
</div>
<?php echo $__env->make('inclusions/showConcernPhoto', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/inclusions/profile/profilePosts.blade.php ENDPATH**/ ?>