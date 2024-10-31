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

                <content>
                    <div class="concern-area">
                        <div class="concern-title">
                            <h1>Raise Your Concern,</h1>
                            <h3>Get an immediate response to your query.</h3>
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
                        </div>
                        <div class="concern-field">
                            <form action="{{ route('searchLaw') }}" method="POST">
                                @csrf
                                <textarea name="user_concern" placeholder="Type your concern here..."></textarea>
                                <button type="submit" class="custom-button">Submit</button>
                            </form>
                        </div>
                    </div>
                    
                    @if(isset($possibleCharges) && count($possibleCharges) > 0)
                        <div class="charges">
                            <div class="charges-content">
                                <div class="charges-header">
                                    <div class="charges-title">
                                        <h1>Possible Charges</h1>
                                    </div>
                                </div>
                                <hr>
                                
                                @foreach($possibleCharges as $charge)
                                    <div class="charges-info">
                                        <div class="possible-charges">
                                            <h1>{{ $charge->article_name }}</h1>
                                            <p>{{ $charge->description }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                      @elseif(request()->isMethod('post') && isset($possibleCharges))
                        <div class="charges">
                            <div class="charges-content">
                                <div class="charges-header">
                                    <div class="charges-title">
                                        <h1>Possible Charges</h1>
                                    </div>
                                </div>
                                <hr>
                                <div class="charges-info">
                                    <div class="possible-charges">
                                        <h1>No possible charges found for your concern.</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif


                </content>
            </main>
        </div>
        <script src="js/showUserNav.js"></script>
        <script src="js/showNotification.js"></script>
        <script src="js/settings.js"></script>
        <script src="js/logout.js"></script>
    </body>
</html>
