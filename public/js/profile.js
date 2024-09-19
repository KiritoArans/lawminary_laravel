document.addEventListener("DOMContentLoaded", function() {
    // Highlight the active nav item
    const navItems = document.querySelectorAll(".profile-nav ul li");

    // Set default active to "Posts"
    const postsLink = document.getElementById('posts-link').parentElement;
    postsLink.classList.add('active');  // Add 'active' class to posts link by default

    navItems.forEach(item => {
        item.addEventListener("click", function() {
            navItems.forEach(i => i.classList.remove("active"));  // Remove active class from all
            this.classList.add("active");  // Add active class to the clicked item
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
        profilePosts.style.display = 'none';
        profileComments.style.display = 'none';
        profileLiked.style.display = 'none';
        profileBookmarked.style.display = 'none';
    }

    // Set the default section to 'Posts'
    hideAllSections();  // Hide all first
    profilePosts.style.display = 'block';  // Show posts by default

    // Event listeners for each navigation link
    postsLink.addEventListener('click', (event) => {
        event.preventDefault();
        hideAllSections();  // Hide everything
        profilePosts.style.display = 'block';  // Show posts
    });

    commentsLink.addEventListener('click', (event) => {
        event.preventDefault();
        hideAllSections();  // Hide everything
        profileComments.style.display = 'block';  // Show comments
    });

    likedLink.addEventListener('click', (event) => {
        event.preventDefault();
        hideAllSections();  // Hide everything
        profileLiked.style.display = 'block';  // Show liked posts
    });

    bookmarkedLink.addEventListener('click', (event) => {
        event.preventDefault();
        hideAllSections();  // Hide everything
        profileBookmarked.style.display = 'block';  // Show bookmarks
    });
});
