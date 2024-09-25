/filter button/

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
        const filterForumId = document.getElementById('filterForumId').value.toLowerCase();
        const filterForumName = document.getElementById('filterForumName').value.toLowerCase();
        const filterForumDescription = document.getElementById('filterForumDescription').value.toLowerCase();
        const filterMembersCount = document.getElementById('filterMembersCount').value;
        const filterDateCreated = document.getElementById('filterDateCreated').value;
        filterForums(filterForumId, filterForumName, filterForumDescription, filterMembersCount, filterDateCreated);
        filterModal.style.display = 'none';
    });

    function filterForums(filterForumId, filterForumName, filterForumDescription, filterMembersCount, filterDateCreated) {
        const rows = document.querySelectorAll('#forumsTableBody tr');
        rows.forEach(row => {
            const forumId = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
            const forumName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const forumDescription = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            const membersCount = row.querySelector('td:nth-child(4)').textContent;
            const dateCreated = row.querySelector('td:nth-child(5)').textContent;

            const matchesForumId = !filterForumId || forumId.includes(filterForumId);
            const matchesForumName = !filterForumName || forumName.includes(filterForumName);
            const matchesForumDescription = !filterForumDescription || forumDescription.includes(filterForumDescription);
            const matchesMembersCount = !filterMembersCount || membersCount === filterMembersCount;
            const matchesDateCreated = !filterDateCreated || dateCreated === filterDateCreated;

            if (matchesForumId && matchesForumName && matchesForumDescription && matchesMembersCount && matchesDateCreated) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
});

/add forum button/

document.addEventListener('DOMContentLoaded', function () {
    // Add Forum Modal Elements
    const addForumButton = document.getElementById('addForumButton');
    const addForumModal = document.getElementById('addForumModal');
    const closeAddForumModal = document.getElementById('closeAddForumModal');
    // const addForumForm = document.getElementById('addForumForm');
    let forumIdCounter = 3; // Adjust based on existing forums

    addForumButton.addEventListener('click', function () {
        addForumModal.style.display = 'block';
    });

    closeAddForumModal.addEventListener('click', function () {
        addForumModal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target == addForumModal) {
            addForumModal.style.display = 'none';
        }
    });

    // addForumForm.addEventListener('submit', function (event) {
    //     event.preventDefault();
    //     const forumName = document.getElementById('addForumName').value;
    //     const forumIssue = document.getElementById('addForumIssue').value;
    //     const forumDescription = document.getElementById('addForumDescription').value;
    //     const membersCount = document.getElementById('addMembersCount').value;
    //     const dateCreated = document.getElementById('addDateCreated').value;

    //     addForum(forumIdCounter++, forumName, forumIssue, forumDescription, membersCount, dateCreated);
    //     addForumModal.style.display = 'none';
    //     addForumForm.reset();
    // });

    // function addForum(id, name, issue, description, members, date) {
    //     const tbody = document.getElementById('forumsTableBody');
    //     const newRow = document.createElement('tr');
    //     newRow.innerHTML = `
    //         <td>${id}</td>
    //         <td>${name}</td>
    //         <td>${description}</td>
    //         <td>${members}</td>
    //         <td>${date}</td>
    //         <td><button class="action-button">View</button></td>
    //     `;
    //     tbody.appendChild(newRow);
    // }
});

/edit button/

document.addEventListener('DOMContentLoaded', function () {
    // Edit Forum Modal Elements
    const editButton = document.getElementById('editButton');
    const editForumModal = document.getElementById('editForumModal');
    const closeEditForumModal = document.getElementById('closeEditForumModal');
    const editForumForm = document.getElementById('editForumForm');
    const deleteForumButton = document.getElementById('deleteForumButton');
    let currentRow = null;

    editButton.addEventListener('click', function () {
        const selectedForumId = prompt("Enter the ID of the forum you want to edit:");
        if (selectedForumId) {
            const rows = document.querySelectorAll('#forumsTableBody tr');
            rows.forEach(row => {
                if (row.querySelector('td:nth-child(1)').textContent === selectedForumId) {
                    currentRow = row;
                    document.getElementById('editForumId').value = selectedForumId;
                    document.getElementById('editForumName').value = row.querySelector('td:nth-child(2)').textContent;
                    document.getElementById('editForumIssue').value = row.querySelector('td:nth-child(3)').textContent;
                    document.getElementById('editForumDescription').value = row.querySelector('td:nth-child(3)').textContent;
                    document.getElementById('editMembersCount').value = row.querySelector('td:nth-child(4)').textContent;
                    document.getElementById('editDateCreated').value = row.querySelector('td:nth-child(5)').textContent;
                    editForumModal.style.display = 'block';
                }
            });
        }
    });

    closeEditForumModal.addEventListener('click', function () {
        editForumModal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target == editForumModal) {
            editForumModal.style.display = 'none';
        }
    });

    editForumForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const forumName = document.getElementById('editForumName').value;
        const forumIssue = document.getElementById('editForumIssue').value;
        const forumDescription = document.getElementById('editForumDescription').value;
        const membersCount = document.getElementById('editMembersCount').value;
        const dateCreated = document.getElementById('editDateCreated').value;
        const restrictAccess = document.getElementById('restrictForumAccess').checked;
        const archiveForum = document.getElementById('archiveForum').checked;

        if (currentRow) {
            currentRow.querySelector('td:nth-child(2)').textContent = forumName;
            currentRow.querySelector('td:nth-child(3)').textContent = forumDescription;
            currentRow.querySelector('td:nth-child(4)').textContent = membersCount;
            currentRow.querySelector('td:nth-child(5)').textContent = dateCreated;

            // Add logic to handle restrict access and archive forum
            if (restrictAccess) {
                console.log('Forum access restricted');
            }
            if (archiveForum) {
                console.log('Forum archived');
            }

            editForumModal.style.display = 'none';
        }
    });

    deleteForumButton.addEventListener('click', function () {
        if (currentRow) {
            currentRow.remove();
            editForumModal.style.display = 'none';
        }
    });
});


/view modal button/

document.addEventListener('DOMContentLoaded', function () {
    // View Forum Modal Elements
    const viewForumModal = document.getElementById('viewForumModal');
    const closeViewForumModal = document.getElementById('closeViewForumModal');

    document.querySelectorAll('.action-button').forEach(button => {
        button.addEventListener('click', function () {
            const forumId = this.getAttribute('data-forum-id');
            const row = document.querySelector(`tr[data-forum-id="${forumId}"]`);

            document.getElementById('viewForumId').textContent = row.querySelector('td:nth-child(1)').textContent;
            document.getElementById('viewForumName').textContent = row.querySelector('td:nth-child(2)').textContent;
            document.getElementById('viewForumIssue').textContent = row.querySelector('td:nth-child(3)').textContent;
            document.getElementById('viewForumDescription').textContent = row.querySelector('td:nth-child(3)').textContent;
            document.getElementById('viewMembersCount').textContent = row.querySelector('td:nth-child(4)').textContent;
            document.getElementById('viewDateCreated').textContent = row.querySelector('td:nth-child(5)').textContent;

            viewForumModal.style.display = 'block';
        });
    });

    closeViewForumModal.addEventListener('click', function () {
        viewForumModal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target == viewForumModal) {
            viewForumModal.style.display = 'none';
        }
    });
});
