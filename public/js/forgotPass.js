let nextButton = document.getElementById('nextButton');
let submitOtpButton = document.getElementById('submitOtpButton');
let resendOtpButton = document.getElementById('resendOtpButton');
let backButton1 = document.getElementById('backButton1');
let backButton2 = document.getElementById('backButton2');
let backButton3 = document.getElementById('backButton3');
const forgotPassDiv = document.querySelector('.forgot-pass-content');
const otpDiv = document.querySelector('.verify-otp');
const newPassDiv = document.querySelector('.new-pass');

// CSRF token for AJAX requests
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Handle forgot password submission
document.getElementById('forgotPassForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const username = document.getElementById('usernameInput').value;
    const email = document.getElementById('emailInput').value;

    if (!username || !email) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Please fill in both username and email.',
        });
        return;
    }

    Swal.fire({
        title: 'Verifying...',
        text: 'Please wait while we verify your account.',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch('/validate-user', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ username, email })
    })
    .then(response => response.json())
    .then(data => {
        Swal.close();
        if (data.success) {
            otpDiv.style.display = 'flex';
            forgotPassDiv.style.display = 'none';
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                html: data.errors.join('<br>')
            });
        }
    })
    .catch(error => {
        Swal.close();
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An unexpected error occurred.',
        });
    });
});

// Handle OTP input fields navigation and submission
document.addEventListener("DOMContentLoaded", function() {
    const otpInputs = document.querySelectorAll('.otpInput');
    
    otpInputs.forEach((input, index) => {
        input.addEventListener('input', function() {
            if (input.value.length === 1 && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus(); // Move to the next input
            }
        });

        input.addEventListener('keydown', function(event) {
            if (event.key === 'Backspace' && input.value === '' && index > 0) {
                otpInputs[index - 1].focus(); // Move to the previous input
            }
        });
    });

    // Handle OTP submission
    document.getElementById('otpForm').addEventListener('submit', function(event) {
        event.preventDefault();

        let otp = '';
        otpInputs.forEach(input => {
            otp += input.value; // Concatenate the values from all the OTP inputs
        });

        if (otp.length !== 6) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please enter the full 6-digit OTP.',
            });
            return;
        }

        Swal.fire({
            title: 'Verifying OTP...',
            text: 'Please wait while we verify the OTP.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch('/verify-otp', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ otp })
        })
        .then(response => response.json())
        .then(data => {
            Swal.close();
            if (data.success) {
                otpDiv.style.display = 'none';
                newPassDiv.style.display = 'flex';
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    html: data.errors.join('<br>')
                });
            }
        })
        .catch(error => {
            Swal.close();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An unexpected error occurred.',
            });
        });
    });
});

// Handle resend OTP
resendOtpButton.addEventListener('click', function() {
    Swal.fire({
        title: 'Resending OTP...',
        text: 'Please wait while we resend the OTP.',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch('/resend-otp', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        }
    })
    .then(response => response.json())
    .then(data => {
        Swal.close();
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'OTP Resent',
                text: data.message,
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                html: data.errors.join('<br>')
            });
        }
    })
    .catch(error => {
        Swal.close();
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An unexpected error occurred.',
        });
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const toggleNewPassword = document.getElementById('toggleNewPassword');
    const newPasswordField = document.getElementById('newPassword');
    const toggleNewPasswordConfirmation = document.getElementById('toggleNewPasswordConfirmation');
    const newPasswordConfirmationField = document.getElementById('newPasswordConfirmation');

    // Toggle visibility for the password field
    toggleNewPassword.addEventListener('click', function () {
        const type = newPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
        newPasswordField.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

    // Toggle visibility for the confirmation password field
    toggleNewPasswordConfirmation.addEventListener('click', function () {
        const type = newPasswordConfirmationField.getAttribute('type') === 'password' ? 'text' : 'password';
        newPasswordConfirmationField.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
});


// Handle new password submission
document.getElementById('newPassForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);

    Swal.fire({
        title: 'Updating password...',
        text: 'Please wait while we update your password.',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch('/update-password', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        Swal.close();
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: data.message,
            }).then(() => {
                window.location.href = '/login';
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Password Error',
                html: data.errors.join('<br>')
            });
        }
    })
    .catch(error => {
        Swal.close();
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An unexpected error occurred.',
        });
    });
});

// Back button behavior
backButton1.addEventListener('click', function() {
    window.location.href = '/login';
});
backButton2.addEventListener('click', function() {
    forgotPassDiv.style.display = 'flex';
    otpDiv.style.display = 'none';
    newPassDiv.style.display = 'none';
});
backButton3.addEventListener('click', function() {
    otpDiv.style.display = 'flex';
    newPassDiv.style.display = 'none';
});

// Handle toggle password visibility for the new password fields
