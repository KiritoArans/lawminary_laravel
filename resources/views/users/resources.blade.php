<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Resources</title>
    <link rel="icon" href="../imgs/lawminarylogo.png" type="image/png">
    <link rel="stylesheet" href="{{ asset ('css/resources_style.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/nav_style.css') }}">
    @include('inclusions/libraryLinks')
</head>
<body>
    <div class="container">
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
                        <li><a href="home"><i class="fa-solid fa-house"></i><span>Home</span></a></li>
                        <li><a href="search"><i class="fa-solid fa-magnifying-glass"></i><span>Search</span></a></li>
                        <li><a href="resources" class="current"><i class="fa-solid fa-folder"></i><span>Resources</span></a></li>
                        <li><a href="profile"><i class="fa-solid fa-user"></i><span>Profile</span></a></li>
                        <li>
                            <a onclick="toggleDropdown(event)"><i class="fa-solid fa-gear"></i><span>Settings</span></a>
                            <div id="settingsDropdown" class="dropdown-content">
                                <ul>
                                    <li><a href="settings/lawminary">About Lawminary</a></li>
                                    <li><a href="settings/pao">About PAO</a></li>
                                    <li><a href="settings/account">Account Settings</a></li>
                                    <li><a href="settings/activitylogs">Activity Logs</a></li>
                                    <li><a href="settings/feedback">Provide Feedback</a></li>
                                    <li><a href="settings/tos">Terms of Service</a></li>
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
        
        <main>
            <header>
                <div class="header-top">
                    <img src="../imgs/Lawminary_Logo_2-Gold.png" alt="">
                    <div class="notification">
                        <a href="notifications"><i class="fas fa-bell bell-icon"></i></a>
                    </div>
                </div>
                <hr class="divider">
                <div class="header-buttons-search">              
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elite.</p>
                    <div class="header-buttons">
                    </div>
                    <div class="search-bar">
                        <input type="text" placeholder="Search for documents">
                        <i class="fas fa-search search-icon"></i>
                    </div>
                </div>
            </header>
            <content>
                <div class="resources-container">
                    <div class="resources-content">
                        <div class="docs">
                            <span>Document</span>
                            <i class="fa-regular fa-bookmark"></i>
                        </div>
                        <a href="" type="download">Click here to download</a>
                    </div>
                    <div class="resources-content">
                        <div class="docs">
                            <span>Document</span>
                            <i class="fa-regular fa-bookmark"></i>
                        </div>
                        <a href="" type="download">Click here to download</a>
                    </div>
                    <div class="resources-content">
                        <div class="docs">
                            <span>Document</span>
                            <i class="fa-regular fa-bookmark"></i>
                        </div>
                        <a href="" type="download">Click here to download</a>
                    </div>
                    <div class="resources-content">
                        <div class="docs">
                            <span>Document</span>
                            <i class="fa-regular fa-bookmark"></i>
                        </div>
                        <a href="" type="download">Click here to download</a>
                    </div>
                    <div class="resources-content">
                        <div class="docs">
                            <span>Document</span>
                            <i class="fa-regular fa-bookmark"></i>
                        </div>
                        <a href="" type="download">Click here to download</a>
                    </div>
                    <div class="resources-content">
                        <div class="docs">
                            <span>Document</span>
                            <i class="fa-regular fa-bookmark"></i>
                        </div>
                        <a href="" type="download">Click here to download</a>
                    </div>
                    <div class="resources-content">
                        <div class="docs">
                            <span>Document</span>
                            <i class="fa-regular fa-bookmark"></i>
                        </div>
                        <a href="" type="download">Click here to download</a>
                    </div>
                </div>          
            </content>
        </main>
    <script src="../js/settings.js"></script>    
    <script src="js/logout.js"></script>
</body>
</html>