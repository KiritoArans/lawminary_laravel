// Minimize Forum List
document.addEventListener('DOMContentLoaded', function() {
    const minimizeIcon = document.getElementById('minimizeIcon');
    const forumInvitationsWrapper = document.querySelector('.forum-invitations-wrapper');
    const showForumButton = document.getElementById('showForumLists'); // Button to show the forum list
  
    // Add a click event listener to the minimize icon to hide the forum-invitations-wrapper
    minimizeIcon.addEventListener('click', function() {
      forumInvitationsWrapper.style.display = 'none';  // Hide the forum-invitations-wrapper
    });
  
    // Add a click event listener to the "See Forum Lists" button to show the forum-invitations-wrapper
    showForumButton.addEventListener('click', function() {
      forumInvitationsWrapper.style.display = 'block';  // Show the forum-invitations-wrapper
    });
  });
  