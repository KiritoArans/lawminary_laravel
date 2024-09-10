<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Forums</title>
        <link
            rel="icon"
            href="{{ asset('imgs/lawminarylogo.png') }}"
            type="image/png"
        />
        <link
            rel="stylesheet"
            href="{{ asset('css/admin/forumstyle.css') }}"
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
                <div class="top-nav">
                    <div class="profile">
                        <div class="user-indicator">
                            <img
                                src="../../imgs/user-img.png"
                                alt="Profile Picture"
                            />
                            <label>@Username</label>
                        </div>
                    </div>
                    {{-- navigation --}}
                    @include('includes_accounts.nav_inc')
                </div>
                <div class="bottom-nav">
                    <a class="logout">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Log out</span>
                    </a>
                </div>
            </aside>
            <main>
                <header>
                    <div class="header-top">
                        <img
                            src="../../imgs/Lawminary_Logo_2-Gold.png"
                            alt=""
                        />
                        <div class="spacer"></div>
                    </div>
                    <hr class="divider" />
                </header>
                <section class="filter-container">
                    <div class="search-bar">
                        <input
                            type="text"
                            placeholder="Search for Forums or Key Words..."
                        />
                        <button class="custom-button" id="editButton">
                            Edit
                        </button>
                        <div id="editForumModal" class="modal">
                            <div class="modal-content">
                                <span
                                    class="close-button"
                                    id="closeEditForumModal"
                                >
                                    &times;
                                </span>
                                <h2>Edit Forum</h2>
                                <form id="editForumForm">
                                    <label for="editForumId">Forum ID:</label>
                                    <input
                                        type="text"
                                        id="editForumId"
                                        name="editForumId"
                                        readonly
                                    />

                                    <label for="editForumName">
                                        Forum Name:
                                    </label>
                                    <input
                                        type="text"
                                        id="editForumName"
                                        name="editForumName"
                                        required
                                    />

                                    <label for="editForumIssue">
                                        Forum Issue:
                                    </label>
                                    <input
                                        type="text"
                                        id="editForumIssue"
                                        name="editForumIssue"
                                        required
                                    />

                                    <label for="editForumDescription">
                                        Forum Description:
                                    </label>
                                    <input
                                        type="text"
                                        id="editForumDescription"
                                        name="editForumDescription"
                                        required
                                    />

                                    <label for="editMembersCount">
                                        Members Count:
                                    </label>
                                    <input
                                        type="number"
                                        id="editMembersCount"
                                        name="editMembersCount"
                                        required
                                    />

                                    <label for="editDateCreated">
                                        Date Created:
                                    </label>
                                    <input
                                        type="date"
                                        id="editDateCreated"
                                        name="editDateCreated"
                                        required
                                    />

                                    <label for="restrictForumAccess">
                                        Restrict Access:
                                    </label>
                                    <input
                                        type="checkbox"
                                        id="restrictForumAccess"
                                        name="restrictForumAccess"
                                    />

                                    <label for="archiveForum">
                                        Archive Forum:
                                    </label>
                                    <input
                                        type="checkbox"
                                        id="archiveForum"
                                        name="archiveForum"
                                    />

                                    <button type="submit" class="custom-button">
                                        Save Changes
                                    </button>
                                    <button
                                        type="button"
                                        class="custom-button"
                                        id="deleteForumButton"
                                    >
                                        Delete Forum
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
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
                                <form id="filterForm">
                                    <label for="filterForumId">Forum ID:</label>
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

                                    <button type="submit" class="custom-button">
                                        Apply Filter
                                    </button>
                                </form>
                            </div>
                        </div>
                        <button class="custom-button" id="addForumButton">
                            Add Forum
                        </button>
                        <div id="addForumModal" class="modal">
                            <div class="modal-content">
                                <span
                                    class="close-button"
                                    id="closeAddForumModal"
                                >
                                    &times;
                                </span>
                                <h2>Add Forum</h2>
                                <form id="addForumForm">
                                    <label for="addForumName">
                                        Forum Name:
                                    </label>
                                    <input
                                        type="text"
                                        id="addForumName"
                                        name="addForumName"
                                        required
                                    />

                                    <label for="addForumIssue">
                                        Forum Issue:
                                    </label>
                                    <input
                                        type="text"
                                        id="addForumIssue"
                                        name="addForumIssue"
                                        required
                                    />

                                    <label for="addForumDescription">
                                        Forum Description:
                                    </label>
                                    <input
                                        type="text"
                                        id="addForumDescription"
                                        name="addForumDescription"
                                        required
                                    />

                                    <label for="addMembersCount">
                                        Members Count:
                                    </label>
                                    <input
                                        type="number"
                                        id="addMembersCount"
                                        name="addMembersCount"
                                        required
                                    />

                                    <label for="addDateCreated">
                                        Date Created:
                                    </label>
                                    <input
                                        type="date"
                                        id="addDateCreated"
                                        name="addDateCreated"
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
                <content class="table-container">
                    @include('includes_forums.forums_table_inc')
                    <div id="viewForumModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button" id="closeViewForumModal">
                                &times;
                            </span>
                            <h2>Forum Details</h2>
                            <p>
                                <strong>Forum ID:</strong>
                                <span id="viewForumId"></span>
                            </p>
                            <p>
                                <strong>Forum Name:</strong>
                                <span id="viewForumName"></span>
                            </p>
                            <p>
                                <strong>Forum Issue:</strong>
                                <span id="viewForumIssue"></span>
                            </p>
                            <p>
                                <strong>Forum Description:</strong>
                                <span id="viewForumDescription"></span>
                            </p>
                            <p>
                                <strong>Members Count:</strong>
                                <span id="viewMembersCount"></span>
                            </p>
                            <p>
                                <strong>Date Created:</strong>
                                <span id="viewDateCreated"></span>
                            </p>
                        </div>
                    </div>
                </content>
            </main>
        </div>
        <script src="{{ asset('js/admin_js/forums_js.js') }}"></script>
    </body>
</html>
