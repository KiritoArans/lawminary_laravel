// /filter button/

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


        filterModal.style.display = 'none';
    });
});



// add button
document.addEventListener('DOMContentLoaded', function () {
    const addButton = document.getElementById('addButton');
    const addModal = document.getElementById('addModal');
    const closeButton = document.querySelector('#addModal .close-button');
    const resourceForm = document.getElementById('resourceForm');

    // Function to open the modal
    function openModal() {
    // function openModal(resource = {}) {
        // document.getElementById('resourceId').value = resource.id || '';
        // document.getElementById('resourceDocument').value = resource.document || '';
        // document.getElementById('resourceTitle').value = resource.title || '';
        // document.getElementById('uploadDate').value = resource.date || '';
        // document.getElementById('resourceFile').value = ''; // Reset file input

        addModal.style.display = 'block';
    }

    // Click event for the edit button
    addButton.addEventListener('click', function () {
        openModal(); // Open modal with empty fields
    });

    // Close the modal when the close button is clicked
    closeButton.addEventListener('click', function () {
        addModal.style.display = 'none';
    });

    // Close the modal when clicking outside of it
    window.addEventListener('click', function (event) {
        if (event.target === addModal) {
            addModal.style.display = 'none';
        }
    });
});


// table
// document.addEventListener('DOMContentLoaded', function () {
//     // Handle download confirmation
//     const documentLinks = document.querySelectorAll('.document-link');

//     documentLinks.forEach(link => {
//         link.addEventListener('click', function (event) {
//             event.preventDefault(); // Prevent the default download action

//             const documentName = this.getAttribute('data-document-name');
//             const confirmation = confirm(`Do you want to download ${documentName}?`);

//             if (confirmation) {
//                 // Proceed with download if confirmed
//                 window.location.href = this.href;
//             }
//         });
//     });
// });


// /view table button/
document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('viewModal');
    var closeButton = document.getElementById('closeButton');

    document.querySelectorAll('.view-button').forEach(button => {
        button.addEventListener('click', function () {
            var id = this.getAttribute('data-id');
            var title = this.getAttribute('data-title');
            var desc = this.getAttribute('data-desc');
            var file = this.getAttribute('data-file');
            var date = this.getAttribute('data-date');

            document.getElementById('rscrId').value = id;
            document.getElementById('rscrDocumentTitle').value = title;
            document.getElementById('rscrDocumentDesc').value = desc;
            document.getElementById('rscrDocumentFileLink').textContent = file;
            document.getElementById('rscrDocumentFileLink').href = file;
            document.getElementById('rscrDateUploaded').value = date;

            var formAction = `/moderator/resources/${id}`;
            document.getElementById('editResourceForm').action = formAction;

            modal.style.display = 'block';
        });
    });

    closeButton.addEventListener('click', function () {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });
});