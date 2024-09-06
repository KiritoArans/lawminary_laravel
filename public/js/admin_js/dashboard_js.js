document.addEventListener('DOMContentLoaded', function () {
    const viewButtons = document.querySelectorAll('.btn-view');
    const modal = document.getElementById('viewModal');
    const closeButton = document.querySelector('.close-button');
    const modalContent = document.getElementById('modalContent');

    viewButtons.forEach((button) => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const row = this.parentElement.parentElement;
            const username = row.children[1].textContent;
            const action = row.children[2].textContent;
            const date = row.children[3].textContent;

            modalContent.innerHTML = `
                <p><strong>ID:</strong> ${id}</p>
                <p><strong>Username:</strong> ${username}</p>
                <p><strong>Action:</strong> ${action}</p>
                <p><strong>Date:</strong> ${date}</p>
            `;
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

//filter modal
console.log('JS Loaded');

document.addEventListener('DOMContentLoaded', function () {
    const filterButton = document.getElementById('filterButton');
    const filterModal = document.getElementById('filterModal');
    const closeButton = document.getElementById('closeFilterModal');
    const filterForm = document.getElementById('filterForm');

    filterButton.addEventListener('click', function () {
        filterModal.style.display = 'block';
    });

    closeButton.addEventListener('click', function () {
        filterModal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target == filterModal) {
            filterModal.style.display = 'none';
        }
    });
});
//filter function

function filterDashboard(filterId, filterUsername, filterAction, filterDate) {
    const rows = document.querySelectorAll('#dashboardTableBody tr');

    rows.forEach((row) => {
        const id = row
            .querySelector('td:nth-child(1)')
            .textContent.toLowerCase();
        const act_username = row
            .querySelector('td:nth-child(2)')
            .textContent.toLowerCase();
        const act_action = row
            .querySelector('td:nth-child(3)')
            .textContent.toLowerCase();
        const act_date = row
            .querySelector('td:nth-child(4)')
            .textContent.toLowerCase();

        const matchesId = !filterId || id.includes(filterId.toLowerCase());
        const matchesUsername =
            !filterUsername ||
            act_username.includes(filterUsername.toLowerCase());
        const matchesAction =
            !filterAction || act_action.includes(filterAction.toLowerCase());
        const matchesDate =
            !filterDate || act_date.includes(filterDate.toLowerCase());

        if (matchesId && matchesUsername && matchesAction && matchesDate) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}
