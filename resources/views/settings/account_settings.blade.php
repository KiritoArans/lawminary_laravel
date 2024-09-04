<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Account Settings</title>
    <link rel="icon" href="../../imgs/lawminarylogo.png" type="image/png">
    <link rel="stylesheet" href="{{ asset ('css/settings/account-settings_style.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/nav_style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="{{ asset('js/library_js/sweetalertV2.js') }}"></script>
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
                <a class="logout" href="../login"><i class="fa-solid fa-right-from-bracket"></i><span>Log out</span></a>
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
                <div class="settings-container">
                    <div class="settings-menu">
                        <ul>
                            <li><a href="#" class="active" data-tab="general">General</a></li>
                            <li><a href="#" data-tab="change-password">Change Password</a></li>
                            <li><a href="#" data-tab="info">Info</a></li>
                        </ul>
                    </div>
                    <div class="settings-content">
                        <div id="general" class="tab-content active">
                            <h2>General</h2>

                            <form method="POST" action="{{ route('settings.updateAccountNames') }}" enctype="multipart/form-data">
                                @csrf
                                @include('displayError')

                                <div class="profile-pic">
                                    @if(Auth::user()->userPhoto)
                                    <img id="profileImagePreview" src="{{ Storage::url(Auth::user()->userPhoto) }}" alt="User Photo">
                                    @else
                                        <img id="profileImagePreview" src="../../imgs/user-img.png" alt="Profile Picture">
                                    @endif
                                    
                                    <input type="file" name="userPhoto" id="userPhotoInput">

                                    <p>Allowed JPG, GIF or PNG. Max size of 800K</p>
                                </div>
                            
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" value="{{ Auth::user()->username }}">
                            
                                <label for="firstName">First Name</label>
                                <input type="text" id="firstName" name="firstName" value="{{ Auth::user()->firstName }}">
                            
                                <label for="middleName">Middle Name</label>
                                <input type="text" id="middleName" name="middleName" value="{{ Auth::user()->middleName }}">
                            
                                <label for="lastName">Last Name</label>
                                <input type="text" id="lastName" name="lastName" value="{{ Auth::user()->lastName }}">
                            
                                <div class="action-button">
                                    <button type="button" onclick="window.location.href='{{ url()->previous() }}'">Cancel</button>
                                    <button type="submit">Save changes</button>
                                </div>
                            </form>

                        </div>
                        <div id="change-password" class="tab-content">
                            <h2>Change Password</h2>

                            <form id="password-change-form" method="POST" action="{{ route('settings.changePassword') }}">
                                @csrf
                                @include('displayError')

                                <label for="current-password">Current Password</label>
                                <input type="password" id="current-password" name="current_password" placeholder="Type your old password" required>
                            
                                <label for="new-password">New Password</label>
                                <input type="password" id="new-password" name="new_password" placeholder="Type your new password" required>
                            
                                <label for="repeat-password">Confirm New Password</label>
                                <input type="password" id="repeat-password" name="new_password_confirmation" placeholder="Confirm new password" required>
                            
                                <div class="action-button">
                                    <button type="button" onclick="window.location.href='{{ url()->previous() }}'">Cancel</button>
                                    <button type="submit">Save changes</button>
                                </div>
                            </form>

                        </div>
                        <div id="info" class="tab-content">
                            <h2>Info</h2>
                            <form method="POST" action="{{ route('settings.updateAccountInfo') }}">
                                @csrf
                                @include('displayError')

                                <label for="bio">Bio</label>
                                <textarea id="bio" name="bio">Some Text</textarea>
                            
                                <label for="birthDate">Birthday</label>
                                <input type="date" id="birthDate" name="birthDate" value="{{ Auth::user()->birthDate }}">
                            
                                <label for="sex">Sex</label>
                                <input type="text" id="sex" name="sex" value="{{ Auth::user()->sex }}" readonly>
                            
                                <label for="nationality">Nationality</label>
                                <input type="text" id="nationality" name="nationality" value="{{ Auth::user()->nationality }}">
                            
                                <label for="contactNumber">Contact Number</label>
                                <input type="text" id="contactNumber" name="contactNumber" value="{{ Auth::user()->contactNumber }}">

                                <label for="email">E-mail</label>
                                <input type="text" id="email" name="email" value="{{ Auth::user()->email }}">
                            
                                <div class="action-button">
                                    <button type="button" onclick="window.location.href='{{ url()->previous() }}'">Cancel</button>
                                    <button type="submit">Save changes</button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </content>
        </main>
    </div>
    <script src="../../js/settings.js"></script>
</body>
</html>