//view button
document.querySelectorAll('.action-btn').forEach((button) => {
    button.addEventListener('click', function () {
        const username = this.getAttribute('data-username');
        const points = this.getAttribute('data-points');
        const badge = this.getAttribute('data-badge');

        // Display more info, for example in a modal
        console.log(`User: ${username}, Points: ${points}, Badge: ${badge}`);
        // Code to handle modal pop-up or other actions
    });
});

//view leaderboards modal
document.addEventListener('DOMContentLoaded', function () {
    const viewButtons = document.querySelectorAll('.view-btn');
    const modal = document.getElementById('modal');
    const closeButton = document.getElementById('closeLeadBtn');

    viewButtons.forEach((button) => {
        button.addEventListener('click', function () {
            const userId = this.getAttribute('data-user_id');
            const rank = this.getAttribute('data-rank');
            const username = this.getAttribute('data-username');
            const points = this.getAttribute('data-points');
            const badge = this.getAttribute('data-badge');

            // Populate modal fields
            document.getElementById('viewUser_id').value = userId;
            document.getElementById('viewRank').value = rank;
            document.getElementById('viewUsername').value = username;
            document.getElementById('viewPoints').value = points;
            document.getElementById('viewBadge').value = badge;

            // Show the modal
            modal.style.display = 'block';
        });
    });

    // Close modal when clicking the close button
    closeButton.addEventListener('click', function () {
        modal.style.display = 'none';
    });

    // Close modal when clicking outside the modal content
    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});

//filter button

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

//reset filter

function resetFilter() {
    // Clear all filter inputs
    document.getElementById('filter_user_id').value = '';
    document.getElementById('filterRank').value = '';
    document.getElementById('filterName').value = '';
    document.getElementById('filterPoints').value = '';
    document.getElementById('filterBadge').value = '';

    // Optionally, submit the form to reset the filter in the backend or refresh the page
    document.getElementById('filterForm').submit(); // This will refresh the page with cleared filters
}
