<nav>
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
                <i class="fa-solid fa-display"></i>
                <span>System Content</span>
            </a>
        </li>
    </ul>
</nav>
