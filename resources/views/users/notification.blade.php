<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Notifications</title>
    <link rel="icon" href="../imgs/lawminarylogo_v3.png" type="image/png">
    <link rel="stylesheet" href="{{ asset ('css/notification_style.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/nav_style.css') }}">
    @include('inclusions/libraryLinks')
</head>
<body>
    <div class="container">
        @include('inclusions/userNav')
        <main>
        <header>
            <div class="header-top">
                <img src="../imgs/Lawminary_Logo_2-Gold.png" alt="">
                <div class="notification">
                    <a href="notifications"><i class="fas fa-bell bell-icon current"></i></a>
                </div>
            </div>
            <hr class="divider">
        </header>
        <content>
            <h1>Notifications</h1>
            <div class="notifs">
                <div class="notifs-content">
                    <div class="user-info">
                        <img src="../imgs/user-img.png" alt="Profile Picture" class="profile-pic">
                        <div class="post-info">
                            <h2>Name Surname</h2>
                            <p>@username</p>
                        </div>
                    </div>
                    <div class="notifs-divider"></div>
                    <div class="notifs-action">
                        <span>Action your concern.</span>
                    </div>
                    <span class="notifs-date">00/00/00</span>
                </div>
            </div>
        </content>
    <script src="../js/settings.js"></script>    
    <script src="js/logout.js"></script>
</body>
</html>