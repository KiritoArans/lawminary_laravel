<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lawminary | <?php echo e($activeForum->forumName); ?></title>
    <link rel="icon" href="/imgs/lawminarylogo_v3.png" type="image/png">
    <link rel="stylesheet" href="<?php echo e(asset ('css/forums_style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset ('css/nav_style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/otherstyles/posts_style.css')); ?>" />
    <?php echo $__env->make('inclusions/libraryLinks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
    <div class="container">
      <?php echo $__env->make('inclusions/userNav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <main>
        <header>
          <div class="header-top">
            <img src="../imgs/Lawminary_Logo_2-Gold.png" alt="" />
            <div class="notification">
              <a href="notifications"><i class="fas fa-bell bell-icon"></i></a>
            </div>
          </div>
          <hr class="divider" />
        </header>

        <div class="header-buttons-search">
          <div class="header-buttons">
            <button id="postsTab" class="posts-tab">Posts</button>
            <button id="forumsTab" class="forums-tab current-tab">Forums</button>
            <button id="articlesTab" class="articles-tab">Article</button>
            <button id="leaderboardsTab" class="leaderboards-tab">Leaderboards</button>
          </div>    
          <button id="showForumLists">See Forum Lists</button> 
        </div>

        <div class="content-wrapper">
          <div class="forum-left">
            <div class="forum-overview">

              <section class="forum-section">
                <div class="forum-active">
                  <div class="circle">
                    <img class="images" src="<?php echo e(Storage::url($activeForum->forumPhoto)); ?>" alt="<?php echo e($activeForum->forumName); ?>"/>
                  </div>
                  <div class="forum-details">
                    <h2><?php echo e($activeForum->forumName); ?></h2>
                    <p><?php echo e($activeForum->membersCount ?? 0); ?> Members</p>
                    <p><?php echo e($activeForum->forumDesc); ?></p>
                    <input type="hidden" id="forumIdInput" value="<?php echo e($activeForum->forum_id); ?>" readonly>
                  </div>
                </div>
              
                <form action="<?php echo e(route('forum.join')); ?>" method="POST">
                  <?php echo csrf_field(); ?>
                  <?php echo $__env->make('inclusions/response', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  <input type="hidden" name="forum_id" value="<?php echo e($activeForum->forum_id); ?>">
                  <button class="join-button <?php echo e($joinedVF ? 'joined-button' : ''); ?>" type="submit"><?php echo e($joinedVF ? 'Joined' : 'Join'); ?></button>
                </form>
              </section>
            </div>

            <?php if($joinedVF): ?>
              <div class="create-post">
                <form action="<?php echo e(route('createForumPost')); ?>" method="POST" enctype="multipart/form-data">
                  <?php echo csrf_field(); ?>
                  <?php echo $__env->make('inclusions/response', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  <input type="hidden" name="forum_id" value="<?php echo e($activeForum->forum_id); ?>">
                  <img src="<?php echo e(Auth::user()->userPhoto ? Storage::url(Auth::user()->userPhoto) : asset('imgs/user-img.png')); ?>" class="user-profile-photo" alt="Profile Picture"/>
                  <textarea name="concern" id="" cols="30" rows="10" placeholder="What's on your mind?"></textarea>
                  <label for="file-upload" class="custom-file-upload">
                      <i class="fa-solid fa-file-arrow-up" title="Attach Photo"></i>
                  </label>
                  <input id="file-upload" type="file" name="concernPhoto" style="display: none;">
                  <button>Post</button>
                </form>
              </div>
            <?php endif; ?>

            <div class="posts">
              <?php if($posts->isEmpty()): ?>
                  <p class="empty2">No posts available for this forum.</p>
              <?php else: ?>
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
                                    <!-- If the post belongs to the authenticated user, show the Delete button -->
                                    <button onclick="confirmDelete('<?php echo e($post->post_id); ?>')" class="btn-delete">
                                        Delete
                                    </button>
                                    <form id="delete-form-<?php echo e($post->post_id); ?>" action="<?php echo e(route('forumPost.delete', $post->post_id)); ?>" method="POST" style="display: none;">
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

                  <?php echo $__env->make('inclusions/openComments', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
            </div>
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
          
              <div class="forum-pagination">
                <button id="prev">Previous</button>
                <span id="page-num">1</span>
                <button id="next">Next</button>
              </div>
              <div class="forum-list">
                <a href="">See Other Forums</a>
              </div>
            </section>
          </div>
          
        </div>

        <?php echo $__env->make('inclusions/rateCommentModal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->make('inclusions/reportPostModal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

      </main>
    </div>

    <script src="js/user_js/forums.js"></script>
    
    <script src="js/reportPost.js"></script>

    <script src="js/postandcomment.js"></script>
    <script src="js/likePost.js"></script>
    <script src="js/bookmarkPost.js"></script>
    <script src="js/commentPost.js"></script>
    <script src="js/replyPost.js"></script>

    <script src="js/followUser.js"></script>

    <script src="js/homelocator.js"></script>
    <script src="js/settings.js"></script>    
    <script src="js/logout.js"></script>

  </body>
</html>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/users/visit_forums.blade.php ENDPATH**/ ?>