<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Moderator FAQs</title>
        <link
            rel="icon"
            href="{{ asset('imgs/lawminarylogo.png') }}"
            type="image/png"
        />
        <link
            rel="stylesheet"
            href="{{ asset('css/moderator/mfaqsstyle.css') }}"
        />
        <link rel="stylesheet" href="{{ asset('css/base_pagination.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/nav_burger.css') }}" />
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
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
            rel="stylesheet"
        />
    </head>
    <body>
        <div class="container-post">
            @include('includes_accounts.mod_nav_inc')

            <main>
                <header class="text-center">
                    <div class="header-top">
                        <i class="fa-solid fa-bars"></i>
                        @include('includes_syscon.syscon_logo_inc')
                    </div>
                    <hr class="divider w-100" />
                </header>
                <h1>Frequently Asked Questions.</h1>

                <div class="search-bar">
                    <form
                        method="GET"
                        action="{{ route('faqs.search') }}"
                        class="d-flex justify-content-center"
                    >
                        <input
                            type="text"
                            name="search"
                            placeholder="Search FAQs..."
                            class="form-control me-2"
                            value="{{ request('search') }}"
                        />
                    </form>
                </div>
                <p>*click cell to view data</p>

                <content class="text-center">
                    <div class="table-responsive">
                        @if ($faqs->isNotEmpty())
                            <table
                                class="table table-striped table-bordered mt-3"
                            >
                                <thead>
                                    <tr>
                                        <th style="width: 90%">Question</th>
                                        <th style="width: 30%">
                                            Related Questions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($faqs as $faq)
                                        <tr>
                                            <td
                                                class="clickable-cell"
                                                data-full-text="{{ $faq['question'] }}"
                                                style="width: 70%"
                                            >
                                                {{ Str::limit($faq['question'], 90) }}
                                            </td>
                                            <td style="width: 30%">
                                                {{ count($faq['related']) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div id="textModal" class="modal">
                                <div class="modal-content">
                                    <span class="close-modal">&times;</span>
                                    <div class="modal-body">
                                        <p id="fullText"></p>
                                        <!-- Full question text will be injected here -->
                                    </div>
                                </div>
                            </div>

                            <!-- Pagination Section -->
                            <div
                                class="paginationContent d-flex justify-content-center mt-3"
                            >
                                <ul class="pagination">
                                    <li
                                        class="page-item {{ $faqs->currentPage() == 1 ? 'disabled' : '' }}"
                                    >
                                        <a
                                            class="page-link"
                                            href="{{ $faqs->appends(request()->input())->previousPageUrl() }}"
                                            rel="prev"
                                        >
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                    </li>

                                    @for ($i = 1; $i <= $faqs->lastPage(); $i++)
                                        <li
                                            class="page-item {{ $faqs->currentPage() == $i ? 'active' : '' }}"
                                        >
                                            <a
                                                class="page-link"
                                                href="{{ $faqs->appends(request()->input())->url($i) }}"
                                            >
                                                {{ $i }}
                                            </a>
                                        </li>
                                    @endfor

                                    <li
                                        class="page-item {{ $faqs->hasMorePages() ? '' : 'disabled' }}"
                                    >
                                        <a
                                            class="page-link"
                                            href="{{ $faqs->appends(request()->input())->nextPageUrl() }}"
                                            rel="next"
                                        >
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <p>No FAQs found.</p>
                        @endif
                    </div>

                    <!-- Modal remains unchanged -->
                    <div id="relatedFaqModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button">&times;</span>

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
