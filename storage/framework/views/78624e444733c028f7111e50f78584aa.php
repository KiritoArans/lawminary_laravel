<div id="followModal" class="followModal">
    <div class="followModal-content">
        <span class="close">&times;</span>
        <div class="modal-nav">
            <span id="followers-tab" class="active">Followers</span>
            <span id="following-tab">Following</span>
        </div>

        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search">
        </div>
        
        <ul id="followers-list" class="user-list">
            <?php $__currentLoopData = $followers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $follower): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <img src="<?php echo e($follower->followerUser->userPhoto ? Storage::url($follower->followerUser->userPhoto) : '../imgs/user-img.png'); ?>" alt="Profile Photo" class="user-profile-photo">
                <div class="user-info">
                    <a href="<?php echo e(Auth::check() && Auth::user()->user_id == $follower->followerUser->user_id ? route('profile') : route('visit-profile', ['user_id' => $follower->followerUser->user_id])); ?>">
                        <span class="fullname"><?php echo e($follower->followerUser->firstName); ?> <?php echo e($follower->followerUser->lastName); ?></span>
                    </a>
                </div>
                <?php if(Auth::user()->user_id != $follower->followerUser->user_id): ?>
                <?php
                    $haveFollowed = \App\Models\Follow::where('follower', Auth::user()->user_id)
                        ->where('following', $follower->followerUser->user_id)
                        ->exists();
                ?>

                <form class="follow-form" action="<?php echo e(route('followUser')); ?>" method="POST" style="display:inline">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="following" value="<?php echo e($follower->followerUser->user_id); ?>">
                    
                    <button type="submit" class="follow-btn <?php echo e($haveFollowed ? 'following' : ''); ?>">
                        <?php echo e($haveFollowed ? 'Unfollow' : 'Follow'); ?>

                    </button>
                </form>

                <?php endif; ?>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>

        <ul id="following-list" class="user-list" style="display: none;">
            <?php $__currentLoopData = $following; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $follow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <img src="<?php echo e($follow->followedUser->userPhoto ? Storage::url($follow->followedUser->userPhoto) : '../imgs/user-img.png'); ?>" alt="Profile Photo" class="user-profile-photo">
                <div class="user-info">
                    <a href="<?php echo e(Auth::check() && Auth::user()->user_id == $follow->followedUser->user_id ? route('profile') : route('visit-profile', ['user_id' => $follow->followedUser->user_id])); ?>">
                        <span class="fullname"><?php echo e($follow->followedUser->firstName); ?> <?php echo e($follow->followedUser->lastName); ?></span>
                    </a>
                </div>
                <?php if(Auth::user()->user_id != $follow->followedUser->user_id): ?>
                <?php
                    $haveFollowed = \App\Models\Follow::where('follower', Auth::user()->user_id)
                        ->where('following', $follow->followedUser->user_id)
                        ->exists();
                ?>

                <form class="follow-form" action="<?php echo e(route('followUser')); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="following" value="<?php echo e($follow->followedUser->user_id); ?>">
                    
                    <button type="submit" class="follow-btn <?php echo e($haveFollowed ? 'following' : ''); ?>">
                        <?php echo e($haveFollowed ? 'Unfollow' : 'Follow'); ?>

                    </button>
                </form>

                <?php endif; ?>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div><?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/inclusions/profile/profileFollowModal.blade.php ENDPATH**/ ?>