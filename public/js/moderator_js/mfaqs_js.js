/Get the modal/;
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('relatedFaqModal');
    const contentDiv = document.getElementById('relatedQuestionsContent');
    const closeButton = document.getElementsByClassName('close-button')[0];

    document.querySelectorAll('.view-related').forEach((button) => {
        button.addEventListener('click', function () {
            const relatedQuestions = JSON.parse(
                this.getAttribute('data-questions')
            );
            contentDiv.innerHTML = relatedQuestions
                .map((q) => `<p>${q}</p>`)
                .join('');
            modal.style.display = 'block';
        });
    });

    closeButton.onclick = function () {
        modal.style.display = 'none';
        contentDiv.innerHTML = '';
    };

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = 'none';
            contentDiv.innerHTML = '';
        }
    };
});

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

// table click

document.addEventListener('DOMContentLoaded', function () {
    // Select all table cells with the "clickable-cell" class
    const questionCells = document.querySelectorAll('.clickable-cell');

    // Get the modal and modal content elements
    const questionModal = document.getElementById('textModal');
    const questionContent = document.getElementById('fullText');

    // Close button in the modal
    const closeQuestionModal = questionModal.querySelector('.close-modal');

    // Add click event to each clickable question cell
    questionCells.forEach((cell) => {
        cell.addEventListener('click', function () {
            const fullText = this.getAttribute('data-full-text'); // Get the full question from the data attribute
            questionContent.textContent = fullText; // Set modal content with full question
            questionModal.style.display = 'block'; // Show modal
        });
    });

    // Close modal on clicking the close button
    closeQuestionModal.addEventListener('click', function () {
        questionModal.style.display = 'none'; // Hide modal
    });

    // Close modal when clicking outside of modal content
    window.addEventListener('click', function (event) {
        if (event.target === questionModal) {
            questionModal.style.display = 'none'; // Hide modal
        }
    });
});
