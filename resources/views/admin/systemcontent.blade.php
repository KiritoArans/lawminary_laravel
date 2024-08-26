<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | System Content</title>
    <link rel="icon" href="{{ asset('imgs/lawminarylogo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/admin/systemcontentstyle.css') }}">
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
                        <li><a href="dashboard"><i class="fa-solid fa-chart-pie"></i><span>Dashboard</span></a></li>
                        <li><a href="postpage"><i class="fa-solid fa-envelope-open-text"></i><span>Posts</span></a></li>
                        <li><a href="account"><i class="fa-solid fa-user-gear"></i><span>Accounts</span></a></li>
                        <li><a href="forums"><i class="fa-solid fa-users"></i><span>Forums</span></a></li>
                        <li><a href="systemcontent" class="current"><i class="fa-solid fa-display"></i><span>System Content</span></a></li>
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
            <content class="table-container">
                <h1>System Content</h1>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Contents</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-item="Logo" data-type="image">
                            <td>Logo</td>
                            <td><a href="#">Logo</a></td>
                            <td><button class="edit-button" data-item="Logo" data-type="image">Edit</button></td>
                        </tr>
                        <tr data-item="System Name" data-type="text">
                            <td>System Name</td>
                            <td><a href="#">System Name</a></td>
                            <td><button class="edit-button" data-item="System Name" data-type="text">Edit</button></td>
                        </tr>
                        <tr data-item="System Description" data-type="text">
                            <td>System Description</td>
                            <td><a href="#">System Description</a></td>
                            <td><button class="edit-button" data-item="System Description" data-type="text">Edit</button></td>
                        </tr>
                        <tr data-item="About System" data-type="text">
                            <td>About System</td>
                            <td><a href="#">About System</a></td>
                            <td><button class="edit-button" data-item="About System" data-type="text">Edit</button></td>
                        </tr>
                        <tr data-item="System Pages" data-type="file">
                            <td>System Pages</td>
                            <td><a href="#">System Pages</a></td>
                            <td><button class="edit-button" data-item="System Pages" data-type="file">Edit</button></td>
                        </tr>
                    </tbody>
                </table>

                <div id="editModal" class="modal">
                    <div class="modal-content">
                        <span class="close-button" id="closeEditModal">&times;</span>
                        <h2>Edit Content</h2>
                        <form id="editForm">
                            <label for="editItemName">Item Name:</label>
                            <input type="text" id="editItemName" name="editItemName" readonly>
                            
                            <div id="editTextContent" class="edit-content-type">
                                <label for="editText">Content:</label>
                                <textarea id="editText" name="editText"></textarea>
                            </div>
                            
                            <div id="editImageContent" class="edit-content-type">
                                <label for="editImage">Upload Image:</label>
                                <input type="file" id="editImage" name="editImage">
                            </div>
                            
                            <div id="editFileContent" class="edit-content-type">
                                <label for="editFile">Upload File:</label>
                                <input type="file" id="editFile" name="editFile">
                            </div>
                            
                            <button type="submit" class="custom-button">Save Changes</button>
                        </form>
                    </div>
                </div>
                <div id="editModal" class="modal">
                    <div class="modal-content">
                        <span class="close-button" id="closeEditModal">&times;</span>
                        <h2>Edit Content</h2>
                        <form id="editForm">
                            <label for="editItemName">Item Name:</label>
                            <input type="text" id="editItemName" name="editItemName" readonly>
                            
                            <label for="editContent">Content:</label>
                            <textarea id="editContent" name="editContent" required></textarea>
                            
                            <button type="submit" class="custom-button">Save Changes</button>
                        </form>
                    </div>
                </div>
            </content>
        </main>
    </div>
    <script src="{{ asset('js/admin_js/systemcontent_js.js') }}"></script>
</body>
</html>
