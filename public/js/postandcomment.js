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



// // Comments
// document.addEventListener('DOMContentLoaded', function () {
//     document.querySelectorAll('.btn-comment').forEach(function (button) {
//         button.addEventListener('click', function () {
//             const postId = this.getAttribute('data-post-id');
//             const modal = document.getElementById('commentModal-' + postId);

//             if (modal) {
//                 // Hide all other modals
//                 document.querySelectorAll('.comment-modal').forEach(function (modal) {
//                     modal.style.display = 'none';
//                 });
//                     modal.style.display = 'block';
//             }
//         });
//     });
//     // Hide the modal when clicking outside of it
//     window.addEventListener('click', function (event) {
//         document.querySelectorAll('.comment-modal').forEach(function (modal) {
//             if (event.target === modal) {
//                 modal.style.display = 'none';
//             }
//         });
//     });
// });

// // Reply
// document.addEventListener('DOMContentLoaded', function () {
//     let replyButtons = document.querySelectorAll('.reply-btn');

//     replyButtons.forEach(function (button) {
//         button.addEventListener('click', function () {
//             let commentId = this.getAttribute('data-comment-id');
//             let replyField = document.getElementById('reply-field-' + commentId);

//             // Toggle the display of the reply field
//             if (replyField.style.display === 'none' || replyField.style.display === '') {
//                 replyField.style.display = 'block';
//             } else {
//                 replyField.style.display = 'none';
//             }
//         });
//     });
// });

// Wait for the DOM to load before running scripts
document.addEventListener('DOMContentLoaded', function () {
    // Function to handle opening and closing post modals
    function setupPostModal() {
        // Get all the "View Post" buttons
        document.querySelectorAll('.btn-comment').forEach(function (button) {
            button.addEventListener('click', function () {
                const postId = this.getAttribute('data-post-id'); // Get post ID from button
                const modal = document.getElementById('commentModal-' + postId); // Get the correct modal

                if (modal) {
                    // Hide all other modals before showing the selected one
                    document.querySelectorAll('.comment-modal').forEach(function (modal) {
                        modal.style.display = 'none';
                    });
                    // Display the correct modal
                    modal.style.display = 'block';
                }
            });
        });

        window.addEventListener('click', function (event) {
            document.querySelectorAll('.comment-modal').forEach(function (modal) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        });
    }

    // Function to handle replies for comments
    function setupReplyButtons() {
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
    }

    // Call the setup functions to activate modals and replies
    setupPostModal();
    setupReplyButtons();
});
