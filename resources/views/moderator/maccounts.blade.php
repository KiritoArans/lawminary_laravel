<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lawminary | Accounts</title>
<link rel="icon" href="{{ asset('imgs/lawminarylogo.png') }}" type="image/png">
<link rel="stylesheet" href="{{ asset('css/moderator/maccountsstyle.css') }}">
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
                        <li><a href="/moderator/accounts" class="current"><i class="fa-solid fa-user-gear"></i><span>Accounts</span></a></li>
                        <li><a href="/moderator/forums"><i class="fa-solid fa-users"></i><span>Forums</span></a></li>
                        <li><a href="/moderator/faqs"><i class="fa-solid fa-circle-question"></i><span>FAQs</span></a></li>
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
                            <th>Account Type</th>
                            <th>Restrict</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="accountTableBody">
                        @foreach($accounts as $account)
                        <tr>
                            <td>{{ $account->id }}</td>
                            <td>{{ $account->username }}</td>
                            <td>{{ $account->email }}</td>
                            <td>{{ $account->accountType }}</td>
                            <td>{{ $account->restrict }}</td>
                            <td>
                                <button type="button" class="custom-button edit-button"
                                    data-id="{{$account->id}}"
                                    data-user_id="{{$account->user_id}}"
                                    data-username="{{$account->username}}"
                                    data-email="{{$account->email}}"
                                    data-firstName="{{$account->firstName}}"
                                    data-middleName="{{$account->middleName}}"
                                    data-lastName="{{$account->lastName}}"
                                    data-birthDate="{{$account->birthDate}}"
                                    data-nationality="{{$account->nationality}}"
                                    data-sex="{{$account->sex}}"
                                    data-contactNumber="{{$account->contactNumber}}"
                                    data-restrict="{{$account->restrict}}"
                                    data-restrictDays="{{$account->restrictDays}}"
                                    data-accountType="{{$account->accountType}}"
                                >Edit</button>
                                <button type="submit" class="delete-button">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </content>
        </main>
    </div>
    <script src="{{ asset('js/moderator_js/maccounts_js.js') }}"></script>
</body>
</html>
