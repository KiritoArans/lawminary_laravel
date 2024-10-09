document.addEventListener('DOMContentLoaded', function() {
    const commentForms = document.querySelectorAll('form[id^="commentForm"]');

    commentForms.forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting the traditional way

            const formData = new FormData(form); // Prepare form data for AJAX submission
            const postId = form.querySelector('input[name="post_id"]').value;

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
                    // Append the new comment's HTML to the comment section
                    const newCommentHTML = `
                        <div class="user-comment">
                            <div>
                                <img src="${data.new_comment.user_photo_url}" alt="User Profile Picture" class="user-profile-photo" />
                            </div>
                            <div class="user-comment-content">
                                <span>
                                    <a href="/profile/${data.new_comment.user_id}">
                                        ${data.new_comment.user_name}
                                    </a>
                                </span>
                                <p>${data.new_comment.comment}</p>
                                <div class="date-reply">
                                    <p class="comment-time">Just now</p>
                                </div>
                            </div>
                        </div>
                    `;

                    // Find the correct comment-area for the post
                    const commentArea = document.getElementById(`comment-area-${postId}`);
                    
                    // Append the new comment to the comment-area
                    commentArea.innerHTML += newCommentHTML;

                    // Clear the comment textarea
                    form.querySelector('textarea').value = '';

                    // Show success alert using SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Your comment has been posted.',
                    });

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error posting comment. Please try again.'
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