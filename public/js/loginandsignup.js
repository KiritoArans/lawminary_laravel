document.addEventListener('DOMContentLoaded', function () {
    const usernameInput = document.getElementById('username');
    const firstNameInput = document.getElementById('first-name');
    const middleNameInput = document.getElementById('middle-name');
    const lastNameInput = document.getElementById('last-name');

    usernameInput.addEventListener('input', function () {
        this.value = this.value.replace(/[^a-zA-Z0-9]/g, '');
    });

    function autoCapitalize(input) {
        input.value = input.value
            .toLowerCase() 
            .replace(/\b\w/g, char => char.toUpperCase()); 
    }

    firstNameInput.addEventListener('input', function () {
        autoCapitalize(this);
    });

    middleNameInput.addEventListener('input', function () {
        autoCapitalize(this);
    });

    lastNameInput.addEventListener('input', function () {
        autoCapitalize(this);
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const signupBtn = document.getElementById('signup-btn');
    const modal = document.getElementById('signupModal');
    const closeBtn = document.querySelector('.close');

    // Open modal on button click
    signupBtn.addEventListener('click', function () {
        modal.style.display = 'flex';
    });

    // Close modal when the close button is clicked
    closeBtn.addEventListener('click', function () {
        modal.style.display = 'none';
    });

    // Close modal when clicking outside of the modal content
    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});


document
    .getElementById('togglePassword')
    .addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const type =
            passwordField.getAttribute('type') === 'password'
                ? 'text'
                : 'password';
        passwordField.setAttribute('type', type);

        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

document
    .getElementById('togglePasswordConfirmation')
    .addEventListener('click', function () {
        const confirmPasswordField = document.getElementById(
            'password_confirmation'
        );
        const type =
            confirmPasswordField.getAttribute('type') === 'password'
                ? 'text'
                : 'password';
        confirmPasswordField.setAttribute('type', type);

        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

document.addEventListener('DOMContentLoaded', function () {
    const createAccountButton = document.getElementById('create-btn');
    const verifyOtpButton = document.getElementById('verifyOtpButton');
    const resendOtpButton = document.getElementById('resendOtpButton'); // Resend OTP Button
    const otpSection = document.querySelector('.otp-section');
    const signUpForm = document.getElementsByClassName('signup-form')[0];
    const signUpHeader = document.querySelector('h1');
    const backButton = document.getElementById('back-btn');

    // Attach click event to the Create Account button
    createAccountButton.addEventListener('click', function (event) {
        event.preventDefault();

        const agreeTermsCheckbox = document.getElementById('agreeTerms');
        if (!agreeTermsCheckbox.checked) {
            Swal.fire({
                icon: 'warning',
                title: 'Agreement Required',
                text: 'You must agree to the user agreement before proceeding.',
                confirmButtonText: 'OK'
            });
            return; 
        }

        const formData = new FormData(signUpForm);

        Swal.fire({
            title: 'Sending OTP...',
            text: 'Please wait while we send the OTP to your email.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch('/signup', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content')
            }
        })
            .then((response) => {
                if (!response.ok) {
                    return response.json().then((err) => {
                        throw err;
                    });
                }
                return response.json();
            })
            .then((data) => {
                Swal.close();
                if (data.success) {
                    otpSection.style.display = 'block';
                    signUpForm.style.display = 'none';
                    signUpHeader.style.display = 'none';
                    Swal.fire({
                        icon: 'success',
                        title: 'OTP Sent',
                        text: data.message
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        html: data.errors.join('<br>') // Display validation errors
                    });
                }
            })
            .catch((error) => {
                Swal.close();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    html: error.errors
                        ? error.errors.join('<br>')
                        : 'An unexpected error occurred.'
                });
            });
    });

    // Attach click event to the Verify OTP button
    verifyOtpButton.addEventListener('click', function (event) {
        event.preventDefault();

        const otpInputs = document.querySelectorAll('.otpInput');
        let otp = '';
        otpInputs.forEach((input) => {
            otp += input.value;
        });

        if (otp.length !== 6) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please enter a 6-digit OTP.'
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

        fetch('/account-verify-otp', {
            method: 'POST',
            body: JSON.stringify({ otp: otp }),
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content')
            }
        })
            .then((response) => {
                if (!response.ok) {
                    return response.json().then((err) => {
                        throw err;
                    });
                }
                return response.json();
            })
            .then((data) => {
                Swal.close();
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.message,
                        confirmButtonText: 'OK' // Custom text for the button
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/login'; // Redirect after clicking "OK"
                        }
                    });
                }
                 else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        html: data.errors.join('<br>') // Display precise OTP verification errors
                    });
                }
            })
            .catch((error) => {
                Swal.close();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    html: error.errors
                        ? error.errors.join('<br>')
                        : 'An unexpected error occurred.'
                });
            });
    });

    // Attach click event to the Resend OTP button
    resendOtpButton.addEventListener('click', function (event) {
        event.preventDefault();

        Swal.fire({
            title: 'Resending OTP...',
            text: 'Please wait while we resend the OTP.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Send a POST request to resend the OTP
        fetch('/account-resend-otp', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content')
            }
        })
            .then((response) => response.json())
            .then((data) => {
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
                        html: data.errors.join('<br>')
                    });
                }
            })
            .catch((error) => {
                Swal.close();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An unexpected error occurred.'
                });
            });
    });

    // Attach click event to the Back button
    backButton.addEventListener('click', function (event) {
        event.preventDefault();

        otpSection.style.display = 'none';
        signUpForm.style.display = 'flex';
        signUpHeader.style.display = 'block'; // Show the <h1> tag
    });
});

// Existing OTP input navigation logic (unchanged)
document.addEventListener('DOMContentLoaded', function () {
    const otpInputs = document.querySelectorAll('.otpInput');

    otpInputs.forEach((input, index) => {
        input.addEventListener('input', function () {
            if (input.value.length === 1 && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
            }
        });

        input.addEventListener('keydown', function (event) {
            if (event.key === 'Backspace' && input.value === '' && index > 0) {
                otpInputs[index - 1].focus();
            }
        });
    });
});
