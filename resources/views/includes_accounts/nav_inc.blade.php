<aside>
    <div class="top-nav">
        <div class="profile">
            <div class="user-indicator">
                @if (Auth::user()->userPhoto)
                    <img
                        src="{{ Storage::url(Auth::user()->userPhoto) }}"
                        alt="Profile Picture"
                    />
                @else
                    <img src="../../imgs/user-img.png" alt="Profile Picture" />
                @endif
                <label>
                    @
                    <span>{{ Auth::user()->username }}</span>
                </label>
            </div>
        </div>
        <nav>
            <ul>
                <li>
                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"
                    >
                        <i class="fa-solid fa-chart-pie"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a
                        href="{{ route('admin.postpage') }}"
                        class="{{ Request::is('admin/postpage') ? 'active' : '' }}"
                    >
                        <i class="fa-solid fa-envelope-open-text"></i>
                        <span>Posts</span>
                    </a>
                </li>

                <li>
                    <a
                        href="{{ route('admin.account') }}"
                        class="{{ Request::is('admin/account') ? 'active' : '' }}"
                    >
                        <i class="fa-solid fa-user-gear"></i>
                        <span>Accounts</span>
                    </a>
                </li>
                <li>
                    <a
                        href="{{ route('admin.forums') }}"
                        class="{{ Request::is('admin/forums') ? 'active' : '' }}"
                    >
                        <i class="fa-solid fa-users"></i>
                        <span>Forums</span>
                    </a>
                </li>
                <li>
                    <a
                        href="{{ route('admin.systemcontent') }}"
                        class="{{ Request::is('admin/faqs') ? 'active' : '' }}"
                    >
                        <i class="fa-solid fa-circle-question"></i>
                        <span>System Content</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="bottom-nav">
        <a href="javascript:void(0);" id="logout-link" class="logout">
            <i class="fa-solid fa-circle-question"></i>
            <span>Log out</span>
        </a>
        <form
            id="logout-form"
            action="{{ route('logoutAdMod') }}"
            method="POST"
            style="display: none"
        >
            @csrf
        </form>
    </div>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuIcon = document.querySelector('.header-top .fa-bars');
        const asideMenu = document.querySelector('aside');

        function handleMenu() {
            if (window.innerWidth <= 1024) {
                // Toggle the expanded state with transition on click
                menuIcon.addEventListener('click', function (event) {
                    event.stopPropagation(); // Prevents event from bubbling to the document
                    asideMenu.classList.toggle('expanded'); // Toggle expanded class for smooth transition
                    asideMenu.style.display = 'block'; // Ensure it's visible
                });

                // Hide aside menu when clicking outside
                document.addEventListener('click', function (event) {
                    if (
                        window.innerWidth <= 1024 &&
                        !asideMenu.contains(event.target) &&
                        !menuIcon.contains(event.target)
                    ) {
                        asideMenu.style.display = 'none'; // Hide the sidebar if clicked outside
                        asideMenu.classList.remove('expanded'); // Reset to collapsed state
                    }
                });
            } else {
                asideMenu.style.display = 'block';
                asideMenu.classList.add('expanded');
            }
        }

        handleMenu();

        window.addEventListener('resize', function () {
            if (window.innerWidth > 1024) {
                asideMenu.style.display = 'block';
                asideMenu.classList.add('expanded');
            } else {
                asideMenu.style.display = 'none';
                asideMenu.classList.remove('expanded');
                handleMenu();
            }
        });
    });
</script>

<!-- Include SweetAlert and logout.js -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/logout.js') }}"></script>
