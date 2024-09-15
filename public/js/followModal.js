document.addEventListener('DOMContentLoaded', function () {
    const followersTab = document.getElementById('followers-tab');
    const followingTab = document.getElementById('following-tab');
    const followersList = document.getElementById('followers-list');
    const followingList = document.getElementById('following-list');
    
    const followingDiv = document.querySelector('.following-count'); 
    const followerDiv = document.querySelector('.follower-count'); 
    const followModal = document.getElementById('followModal'); 
    const closeModal = document.querySelector('.followModal .close'); 

    // By default, show followers and set the active tab
    followersTab.classList.add('active-tab');
    
    function showFollowers() {
        followersTab.classList.add('active-tab');
        followingTab.classList.remove('active-tab');
        followersList.style.display = 'block';
        followingList.style.display = 'none';
    }

    function showFollowing() {
        followersTab.classList.remove('active-tab');
        followingTab.classList.add('active-tab');
        followersList.style.display = 'none';
        followingList.style.display = 'block';
    }

    followersTab.addEventListener('click', function (e) {
        e.preventDefault();
        showFollowers();
    });

    followingTab.addEventListener('click', function (e) {
        e.preventDefault();
        showFollowing();
    });

    followingDiv.addEventListener('click', function () {
        followModal.style.display = 'flex'; 
    });
    followerDiv.addEventListener('click', function () {
        followModal.style.display = 'flex'; 
    });

    closeModal.addEventListener('click', function () {
        followModal.style.display = 'none'; 
    });

    window.addEventListener('click', function (event) {
        if (event.target === followModal) {
            followModal.style.display = 'none';
        }
    });
});