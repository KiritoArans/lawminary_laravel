document.addEventListener('DOMContentLoaded', function () {
    // Get the modal and related elements
    var reportModal = document.getElementById('reportModal');
    var closeBtn = document.getElementsByClassName('report-close')[0];
    var submitButton = document.getElementById('submitReport');
    
    // Radio buttons and "Others" textarea
    var radioButtons = document.getElementsByName('reportReason');
    var otherReasonTextarea = document.getElementById('otherReason');
    var otherReasonDiv = document.getElementById('otherReasonDiv');

    // Variable to store post_id dynamically
    var postId = null;

    // Function to open the modal and set post_id
    function openReportModal(event) {
        event.preventDefault();
        postId = this.getAttribute('data-post-id'); // Get post_id from the clicked link
        reportModal.style.display = 'flex'; // Show the modal
    }

    // Function to close the modal
    function closeReportModal() {
        reportModal.style.display = 'none'; // Hide the modal
    }

    // Function to handle clicks outside of the modal
    function clickOutsideModal(event) {
        if (event.target === reportModal) {
            closeReportModal();
        }
    }

    // Attach event listeners to all report links dynamically
    var reportLinks = document.querySelectorAll('.options a[data-post-id]');
    reportLinks.forEach(function (link) {
        link.addEventListener('click', openReportModal); // Bind the click event to each report link
    });

    // Event listener to show textarea when "Others" is selected
    radioButtons.forEach(function (radio) {
        radio.addEventListener('change', function () {
            if (this.value === 'Others') {
                otherReasonDiv.style.display = 'block'; // Show textarea
            } else {
                otherReasonDiv.style.display = 'none'; // Hide textarea
                otherReasonTextarea.value = ''; // Clear textarea
            }
        });
    });

    // Function to submit the report
    function submitReport() {
        var selectedReason = '';
        var otherReason = otherReasonTextarea.value.trim();
        
        // Check which radio button is selected
        for (var i = 0; i < radioButtons.length; i++) {
            if (radioButtons[i].checked) {
                selectedReason = radioButtons[i].value;
                break;
            }
        }

        // If "Others" is selected, use the text from the textarea
        if (selectedReason === 'Others' && otherReason !== '') {
            selectedReason = otherReason;
        }

        if (selectedReason === '' || (selectedReason === 'Others' && otherReason === '')) {
            Swal.fire('Error', 'Please select a reason or specify the reason.', 'error');
            return;
        }

        if (!postId) {
            Swal.fire('Error', 'No post ID found.', 'error');
            return;
        }

        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Get CSRF token

        fetch('/report', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token, 
            },
            body: JSON.stringify({
                post_id: postId,
                reportContent: selectedReason
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Report submitted successfully') {
                Swal.fire('Success', 'Your report has been submitted.', 'success');
                closeReportModal(); 
            } else {
                Swal.fire('Error', 'There was an error submitting your report.', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error', 'An error occurred while submitting your report.', 'error');
        });
    }

    submitButton.onclick = submitReport;
});
