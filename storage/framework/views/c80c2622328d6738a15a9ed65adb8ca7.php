<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Account Settings</title>
    <link rel="icon" href="../../imgs/lawminarylogo.png" type="image/png">
    <link rel="stylesheet" href="<?php echo e(asset ('css/settings/account-settings_style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset ('css/nav_style.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <aside>
            <div class="top-nav">
                <div class="profile">
                    <div class="user-indicator">
                        <img src="../../imgs/user-img.png" alt="Profile Picture">
                        <label>@<span><?php echo e(Auth::user()->username); ?></span></label>
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
                            <div class="profile-pic">
                                <img src="../../imgs/user-img.png" alt="Profile Picture">
                                <button>Upload new photo</button>
                                <button>Reset</button>
                                <p>Allowed JPG, GIF or PNG. Max size of 800K</p>
                            </div>

                            <form method="POST" action="<?php echo e(route('settings.updateAccountNames')); ?>">
                                <?php echo csrf_field(); ?>
                                <?php if(session('success')): ?>
                                <div class="alert alert-success">
                                    <?php echo e(session('success')); ?>

                                </div>
                                <?php endif; ?>

                                <?php if(session('error')): ?>
                                <div class="error">
                                    <?php echo e(session('error')); ?>

                                </div>
                                <?php endif; ?>

                                <?php if($errors->any()): ?>
                                <div class="error">
                                    <ul>
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                                <?php endif; ?>
                            
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" value="<?php echo e(Auth::user()->username); ?>">
                            
                                <label for="firstName">First Name</label>
                                <input type="text" id="firstName" name="firstName" value="<?php echo e(Auth::user()->firstName); ?>">
                            
                                <label for="middleName">Middle Name</label>
                                <input type="text" id="middleName" name="middleName" value="<?php echo e(Auth::user()->middleName); ?>">
                            
                                <label for="lastName">Last Name</label>
                                <input type="text" id="lastName" name="lastName" value="<?php echo e(Auth::user()->lastName); ?>">
                            
                                <div class="action-button">
                                    <button type="button" onclick="window.location.href='<?php echo e(url()->previous()); ?>'">Cancel</button>
                                    <button type="submit">Save changes</button>
                                </div>
                            </form>

                        </div>
                        <div id="change-password" class="tab-content">
                            <h2>Change Password</h2>

                            <form id="password-change-form" method="POST" action="<?php echo e(route('settings.changePassword')); ?>">
                                <?php echo csrf_field(); ?>
                                
                                <?php if(session('success')): ?>
                                <div class="alert alert-success">
                                    <?php echo e(session('success')); ?>

                                </div>
                                <?php endif; ?>

                                <?php if(session('error')): ?>
                                <div class="error">
                                    <?php echo e(session('error')); ?>

                                </div>
                                <?php endif; ?>

                                <?php if($errors->any()): ?>
                                <div class="error">
                                    <ul>
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                                <?php endif; ?>

                                <label for="current-password">Current Password</label>
                                <input type="password" id="current-password" name="current_password" placeholder="Type your old password" required>
                            
                                <label for="new-password">New Password</label>
                                <input type="password" id="new-password" name="new_password" placeholder="Type your new password" required>
                            
                                <label for="repeat-password">Confirm New Password</label>
                                <input type="password" id="repeat-password" name="new_password_confirmation" placeholder="Confirm new password" required>
                            
                                <div class="action-button">
                                    <button type="button" onclick="window.location.href='<?php echo e(url()->previous()); ?>'">Cancel</button>
                                    <button type="submit">Save changes</button>
                                </div>
                            </form>

                        </div>
                        <div id="info" class="tab-content">
                            <h2>Info</h2>
                            <form method="POST" action="<?php echo e(route('settings.updateAccountInfo')); ?>">
                                <?php echo csrf_field(); ?>
                            
                                <label for="bio">Bio</label>
                                <textarea id="bio" name="bio">Some Text</textarea>
                            
                                <label for="birthDate">Birthday</label>
                                <input type="date" id="birthDate" name="birthDate" value="<?php echo e(Auth::user()->birthDate); ?>">
                            
                                <label for="sex">Sex</label>
                                <input type="text" id="sex" name="sex" value="<?php echo e(Auth::user()->sex); ?>" readonly>
                            
                                <label for="nationality">Nationality</label>
                                <input type="text" id="nationality" name="nationality" value="<?php echo e(Auth::user()->nationality); ?>">
                            
                                <label for="contactNumber">Contact Number</label>
                                <input type="text" id="contactNumber" name="contactNumber" value="<?php echo e(Auth::user()->contactNumber); ?>">

                                <label for="email">E-mail</label>
                                <input type="text" id="email" name="email" value="<?php echo e(Auth::user()->email); ?>">
                            
                                <div class="action-button">
                                    <button type="button" onclick="window.location.href='<?php echo e(url()->previous()); ?>'">Cancel</button>
                                    <button type="submit">Save changes</button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </content>
        </main>
    </div>
    <script>

    </script>
    <script src="../../js/settings.js"></script>
</body>
</html><?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views\settings\account_settings.blade.php ENDPATH**/ ?>