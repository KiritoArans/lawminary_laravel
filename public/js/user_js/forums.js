// Minimize Forum List
document.addEventListener('DOMContentLoaded', function() {
    const minimizeIcon = document.getElementById('minimizeIcon');
    const forumInvitationsWrapper = document.querySelector('.forum-invitations-wrapper');
    const showForumButton = document.getElementById('showForumLists'); 

    minimizeIcon.addEventListener('click', function() {
      forumInvitationsWrapper.style.display = 'none'; 
    });
  
    showForumButton.addEventListener('click', function() {
      forumInvitationsWrapper.style.display = 'block'; 
    });
  });


  
  document.getElementById('searchInput').addEventListener('input', function() {
    const searchQuery = this.value.toLowerCase();  // Get the search input value
    const forums = document.querySelectorAll('.forum-item');  // Get all forum containers

    forums.forEach(forum => {
        const forumName = forum.querySelector('.forum-name').textContent.toLowerCase();  // Get forum name
        
        // Check if the forum name matches the search query
        if (forumName.includes(searchQuery)) {
            forum.style.display = 'block';  // Show forum if it matches
        } else {
            forum.style.display = 'none';  // Hide forum if it doesn't match
        }
    });
});

  