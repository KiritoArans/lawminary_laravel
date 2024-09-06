<aside>
    <div class="top-nav">
        <div class="profile">
            <div class="user-indicator">
                @if(Auth::user()->userPhoto)
                    <img src="{{ Storage::url(Auth::user()->userPhoto) }}" alt="Profile Picture">
                @else
                    <img src="../../imgs/user-img.png" alt="Profile Picture">
                @endif
                <label>@<span>{{ Auth::user()->username }}</span></label>
            </div>
        </div>                
        <nav>
            <ul>
                <li>
                    <a href="home" class="{{ Request::is('home', 'article', 'forums') ? 'active' : '' }}">
                        <i class="fa-solid fa-house"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="search" class="{{ Request::is('search') ? 'active' : '' }}">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <span>Search</span>
                    </a>
                </li>
                <li>
                    <a href="resources" class="{{ Request::is('resources') ? 'active' : '' }}">
                        <i class="fa-solid fa-folder"></i>
                        <span>Resources</span>
                    </a>
                </li>
                <li>
                    <a href="profile" class="{{ Request::is('profile') ? 'active' : '' }}">
                        <i class="fa-solid fa-user"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li>
                    <a onclick="toggleDropdown(event)" 
                        class="{{ Request::is(
                            'about-lawminary', 
                            'about-pao', 
                            'account-settings', 
                            'activitylogs', 
                            'provide-feedback', 
                            'terms-of-service') ? 'active' : '' }}">
                        <i class="fa-solid fa-gear"></i>
                        <span>Settings</span>
                    </a>
                    <div id="settingsDropdown" class="dropdown-content">
                        <ul>
                            <li><a href="about-lawminary">About Lawminary</a></li>
                            <li><a href="about-pao">About PAO</a></li>
                            <li><a href="account-settings">Account Settings</a></li>
                            <li><a href="activitylogs">Activity Logs</a></li>
                            <li><a href="provide-feedback">Provide Feedback</a></li>
                            <li><a href="terms-of-service">Terms of Service</a></li>
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
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</aside>
