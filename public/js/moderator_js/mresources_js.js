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

// Function to bind the click event to the view buttons

// Function to close the modal
function bindCloseButton() {
    const closeButton = document.querySelector('.close-btnEdit');
    const modal = document.getElementById('editResourceModal');

    closeButton.addEventListener('click', function () {
        modal.style.display = 'none';
    });

    // Also close the modal when clicking outside of the modal content
    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
}

// Ensure everything runs when the DOM is fully loaded
document.addEventListener('DOMContentLoaded', function () {
    bindViewButtons(); // Bind view button events
    bindCloseButton(); // Bind close modal events
});

function bindViewButtons() {
    const buttons = document.querySelectorAll('.view-button');

    buttons.forEach((button) => {
        button.addEventListener('click', function () {
            // Get data attributes from the clicked button
            const id = this.getAttribute('data-id');
            const title = this.getAttribute('data-titleEdit');
            const desc = this.getAttribute('data-descEdit');
            const file = this.getAttribute('data-fileEdit');

            // Debugging: Log the values retrieved
            console.log('Data retrieved:', { id, title, desc, file });

            // Populate modal fields with the resource data
            document.getElementById('resourceId').value = id || ''; // Set the resource ID
            document.getElementById('documentTitleEdit').value = title || ''; // Set the title
            document.getElementById('documentDescEdit').value = desc || ''; // Set the description
            document.getElementById('documentFileName').value = file || ''; // Display the current file name

            // Display the modal
            const modal = document.getElementById('editResourceModal');
            modal.style.display = 'block';
        });
    });
}

function confirmDelete(resourceId) {
    // Show SweetAlert2 confirmation dialog
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33'
    }).then((result) => {
        if (result.isConfirmed) {
            // If user confirms, submit the form programmatically
            document.getElementById(`delete-form-${resourceId}`).submit();

            // Optionally show another alert after submission
            Swal.fire('Deleted!', 'The resource has been deleted.', 'success');
        } else {
            // Optional: Handle the case when user cancels
            Swal.fire('Cancelled', 'Your resource is safe!', 'info');
        }
    });
}

function resetFilter() {
    // Clear all filter inputs
    document.getElementById('filterId').value = '';
    document.getElementById('filterTitle').value = '';
    document.getElementById('filterDesc').value = '';
    document.getElementById('filterDate').value = '';

    // Optionally, submit the form to reset the filter in the backend or refresh the page
    document.getElementById('filterForm').submit(); // This will refresh the page with cleared filters
}

//table click

document.addEventListener('DOMContentLoaded', function () {
    const clickableCells = document.querySelectorAll('.clickable-cell');

    clickableCells.forEach((cell) => {
        cell.addEventListener('click', function () {
            const fullText = this.getAttribute('data-full-text'); // Get the content of the clicked cell
            document.getElementById('modalContent').textContent = fullText;

            // Show the modal
            document.getElementById('textModal').style.display = 'block';
        });
    });

    // Close modal logic
    const closeModal = document.querySelector('.close-modal');
    closeModal.addEventListener('click', function () {
        document.getElementById('textModal').style.display = 'none';
    });

    window.onclick = function (event) {
        const modal = document.getElementById('textModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };
});
