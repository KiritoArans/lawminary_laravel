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

// Function to open the edit modal and populate it with the resource data
function openEditModal(resource) {
    // Populate the modal fields with the resource data
    document.getElementById('documentTitle').value = resource.documentTitle;
    document.getElementById('documentDesc').value = resource.documentDesc;

    // Set the form action to update the resource using the resource ID
    document.getElementById('editResourceForm').action =
        `/moderator/resources/${resource.id}`;

    // Display the modal
    document.getElementById('editResourceModal').style.display = 'block';
}

// Function to close the modal
function closeModal() {
    document.getElementById('editResourceModal').style.display = 'none';
}

// Bind edit buttons (call this when the page loads)
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.edit-button').forEach((button) => {
        button.addEventListener('click', function () {
            // Parse the resource data from the button's data attribute
            const resource = JSON.parse(this.getAttribute('data-resource'));

            // Open the modal and pass the resource data to it
            openEditModal(resource);
        });
    });
});

// Optional: Close modal when clicking outside of the modal content
window.onclick = function (event) {
    const modal = document.getElementById('editResourceModal');
    if (event.target === modal) {
        closeModal();
    }
};

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
