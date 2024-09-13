// Option Button
document.querySelectorAll('.post-options i').forEach(function (button) {
    button.addEventListener('click', function () {
        let postOptions = button.closest('.post-options'); 
        let options = postOptions.querySelector('.options'); 
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
        document.body.addEventListener('click', function (event) {
            if (event.target.closest('.btn-comment')) {

                const commentBtn = event.target.closest('.btn-comment');
                const postId = commentBtn.getAttribute('data-post-id'); 
                const commentModal = document.getElementById('commentModal-' + postId); 

                if (commentModal) {
                    console.log('Opening modal for post ID:', postId); 
                    document.querySelectorAll('.comment-modal').forEach(function (commentModal) {
                        commentModal.style.display = 'none';
                    });
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
                    if (replyField.style.display === 'none' || replyField.style.display === '') {
                        replyField.style.display = 'block';
                    } else {
                        replyField.style.display = 'none';
                    }
                }
            }
        });
    }
    
    setupPostModal();
    setupReplyButtons();
});

// View and Hide Reply
function toggleReplies(commentId, linkElement) {
    var replySection = document.getElementById('replies-' + commentId);

    if (replySection.style.display === 'none') {
        replySection.style.display = 'block';
        linkElement.textContent = 'Hide Replies'; 
    } else {
        replySection.style.display = 'none';
        linkElement.textContent = 'View Replies';
    }
}

// Post Modal
var newPostModal = document.getElementById("postModal");
var createPostBtn = document.querySelector(".new-post");
var span = document.getElementsByClassName("close")[0];

    createPostBtn.onclick = function() {
        newPostModal.style.display = "flex";
    }

    span.onclick = function() {
        newPostModal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target === newPostModal) {
            newPostModal.style.display = "none";
        }
}
