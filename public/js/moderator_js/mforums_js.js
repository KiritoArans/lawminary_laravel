/filter button/;

// Show/hide the filter modal
document.getElementById('filterButton').onclick = function () {
    document.getElementById('filterModal').style.display = 'block';
};

document.getElementById('closeFilterModal').onclick = function () {
    document.getElementById('filterModal').style.display = 'none';
};

// Close modal when clicking outside of it
window.onclick = function (event) {
    var modal = document.getElementById('filterModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
};
document.getElementById('resetButton').onclick = function () {
    document.getElementById('filterForm').reset();
};

/update button/;

document.addEventListener('DOMContentLoaded', function () {
    var editButtons = document.querySelectorAll('.edit-button');
    var editModal = document.getElementById('editForumModal');
    var closeEditModal = document.getElementById('closeEditForumModal');

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

            // Set the form action dynamically
            var form = document.getElementById('editForumForm');
            form.action = form.action.replace(':forum_id', forumId);

            // Show the modal
            editModal.style.display = 'block';
        });
    });

    // Close the modal when clicking on the close button
    closeEditModal.onclick = function () {
        editModal.style.display = 'none';
    };

    // Close the modal when clicking outside of the modal content
    window.onclick = function (event) {
        if (event.target == editModal) {
            editModal.style.display = 'none';
        }
    };
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
