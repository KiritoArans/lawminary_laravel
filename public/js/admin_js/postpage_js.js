/view pending post button/

document.addEventListener('DOMContentLoaded', function () {
    // View Pending Posts Elements
    const viewPendingButton = document.getElementById('viewPendingButton');
    const pendingPostsModal = document.getElementById('pendingPostsModal');
    const closePendingPostsModal = document.getElementById('closePendingPostsModal');
    const pendingPostsContainer = document.getElementById('pendingPostsContainer');

    viewPendingButton.addEventListener('click', function () {
        loadPendingPosts();
        pendingPostsModal.style.display = 'block';
    });

    closePendingPostsModal.addEventListener('click', function () {
        pendingPostsModal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target == pendingPostsModal) {
            pendingPostsModal.style.display = 'none';
        }
    });

    function loadPendingPosts() {
        // Example data, replace with actual data fetching logic
        const pendingPosts = [
            { id: 1, content: 'Pending post content 1' },
            { id: 2, content: 'Pending post content 2' },
            { id: 3, content: 'Pending post content 3' }
        ];

        pendingPostsContainer.innerHTML = ''; // Clear existing content

        pendingPosts.forEach(post => {
            const postElement = document.createElement('div');
            postElement.className = 'pending-post';
            postElement.innerHTML = `
                <p>${post.content}</p>
                <div class="post-buttons">
                    <button class="custom-button approve-button" data-id="${post.id}">Approve</button>
                    <button class="custom-button disregard-button" data-id="${post.id}">Disregard</button>
                </div>
            `;
            pendingPostsContainer.appendChild(postElement);
        });

        // Attach event listeners to the new buttons
        document.querySelectorAll('.approve-button').forEach(button => {
            button.addEventListener('click', function () {
                const postId = this.getAttribute('data-id');
                approvePost(postId);
            });
        });

        document.querySelectorAll('.disregard-button').forEach(button => {
            button.addEventListener('click', function () {
                const postId = this.getAttribute('data-id');
                disregardPost(postId);
            });
        });
    }

    function approvePost(postId) {
        // Add logic to approve the post
        console.log(`Approved post with ID: ${postId}`);
        removePostFromUI(postId);
    }

    function disregardPost(postId) {
        // Add logic to disregard the post
        console.log(`Disregarded post with ID: ${postId}`);
        removePostFromUI(postId);
    }

    function removePostFromUI(postId) {
        const postElement = document.querySelector(`.pending-post .approve-button[data-id="${postId}"]`).closest('.pending-post');
        postElement.remove();
    }
});


/filter button/

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

    filterForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const filterPostId = document.getElementById('filterPostId').value.toLowerCase();
        const filterConcern = document.getElementById('filterConcern').value.toLowerCase();
        const filterPostedBy = document.getElementById('filterPostedBy').value.toLowerCase();
        const filterDate = document.getElementById('filterDate').value;
        const filterApprovedBy = document.getElementById('filterApprovedBy').value.toLowerCase();
        filterPosts(filterPostId, filterConcern, filterPostedBy, filterDate, filterApprovedBy);
        filterModal.style.display = 'none';
    });

    function filterPosts(filterPostId, filterConcern, filterPostedBy, filterDate, filterApprovedBy) {
        const rows = document.querySelectorAll('#postsTableBody tr');
        rows.forEach(row => {
            const postId = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
            const concern = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const postedBy = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            const date = row.querySelector('td:nth-child(4)').textContent;
            const approvedBy = row.querySelector('td:nth-child(5)').textContent.toLowerCase();

            const matchesPostId = !filterPostId || postId.includes(filterPostId);
            const matchesConcern = !filterConcern || concern.includes(filterConcern);
            const matchesPostedBy = !filterPostedBy || postedBy.includes(filterPostedBy);
            const matchesDate = !filterDate || date === filterDate;
            const matchesApprovedBy = !filterApprovedBy || approvedBy.includes(filterApprovedBy);

            if (matchesPostId && matchesConcern && matchesPostedBy && matchesDate && matchesApprovedBy) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
});

/edit button/

document.addEventListener('DOMContentLoaded', function () {
    // Edit Modal Elements
    const editButton = document.getElementById('editButton');
    const editModal = document.getElementById('editModal');
    const closeEditModal = document.getElementById('closeEditModal');
    const editForm = document.getElementById('editForm');
    const deleteButton = document.getElementById('deleteButton');
    let currentRow = null;

    editButton.addEventListener('click', function () {
        const selectedRowId = prompt("Enter the ID of the post you want to edit:");
        if (selectedRowId) {
            const rows = document.querySelectorAll('#postsTableBody tr');
            rows.forEach(row => {
                if (row.querySelector('td:nth-child(1)').textContent === selectedRowId) {
                    currentRow = row;
                    document.getElementById('editPostId').value = selectedRowId;
                    document.getElementById('editContent').value = row.querySelector('td:nth-child(2)').textContent;
                    document.getElementById('editStatus').value = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                    document.getElementById('editTags').value = row.querySelector('td:nth-child(4)').textContent;
                    editModal.style.display = 'block';
                }
            });
        }
    });

    closeEditModal.addEventListener('click', function () {
        editModal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target == editModal) {
            editModal.style.display = 'none';
        }
    });

    editForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const content = document.getElementById('editContent').value;
        const status = document.getElementById('editStatus').value;
        const tags = document.getElementById('editTags').value;
        const restrictDays = document.getElementById('restrictUser').value;
        const notifyUser = document.getElementById('notifyUser').checked;

        if (currentRow) {
            currentRow.querySelector('td:nth-child(2)').textContent = content;
            currentRow.querySelector('td:nth-child(3)').textContent = status.charAt(0).toUpperCase() + status.slice(1);
            currentRow.querySelector('td:nth-child(4)').textContent = tags;

            // Add logic to handle user restriction and notification
            if (restrictDays) {
                console.log(`User restricted for ${restrictDays} days`);
            }
            if (notifyUser) {
                console.log('User notified');
            }

            editModal.style.display = 'none';
        }
    });

    deleteButton.addEventListener('click', function () {
        if (currentRow) {
            currentRow.remove();
            editModal.style.display = 'none';
        }
    });
});
