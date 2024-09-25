<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Search</title>
        <link rel="icon" href="../imgs/lawminarylogo.png" type="image/png" />
        <link rel="stylesheet" href="{{ asset('css/search_style.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/nav_style.css') }}" />
        @include('inclusions/libraryLinks')
    </head>
    <body>
        <div class="container">
            <!-- Include navigation bar for users -->
            @include('inclusions/userNav')

            <main>
                <!-- Header section -->
                <header>
                    <div class="header-top">
                        @include('includes_syscon.syscon_logo_inc')
                        <div class="notification">
                            <a href="notifications">
                                <i class="fas fa-bell bell-icon"></i>
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
                                <textarea
                                    name="user_concern"
                                    id="user_concern"
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
                                        <div class="possible-charges">
                                            <h2>
                                                {{ $charge->article_name }}
                                            </h2>
                                            <p>{{ $charge->description }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>
                                    No possible charges found for your concern.
                                </p>
                            @endif
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </body>
</html>
