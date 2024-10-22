document.addEventListener('DOMContentLoaded', function() {
    const replyForms = document.querySelectorAll('form[id^="reply-form"]');

    replyForms.forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting the traditional way

            const formData = new FormData(form); // Prepare form data for AJAX submission
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
                    // Clear the reply textarea
                    form.querySelector('textarea').value = '';

                    // Show success alert using SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Your reply has been posted.',
                    });

                    // No need to manually append the reply, Laravel Echo will handle that
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
