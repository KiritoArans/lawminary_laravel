<div class="container">
    <div class="boxes-row">
        <div class="box box1">
            <i class="uil uil-file-upload-alt"></i>
            <span class="fa-sharp-duotone fa-solid fa-font-case">
                <i class="fa-solid fa-spinner"></i>
                Pending Posts
            </span>
            <a href="#" class="number"><h1>{{ $pendingPosts }}</h1></a>
        </div>
        <div class="box box2">
            <i class="uil uil-comments"></i>
            <span class="fa-sharp-duotone fa-solid fa-font-case">
                <i class="fa-solid fa-person-circle-check"></i>
                Pending Accounts
            </span>
            <a href="#" class="number"><h1>{{ $pendingAccounts }}</h1></a>
        </div>
        <div class="box box3">
            <i class="uil uil-bag"></i>
            <span class="fa-sharp-duotone fa-solid fa-font-case">
                <i class="fa-solid fa-file-invoice"></i>
                Total Accounts
            </span>
            <a href="#" class="number"><h1>{{ $accountsCount }}</h1></a>
        </div>
        <div class="box box4">
            <i class="uil uil-bag"></i>
            <span class="fa-sharp-duotone fa-solid fa-font-case">
                <i class="fa-solid fa-school"></i>
                Forums
            </span>
            <a href="#" class="number"><h1>{{ $forumsCount }}</h1></a>
        </div>
    </div>
</div>

<div class="container">
    <div class="boxes-row">
        <div class="box box5">
            <i class="uil uil-newspaper"></i>
            <span class="fa-sharp-duotone fa-solid fa-font-case">
                <i class="fa-solid fa-file"></i>
                Total Posts
            </span>
            <a href="#" class="number"><h1>{{ $totalPosts }}</h1></a>
        </div>
        <div class="box box6">
            <i class="uil uil-comment-alt"></i>
            <span class="fa-sharp-duotone fa-solid fa-font-case">
                <i class="fa-solid fa-user-tie"></i>
                Answered Concerns
            </span>
            <a href="#" class="number">
                <h1>{{ $totalConcernsCommentedByLawyer }}</h1>
            </a>
        </div>
        <div class="box box7">
            <i class="uil uil-trophy"></i>
            <span class="fa-sharp-duotone fa-solid fa-font-case">
                <i class="fa-solid fa-award"></i>
                Highest Leaderboard Points
            </span>
            <a href="#" class="number">
                <h1>{{ $highestLeaderboardPoints }}</h1>
            </a>
        </div>
        <div class="box box8">
            <i class="uil uil-gavel"></i>
            <span class="fa-sharp-duotone fa-solid fa-font-case">
                <i class="fa-solid fa-scale-balanced"></i>
                Total Laws
            </span>
            <a href="#" class="number"><h1>{{ $totalLaws }}</h1></a>
        </div>
    </div>
</div>
