<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Terms of Service</title>
    <link rel="icon" href="../..imgs/lawminarylogo.png" type="image/png">
    <link rel="stylesheet" href="{{ asset ('css/settings/terms_of_service_style.css') }}">
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
            <content class="tos-section">
                <h1>Terms of Service</h1>
                <div class="tos-content">
                    <h2>1. Introduction</h2>
                    <p>Welcome to Lawminary! These Terms of Service ("Terms") govern your use of our website located at lawminary.com (together or individually "Service") operated by Lawminary.</p>

                    <h2>2. Accounts</h2>
                    <p>When you create an account with us, you must provide us information that is accurate, complete, and current at all times. Failure to do so constitutes a breach of the Terms, which may result in immediate termination of your account on our Service.</p>

                    <h2>3. Termination</h2>
                    <p>We may terminate or suspend your account immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms.</p>

                    <h2>4. Changes to Terms</h2>
                    <p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material, we will provide at least 30 days' notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.</p>

                    <h2>5. Contact Us</h2>
                    <p>If you have any questions about these Terms, please contact us.</p>
                </div>
            </content>
        </main>
    </div>
    <script src="../js/settings.js"></script>
    <script src="../js/logout.js"></script>
</body>
</html>