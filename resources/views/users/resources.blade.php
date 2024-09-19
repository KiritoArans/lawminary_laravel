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
        @include('inclusions/userNav')
        <main>
            <header>
                <div class="header-top">
                    @include('includes_syscon.syscon_logo_inc')
                    <div class="notification">
                        <a href="notifications"><i class="fas fa-bell bell-icon"></i></a>
                    </div>
                </div>
                <hr class="divider">
                <div class="header-buttons-search">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elite.</p>
                    <div class="header-buttons"></div>
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
    </div>
    <script src="../js/settings.js"></script>
    <script src="js/logout.js"></script>
</body>
</html>
