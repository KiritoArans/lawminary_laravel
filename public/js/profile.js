document.addEventListener("DOMContentLoaded", function() {
    const navItems = document.querySelectorAll(".profile-nav ul li");

    const postsLink = document.getElementById('posts-link');
    postsLink.classList.add('active'); 

    navItems.forEach(item => {
        item.addEventListener("click", function() {
            navItems.forEach(i => i.classList.remove("active"));  
            this.classList.add("active");  
        });
    });
});
document.addEventListener('DOMContentLoaded', (event) => {
    const postsLink = document.getElementById('posts-link');
    const commentsLink = document.getElementById('comments-link');
    const likedLink = document.getElementById('liked-link');
    const bookmarkedLink = document.getElementById('bookmarked-link');

    const profilePosts = document.querySelector('.profile-posts');
    const profileComments = document.querySelector('.profile-comments');
    const profileLiked = document.querySelector('.profile-liked');
    const profileBookmarked = document.querySelector('.profile-bookmarked');

    // Function to hide all sections
    function hideAllSections() {
        if (profilePosts) profilePosts.style.display = 'none';
        if (profileComments) profileComments.style.display = 'none';
        if (profileLiked) profileLiked.style.display = 'none';
        if (profileBookmarked) profileBookmarked.style.display = 'none';
    }

    // Set the default section to 'Posts'
    hideAllSections(); 
    if (profilePosts) profilePosts.style.display = 'block';  // Show posts by default

    // Event listeners for each navigation link
    postsLink.addEventListener('click', (event) => {
        event.preventDefault();
        hideAllSections();
        if (profilePosts) profilePosts.style.display = 'block';
    });

    commentsLink.addEventListener('click', (event) => {
        event.preventDefault();
        hideAllSections();
        if (profileComments) profileComments.style.display = 'block';
    });

    likedLink.addEventListener('click', (event) => {
        event.preventDefault();
        hideAllSections();
        if (profileLiked) profileLiked.style.display = 'block';
    });

    bookmarkedLink.addEventListener('click', (event) => {
        event.preventDefault();
        hideAllSections();
        if (profileBookmarked) profileBookmarked.style.display = 'block';
    });
});

function openModal() {
    document.getElementById("profileModal").style.display = "block";
}

function closeModal() {
    document.getElementById("profileModal").style.display = "none";
}

// Close the modal when the user clicks outside of the modal content
window.onclick = function(event) {
    const modal = document.getElementById("profileModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


document.addEventListener('DOMContentLoaded', function () {
    const sortFilter = document.getElementById('sortFilter');
    const postsContainer = document.getElementById('posts-container');

    sortFilter.addEventListener('change', function () {
        const selectedValue = this.value;
        let postsArray = Array.from(postsContainer.children); // Convert NodeList to an array

        // Sort the posts based on the selected value (newest or oldest)
        postsArray.sort(function (a, b) {
            const timeA = new Date(a.getAttribute('data-post-time'));
            const timeB = new Date(b.getAttribute('data-post-time'));

            if (selectedValue === 'newest') {
                return timeB - timeA; // Sort descending (newest first)
            } else if (selectedValue === 'oldest') {
                return timeA - timeB; // Sort ascending (oldest first)
            }
        });

        // Re-append sorted posts to the container
        postsArray.forEach(function (post) {
            postsContainer.appendChild(post);
        });
    });
});