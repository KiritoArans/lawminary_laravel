/filter button/

document.addEventListener('DOMContentLoaded', function () {
    const filterButton = document.getElementById('filterButton');
    const filterModal = document.getElementById('filterModal');
    const closeButton = document.querySelector('#filterModal .close-button');

    // Open the modal when the filter button is clicked
    filterButton.addEventListener('click', function () {
        filterModal.style.display = 'block';
    });

    // Close the modal when the close button is clicked
    closeButton.addEventListener('click', function () {
        filterModal.style.display = 'none';
    });

    // Close the modal when clicking outside of it
    window.addEventListener('click', function (event) {
        if (event.target === filterModal) {
            filterModal.style.display = 'none';
        }
    });

    // Handle the form submission (for demo purposes, you can extend this)
    document.getElementById('filterForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission behavior

        // Get the filter values
        const filterId = document.getElementById('filterId').value;
        const filterDocument = document.getElementById('filterDocument').value;
        const filterTitle = document.getElementById('filterTitle').value;
        const filterDate = document.getElementById('filterDate').value;

        // Implement your filter logic here (e.g., filter the table based on the input values)

        // Close the modal after applying filters
        filterModal.style.display = 'none';
    });
});

/edit button/

document.addEventListener('DOMContentLoaded', function () {
    const editButton = document.getElementById('editButton');
    const editModal = document.getElementById('editModal');
    const closeButton = document.querySelector('#editModal .close-button');
    const resourceForm = document.getElementById('resourceForm');

    // Function to open the modal
    function openModal(resource = {}) {
        document.getElementById('resourceId').value = resource.id || '';
        document.getElementById('resourceDocument').value = resource.document || '';
        document.getElementById('resourceTitle').value = resource.title || '';
        document.getElementById('uploadDate').value = resource.date || '';
        document.getElementById('resourceFile').value = ''; // Reset file input

        editModal.style.display = 'block';
    }

    // Click event for the edit button
    editButton.addEventListener('click', function () {
        openModal(); // Open modal with empty fields
    });

    // Close the modal when the close button is clicked
    closeButton.addEventListener('click', function () {
        editModal.style.display = 'none';
    });

    // Close the modal when clicking outside of it
    window.addEventListener('click', function (event) {
        if (event.target === editModal) {
            editModal.style.display = 'none';
        }
    });

    // Handle form submission
    resourceForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission

        const formData = new FormData(resourceForm);

        // Log the file name to check if the file is being captured
        const fileInput = document.getElementById('resourceFile');
        console.log(fileInput.files[0].name);

        // Here you would typically send `formData` to your server using fetch or XMLHttpRequest
        // For example:
        // fetch('your-server-endpoint', {
        //     method: 'POST',
        //     body: formData
        // })
        // .then(response => response.json())
        // .then(data => console.log('Success:', data))
        // .catch(error => console.error('Error:', error));

        editModal.style.display = 'none'; // Close the modal after submission
    });
});


/table/

document.addEventListener('DOMContentLoaded', function () {
    // Handle download confirmation
    const documentLinks = document.querySelectorAll('.document-link');

    documentLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default download action

            const documentName = this.getAttribute('data-document-name');
            const confirmation = confirm(`Do you want to download ${documentName}?`);

            if (confirmation) {
                // Proceed with download if confirmed
                window.location.href = this.href;
            }
        });
    });
});


/view table button/

document.addEventListener('DOMContentLoaded', function() {
    const viewButtons = document.querySelectorAll('.view-button');
    const viewModal = document.getElementById('viewModal');
    const closeButtons = document.querySelectorAll('.close-button');

    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            const resourceId = row.getAttribute('data-id');
            const resourceDocument = row.getAttribute('data-document');
            const resourceTitle = row.getAttribute('data-title');
            const uploadDate = row.getAttribute('data-date');

            // Populate the modal with the resource details
            document.getElementById('viewResourceId').textContent = resourceId;
            const documentLink = document.getElementById('viewResourceDocument');
            documentLink.textContent = resourceDocument;
            documentLink.href = resourceDocument;
            document.getElementById('viewResourceTitle').textContent = resourceTitle;
            document.getElementById('viewUploadDate').textContent = uploadDate;

            // Ask before downloading the file
            documentLink.addEventListener('click', function(event) {
                event.preventDefault();
                if (confirm("Do you want to download this document?")) {
                    window.location.href = this.href;
                }
            });

            // Display the modal
            viewModal.style.display = 'block';
        });
    });

    // Close the modal when any close button is clicked
    closeButtons.forEach(button => {
        button.addEventListener('click', function() {
            viewModal.style.display = 'none';
        });
    });

    // Close the modal when clicking outside of it
    window.addEventListener('click', function(event) {
        if (event.target === viewModal) {
            viewModal.style.display = 'none';
        }
    });
});

