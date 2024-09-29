<div class="top-nav">
    <div class="profile">
        <div class="user-indicator">
            <img
                src="<?php echo e(Auth::user()->userPhoto ? asset('storage/' . Auth::user()->userPhoto) : asset('imgs/koi fish.png')); ?>"
                alt="Profile Picture"
            />
            <label><?php echo e('@' . Auth::user()->username); ?></label>
        </div>
    </div>
    <nav>
        <ul>
            <li>
                <a href="<?php echo e(route('moderator.dashboard')); ?>">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('moderator.postpage')); ?>">
                    <i class="fa-solid fa-envelope-open-text"></i>
                    <span>Posts</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('moderator.leaderboards')); ?>">
                    <i class="fa-solid fa-chart-simple"></i>
                    <span>Leaderboards</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('moderator.resources')); ?>">
                    <i class="fa-solid fa-folder"></i>
                    <span>Resources</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('moderator.account')); ?>" class="current">
                    <i class="fa-solid fa-user-gear"></i>
                    <span>Accounts</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('moderator.forums')); ?>">
                    <i class="fa-solid fa-users"></i>
                    <span>Forums</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('moderator.faqs')); ?>">
                    <i class="fa-solid fa-circle-question"></i>
                    <span>FAQs</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
<div class="bottom-nav">
    <a href="<?php echo e(route('logoutAdMod')); ?>" class="logout" id="logout-link">
        <i class="fa-solid fa-right-from-bracket"></i>
        <span>Log out</span>
    </a>

    <!-- Hidden form to handle the logout request -->
    <form
        id="logout-form"
        action="<?php echo e(route('logoutAdMod')); ?>"
        method="POST"
        style="display: none"
    >
        <?php echo csrf_field(); ?>
    </form>
</div>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_accounts/mod_nav_inc.blade.php ENDPATH**/ ?>