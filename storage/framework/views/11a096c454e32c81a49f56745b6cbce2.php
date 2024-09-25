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
                <li><a href="../home"><i class="fa-solid fa-house"></i><span>Home</span></a></li>
                <li><a href="../search"><i class="fa-solid fa-magnifying-glass"></i><span>Search</span></a></li>
                <li><a href="../resources"><i class="fa-solid fa-folder"></i><span>Resources</span></a></li>
                <li><a href="../profile"><i class="fa-solid fa-user"></i><span>Profile</span></a></li>
                <li>
                    <a class="current" onclick="toggleDropdown(event)"><i class="fa-solid fa-gear"></i><span>Settings</span></a>
                    <div id="settingsDropdown" class="dropdown-content">
                        <ul>
                            <li><a href="lawminary">About Lawminary</a></li>
                            <li><a href="pao">About PAO</a></li>
                            <li><a href="account">Account Settings</a></li>
                            <li><a href="activitylogs">Activity Logs</a></li>
                            <li><a href="feedback">Provide Feedback</a></li>
                            <li><a href="tos">Terms of Service</a></li>
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
</aside><?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/inclusions/settingsNav.blade.php ENDPATH**/ ?>