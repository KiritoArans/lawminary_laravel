<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | FAQs</title>
        <link
            rel="icon"
            href="{{ asset('imgs/lawminarylogo.png') }}"
            type="image/png"
        />
        <link
            rel="stylesheet"
            href="{{ asset('css/moderator/mfaqsstyle.css') }}"
        />
        <link rel="stylesheet" href="{{ asset('/base_pagination') }}" />
        <link rel="stylesheet" href="{{ asset('css/nav_style.css') }}" />
        <link
            rel="stylesheet"
            href="{{ asset('css/admin/base_admin_table_style.css') }}"
        />
        <link
            rel="stylesheet"
            href="{{ asset('css/admin/base_admin_modal_style.css') }}"
        />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
            integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <link
            href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
            rel="stylesheet"
        />
    </head>
    <body>
        <div class="container">
            <aside>
                @include('includes_accounts.mod_nav_inc')
            </aside>
            <main>
                <header>
                    <div class="header-top">
                        @include('includes_syscon.syscon_logo_inc')
                    </div>
                    <hr class="divider" />

                    <div class="search-bar">
                        <input type="text" placeholder="Search FAQs..." />
                        <div class="filter-btn">
                            <button id="filterButton" class="custom-button">
                                Filter
                            </button>
                        </div>
                    </div>
                </header>
                <content>
                    <h1>Frequently Asked Questions</h1>
                    <div class="container">
                        @if (! empty($faqs))
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Question</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($faqs as $keyword => $questions)
                                        <tr>
                                            <td>{{ $keyword }}</td>
                                            <td>
                                                <button
                                                    class="custom-button view-related"
                                                    data-questions="{{ json_encode($questions) }}"
                                                >
                                                    View Related Questions
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No FAQs found.</p>
                        @endif
                    </div>

                    <!-- Modal -->
                    <div id="relatedFaqModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button">&times;</span>
                            <h2>Related Questions</h2>
                            <div id="relatedQuestionsContent">
                                <!-- Dynamic related questions will be loaded here -->
                            </div>
                        </div>
                    </div>
                </content>
            </main>
        </div>
        <script src="{{ asset('js/moderator_js/mfaqs_js.js') }}"></script>
    </body>
</html>
