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

/action button, view button/

document.addEventListener('DOMContentLoaded', function() {
    const actionButtons = document.querySelectorAll('.action-btn');
    const modal = document.getElementById('actionModal');
    const closeButton = document.querySelector('#actionModal .close-button');

    const modalRank = document.getElementById('modalRank');
    const modalUsername = document.getElementById('modalUsername');
    const modalPoints = document.getElementById('modalPoints');
    const modalBadge = document.getElementById('modalBadge');

    actionButtons.forEach(button => {
        button.addEventListener('click', function() {
            const rank = this.getAttribute('data-rank');
            const username = this.getAttribute('data-username');
            const points = this.getAttribute('data-points');
            const badge = this.getAttribute('data-badge');

            modalRank.textContent = rank;
            modalUsername.textContent = username;
            modalPoints.textContent = points;
            modalBadge.textContent = badge;

            modal.style.display = 'block';
        });
    });

    closeButton.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});
