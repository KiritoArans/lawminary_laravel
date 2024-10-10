<div class="top-nav">
    <!-- Burger Menu Icon -->
    <div class="burger-menu" id="burgerToggle">
        <i class="fa-solid fa-bars"></i>
        <!-- FontAwesome icon for the burger -->
    </div>
    <!-- Profile Section -->

    <!-- Navigation Links (Hidden by default on mobile) -->
    <nav id="navList">
        <div class="profile">
            <div class="user-indicator">
                <img
                    src="<?php echo e(Auth::user()->userPhoto ? asset('storage/' . Auth::user()->userPhoto) : asset('imgs/koi fish.png')); ?>"
                    alt="Profile Picture"
                />
                <label><?php echo e('@' . Auth::user()->username); ?></label>
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
                    <i class="fa-solid fa-display"></i>
                    <span>System Content</span>
                </a>
            </li>
            <div class="bottom-nav">
                <a
                    href="<?php echo e(route('logoutAdMod')); ?>"
                    id="logout-link"
                    class="logout"
                >
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
        </ul>
    </nav>
</div>

<!-- Bottom Navigation for Logout -->

<!-- Include SweetAlert and logout.js -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo e(asset('js/logout.js')); ?>"></script>

<!-- JavaScript for Burger Menu Toggle -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const burgerToggle = document.getElementById('burgerToggle');
        const navList = document.getElementById('navList');

        burgerToggle.addEventListener('click', function () {
            navList.classList.toggle('show');
        });

        // Optional: Close nav if clicked outside of it
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
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_accounts/nav_inc.blade.php ENDPATH**/ ?>