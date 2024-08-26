<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Resources</title>
    <link rel="icon" href="{{ asset('imgs/lawminarylogo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/moderator/mrecourcesstyle.css') }}">
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
                        <li><a href="mdashboard"><i class="fa-solid fa-chart-pie"></i><span>Dashboard</span></a></li>
                        <li><a href="mposts"><i class="fa-solid fa-envelope-open-text"></i><span>Posts</span></a></li>
                        <li><a href="mleaderboards"><i class="fa-solid fa-chart-simple"></i><span>Leaderboards</span></a></li>
                        <li><a href="mresources"  class="current"><i class="fa-solid fa-folder"></i><span>Resources</span></a></li>
                        <li><a href="maccounts"><i class="fa-solid fa-user-gear"></i><span>Accounts</span></a></li>
                        <li><a href="mforums"><i class="fa-solid fa-users"></i><span>Forums</span></a></li>
                        <li><a href="mfaqs"><i class="fa-solid fa-circle-question"></i><span>FAQs</span></a></li>
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
                <div class="filter-container">
                    <div class="search-bar">
                        <input type="text" placeholder="Search posts...">
                    <div class="filter-btn">
                        <button id="filterButton">Filter</button>
                    </div>

                    <div id="filterModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button">&times;</span>
                            <h2>Filter Resources</h2>
                            <form id="filterForm">
                                <label for="filterId">Filter by ID:</label>
                                <input type="text" id="filterId" name="filterId">

                                <label for="filterDocument">Filter by Document:</label>
                                <input type="text" id="filterDocument" name="filterDocument">

                                <label for="filterTitle">Filter by Resource Title:</label>
                                <input type="text" id="filterTitle" name="filterTitle">

                                <label for="filterDate">Filter by Date Uploaded:</label>
                                <input type="date" id="filterDate" name="filterDate">

                                <button type="submit" class="apply-button">Apply Filters</button>
                            </form>
                        </div>
                    </div>

                    <div id="editModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button">&times;</span>
                            <h2>Add / Update Resource</h2>
                            <form id="resourceForm" enctype="multipart/form-data">
                                <label for="resourceId">Resource ID:</label>
                                <input type="text" id="resourceId" name="resourceId" placeholder="Enter Resource ID" required>

                                <label for="resourceDocument">Document:</label>
                                <input type="text" id="resourceDocument" name="resourceDocument" placeholder="Enter Document Name" required>

                                <label for="resourceTitle">Resource Title:</label>
                                <input type="text" id="resourceTitle" name="resourceTitle" placeholder="Enter Resource Title" required>

                                <label for="uploadDate">Date Uploaded:</label>
                                <input type="date" id="uploadDate" name="uploadDate" required>

                                <label for="resourceFile">Upload File:</label>
                                <input type="file" id="resourceFile" name="resourceFile" accept=".pdf,.doc,.docx,.jpg,.png,.zip" required>

                                <div class="form-buttons">
                                    <button type="submit" class="save-button">Save Resource</button>
                                    <button type="button" class="delete-button">Delete Resource</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </header>
            <content>
                <div class="table">
                    <table class="resource-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Document</th>
                                <th>Resource Title</th>
                                <th>Date Uploaded</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-id="1" data-document="Document1.pdf" data-title="Resource Title 1" data-date="2024-08-01">
                                <td>1</td>
                                <td>Document1.pdf</td>
                                <td>Resource Title 1</td>
                                <td>2024-08-01</td>
                                <td><button class="custom-button view-button">View</button></td>
                            </tr>
                            <tr data-id="2" data-document="Document2.pdf" data-title="Resource Title 2" data-date="2024-08-02">
                                <td>2</td>
                                <td>Document2.pdf</td>
                                <td>Resource Title 2</td>
                                <td>2024-08-02</td>
                                <td><button class="custom-button view-button">View</button></td>
                            </tr>
                            <tr data-id="3" data-document="Document3.pdf" data-title="Resource Title 3" data-date="2024-08-03">
                                <td>3</td>
                                <td>Document3.pdf</td>
                                <td>Resource Title 3</td>
                                <td>2024-08-03</td>
                                <td><button class="custom-button view-button">View</button></td>
                            </tr>
                            <tr data-id="4" data-document="Document4.pdf" data-title="Resource Title 4" data-date="2024-08-04">
                                <td>4</td>
                                <td>Document4.pdf</td>
                                <td>Resource Title 4</td>
                                <td>2024-08-04</td>
                                <td><button class="custom-button view-button">View</button></td>
                            </tr>
                            <tr data-id="5" data-document="Document5.pdf" data-title="Resource Title 5" data-date="2024-08-05">
                                <td>5</td>
                                <td>Document5.pdf</td>
                                <td>Resource Title 5</td>
                                <td>2024-08-05</td>
                                <td><button class="custom-button view-button">View</button></td>
                            </tr>
                            <tr data-id="6" data-document="Document6.pdf" data-title="Resource Title 6" data-date="2024-08-06">
                                <td>6</td>
                                <td>Document6.pdf</td>
                                <td>Resource Title 6</td>
                                <td>2024-08-06</td>
                                <td><button class="custom-button view-button">View</button></td>
                            </tr>
                            <tr data-id="7" data-document="Document7.pdf" data-title="Resource Title 7" data-date="2024-08-07">
                                <td>7</td>
                                <td>Document7.pdf</td>
                                <td>Resource Title 7</td>
                                <td>2024-08-07</td>
                                <td><button class="custom-button view-button">View</button></td>
                            </tr>
                            <tr data-id="8" data-document="Document8.pdf" data-title="Resource Title 8" data-date="2024-08-08">
                                <td>8</td>
                                <td>Document8.pdf</td>
                                <td>Resource Title 8</td>
                                <td>2024-08-08</td>
                                <td><button class="custom-button view-button">View</button></td>
                            </tr>
                            <tr data-id="9" data-document="Document9.pdf" data-title="Resource Title 9" data-date="2024-08-09">
                                <td>9</td>
                                <td>Document9.pdf</td>
                                <td>Resource Title 9</td>
                                <td>2024-08-09</td>
                                <td><button class="custom-button view-button">View</button></td>
                            </tr>
                            <tr data-id="10" data-document="Document10.pdf" data-title="Resource Title 10" data-date="2024-08-10">
                                <td>10</td>
                                <td>Document10.pdf</td>
                                <td>Resource Title 10</td>
                                <td>2024-08-10</td>
                                <td><button class="custom-button view-button">View</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div id="viewModal" class="modal">
                    <div class="modal-content">
                        <span class="close-button">&times;</span>
                        <h2>View Resource</h2>
                        <p><strong>ID:</strong> <span id="viewResourceId"></span></p>
                        <p><strong>Document:</strong> <a id="viewResourceDocument" href="#" download></a></p>
                        <p><strong>Resource Title:</strong> <span id="viewResourceTitle"></span></p>
                        <p><strong>Date Uploaded:</strong> <span id="viewUploadDate"></span></p>
                    </div>
                </div>
            </content>
        </main>
    </div>
    <script src="{{ asset('js/moderator_js/mresources_js.js') }}"></script>
</body>
</html>
