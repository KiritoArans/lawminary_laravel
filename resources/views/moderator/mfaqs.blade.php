<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | FAQs</title>
    <link rel="icon" href="{{ asset('imgs/lawminarylogo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/moderator/mfaqsstyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/base_admin_table_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/base_admin_modal_style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <aside>
            <div class="top-nav">
                <div class="profile">
                    <div class="user-indicator">
                        <img src="../../imgs/user-img.png" alt="Profile Picture">
                        <label>@Username</label>
                    </div>
                </div>
                <nav>
                    <ul>
                        <li><a href="/moderator/dashboard"><i class="fa-solid fa-chart-pie"></i><span>Dashboard</span></a></li>
                        <li><a href="/moderator/posts"><i class="fa-solid fa-envelope-open-text"></i><span>Posts</span></a></li>
                        <li><a href="/moderator/leaderboards"><i class="fa-solid fa-chart-simple"></i><span>Leaderboards</span></a></li>
                        <li><a href="/moderator/resources"><i class="fa-solid fa-folder"></i><span>Resources</span></a></li>
                        <li><a href="/moderator/accounts"><i class="fa-solid fa-user-gear"></i><span>Accounts</span></a></li>
                        <li><a href="/moderator/forums"><i class="fa-solid fa-users"></i><span>Forums</span></a></li>
                        <li><a href="/moderator/faqs"  class="current"><i class="fa-solid fa-circle-question"></i><span>FAQs</span></a></li>
                    </ul>
                </nav>
            </div>
            <div class="bottom-nav">
                <a class="logout"><i class="fa-solid fa-right-from-bracket"></i><span>Log out</span></a>
            </div>
        </aside>
        <main>
            <header>
                <div class="header-top">
                    <img src="../../imgs/Lawminary_Logo_2-Gold.png" alt="">
                </div>
                <hr class="divider">

                <div class="search-bar">
                    <input type="text" placeholder="Search FAQs...">
                    <div class="filter-btn">
                        <button id="filterButton" class="custom-button">Filter</button>
                    </div>
                </div>
            </header>
            <content>
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Concern</th>
                                <th>Frequency</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-id="1" data-concern="How to register?" data-frequency="15" data-date="2024-08-10">
                                <td>1</td>
                                <td>How to register?</td>
                                <td>15</td>
                                <td>2024-08-10</td>
                                <td><button class="custom-button view-button">View</button></td>
                            </tr>
                            <tr data-id="2" data-concern="How to reset password?" data-frequency="10" data-date="2024-08-11">
                                <td>2</td>
                                <td>How to reset password?</td>
                                <td>10</td>
                                <td>2024-08-11</td>
                                <td><button class="custom-button view-button">View</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div id="viewFaqModal" class="modal">
                    <div class="modal-content">
                        <span class="close-button">&times;</span>
                        <h2>FAQ Details</h2>
                        <p><strong>ID:</strong> <span id="viewFaqId"></span></p>
                        <p><strong>Concern:</strong> <span id="viewFaqConcern"></span></p>
                        <p><strong>Frequency:</strong> <span id="viewFaqFrequency"></span></p>
                        <p><strong>Date:</strong> <span id="viewFaqDate"></span></p>
                    </div>
                </div>

                <div id="filterFaqModal" class="modal">
                    <div class="modal-content">
                        <span class="close-button">&times;</span>
                        <h2>Filter FAQs</h2>
                        <form id="filterForm">
                            <label for="filterFaqId">Filter by ID:</label>
                            <input type="text" id="filterFaqId" name="filterFaqId">

                            <label for="filterFaqConcern">Filter by Concern:</label>
                            <input type="text" id="filterFaqConcern" name="filterFaqConcern">

                            <label for="filterFaqFrequency">Filter by Frequency:</label>
                            <input type="text" id="filterFaqFrequency" name="filterFaqFrequency">

                            <label for="filterFaqDate">Filter by Date:</label>
                            <input type="date" id="filterFaqDate" name="filterFaqDate">

                            <div class="form-buttons">
                                <button type="submit" class="save-button">Apply Filters</button>
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
