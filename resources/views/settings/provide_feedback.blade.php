<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Provide Feedback</title>
    <link rel="icon" href="../../imgs/lawminarylogo.png" type="image/png">
    <link rel="stylesheet" href="{{ asset ('css/settings/provide_feedback_style.css') }}">
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
            <content class="feedback-section">
                <div class="feedback-form">
                    <form method="POST" action="submit_feedback.php">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" required>

                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>

                        <label for="feedback">Feedback:</label>
                        <textarea id="feedback" name="feedback" rows="4" required></textarea>

                        <button type="submit">Submit Feedback</button>
                    </form>
                </div>
            </content>
        </main>
    </div>
    <script src="../js/settings.js"></script>
    <script src="../js/logout.js"></script>
</body>
</html>
