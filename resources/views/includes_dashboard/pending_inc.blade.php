<div class="container">
    <!-- First Row (3 boxes) -->
    <div class="boxes-row">
        <div class="box box1">
            <i class="uil uil-file-upload-alt"></i>
            <span class="text">Pending Posts</span>
            <a href="#" class="number"><h1>{{ $pendingPosts }}</h1></a>
        </div>
        <div class="box box2">
            <i class="uil uil-comments"></i>
            <span class="text">Pending Accounts</span>
            <a href="#" class="number"><h1>{{ $pendingAccounts }}</h1></a>
        </div>
        <div class="box box3">
            <i class="uil uil-bag"></i>
            <span class="text">Accounts</span>
            <a href="#" class="number"><h1>{{ $accountsCount }}</h1></a>
        </div>
    </div>

    <!-- Second Row (3 boxes) -->
    <div class="boxes-row">
        <div class="box box4">
            <i class="uil uil-bag"></i>
            <span class="text">Posts</span>
            <a href="#" class="number"><h1>{{ $postsCount }}</h1></a>
        </div>
        <div class="box box5">
            <i class="uil uil-comments"></i>
            <span class="text">Comments</span>
            <a href="#" class="number"><h1>{{ $commentsCount }}</h1></a>
        </div>
        <div class="box box6">
            <i class="uil uil-bag"></i>
            <span class="text">Forums</span>
            <a href="#" class="number"><h1>{{ $forumsCount }}</h1></a>
        </div>
    </div>
</div>
