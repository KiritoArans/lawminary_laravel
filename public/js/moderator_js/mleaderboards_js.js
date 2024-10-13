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
    // Clear the filter inputs
    document.getElementById('filterRank').value = '';
    document.getElementById('filterMinPoints').value = '';
    document.getElementById('filterMaxPoints').value = '';

    // Optionally, submit the form to reset the filter in the backend
    document.forms['filterForm'].submit(); // Submits the form after clearing filters
}

// table click

document.addEventListener('DOMContentLoaded', function () {
    // Get the text modal and modal content elements
    const textModal = document.getElementById('textModal');
    const modalContent = document.getElementById('fullText');
    const closeModalText = document.querySelector('.close-modal');

    // Get the image modal and image content elements
    const imageModal = document.getElementById('imageModal');
    const fullImage = document.getElementById('fullImage');
    const closeModalImage = document.querySelectorAll('.close-modal')[1]; // Second close button for image modal

    // Handle cell clicks
    document.querySelectorAll('.clickable-cell').forEach((cell) => {
        cell.addEventListener('click', function () {
            const fullText = this.getAttribute('data-full-text'); // Get the full text from data attribute
            modalContent.textContent = fullText; // Set the modal content
            textModal.style.display = 'flex'; // Show the text modal
        });
    });

    // Handle image clicks
    document.querySelectorAll('.clickable-photo').forEach((img) => {
        img.addEventListener('click', function () {
            fullImage.src = this.getAttribute('data-fullsize'); // Set full-size image src
            imageModal.style.display = 'flex'; // Show the image modal
        });
    });

    // Close modal on clicking the close button for text modal
    closeModalText.addEventListener('click', function () {
        textModal.style.display = 'none'; // Hide the modal
    });

    // Close modal on clicking the close button for image modal
    closeModalImage.addEventListener('click', function () {
        imageModal.style.display = 'none'; // Hide the image modal
    });

    // Close modal when clicking outside of modal content
    window.onclick = function (event) {
        if (event.target === textModal) {
            textModal.style.display = 'none'; // Hide the modal
        }
        if (event.target === imageModal) {
            imageModal.style.display = 'none'; // Hide the image modal
        }
    };
});
