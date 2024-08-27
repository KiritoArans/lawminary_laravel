<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Leaderboards</title>
    <link rel="icon" href="{{ asset('imgs/lawminarylogo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/moderator/mleaderboardsstyle.css') }}">
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
                        <li><a href="/moderator/leaderboards" class="current"><i class="fa-solid fa-chart-simple"></i><span>Leaderboards</span></a></li>
                        <li><a href="/moderator/resources"><i class="fa-solid fa-folder"></i><span>Resources</span></a></li>
                        <li><a href="/moderator/accounts"><i class="fa-solid fa-user-gear"></i><span>Accounts</span></a></li>
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
                    <img src="../../imgs/Lawminary_Logo_2-Gold.png" alt="">
                </div>
                <hr class="divider">
        
                <div class="filter-container">
                    <div class="search-bar">
                    <h1>Leaderboards</h1>
                    <input type="text" placeholder="Search posts...">
                    <div class="filter-btn">
                        <button id="filterButton">Filter</button>
                    </div>

                    <div id="filterModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button">&times;</span>
                            <h2>Filter Posts</h2>
                            
                            <form id="filterForm">
                                <label for="filterRank">Filter by Rank:</label>
                                <input type="text" id="filterRank" name="filterRank">
                            
                                <label for="filterUsername">Filter by Username:</label>
                                <input type="text" id="filterUsername" name="filterUsername">
                            
                                <label for="filterPoints">Filter by Activity Points:</label>
                                <input type="text" id="filterPoints" name="filterPoints">
                            
                                <label for="filterBadge">Filter by Badge:</label>
                                <input type="text" id="filterBadge" name="filterBadge">
                            
                                <label for="filterAction">Filter by Action:</label>
                                <input type="text" id="filterAction" name="filterAction">
                                
                                <button type="submit">Apply Filters</button>
                            </form>        
                        </div>
                    </div>
                </div>
            </header>
            <content>
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Username</th>
                                <th>Activity Points</th>
                                <th>Badge</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Username1</td>
                                <td>1200</td>
                                <td>Gold</td>
                                <td><button class="action-btn" data-rank="1" data-username="Username1" data-points="1200" data-badge="Gold">Action</button></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Username2</td>
                                <td>1100</td>
                                <td>Silver</td>
                                <td><button class="action-btn" data-rank="2" data-username="Username2" data-points="1100" data-badge="Silver">Action</button></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Username3</td>
                                <td>1000</td>
                                <td>Bronze</td>
                                <td><button class="action-btn" data-rank="3" data-username="Username3" data-points="1000" data-badge="Bronze">Action</button></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Username4</td>
                                <td>900</td>
                                <td>Silver</td>
                                <td><button class="action-btn" data-rank="4" data-username="Username4" data-points="900" data-badge="Silver">Action</button></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Username5</td>
                                <td>850</td>
                                <td>Gold</td>
                                <td><button class="action-btn" data-rank="5" data-username="Username5" data-points="850" data-badge="Gold">Action</button></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Username6</td>
                                <td>800</td>
                                <td>Bronze</td>
                                <td><button class="action-btn" data-rank="6" data-username="Username6" data-points="800" data-badge="Bronze">Action</button></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Username7</td>
                                <td>750</td>
                                <td>Silver</td>
                                <td><button class="action-btn" data-rank="7" data-username="Username7" data-points="750" data-badge="Silver">Action</button></td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Username8</td>
                                <td>700</td>
                                <td>Gold</td>
                                <td><button class="action-btn" data-rank="8" data-username="Username8" data-points="700" data-badge="Gold">Action</button></td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>Username9</td>
                                <td>650</td>
                                <td>Bronze</td>
                                <td><button class="action-btn" data-rank="9" data-username="Username9" data-points="650" data-badge="Bronze">Action</button></td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>Username10</td>
                                <td>600</td>
                                <td>Silver</td>
                                <td><button class="action-btn" data-rank="10" data-username="Username10" data-points="600" data-badge="Silver">Action</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div id="actionModal" class="modal">
                    <div class="modal-content">
                        <span class="close-button">&times;</span>
                        <h2>Activity Details</h2>
                        <p><strong>Rank:</strong> <span id="modalRank"></span></p>
                        <p><strong>Username:</strong> <span id="modalUsername"></span></p>
                        <p><strong>Activity Points:</strong> <span id="modalPoints"></span></p>
                        <p><strong>Badge:</strong> <span id="modalBadge"></span></p>
                    </div>
                </div>
            </content>
        </main>
    </div>
    <script src="../../js/home_js.js"></script>
    <script src="{{ asset('js/moderator_js/mleaderboards_js.js') }}"></script>
</body>
</html>
