<aside>
    <!-- Burger Menu for Mobile and Tablet -->
    <div class="burger-menu" id="burgerToggle">
        <i class="fa-solid fa-bars"></i>
    </div>

    <!-- Mobile and Tablet Navigation -->
    <nav id="navList">
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
        <ul>
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.postpage') }}">
                    <i class="fa-solid fa-envelope-open-text"></i>
                    <span>Posts</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.account') }}" class="current">
                    <i class="fa-solid fa-user-gear"></i>
                    <span>Accounts</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.forums') }}">
                    <i class="fa-solid fa-users"></i>
                    <span>Forums</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.systemcontent') }}">
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
                action="{{ route('logoutAdMod') }}"
                method="POST"
                style="display: none"
            >
                @csrf
            </form>
        </div>
    </nav>

    <!-- Desktop Sidebar Navigation -->
    <div class="mod-nav">
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
        <ul>
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.postpage') }}">
                    <i class="fa-solid fa-envelope-open-text"></i>
                    <span>Posts</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.account') }}" class="current">
                    <i class="fa-solid fa-user-gear"></i>
                    <span>Accounts</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.forums') }}">
                    <i class="fa-solid fa-users"></i>
                    <span>Forums</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.systemcontent') }}">
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
                action="{{ route('logoutAdMod') }}"
                method="POST"
                style="display: none"
            >
                @csrf
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
<script src="{{ asset('js/logout.js') }}"></script>
