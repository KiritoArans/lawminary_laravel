<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lawminary | Search for <?php echo e($query); ?></title>
    <link rel="icon" href="../imgs/lawminarylogo_v3.png" type="image/png" />
    <link rel="stylesheet" href="<?php echo e(asset('css/home_style.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/nav_style.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/responsive/navres.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/otherstyles/posts_style.css')); ?>" />
    <?php echo $__env->make('inclusions/libraryLinks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('inclusions/broadcastJS', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
    <div class="container">
        <?php echo $__env->make('inclusions/userNav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <main>
            <header>
                <div class="header-top">
                    <i class="fa-solid fa-bars"></i>
                    <?php echo $__env->make('includes_syscon.syscon_logo_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="notification">
                        <a href="notifications" class="notification-link">
                            <i class="fas fa-bell bell-icon current"></i>
                            <span id="notification-count" class="notification-badge"></span>
                        </a>
                    </div>
                </div>
                <hr class="divider" />
            </header>
            <div class="header-buttons-search">
                <div class="header-buttons">
                    <button id="postsTab" class="posts-tab">
                        <span>Posts</span>
                        <i class="fa-solid fa-envelope-open-text"></i>
                    </button>
                    <button id="forumsTab" class="forums-tab">
                        <span>Forums</span>
                        <i class="fa-solid fa-users"></i>
                    </button>
                    <button id="articlesTab" class="articles-tab">
                        <span>Article</span>
                        <i class="fa-solid fa-scale-balanced"></i>
                    </button>
                    <button id="leaderboardsTab" class="leaderboards-tab">
                        <span>Leaderboards</span>
                        <i class="fa-solid fa-chart-simple"></i>
                    </button>
                </div>

                <div class="search-bar">
                    <form id="searchForm" action="/home-search" method="GET">
                        <input type="text" name="query" id="searchQuery" placeholder="Search a user or post" required />
                        <i class="fas fa-search search-icon" onclick="document.getElementById('searchForm').submit();"></i>
                        <button type="submit">Search</button>
                    </form>
                </div>

            </div>

            <content>
                <div class="search-results">

                    <div class="home-search-nav">
                        <span id="all-tab" class="active">All</span>
                        <span id="user-tab">User</span>
                        <span id="lawyer-tab">Lawyer</span>
                        <span id="post-tab">Post</span>
                    </div>
                    
                    <div id="user-section">
                        <h3>Users</h3>
                        <?php if($users->isEmpty()): ?>
                            <p class="empty-search">No user found for <?php echo e($query); ?>.</p>
                        <?php else: ?>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="user-searched">
                                <div class="user-details">
                                    <img src="<?php echo e($user->userPhoto ? Storage::url($user->userPhoto) : '../imgs/user-img.png'); ?>" alt="Profile Picture" class="user-profile-photo" />
                                    <div class="user-names">
                                        <a href="<?php echo e(Auth::check() && Auth::user()->user_id == $user->user_id ? route('profile') : route('visit-profile', ['user_id' => $user->user_id])); ?>">
                                            <?php echo e($user->firstName); ?> <?php echo e($user->lastName); ?>

                                        </a>
                                        <p>@<span><?php echo e($user->username); ?></span></p>
                                        <span><?php echo e($user->posts_count); ?> Posts, <?php echo e($user->followers_count); ?> Followers</span>
                                    </div>
                                </div>
                                <?php
                                    $haveFollowed = \App\Models\Follow::where('follower', Auth::user()->user_id)
                                        ->where('following', $user->user_id)
                                        ->exists();
                                ?>
                
                                <?php if(Auth::check() && Auth::user()->user_id !== $user->user_id): ?>
                                    <form class="follow-form" action="<?php echo e(route('followUser')); ?>" method="POST" style="display: inline">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="following" value="<?php echo e($user->user_id); ?>">

                                        <button type="submit" class="edit-profile-button follow-btn <?php echo e($haveFollowed ? 'following followed-btn' : ''); ?>">
                                            <?php echo e($haveFollowed ? 'Unfollow' : 'Follow'); ?>

                                        </button>
                                    </form>
                                <?php endif; ?>

                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>

                    <div id="lawyer-section">
                        <h3>Lawyers</h3>
                        <?php if($lawyers->isEmpty()): ?>
                            <p class="empty-search">No user found for <?php echo e($query); ?>.</p>
                        <?php else: ?>
                            <?php $__currentLoopData = $lawyers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lawyer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="user-searched">
                                <div class="user-details">
                                    <img src="<?php echo e($lawyer->userPhoto ? Storage::url($lawyer->userPhoto) : '../imgs/user-img.png'); ?>" alt="Profile Picture" class="user-profile-photo" />
                                    <div class="user-names">
                                        <a href="<?php echo e(Auth::check() && Auth::user()->user_id == $lawyer->user_id ? route('profile') : route('visit-profile', ['user_id' => $lawyer->user_id])); ?>">
                                            Atty. <?php echo e($lawyer->firstName); ?> <?php echo e($lawyer->lastName); ?>

                                        </a>
                                        <p>@<span><?php echo e($lawyer->username); ?></span></p>
                                        <span><?php echo e($lawyer->posts_count); ?> Posts, <?php echo e($lawyer->followers_count); ?> Followers</span>
                                    </div>
                                </div>
                                <?php
                                    $haveFollowed = \App\Models\Follow::where('follower', Auth::user()->user_id)
                                        ->where('following', $lawyer->user_id)
                                        ->exists();
                                ?>
                
                                <?php if(Auth::check() && Auth::user()->user_id !== $lawyer->user_id): ?>
                                    <form class="follow-form" action="<?php echo e(route('followUser')); ?>" method="POST" style="display: inline">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="following" value="<?php echo e($lawyer->user_id); ?>">

                                        <button type="submit" class="edit-profile-button follow-btn <?php echo e($haveFollowed ? 'following followed-btn' : ''); ?>">
                                            <?php echo e($haveFollowed ? 'Unfollow' : 'Follow'); ?>

                                        </button>
                                    </form>
                                <?php endif; ?>

                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                
                    <div id="post-section">
                        <h3>Posts</h3>
                        <?php if($posts->isEmpty()): ?>
                            <p class="empty-search">No post found for <?php echo e($query); ?>.</p>
                        <?php else: ?>
                            <?php echo $__env->make('inclusions/showPosts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                    </div>
                
                </div>
                


            </content>

            <?php echo $__env->make('inclusions/openComments', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php echo $__env->make('inclusions/createPostModal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php echo $__env->make('inclusions/rateCommentModal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php echo $__env->make('inclusions/reportPostModal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </main>
    </div>
    
    <script src="js/homeSearchNav.js"></script>

    <script src="js/postandcomment.js"></script>
    <script src="js/likePost.js"></script>
    <script src="js/bookmarkPost.js"></script>
    <script src="js/commentPost.js"></script>
    <script src="js/replyPost.js"></script>

    <script src="js/reportPost.js"></script>

    <script src="js/followUser.js"></script>

    <script src="js/showNotification.js"></script>
    
    <script src="js/showUserNav.js"></script>

    <script src="js/homelocator.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/logout.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/users/home-search.blade.php ENDPATH**/ ?>