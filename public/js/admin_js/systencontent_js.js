/edit button/

document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-button');
    const editModal = document.getElementById('editModal');
    const closeEditModal = document.getElementById('closeEditModal');
    const editForm = document.getElementById('editForm');
    let currentRow = null;

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const item = this.getAttribute('data-item');
            const row = document.querySelector(`tr[data-item="${item}"]`);
            currentRow = row;

            document.getElementById('editItemName').value = item;
            document.getElementById('editContent').value = row.querySelector('td:nth-child(2) a').textContent;

            editModal.style.display = 'block';
        });
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

        if (currentRow) {
            currentRow.querySelector('td:nth-child(2) a').textContent = content;
            editModal.style.display = 'none';
        }
    });
});
