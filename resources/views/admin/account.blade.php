<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Admin</title>
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
                        <li><a href="dashboard.html"><i class="fa-solid fa-chart-pie"></i><span>Dashboard</span></a></li>
                        <li><a href="postpage.html"><i class="fa-solid fa-envelope-open-text"></i><span>Posts</span></a></li>
                        <li><a href="account.html" class="current"><i class="fa-solid fa-user-gear"></i><span>Accounts</span></a></li>
                        <li><a href="forums.html"><i class="fa-solid fa-users"></i><span>Forums</span></a></li>
                        <li><a href="systemcontent.html"><i class="fa-solid fa-display"></i><span>System Content</span></a></li>
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
                                <div id="editValidationErrors" style="color:red;"></div>
                                
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
                     <!-- add accounts -->
                    <button class="custom-button" id="addButton">Add</button>
                    <div id="addModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button" id="closeAddModal">&times;</span>
                            <h2>Add Account</h2>
                            <div id="validationErrors" style="color: red;"></div>
                        <form id="addForm" method="POST" action="{{ route('admin.addAccount') }}">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        <label for="firstName">First Name:</label>
                        <input type="text" id="firstName" name="firstName" value="{{ old('firstName') }}" required>

                        <label for="middleName">Middle Name:</label>
                        <input type="text" id="middleName" name="middleName" value="{{ old('middleName') }}">

                        <label for="lastName">Last Name:</label>
                        <input type="text" id="lastName" name="lastName" value="{{ old('lastName') }}" required>

                        <label for="birthDate">Birth Date:</label>
                        <input type="date" id="birthDate" name="birthDate" value="{{ old('birthDate') }}" required>

                        <label for="nationality">Nationality:</label>
                        <input type="text" id="nationality" name="nationality" value="{{ old('nationality') }}" required>

                        <label for="sex">Sex:</label>
                        <select id="sex" name="sex" required>
                            <option value="male" {{ old('sex') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('sex') == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('sex') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>

                        <label for="contactNumber">Contact Number:</label>
                        <input type="tel" id="contactNumber" name="contactNumber" value="{{ old('contactNumber') }}" required>

                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>

                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="{{ old('username') }}" required>

                        <label for="accountType">Account Type:</label>
                        <select id="accountType" name="accountType" required>
                            <option value="ser" {{ old('accountType') == 'user' ? 'selected' : '' }}>User</option>
                            <option value="moderator" {{ old('accountType') == 'moderator' ? 'selected' : '' }}>Moderator</option>
                            <option value="lawyer" {{ old('accountType') == 'lawyer' ? 'selected' : '' }}>Lawyer</option>
                            <option value="admin" {{ old('accountType') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>

                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>

                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required>

                        <button type="submit" class="custom-button">Add Account</button>
                        </form>             
                             </div>
                                 </div>
                                    </div>
                                </section>
                        <!-- display content on table -->
                    <content class="table-container">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>E-mail</th>
                                    <th>Date Created</th>
                                    <th>Account Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="accountTableBody">
                                @foreach($accounts as $account)
                                <tr data-type="{{ strtolower($account->account_type) }}">
                                    <td>{{ $account->user_id }}</td>
                                    <td>{{ $account->username }}</td>
                                    <td>{{ $account->email }}</td>
                                    <td>{{ $account->created_at->format('m/d/Y') }}</td>
                                    <td>{{ ucfirst($account->accountType) }}</td>
                                    <td>
                                        <button type="button" class="custom-button view-button">View</button>
                                        {{-- <form method="post" action="">
                                            @csrf
                                            @method('delete') --}}
                                            <button type="submit" class="delete-button">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </content>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/admin_js/accounts_js.js') }}"></script>
</body>
</html>
