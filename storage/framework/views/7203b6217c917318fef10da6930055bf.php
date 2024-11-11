<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Forums</title>
        <link rel="icon" href="/imgs/lawminarylogo_v3.png" type="image/png" />
        <link rel="stylesheet" href="<?php echo e(asset('css/forums_style.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('css/nav_style.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('css/responsive/navres.css')); ?>" />
        <link
            rel="stylesheet"
            href="<?php echo e(asset('css/otherstyles/posts_style.css')); ?>"
        />
        <?php echo $__env->make('inclusions/libraryLinks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </head>
    <body>
        <div class="container">
            <?php echo $__env->make('inclusions/userNav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <main>
                <header>
                    <div class="header-top">
                        <i class="fa-solid fa-bars"></i>
                        <img src="../imgs/Lawminary_Logo_2-Gold.png" alt="" />
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
                        <button id="forumsTab" class="forums-tab current-tab">
                            <span>Forums</span>
                            <i class="fa-solid fa-users"></i>
                        </button>
                        <button id="articlesTab" class="articles-tab">
                            <span>Article</span>
                            <i class="fa-solid fa-scale-balanced"></i>
                        </button>
                        <button id="leaderboardsTab" class="leaderboards-tab">
                            <span>Top Lawyers</span>
                            <i class="fa-solid fa-chart-simple"></i>
                        </button>
                    </div>
                    <button id="showForumLists">See Forum Lists</button>
                </div>

                <div class="content-wrapper">
                    <div class="forum-left">
                        <div class="search-forum">
                            <div class="search-ttl">
                                <label>Discover</label>
                                <label>Forums</label>
                            </div>
                            <input
                                type="text"
                                id="searchInput"
                                placeholder="Search forums..."
                            />
                            <button>Search</button>
                        </div>

                        <?php $__currentLoopData = $discoverForum; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dForum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="forum-overview forum-item">
                                <section class="forum-section">
                                    <div class="forum-active">
                                        <div class="circle">
                                            <img
                                                class="images"
                                                src="<?php echo e(Storage::url($dForum->forumPhoto)); ?>"
                                                alt="<?php echo e($dForum->forumName); ?>"
                                            />
                                        </div>
                                        <div class="forum-details">
                                            <a
                                                href="<?php echo e(route('visit.forum', $dForum->forum_id)); ?>"
                                                class="forum-link"
                                            >
                                                <h2 class="forum-name">
                                                    <?php echo e($dForum->forumName); ?>

                                                </h2>
                                            </a>
                                            <p>
                                                <?php echo e($dForum->membersCount); ?>

                                                Member(s)
                                            </p>
                                            <p><?php echo e($dForum->forumDesc); ?></p>
                                            <input
                                                type="hidden"
                                                id="forumIdInput"
                                                value="<?php echo e($dForum->forum_id); ?>"
                                                readonly
                                            />
                                        </div>
                                    </div>

                                    <form
                                        action="<?php echo e(route('forum.join')); ?>"
                                        method="POST"
                                    >
                                        <?php echo csrf_field(); ?>
                                        <?php echo $__env->make('inclusions/response', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <input
                                            type="hidden"
                                            name="forum_id"
                                            value="<?php echo e($dForum->forum_id); ?>"
                                        />
                                        <button
                                            class="join-button <?php echo e($joined[$dForum->forum_id] ? 'joined-button' : ''); ?>"
                                            type="submit"
                                        >
                                            <?php echo e($joined[$dForum->forum_id] ? 'Joined' : 'Join'); ?>

                                        </button>
                                    </form>
                                </section>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="forum-invitations-wrapper">
                        <section class="forum-invitations">
                            <div class="forum-ttl">
                                <h2>Forum List</h2>
                            <i class="fa-solid fa-window-minimize" id="minimizeIcon"></i>
                            </div>              
                            <div class="search-bar">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" placeholder="Search Forums">
                            </div>
                      
                            <?php $__currentLoopData = $joinedForum; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $forum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('visit.forum', $forum->forum_id)); ?>" class="forum-link">
                                    <div class="forum" 
                                        data-forum-id="<?php echo e($forum->forum_id); ?>"
                                        data-forum-name="<?php echo e($forum->forumName); ?>"
                                        data-forum-members="<?php echo e($forum->membersCount ?? 0); ?>"
                                        data-forum-desc="<?php echo e($forum->forumDesc); ?>"
                                        data-forum-photo="<?php echo e(Storage::url($forum->forumPhoto)); ?>">
                                        <img src="<?php echo e(Storage::url($forum->forumPhoto)); ?>" alt="">
                                    <div class="forum-status">
                                        <span>Joined</span>
                                    </div>
                                    <div class="forum-head">
                                        <h3><?php echo e($forum->forumName); ?></h3>
                                        <h5>Member(s): <?php echo e($forum->membersCount ?? 0); ?></h5>
                                    </div>
                                    </div>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                        </section>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <script src="js/showUserNav.js"></script>

        <script src="js/showNotification.js"></script>
        <script src="js/user_js/forums.js"></script>
        <script src="js/homelocator.js"></script>
        <script src="js/settings.js"></script>
        <script src="js/logout.js"></script>
        <script src="js/postandcomment.js"></script>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/users/forums.blade.php ENDPATH**/ ?>