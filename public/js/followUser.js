document.addEventListener('DOMContentLoaded', function() {
    const followForms = document.querySelectorAll('.follow-form');

    followForms.forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent traditional form submission

            const formData = new FormData(form); // Prepare form data for AJAX
            const followingId = form.querySelector('input[name="following"]').value; // Get the 'following' user_id

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
                    const followButton = form.querySelector('button');

                    // Update the button text and class based on follow/unfollow state
                    if (data.is_followed) {
                        followButton.textContent = 'Unfollow';
                        followButton.classList.add('following');
                    } else {
                        followButton.textContent = 'Follow';
                        followButton.classList.remove('following');
                    }

                    // Show success alert using SweetAlert with custom z-index to ensure it's above the modal
                    Swal.fire({
                        icon: 'success',
                        title: data.is_followed ? 'Followed' : 'Unfollowed',
                        text: data.message,
                        didOpen: () => {
                            // Dynamically set z-index for the SweetAlert popup
                            const swalPopup = document.querySelector('.swal2-popup');
                            swalPopup.style.zIndex = '10001'; // Make sure it's above the modal
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error following/unfollowing the user. Please try again.',
                        didOpen: () => {
                            const swalPopup = document.querySelector('.swal2-popup');
                            swalPopup.style.zIndex = '10001';
                        }
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An unexpected error occurred.',
                    didOpen: () => {
                        const swalPopup = document.querySelector('.swal2-popup');
                        swalPopup.style.zIndex = '10001';
                    }
                });
                console.error('Error:', error);
            });
        });
    });
});
