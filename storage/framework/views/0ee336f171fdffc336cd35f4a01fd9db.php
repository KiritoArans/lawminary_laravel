<aside>
    <div class="top-nav">
        <div class="profile">
            <div class="user-indicator">
                <?php if(Auth::user()->userPhoto): ?>
                    <img src="<?php echo e(Storage::url(Auth::user()->userPhoto)); ?>" alt="Profile Picture">
                <?php else: ?>
                    <img src="../../imgs/user-img.png" alt="Profile Picture">
                <?php endif; ?>
                <label>@<span><?php echo e(Auth::user()->username); ?></span></label>
            </div>
        </div>                
        <nav>
            <ul>
                <li>
                    <a href="home" class="<?php echo e(Request::is('home', 'article', 'forums', 'leaderboards') ? 'active' : ''); ?>">
                        <i class="fa-solid fa-house"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="search-law" class="<?php echo e(Request::is('search-law') ? 'active' : ''); ?>">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span>Search Law</span>
                    </a>
                </li>
                <li>
                    <a href="resources" class="<?php echo e(Request::is('resources') ? 'active' : ''); ?>">
                        <i class="fa-solid fa-folder"></i>
                        <span>Resources</span>
                    </a>
                </li>
                <li>
                    <a href="profile" class="<?php echo e(Request::is('profile') ? 'active' : ''); ?>">
                        <i class="fa-solid fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li>
                    <a onclick="toggleDropdown(event)" 
                        class="<?php echo e(Request::is(
                            'about-lawminary', 
                            'about-pao', 
                            'account-settings', 
                            'activitylogs', 
                            'provide-feedback', 
                            'terms-of-service') ? 'active' : ''); ?>">
                        <i class="fa-solid fa-gear"></i>
                        <span>Settings</span>
                    </a>
                    <div id="settingsDropdown" class="dropdown-content">
                        <ul>
                            <li><a href="about-lawminary" class="<?php echo e(Request::is('about-lawminary') ? 'active' : ''); ?>">About Lawminary</a></li>
                            <li><a href="about-pao" class="<?php echo e(Request::is('about-pao') ? 'active' : ''); ?>">About PAO</a></li>
                            <li><a href="account-settings" class="<?php echo e(Request::is('account-settings') ? 'active' : ''); ?>">Account Settings</a></li>
                            <li><a href="activitylogs" class="<?php echo e(Request::is('activitylogs') ? 'active' : ''); ?>">Activity Logs</a></li>
                            <li><a href="provide-feedback" class="<?php echo e(Request::is('provide-feedback') ? 'active' : ''); ?>">Provide Feedback</a></li>
                            <li><a href="terms-of-service" class="<?php echo e(Request::is('terms-of-service') ? 'active' : ''); ?>">Terms of Service</a></li>
                        </ul>
                    </div>
                </li>                    
            </ul>
        </nav>
    </div>
    <div class="bottom-nav">
        <a class="logout" id="logout-link">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Log out</span>
        </a>
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
            <?php echo csrf_field(); ?>
        </form>
    </div>
</aside>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/inclusions/userNav.blade.php ENDPATH**/ ?>