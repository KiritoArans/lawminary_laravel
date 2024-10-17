//table click

document.addEventListener('DOMContentLoaded', function () {
    // Get references to the text modal and close button
    const viewModal = document.getElementById('viewModal');
    const fullTextElement = document.getElementById('modalContent');
    const closeModal = document.getElementById('closeModal');

    // Function to open text modal with full content
    function openTextModal(content) {
        fullTextElement.textContent = content;
        viewModal.style.display = 'block';
    }

    // Attach event listeners to clickable cells
    document.querySelectorAll('.clickable-cell').forEach((cell) => {
        cell.addEventListener('click', function () {
            const fullText =
                this.getAttribute('data-full-text') || this.textContent;
            openTextModal(fullText); // Open text modal with full content
        });
    });

    document.querySelectorAll('.clickable-cell').forEach((cell) => {
        cell.addEventListener('click', function () {
            const fullText =
                this.getAttribute('data-full-description') || this.textContent;
            openTextModal(fullText); // Open text modal with full content
        });
    });

    // Close text modal when the close button is clicked
    closeModal.addEventListener('click', function () {
        viewModal.style.display = 'none';
    });

    // Close text modal when clicking outside the modal content
    window.addEventListener('click', function (event) {
        if (event.target === viewModal) {
            viewModal.style.display = 'none';
        }
    });
});

//show add modal

document.addEventListener('DOMContentLoaded', function () {
    const addLawModal = document.getElementById('addLawModal');
    const closeAddLawModal = document.getElementById('closeAddLawModal');
    const customButton = document.querySelector('.custom-button');

    // Open modal when the button is clicked
    customButton.addEventListener('click', function () {
        addLawModal.style.display = 'block';
    });

    // Close modal when the close button is clicked
    closeAddLawModal.addEventListener('click', function () {
        addLawModal.style.display = 'none';
    });

    // Close modal when clicking outside of the modal content
    window.addEventListener('click', function (event) {
        if (event.target === addLawModal) {
            addLawModal.style.display = 'none';
        }
    });
    const successMessage = document.getElementById('successMessage').value;
    if (successMessage) {
        Swal.fire({
            title: 'Success!',
            text: successMessage,
            icon: 'success',
            confirmButtonText: 'OK'
        });
    }
});

//edit modal

document.addEventListener('DOMContentLoaded', function () {
    const editModal = document.getElementById('editLawModal');
    const closeEditModal = document.getElementById('closeEditModal');
    const editLawForm = document.getElementById('editLawForm');

    // Function to open modal and fill data for editing
    document.querySelectorAll('.edit-button').forEach((editButton) => {
        editButton.addEventListener('click', function () {
            const lawId = this.getAttribute('data-id');

            // Fetch data from the table row (simplified, you could fetch from API)
            const row = this.closest('tr');
            document.getElementById('edit_title').value =
                row.cells[0].innerText;
            document.getElementById('edit_article_no').value =
                row.cells[1].innerText;
            document.getElementById('edit_title_name').value =
                row.cells[2].innerText;
            document.getElementById('edit_chapter_number').value =
                row.cells[3].innerText;
            document.getElementById('edit_chapter_name').value =
                row.cells[4].innerText;
            document.getElementById('edit_section').value =
                row.cells[5].innerText;
            document.getElementById('edit_section_name').value =
                row.cells[6].innerText;
            document.getElementById('edit_article_name').value =
                row.cells[7].innerText;
            document.getElementById('edit_synonyms').value =
                row.cells[9].innerText;
            const fullDescription = row
                .querySelector('[data-full-description]')
                .getAttribute('data-full-description');
            document.getElementById('edit_description').value = fullDescription;

            // Set the action URL for the form dynamically

            // Show the modal
            editModal.style.display = 'block';
        });
    });

    // Close modal when the close button is clicked
    closeEditModal.addEventListener('click', function () {
        editModal.style.display = 'none';
    });

    // Close modal when clicking outside of the modal content
    window.addEventListener('click', function (event) {
        if (event.target === editModal) {
            editModal.style.display = 'none';
        }
    });

    deleteLawForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the form from submitting immediately
        Swal.fire({
            title: 'Are you sure?',
            text: 'This law will be permanently deleted!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                deleteLawForm.submit(); // Submit the form if confirmed
            }
        });
    });

    // SweetAlert for successful update or delete
    const successMessage = document.getElementById('successMessage').value;
    if (successMessage) {
        Swal.fire({
            title: 'Success!',
            text: successMessage,
            icon: 'success',
            confirmButtonText: 'OK'
        });
    }
});
