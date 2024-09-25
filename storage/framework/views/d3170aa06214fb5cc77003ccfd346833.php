<div class="profile-posts">
    <div class="posts">
        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($posts->isEmpty()): ?>
                <p>No posts yet.</p>
            <?php endif; ?>
            <div class="post-content">
                <div class="post-header">
                    <div class="user-info">
                        <?php if(Auth::user()->userPhoto): ?>
                            <img src="<?php echo e(Storage::url(Auth::user()->userPhoto)); ?>" class="user-profile-photo" alt="Profile Picture">
                        <?php else: ?>
                            <img src="../../imgs/user-img.png" class="user-profile-photo" alt="Profile Picture">
                        <?php endif; ?>
                        <div class="post-info">
                            <h2><?php echo e($user->firstName); ?> <?php echo e($user->lastName); ?></h2>
                            <p>@<span><?php echo e($user->username); ?></span></p>
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
                        <img src="<?php echo e(Storage::url($post->concernPhoto)); ?>" alt="Concern Photo" style="max-width: 25%; height: auto;">
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
            
            <div class="comment-modal" id="commentModal-<?php echo e($post->post_id); ?>" style="display:none;">
                <div class="clicked-post-content">
                    <div class="clicked-post-header">
                        <div class="user-info">
                            <?php if(Auth::user()->userPhoto): ?>
                            <img src="<?php echo e(Storage::url(Auth::user()->userPhoto)); ?>" class="user-profile-photo" alt="Profile Picture">
                            <?php else: ?>
                                <img src="../../imgs/user-img.png" class="user-profile-photo" alt="Profile Picture">
                            <?php endif; ?>
                            <div class="clicked-post-info">
                                <h2 id="modalUserName"><?php echo e($user->firstName); ?> <?php echo e($user->lastName); ?></h2>
                                <p>@<span id="modalUserUsername"><?php echo e($user->username); ?></span></p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="clicked-post-text">
                        <p id="modalPostText"><?php echo e($post->concern); ?></p>
                        <?php if($post->concernPhoto): ?>
                            <img id="modalPostPhoto" src="<?php echo e(Storage::url($post->concernPhoto)); ?>" alt="Concern Photo" style="max-width: 100%; height: auto;">
                        <?php endif; ?>
                    </div>
                    <hr>
                    <div class="actions">
                        <button><i class="fa-solid fa-gavel"></i> Hit</button>
                        <button><i class="fas fa-comment"></i> Comment</button>
                        <button><i class="fas fa-bookmark"></i> Bookmark</button>
                    </div>

                    <hr>

                    <div class="comment-section">
                        <div class="comment-area">
                        <?php $__currentLoopData = $post->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="user-comment">
                                <div>
                                    <?php if($comment->user && $comment->user->userPhoto): ?>
                                        <img src="<?php echo e(Storage::url($comment->user->userPhoto)); ?>" alt="User Profile Picture" class="user-profile-photo">
                                    <?php else: ?>
                                        <img src="../../imgs/user-img.png" alt="Default User Image" class="user-profile-photo">
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <span><?php echo e($comment->user ? $comment->user->firstName . ' ' . $comment->user->lastName : 'Unknown User'); ?></span>
                                    <p><?php echo e($comment->comment); ?></p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
                        <?php if(session('post_id') == $post->post_id && session('new_comment')): ?>
                        <div class="user-comment">
                            <div>
                                <img src="<?php echo e(Auth::user()->userPhoto ? Storage::url(Auth::user()->userPhoto) : '../../imgs/user-img.png'); ?>" alt="User Profile Picture" class="user-profile-photo">
                            </div>
                            <div>
                                <span><?php echo e(Auth::user()->firstName); ?> <?php echo e(Auth::user()->lastName); ?></span>
                                <p><?php echo e(session('new_comment')->comment); ?></p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
            
                        <hr>
            
                        <div class="comment-field">
                            <form method="POST" action="<?php echo e(route('users.createComment')); ?>">
                                <?php echo csrf_field(); ?>
                                <?php if(Auth::user()->userPhoto): ?>
                                    <img src="<?php echo e(Storage::url(Auth::user()->userPhoto)); ?>" class="user-profile-photo" alt="Profile Picture">
                                <?php else: ?>
                                    <img src="../../imgs/user-img.png" class="user-profile-photo" alt="Profile Picture">
                                <?php endif; ?>
                                <input type="hidden" name="post_id" value="<?php echo e($post->post_id); ?>">
                                <textarea name="comment" placeholder="Write a comment..." required></textarea>
                                <button type="submit">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div><?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/inclusions/posts.blade.php ENDPATH**/ ?>