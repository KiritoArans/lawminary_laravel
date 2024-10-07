<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Moderator Forums</title>
        <link
            rel="icon"
            href="{{ asset('imgs/lawminarylogo.png') }}"
            type="image/png"
        />
        <link
            rel="stylesheet"
            href="{{ asset('css/moderator/mforumsstyle.css') }}"
        />
        <link rel="stylesheet" href="{{ asset('css/nav_style.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/base_pagination.css') }}" />
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

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @include('inclusions/libraryLinks')
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
                        <div class="spacer"></div>
                    </div>
                    <hr class="divider" />
                </header>
                <form
                    action="{{ route('moderator.searchForums') }}"
                    method="GET"
                >
                    <div class="form-group">
                        <div class="form-search" style="width: 100%">
                            <input
                                type="text"
                                name="query"
                                class="form-control"
                                placeholder="Search for Forums or Key Words..."
                            />
                        </div>
                        <button type="submit" class="custom-button">
                            Search
                        </button>
                    </div>
                </form>
                <section class="filter-container">
                    <div class="action-buttons">
                        <div class="container"></div>

                        <!-- Filter Button and Modal -->
                        <div class="action-buttons">
                            <button class="custom-button" id="filterButton">
                                Filter
                            </button>

                            <div id="filterModal" class="modal">
                                <div class="modal-content">
                                    <span
                                        class="close-button"
                                        id="closeFilterModal"
                                    >
                                        &times;
                                    </span>
                                    <h2>Filter Forums</h2>

                                    <!-- Filter Form -->
                                    <form
                                        id="filterForm"
                                        action="{{ route('moderator.filterForums') }}"
                                        method="GET"
                                    >
                                        <label for="filterForumId">
                                            Forum ID:
                                        </label>
                                        <input
                                            type="text"
                                            id="filterForumId"
                                            name="filterForumId"
                                        />

                                        <label for="filterForumName">
                                            Forum Name:
                                        </label>
                                        <input
                                            type="text"
                                            id="filterForumName"
                                            name="filterForumName"
                                        />

                                        <label for="filterForumDescription">
                                            Forum Description:
                                        </label>
                                        <input
                                            type="text"
                                            id="filterForumDescription"
                                            name="filterForumDescription"
                                        />

                                        <label for="filterMembersCount">
                                            Members Count:
                                        </label>
                                        <input
                                            type="number"
                                            id="filterMembersCount"
                                            name="filterMembersCount"
                                        />

                                        <label for="filterDateCreated">
                                            Date Created:
                                        </label>
                                        <input
                                            type="date"
                                            id="filterDateCreated"
                                            name="filterDateCreated"
                                        />

                                        <button
                                            type="button"
                                            class="custom-button"
                                            id="resetButton"
                                        >
                                            Reset Filter
                                        </button>

                                        <button
                                            type="submit"
                                            class="custom-button"
                                        >
                                            Apply Filter
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Add Forum Button -->
                        <button class="custom-button" id="addForumButton">
                            Add Forum
                        </button>

                        <!-- Add Forum Modal -->
                        <div id="addForumModal" class="modal">
                            <div class="modal-content">
                                <span
                                    class="close-button"
                                    id="closeAddForumModal"
                                >
                                    &times;
                                </span>
                                <h2>Add Forum</h2>
                                <form
                                    id="addForumForm"
                                    method="POST"
                                    action="{{ route('createForum') }}"
                                    enctype="multipart/form-data"
                                >
                                    @csrf
                                    @include('inclusions/response')
                                    <label for="addForumName">
                                        Forum Name:
                                    </label>
                                    <input
                                        type="text"
                                        id="addForumName"
                                        name="forumName"
                                        required
                                    />

                                    <label for="addForumPhoto">
                                        Forum Photo:
                                    </label>
                                    <input
                                        type="file"
                                        id="addForumPhoto"
                                        name="forumPhoto"
                                    />

                                    <label for="addForumDescription">
                                        Forum Description:
                                    </label>
                                    <input
                                        type="text"
                                        id="addForumDescription"
                                        name="forumDesc"
                                        required
                                    />

                                    <button type="submit" class="custom-button">
                                        Add Forum
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
                @include('includes_forums.forums_view_inc')
            </main>
        </div>
        <script src="{{ asset('js/moderator_js/mforums_js.js') }}"></script>
    </body>
</html>
