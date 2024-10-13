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
            const status = button.getAttribute('data-status').trim(); // Ensure there's no extra space
            const tags = button.getAttribute('data-tags');
            const postedBy = button.getAttribute('data-postedby');
            const approvedBy = button.getAttribute('data-approvedby');
            console.log('Status:', status); // Add this line for debugging

            // Fill the form fields
            postIdInput.value = postId;
            concernInput.value = concern;
            tagsInput.value = tags;
            postedByInput.value = postedBy;
            approvedByInput.value = approvedBy;

            // Directly set the value of the dropdown
            statusInput.value = status;

            // Show the modal
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
                    fetch(`/admin/posts/${postId}`, {
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

//reset filter

function resetFilter() {
    // Clear all filter inputs
    document.getElementById('filterPostId').value = '';
    document.getElementById('filterContent').value = '';
    document.getElementById('filterStatus').value = '';
    document.getElementById('filterTags').value = '';
    document.getElementById('filterPostedBy').value = '';
    document.getElementById('filterApprovedBy').value = '';
    document.getElementById('filterDate').value = '';

    // Optionally, submit the form to reset the filter in the backend or refresh the page
    document.getElementById('filterForm').submit(); // This will refresh the page with cleared filters
}

// Function to open the modal
document.querySelectorAll('.btn-view-reject').forEach((button) => {
    button.addEventListener('click', function () {
        var postId = this.getAttribute('data-target').split('-')[1]; // Get the post ID from data-target attribute
        var modal = document.getElementById('disregardModal-' + postId);

        // Add Bootstrap modal classes to show the modal
        modal.classList.add('show');
        modal.style.display = 'block';
        modal.setAttribute('aria-hidden', 'false');
        modal.setAttribute('role', 'dialog');

        // Add backdrop (optional if you want to simulate Bootstrap's backdrop)
        var backdrop = document.createElement('div');
        backdrop.className = 'modal-backdrop fade show';
        document.body.appendChild(backdrop);
    });
});

// Function to close the modal when the close button is clicked
document.querySelectorAll('.close-button-reason').forEach((closeButton) => {
    closeButton.addEventListener('click', function () {
        var modal = this.closest('.modal');

        // Remove Bootstrap modal classes to hide the modal
        modal.classList.remove('show');
        modal.style.display = 'none';
        modal.setAttribute('aria-hidden', 'true');

        // Remove backdrop
        var backdrop = document.querySelector('.modal-backdrop');
        if (backdrop) {
            backdrop.remove();
        }
    });
});

// Function to close the modal if clicked outside the modal content
window.addEventListener('click', function (event) {
    var modals = document.querySelectorAll('.modal');
    modals.forEach(function (modal) {
        if (event.target === modal) {
            modal.classList.remove('show');
            modal.style.display = 'none';
            modal.setAttribute('aria-hidden', 'true');

            // Remove backdrop
            var backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.remove();
            }
        }
    });
});

//report button
document.addEventListener('DOMContentLoaded', function () {
    const viewReportedPostsButton = document.getElementById(
        'viewReportedPostsButton'
    );
    const reportedPostsModal = document.getElementById('reportedPostsModal');
    const postReportsModal = document.getElementById('postReportsModal');
    const reportedPostsContainer = document.getElementById(
        'reportedPostsContainer'
    );
    const postReportsContainer = document.getElementById(
        'postReportsContainer'
    );
    const disregardPostButton = document.getElementById('disregardPostButton');

    // Open modal to view reported posts
    viewReportedPostsButton.addEventListener('click', function () {
        fetch('/admin/reported-posts')
            .then((response) => response.json())
            .then((data) => {
                reportedPostsContainer.innerHTML = ''; // Clear existing content
                data.forEach((post) => {
                    // Create an element for each reported post with a view reports button
                    const postDiv = document.createElement('div');
                    postDiv.innerHTML = `
                        <p><strong>Post ID:</strong>${post.post_id}</p>
                        <p><strong>Post Concern:</strong> ${post.concern}</p>
                        <button class="btn btn-info" data-post-id="${post.post_id}" id='viewReportsBtn'>
                            View reports
                        </button>
                    `;

                    // Add event listener to the "View reports" button
                    postDiv
                        .querySelector('button')
                        .addEventListener('click', function () {
                            viewReportsForPost(post.post_id); // Show reports for this post
                        });

                    // Append the postDiv to the container
                    reportedPostsContainer.appendChild(postDiv);
                });
                reportedPostsModal.style.display = 'block'; // Show the modal
            })
            .catch((error) => {
                console.error('Error fetching reported posts:', error);
            });
    });

    // Close modal when clicking on the close button
    document
        .querySelector('.close-reported-posts')
        .addEventListener('click', function () {
            reportedPostsModal.style.display = 'none';
        });

    // Fetch and display reports for a specific post
    function viewReportsForPost(postId) {
        fetch(`/admin/post-reports/${postId}`)
            .then((response) => response.json())
            .then((data) => {
                postReportsContainer.innerHTML = ''; // Clear container
                data.forEach((report) => {
                    const reportDiv = document.createElement('div');
                    reportDiv.textContent = `Reports: ${report.reportContent}`;
                    postReportsContainer.appendChild(reportDiv);
                });
                disregardPostButton.setAttribute('data-post-id', postId); // Attach post ID to button
                postReportsModal.style.display = 'block'; // Show the reports modal
            });
    }

    // Disregard post when button is clicked
    disregardPostButton.addEventListener('click', function () {
        const postId = this.getAttribute('data-post-id');

        // Show SweetAlert confirmation before proceeding
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, disregard it!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/disregard-post/${postId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    }
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            Swal.fire(
                                'Disregarded!',
                                'The post has been disregarded.',
                                'success'
                            );
                            postReportsModal.style.display = 'none'; // Close modal
                            viewReportedPostsButton.click(); // Refresh reported posts
                        } else {
                            Swal.fire(
                                'Failed!',
                                'There was an error disregarding the post.',
                                'error'
                            );
                        }
                    });
            }
        });
    });

    // Close post reports modal
    document
        .querySelector('.close-post-reports')
        .addEventListener('click', function () {
            postReportsModal.style.display = 'none';
        });
});

//table click

// Function to open a modal showing the full content
document.addEventListener('DOMContentLoaded', function () {
    // Target all table cells except the last column (Action column)
    const cells = document.querySelectorAll('.table td:not(:last-child)');

    cells.forEach((cell) => {
        cell.addEventListener('click', function () {
            const fullText =
                this.getAttribute('data-full-text') || this.textContent; // Get full text from data attribute or content
            document.getElementById('fullText').textContent = fullText;
            document.getElementById('textModal').style.display = 'block';
        });
    });

    // Close modal logic
    const closeModal = document.querySelector('.close-modal');
    closeModal.addEventListener('click', function () {
        document.getElementById('textModal').style.display = 'none';
    });

    window.onclick = function (event) {
        const modal = document.getElementById('textModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };
});
