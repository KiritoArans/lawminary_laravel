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
                        text: data.message
                    }).then(() => {
                        window.location.href = '/login';
                    });
                } else {
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
        fetch('/resend-otp', {
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

//nationalities
document.addEventListener('DOMContentLoaded', function () {
    // Fetch the nationalities from the JSON file
    fetch('/nationalities.json') // Adjust the path if necessary
        .then((response) => response.json())
        .then((data) => {
            const nationalitySelect = document.getElementById('nationality');
            data.forEach((nationality) => {
                const option = document.createElement('option');
                option.value = nationality.name;
                option.text = nationality.name;
                nationalitySelect.appendChild(option);
            });
        })
        .catch((error) => console.error('Error loading nationalities:', error));
});

//contact number

document
    .getElementById('contactNumber')
    .addEventListener('input', function (e) {
        // Replace any non-digit characters
        this.value = this.value.replace(/\D/g, '');
    });
