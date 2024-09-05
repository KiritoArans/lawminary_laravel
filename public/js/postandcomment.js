// Post Modal
var modal = document.getElementById("postModal");
var btn = document.querySelector(".new-post");
var span = document.getElementsByClassName("close")[0];
var postButton = document.querySelector(".post-button");
btn.onclick = function() {
    modal.style.display = "flex";
}
span.onclick = function() {
    modal.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

document.querySelector('.post-options i').addEventListener('click', function() {
    const options = document.querySelector('.post-options .options');
    if (options.style.display === 'block') {
        options.style.display = 'none';
    } else {
        options.style.display = 'block';
    }
});


// Comments
document.addEventListener('DOMContentLoaded', function () {
    // Function to show the relevant modal when the comment button is clicked
    document.querySelectorAll('.btn-comment').forEach(function (button) {
        button.addEventListener('click', function () {
            const postId = this.getAttribute('data-post-id');
            const modal = document.getElementById('commentModal-' + postId);

            if (modal) {
                // Hide all other modals
                document.querySelectorAll('.comment-modal').forEach(function (modal) {
                    modal.style.display = 'none';
                });
                    modal.style.display = 'block';
            }
        });
    });
    // Hide the modal when clicking outside of it
    window.addEventListener('click', function (event) {
        document.querySelectorAll('.comment-modal').forEach(function (modal) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    });
});



// Reply
document.addEventListener('DOMContentLoaded', function () {
    let replyButtons = document.querySelectorAll('.reply-btn');

    replyButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            let commentId = this.getAttribute('data-comment-id');
            let replyField = document.getElementById('reply-field-' + commentId);

            // Toggle the display of the reply field
            if (replyField.style.display === 'none' || replyField.style.display === '') {
                replyField.style.display = 'block';
            } else {
                replyField.style.display = 'none';
            }
        });
    });
});