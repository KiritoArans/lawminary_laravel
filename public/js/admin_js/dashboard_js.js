// document.addEventListener('DOMContentLoaded', function () {
//     const viewButtons = document.querySelectorAll('.btn-view');
//     const modal = document.getElementById('viewModal');
//     const closeButton = document.querySelector('.close-button');
//     const closeButtonView = document.querySelector('.close-buttonView');
//     const modalContent = document.getElementById('modalContent');

//     viewButtons.forEach((button) => {
//         button.addEventListener('click', function () {
//             const id = this.getAttribute('data-id');
//             const row = this.parentElement.parentElement;
//             const username = row.children[1].textContent;
//             const action = row.children[2].textContent;
//             const date = row.children[3].textContent;

//             modalContent.innerHTML = `
//                 <p><strong>ID:</strong> ${id}</p>
//                 <p><strong>Username:</strong> ${username}</p>
//                 <p><strong>Action:</strong> ${action}</p>
//                 <p><strong>Date:</strong> ${date}</p>
//             `;
//             modal.style.display = 'block';
//         });
//     });

//     closeButton.addEventListener('click', function () {
//         modal.style.display = 'none';
//     });
//     closeButtonView.addEventListener('click', function () {
//         modal.style.display = 'none';
//     });

//     window.addEventListener('click', function (event) {
//         if (event.target == modal) {
//             modal.style.display = 'none';
//         }
//     });
// });

// //filter modal
// console.log('JS Loaded');

// document.addEventListener('DOMContentLoaded', function () {
//     const filterButton = document.getElementById('filterButton');
//     const filterModal = document.getElementById('filterModal');
//     const closeButton = document.getElementById('closeFilterModal');
//     const filterForm = document.getElementById('filterForm');

//     filterButton.addEventListener('click', function () {
//         filterModal.style.display = 'block';
//     });

//     closeButton.addEventListener('click', function () {
//         filterModal.style.display = 'none';
//     });

//     window.addEventListener('click', function (event) {
//         if (event.target == filterModal) {
//             filterModal.style.display = 'none';
//         }
//     });
// });
// //filter function

// function filterDashboard(filterId, filterUsername, filterAction, filterDate) {
//     const rows = document.querySelectorAll('#dashboardTableBody tr');

//     rows.forEach((row) => {
//         const id = row
//             .querySelector('td:nth-child(1)')
//             .textContent.toLowerCase();
//         const act_username = row
//             .querySelector('td:nth-child(2)')
//             .textContent.toLowerCase();
//         const act_action = row
//             .querySelector('td:nth-child(3)')
//             .textContent.toLowerCase();
//         const act_date = row
//             .querySelector('td:nth-child(4)')
//             .textContent.toLowerCase();

//         const matchesId = !filterId || id.includes(filterId.toLowerCase());
//         const matchesUsername =
//             !filterUsername ||
//             act_username.includes(filterUsername.toLowerCase());
//         const matchesAction =
//             !filterAction || act_action.includes(filterAction.toLowerCase());
//         const matchesDate =
//             !filterDate || act_date.includes(filterDate.toLowerCase());

//         if (matchesId && matchesUsername && matchesAction && matchesDate) {
//             row.style.display = '';
//         } else {
//             row.style.display = 'none';
//         }
//     });
// }

// //reset filter

// function resetFilter() {
//     // Clear all filter inputs
//     document.getElementById('filterId').value = '';
//     document.getElementById('filterUsername').value = '';
//     document.getElementById('filterAction').value = '';
//     document.getElementById('filterDate').value = '';

//     // Optionally, submit the form to reset the filter in the backend or refresh the page
//     document.getElementById('filterForm').submit(); // This will refresh the page with cleared filters
// }

// This function is called when a time range is selected (daily, weekly, monthly, yearly)
// This function is called when a time range is selected (daily, weekly, monthly, yearly)
function filterData(range) {
    // Update the URL to include the admin prefix
    fetch(`/admin/dashboard/data?range=${range}`)
        .then((response) => response.json())
        .then((data) => {
            // Update the chart with the new data
            updateChart(data);
        });
}
function updateChart(data) {
    const chartElement = document.getElementById('myChart').getContext('2d');

    // If a chart instance exists, destroy it before creating a new one
    if (window.myChart && typeof window.myChart.destroy === 'function') {
        window.myChart.destroy();
    }

    // Create the new chart with the fetched data
    window.myChart = new Chart(chartElement, {
        type: 'bar',
        data: {
            labels: data.labels, // Time periods (e.g., dates, weeks, months, or years)
            datasets: [
                {
                    label: 'Accounts Created',
                    data: data.accounts, // Number of accounts created
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Posts Created',
                    data: data.posts, // Number of posts created
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Forum Posts Created',
                    data: data.forumPosts, // Number of forum posts created
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true // Ensure the y-axis starts from 0
                }
            }
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    // Safely attach event listeners only if elements exist
    filterData('weekly');

    const dailyButton = document.getElementById('daily');
    const weeklyButton = document.getElementById('weekly');
    const monthlyButton = document.getElementById('monthly');
    const yearlyButton = document.getElementById('yearly');

    if (dailyButton) {
        dailyButton.addEventListener('click', function () {
            filterData('daily');
        });
    }

    if (weeklyButton) {
        weeklyButton.addEventListener('click', function () {
            filterData('weekly');
        });
    }

    if (monthlyButton) {
        monthlyButton.addEventListener('click', function () {
            filterData('monthly');
        });
    }

    if (yearlyButton) {
        yearlyButton.addEventListener('click', function () {
            filterData('yearly');
        });
    }
    if (window.myChart && typeof window.myChart.destroy === 'function') {
        window.myChart.destroy();
    }
});
