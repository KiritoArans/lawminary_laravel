/edit button/

document.addEventListener('DOMContentLoaded', function() {
    console.log("Script loaded");

    const editButton = document.getElementById('editBtn');
    const editModal = document.getElementById('editModal');
    const closeButton = document.querySelector('#editModal .close-button');

    editButton.addEventListener('click', function() {
        console.log("Edit button clicked");
        editModal.style.display = 'block';
    });

    closeButton.addEventListener('click', function() {
        console.log("Close button clicked");
        editModal.style.display = 'none';
    });

     // Close modal when clicking outside of it
     window.addEventListener('click', function(event) {
        if (event.target === editModal) {
            editModal.style.display = 'none';
        }
    });
});

/view pending post button/

document.addEventListener('DOMContentLoaded', function() {
    const viewPendingButton = document.getElementById('viewPendingButton');
    const pendingItemsModal = document.getElementById('pendingItemsModal');
    const closeButton = document.querySelector('#pendingItemsModal .close-button');
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    // Show modal when button is clicked
    viewPendingButton.addEventListener('click', function() {
        pendingItemsModal.style.display = 'block';
    });

    // Close modal when close button is clicked
    closeButton.addEventListener('click', function() {
        pendingItemsModal.style.display = 'none';
    });

    // Close modal when clicking outside of it
    window.addEventListener('click', function(event) {
        if (event.target === pendingItemsModal) {
            pendingItemsModal.style.display = 'none';
        }
    });

    // Tab switching logic
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');

            // Remove active class from all buttons and contents
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));

            // Add active class to the selected button and content
            this.classList.add('active');
            document.getElementById(targetTab).classList.add('active');
        });
    });
});


/filter button/

document.addEventListener('DOMContentLoaded', function() {
    const filterButton = document.getElementById('filterButton');
    const filterModal = document.getElementById('filterModal');
    const closeButton = document.querySelector('#filterModal .close-button');

    // Show modal when filter button is clicked
    filterButton.addEventListener('click', function() {
        filterModal.style.display = 'block';
    });

    // Close modal when close button is clicked
    closeButton.addEventListener('click', function() {
        filterModal.style.display = 'none';
    });

    // Close modal when clicking outside of it
    window.addEventListener('click', function(event) {
        if (event.target === filterModal) {
            filterModal.style.display = 'none';
        }
    });

    // Handle form submission (You can replace this with actual filter logic)
    document.getElementById('filterForm').addEventListener('submit', function(event) {
        event.preventDefault();
        // Add your filter logic here
        console.log('Filters applied');
        filterModal.style.display = 'none';
    });
});
