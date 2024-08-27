<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Posts</title>
    <link rel="icon" href="{{ asset('imgs/lawminarylogo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/admin/postpagestyle.css') }}">
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
                        <li><a href="/admin/dashboard"><i class="fa-solid fa-chart-pie"></i><span>Dashboard</span></a></li>
                        <li><a href="/admin/postpage" class="current"><i class="fa-solid fa-envelope-open-text"></i><span>Posts</span></a></li>
                        <li><a href="/admin/account"><i class="fa-solid fa-user-gear"></i><span>Accounts</span></a></li>
                        <li><a href="/admin/forums"><i class="fa-solid fa-users"></i><span>Forums</span></a></li>
                        <li><a href="/admin/systemcontent"><i class="fa-solid fa-display"></i><span>System Content</span></a></li>
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
                    <div class="spacer"></div>
                </div>
                <hr class="divider">
            </header>
            <div class="filter-container">
                <div class="search-bar">
                    <input type="text" placeholder="Search for posts">
                    <button class="custom-button" id="editButton">Edit</button>
                <div id="editModal" class="modal">
                    <div class="modal-content">
                        <span class="close-button" id="closeEditModal">&times;</span>
                        <h2>Edit Post</h2>
                        <form id="editForm">
                            <label for="editPostId">Post ID:</label>
                            <input type="text" id="editPostId" name="editPostId" readonly>
                            
                            <label for="editContent">Content:</label>
                            <textarea id="editContent" name="editContent"></textarea>
                            
                            <label for="editStatus">Status:</label>
                            <select id="editStatus" name="editStatus">
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                            
                            <label for="editTags">Tags:</label>
                            <input type="text" id="editTags" name="editTags">
                            
                            <label for="restrictUser">Restrict User (days):</label>
                            <input type="number" id="restrictUser" name="restrictUser">
                            
                            <label for="notifyUser">Notify User:</label>
                            <input type="checkbox" id="notifyUser" name="notifyUser">
                            
                            <button type="submit" class="custom-button">Save Changes</button>
                            <button type="button" class="custom-button" id="deleteButton">Delete Post</button>
                        </form>
                    </div>
                </div>
            </div>
                <div class="action-buttons">
                    <button class="custom-button" id="viewPendingButton">View Pending Posts</button>
                    
                    <div id="pendingPostsModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button" id="closePendingPostsModal">&times;</span>
                            <h2>Pending Posts</h2>
                            <div id="pendingPostsContainer">
                                <!-- Dynamic content will be added here -->
                            </div>
                        </div>
                    </div>
                    <button class="custom-button" id="filterButton">Filter</button>
                    <div id="filterModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button" id="closeFilterModal">&times;</span>
                            <h2>Filter Posts</h2>
                            <form id="filterForm">
                                <label for="filterPostId">Post ID:</label>
                                <input type="text" id="filterPostId" name="filterPostId">
                                
                                <label for="filterConcern">Concern:</label>
                                <input type="text" id="filterConcern" name="filterConcern">
                                
                                <label for="filterPostedBy">Posted By:</label>
                                <input type="text" id="filterPostedBy" name="filterPostedBy">
                                
                                <label for="filterDate">Date:</label>
                                <input type="date" id="filterDate" name="filterDate">
                                
                                <label for="filterApprovedBy">Approved by:</label>
                                <input type="text" id="filterApprovedBy" name="filterApprovedBy">
                                
                                <button type="submit" class="custom-button">Apply Filter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>            
            <content class="container">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Post ID</th>
                            <th>Content</th>
                            <th>Status</th>
                            <th>Tags</th>
                            <th>Posted By</th>
                            <th>Date</th>
                            <th>Approved by</th>
                        </tr>
                    </thead>
                    <tbody id="postsTableBody">
                        <tr>
                            <td>1</td>
                            <td>Example content 1</td>
                            <td>Pending</td>
                            <td>tag1, tag2</td>
                            <td>User 1</td>
                            <td>2024-08-05</td>
                            <td>Admin 1</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Example content 2</td>
                            <td>Approved</td>
                            <td>tag3, tag4</td>
                            <td>User 2</td>
                            <td>2024-08-04</td>
                            <td>Admin 2</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Example content 3</td>
                            <td>Rejected</td>
                            <td>tag5, tag6</td>
                            <td>User 3</td>
                            <td>2024-08-03</td>
                            <td>Admin 3</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Example content 4</td>
                            <td>Pending</td>
                            <td>tag7, tag8</td>
                            <td>User 4</td>
                            <td>2024-08-02</td>
                            <td>Admin 4</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Example content 5</td>
                            <td>Approved</td>
                            <td>tag9, tag10</td>
                            <td>User 5</td>
                            <td>2024-08-01</td>
                            <td>Admin 5</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Example content 6</td>
                            <td>Pending</td>
                            <td>tag11, tag12</td>
                            <td>User 6</td>
                            <td>2024-07-31</td>
                            <td>Admin 6</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Example content 7</td>
                            <td>Approved</td>
                            <td>tag13, tag14</td>
                            <td>User 7</td>
                            <td>2024-07-30</td>
                            <td>Admin 7</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Example content 8</td>
                            <td>Rejected</td>
                            <td>tag15, tag16</td>
                            <td>User 8</td>
                            <td>2024-07-29</td>
                            <td>Admin 8</td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>Example content 9</td>
                            <td>Pending</td>
                            <td>tag17, tag18</td>
                            <td>User 9</td>
                            <td>2024-07-28</td>
                            <td>Admin 9</td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>Example content 10</td>
                            <td>Approved</td>
                            <td>tag19, tag20</td>
                            <td>User 10</td>
                            <td>2024-07-27</td>
                            <td>Admin 10</td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td>Example content 11</td>
                            <td>Rejected</td>
                            <td>tag21, tag22</td>
                            <td>User 11</td>
                            <td>2024-07-26</td>
                            <td>Admin 11</td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>Example content 12</td>
                            <td>Pending</td>
                            <td>tag23, tag24</td>
                            <td>User 12</td>
                            <td>2024-07-25</td>
                            <td>Admin 12</td>
                        </tr>
                    </tbody>
                </table>
            </content>
        </main>
    </div>
    <script src="{{ asset('js/admin_js/accounts_js.js') }}"></script>
</body>
</html>
