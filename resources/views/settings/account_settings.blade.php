<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Account Settings</title>
        <link rel="icon" href="../../imgs/lawminarylogo_v3.png" type="image/png" />
        <link
            rel="stylesheet"
            href="{{ asset('css/settings/account-settings_style.css') }}"
        />
        <link rel="stylesheet" href="{{ asset('css/nav_style.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/responsive/navres.css') }}" />
        @include('inclusions/libraryLinks')
    </head>
    <body>
        <div class="container">
            @include('inclusions/userNav')
            <main>
                <header>
                    <div class="header-top">
                        <i class="fa-solid fa-bars"></i>
                        @include('includes_syscon.syscon_logo_inc')
                        <div class="notification">
                            <a href="../notifications" class="notification-link">
                                <i class="fas fa-bell bell-icon current"></i>
                                <span id="notification-count" class="notification-badge"></span>
                            </a>
                        </div>
                    </div>
                    <hr class="divider" />
                </header>
                <content>
                    <div class="settings-container">
                        <div class="settings-menu">
                            <ul>
                                <li>
                                    <a class="active" data-tab="general">
                                        General
                                    </a>
                                </li>
                                <li>
                                    <a data-tab="change-password">
                                        Change Password
                                    </a>
                                </li>
                                <li><a data-tab="info">Info</a></li>
                                
                                <li><a data-tab="delete-account">Delete Account</a></li>
                            </ul>
                        </div>
                        <div class="settings-content">
                            <div id="general" class="tab-content active">
                                <h2>General</h2>

                                <form
                                    method="POST"
                                    action="{{ route('settings.updateAccountNames') }}"
                                    enctype="multipart/form-data"
                                >
                                    @csrf
                                    @include('inclusions/response')
                                    <div class="profile-pic">
                                        <img
                                            id="profileImagePreview"
                                            src="{{ Auth::user()->userPhoto ? Storage::url(Auth::user()->userPhoto) : asset('imgs/user-img.png') }}"
                                            alt="Profile Picture"
                                        />
                                        <div class="profile-pic-info">
                                            <input
                                                type="file"
                                                name="userPhoto"
                                                id="userPhotoInput"
                                            />
                                            <p>
                                                Allowed JPG, GIF or PNG. Max
                                                size of 800K
                                            </p>
                                        </div>
                                    </div>

                                    <label for="username">Username</label>
                                    <input
                                        type="text"
                                        id="username"
                                        name="username"
                                        value="{{ Auth::user()->username }}"
                                    />

                                    <label for="firstName">First Name</label>
                                    <input
                                        type="text"
                                        id="firstName"
                                        name="firstName"
                                        value="{{ Auth::user()->firstName }}"
                                    />

                                    <label for="middleName">Middle Name</label>
                                    <input
                                        type="text"
                                        id="middleName"
                                        name="middleName"
                                        value="{{ Auth::user()->middleName }}"
                                    />

                                    <label for="lastName">Last Name</label>
                                    <input
                                        type="text"
                                        id="lastName"
                                        name="lastName"
                                        value="{{ Auth::user()->lastName }}"
                                    />

                                    <div class="action-button">
                                        <button
                                            type="button"
                                            onclick="window.location.href='{{ url()->previous() }}'"
                                        >
                                            Cancel
                                        </button>
                                        <button type="submit">
                                            Save changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div id="change-password" class="tab-content">
                                <h2>Change Password</h2>

                                <form
                                    id="password-change-form"
                                    method="POST"
                                    action="{{ route('settings.changePassword') }}"
                                >
                                    @csrf
                                    @include('inclusions/response')

                                    <label for="current-password">Current Password</label>
                                    <div class="password-container">
                                        <input
                                            type="password"
                                            id="current-password"
                                            name="current_password"
                                            placeholder="Type your old password"
                                            required
                                        />
                                        <i class="fas fa-eye toggle-password" id="toggleCurrentPassword"></i>
                                    </div>

                                    <label for="new-password">New Password</label>
                                    <div class="password-container">
                                        <input
                                            type="password"
                                            id="new-password"
                                            name="new_password"
                                            placeholder="Type your new password"
                                            required
                                        />
                                        <i class="fas fa-eye toggle-password" id="toggleNewPassword"></i>
                                    </div>

                                    <label for="repeat-password">Confirm New Password</label>
                                    <div class="password-container">
                                        <input
                                            type="password"
                                            id="repeat-password"
                                            name="new_password_confirmation"
                                            placeholder="Confirm new password"
                                            required
                                        />
                                        <i class="fas fa-eye toggle-password" id="toggleRepeatPassword"></i>
                                    </div>

                                    <div class="action-button">
                                        <button type="button" onclick="window.location.href='{{ url()->previous() }}'">
                                            Cancel
                                        </button>
                                        <button type="submit">Save changes</button>
                                    </div>
                                </form>


                            </div>
                            <div id="info" class="tab-content">
                                <h2>Info</h2>
                                <form
                                    method="POST"
                                    action="{{ route('settings.updateAccountInfo') }}"
                                >
                                    @csrf
                                    @include('inclusions/response')

                                    <label for="birthDate">Birthday</label>
                                    <input
                                        type="date"
                                        id="birthDate"
                                        name="birthDate"
                                        value="{{ Auth::user()->birthDate }}"
                                    />

                                    <label for="sex">Sex</label>
                                    <input
                                        type="text"
                                        id="sex"
                                        name="sex"
                                        value="{{ Auth::user()->sex }}"
                                        readonly
                                    />
                                    

                                    <label for="email">E-mail</label>
                                    <input
                                        type="text"
                                        id="email"
                                        name="email"
                                        value="{{ Auth::user()->email }}"
                                        readonly
                                    />

                                    <div class="action-button">
                                        <button
                                            type="button"
                                            onclick="window.location.href='{{ url()->previous() }}'"
                                        >
                                            Cancel
                                        </button>
                                        <button type="submit">
                                            Save changes
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div id="delete-account" class="tab-content">
                                <h2>Delete Account</h2>
                                <form id="deleteAccountForm" method="POST" action="{{ route('deleteAccount') }}">
                                    @csrf
                                    @include('inclusions/response')
                            
                                    <label for="username">Username</label>
                                    <input type="text" 
                                        id="username" 
                                        name="username" 
                                        placeholder="Type your old username" 
                                        required
                                    />
                            
                                    <label for="password">Password</label>
                                    <div class="password-container">
                                        <input
                                            type="password"
                                            id="password"
                                            name="password"
                                            placeholder="Type your old password"
                                            required
                                        />
                                        <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                                    </div>
                            
                                    <div class="note">
                                        <span>Note: You cannot retrieve your account once it's deleted.</span>
                                    </div>
                            
                                    <div class="action-button">
                                        <button type="button" onclick="window.location.href='{{ url()->previous() }}'">Cancel</button>
                                        <button type="submit" id="delete-btn">Delete</button>
                                    </div>
                                </form>
                            </div>
                            
                        </div>

                    </div>
                </content>
            </main>
        </div>
        <script src="js/showUserNav.js"></script>
        <script src="../js/showNotification.js"></script>
        <script src="../js/settings.js"></script>
        <script src="../js/logout.js"></script>
    </body>
</html>
