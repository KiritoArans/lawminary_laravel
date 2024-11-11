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


  // Search Forum and Forum Joined
  document.addEventListener('DOMContentLoaded', function () {
    const searchInputLeft = document.getElementById('searchInput'); 
    const forums = document.querySelectorAll('.forum-item'); 

    const searchInputRight = document.querySelector('.search-bar input'); 
    const forumLinks = document.querySelectorAll('.forum-invitations .forum-link'); 

    searchInputLeft.addEventListener('input', function () {
        const searchQuery = this.value.toLowerCase();

        forums.forEach(forum => {
            const forumName = forum.querySelector('.forum-name').textContent.toLowerCase();
            forum.style.display = forumName.includes(searchQuery) ? 'block' : 'none';
        });
    });

    searchInputRight.addEventListener('input', function () {
        const searchQuery = this.value.toLowerCase();

        forumLinks.forEach(link => {
            const forumName = link.querySelector('.forum-head h3').textContent.toLowerCase();
            link.style.display = forumName.includes(searchQuery) ? 'block' : 'none';
        });
    });
});




document.addEventListener('DOMContentLoaded', function () {
  const fileUpload = document.getElementById('file-upload');
  const imagePreviewSection = document.getElementById('image-preview-section');
  const imagePreview = document.getElementById('image-preview');
  const removeImage = document.getElementById('remove-image');

  fileUpload.addEventListener('change', function(event) {
      const file = event.target.files[0];
      if (file) {
          const reader = new FileReader();
          reader.onload = function(e) {
              imagePreview.src = e.target.result;
              imagePreviewSection.style.display = 'block'; 
          };
          reader.readAsDataURL(file);
      }
  });

  removeImage.addEventListener('click', function() {
      imagePreview.src = '';
      imagePreviewSection.style.display = 'none'; 
      fileUpload.value = ''; 
  });
});