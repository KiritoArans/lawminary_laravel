document.addEventListener('DOMContentLoaded', function () {
    console.log('DOM fully loaded and parsed');

    const clickableCells = document.querySelectorAll('.clickable-cell');
    const editForm = document.getElementById('editForm');
    const editModal = document.getElementById('editModal');
    const closeButton = document.querySelector('.close-buttonEdit');

    const editIdField = document.getElementById('editId');
    const editField = document.getElementById('editField');
    const sysconButton = document.getElementById('sysconButton');

    // Fields
    const nameField = document.getElementById('nameField');
    const systemDescField = document.getElementById('systemDescField');
    const systemDesc2Field = document.getElementById('systemDesc2Field');
    const partnerNameField = document.getElementById('partnerNameField');
    const partnerDescField = document.getElementById('partnerDescField');
    const partnerDesc2Field = document.getElementById('partnerDesc2Field');
    const fileContentField = document.getElementById('fileContentField');

    // Input elements for each field
    const editNameField = document.getElementById('editName');
    const editSystemDesc = document.getElementById('editSystemDesc');
    const editSystemDesc2 = document.getElementById('editSystemDesc2');
    const editPartnerName = document.getElementById('editPartnerName');
    const editPartnerDesc = document.getElementById('editPartnerDesc');
    const editPartnerDesc2 = document.getElementById('editPartnerDesc2');
    const editLogoField = document.getElementById('editLogo');

    // Logo preview elements
    const logoPreviewContainer = document.getElementById(
        'logoPreviewContainer'
    );
    const logoPreview = document.getElementById('logoPreview');

    // Ensure the modal is hidden initially
    editModal.style.display = 'none';

    // Flag to control the modal opening
    let preventAutoOpen = true;

    // Adjust the height of the textarea to fit content
    function adjustTextareaHeight(textarea) {
        textarea.style.height = 'auto'; // Reset height
        textarea.style.height = textarea.scrollHeight + 'px'; // Set height to content
    }

    // Apply initial height adjustment and add event listeners for input
    const textareas = document.querySelectorAll(
        '#editModal .form-group textarea'
    );
    textareas.forEach((textarea) => {
        adjustTextareaHeight(textarea); // Adjust on load
        textarea.addEventListener('input', () =>
            adjustTextareaHeight(textarea)
        ); // Adjust on input
    });

    // Event listener for clickable cells to open modal
    clickableCells.forEach((cell) => {
        cell.addEventListener('click', function () {
            console.log('Cell clicked');
            preventAutoOpen = false; // Allow modal to open

            // Hide all form fields initially
            nameField.style.display = 'none';
            systemDescField.style.display = 'none';
            systemDesc2Field.style.display = 'none';
            partnerNameField.style.display = 'none';
            partnerDescField.style.display = 'none';
            partnerDesc2Field.style.display = 'none';
            fileContentField.style.display = 'none';
            logoPreviewContainer.style.display = 'none';

            const id = this.getAttribute('data-id');
            const contentType = this.getAttribute('data-type');
            const content = this.getAttribute('data-content') || '';
            const desc = this.getAttribute('data-desc') || '';
            const desc2 = this.getAttribute('data-desc2') || '';
            const logoPath =
                this.querySelector('.clickable-photo')?.getAttribute(
                    'data-fullsize'
                ) || '';

            editForm.action = id
                ? `/admin/systemcontent/update/${id}`
                : `/admin/systemcontent/store`;
            sysconButton.innerText = id ? 'Update' : 'Add';

            editIdField.value = id || '';
            editField.value = contentType;

            if (contentType === 'system_name') {
                nameField.style.display = 'block';
                systemDescField.style.display = 'block';
                systemDesc2Field.style.display = 'block';
                editNameField.value = content;
                editSystemDesc.value = desc;
                editSystemDesc2.value = desc2;

                adjustTextareaHeight(editSystemDesc);
                adjustTextareaHeight(editSystemDesc2);
            } else if (contentType === 'partner_name') {
                partnerNameField.style.display = 'block';
                partnerDescField.style.display = 'block';
                partnerDesc2Field.style.display = 'block';
                editPartnerName.value = content;
                editPartnerDesc.value = desc;
                editPartnerDesc2.value = desc2;

                adjustTextareaHeight(editPartnerDesc);
                adjustTextareaHeight(editPartnerDesc2);
            } else if (contentType === 'logo') {
                fileContentField.style.display = 'block';
                if (logoPath) {
                    logoPreview.src = logoPath;
                    logoPreviewContainer.style.display = 'block';
                }
                editLogoField.value = '';
            }

            console.log('Opening modal');
            editModal.style.display = 'flex';
        });
    });

    closeButton.addEventListener('click', function () {
        console.log('Close button clicked');
        editModal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target === editModal) {
            console.log('Window click detected outside modal');
            editModal.style.display = 'none';
        }
    });

    // Prevent the modal from auto-opening on page load
    if (preventAutoOpen) {
        editModal.style.display = 'none';
        console.log('Auto-open prevented');
    }
});
