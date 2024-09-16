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


// Rate Modal:
document.addEventListener('DOMContentLoaded', function () {
    let rateModal = document.getElementById('rateModal');
    let closeRateModal = document.querySelector('.close-rate-modal');
    let commentIdInput = document.getElementById('rating_comment_id'); // Hidden input to store comment ID
    let starRatingInput = document.getElementById('star-rating'); // Hidden input for the rating
    let rateStars = document.querySelectorAll('.rate-btn'); // Target all buttons that open the modal
    let starIcons = document.querySelectorAll('.star'); // Target the star icons for rating selection

    // Loop through all the stars (rate buttons) that open the modal and add event listeners
    rateStars.forEach(star => {
        star.addEventListener('click', function () {
            // Find the comment ID from the data-comment-id attribute
            let commentId = this.getAttribute('data-rating-comment-comment_id');
            
            // Set the comment ID in the hidden input inside the modal
            commentIdInput.value = commentId;
            
            console.log('Rating Comment ID:', commentId); // Log for debugging
            rateModal.style.display = 'flex'; // Show the modal
        });
    });

    // Handle the star rating selection
    starIcons.forEach(star => {
        star.addEventListener('click', function () {
            let selectedRating = this.getAttribute('data-rating');
            
            // Set the rating value in the hidden input field
            starRatingInput.value = selectedRating;

            // Highlight stars up to the clicked one (left to right)
            starIcons.forEach(star => star.classList.remove('selected-star')); // Remove the highlight for all
            for (let i = 0; i < selectedRating; i++) {
                starIcons[i].classList.add('selected-star'); // Add highlight for the stars up to the clicked one
            }
        });
    });

    // Close the modal when clicking the close button
    closeRateModal.addEventListener('click', function () {
        rateModal.style.display = 'none';
    });

    // Close the modal if clicking outside the modal content
    window.addEventListener('click', function (event) {
        if (event.target === rateModal) {
            rateModal.style.display = 'none';
        }
    });
});









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