document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordField = document.getElementById('password');
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
    
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
});

// Toggle for confirm password field
document.getElementById('togglePasswordConfirmation').addEventListener('click', function () {
    const confirmPasswordField = document.getElementById('password_confirmation');
    const type = confirmPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
    confirmPasswordField.setAttribute('type', type);
    
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
});

document.addEventListener('DOMContentLoaded', function () {
    const otpModal = document.getElementById('otpModal');
    const otpError = document.getElementById('otpError');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Handle form submission to create an account
    document.querySelector('.signup-form').addEventListener('submit', function (event) {
        event.preventDefault();  // Prevent the default form submission behavior

        const formData = new FormData(this);

        // Show loading modal for OTP sending
        Swal.fire({
            title: 'Sending OTP...',
            text: 'Please wait while we verify your email.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Send the signup data via AJAX
        fetch('/signup', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to send signup request.');  // Handle non-200 HTTP responses
            }
            return response.json();
        })
        .then(data => {
            Swal.close(); // Close loading modal
            if (data.success) {
                // Show OTP modal on success
                otpModal.style.display = 'flex';
            } else {
                // Show validation or server errors
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    html: data.errors.join('<br>') // Display validation errors
                });
            }
        })
        .catch(error => {
            console.error('Error occurred during signup request:', error);  // Log the exact error
            Swal.close();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An unexpected error occurred. Please try again.',
            });
        });
    });

    // Handle OTP verification in the modal
    document.getElementById('verifyOtpButton').addEventListener('click', function () {
        const otp = document.getElementById('otpInput').value;

        if (!otp) {
            otpError.style.display = 'block';
            otpError.innerHTML = 'Please enter the OTP.';
            return;
        }

        otpError.style.display = 'none'; // Hide any previous errors

        Swal.fire({
            title: 'Verifying OTP...',
            text: 'Please wait while we verify the OTP.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Send OTP verification request
        fetch('/verify-otp', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ otp })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to verify OTP.');  // Handle non-200 HTTP responses
            }
            return response.json();
        })
        .then(data => {
            Swal.close();
            if (data.success) {
                otpModal.style.display = 'none'; // Close OTP modal
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Account created successfully!'
                }).then(() => {
                    window.location.href = '/login'; // Redirect to login
                });
            } else {
                otpError.style.display = 'block';
                otpError.innerHTML = data.errors.join('<br>'); // Show OTP error
            }
        })
        .catch(error => {
            console.error('Error occurred during OTP verification:', error);  // Log the exact error
            Swal.close();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An unexpected error occurred. Please try again.',
            });
        });
    });

    // Handle resend OTP
    document.getElementById('resendOtpButton').addEventListener('click', function () {
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
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to resend OTP.');  // Handle non-200 HTTP responses
            }
            return response.json();
        })
        .then(data => {
            Swal.close();
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'OTP Resent',
                    text: data.message
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to resend OTP. Please try again.'
                });
            }
        })
        .catch(error => {
            console.error('Error occurred during OTP resend:', error);  // Log the exact error
            Swal.close();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An unexpected error occurred.'
            });
        });
    });
});
