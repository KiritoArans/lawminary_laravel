/filter modal/;

// Show/hide the filter modal
document.getElementById('filterButton').onclick = function () {
    var modal = document.getElementById('filterModal');
    modal.style.display = 'block'; // Show the modal when the filter button is clicked
};

// Close the filter modal when clicking the "X" button
document.getElementById('closeFilterModal').onclick = function () {
    var modal = document.getElementById('filterModal');
    modal.style.display = 'none'; // Close the modal when the close button is clicked
};

// Reset the filter form when clicking the reset button
document.getElementById('resetButton').onclick = function () {
    document.getElementById('filterForm').reset(); // Reset the form fields
};

// Close the modal when clicking outside of the modal content
window.addEventListener('click', function (event) {
    var modal = document.getElementById('filterModal');
    var modalContent = document.getElementById('filterModalContent');

    if (event.target === modal) {
        modal.style.display = 'none'; // Close the modal when clicking outside the modal content
    }
});

/update button/;

document.addEventListener('DOMContentLoaded', function () {
    var editButtons = document.querySelectorAll('.edit-button');
    var editModal = document.getElementById('editForumModal');
    var closeEditModal = document.getElementById('closeEditForumModal');
    var deleteForm = document.getElementById('deleteForumForm');

    // Add click event listener to each edit button
    editButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            var forumId = button.getAttribute('data-forum-id');
            var forumName = button.getAttribute('data-forum-name');
            var forumDesc = button.getAttribute('data-forum-desc');
            var dateCreated = button.getAttribute('data-date-created');

            // Populate modal form fields
            document.getElementById('editForumId').value = forumId;
            document.getElementById('editForumName').value = forumName;
            document.getElementById('editForumDescription').value = forumDesc;
            document.getElementById('editDateCreated').value = dateCreated;

            // Set the form action dynamically for the edit form
            var editForm = document.getElementById('editForumForm');
            editForm.action = `/moderator/forums/${forumId}/edit`;

            // Set the form action dynamically for the delete form
            deleteForm.action = `/moderator/forums/${forumId}/delete`;

            // Show the modal
            editModal.style.display = 'block';
        });
    });

    // Close the modal when clicking on the close button
    closeEditModal.onclick = function () {
        editModal.style.display = 'none';
    };

    // Close the modal when clicking outside of the modal content
    window.addEventListener('click', function (event) {
        if (event.target == editModal) {
            editModal.style.display = 'none';
        }
    });

    // Delete button event inside the modal
    document.querySelectorAll('.delete-button').forEach(function (button) {
        button.addEventListener('click', function () {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to undo this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form associated with the delete button
                    button.closest('form').submit();
                }
            });
        });
    });
});

/delete button/;

document.addEventListener('DOMContentLoaded', function () {
    // Function to trigger SweetAlert before delete
    window.confirmDelete = function (button) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to undo this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form associated with the delete button
                button.closest('form').submit();
            }
        });
    };
});

/add forum button/;

document.addEventListener('DOMContentLoaded', function () {
    // Add Forum Modal Elements
    const addForumButton = document.getElementById('addForumButton');
    const addForumModal = document.getElementById('addForumModal');
    const closeAddForumModal = document.getElementById('closeAddForumModal');
    // const addForumForm = document.getElementById('addForumForm');
    let forumIdCounter = 3; // Adjust based on existing forums

    addForumButton.addEventListener('click', function () {
        addForumModal.style.display = 'block';
    });

    closeAddForumModal.addEventListener('click', function () {
        addForumModal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target == addForumModal) {
            addForumModal.style.display = 'none';
        }
    });
});

/table click/;
document.addEventListener('DOMContentLoaded', function () {
    // Make only the images clickable
    document.querySelectorAll('.clickable-photo').forEach((img) => {
        img.addEventListener('click', function (event) {
            // Prevent the event from propagating to the cell
            event.stopPropagation();

            var modal = document.getElementById('imageModalPic');
            var fullImage = document.getElementById('fullImage');
            fullImage.src = this.getAttribute('data-fullsize');
            modal.style.display = 'flex'; // Use flex to center the image
        });
    });

    // Close modal when the "X" button is clicked
    document
        .getElementById('closeModalPic')
        .addEventListener('click', function () {
            var modal = document.getElementById('imageModalPic');
            modal.style.display = 'none';
        });

    // Close modal when clicking outside the image
    document
        .getElementById('imageModalPic')
        .addEventListener('click', function (event) {
            if (event.target === this) {
                this.style.display = 'none';
            }
        });

    // Only target cells that do not contain images and are not the action column
    const cells = document.querySelectorAll(
        '.table td:not(:has(img)):not(:last-child)'
    );

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
