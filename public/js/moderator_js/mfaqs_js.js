/view button/

document.addEventListener('DOMContentLoaded', function() {
    const viewButtons = document.querySelectorAll('.view-button');
    const viewFaqModal = document.getElementById('viewFaqModal');
    const closeButton = viewFaqModal.querySelector('.close-button');
    
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            const faqId = row.getAttribute('data-id');
            const faqConcern = row.getAttribute('data-concern');
            const faqFrequency = row.getAttribute('data-frequency');
            const faqDate = row.getAttribute('data-date');

            document.getElementById('viewFaqId').textContent = faqId;
            document.getElementById('viewFaqConcern').textContent = faqConcern;
            document.getElementById('viewFaqFrequency').textContent = faqFrequency;
            document.getElementById('viewFaqDate').textContent = faqDate;

            viewFaqModal.style.display = 'block';
        });
    });

    closeButton.addEventListener('click', function() {
        viewFaqModal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === viewFaqModal) {
            viewFaqModal.style.display = 'none';
        }
    });
});


/filter button/

document.addEventListener('DOMContentLoaded', function() {
    const filterButton = document.getElementById('filterButton');
    const filterFaqModal = document.getElementById('filterFaqModal');
    const closeButton = filterFaqModal.querySelector('.close-button');
    const filterForm = document.getElementById('filterForm');

    // Open the filter modal
    filterButton.addEventListener('click', function() {
        filterFaqModal.style.display = 'block';
    });

    // Close the filter modal
    closeButton.addEventListener('click', function() {
        filterFaqModal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === filterFaqModal) {
            filterFaqModal.style.display = 'none';
        }
    });

    // Apply filter logic
    filterForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission
        const filterId = document.getElementById('filterId').value.toLowerCase();
        const filterConcern = document.getElementById('filterConcern').value.toLowerCase();
        const filterFrequency = document.getElementById('filterFrequency').value.toLowerCase();
        const filterDate = document.getElementById('filterDate').value;

        const rows = document.querySelectorAll('.table tbody tr');

        rows.forEach(row => {
            const id = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
            const concern = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const frequency = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            const date = row.querySelector('td:nth-child(4)').textContent;

            const matchesId = !filterId || id.includes(filterId);
            const matchesConcern = !filterConcern || concern.includes(filterConcern);
            const matchesFrequency = !filterFrequency || frequency.includes(filterFrequency);
            const matchesDate = !filterDate || date === filterDate;

            if (matchesId && matchesConcern && matchesFrequency && matchesDate) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        filterFaqModal.style.display = 'none';
    });
});
