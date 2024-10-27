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
                        href="{{ route('moderator.dashboard') }}"
                        class="{{ Request::is('moderator/dashboard') ? 'active' : '' }}"
                    >
                        <i class="fa-solid fa-chart-pie"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a
                        href="{{ route('moderator.postpage') }}"
                        class="{{ Request::is('moderator/postpage') ? 'active' : '' }}"
                    >
                        <i class="fa-solid fa-envelope-open-text"></i>
                        <span>Posts</span>
                    </a>
                </li>
                <li>
                    <a
                        href="{{ route('moderator.leaderboards') }}"
                        class="{{ Request::is('moderator/leaderboards') ? 'active' : '' }}"
                    >
                        <i class="fa-solid fa-chart-simple"></i>
                        <span>Leaderboards</span>
                    </a>
                </li>
                <li>
                    <a
                        href="{{ route('moderator.resources') }}"
                        class="{{ Request::is('moderator/resources') ? 'active' : '' }}"
                    >
                        <i class="fa-solid fa-folder"></i>
                        <span>Resources</span>
                    </a>
                </li>
                <li>
                    <a
                        href="{{ route('moderator.account') }}"
                        class="{{ Request::is('moderator/account') ? 'active' : '' }}"
                    >
                        <i class="fa-solid fa-user-gear"></i>
                        <span>Accounts</span>
                    </a>
                </li>
                <li>
                    <a
                        href="{{ route('moderator.forums') }}"
                        class="{{ Request::is('moderator/forums') ? 'active' : '' }}"
                    >
                        <i class="fa-solid fa-users"></i>
                        <span>Forums</span>
                    </a>
                </li>
                <li>
                    <a
                        href="{{ route('moderator.faqs') }}"
                        class="{{ Request::is('moderator/faqs') ? 'active' : '' }}"
                    >
                        <i class="fa-solid fa-circle-question"></i>
                        <span>FAQs</span>
                    </a>
                </li>
                <li>
                    <a
                        href="{{ route('moderator.about-law') }}"
                        class="{{ Request::is('moderator/about-law') ? 'active' : '' }}"
                    >
                        <i class="fa-solid fa-scale-balanced"></i>
                        <span>Laws</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="bottom-nav">
        <a href="javascript:void(0);" id="logout-link" class="logout">
            <i class="fa-solid fa-right-from-bracket"></i>
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
