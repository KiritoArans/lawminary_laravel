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
function filterData(range) {
    console.log(`Button clicked for range: ${range}`);
    const basePath = window.location.pathname.includes('/admin')
        ? '/admin'
        : '/moderator';

    // Fetch the data for bar chart and pie chart using /admin/dashboard/data
    fetch(`${basePath}/dashboard/data?range=${range}`)
        .then((response) => response.json())
        .then((data) => {
            console.log('Fetched Data for Bar and Pie:', data);

            // Update the bar and pie charts with the fetched data
            updateBarChart(data.barChart); // Update the bar chart
            updatePieChart(data.pieChart); // Update the pie chart
        })
        .catch((error) => {
            console.error('Error fetching data for Bar and Pie:', error);
        });

    // Fetch the data for line chart using /api/chart-data
    fetch(`/api/chart-data?range=${range}`)
        .then((response) => response.json())
        .then((data) => {
            console.log('Fetched Data for Line Chart:', data);

            // Update the line graph with the fetched data
            updateLineGraph(data, range); // Update the line chart, pass the range to it
        })
        .catch((error) => {
            console.error('Error fetching data for Line Chart:', error);
        });
}

// Call the function to fetch default data (e.g., weekly) on page load
document.addEventListener('DOMContentLoaded', function () {
    filterData('weekly'); // Fetch 'weekly' data on page load
});

function updateBarChart(data) {
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
                    backgroundColor: 'rgba(255, 0, 0, 0.2)', // Red background
                    borderColor: 'rgba(255, 0, 0, 1)', // Red border
                    borderWidth: 1
                },
                {
                    label: 'Posts Created',
                    data: data.posts, // Number of posts created
                    backgroundColor: 'rgba(255, 165, 0, 0.2)', // Orange background
                    borderColor: 'rgba(255, 165, 0, 1)', // Orange border
                    borderWidth: 1
                },
                {
                    label: 'Forum Posts Created',
                    data: data.forumPosts, // Number of forum posts created
                    backgroundColor: 'rgba(255, 255, 0, 0.2)', // Yellow background
                    borderColor: 'rgba(255, 255, 0, 1)', // Yellow border
                    borderWidth: 1
                },
                {
                    label: 'Feedbacks Received',
                    data: data.feedbacks, // Add feedback data here
                    backgroundColor: 'rgba(0, 128, 0, 0.2)', // Green background
                    borderColor: 'rgba(0, 128, 0, 1)', // Green border
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

function updatePieChart(data) {
    const chartElement = document.getElementById('myPieChart').getContext('2d');

    if (window.myPieChart && typeof window.myPieChart.destroy === 'function') {
        window.myPieChart.destroy();
    }

    window.myPieChart = new Chart(chartElement, {
        type: 'pie',
        data: {
            labels: ['Accounts', 'Posts', 'Forum Posts', 'Feedbacks'],
            datasets: [
                {
                    label: 'Data Breakdown',
                    data: [
                        data.accounts[0],
                        data.posts[0],
                        data.forumPosts[0],
                        data.feedbacks[0]
                    ],
                    backgroundColor: [
                        'rgba(255, 0, 0, 0.8)', // Red
                        'rgba(255, 165, 0, 0.8)', // Orange
                        'rgba(255, 255, 0, 0.8)', // Yellow
                        'rgba(0, 128, 0, 0.8)' // Green
                    ],
                    borderColor: [
                        'rgba(255, 0, 0, 1)', // Red
                        'rgba(255, 165, 0, 1)', // Orange
                        'rgba(255, 255, 0, 1)', // Yellow
                        'rgba(0, 128, 0, 1)' // Green
                    ],

                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                datalabels: {
                    formatter: (value, ctx) => {
                        let sum = ctx.chart.data.datasets[0].data.reduce(
                            (a, b) => a + b,
                            0
                        );
                        let percentage = ((value / sum) * 100).toFixed(2) + '%';
                        return percentage;
                    },
                    color: '#fff',
                    font: {
                        weight: 'bold'
                    }
                },
                chart3d: {
                    enable: true, // Enables the 3D effect
                    depth: 10, // Depth of the 3D effect
                    perspective: 1000,
                    angleX: -30, // X-axis angle for 3D effect
                    angleY: 30 // Y-axis angle for 3D effect
                }
            }
        },
        plugins: [ChartDataLabels] // Enable the plugins
    });
}

function updateLineGraph(data, range) {
    const chartElement = document
        .getElementById('myLineChart')
        .getContext('2d');

    if (
        window.myLineChart &&
        typeof window.myLineChart.destroy === 'function'
    ) {
        window.myLineChart.destroy();
    }

    const timeUnit =
        range === 'yearly'
            ? 'month'
            : range === 'monthly'
              ? 'day'
              : range === 'weekly'
                ? 'day'
                : 'hour';

    // Make sure data arrays are correctly aligned with labels
    window.myLineChart = new Chart(chartElement, {
        type: 'line',
        data: {
            labels: data.labels, // X-axis labels (dates)
            datasets: [
                {
                    label: 'Accounts Created',
                    data: data.accounts, // Accounts data
                    backgroundColor: 'rgba(255, 0, 0, 0.2)',
                    borderColor: 'rgba(255, 0, 0, 1)',
                    borderWidth: 1,
                    fill: false
                },
                {
                    label: 'Posts Created',
                    data: data.posts, // Posts data
                    backgroundColor: 'rgba(255, 165, 0, 0.2)',
                    borderColor: 'rgba(255, 165, 0, 1)',
                    borderWidth: 1,
                    fill: false
                },
                {
                    label: 'Forum Posts Created',
                    data: data.forumPosts, // Forum posts data
                    backgroundColor: 'rgba(255, 255, 0, 0.2)',
                    borderColor: 'rgba(255, 255, 0, 1)',
                    borderWidth: 1,
                    fill: false
                },
                {
                    label: 'Feedbacks Received',
                    data: data.feedbacks, // Feedbacks data
                    backgroundColor: 'rgba(0, 128, 0, 0.2)',
                    borderColor: 'rgba(0, 128, 0, 1)',
                    borderWidth: 1,
                    fill: false
                }
            ]
        },
        options: {
            scales: {
                x: {
                    type: 'time',
                    time: {
                        unit: timeUnit, // Time unit based on selected range
                        tooltipFormat: 'YYYY-MM-DD HH:mm'
                    },
                    title: {
                        display: true,
                        text: 'Time'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Items'
                    }
                }
            }
        }
    });
}

// Call the function to fetch default data (e.g., weekly) on page load
document.addEventListener('DOMContentLoaded', function () {
    fetchChartData('weekly'); // Fetch 'weekly' data on page load
});

document.querySelectorAll('.minimize-chart').forEach(function (button, index) {
    button.addEventListener('click', function () {
        const chartContainer = button.closest('.chart-container');
        const chart = chartContainer.querySelector('canvas');

        // Set a label based on the chart being minimized
        let chartLabel;
        if (chart.id === 'myChart') {
            chartLabel = 'Bar Graph';
        } else if (chart.id === 'myPieChart') {
            chartLabel = 'Pie Chart';
        } else if (chart.id === 'myLineChart') {
            chartLabel = 'Line Graph';
        }

        const placeholder = document.createElement('div');
        placeholder.classList.add('minimized-placeholder');
        placeholder.innerHTML = `<span>${chartLabel}</span>`;

        placeholder.addEventListener('click', function () {
            chartContainer.classList.remove('hidden');
            chartContainer.style.display = 'block';
            placeholder.remove(); // Remove the placeholder after showing the chart
        });

        chartContainer.classList.add('hidden');
        chartContainer.style.display = 'none';

        chartContainer.parentNode.insertBefore(placeholder, chartContainer);
    });
});
document.addEventListener('DOMContentLoaded', function () {
    fetchEngagementData();
});

function fetchEngagementData() {
    fetch('{{ route("dashboard.postEngagementData") }}')
        .then((response) => response.json())
        .then((data) => {
            const timesSinceApproval = data.map(
                (post) => post.time_since_approval
            );
            const totalEngagements = data.map((post) => post.total_engagement);

            renderEngagementChart(timesSinceApproval, totalEngagements);
        });
}

function renderEngagementChart(times, engagements) {
    const ctx = document.getElementById('engagementChart').getContext('2d');
    new Chart(ctx, {
        type: 'scatter',
        data: {
            datasets: [
                {
                    label: 'Post Engagement vs Time Since Approval',
                    data: times.map((time, index) => ({
                        x: time,
                        y: engagements[index]
                    })),
                    backgroundColor: 'rgba(75, 192, 192, 0.6)'
                }
            ]
        },
        options: {
            scales: {
                x: {
                    type: 'linear',
                    position: 'bottom',
                    title: {
                        display: true,
                        text: 'Time Since Approval (Hours)'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Total Engagement (Likes + Comments)'
                    }
                }
            }
        }
    });
}

//post scatter diagram//

document.addEventListener('DOMContentLoaded', function () {
    // Attach event listeners to the time filter buttons
    filterData('weekly'); // Load weekly data by default

    const dailyButton = document.getElementById('daily');
    const weeklyButton = document.getElementById('weekly');
    const monthlyButton = document.getElementById('monthly');
    const yearlyButton = document.getElementById('yearly');

    if (dailyButton) {
        dailyButton.addEventListener('click', function () {
            filterData('daily');
            fetchEngagementData('daily'); // Fetch scatter data for daily range
        });
    }

    if (weeklyButton) {
        weeklyButton.addEventListener('click', function () {
            filterData('weekly');
            fetchEngagementData('weekly'); // Fetch scatter data for weekly range
        });
    }

    if (monthlyButton) {
        monthlyButton.addEventListener('click', function () {
            filterData('monthly');
            fetchEngagementData('monthly'); // Fetch scatter data for monthly range
        });
    }

    if (yearlyButton) {
        yearlyButton.addEventListener('click', function () {
            filterData('yearly');
            fetchEngagementData('yearly'); // Fetch scatter data for yearly range
        });
    }
});

function fetchEngagementData(range = 'weekly') {
    fetch(`/moderator/dashboard/post-engagement-data?range=${range}`)
        .then((response) => response.json())
        .then((data) => {
            const timesSinceApproval = data.map(
                (post) => post.time_since_approval
            );
            const totalEngagements = data.map((post) => post.total_engagement);

            renderEngagementChart(timesSinceApproval, totalEngagements);
        });
}

function renderEngagementChart(times, engagements) {
    const ctx = document.getElementById('engagementChart').getContext('2d');
    if (
        window.engagementChart &&
        typeof window.engagementChart.destroy === 'function'
    ) {
        window.engagementChart.destroy();
    }
    window.engagementChart = new Chart(ctx, {
        type: 'scatter',
        data: {
            datasets: [
                {
                    label: 'Post Engagement vs Time Since Approval',
                    data: times.map((time, index) => ({
                        x: time,
                        y: engagements[index]
                    })),
                    backgroundColor: 'rgba(75, 192, 192, 0.6)'
                }
            ]
        },
        options: {
            scales: {
                x: {
                    type: 'linear',
                    position: 'bottom',
                    title: {
                        display: true,
                        text: 'Time Since Approval (Hours)'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Total Engagement (Likes + Comments)'
                    }
                }
            }
        }
    });
}

//lawyerr engagment---------------------------------///

document.addEventListener('DOMContentLoaded', function () {
    // Attach event listeners to the time filter buttons
    filterData('weekly'); // Load weekly data by default

    const dailyButton = document.getElementById('daily');
    const weeklyButton = document.getElementById('weekly');
    const monthlyButton = document.getElementById('monthly');
    const yearlyButton = document.getElementById('yearly');

    if (dailyButton) {
        dailyButton.addEventListener('click', function () {
            filterData('daily');
            fetchLawyerResponseData('daily');
        });
    }

    if (weeklyButton) {
        weeklyButton.addEventListener('click', function () {
            filterData('weekly');
            fetchLawyerResponseData('weekly');
        });
    }

    if (monthlyButton) {
        monthlyButton.addEventListener('click', function () {
            filterData('monthly');
            fetchLawyerResponseData('monthly');
        });
    }

    if (yearlyButton) {
        yearlyButton.addEventListener('click', function () {
            filterData('yearly');
            fetchLawyerResponseData('yearly');
        });
    }

    // Fetch default weekly data on page load
    fetchLawyerResponseData('weekly');
});

function fetchLawyerResponseData(range = 'weekly') {
    fetch(`/moderator/dashboard/lawyer-response-data?range=${range}`)
        .then((response) => response.json())
        .then((data) => {
            console.log(data); // Add this line to check if data is coming through properly
            const avgResponseTimes = data.map(
                (lawyer) => lawyer.avg_response_time
            );
            const postsHandled = data.map((lawyer) => lawyer.posts_handled);

            renderLawyerResponseChart(avgResponseTimes, postsHandled);
        })
        .catch((error) => {
            console.error('Error fetching lawyer response data:', error);
        });
}

function renderLawyerResponseChart(avgTimes, handledPosts) {
    const ctx = document.getElementById('lawyerResponseChart').getContext('2d');
    if (
        window.lawyerResponseChart &&
        typeof window.lawyerResponseChart.destroy === 'function'
    ) {
        window.lawyerResponseChart.destroy();
    }
    window.lawyerResponseChart = new Chart(ctx, {
        type: 'scatter',
        data: {
            datasets: [
                {
                    label: 'Lawyer Response Time vs Posts Handled',
                    data: avgTimes.map((time, index) => ({
                        x: time,
                        y: handledPosts[index]
                    })),
                    backgroundColor: 'rgba(54, 162, 235, 0.6)'
                }
            ]
        },
        options: {
            scales: {
                x: {
                    type: 'linear',
                    position: 'bottom',
                    title: {
                        display: true,
                        text: 'Average Response Time (Hours)'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Number of Posts Handled'
                    }
                }
            }
        }
    });
}
