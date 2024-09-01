
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

    // addForm.addEventListener('submit', function (event) {
    //     event.preventDefault(); 
    
    //     const name = document.getElementById('addName').value.trim();
    //     const email = document.getElementById('addEmail').value.trim();
    //     const username = document.getElementById('addUsername').value.trim();
    //     const accountType = document.getElementById('addAccountType').value;
    //     const password = document.getElementById('addPassword').value.trim();
    
    //     // Custom validation or additional logic here
    //     if (name && email && username && accountType && password) {
    //         addAccount(name, email, username, accountType, password);
    //         addModal.style.display = 'none';
    //         this.submit(); // Proceed with form submission
    //     } else {
    //         // Handle missing data
    //         alert('Please fill in all required fields.');
    //     }
    // });
    
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
});

//update/edit the table file
document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.edit-button');
    const editModal = document.getElementById('editAccountModal');
    const closeEditModalFooter = document.getElementById('closeEditModalFooter');
    const closeEditModalX = document.getElementById('closeEditModalX');

    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const account = JSON.parse(this.getAttribute('data-account'));

            // Populate the form fields
            document.getElementById('editUserId').value = account.user_id;
            document.getElementById('editUsername').value = account.username;
            document.getElementById('editEmail').value = account.email;
            document.getElementById('editPassword').value = '';
            document.getElementById('editFirstName').value = account.firstName;
            document.getElementById('editMiddleName').value = account.middleName;
            document.getElementById('editLastName').value = account.lastName;
            document.getElementById('editBirthDate').value = account.birthDate;
            document.getElementById('editNationality').value = account.nationality;
            document.getElementById('editSexForm').value = account.sex;
            document.getElementById('editSex').value = account.sex;
            document.getElementById('editContactNumber').value = account.contactNumber;
            document.getElementById('editRestrict').checked = account.restrict;
            document.getElementById('editRestrictDays').value = account.restrictDays;
            document.getElementById('editAccountType').value = account.accountType;

            // Update the form action URL to include the correct ID
            document.getElementById('editAccountForm').action = `/admin/account/${account.user_id}`;

            // Show the modal by setting its display to block
            editModal.style.display = "block";
        });
    });

    // Close the modal when the user clicks on <span> (x) or footer close button
    closeEditModalX.addEventListener('click', function() {
        editModal.style.display = "none";
    });

    closeEditModalFooter.addEventListener('click', function() {
        editModal.style.display = "none";
    });

    // Close the modal when the user clicks outside of the modal
    window.addEventListener('click', function(event) {
        if (event.target == editModal) {
            editModal.style.display = "none";
        }
    });
});



