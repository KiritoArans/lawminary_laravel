document.addEventListener('DOMContentLoaded', function() {
    const bookmarkForms = document.querySelectorAll('.bookmark-form');

    bookmarkForms.forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent traditional form submission

            const formData = new FormData(form); // Prepare form data for AJAX
            const postId = form.getAttribute('data-post-id'); // Get post_id from form

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
            })
            .then(response => response.json()) // Parse JSON response
            .then(data => {
                if (data.success) {
                    const bookmarkButton = form.querySelector('button');
                    const bookmarksCountSpan = document.getElementById(`bookmark-count-${postId}`);

                    // Update the bookmark count
                    bookmarksCountSpan.innerText = `(${data.bookmark_count})`;

                    // Toggle the class for bookmarked/unbookmarked state
                    if (data.is_bookmarked) {
                        bookmarkButton.classList.add('btn-bookmarked');
                    } else {
                        bookmarkButton.classList.remove('btn-bookmarked');
                    }

                    // Show success alert using SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: data.is_bookmarked ? 'Post Bookmarked' : 'Post Unbookmarked',
                        text: data.message,
                        showConfirmButton: false,  
                        timer: 1000,
                    });

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error bookmarking the post. Please try again.'
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
