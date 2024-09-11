console.log('JavaScript is loaded'); // Add this to the top of your forums_js.js file.

/filter button/;

document.addEventListener('DOMContentLoaded', function () {
    // Filter Modal Elements
    const filterButton = document.getElementById('filterButton');
    const filterModal = document.getElementById('filterModal');
    const closeFilterModal = document.querySelector('.close-buttonFilter');

    // Open the filter modal when the filter button is clicked
    filterButton.addEventListener('click', function () {
        filterModal.style.display = 'block';
    });

    // Close the filter modal when the close button is clicked
    closeFilterModal.addEventListener('click', function () {
        filterModal.style.display = 'none';
    });

    // Close the modal when clicking outside of it
    window.addEventListener('click', function (event) {
        if (event.target == filterModal) {
            filterModal.style.display = 'none';
        }
    });
});

/add forum button/;

document.addEventListener('DOMContentLoaded', function () {
    // Add Forum Modal Elements
    const addForumButton = document.getElementById('addForumButton');
    const addForumModal = document.getElementById('addForumModal');
    const closeAddForumModal = document.getElementById('closeAddForumModal');

    // Show the modal when the Add Forum button is clicked
    addForumButton.addEventListener('click', function () {
        addForumModal.style.display = 'block';
    });

    // Close the modal when the close button is clicked
    closeAddForumModal.addEventListener('click', function () {
        addForumModal.style.display = 'none';
    });

    // Close the modal when clicking outside of it
    window.addEventListener('click', function (event) {
        if (event.target == addForumModal) {
            addForumModal.style.display = 'none';
        }
    });

    // Allow form submission to go through to Laravel backend (No event.preventDefault)
    // The backend will handle adding the new forum and then reload the page
}); // SweetAlert for successful form submission
document
    .getElementById('addForumForm')
    .addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent default form submission

        const form = this; // Reference to the form

        // Submit the form via AJAX or let Laravel handle it via a normal request
        form.submit();

        // Show SweetAlert success notification
        Swal.fire({
            title: 'Success!',
            text: 'The forum has been created    successfully.',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    });

/edit button/;

document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.editButton');
    const editModal = document.getElementById('editModal');
    const editForm = document.getElementById('editForm');
    const closeModal = document.querySelector('.close-buttonEdit');

    const editIdField = document.getElementById('editId');
    const editNameField = document.getElementById('editName');
    const editDescField = document.getElementById('editDesc');
    const editMembersField = document.getElementById('editMembers');

    editButtons.forEach((button) => {
        button.addEventListener('click', function () {
            // Get data from the button (from table row)
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const desc = this.getAttribute('data-desc');
            const members = this.getAttribute('data-members');

            // Populate the form fields
            editIdField.value = id;
            editNameField.value = name;
            editDescField.value = desc;
            editMembersField.value = members;

            // Update form action to include ID
            editForm.action = `/admin/forums/update/${id}`;

            // Show the modal
            editModal.style.display = 'block';
        });
    });

    // Close the modal
    closeModal.addEventListener('click', function () {
        editModal.style.display = 'none';
    });

    // Close modal when clicking outside of it
    window.onclick = function (event) {
        if (event.target === editModal) {
            editModal.style.display = 'none';
        }
    };
});
// SweetAlert for successful form submission
document.getElementById('editForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent default form submission

    const form = this; // Reference to the form

    // Submit the form via AJAX or let Laravel handle it via a normal request
    form.submit();

    // Show SweetAlert success notification
    Swal.fire({
        title: 'Success!',
        text: 'The forum has been updated successfully.',
        icon: 'success',
        confirmButtonText: 'OK'
    });
});

//delete sweet alert
document.addEventListener('DOMContentLoaded', function () {
    // Add event listener to all delete buttons
    document.querySelectorAll('.deleteButton').forEach(function (button) {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            const form = this.closest('form'); // Get the form related to the delete button

            // Show SweetAlert confirmation
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form if the user confirms
                    form.submit();
                }
            });
        });
    });
});
