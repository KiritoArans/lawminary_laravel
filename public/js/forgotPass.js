let nextButton = document.getElementById('nextButton');
let submitButton = document.getElementById('sumbitButton');
let backButton1 = document.getElementById('backButton1');
let backButton2 = document.getElementById('backButton2');
let backButton3 = document.getElementById('backButton3');
const forgotPassDiv = document.querySelector('.forgot-pass-content');
const otpDiv = document.querySelector('.verify-otp');
const newPassDiv = document.querySelector('.new-pass');

// When Next is clicked
nextButton.addEventListener('click', function() {
    otpDiv.style.display = 'flex';
    forgotPassDiv.style.display = 'none';
    newPassDiv.style.display = 'none';
});

// When Submit is clicked
submitButton.addEventListener('click', function() {
    otpDiv.style.display = 'none';
    forgotPassDiv.style.display = 'none';
    newPassDiv.style.display = 'flex';
});

// Back button from OTP to Forgot Password
backButton1.addEventListener('click', function() {
    window.location.href = '/login';
});

// Back button from New Password to OTP
backButton2.addEventListener('click', function() {
    forgotPassDiv.style.display = 'flex';
    otpDiv.style.display = 'none';
    newPassDiv.style.display = 'none';
});

// Back button from New Password to OTP
backButton3.addEventListener('click', function() {
    forgotPassDiv.style.display = 'none';
    otpDiv.style.display = 'flex';
    newPassDiv.style.display = 'none';
});
