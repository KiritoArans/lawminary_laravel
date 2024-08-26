/boxes/

document.addEventListener('DOMContentLoaded', function() {
    // Dummy data for details
    const dataDetails = {
        pendingPosts: [
            'Post 1: Title of the post',
            'Post 2: Title of the post',
            'Post 3: Title of the post',
            'Post 4: Title of the post',
            'Post 5: Title of the post'
        ],
        pendingAccounts: [
            'Account 1: Username1',
            'Account 2: Username2',
            'Account 3: Username3',
            'Account 4: Username4',
            'Account 5: Username5',
            'Account 6: Username6',
            'Account 7: Username7',
            'Account 8: Username8'
        ],
        accounts: [
            'Account 1: Username1',
            'Account 2: Username2',
            'Account 3: Username3',
            'Account 4: Username4',
            'Account 5: Username5',
            'Account 6: Username6',
            'Account 7: Username7',
            'Account 8: Username8',
            'Account 9: Username9',
            'Account 10: Username10',
            'Account 11: Username11',
            'Account 12: Username12',
            'Account 13: Username13',
            'Account 14: Username14',
            'Account 15: Username15',
            'Account 16: Username16',
            'Account 17: Username17',
            'Account 18: Username18',
            'Account 19: Username19',
            'Account 20: Username20'
        ]
    };

    // Update the number in each box
    document.getElementById('pendingPosts').textContent = dataDetails.pendingPosts.length;
    document.getElementById('pendingAccounts').textContent = dataDetails.pendingAccounts.length;
    document.getElementById('accounts').textContent = dataDetails.accounts.length;

    // Click event for the boxes
    const boxes = document.querySelectorAll('.clickable');
    const modal = document.getElementById('detailsModal');
    const boxesCloseButton = document.querySelector('#detailsModal .close-button');
    const modalTitle = document.getElementById('modalTitle');
    const modalList = document.getElementById('modalList');

    boxes.forEach(box => {
        box.addEventListener('click', function() {
            const dataType = this.getAttribute('data-type');
            const details = dataDetails[dataType];

            modalTitle.textContent = this.querySelector('.text').textContent;
            modalList.innerHTML = ''; // Clear the list

            details.forEach(detail => {
                const listItem = document.createElement('li');
                listItem.textContent = detail;
                modalList.appendChild(listItem);
            });

            modal.style.display = 'block';
        });
    });

    // close the modal when x is clicked

    boxesCloseButton.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    // Close the modal when clicking outside of it
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});

/filter button/

document.addEventListener('DOMContentLoaded', function () {
    const filterButton = document.getElementById('filterButton');
    const filterModal = document.getElementById('filterModal');
    const filterCloseButton = document.querySelector('#filterModal .close-button');
    const applyFilter = document.getElementById('applyFilter');

    filterButton.addEventListener('click', function () {
        filterModal.style.display = 'block';
    });

    filterCloseButton.addEventListener('click', function() {
        filterModal.style.display = 'none';
    });
    

    window.addEventListener('click', function (event) {
        if (event.target == filterModal) {
            filterModal.style.display = 'none';
        }
    });

    applyFilter.addEventListener('click', function () {
        const filterId = document.getElementById('filterId').value.toLowerCase();
        const filterUsername = document.getElementById('filterUsername').value.toLowerCase();
        const filterAction = document.getElementById('filterAction').value.toLowerCase();
        const filterDate = document.getElementById('filterDate').value;

        const rows = document.querySelectorAll('#tableBody tr');
        rows.forEach(row => {
            const id = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
            const username = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const action = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            const date = row.querySelector('td:nth-child(4)').textContent;

            const matchesId = !filterId || id.includes(filterId);
            const matchesUsername = !filterUsername || username.includes(filterUsername);
            const matchesAction = !filterAction || action.includes(filterAction);
            const matchesDate = !filterDate || date.includes(filterDate);

            if (matchesId && matchesUsername && matchesAction && matchesDate) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        filterModal.style.display = 'none';
    });
    filterCloseButton.addEventListener('click', function() {
        filterModal.style.display = 'none';
    });
    
    
});


/view button/
document.addEventListener('DOMContentLoaded', function() {
    const viewButtons = document.querySelectorAll('.btn-view');
    const modal = document.getElementById('viewModal');
    const closeButton = document.querySelector('#viewModal .close-button');
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            const activityId = row.querySelector('td:nth-child(1)').textContent;
            const username = row.querySelector('td:nth-child(2)').textContent;
            const action = row.querySelector('td:nth-child(3)').textContent;
            const date = row.querySelector('td:nth-child(4)').textContent;

            document.getElementById('modalId').textContent = activityId;
            document.getElementById('modalUsername').textContent = username;
            document.getElementById('modalAction').textContent = action;
            document.getElementById('modalDate').textContent = date;

            modal.style.display = 'block';
        });
    });

    // Correctly selecting the close button using querySelector
    closeButton.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    // Close the modal when clicking outside of it
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});

