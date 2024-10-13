<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Profile</title>
        <link rel="icon" href="../imgs/lawminarylogo_v3.png" type="image/png" />
        <link rel="stylesheet" href="<?php echo e(asset('css/profile_style.css')); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset('css/nav_style.css')); ?>" />
        <link
            rel="stylesheet"
            href="<?php echo e(asset('css/otherstyles/posts_style.css')); ?>"
        />
        <?php echo $__env->make('inclusions/libraryLinks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

                <content class="profile-section">
                    <div class="profile-header">
                        <div class="profile-details">
                            <div class="profile-left">
                                <img
                                    src="<?php echo e(Auth::user()->userPhoto ? Storage::url(Auth::user()->userPhoto) : asset('imgs/user-img.png')); ?>"
                                    class="profile-photo"
                                    alt="Profile Picture"/>
                                <div class="profile-info">
                                    <h2>
                                        <?php echo e(Auth::user()->firstName); ?>

                                        <?php echo e(Auth::user()->lastName); ?>

                                    </h2>
                                    <h4>
                                        @<span><?php echo e(Auth::user()->username); ?></span>
                                    </h4>
                                    <div class="profile-badge">
                                        <span class="badge">
                                            <?php echo e(Auth::user()->accountType); ?>

                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-right">
                                <div class="profile-stats">
                                    <div class="following-count">
                                        <span>Following:</span>
                                        <span><?php echo e($followingCount); ?></span>
                                    </div>
                                    <div class="follower-count">
                                        <span>Followers:</span>
                                        <span><?php echo e($followerCount); ?></span>
                                    </div>
                                    <a href="account-settings" class="edit-profile-button">
                                        Edit Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="hr1">
                    <div class="profile-nav">
                        <ul>
                            <li id="posts-link"><a >Posts</a></li>
                            <li id="comments-link"><a >Comments and Replies</a></li>
                            <li id="liked-link"><a>Likes</a></li>
                            <li id="bookmarked-link"><a>Bookmarks</a></li>
                        </ul>
                    </div>
                    <hr class="hr2">

                    <div class="profile-content">

                        <?php echo $__env->make('inclusions/profile/profileFollowModal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <?php echo $__env->make('inclusions/profile/profilePosts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <?php echo $__env->make('inclusions/openComments', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <?php echo $__env->make('inclusions/rateCommentModal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <?php echo $__env->make('inclusions/profile/profileCommsReps', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <?php echo $__env->make('inclusions/profile/profileLikes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <?php echo $__env->make('inclusions/profile/profileBookmarks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    </div>

                    <?php echo $__env->make('inclusions/profile/penPostModal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    
                    <?php echo $__env->make('inclusions/createPostModal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                </content>
            </main>
        </div>
        <script src="js/followModal.js"></script>
        <script src="js/postandcomment.js"></script>

        <script src="js/likePost.js"></script>
        <script src="js/bookmarkPost.js"></script>
        <script src="js/commentPost.js"></script>
        <script src="js/replyPost.js"></script>

        <script src="js/followUser.js"></script>
        
        <script src="js/pendingPost.js"></script>

        <script src="js/settings.js"></script>
        <script src="js/profile.js"></script>
        <script src="js/logout.js"></script>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/users/profile.blade.php ENDPATH**/ ?>