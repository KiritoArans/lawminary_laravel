document.addEventListener("DOMContentLoaded", function() {
    const navItems = document.querySelectorAll(".profile-nav ul li");

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

    function hideAllSections() {
        profilePosts.style.display = 'none';
        profileComments.style.display = 'none';
        profileLiked.style.display = 'none';
        profileBookmarked.style.display = 'none';
    }

    postsLink.addEventListener('click', (event) => {
        event.preventDefault();
        hideAllSections();
        profilePosts.style.display = 'block';
    });

    commentsLink.addEventListener('click', (event) => {
        event.preventDefault();
        hideAllSections();
        profileComments.style.display = 'block';
    });

    likedLink.addEventListener('click', (event) => {
        event.preventDefault();
        hideAllSections();
        profileLiked.style.display = 'block';
    });

    bookmarkedLink.addEventListener('click', (event) => {
        event.preventDefault();
        hideAllSections();
        profileBookmarked.style.display = 'block';
    });
});
