// let nextButton = document.getElementById('nextButton');
// let submitButton = document.getElementById('sumbitButton');
// let backButton1 = document.getElementById('backButton1');
// let backButton2 = document.getElementById('backButton2');
// let backButton3 = document.getElementById('backButton3');
// const forgotPassDiv = document.querySelector('.forgot-pass-content');
// const otpDiv = document.querySelector('.verify-otp');
// const newPassDiv = document.querySelector('.new-pass');

// // When Next is clicked
// nextButton.addEventListener('click', function() {
//     otpDiv.style.display = 'flex';
//     forgotPassDiv.style.display = 'none';
//     newPassDiv.style.display = 'none';
// });

// // When Submit is clicked
// submitButton.addEventListener('click', function() {
//     otpDiv.style.display = 'none';
//     forgotPassDiv.style.display = 'none';
//     newPassDiv.style.display = 'flex';
// });

// // Back button from OTP to Forgot Password
// backButton1.addEventListener('click', function() {
//     window.location.href = '/login';
// });

// // Back button from New Password to OTP
// backButton2.addEventListener('click', function() {
//     forgotPassDiv.style.display = 'flex';
//     otpDiv.style.display = 'none';
//     newPassDiv.style.display = 'none';
// });

// // Back button from New Password to OTP
// backButton3.addEventListener('click', function() {
//     forgotPassDiv.style.display = 'none';
//     otpDiv.style.display = 'flex';
//     newPassDiv.style.display = 'none';
// });





let nextButton = document.getElementById('nextButton');
let submitOtpButton = document.getElementById('submitOtpButton');
let backButton1 = document.getElementById('backButton1');
let backButton2 = document.getElementById('backButton2');
let backButton3 = document.getElementById('backButton3');
const forgotPassDiv = document.querySelector('.forgot-pass-content');
const otpDiv = document.querySelector('.verify-otp');
const newPassDiv = document.querySelector('.new-pass');

// CSRF token for AJAX requests
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Prevent form submission
document.getElementById('forgotPassForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const username = document.getElementById('usernameInput').value;
    const email = document.getElementById('emailInput').value;

    // Validate username and email
    if (!username || !email) {
        alert('Please fill in both username and email.');
        return;
    }

    // AJAX call to validate username and email, then send OTP
    fetch('/validate-user', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ username, email })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Move to the OTP section
            otpDiv.style.display = 'flex';
            forgotPassDiv.style.display = 'none';
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
});

// OTP submission
document.getElementById('otpForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const otp = document.getElementById('otpInput').value;

    if (!otp) {
        alert('Please enter the OTP.');
        return;
    }

    // AJAX call to verify OTP
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
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Move to the new password section
            otpDiv.style.display = 'none';
            newPassDiv.style.display = 'flex';
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
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
