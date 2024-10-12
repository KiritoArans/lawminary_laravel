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

    // Clear modal content and show relevant fields based on the button clicked
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
            const content = this.getAttribute('data-content') || '';
            const name = this.getAttribute('data-name') || ''; // Default to empty string if undefined

            // Populate the hidden ID and field in the form
            editIdField.value = id;
            editField.value = contentType; // Set the hidden field for content type

            // Check content type and show corresponding form fields
            if (contentType === 'system_name') {
                nameField.style.display = 'block';
                editNameField.value = name || ''; // Populate name field
            } else if (contentType === 'about_lawminary') {
                aboutLawminaryField.style.display = 'block';
                editAboutLawminaryField.value = content; // Populate textarea
            } else if (contentType === 'about_pao') {
                aboutPaoField.style.display = 'block';
                editAboutPaoField.value = content; // Populate textarea
            } else if (contentType === 'terms_of_service') {
                termsOfServiceField.style.display = 'block';
                editTermsOfServiceField.value = content; // Populate textarea
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

//table click

document.addEventListener('DOMContentLoaded', function () {
    // Select all clickable text elements
    const clickableTexts = document.querySelectorAll('.clickable-text');

    // Get the modal and modal content elements
    const modal = document.getElementById('textModal');
    const modalContent = document.getElementById('fullText');

    // Close button in the modal
    const closeModal = document.querySelector('.close-modal');

    // Add click event to each clickable text
    clickableTexts.forEach((text) => {
        text.addEventListener('click', function () {
            const fullText = this.getAttribute('data-full-text'); // Get the full text from the data attribute
            modalContent.textContent = fullText; // Set modal content
            modal.style.display = 'flex'; // Show the modal
        });
    });

    // Close modal on clicking the close button
    closeModal.addEventListener('click', function () {
        modal.style.display = 'none'; // Hide modal
    });

    // Close modal when clicking outside of modal content
    window.onclick = function (event) {
        if (event.target === modal) {
            modal.style.display = 'none'; // Hide modal
        }
    };
});

// photo open

document.addEventListener('DOMContentLoaded', function () {
    // Open modal when the image is clicked
    document.querySelectorAll('.clickable-photo').forEach((img) => {
        img.addEventListener('click', function () {
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
});
