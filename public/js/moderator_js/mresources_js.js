// /filter button/

document.addEventListener('DOMContentLoaded', function () {
    const filterButton = document.getElementById('filterButton');
    const filterModal = document.getElementById('filterModal');
    const closeButton = document.querySelector('#filterModal .close-button');

    filterButton.addEventListener('click', function () {
        filterModal.style.display = 'block';
    });

    closeButton.addEventListener('click', function () {
        filterModal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target === filterModal) {
            filterModal.style.display = 'none';
        }
    });

    document.getElementById('filterForm').addEventListener('submit', function (e) {
        e.preventDefault(); 

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

    function openModal() {
        addModal.style.display = 'block';
    }

    addButton.addEventListener('click', function () {
        openModal();
    });

    closeButton.addEventListener('click', function () {
        addModal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target === addModal) {
            addModal.style.display = 'none';
        }
    });
});



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

            document.getElementById('rsrcId').value = id;
            document.getElementById('rsrcDocumentTitle').value = title;
            document.getElementById('rsrcDocumentDesc').value = desc;
            document.getElementById('rsrcDocumentFileLink').textContent = file;
            document.getElementById('rsrcDocumentFileLink').href = file;
            document.getElementById('rsrcDateUploaded').value = date;

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