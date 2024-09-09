// Option Button
document.querySelectorAll('.post-options i').forEach(function (button) {
    button.addEventListener('click', function () {
        // Find the closest .post-options container and toggle its .options menu
        let postOptions = button.closest('.post-options'); // Find the parent .post-options container
        let options = postOptions.querySelector('.options'); // Select the .options within this post-options
        
        // Toggle the visibility of the .options menu
        if (options.style.display === 'block') {
            options.style.display = 'none';
        } else {
            options.style.display = 'block';
        }
    });
});



// Comment Button
document.addEventListener('DOMContentLoaded', function () {
    function setupPostModal() {
        // Event delegation for handling clicks on comment buttons
        document.body.addEventListener('click', function (event) {
            // Check if the clicked element has the class 'btn-comment'
            if (event.target.closest('.btn-comment')) {
                // Get the button element
                const commentBtn = event.target.closest('.btn-comment');
                const postId = commentBtn.getAttribute('data-post-id'); // Get post ID from button
                const commentModal = document.getElementById('commentModal-' + postId); // Get the correct modal by ID

                if (commentModal) {
                    console.log('Opening modal for post ID:', postId); // Debugging log
                    // Hide all other modals before showing the selected one
                    document.querySelectorAll('.comment-modal').forEach(function (commentModal) {
                        commentModal.style.display = 'none';
                    });
                    // Display the correct modal
                    commentModal.style.display = 'block';
                } else {
                    Swal.fire({
                        title: 'Post Unavailable',
                        text: 'Concern might have been deleted by the owner.',
                        icon: 'error',
                        confirmButtonText: 'Okay'
                    });
                }
            }
        });

        // Close modal if clicked outside the modal content
        window.addEventListener('click', function (event) {
            document.querySelectorAll('.comment-modal').forEach(function (commentModal) {
                if (event.target === commentModal) {
                    commentModal.style.display = 'none';
                }
            });
        });
    }
    // Function to handle reply buttons
    function setupReplyButtons() {
        document.body.addEventListener('click', function (event) {
            if (event.target.closest('.reply-btn')) {
                const replyBtn = event.target.closest('.reply-btn');
                const commentId = replyBtn.getAttribute('data-comment-id');
                const replyField = document.getElementById('reply-field-' + commentId);

                if (replyField) {
                    // Toggle the display of the reply field
                    if (replyField.style.display === 'none' || replyField.style.display === '') {
                        replyField.style.display = 'block';
                    } else {
                        replyField.style.display = 'none';
                    }
                }
            }
        });
    }
    // Initialize both functions
    setupPostModal();
    setupReplyButtons();
});


// Post Modal
var newPostModal = document.getElementById("postModal");
var createPostBtn = document.querySelector(".new-post");
var span = document.getElementsByClassName("close")[0];
var postButton = document.querySelector(".post-button");
createPostBtn.onclick = function() {
    newPostModal.style.display = "flex";
}
span.onclick = function() {
    newPostModal.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == newPostModal) {
        newPostModal.style.display = "none";
    }
}