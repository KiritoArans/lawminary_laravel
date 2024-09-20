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
