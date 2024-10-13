document.addEventListener('DOMContentLoaded', function() {
    const rateForm = document.getElementById('rateForm');
    const rateModal = document.getElementById('rateModal'); // Get the modal element

    rateForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting traditionally

        const formData = new FormData(rateForm); // Prepare form data for AJAX

        fetch(rateForm.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        })
        .then(response => response.json()) // Parse the JSON response
        .then(data => {
            if (data.success) {
                // Display SweetAlert success message
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: data.message,
                });

                // Hide the rate modal after success
                rateModal.style.display = 'none';
            } else {
                // Display SweetAlert error message
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'There was an issue with submitting your rating.',
                });
            }
        })
        .catch(error => {
            // Display error in SweetAlert if something unexpected happens
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An unexpected error occurred.',
            });
            console.error('Error:', error);
        });
    });
});
