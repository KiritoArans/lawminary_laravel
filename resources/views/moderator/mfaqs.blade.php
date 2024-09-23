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
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Concern</th>
                                    <th>Entities</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($faqs as $faq)
                                    <tr>
                                        <td>{{ $faq['id'] }}</td>
                                        <td>{{ $faq['concern'] }}</td>
                                        <td>
                                            @if (! empty($faq['entities']))
                                                @foreach ($faq['entities'] as $entity)
                                                    @if (is_array($entity))
                                                        @foreach ($entity as $keyword)
                                                            {{ $keyword }}
                                                            <br />
                                                        @endforeach
                                                    @else
                                                        {{ $entity }}
                                                        <br />
                                                    @endif
                                                @endforeach
                                            @else
                                                    No entities found
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id="filterFaqModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button">&times;</span>
                            <h2>Filter FAQs</h2>
                            <form id="filterForm">
                                <label for="filterFaqId">Filter by ID:</label>
                                <input
                                    type="text"
                                    id="filterFaqId"
                                    name="filterFaqId"
                                />

                                <label for="filterFaqConcern">
                                    Filter by Concern:
                                </label>
                                <input
                                    type="text"
                                    id="filterFaqConcern"
                                    name="filterFaqConcern"
                                />

                                <label for="filterFaqFrequency">
                                    Filter by Frequency:
                                </label>
                                <input
                                    type="text"
                                    id="filterFaqFrequency"
                                    name="filterFaqFrequency"
                                />

                                <label for="filterFaqDate">
                                    Filter by Date:
                                </label>
                                <input
                                    type="date"
                                    id="filterFaqDate"
                                    name="filterFaqDate"
                                />

                                <div class="form-buttons">
                                    <button type="submit" class="save-button">
                                        Apply Filters
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </content>
            </main>
        </div>
        <script src="{{ asset('js/moderator_js/mfaqs_js.js') }}"></script>
    </body>
</html>
