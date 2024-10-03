document.addEventListener('DOMContentLoaded', function () {
    const followersTab = document.getElementById('followers-tab');
    const followingTab = document.getElementById('following-tab');
    const followersList = document.getElementById('followers-list');
    const followingList = document.getElementById('following-list');
    const searchInput = document.getElementById('searchInput'); // The search input field

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
        searchInput.value = ''; // Clear search input on tab switch
        filterList(followersList); // Filter followers list
    }

    function showFollowing() {
        followersTab.classList.remove('active-tab');
        followingTab.classList.add('active-tab');
        followersList.style.display = 'none';
        followingList.style.display = 'block';
        searchInput.value = ''; // Clear search input on tab switch
        filterList(followingList); // Filter following list
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

    // Add search functionality
    searchInput.addEventListener('keyup', function () {
        const activeList = followersList.style.display === 'block' ? followersList : followingList;
        filterList(activeList); // Filter the currently active list
    });

    // Function to filter the list based on the search query
    function filterList(list) {
        const searchTerm = searchInput.value.toLowerCase();
        const listItems = list.getElementsByTagName('li');

        for (let i = 0; i < listItems.length; i++) {
            const userInfo = listItems[i].getElementsByClassName('user-info')[0];
            const fullName = userInfo ? userInfo.textContent.toLowerCase() : '';

            if (fullName.includes(searchTerm)) {
                listItems[i].style.display = ''; // Show the item
            } else {
                listItems[i].style.display = 'none'; // Hide the item
            }
        }
    }
});
