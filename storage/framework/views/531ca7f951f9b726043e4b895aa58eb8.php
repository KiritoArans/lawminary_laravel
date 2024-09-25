<?php $__currentLoopData = $allPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="comment-modal" id="commentModal-<?php echo e($post->post_id); ?>" style="display:none;">
        <div class="clicked-post-content">
            <div class="clicked-post-header">
                <div class="user-info">
                    <img src="<?php echo e($post->user->userPhoto ? Storage::url($post->user->userPhoto) : '../imgs/user-img.png'); ?>" alt="Profile Picture" class="user-profile-photo">
                    <div class="clicked-post-info">
                        <h2 id="modalUserName">
                            <a href="<?php echo e(Auth::check() && Auth::user()->user_id == $post->user->user_id ? route('profile') : route('visit-profile', ['user_id' => $post->user->user_id])); ?>">
                                <?php echo e($post->user ? ($post->user->accountType === 'Attorney' ? 'Atty. ' : '') . $post->user->firstName . ' ' . $post->user->lastName : 'Unknown User'); ?>

                            </a>
                        </h2>  
                        <label>@<span id="modalUserUsername"><?php echo e($post->user->username); ?></span></label>
                        <p> <?php echo e($post->created_at->format('M d, Y H:i A')); ?></p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="clicked-post-text">
                <p id="modalPostText"><?php echo e($post->concern); ?></p>
                <?php if($post->concernPhoto): ?>
                    <img id="modalPostPhoto" src="<?php echo e(Storage::url($post->concernPhoto)); ?>" alt="Concern Photo">
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
                <form action="<?php echo e(route('post.like')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="post_id" value="<?php echo e($post->post_id); ?>">
                
                    <button type="submit" class="btn-hit <?php echo e($hasLiked ? 'btn-hitted' : ""); ?>">
                        <i class="fa-solid fa-gavel"></i> Hit
                        <?php if($post->likes_count > 0): ?>
                            <span>(<?php echo e($post->likes_count); ?>)</span>
                        <?php endif; ?>
                    </button>
                </form>
                
                <button><i class="fas fa-comment"></i> Comment
                    <?php if($post->comments_count > 0): ?>
                        <span>(<?php echo e($post->comments_count); ?>)</span>
                    <?php endif; ?>
                </button>

                <form action="<?php echo e(route('post.bookmark')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="post_id" value="<?php echo e($post->post_id); ?>">
                
                    <button type="submit" class="btn-bookmark <?php echo e($hasBookmarked ? 'btn-bookmarked' : ""); ?>">
                        <i class="fas fa-bookmark"></i> Bookmark
                        <?php if($post->bookmarks_count > 0): ?>
                            <span>(<?php echo e($post->bookmarks_count); ?>)</span>
                        <?php endif; ?>
                    </button>
                </form>
            </div>
            <hr>
            <div class="comment-section">
                <div class="comment-area">
                <?php $__currentLoopData = $post->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="user-comment">
                        <div>
                            <img src="<?php echo e($comment->user->userPhoto ? Storage::url($comment->user->userPhoto) : '../imgs/user-img.png'); ?>" alt="User Profile Picture" class="user-profile-photo">
                        </div>
                        <div class="user-comment-content">
                            <span>
                                <a href="<?php echo e(Auth::check() && Auth::user()->user_id == $comment->user->user_id ? route('profile') : route('visit-profile', ['user_id' => $comment->user->user_id])); ?>">
                                    <?php echo e($comment->user ? ($comment->user->accountType === 'Attorney' ? 'Atty. ' : '') . $comment->user->firstName . ' ' . $comment->user->lastName : 'Unknown User'); ?>

                                </a>
                                <?php if($comment->user->accountType === 'Attorney'): ?>
                                    <i class="fa-regular fa-star rate-btn" 
                                        data-rating-comment-comment_id="<?php echo e($comment->comment_id); ?>" 
                                        data-rating-comment-user_id="<?php echo e($comment->user->user_id); ?>">
                                    </i>
                                <?php endif; ?>
                            </span>                                     
                            <p><?php echo e($comment->comment); ?></p>
                            <div class="date-reply">
                                <p class="comment-time"><?php echo e($comment->created_at->diffForHumans()); ?></p>
                                <a href="javascript:void(0);" class="reply-btn" data-comment-id="<?php echo e($comment->id); ?>">Reply</a>
                            </div>
                            <div class="reply-field" id="reply-field-<?php echo e($comment->id); ?>">
                                <?php
                                    $attorneyComments = $post->comments->filter(function ($comment) {
                                        return $comment->user->accountType === 'Attorney';
                                    });
                            
                                    $isSameAttorney = $attorneyComments->contains(function ($comment) {
                                        return $comment->user->user_id === Auth::user()->user_id;
                                    });
                            
                                    $isAttorney = Auth::user()->accountType === 'Attorney';
                            
                                    $isPostOwner = $post->user->user_id === Auth::user()->user_id;
                                ?>
                            
                                <?php if($attorneyComments->isNotEmpty() && $isAttorney && !$isSameAttorney && !$isPostOwner): ?>
                                    <label class="comment-warning">Comments and Replies are not accomodated by this post anymore.</label>
                                <?php else: ?>
                                    <form action="<?php echo e(route('users.createReply')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <textarea name="reply" id="reply-textarea-<?php echo e($comment->id); ?>" placeholder="Replying to <?php echo e($comment->user ? $comment->user->firstName : 'Unknown User'); ?>"></textarea>
                                        <input type="hidden" name="post_id" value="<?php echo e($post->post_id); ?>">
                                        <input type="hidden" name="comment_id" value="<?php echo e($comment->comment_id); ?>">
                                        <button type="submit">Send</button>
                                    </form>
                                <?php endif; ?>
                            </div>      
                        </div>
                    </div>
                    <?php if($comment->reply->isNotEmpty()): ?>
                        <div class="view-reply">
                            <a href="javascript:void(0);" onclick="toggleReplies(<?php echo e($comment->id); ?>, this)">View Replies</a>
                        </div>
                    <?php endif; ?>
                    <div id="replies-<?php echo e($comment->id); ?>" style="display: none;">
                        <?php $__currentLoopData = $comment->reply; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="user-reply">
                                <div>
                                    <img src="<?php echo e($reply->user->userPhoto ? Storage::url($reply->user->userPhoto) : '../imgs/user-img.png'); ?>" alt="User Profile Picture" class="user-profile-photo">
                                </div>
                                <div class="user-reply-content">
                                    <span>
                                        <a href="<?php echo e(Auth::check() && Auth::user()->user_id == $reply->user->user_id ? route('profile') : route('visit-profile', ['user_id' => $reply->user->user_id])); ?>">
                                            <?php echo e($reply->user ? ($reply->user->accountType === 'Attorney' ? 'Atty. ' : '') . $reply->user->firstName . ' ' . $reply->user->lastName : 'Unknown User'); ?>

                                        </a>
                                    </span>                                                        
                                    <label>replied to 
                                        <span><?php echo e($comment->user ? $comment->user->firstName: 'Unknown User'); ?></span>'s comment.
                                    </label>
                                    <p><?php echo e($reply->reply); ?></p>
                                    <div class="date-reply">
                                        <p class="comment-time"><?php echo e($reply->created_at->diffForHumans()); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <hr>
                <div class="comment-field" id="comment-field">
                    <?php
                        $attorneyComments = $post->comments->filter(function ($comment) {
                            return $comment->user->accountType === 'Attorney';
                        });
                
                        $isSameAttorney = $attorneyComments->contains(function ($comment) {
                            return $comment->user->user_id === Auth::user()->user_id;
                        });
                
                        $isAttorney = Auth::user()->accountType === 'Attorney';
                
                        $isPostOwner = $post->user->user_id === Auth::user()->user_id;
                    ?>
                
                    <?php if($attorneyComments->isNotEmpty() && $isAttorney && !$isSameAttorney && !$isPostOwner): ?>
                        <label class="comment-warning">An attorney has already commented on this post.</label>
                    <?php else: ?>
                        <form id="commentForm" method="POST" action="<?php echo e(route('users.createComment')); ?>">
                            <?php echo csrf_field(); ?>
                            <img src="<?php echo e(Auth::user()->userPhoto ? Storage::url(Auth::user()->userPhoto) : asset('imgs/user-img.png')); ?>" class="user-profile-photo" alt="Profile Picture">
                            <input type="hidden" name="post_id" value="<?php echo e($post->post_id); ?>">
                            <textarea name="comment" placeholder="Write a comment..." required></textarea>
                            <button type="submit">Send</button>
                        </form>
                    <?php endif; ?>
                </div>                                    
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/inclusions/openComments.blade.php ENDPATH**/ ?>