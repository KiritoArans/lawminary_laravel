/filter/;
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

    function filterAccounts(filterId, filterUsername, filterEmail) {
        const rows = document.querySelectorAll('#accountTableBody tr');
        rows.forEach((row) => {
            const id = row
                .querySelector('td:nth-child(1)')
                .textContent.toLowerCase();
            const username = row
                .querySelector('td:nth-child(2)')
                .textContent.toLowerCase();
            const email = row
                .querySelector('td:nth-child(3)')
                .textContent.toLowerCase();

            const matchesId = !filterId || id.includes(filterId);
            const matchesUsername =
                !filterUsername || username.includes(filterUsername);
            const matchesEmail = !filterEmail || email.includes(filterEmail);

            if (matchesId && matchesUsername && matchesEmail) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
    // Define the resetFilter function
    window.resetFilter = function () {
        // Reset form fields
        filterForm.reset();

        // Show all rows again after reset
        const rows = document.querySelectorAll('#accountTableBody tr');
        rows.forEach((row) => {
            row.style.display = ''; // Reset the display of all rows
        });
    };
});

/add/;

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

document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('editAccountModal');
    var closeButton = document.getElementById('closeEditModalX');

    document.querySelectorAll('.edit-button').forEach((button) => {
        button.addEventListener('click', function () {
            var id = this.getAttribute('data-id');
            var username = this.getAttribute('data-username');
            var email = this.getAttribute('data-email');
            var firstName = this.getAttribute('data-firstName');
            var middleName = this.getAttribute('data-middleName');
            var lastName = this.getAttribute('data-lastName');
            var birthDate = this.getAttribute('data-birthDate');
            var nationality = this.getAttribute('data-nationality');
            var sex = this.getAttribute('data-sex');
            var contactNumber = this.getAttribute('data-contactNumber');
            var restrict = this.getAttribute('data-restrict');
            var restrictDays = this.getAttribute('data-restrictDays');
            var accountType = this.getAttribute('data-accountType');

            document.getElementById('editId').value = id;
            document.getElementById('editUsername').value = username;
            document.getElementById('editEmail').value = email;
            document.getElementById('editFirstName').value = firstName;
            document.getElementById('editMiddleName').value = middleName;
            document.getElementById('editLastName').value = lastName;
            document.getElementById('editBirthDate').value = birthDate;
            document.getElementById('editNationality').value = nationality;
            document.getElementById('editSex').value = sex;
            document.getElementById('editContactNumber').value = contactNumber;
            document.getElementById('editRestrict').value = restrict;
            document.getElementById('editRestrictDays').value = restrictDays;
            document.getElementById('editAccountType').value = accountType;

            var formAction = `/admin/account/${id}`;
            document.getElementById('editAccountForm').action = formAction;
            console.log('Sex:', sex); // Debugging to see the value passed

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
//enable / disable logic for restrict days
document.getElementById('editRestrict').addEventListener('change', function () {
    var restrictDaysInput = document.getElementById('editRestrictDays');

    if (this.value === 'Yes') {
        restrictDaysInput.disabled = false;
        restrictDaysInput.required = true; // Makes it required when 'Yes' is selected
        restrictDaysInput.value = '1'; // Default to 1 if 'Yes' is selected
    } else {
        restrictDaysInput.disabled = true;
        restrictDaysInput.required = false; // Removes the required attribute
        restrictDaysInput.value = ''; // Clears the value when 'No' is selected
    }
});

// Ensure the correct initial state when the page loads
window.addEventListener('DOMContentLoaded', function () {
    var restrictDaysInput = document.getElementById('editRestrictDays');
    var restrictSelect = document.getElementById('editRestrict');

    if (restrictSelect.value === 'Yes') {
        restrictDaysInput.disabled = false;
    } else {
        restrictDaysInput.disabled = true;
    }
});
//search function
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search');
    const tableBody = document.getElementById('accountTableBody');
    const rows = tableBody.getElementsByTagName('tr');

    searchInput.addEventListener('keyup', function () {
        console.log('Search triggered'); // Check if this appears
        const searchValue = searchInput.value.toLowerCase();
        console.log('Search value:', searchValue); // Log the search value

        for (let i = 0; i < rows.length; i++) {
            const row = rows[i];
            let rowText = row.textContent.toLowerCase();
            console.log('Row text:', rowText); // Log each row's text content

            if (rowText.includes(searchValue)) {
                row.style.display = ''; // Show the row
            } else {
                row.style.display = 'none'; // Hide the row
            }
        }
    });
});
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-view-reject').forEach((button) => {
        button.addEventListener('click', function () {
            const accountId = this.getAttribute('data-account-id');
            confirmDelete(accountId);
        });
    });
});

function confirmDelete(accountId) {
    Swal.fire({
        title: 'Delete ID #' + accountId + '?',
        text: 'The data will be deleted in the database.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + accountId).submit();
        }
    });
}

//pending accounts

document.addEventListener('DOMContentLoaded', function () {
    const viewPendingButton = document.getElementById('viewPendingButton');
    const pendingAccountsModal = document.getElementById(
        'pendingAccountsModal'
    );
    const closeModalButton = document.getElementById('closeModal');

    // Function to open the modal
    function openModal() {
        pendingAccountsModal.style.display = 'block';
    }

    // Function to close the modal
    function closeModal() {
        pendingAccountsModal.style.display = 'none';
    }

    // Open the modal when the button is clicked
    viewPendingButton.addEventListener('click', openModal);

    // Close the modal when the close button is clicked
    closeModalButton.addEventListener('click', closeModal);

    // Close the modal when clicking outside the modal content
    window.addEventListener('click', function (event) {
        if (event.target == pendingAccountsModal) {
            closeModal();
        }
    });

    // Check if "modal=true" is present in the URL to automatically open the modal
    if (window.location.search.includes('modal=true')) {
        openModal();
    }
});

document
    .getElementById('contactNumber')
    .addEventListener('input', function (e) {
        // Replace any non-digit characters
        this.value = this.value.replace(/\D/g, '');
    });

// public/js/populateNationalities.js
document.addEventListener('DOMContentLoaded', function () {
    // Fetch the nationalities from the JSON file
    fetch('/nationalities.json') // Adjust the path if necessary
        .then((response) => response.json())
        .then((data) => {
            const nationalitySelect = document.getElementById('nationality');
            data.forEach((nationality) => {
                const option = document.createElement('option');
                option.value = nationality.name;
                option.text = nationality.name;
                nationalitySelect.appendChild(option);
            });
        })
        .catch((error) => console.error('Error loading nationalities:', error));
});

// Open modal when the image is clicked
document.querySelectorAll('.clickable-photo').forEach((img) => {
    img.addEventListener('click', function () {
        var modal = document.getElementById('imageModalPic');
        var fullImage = document.getElementById('fullImage');
        fullImage.src = this.getAttribute('data-fullsize');
        modal.style.display = 'flex'; // Use flex to center the image
    });
});

// Close modal when the "X" button is clicked
document.getElementById('closeModalPic').addEventListener('click', function () {
    var modal = document.getElementById('imageModalPic');
    modal.style.display = 'none';
});

// Close modal when clicking outside the image
document
    .getElementById('imageModalPic')
    .addEventListener('click', function (event) {
        if (event.target === this) {
            this.style.display = 'none';
        }
    });

//table click

document.addEventListener('DOMContentLoaded', function () {
    // Select all table cells except for "Display Photo" (2nd column) and "Action" (last column)
    const cells = document.querySelectorAll('.clickable-cell');

    // Get the modal and modal content elements
    const modal = document.getElementById('textModal');
    const modalContent = document.getElementById('fullText');

    // Close button in the modal
    const closeModal = document.querySelector('.close-modal');

    // Add click event to each clickable cell
    cells.forEach((cell) => {
        cell.addEventListener('click', function () {
            const fullText = this.getAttribute('data-full-text'); // Get the full text from the data attribute
            modalContent.textContent = fullText; // Set modal content
            modal.style.display = 'flex'; // Show the modal
        });
    });

    // Close modal on clicking the close button
    closeModal.addEventListener('click', function () {
        modal.style.display = 'none'; // Hide modal
    });

    // Close modal when clicking outside of modal content
    window.onclick = function (event) {
        if (event.target === modal) {
            modal.style.display = 'none'; // Hide modal
        }
    };
});
