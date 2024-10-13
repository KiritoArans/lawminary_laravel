<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Notifications</title>
    <link rel="icon" href="../imgs/lawminarylogo_v3.png" type="image/png">
    <link rel="stylesheet" href="<?php echo e(asset ('css/notification_style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset ('css/nav_style.css')); ?>">
    <?php echo $__env->make('inclusions/libraryLinks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
    <div class="container">
        <?php echo $__env->make('inclusions/userNav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <main>
            <header>
                <div class="header-top">
                    <img src="../imgs/Lawminary_Logo_2-Gold.png" alt="">
                    <div class="notification">
                        <a href="notifications"><i class="fas fa-bell bell-icon current"></i></a>
                    </div>
                </div>
                <hr class="divider">
            </header>
            <content>
                <h1>Notifications</h1>

                <?php if($notificationsWithUsers->isEmpty()): ?>
                    <p class="empty-data">No notifications yet.</p>
                <?php else: ?>

                <?php $__currentLoopData = $notificationsWithUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $notification = $item['notification'];
                        $liker = $item['liker'];
                        $bookmarker = $item['bookmarker'];
                        $commenter = $item['commenter'];
                        $replier = $item['replier'];
                        $rater = $item['rater'];
                        $follower = $item['follower'];
                    ?>
            
                    <!-- If the notification has a liker -->
                    <?php if($liker): ?>
                        <div class="notifs btn-comment" data-post-id="<?php echo e($notification->data['post_id']); ?>">
                            <div class="notifs-content">
                                <div class="user-info">
                                    <img src="<?php echo e($liker->userPhoto ? Storage::url($liker->userPhoto) : asset('imgs/user-img.png')); ?>" alt="Profile Picture" class="user-profile-photo" />
            
                                    <div class="notifs-info">
                                        <h2>
                                            <a href="<?php echo e(Auth::check() && Auth::user()->user_id == $liker->user_id ? route('profile') : route('visit-profile', ['user_id' => $liker->user_id])); ?>">
                                                <?php echo e($liker->firstName); ?> <?php echo e($liker->lastName); ?>

                                            </a>
                                        </h2>
                                        <p>@<span><?php echo e($liker->username); ?></span></p>
                                    </div>
                                </div>
                                <div class="notifs-divider"></div>
                                <div class="notifs-action">
                                    <span><?php echo e($liker->firstName); ?> <?php echo e($notification->data['message']); ?></span>
                                </div>
                                <span class="notifs-date"><?php echo e($notification->created_at->diffForHumans()); ?></span>
                            </div>
                        </div>
                    <?php endif; ?>
            
                    <!-- If the notification has a bookmarker -->
                    <?php if($bookmarker): ?>
                        <div class="notifs btn-comment" data-post-id="<?php echo e($notification->data['post_id']); ?>">
                            <div class="notifs-content">
                                <div class="user-info">
                                    <img src="<?php echo e($bookmarker->userPhoto ? Storage::url($bookmarker->userPhoto) : asset('imgs/user-img.png')); ?>" alt="Profile Picture" class="user-profile-photo" />
            
                                    <div class="notifs-info">
                                        <h2>
                                            <a href="<?php echo e(Auth::check() && Auth::user()->user_id == $bookmarker->user_id ? route('profile') : route('visit-profile', ['user_id' => $bookmarker->user_id])); ?>">
                                                <?php echo e($bookmarker->firstName); ?> <?php echo e($bookmarker->lastName); ?>

                                            </a>
                                        </h2>
                                        <p>@<span><?php echo e($bookmarker->username); ?></span></p>
                                    </div>
                                </div>
                                <div class="notifs-divider"></div>
                                <div class="notifs-action">
                                    <span><?php echo e($bookmarker->firstName); ?> <?php echo e($notification->data['message']); ?></span>
                                </div>
                                <span class="notifs-date"><?php echo e($notification->created_at->diffForHumans()); ?></span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if($commenter): ?>
                        <div class="notifs btn-comment" data-post-id="<?php echo e($notification->data['post_id']); ?>">
                            <div class="notifs-content">
                                <div class="user-info">
                                    <img src="<?php echo e($commenter->userPhoto ? Storage::url($commenter->userPhoto) : asset('imgs/user-img.png')); ?>" alt="Profile Picture" class="user-profile-photo" />
            
                                    <div class="notifs-info">
                                        <h2>
                                            <a href="<?php echo e(Auth::check() && Auth::user()->user_id == $commenter->user_id ? route('profile') : route('visit-profile', ['user_id' => $commenter->user_id])); ?>">
                                                <?php echo e($commenter->firstName); ?> <?php echo e($commenter->lastName); ?>

                                            </a>
                                        </h2>
                                        <p>@<span><?php echo e($commenter->username); ?></span></p>
                                    </div>
                                </div>
                                <div class="notifs-divider"></div>
                                <div class="notifs-action">
                                    <span><?php echo e($commenter->firstName); ?> <?php echo e($notification->data['message']); ?></span>
                                </div>
                                <span class="notifs-date"><?php echo e($notification->created_at->diffForHumans()); ?></span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if($replier): ?>
                        <div class="notifs btn-comment">
                            <div class="notifs-content">
                                <div class="user-info">
                                    <img src="<?php echo e($replier->userPhoto ? Storage::url($replier->userPhoto) : asset('imgs/user-img.png')); ?>" alt="Profile Picture" class="user-profile-photo" />
            
                                    <div class="notifs-info">
                                        <h2>
                                            <a href="<?php echo e(Auth::check() && Auth::user()->user_id == $replier->user_id ? route('profile') : route('visit-profile', ['user_id' => $replier->user_id])); ?>">
                                                <?php echo e($replier->firstName); ?> <?php echo e($replier->lastName); ?>

                                            </a>
                                        </h2>
                                        <p>@<span><?php echo e($replier->username); ?></span></p>
                                    </div>
                                </div>
                                <div class="notifs-divider"></div>
                                <div class="notifs-action">
                                    <span><?php echo e($replier->firstName); ?> <?php echo e($notification->data['message']); ?></span>
                                </div>
                                <span class="notifs-date"><?php echo e($notification->created_at->diffForHumans()); ?></span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if($rater): ?>
                        <div class="notifs btn-comment">
                            <div class="notifs-content">
                                <div class="user-info">
                                    <img src="<?php echo e($rater->userPhoto ? Storage::url($rater->userPhoto) : asset('imgs/user-img.png')); ?>" alt="Profile Picture" class="user-profile-photo" />
            
                                    <div class="notifs-info">
                                        <h2>
                                            <a href="<?php echo e(Auth::check() && Auth::user()->user_id == $rater->user_id ? route('profile') : route('visit-profile', ['user_id' => $rater->user_id])); ?>">
                                                <?php echo e($rater->firstName); ?> <?php echo e($rater->lastName); ?>

                                            </a>
                                        </h2>
                                        <p>@<span><?php echo e($rater->username); ?></span></p>
                                    </div>
                                </div>
                                <div class="notifs-divider"></div>
                                <div class="notifs-action">
                                    <span><?php echo e($rater->firstName); ?> <?php echo e($notification->data['message']); ?></span>
                                </div>
                                <span class="notifs-date"><?php echo e($notification->created_at->diffForHumans()); ?></span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if($follower): ?>
                        <div class="notifs btn-comment">
                            <div class="notifs-content">
                                <div class="user-info">
                                    <img src="<?php echo e($follower->userPhoto ? Storage::url($follower->userPhoto) : asset('imgs/user-img.png')); ?>" alt="Profile Picture" class="user-profile-photo" />
            
                                    <div class="notifs-info">
                                        <h2>
                                            <a href="<?php echo e(Auth::check() && Auth::user()->user_id == $follower->user_id ? route('profile') : route('visit-profile', ['user_id' => $follower->user_id])); ?>">
                                                <?php echo e($follower->firstName); ?> <?php echo e($follower->lastName); ?>

                                            </a>
                                        </h2>
                                        <p>@<span><?php echo e($follower->username); ?></span></p>
                                    </div>
                                </div>
                                <div class="notifs-divider"></div>
                                <div class="notifs-action">
                                    <span><?php echo e($follower->firstName); ?> <?php echo e($notification->data['message']); ?></span>
                                </div>
                                <span class="notifs-date"><?php echo e($notification->created_at->diffForHumans()); ?></span>
                            </div>
                        </div>
                    <?php endif; ?>
            
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </content>
            
            
        </main>
    </div>
    
    <script src="../js/settings.js"></script>    
    <script src="js/logout.js"></script>
</body>
</html><?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/users/notification.blade.php ENDPATH**/ ?>