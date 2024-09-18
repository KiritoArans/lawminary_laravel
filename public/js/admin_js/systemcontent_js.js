document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.editButton');
    const editForm = document.getElementById('editForm');
    const editModal = document.getElementById('editModal');
    const closeButton = document.querySelector('.close-buttonEdit');

    const editIdField = document.getElementById('editId');
    const editField = document.getElementById('editField');

    // Fields
    const nameField = document.getElementById('nameField');
    const aboutLawminaryField = document.getElementById('about_LawminaryField');
    const aboutPaoField = document.getElementById('aboutPaoField');
    const termsOfServiceField = document.getElementById('termsOfServiceField');
    const fileContentField = document.getElementById('fileContentField');

    // Text Areas
    const editNameField = document.getElementById('editName');
    const editAboutLawminaryField =
        document.getElementById('editAboutLawminary');
    const editAboutPaoField = document.getElementById('editAboutPao');
    const editTermsOfServiceField =
        document.getElementById('editTermsOfService');
    const editLogoField = document.getElementById('editLogo');

    editButtons.forEach((button) => {
        button.addEventListener('click', function () {
            // Hide all form fields first
            nameField.style.display = 'none';
            aboutLawminaryField.style.display = 'none';
            aboutPaoField.style.display = 'none';
            termsOfServiceField.style.display = 'none';
            fileContentField.style.display = 'none';

            const id = this.getAttribute('data-id');
            const contentType = this.getAttribute('data-type'); // Type to determine content (logo, name, or text content)
            const content = this.getAttribute('data-content');
            const name = this.getAttribute('data-name') || ''; // Ensure name has a default empty string

            // Populate the hidden ID and field in the form
            editIdField.value = id;
            editField.value = contentType; // Set the hidden field for content type

            // Check content type and show corresponding form fields
            if (contentType === 'system_name') {
                nameField.style.display = 'block';
                editNameField.value = name; // Populate name field
            } else if (contentType === 'content_text') {
                if (content.includes('Lawminary')) {
                    aboutLawminaryField.style.display = 'block';
                    editAboutLawminaryField.value = content; // Populate textarea
                } else if (content.includes('PAO')) {
                    aboutPaoField.style.display = 'block';
                    editAboutPaoField.value = content; // Populate textarea
                } else if (content.includes('Terms')) {
                    termsOfServiceField.style.display = 'block';
                    editTermsOfServiceField.value = content; // Populate textarea
                }
            } else if (contentType === 'logo') {
                fileContentField.style.display = 'block'; // Show file input for the logo
            }

            // Set the form action dynamically based on the ID
            editForm.action = `/admin/systemcontent/update/${id}`;

            // Show the modal
            editModal.style.display = 'block';

            // Close the modal when the close button is clicked
            closeButton.addEventListener('click', function () {
                editModal.style.display = 'none';
            });

            // Close the modal if the user clicks outside the modal content
            window.addEventListener('click', function (event) {
                if (event.target == editModal) {
                    editModal.style.display = 'none';
                }
            });
        });
    });
});
