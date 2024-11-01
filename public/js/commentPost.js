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
                    // Clear the comment textarea
                    form.querySelector('textarea').value = '';

                    // Show success alert using SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Your comment has been posted.',
                        showConfirmButton: false,  
                        timer: 2000,
                    });

                    // No need to manually append the comment, Laravel Echo will handle that
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
