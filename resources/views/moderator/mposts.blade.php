<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moderator | Posts</title>
    <link rel="icon" href="{{ asset('imgs/lawminarylogo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/moderator/mpoststyle.css') }}">
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
                 {{-- navigation for moderator --}}
                 @include('includes_accounts.mod_nav_inc')
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
                <div class="header-line">
                    <input type="text" placeholder="Search posts...">
                    <div class="search-bar">
                        <div class="edit-btn">
                            <button id="editBtn">Edit</button>
                        </div>
                    </div>
                    <div id="editModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button">&times;</span>
                            <h2>Edit Post</h2>

                            <div class="form-group">
                                <label for="editDate">Date:</label>
                                <input type="text" id="editDate" name="editDate" value="2024-08-01">
                            </div>

                            <div class="form-group">
                                <label for="editApprovedBy">Approved By:</label>
                                <input type="text" id="editApprovedBy" name="editApprovedBy" value="Admin 1">
                            </div>

                            <div class="form-group">
                                <label for="editRestrictUser">Restrict User (days):</label>
                                <input type="text" id="editRestrictUser" name="editRestrictUser">
                            </div>

                            <div class="form-group notify-user">
                                <label for="notifyUser">Notify User:</label>
                                <input type="checkbox" id="notifyUser" name="notifyUser">
                            </div>

                            <div class="form-group buttons">
                                <button type="submit">Save Changes</button>
                                <button type="button" class="delete-button">Delete Post</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="action-buttons">
                    <button id="viewPendingButton">View Pending Posts</button>
                    <div id="pendingItemsModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button">&times;</span>
                            <h2>Pending Posts</h2>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Post ID</th>
                                        <th>Title</th>
                                        <th>Posted By</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Title of the pending post 1</td>
                                        <td>User 1</td>
                                        <td>2024-08-01</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Title of the pending post 2</td>
                                        <td>User 2</td>
                                        <td>2024-08-02</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Title of the pending post 3</td>
                                        <td>User 3</td>
                                        <td>2024-08-03</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <button id="filterButton">Filter</button>
                    <div id="filterModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button">&times;</span>
                            <h2>Filter Posts</h2>
                            
                            <form id="filterForm">
                                <label for="filterId">Filter by Post ID:</label>
                                <input type="text" id="filterId" name="filterId">

                                <label for="filterConcern">Filter by Concern:</label>
                                <input type="text" id="filterConcern" name="filterConcern">

                                <label for="filterPostedBy">Filter by Posted By:</label>
                                <input type="text" id="filterPostedBy" name="filterPostedBy">

                                <label for="filterDate">Filter by Date:</label>
                                <input type="date" id="filterDate" name="filterDate">

                                <label for="filterApprovedBy">Filter by Approved By:</label>
                                <input type="text" id="filterApprovedBy" name="filterApprovedBy">
                                
                                <button type="submit">Apply Filters</button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>
            <content>
                <div class="bootstrap-table-container">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Post ID</th>
                                <th>Concern</th>
                                <th>Posted By</th>
                                <th>Date</th>
                                <th>Approved By</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Concern A</td>
                                <td>User 1</td>
                                <td>2024-08-01</td>
                                <td>Admin 1</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Concern B</td>
                                <td>User 2</td>
                                <td>2024-08-02</td>
                                <td>Admin 2</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </content>
        </main>
    </div>
    <script src="../../js/moderator_js/mpost_js.js"></script>
</body>
</html>
