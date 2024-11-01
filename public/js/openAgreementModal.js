var agreementModal = document.getElementById("agreementModal");
var span = document.getElementById("closeAgreementModal");

    document.getElementById("openAgreementModal").onclick = function(event) {
        event.preventDefault(); // Prevent default anchor behavior
        agreementModal.style.display = "flex"; // Show the modal
    }

    span.onclick = function() {
        agreementModal.style.display = "none"; // Hide the modal
    }
    window.onclick = function(event) {
        if (event.target == agreementModal) {
            agreementModal.style.display = "none"; // Hide the modal
        }
}