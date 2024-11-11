@if($user->accountType === 'Lawyer')
    <div id="helpedModal" class="helpedModal" style="display: none;">
        <div class="helpedModal-content">
            <span class="closeHelpedModal" id="closeHelpedModal">&times;</span>
            <div class="user-helped">
                <h2>Number of Users Helped</h2>
                <h1><i class="fa-solid fa-user-group"></i> {{ $helpedUserCount }}</h1>
            </div>
            <div class="user-rating">
                <h2>Average Rating</h2>
                <h1><i class="fa-solid fa-star"></i> {{ $averageRating }}</h1>
            </div>
        </div>
    </div>
@endif