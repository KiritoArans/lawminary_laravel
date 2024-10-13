<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lawminary | Home</title>
    <link rel="icon" href="../imgs/lawminarylogo_v3.png" type="image/png" />
    <link rel="stylesheet" href="<?php echo e(asset('css/home_style.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/nav_style.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/otherstyles/posts_style.css')); ?>" />
    <?php echo $__env->make('inclusions/libraryLinks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
    <div class="container">
        <?php echo $__env->make('inclusions/userNav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <main>
            <header>
                <div class="header-top">
                    
                    <?php echo $__env->make('includes_syscon.syscon_logo_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="notification">
                        <a href="notifications">
                            <i class="fas fa-bell bell-icon"></i>
                        </a>
                    </div>
                </div>
                <hr class="divider" />
            </header>
            <div class="header-buttons-search">
                <div class="header-buttons">
                    <button id="postsTab" class="posts-tab current-tab">Posts</button>
                    <button id="forumsTab" class="forums-tab">Forums</button>
                    <button id="articlesTab" class="articles-tab">Article</button>
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
                <div class="filter-post">
                    <form action="<?php echo e(route('home')); ?>" method="GET" class="filter-form">
                        <select name="filter" id="filter" onchange="this.form.submit()">
                            <option value="all" <?php echo e(request('filter') == 'all' ? 'selected' : ''); ?>>Discover</option>
                            <option value="following" <?php echo e(request('filter') == 'following' ? 'selected' : ''); ?>>Following</option>
                        </select>
                    </form>
                </div>
                
                <?php echo $__env->make('inclusions/showPosts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    
                <?php echo $__env->make('inclusions/openComments', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                
                <?php echo $__env->make('inclusions/createPostModal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php echo $__env->make('inclusions/rateCommentModal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php echo $__env->make('inclusions/reportPostModal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            </content>
        </main>
    </div>

    <script src="js/postandcomment.js"></script>
    <script src="js/likePost.js"></script>
    <script src="js/bookmarkPost.js"></script>
    <script src="js/commentPost.js"></script>
    <script src="js/replyPost.js"></script>
    <script src="js/rateComment.js"></script>

    <script src="js/reportPost.js"></script>

    <script src="js/followUser.js"></script>

    <script src="js/homelocator.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/logout.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/users/home.blade.php ENDPATH**/ ?>