/Get the modal/;

var modal = document.getElementById('relatedFaqModal');

// Get the <span> element that closes the modal
var closeButton = document.getElementsByClassName('close-button')[0];

// When the user clicks on a 'View Related Questions' button, open the modal
document.querySelectorAll('.view-related').forEach((button) => {
    button.addEventListener('click', function () {
        const questions = JSON.parse(this.getAttribute('data-questions'));

        // Populate the modal with related questions
        const contentDiv = document.getElementById('relatedQuestionsContent');
        contentDiv.innerHTML = ''; // Clear previous content

        questions.forEach((question) => {
            contentDiv.innerHTML += `${question.concern}<br/>`;
        });

        modal.style.display = 'block';
    });
});

// When the user clicks on <span> (x), close the modal
closeButton.onclick = function () {
    modal.style.display = 'none';
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
};

/filter button/;

document.addEventListener('DOMContentLoaded', function () {
    const filterButton = document.getElementById('filterButton');
    const filterFaqModal = document.getElementById('filterFaqModal');
    const closeButton = filterFaqModal.querySelector('.close-button');
    const filterForm = document.getElementById('filterForm');

    // Open the filter modal
    filterButton.addEventListener('click', function () {
        filterFaqModal.style.display = 'block';
    });

    // Close the filter modal
    closeButton.addEventListener('click', function () {
        filterFaqModal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target === filterFaqModal) {
            filterFaqModal.style.display = 'none';
        }
    });

    // Apply filter logic
    filterForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent form submission
        const filterId = document
            .getElementById('filterId')
            .value.toLowerCase();
        const filterConcern = document
            .getElementById('filterConcern')
            .value.toLowerCase();
        const filterFrequency = document
            .getElementById('filterFrequency')
            .value.toLowerCase();
        const filterDate = document.getElementById('filterDate').value;

        const rows = document.querySelectorAll('.table tbody tr');

        rows.forEach((row) => {
            const id = row
                .querySelector('td:nth-child(1)')
                .textContent.toLowerCase();
            const concern = row
                .querySelector('td:nth-child(2)')
                .textContent.toLowerCase();
            const frequency = row
                .querySelector('td:nth-child(3)')
                .textContent.toLowerCase();
            const date = row.querySelector('td:nth-child(4)').textContent;

            const matchesId = !filterId || id.includes(filterId);
            const matchesConcern =
                !filterConcern || concern.includes(filterConcern);
            const matchesFrequency =
                !filterFrequency || frequency.includes(filterFrequency);
            const matchesDate = !filterDate || date === filterDate;

            if (
                matchesId &&
                matchesConcern &&
                matchesFrequency &&
                matchesDate
            ) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        filterFaqModal.style.display = 'none';
    });
});
