document.addEventListener('DOMContentLoaded', function() {
    const replyForms = document.querySelectorAll('form[id^="reply-form"]');

    replyForms.forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting the traditional way

            const formData = new FormData(form); // Prepare form data for AJAX submission

            // Fetch comment_id directly from the hidden input field inside the form
            const commentId = form.querySelector('input[name="comment_id"]').value; 

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
            })
            .then(response => response.json()) // Ensure we parse JSON response
            .then(data => {
                if (data.success) {
                    // Find the correct reply section for the comment
                    var replySection = document.getElementById('replies-' + commentId);

                    // Check if reply section exists
                    if (replySection) {
                        // Show the reply section if it's hidden
                        replySection.style.display = 'block';

                        // Append the new reply's HTML to the reply section
                        const newReplyHTML = `
                            <div class="user-reply">
                                <div>
                                    <img src="${data.new_reply.user_photo_url}" alt="User Profile Picture" class="user-profile-photo" />
                                </div>
                                <div class="user-reply-content">
                                    <span>
                                        <a href="/profile/${data.new_reply.user_id}">
                                            ${data.new_reply.user_name}
                                        </a>
                                    </span>
                                    <p>${data.new_reply.reply}</p>
                                    <div class="date-reply">
                                        <p class="comment-time">Just now</p>
                                    </div>
                                </div>
                            </div>
                        `;
                        
                        // Append the new reply to the reply section
                        replySection.innerHTML += newReplyHTML;

                        // Clear the reply textarea
                        form.querySelector('textarea').value = '';

                        // Show success alert using SweetAlert
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Your reply has been posted.',
                        });
                    } else {
                        console.error('Reply section not found.');
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error posting reply. Please try again.'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An unexpected error occurred.',
                });
                console.error('Error:', error);
            });
        });
    });
});
