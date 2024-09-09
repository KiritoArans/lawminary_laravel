/view pending post button/;
document.addEventListener('DOMContentLoaded', function () {
    const viewPendingButton = document.getElementById('viewPendingButton');
    const pendingPostsModal = document.getElementById('pendingPostsModal');
    const closeModalButton = document.getElementById('closeModal');

    // Open the modal when the button is clicked
    viewPendingButton.addEventListener('click', function () {
        pendingPostsModal.style.display = 'block';
    });

    // Close the modal when the close button is clicked
    closeModalButton.addEventListener('click', function () {
        pendingPostsModal.style.display = 'none';
    });

    // Close the modal when clicking outside the modal content
    window.addEventListener('click', function (event) {
        if (event.target == pendingPostsModal) {
            pendingPostsModal.style.display = 'none';
        }
    });
});
/filter button/;

document.addEventListener('DOMContentLoaded', function () {
    const filterButton = document.getElementById('filterButton');
    const filterModal = document.getElementById('filterModal');
    const closeButton = document.getElementById('closeFilterModal');

    // Open the filter modal
    filterButton.addEventListener('click', function () {
        filterModal.style.display = 'block';
    });

    // Close the filter modal
    closeButton.addEventListener('click', function () {
        filterModal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target == filterModal) {
            filterModal.style.display = 'none';
        }
    });

    // Let the form submit normally, no need for JS filtering here
});

//search function

document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search');
    const tableBody = document.getElementById('postTableBody');
    const rows = tableBody.getElementsByTagName('tr');

    searchInput.addEventListener('keyup', function () {
        console.log('Search triggered'); // Check if this appears
        const searchValue = searchInput.value.toLowerCase();
        console.log('Search value:', searchValue); // Log the search value

        for (let i = 0; i < rows.length; i++) {
            const row = rows[i];
            let rowText = row.textContent.toLowerCase();
            console.log('Row text:', rowText); // Log each row's text content

            if (rowText.includes(searchValue)) {
                row.style.display = ''; // Show the row
            } else {
                row.style.display = 'none'; // Hide the row
            }
        }
    });
});

//edit and update function

document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.editButton');
    const editModal = document.getElementById('editModal');
    const closeModal = document.querySelector('.close-buttonEdit');

    const postIdInput = document.getElementById('editPostId');
    const concernInput = document.getElementById('editConcern');
    const statusInput = document.getElementById('editStatus');
    const tagsInput = document.getElementById('editTags');
    const postedByInput = document.getElementById('editPostedBy');
    const approvedByInput = document.getElementById('editApprovedBy');

    // Open modal and fill in the form with the correct data
    editButtons.forEach((button) => {
        button.addEventListener('click', function () {
            const postId = button.getAttribute('data-id');
            const concern = button.getAttribute('data-concern');
            const status = button.getAttribute('data-status');
            const tags = button.getAttribute('data-tags');
            const postedBy = button.getAttribute('data-postedby');
            const approvedBy = button.getAttribute('data-approvedby');

            // Fill the form
            postIdInput.value = postId;
            concernInput.value = concern;
            statusInput.value = status;
            tagsInput.value = tags;
            postedByInput.value = postedBy;
            approvedByInput.value = approvedBy;

            // Show modal
            editModal.style.display = 'block';
        });
    });

    // Close the modal when clicking the close button
    closeModal.addEventListener('click', function () {
        editModal.style.display = 'none';
    });

    // Close the modal when clicking outside of the modal content
    window.addEventListener('click', function (event) {
        if (event.target == editModal) {
            editModal.style.display = 'none';
        }
    });
});

//delete function

document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.deleteButton');

    deleteButtons.forEach((button) => {
        button.addEventListener('click', function () {
            const postId = button.getAttribute('data-id'); // Get the post ID from the button attribute

            // SweetAlert confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: 'Once deleted, you will not be able to recover this post!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If user confirms deletion, send the DELETE request
                    fetch(`/posts/${postId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        }
                    })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.success) {
                                // SweetAlert2 success notification
                                Swal.fire(
                                    'Deleted!',
                                    'The post has been deleted successfully.',
                                    'success'
                                ).then(() => {
                                    // Reload the page after SweetAlert is closed
                                    window.location.reload();
                                });

                                // Check if the post row exists before removing it
                                const postRow = document.querySelector(
                                    `#post-${postId}`
                                );
                                if (postRow) {
                                    postRow.remove();
                                } else {
                                    console.warn(
                                        `Post row with ID #post-${postId} not found in the DOM.`
                                    );
                                }
                            } else {
                                Swal.fire(
                                    'Failed!',
                                    'Failed to delete the post. Please try again.',
                                    'error'
                                );
                            }
                        })
                        .catch((error) => {
                            console.error('Error:', error);
                            Swal.fire(
                                'Error!',
                                'An error occurred. Please try again.',
                                'error'
                            );
                        });
                }
            });
        });
    });
});
