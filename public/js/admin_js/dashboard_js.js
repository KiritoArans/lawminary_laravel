document.addEventListener('DOMContentLoaded', function() {
    const viewButtons = document.querySelectorAll('.btn-view');
    const modal = document.getElementById('viewModal');
    const closeButton = document.querySelector('.close-button');
    const modalContent = document.getElementById('modalContent');

    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const row = this.parentElement.parentElement;
            const username = row.children[1].textContent;
            const action = row.children[2].textContent;
            const date = row.children[3].textContent;

            modalContent.innerHTML = `
                <p><strong>ID:</strong> ${id}</p>
                <p><strong>Username:</strong> ${username}</p>
                <p><strong>Action:</strong> ${action}</p>
                <p><strong>Date:</strong> ${date}</p>
            `;
            modal.style.display = 'block';
        });
    });

    closeButton.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });
});
