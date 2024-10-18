function confirmDelete(postId) {
    console.log(postId); // Check the postId being passed here
    Swal.fire({
        title: 'Deleting Post',
        text: "Do you want to delete this post?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'Cancel',
    }).then((result) => {
        if (result.isConfirmed) {
            // Ensure the correct form is being submitted
            console.log('Submitting form for postId:', postId);
            document.getElementById('delete-form-' + postId).submit();
        }
    });
}
