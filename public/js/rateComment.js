document.addEventListener('DOMContentLoaded', function() {
    const rateForm = document.getElementById('rateForm');
    const rateModal = document.getElementById('rateModal');

    rateForm.addEventListener('submit', function(event) {
        event.preventDefault(); 

        const formData = new FormData(rateForm); 

        fetch(rateForm.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        })
        .then(response => response.json()) 
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: data.message,
                });

                rateModal.style.display = 'none';
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'There was an issue with submitting your rating.',
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
