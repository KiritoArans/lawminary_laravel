document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.editButton');
    const editForm = document.getElementById('editForm'); // Add the form
    const editModal = document.getElementById('editModal');
    const closeButton = document.querySelector('.close-buttonEdit'); // Select the close button

    editButtons.forEach((button) => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const content = this.getAttribute('data-content');

            const editIdField = document.getElementById('editId');
            const editNameField = document.getElementById('editName');
            const editContentField = document.getElementById('editContent');
            const viewContentField = document.getElementById('viewContent');

            if (
                editIdField &&
                editNameField &&
                editContentField &&
                viewContentField
            ) {
                // Populate modal fields
                editIdField.value = id;
                editNameField.value = name;
                viewContentField.value = content;

                // Don't set value for file input because it's not allowed
                // Show the modal
                editModal.style.display = 'block';

                // Dynamically set form action with the correct ID
                editForm.action = `/admin/systemcontent/update/${id}`; // This should be dynamic

                closeButton.addEventListener('click', function () {
                    editModal.style.display = 'none';
                });

                // Close the modal if the user clicks anywhere outside the modal
                window.addEventListener('click', function (event) {
                    if (event.target == editModal) {
                        editModal.style.display = 'none';
                    }
                });
            }
        });
    });
});
