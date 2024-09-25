<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Account Settings</title>
        <link rel="icon" href="../../imgs/lawminarylogo.png" type="image/png" />
        <link
            rel="stylesheet"
            href="<?php echo e(asset('css/settings/account-settings_style.css')); ?>"
        />
        <link rel="stylesheet" href="<?php echo e(asset('css/nav_style.css')); ?>" />
        <?php echo $__env->make('inclusions/libraryLinks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </head>
    <body>
        <div class="container">
            <?php echo $__env->make('inclusions/userNav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <main>
                <header>
                    <div class="header-top">
                        <?php echo $__env->make('includes_syscon.syscon_logo_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="notification">
                            <a href="../notifications">
                                <i class="fas fa-bell bell-icon"></i>
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
                            </ul>
                        </div>
                        <div class="settings-content">
                            <div id="general" class="tab-content active">
                                <h2>General</h2>

                                <form
                                    method="POST"
                                    action="<?php echo e(route('settings.updateAccountNames')); ?>"
                                    enctype="multipart/form-data"
                                >
                                    <?php echo csrf_field(); ?>
                                    <?php echo $__env->make('inclusions/response', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <div class="profile-pic">
                                        <img
                                            id="profileImagePreview"
                                            src="<?php echo e(Auth::user()->userPhoto ? Storage::url(Auth::user()->userPhoto) : asset('imgs/user-img.png')); ?>"
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
                                        value="<?php echo e(Auth::user()->username); ?>"
                                    />

                                    <label for="firstName">First Name</label>
                                    <input
                                        type="text"
                                        id="firstName"
                                        name="firstName"
                                        value="<?php echo e(Auth::user()->firstName); ?>"
                                    />

                                    <label for="middleName">Middle Name</label>
                                    <input
                                        type="text"
                                        id="middleName"
                                        name="middleName"
                                        value="<?php echo e(Auth::user()->middleName); ?>"
                                    />

                                    <label for="lastName">Last Name</label>
                                    <input
                                        type="text"
                                        id="lastName"
                                        name="lastName"
                                        value="<?php echo e(Auth::user()->lastName); ?>"
                                    />

                                    <div class="action-button">
                                        <button
                                            type="button"
                                            onclick="window.location.href='<?php echo e(url()->previous()); ?>'"
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
                                    action="<?php echo e(route('settings.changePassword')); ?>"
                                >
                                    <?php echo csrf_field(); ?>
                                    <?php echo $__env->make('inclusions/response', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                    <label for="current-password">
                                        Current Password
                                    </label>
                                    <input
                                        type="password"
                                        id="current-password"
                                        name="current_password"
                                        placeholder="Type your old password"
                                        required
                                    />

                                    <label for="new-password">
                                        New Password
                                    </label>
                                    <input
                                        type="password"
                                        id="new-password"
                                        name="new_password"
                                        placeholder="Type your new password"
                                        required
                                    />

                                    <label for="repeat-password">
                                        Confirm New Password
                                    </label>
                                    <input
                                        type="password"
                                        id="repeat-password"
                                        name="new_password_confirmation"
                                        placeholder="Confirm new password"
                                        required
                                    />

                                    <div class="action-button">
                                        <button
                                            type="button"
                                            onclick="window.location.href='<?php echo e(url()->previous()); ?>'"
                                        >
                                            Cancel
                                        </button>
                                        <button type="submit">
                                            Save changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div id="info" class="tab-content">
                                <h2>Info</h2>
                                <form
                                    method="POST"
                                    action="<?php echo e(route('settings.updateAccountInfo')); ?>"
                                >
                                    <?php echo csrf_field(); ?>
                                    <?php echo $__env->make('inclusions/response', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                    <label for="bio">Bio</label>
                                    <textarea id="bio" name="bio">
Some Text</textarea
                                    >

                                    <label for="birthDate">Birthday</label>
                                    <input
                                        type="date"
                                        id="birthDate"
                                        name="birthDate"
                                        value="<?php echo e(Auth::user()->birthDate); ?>"
                                    />

                                    <label for="sex">Sex</label>
                                    <input
                                        type="text"
                                        id="sex"
                                        name="sex"
                                        value="<?php echo e(Auth::user()->sex); ?>"
                                        readonly
                                    />

                                    <label for="nationality">Nationality</label>
                                    <input
                                        type="text"
                                        id="nationality"
                                        name="nationality"
                                        value="<?php echo e(Auth::user()->nationality); ?>"
                                    />

                                    <label for="contactNumber">
                                        Contact Number
                                    </label>
                                    <input
                                        type="text"
                                        id="contactNumber"
                                        name="contactNumber"
                                        value="<?php echo e(Auth::user()->contactNumber); ?>"
                                    />

                                    <label for="email">E-mail</label>
                                    <input
                                        type="text"
                                        id="email"
                                        name="email"
                                        value="<?php echo e(Auth::user()->email); ?>"
                                    />

                                    <div class="action-button">
                                        <button
                                            type="button"
                                            onclick="window.location.href='<?php echo e(url()->previous()); ?>'"
                                        >
                                            Cancel
                                        </button>
                                        <button type="submit">
                                            Save changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </content>
            </main>
        </div>
        <script src="../js/settings.js"></script>
        <script src="../js/logout.js"></script>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/settings/account_settings.blade.php ENDPATH**/ ?>