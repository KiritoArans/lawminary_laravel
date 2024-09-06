<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | About Lawminary</title>
    <link rel="icon" href="../../imgs/lawminarylogo.png" type="image/png">
    <link rel="stylesheet" href="{{ asset ('css/about_style.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/nav_style.css') }}">
    @include('inclusions/libraryLinks')
</head>
<body>
    <div class="container">
        @include('inclusions/userNav')
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
            <content class="about-content">
                <h2>About Lawminary</h2>
                <p>Lawminary is an innovative web-based platform designed to help individuals find legal information and resources easily. We aim to collaborate with the Public Attorney’s Office of Tanauan City to provide accurate and reliable legal information to the community.</p>
                <p>Our mission is to make legal information accessible to everyone, empowering individuals to understand their legal rights and obligations. We believe that access to legal information is a fundamental right and strive to make it available in a user-friendly and understandable manner.</p>
                <p>With Lawminary, users can search for legal topics, ask questions in forums, and access a wealth of resources curated by legal professionals. Join our community and be part of a platform that makes legal information accessible to all.</p>
            </content>
        </main>
    </div>
    <script src="../js/settings.js"></script>
    <script src="../js/logout.js"></script>
</body>
</html>
