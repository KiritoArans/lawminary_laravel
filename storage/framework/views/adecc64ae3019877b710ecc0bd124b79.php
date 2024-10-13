<aside>
    <!-- Burger Menu for Mobile and Tablet -->
    <div class="burger-menu" id="burgerToggle">
        <i class="fa-solid fa-bars"></i>
    </div>

    <!-- Mobile and Tablet Navigation -->
    <nav id="navList">
        <div class="profile">
            <div class="user-indicator">
                <?php if(Auth::user()->userPhoto): ?>
                    <img
                        src="<?php echo e(Storage::url(Auth::user()->userPhoto)); ?>"
                        alt="Profile Picture"
                    />
                <?php else: ?>
                    <img src="../../imgs/user-img.png" alt="Profile Picture" />
                <?php endif; ?>
                <label>
                    @
                    <span><?php echo e(Auth::user()->username); ?></span>
                </label>
            </div>
        </div>
        <ul>
            <li>
                <a href="<?php echo e(route('admin.dashboard')); ?>">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('admin.postpage')); ?>">
                    <i class="fa-solid fa-envelope-open-text"></i>
                    <span>Posts</span>
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('admin.account')); ?>" class="current">
                    <i class="fa-solid fa-user-gear"></i>
                    <span>Accounts</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('admin.forums')); ?>">
                    <i class="fa-solid fa-users"></i>
                    <span>Forums</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('admin.systemcontent')); ?>">
                    <i class="fa-solid fa-circle-question"></i>
                    <span>System Content</span>
                </a>
            </li>
        </ul>
        <div class="bottom-nav-burger">
            <a href="javascript:void(0);" id="logout-link" class="logout">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Log out</span>
            </a>
            <form
                id="logout-form"
                action="<?php echo e(route('logoutAdMod')); ?>"
                method="POST"
                style="display: none"
            >
                <?php echo csrf_field(); ?>
            </form>
        </div>
    </nav>

    <!-- Desktop Sidebar Navigation -->
    <div class="mod-nav">
        <div class="profile">
            <div class="user-indicator">
                <?php if(Auth::user()->userPhoto): ?>
                    <img
                        src="<?php echo e(Storage::url(Auth::user()->userPhoto)); ?>"
                        alt="Profile Picture"
                    />
                <?php else: ?>
                    <img src="../../imgs/user-img.png" alt="Profile Picture" />
                <?php endif; ?>
                <label>
                    @
                    <span><?php echo e(Auth::user()->username); ?></span>
                </label>
            </div>
        </div>
        <ul>
            <li>
                <a href="<?php echo e(route('admin.dashboard')); ?>">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('admin.postpage')); ?>">
                    <i class="fa-solid fa-envelope-open-text"></i>
                    <span>Posts</span>
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('admin.account')); ?>" class="current">
                    <i class="fa-solid fa-user-gear"></i>
                    <span>Accounts</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('admin.forums')); ?>">
                    <i class="fa-solid fa-users"></i>
                    <span>Forums</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('admin.systemcontent')); ?>">
                    <i class="fa-solid fa-circle-question"></i>
                    <span>System Content</span>
                </a>
            </li>
        </ul>
        <div class="bottom-nav">
            <a href="javascript:void(0);" id="logout-link-nav" class="logout">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Log out</span>
            </a>
            <form
                id="logout-form"
                action="<?php echo e(route('logoutAdMod')); ?>"
                method="POST"
                style="display: none"
            >
                <?php echo csrf_field(); ?>
            </form>
        </div>
    </div>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const burgerToggle = document.getElementById('burgerToggle');
        const navList = document.getElementById('navList');

        burgerToggle.addEventListener('click', function () {
            navList.classList.toggle('show');
        });

        // Close nav if clicked outside
        document.addEventListener('click', function (event) {
            if (
                !navList.contains(event.target) &&
                !burgerToggle.contains(event.target)
            ) {
                navList.classList.remove('show');
            }
        });
    });
</script>

<!-- Include SweetAlert and logout.js -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo e(asset('js/logout.js')); ?>"></script>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_accounts/nav_inc.blade.php ENDPATH**/ ?>