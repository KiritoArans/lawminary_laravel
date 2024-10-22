document.addEventListener("DOMContentLoaded", function() {
    const badgeElement = document.getElementById("notification-count");

    if (notificationCount > 0) {
        badgeElement.textContent = notificationCount; // Show number of notifications
        badgeElement.classList.add("has-notifications"); // Display the badge
    }
});
