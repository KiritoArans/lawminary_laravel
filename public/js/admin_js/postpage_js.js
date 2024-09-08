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

/edit button/;

document.addEventListener('DOMContentLoaded', function () {
    // Edit Modal Elements
    const editButton = document.getElementById('editButton');
    const editModal = document.getElementById('editModal');
    const closeEditModal = document.getElementById('closeEditModal');
    const editForm = document.getElementById('editForm');
    const deleteButton = document.getElementById('deleteButton');
    let currentRow = null;

    editButton.addEventListener('click', function () {
        const selectedRowId = prompt(
            'Enter the ID of the post you want to edit:'
        );
        if (selectedRowId) {
            const rows = document.querySelectorAll('#postsTableBody tr');
            rows.forEach((row) => {
                if (
                    row.querySelector('td:nth-child(1)').textContent ===
                    selectedRowId
                ) {
                    currentRow = row;
                    document.getElementById('editPostId').value = selectedRowId;
                    document.getElementById('editContent').value =
                        row.querySelector('td:nth-child(2)').textContent;
                    document.getElementById('editStatus').value = row
                        .querySelector('td:nth-child(3)')
                        .textContent.toLowerCase();
                    document.getElementById('editTags').value =
                        row.querySelector('td:nth-child(4)').textContent;
                    editModal.style.display = 'block';
                }
            });
        }
    });

    closeEditModal.addEventListener('click', function () {
        editModal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target == editModal) {
            editModal.style.display = 'none';
        }
    });

    editForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const content = document.getElementById('editContent').value;
        const status = document.getElementById('editStatus').value;
        const tags = document.getElementById('editTags').value;
        const restrictDays = document.getElementById('restrictUser').value;
        const notifyUser = document.getElementById('notifyUser').checked;

        if (currentRow) {
            currentRow.querySelector('td:nth-child(2)').textContent = content;
            currentRow.querySelector('td:nth-child(3)').textContent =
                status.charAt(0).toUpperCase() + status.slice(1);
            lector('td:nth-child(3)').textContent =
                status.charAt(0).toUpperCase() + status.slice(1);
            lector('td:nth-child(3)').textContent =
                status.charAt(0).toUpperCase() + status.slice(1);
            lector('td:nth-child(3)').textContent =
                status.charAt(0).toUpperCase() + status.slice(1);
            currentRow.querySelector('td:nth-child(4)').textContent = tags;

            // Add logic to handle user restriction and notification
            if (restrictDays) {
                console.log(`User restricted for ${restrictDays} days`);
            }
            if (notifyUser) {
                console.log('User notified');
            }

            editModal.style.display = 'none';
        }
    });

    deleteButton.addEventListener('click', function () {
        if (currentRow) {
            y;
            currentRow.remove();
            editModal.style.display = 'none';
        }
    });
});
