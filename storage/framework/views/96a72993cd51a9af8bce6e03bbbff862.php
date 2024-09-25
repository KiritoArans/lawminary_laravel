<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Admin</title>
    <link rel="icon" href="<?php echo e(asset('imgs/lawminarylogo.png')); ?>" type="image/png">
    <link rel="stylesheet" href="<?php echo e(asset('css/admin/dashboardstyle.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/nav_style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/admin/base_admin_table_style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/admin/base_admin_modal_style.css')); ?>">
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
                        <li><a href="/admin/dashboard" class="current"><i class="fa-solid fa-chart-pie"></i><span>Dashboard</span></a></li>
                        <li><a href="/admin/postpage"><i class="fa-solid fa-envelope-open-text"></i><span>Posts</span></a></li>
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
                </div>
                <hr class="divider">
                <div class="header-line">
                    <div class="header-ttl">
                        <h1>Dashboard</h1>
                    </div>
                    <div class="filter-section">
                        <div class="filter-btn">
                            <button id="filterButton">Filter</button>
                        </div>
                    </div>
                </div>
            </header>
            <content>
                <div class="dash-content">
                    <div class="box-content">
                        <div class="boxes">
                            <div class="box box1">
                                <i class="uil uil-file-upload-alt"></i>
                                <span class="text">Pending Posts</span>
                                <a href="#" class="number"><h1>0</h1></a>
                            </div>
                            <div class="box box2">
                                <i class="uil uil-comments"></i>
                                <span class="text">Pending Accounts</span>
                                <a href="#" class="number"><h1>0</h1></a>
                            </div>
                            <div class="box box3">
                                <i class="uil uil-bag"></i>
                                <span class="text">Accounts</span>
                                <a href="#" class="number"><h1>0</h1></a>
                            </div>
                            <div class="container-table">

                                <div class="container-table">
                                <div class="container-table">
    <h2>Recent Activities</h2>
    <div class="container-table-2">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Action</th>
                    <th>Date</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>user1</td>
                    <td>Logged in</td>
                    <td>2024-08-04</td>
                    <td><button class="btn btn-view btn-sm" data-id="1">View</button></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>user2</td>
                    <td>Logged out</td>
                    <td>2024-08-04</td>
                    <td><button class="btn btn-view btn-sm" data-id="2">View</button></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>user3</td>
                    <td>User has posted this</td>
                    <td>2024-08-04</td>
                    <td><button class="btn btn-view btn-sm" data-id="3">View</button></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>user4</td>
                    <td>User commented on this</td>
                    <td>2024-08-04</td>
                    <td><button class="btn btn-view btn-sm" data-id="4">View</button></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>user5</td>
                    <td>User liked this</td>
                    <td>2024-08-04</td>
                    <td><button class="btn btn-view btn-sm" data-id="5">View</button></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>user6</td>
                    <td>User has posted this</td>
                    <td>2024-08-04</td>
                    <td><button class="btn btn-view btn-sm" data-id="6">View</button></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>user7</td>
                    <td>Logged in</td>
                    <td>2024-08-04</td>
                    <td><button class="btn btn-view btn-sm" data-id="7">View</button></td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>user8</td>
                    <td>Logged out</td>
                    <td>2024-08-04</td>
                    <td><button class="btn btn-view btn-sm" data-id="8">View</button></td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>user9</td>
                    <td>User commented on this</td>
                    <td>2024-08-04</td>
                    <td><button class="btn btn-view btn-sm" data-id="9">View</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
                        <div id="viewModal" class="modal">
                            <div class="modal-content">
                                <span class="close-button">&times;</span>
                                <h2>Activity Details</h2>
                                <div id="modalContent">
                                    <!-- Dynamic content will be loaded here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </content>
        </main>
        <script src="<?php echo e(asset('js/admin_js/dashboard_js.js')); ?>"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views\admin\dashboard.blade.php ENDPATH**/ ?>