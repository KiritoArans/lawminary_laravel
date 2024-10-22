import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Enable Pusher logging for debugging
Pusher.logToConsole = true;

// Initialize Echo with Pusher using actual values
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'c41885dad45d1f907ea8',  // Use actual Pusher key
    cluster: 'ap1',  // Use actual Pusher cluster
    forceTLS: false  // Change to true if using TLS
});


document.addEventListener('DOMContentLoaded', function() {
    console.log('Echo setup initialized');  // <-- Ensure this shows up in the console

    // Find all posts by their postId (assuming each post container has an ID like `post-{postId}`)
    let postContainers = document.querySelectorAll('[id^="comment-area-"]');
    
    postContainers.forEach(function(postContainer) {
        let postId = postContainer.id.split('-')[2]; // Extract postId from the element's ID
        console.log('Listening for comments on post ID:', postId);  // Log the post ID for debugging

        // Listen to the Pusher channel for each post's comments
        window.Echo.channel('comments.' + postId)
            .listen('CommentCreated', (e) => {
                console.log('Event received for post ID ' + postId + ':', e);  // Log event details

                let newComment = `
                    <div class="user-comment">
                        <div>
                            <img src="${e.user_photo_url}" alt="User Profile Picture" class="user-profile-photo" />
                        </div>
                        <div class="user-comment-content">
                            <span>
                                <a href="/profile/${e.user_id}">
                                    ${e.user_name}
                                </a>
                            </span>
                            <p>${e.comment}</p>
                            <div class="date-reply">
                                <p class="comment-time">Just now</p>
                            </div>
                        </div>
                    </div>
                `;

                // Append new comment to the correct comment area of the specific post
                let commentArea = document.getElementById('comment-area-' + postId);
                if (commentArea) {
                    commentArea.innerHTML += newComment;
                    console.log('New comment added to the comment area of post ID ' + postId);
                } else {
                    console.error('Comment area not found for post ID:', postId);
                }
            });
    });
});
