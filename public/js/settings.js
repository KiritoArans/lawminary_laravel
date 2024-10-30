document.querySelectorAll('.settings-menu a').forEach(tab => {
    tab.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelectorAll('.settings-menu a').forEach(item => item.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
        this.classList.add('active');
        document.getElementById(this.getAttribute('data-tab')).classList.add('active');
    });
});


function toggleDropdown() {
    var dropdown = document.getElementById("settingsDropdown");
    if (dropdown.style.display === "block") {
        dropdown.style.display = "none";
    } else {
        dropdown.style.display = "block";
    }
}

window.onclick = function(event) {
    if (!event.target.matches('.fa-gear') && !event.target.matches('span') && !event.target.closest('.current')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.style.display === "block") {
                openDropdown.style.display = "none";
            }
        }
    }
}


document.getElementById('userPhotoInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profileImagePreview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});


document.addEventListener('DOMContentLoaded', function () {
    const toggleCurrentPassword = document.getElementById('toggleCurrentPassword');
    const currentPasswordField = document.getElementById('current-password');

    const toggleNewPassword = document.getElementById('toggleNewPassword');
    const newPasswordField = document.getElementById('new-password');

    const toggleRepeatPassword = document.getElementById('toggleRepeatPassword');
    const repeatPasswordField = document.getElementById('repeat-password');

    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');

    // Toggle visibility for current password
    toggleCurrentPassword.addEventListener('click', function () {
        const type = currentPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
        currentPasswordField.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

    // Toggle visibility for new password
    toggleNewPassword.addEventListener('click', function () {
        const type = newPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
        newPasswordField.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

    // Toggle visibility for repeat password
    toggleRepeatPassword.addEventListener('click', function () {
        const type = repeatPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
        repeatPasswordField.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

    togglePassword.addEventListener('click', function () {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
});


function confirmDelete() {
    Swal.fire({
        title: 'Your Account will be Deleted!',
        text: "This action cannot be undone.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            document.querySelector("form").submit();
        }
    });
}