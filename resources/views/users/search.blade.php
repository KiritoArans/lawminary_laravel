<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Search Law</title>
        <link rel="icon" href="../imgs/lawminarylogo_v3.png" type="image/png" />
        <link rel="stylesheet" href="{{ asset('css/search_style.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/nav_style.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/responsive/navres.css') }}" />
        @include('inclusions/libraryLinks')
    </head>
    <body>
        <div class="container">
            @include('inclusions/userNav')
            <main>
                <!-- Header section -->
                <header>
                    <div class="header-top">
                        <i class="fa-solid fa-bars"></i>
                        @include('includes_syscon.syscon_logo_inc')
                        <div class="notification">
                            <a href="notifications" class="notification-link">
                                <i class="fas fa-bell bell-icon current"></i>
                                <span id="notification-count" class="notification-badge"></span>
                            </a>
                        </div>
                    </div>
                    <hr class="divider" />
                </header>

                <!-- Main content area -->
                <section class="content-area">
                    <div class="concern-title">
                        <h1>Raise Your Concern</h1>
                        <h3>Get an immediate response to your query.</h3>
                    </div>
                    <div class="concern-area">
                        <!-- Form for submitting concern -->
                        <form
                            action="{{ route('find.charges') }}"
                            method="POST"
                        >
                            @csrf
                            <div class="concern-input">
                                <label for="user_concern" class="input-label">
                                    Your Concern:
                                </label>
                                <textarea
                                    name="user_concern"
                                    id="user_concern"
                                    class="textarea-field"
                                    placeholder="Type your concern here..."
                                    required
                                ></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="custom-button">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>

                    <p>
                        <strong>Disclaimer:</strong>
                        <br />
                        The possible charges listed are based on the information
                        you provided and are for reference purposes only. They
                        do not constitute legal advice or a final determination
                        of your case. For accurate legal consultation and
                        representation, please consult with a qualified
                        attorney. The charges shown may not cover all aspects of
                        the law and may not apply in every scenario.
                    </p>
                    <!-- Possible charges section -->
                    <div class="charges">
                        <div class="charges-content">
                            <div class="charges-header">
                                <h1>Possible Charges</h1>
                                <hr />
                            </div>

                            <!-- Display possible charges -->
                            @if (isset($possibleCharges) && count($possibleCharges) > 0)
                                @foreach ($possibleCharges as $charge)
                                    <div class="charges-info">
                                        <h2>{{ $charge->article_name }}</h2>
                                        <p>{{ $charge->description }}</p>
                                    </div>
                                @endforeach
                            @else
                                <p>
                                    No possible charges found for your concern.
                                </p>
                            @endif
                            @if (isset($error) && ! empty($error))
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                            @endif
                        </div>
                    </div>
                </section>
            </main>
        </div>
        <script src="js/showUserNav.js"></script>
        <script src="js/showNotification.js"></script>
        <script src="js/settings.js"></script>
        <script src="js/logout.js"></script>
    </body>
</html>
