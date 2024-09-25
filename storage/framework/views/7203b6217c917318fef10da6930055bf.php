<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lawminary | Forums</title>
    <link rel="icon" href="/imgs/lawminarylogo.png" type="image/png">
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
          </div>    
          <button id="showForumLists">See Forum Lists</button> 
        </div>

        <div class="content-wrapper">
          <div class="forum-left">
            <div class="forum-overview">

              

              <section class="forum-section">
                <div class="forum-active">
                  <div class="circle">
                    <img class="images" src="" alt=""/>
                  </div>
                  <div class="forum-details">
                    <h2>Forum name</h2>
                    <p>Members: #</p>
                    <p>Forum desc</p>
                    <input type="text" id="forumIdInput" value="" readonly>
                  </div>
                </div>
              
                <button class="join-button">Join</button>
              </section>
              

              <hr>

              <div class="posts">
                    <div class="post-content">
                        <div class="post-header">
                            <div class="user-info">
                                <img src="../imgs/user-img.png" alt="Profile Picture" class="user-profile-photo"/>
                                <div class="post-info">
                                    <h2>Some Name</h2> <!-- Assuming postedBy is the user's name -->
                                    <p>@username</p> <!-- Adjust this to display the user's username if available -->
                                </div>
                            </div>
                            <div class="post-options">
                                <div class="options" style="display: none"><a href="#">Action</a></div>
                                <i class="fas fa-ellipsis-v"></i>
                            </div>
                        </div>
                        <hr />
                        <div class="post-text">
                            <p>Concern</p> <!-- Post content -->
                        </div>
                        <hr />
                        <div class="actions">
                            <button><i class="fa-solid fa-gavel"></i> Hit</button>
                            <button><i class="fas fa-comment"></i> Comment</button>
                            <button><i class="fas fa-bookmark"></i> Bookmark</button>
                        </div>
                    </div>
              </div>
            

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
          
              <?php $__currentLoopData = $forums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $forum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('visit.forum', $forum->forum_id)); ?>" class="forum-link">
                  <div class="forum" 
                    data-forum-id="<?php echo e($forum->forum_id); ?>"
                    data-forum-name="<?php echo e($forum->forumName); ?>"
                    data-forum-members="<?php echo e($forum->members ?? 0); ?>"
                    data-forum-desc="<?php echo e($forum->forumDesc); ?>"
                    data-forum-photo="<?php echo e(Storage::url($forum->forumPhoto)); ?>">
                    <img src="<?php echo e(Storage::url($forum->forumPhoto)); ?>" alt="">
                    <div class="forum-status">
                        <span>Joined</span>
                    </div>
                    <div class="forum-head">
                        <h3><?php echo e($forum->forumName); ?></h3>
                        <h5>Members: <?php echo e($forum->members ?? 0); ?></h5>
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
      </main>
    </div>

    
    <script src="js/user_js/forums.js"></script>
    <script src="js/homelocator.js"></script>
    <script src="js/settings.js"></script>    
    <script src="js/logout.js"></script>
    <script src="js/postandcomment.js"></script>
  </body>
</html>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/users/forums.blade.php ENDPATH**/ ?>