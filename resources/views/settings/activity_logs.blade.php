<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Settings</title>
    <link rel="icon" href="../../imgs/lawminarylogo.png" type="image/png">
    <link rel="stylesheet" href="{{ asset ('css/settings/activity_logs_style.css') }}">
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
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </aside>
        <main>
            <header>
                <div class="header-top">
                    <img src="../../imgs/Lawminary_Logo_2-Gold.png" alt="Lawminary Logo">
                    <div class="notification">
                        <a href="../notifications"><i class="fas fa-bell bell-icon"></i></a>
                    </div>
                </div>
                <hr class="divider">
            </header>
            <content>
                <div class="logs">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Activity</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2024-06-14</td>
                                <td>Like</td>
                                <td>You liked a post by John Doe</td>
                            </tr>
                            <tr>
                                <td>2024-06-13</td>
                                <td>Comment</td>
                                <td>You commented on a post by Jane Smith</td>
                            </tr>
                            <tr>
                                <td>2024-06-12</td>
                                <td>Post</td>
                                <td>You created a new post</td>
                            </tr>
                            <tr>
                                <td>2024-06-11</td>
                                <td>Share</td>
                                <td>You shared a post by Alex Brown</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </content>
        </main>
    </div>
    <script src="../js/settings.js"></script>
    <script src="../js/logout.js"></script>
</body>
</html>
