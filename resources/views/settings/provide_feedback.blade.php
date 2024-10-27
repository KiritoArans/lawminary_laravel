<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Provide Feedback</title>
        <link rel="icon" href="../../imgs/lawminarylogo_v3.png" type="image/png" />
        <link
            rel="stylesheet"
            href="{{ asset('css/settings/provide_feedback_style.css') }}"
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
                <content class="feedback-section">
                    <div class="feedback-text">
                        <h1>We'd love to hear</h1>
                        <h2>something from you!</h2>
                        <img src="../imgs/feedback.png" alt="">
                    </div>
                    <div class="feedback-form">

                        <form method="POST" action="{{ route('users.createFeedback') }}">
                            @csrf 
                            @include('inclusions/response')
                            <label for="email">Email</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ Auth::user()->email }}"
                                required
                                readonly
                            />

                            <label for="feedback">Feedback</label>
                            <textarea
                                id="feedback"
                                name="feedback"
                                rows="4"
                                placeholder="Type any comments or suggestions..."
                                required
                            ></textarea>

                            <button type="submit">Submit Feedback</button>
                        </form>

                    </div>
                </content>
            </main>
        </div>
        <script src="../js/showUserNav.js"></script>
        <script src="../js/showNotification.js"></script>
        <script src="../js/settings.js"></script>
        <script src="../js/logout.js"></script>
    </body>
</html>
