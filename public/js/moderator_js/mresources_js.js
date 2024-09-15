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
});

// add button
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

// Function to bind the event listeners to the view buttons
function bindViewButtons() {
    var modal = document.getElementById('viewModal');
    var closeButton = document.getElementById('closeButton');

    document.querySelectorAll('.view-button').forEach((button) => {
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
}

function confirmDelete(event) {
    event.preventDefault(); // Prevent form submission

    Swal.fire({
        title: 'Are you sure?',
        text: 'Do you want to delete this resource? This action cannot be undone!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // If confirmed, submit the form manually
            event.target.submit();
        }
    });
}

// Function to bind event listeners to "View" buttons
function bindViewButtons() {
    const modal = document.getElementById('viewModal');
    const closeButton = document.getElementById('closeButton');

    document.querySelectorAll('.view-button').forEach((button) => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const title = this.getAttribute('data-title');
            const desc = this.getAttribute('data-desc');
            const file = this.getAttribute('data-file');
            const date = this.getAttribute('data-date');

            document.getElementById('rsrcId').value = id;
            document.getElementById('rsrcDocumentTitle').value = title;
            document.getElementById('rsrcDocumentDesc').value = desc;
            document.getElementById('rsrcDocumentFileLink').textContent = file;
            document.getElementById('rsrcDocumentFileLink').href = file;
            document.getElementById('rsrcDateUploaded').value = date;

            const formAction = `/moderator/resources/${id}`;
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
}

// Search function
const searchInput = document.getElementById('searchInput'); // Corrected ID

searchInput.addEventListener('keyup', function () {
    const query = this.value;

    fetch(`/moderator/search-resources?query=${query}`)
        .then((response) => response.json())
        .then((data) => {
            let resultsHtml = '';

            if (data.length > 0) {
                data.forEach((resource) => {
                    resultsHtml += `
                        <tr>
                            <td>${resource.id}</td>
                            <td>${resource.documentTitle}</td>
                            <td>${resource.documentDesc}</td>
                            <td>${resource.documentFile}</td>
                            <td>${new Date(resource.created_at).toLocaleDateString()}</td>
                            <td>
                                <button type="button" class="custom-button view-button"
                                    data-id="${resource.id}"
                                    data-title="${resource.documentTitle}"
                                    data-desc="${resource.documentDesc}"
                                    data-file="${resource.documentFile}"
                                    data-date="${resource.created_at}">
                                    View
                                </button>
                                <form method="post" action="/moderator/resources/${resource.id}/destroy" onsubmit="confirmDelete(event);">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="delete">
                                    <button type="submit" class="delete-button">Delete</button>
                                </form>
                            </td>
                        </tr>`;
                });
            } else {
                resultsHtml = '<tr><td colspan="6">No results found</td></tr>';
            }

            document.querySelector('.resource-table tbody').innerHTML =
                resultsHtml;

            // Re-bind event listeners to new view buttons
            bindViewButtons();
        })
        .catch((error) => {
            console.error('Error fetching search results:', error);
        });
});

// Initial binding of view buttons on page load
document.addEventListener('DOMContentLoaded', function () {
    bindViewButtons();
});
