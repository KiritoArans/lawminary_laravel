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
    console.log('Echo setup for replies initialized');

    // Track which comment channels we've already added listeners for
    let listenedReplyChannels = [];

    // Find all comments by their commentId (assuming each reply section has an ID like `replies-{commentId}`)
    let commentContainers = document.querySelectorAll('[id^="replies-"]');

    commentContainers.forEach(function(commentContainer) {
        let commentId = commentContainer.id.split('-')[1]; // Extract commentId from the element's ID
        console.log('Listening for replies on comment ID:', commentId);  // Log the comment ID for debugging

        // Check if we've already added a listener for this comment's reply channel
        if (!listenedReplyChannels.includes(commentId)) {
            listenedReplyChannels.push(commentId);  // Mark this channel as already listened

            // Listen to the Pusher channel for each comment's replies
            window.Echo.channel('replies.' + commentId)
                .listen('ReplyCreated', (e) => {
                    console.log('Event received for comment ID ' + commentId + ':', e);  // Log event details

                    let newReply = `
                        <div class="user-reply">
                            <div>
                                <img src="${e.user_photo_url}" 
                                    alt="User Profile Picture" 
                                    class="user-profile-photo" 
                                    onerror="this.onerror=null; this.src='{{ asset('imgs/user-img.png') }}';" />
                            </div>
                            <div class="user-reply-content">
                                <span>
                                    <a href="/profile/${e.user_id}">
                                        ${e.user_name}
                                    </a>
                                </span>
                                <p>${e.reply}</p>
                                <div class="date-reply">
                                    <p class="comment-time">Just now</p>
                                </div>
                            </div>
                        </div>
                    `;

                    // Append new reply to the correct reply section of the specific comment
                    let replyArea = document.getElementById('replies-' + commentId);
                    if (replyArea) {
                        replyArea.innerHTML += newReply;
                        console.log('New reply added to the reply section of comment ID ' + commentId);
                    } else {
                        console.error('Reply section not found for comment ID:', commentId);
                    }
                });
        } else {
            console.log('Already listening for replies on comment ID:', commentId);
        }
    });
});
