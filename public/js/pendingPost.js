var penPostModal = document.getElementById("pendingModal");

// Get the button that opens the modal
var btn = document.querySelector(".view-pendings");

// Get the close button element
var closeButton = document.getElementsByClassName("pen-post-close")[0];

// Get tab elements
var pendingTab = document.getElementById("pending-posts-tab");
var disregardedTab = document.getElementById("disregarded-posts-tab");

// Get content elements
var pendingContent = document.getElementById("pending-posts");
var disregardedContent = document.getElementById("disregarded-posts");

// When the user clicks the button, open the modal
btn.onclick = function() {
    penPostModal.style.display = "flex";
}

// When the user clicks the close button, close the modal
closeButton.onclick = function() {
    penPostModal.style.display = "none";
}

// When the user clicks anywhere outside the modal, close it
window.onclick = function(event) {
    if (event.target == penPostModal) {
        penPostModal.style.display = "none";
    }
}

// Tab switching logic
pendingTab.onclick = function() {
    pendingTab.classList.add("active");
    disregardedTab.classList.remove("active");

    pendingContent.style.display = "block";
    disregardedContent.style.display = "none";
}

disregardedTab.onclick = function() {
    disregardedTab.classList.add("active");
    pendingTab.classList.remove("active");

    pendingContent.style.display = "none";
    disregardedContent.style.display = "block";
}


// Function to update status colors based on post status
function updateStatusColors() {
    // Get all elements with class 'status-text'
    var statusElements = document.querySelectorAll('.status-text');

    // Loop through each element and check its data-status attribute
    statusElements.forEach(function(element) {
        var status = element.getAttribute('data-status');

        // Apply the color based on the status
        if (status === 'Pending') {
            element.style.color = 'green';  // Green for pending
        } else if (status === 'Disregarded') {
            element.style.color = 'red';    // Red for disregarded
        }
    });
}

// Run the function on page load
document.addEventListener('DOMContentLoaded', function() {
    updateStatusColors();
});
