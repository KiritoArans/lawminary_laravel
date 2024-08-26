
/filter/

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

    filterForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const filterId = document.getElementById('filterId').value.toLowerCase();
        const filterUsername = document.getElementById('filterUsername').value.toLowerCase();
        const filterEmail = document.getElementById('filterEmail').value.toLowerCase();
        filterAccounts(filterId, filterUsername, filterEmail);
        filterModal.style.display = 'none';
    });

    function filterAccounts(filterId, filterUsername, filterEmail) {
        const rows = document.querySelectorAll('#accountTableBody tr');
        rows.forEach(row => {
            const id = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
            const username = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const email = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

            const matchesId = !filterId || id.includes(filterId);
            const matchesUsername = !filterUsername || username.includes(filterUsername);
            const matchesEmail = !filterEmail || email.includes(filterEmail);

            if (matchesId && matchesUsername && matchesEmail) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
});


/add/

document.addEventListener('DOMContentLoaded', function () {
    const addButton = document.getElementById('addButton');
    const addModal = document.getElementById('addModal');
    const closeAddModal = document.getElementById('closeAddModal');
    const addForm = document.getElementById('addForm');

    addButton.addEventListener('click', function () {
        addModal.style.display = 'block';
    });

    closeAddModal.addEventListener('click', function () {
        addModal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target == addModal) {
            addModal.style.display = 'none';
        }
    });

    addForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const name = document.getElementById('addName').value;
        const email = document.getElementById('addEmail').value;
        const username = document.getElementById('addUsername').value;
        const accountType = document.getElementById('addAccountType').value;
        const password = document.getElementById('addPassword').value;

        addAccount(name, email, username, accountType, password);
        addModal.style.display = 'none';
    });

    function addAccount(name, email, username, accountType, password) {
        const tbody = document.getElementById('accountTableBody');
        const newRow = document.createElement('tr');
        newRow.dataset.type = accountType.toLowerCase();
        newRow.innerHTML = `
            <td>new-id</td>
            <td>${username}</td>
            <td>${email}</td>
            <td>${new Date().toLocaleDateString()}</td>
            <td>${accountType.charAt(0).toUpperCase() + accountType.slice(1)}</td>
        `;
        tbody.appendChild(newRow);
    }
});

/edit/

document.addEventListener('DOMContentLoaded', function () {
    const editButton = document.getElementById('editButton');
    const editModal = document.getElementById('editModal');
    const closeEditModal = document.getElementById('closeEditModal');
    const editForm = document.getElementById('editForm');
    const deleteButton = document.getElementById('deleteButton');
    let currentRow = null;

    editButton.addEventListener('click', function () {
        const selectedRow = prompt("Enter the ID of the account you want to edit:");
        if (selectedRow) {
            const rows = document.querySelectorAll('#accountTableBody tr');
            rows.forEach(row => {
                if (row.querySelector('td:nth-child(1)').textContent === selectedRow) {
                    currentRow = row;
                    document.getElementById('editId').value = selectedRow;
                    document.getElementById('editName').value = row.querySelector('td:nth-child(2)').textContent;
                    document.getElementById('editEmail').value = row.querySelector('td:nth-child(3)').textContent;
                    document.getElementById('editUsername').value = row.querySelector('td:nth-child(2)').textContent;
                    editModal.style.display = 'block';
                }
            });
        }
    });

    closeEditModal.addEventListener('click', function () {
        editModal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target == editModal) {
            editModal.style.display = 'none';
        }
    });

    editForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const name = document.getElementById('editName').value;
        const email = document.getElementById('editEmail').value;
        const username = document.getElementById('editUsername').value;
        const password = document.getElementById('editPassword').value;

        if (currentRow) {
            currentRow.querySelector('td:nth-child(2)').textContent = name;
            currentRow.querySelector('td:nth-child(3)').textContent = email;
            currentRow.querySelector('td:nth-child(4)').textContent = new Date().toLocaleDateString(); // Assuming Date Created field is updated
            editModal.style.display = 'none';
        }
    });

    deleteButton.addEventListener('click', function () {
        if (currentRow) {
            currentRow.remove();
            editModal.style.display = 'none';
        }
    });
});

