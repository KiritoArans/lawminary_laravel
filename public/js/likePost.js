document.addEventListener('DOMContentLoaded', function() {
    const likeForms = document.querySelectorAll('.like-form');

    likeForms.forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting traditionally

            const formData = new FormData(form); // Prepare form data for AJAX
            const postId = form.getAttribute('data-post-id'); // Get post_id from form

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
                    const likeButton = form.querySelector('button');
                    const likesCountSpan = document.getElementById(`likes-count-${postId}`);

                    // Update the like count
                    likesCountSpan.innerText = `(${data.like_count})`;

                    // Toggle the class for liked/unliked state
                    if (data.is_liked) {
                        likeButton.classList.add('btn-hitted');
                    } else {
                        likeButton.classList.remove('btn-hitted');
                    }

                    // Show success alert using SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: data.is_liked ? 'Post Liked' : 'Post Unliked',
                        text: data.message,
                        showConfirmButton: false,  
                        timer: 1000,
                    });

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error liking the post. Please try again.'
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