document.addEventListener('DOMContentLoaded', function() {
    var leaderboardWrapper = document.getElementById('leaderboards');
    var loggedInUserId = leaderboardWrapper.getAttribute('data-logged-in-user-id');

    var leaderboardItems = document.querySelectorAll('.leaderboards-content');

    leaderboardItems.forEach(function(item) {
        item.addEventListener('click', function() {
            var lawyerUserId = item.getAttribute('data-lawyer-id');

            if (loggedInUserId && loggedInUserId === lawyerUserId) {
                window.location.href = "/profile";
            } else {
                window.location.href = "/profile-" + lawyerUserId;
            }
        });
    });
});



function openBadgeChart() {
    document.getElementById("badgeModal").style.display = "block";
}

function closeBadgeChart() {
    document.getElementById("badgeModal").style.display = "none";
}

window.onclick = function(event) {
    let badgeModal = document.getElementById("badgeModal");
    if (event.target == badgeModal) {
        badgeModal.style.display = "none";
    }
}