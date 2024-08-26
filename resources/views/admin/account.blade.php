<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Accounts</title>
    <link rel="icon" href="{{ asset('imgs/lawminarylogo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/admin/accountstyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/base_admin_table_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/base_admin_modal_style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">


</head>
<body>
    <div class="container-fluid my-4">
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
                        <li><a href="dashboard"><i class="fa-solid fa-chart-pie"></i><span>Dashboard</span></a></li>
                        <li><a href="postpage"><i class="fa-solid fa-envelope-open-text"></i><span>Posts</span></a></li>
                        <li><a href="account" class="current"><i class="fa-solid fa-user-gear"></i><span>Accounts</span></a></li>
                        <li><a href="forums"><i class="fa-solid fa-users"></i><span>Forums</span></a></li>
                        <li><a href="systemcontent"><i class="fa-solid fa-display"></i><span>System Content</span></a></li>
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
                    <img src="../../imgs/Lawminary_Logo_2-Gold.png" alt="Lawminary Logo">
                    <div class="spacer"></div>
                </div>
                <hr class="divider">
            </header>
            <section class="filter-container">
                <div class="search-bar">
                    <input type="text" id="search" placeholder="Search for posts or key words...">
                    <button class="custom-button" id="editButton">Edit</button>
                    <div id="editModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button" id="closeEditModal">&times;</span>
                            <h2>Edit Account</h2>
                            <form id="editForm">
                                <input type="hidden" id="editId" name="editId">
                                <label for="editName">Name:</label>
                                <input type="text" id="editName" name="editName" required>
                                
                                <label for="editEmail">Email:</label>
                                <input type="email" id="editEmail" name="editEmail" required>
                                
                                <label for="editUsername">Username:</label>
                                <input type="text" id="editUsername" name="editUsername" required>
                                
                                <label for="editPassword">Password:</label>
                                <input type="password" id="editPassword" name="editPassword">
                                
                                <button type="submit" class="custom-button">Save Changes</button>
                                <button type="button" class="custom-button" id="deleteButton">Delete Account</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="action-buttons">
                    <button class="custom-button" id="filterButton">Filter</button>
                    <select class="custom-button" id="accountType">
                        <option value="all">Account Type</option>
                        <option value="moderator">Moderator</option>
                        <option value="user">User</option>
                        <option value="lawyer">Lawyer</option>
                        <option value="admin">Admin</option>
                    </select>
                    <div id="filterModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button" id="closeFilterModal">&times;</span>
                            <h2>Filter Accounts</h2>
                            <form id="filterForm">
                                <label for="filterId">ID:</label>
                                <input type="text" id="filterId" name="filterId">
                                <label for="filterUsername">Username:</label>
                                <input type="text" id="filterUsername" name="filterUsername">
                                <label for="filterEmail">Email:</label>
                                <input type="text" id="filterEmail" name="filterEmail">
                                <button type="submit" class="custom-button">Apply Filter</button>
                            </form>
                        </div>
                    </div>
                    <button class="custom-button" id="addButton">Add</button>
                    <div id="addModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button" id="closeAddModal">&times;</span>
                            <h2>Add Account</h2>
                            <form id="addForm">
                                <label for="addName">Name:</label>
                                <input type="text" id="addName" name="addName" required>
                                
                                <label for="addEmail">Email:</label>
                                <input type="email" id="addEmail" name="addEmail" required>
                                
                                <label for="addUsername">Username:</label>
                                <input type="text" id="addUsername" name="addUsername" required>
                                
                                <label for="addAccountType">Account Type:</label>
                                <select id="addAccountType" name="addAccountType" required>
                                    <option value="user">User</option>
                                    <option value="moderator">Moderator</option>
                                    <option value="lawyer">Lawyer</option>
                                    <option value="admin">Admin</option>
                                </select>
                                
                                <label for="addPassword">Password:</label>
                                <input type="password" id="addPassword" name="addPassword" required>
                                
                                <button type="submit" class="custom-button">Add Account</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <content class="table-container">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>E-mail</th>
                            <th>Date Created</th>
                            <th>Account Type</th>
                        </tr>
                    </thead>
                    <tbody id="accountTableBody">
                        <tr data-type="user">
                            <td>24-0001</td>
                            <td>Yves Salarond</td>
                            <td>ys1321@gmail.com</td>
                            <td>mm/dd/yy</td>
                            <td>User</td>
                        </tr>
                        <tr data-type="moderator">
                            <td>24-0002</td>
                            <td>Jane Doe</td>
                            <td>jane.doe@example.com</td>
                            <td>01/15/23</td>
                            <td>Moderator</td>
                        </tr>
                        <tr data-type="admin">
                            <td>24-0003</td>
                            <td>John Smith</td>
                            <td>john.smith@example.com</td>
                            <td>02/28/23</td>
                            <td>Admin</td>
                        </tr>
                        <tr data-type="lawyer">
                            <td>24-0004</td>
                            <td>Alice Brown</td>
                            <td>alice.brown@example.com</td>
                            <td>03/10/23</td>
                            <td>Lawyer</td>
                        </tr>
                        <tr data-type="user">
                            <td>24-0005</td>
                            <td>Michael White</td>
                            <td>michael.white@example.com</td>
                            <td>04/22/23</td>
                            <td>User</td>
                        </tr>
                        <tr data-type="lawyer">
                            <td>24-0006</td>
                            <td>Linda Green</td>
                            <td>linda.green@example.com</td>
                            <td>05/15/23</td>
                            <td>Lawyer</td>
                        </tr>
                        <tr data-type="moderator">
                            <td>24-0007</td>
                            <td>Chris Blue</td>
                            <td>chris.blue@example.com</td>
                            <td>06/30/23</td>
                            <td>Moderator</td>
                        </tr>
                        <tr data-type="admin">
                            <td>24-0008</td>
                            <td>Karen Black</td>
                            <td>karen.black@example.com</td>
                            <td>07/08/23</td>
                            <td>Admin</td>
                        </tr>
                        <tr data-type="user">
                            <td>24-0009</td>
                            <td>Paul Red</td>
                            <td>paul.red@example.com</td>
                            <td>08/01/23</td>
                            <td>User</td>
                        </tr>
                        <tr data-type="lawyer">
                            <td>24-0010</td>
                            <td>Susan Yellow</td>
                            <td>susan.yellow@example.com</td>
                            <td>09/05/23</td>
                            <td>Lawyer</td>
                        </tr>
                    </tbody>
                </table>
            </content>
        </main>
    </div>
    <script src="{{ asset('js/admin_js/accounts_js.js') }}"></script>
</body>
</html>
