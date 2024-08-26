<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Moderator</title>
    <link rel="icon" href="{{ asset('imgs/lawminarylogo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/moderator/mdashboardstyle.css') }}">
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
                        <li><a href="mdashboard"  class="current"><i class="fa-solid fa-chart-pie"></i><span>Dashboard</span></a></li>
                        <li><a href="mposts"><i class="fa-solid fa-envelope-open-text"></i><span>Posts</span></a></li>
                        <li><a href="mleaderboards"><i class="fa-solid fa-chart-simple"></i><span>Leaderboards</span></a></li>
                        <li><a href="mresources"><i class="fa-solid fa-folder"></i><span>Resources</span></a></li>
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
                <div class="header-line">
                    <div class="header-ttl">
                        <h1>Dashboard</h1>
                    </div>
                    <div class="filter-section">
                        <div class="filter-btn">
                            <button id="filterButton">Filter</button>
                        </div>
                    </div>
                    <div id="filterModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button">&times;</span>
                            <h2>Filter Options</h2>
                            <div class="filter-inputs">
                                <input type="text" id="filterId" placeholder="Filter by ID">
                                <input type="text" id="filterUsername" placeholder="Filter by Username">
                                <input type="text" id="filterAction" placeholder="Filter by Action">
                                <input type="date" id="filterDate">
                                <button id="applyFilter">Apply Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <content>
                <div id="detailsModal" class="modal">
                    <div class="modal-content">
                        <span class="close-button">&times;</span>
                        <h2 id="modalTitle">Details</h2>
                        <ul id="modalList"></ul>
                    </div>
                </div>
                <div class="dash-content">
                    <div class="box-content">
                        <div class="boxes">
                            <div class="box box1 clickable" data-type="pendingPosts">
                                <i class="uil uil-file-upload-alt"></i>
                                <span class="text">Pending Posts</span>
                                <a href="#" class="number"><h1 id="pendingPosts">0</h1></a>
                            </div>
                            <div class="box box2 clickable" data-type="pendingAccounts">
                                <i class="uil uil-comments"></i>
                                <span class="text">Pending Accounts</span>
                                <a href="#" class="number"><h1 id="pendingAccounts">0</h1></a>
                            </div>
                            <div class="box box3 clickable" data-type="accounts">
                                <i class="uil uil-bag"></i>
                                <span class="text">Accounts</span>
                                <a href="#" class="number"><h1 id="accounts">0</h1></a>
                            </div>
                        </div>
                    </div>
                </div>
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
                                <tr>
                                    <td>10</td>
                                    <td>user10</td>
                                    <td>User liked this</td>
                                    <td>2024-08-04</td>
                                    <td><button class="btn btn-view btn-sm" data-id="10">View</button></td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td>user11</td>
                                    <td>Logged in</td>
                                    <td>2024-08-04</td>
                                    <td><button class="btn btn-view btn-sm" data-id="11">View</button></td>
                                </tr>
                                <tr>
                                    <td>12</td>
                                    <td>user12</td>
                                    <td>Logged out</td>
                                    <td>2024-08-04</td>
                                    <td><button class="btn btn-view btn-sm" data-id="12">View</button></td>
                                </tr>
                                <tr>
                                    <td>13</td>
                                    <td>user13</td>
                                    <td>User has posted this</td>
                                    <td>2024-08-04</td>
                                    <td><button class="btn btn-view btn-sm" data-id="13">View</button></td>
                                </tr>
                                <tr>
                                    <td>14</td>
                                    <td>user14</td>
                                    <td>User commented on this</td>
                                    <td>2024-08-04</td>
                                    <td><button class="btn btn-view btn-sm" data-id="14">View</button></td>
                                </tr>
                                <tr>
                                    <td>15</td>
                                    <td>user15</td>
                                    <td>User liked this</td>
                                    <td>2024-08-04</td>
                                    <td><button class="btn btn-view btn-sm" data-id="15">View</button></td>
                                </tr>
                                <tr>
                                    <td>16</td>
                                    <td>user16</td>
                                    <td>Logged in</td>
                                    <td>2024-08-04</td>
                                    <td><button class="btn btn-view btn-sm" data-id="16">View</button></td>
                                </tr>
                                <tr>
                                    <td>17</td>
                                    <td>user17</td>
                                    <td>Logged out</td>
                                    <td>2024-08-04</td>
                                    <td><button class="btn btn-view btn-sm" data-id="17">View</button></td>
                                </tr>
                                <tr>
                                    <td>18</td>
                                    <td>user18</td>
                                    <td>User has posted this</td>
                                    <td>2024-08-04</td>
                                    <td><button class="btn btn-view btn-sm" data-id="18">View</button></td>
                                </tr>
                                <tr>
                                    <td>19</td>
                                    <td>user19</td>
                                    <td>User commented on this</td>
                                    <td>2024-08-04</td>
                                    <td><button class="btn btn-view btn-sm" data-id="19">View</button></td>
                                </tr>
                                <tr>
                                    <td>20</td>
                                    <td>user20</td>
                                    <td>User liked this</td>
                                    <td>2024-08-04</td>
                                    <td><button class="btn btn-view btn-sm" data-id="20">View</button></td>
                                </tr>
                                <tr>
                                    <td>21</td>
                                    <td>user21</td>
                                    <td>Logged in</td>
                                    <td>2024-08-04</td>
                                    <td><button class="btn btn-view btn-sm" data-id="21">View</button></td>
                                </tr>
                                <tr>
                                    <td>22</td>
                                    <td>user22</td>
                                    <td>Logged out</td>
                                    <td>2024-08-04</td>
                                    <td><button class="btn btn-view btn-sm" data-id="22">View</button></td>
                                </tr>
                                <tr>
                                    <td>23</td>
                                    <td>user23</td>
                                    <td>User has posted this</td>
                                    <td>2024-08-04</td>
                                    <td><button class="btn btn-view btn-sm" data-id="23">View</button></td>
                                </tr>
                                <tr>
                                    <td>24</td>
                                    <td>user24</td>
                                    <td>User commented on this</td>
                                    <td>2024-08-04</td>
                                    <td><button class="btn btn-view btn-sm" data-id="24">View</button></td>
                                </tr>
                                <tr>
                                    <td>25</td>
                                    <td>user25</td>
                                    <td>User liked this</td>
                                    <td>2024-08-04</td>
                                    <td><button class="btn btn-view btn-sm" data-id="25">View</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="viewModal" class="modal">
                    <div class="modal-content">
                        <span class="close-button">&times;</span> <!-- Ensure this is correctly placed -->
                        <h2>Activity Details</h2>
                        <p><strong>ID:</strong> <span id="modalId"></span></p>
                        <p><strong>Username:</strong> <span id="modalUsername"></span></p>
                        <p><strong>Action:</strong> <span id="modalAction"></span></p>
                        <p><strong>Date:</strong> <span id="modalDate"></span></p>
                    </div>
                </div>
            </content>
        </main>
    </div>
    <script src="../../js/home_js.js"></script>
    <script src="{{ asset('js/moderator_js/mdashboard_js.js') }}"></script>
</body>
</html>
