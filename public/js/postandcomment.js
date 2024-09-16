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

// Delete Post Sweet Alert
function confirmDelete(postId) {
    Swal.fire({
        title: 'Deleting Post',
        text: "Do you want to delete this post?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'Cancel',
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + postId).submit();
        }
    })
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

// Preview Concern Image
const fileUpload = document.getElementById('file-upload');
const imagePreviewSection = document.getElementById('image-preview-section');
const imagePreview = document.getElementById('image-preview');
const removeImage = document.getElementById('remove-image');

// Show image preview when a file is selected
fileUpload.addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreviewSection.style.display = 'block'; // Show the image preview section
        };
        reader.readAsDataURL(file);
    }
});

// Remove image preview when 'X' button is clicked
removeImage.addEventListener('click', function() {
    imagePreview.src = ''; // Clear the image preview source
    imagePreviewSection.style.display = 'none'; // Hide the image preview section
    fileUpload.value = ''; // Reset the file input field
});