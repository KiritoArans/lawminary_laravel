<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Resources</title>
    <link rel="icon" href="{{ asset('imgs/lawminarylogo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/moderator/mrecourcesstyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/moderator/base_moderator_table_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/moderator/base_moderator_modal_style.css') }}">
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
                        <li><a href="/moderator/resources"  class="current"><i class="fa-solid fa-folder"></i><span>Resources</span></a></li>
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

                                    <button class="custom-button" type="submit" class="apply-button">Apply Filters</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="add-container">
                    <button class="custom-button" id="addButton">Add</button>
                </div>
                <div id="addModal" class="modal">
                    <div class="modal-content">
                        <span class="close-button">&times;</span>
                        <h2>Add Resource</h2>
                        <div class="error">
                            @if($errors->any())
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                        <form id="resourceForm" enctype="multipart/form-data" method="post" action="{{route('moderator.uploadResource')}}">
                            @csrf
                            <label for="documentTitle">Document Title:</label>
                            <input type="text" id="documentTitle" name="documentTitle" placeholder="Enter Document Name" required>

                            <label for="documentDesc">Document Description:</label>
                            <input type="text" id="documentDesc" name="documentDesc" placeholder="Enter Description" required>
    
                            <label for="documentFile">Upload File:</label>
                            <input class="custom-button "type="file" id="documentFile" name="documentFile" accept=".pdf,.doc,.docx,.jpg,.png,.zip" required>

                            <div class="form-buttons">
                                <button class="custom-button" type="submit" class="save-button">Add File</button>
                            </div>
                        </form>
                    </div>
                </div>
            </header>
            <content>
                <div class="table">
                    <table class="resource-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Document Name</th>
                                <th>Document Desc</th>
                                <th>File</th>
                                <th>Date Uploaded</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rsrcfiles as $rsrcfile)
                            <tr>
                                <td>{{$rsrcfile->id}}</td>
                                <td>{{$rsrcfile->documentTitle}}</td>
                                <td>{{$rsrcfile->documentDesc}}</td>
                                <td>{{$rsrcfile->documentFile}}</td>
                                <td>{{$rsrcfile->created_at}}</td>
                                <td>
                                    <button type="button" class="custom-button view-button" 
                                    data-id="{{$rsrcfile->id}}" 
                                    data-title="{{$rsrcfile->documentTitle}}" 
                                    data-desc="{{$rsrcfile->documentDesc}}" 
                                    data-file="{{$rsrcfile->documentFile}}" 
                                    data-date="{{$rsrcfile->created_at}}"
                                    >View</button>
                                    <form method="post" action="{{route('moderator.destroyResource', ['rsrcfile' => $rsrcfile])}}" onsubmit="confirmDelete(event);">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="delete-button">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            
                <div id="viewModal" class="modal">
                    <div class="modal-content">
                        <span class="close-button" id="closeButton">&times;</span>
                        <h2>View Resource</h2>
                        <div class="error">
                            @if($errors->any())
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                        <form id="editResourceForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <label>ID:</label>
                            <input id="rsrcId" name="id" value="" readonly>
                        
                            <label>Document Name:</label>
                            <input type="text" id="rsrcDocumentTitle" name="documentTitle" placeholder="Enter Document Name" value="">
                            
                            <label>Document Description:</label>
                            <input type="text" id="rsrcDocumentDesc" name="documentDesc" placeholder="Enter Description" value="">
                        
                            <label>File:</label>
                            <input type="file" id="rsrcDocumentFile" name="documentFile" accept=".pdf,.doc,.docx,.jpg,.png,.zip" hidden>
                            <a id="rsrcDocumentFileLink" href="" download=""></a>
                            
                            <label for="newDocumentFile">Upload New File:</label>
                            <input type="file" id="newDocumentFile" name="documentFile">
                        
                            <label>Date Uploaded:</label>
                            <input id="rsrcDateUploaded" name="created_at" value="" readonly>
                        
                            <button type="submit" class="custom-button">Save</button>
                        </form>                        
                    </div>
                </div>
            </content>
            
        </main>
    </div>
    <script src="{{ asset('js/moderator_js/mresources_js.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
