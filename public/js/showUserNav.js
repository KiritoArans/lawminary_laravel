document.addEventListener('DOMContentLoaded', function() {
    const menuIcon = document.querySelector('.header-top .fa-bars');
    const asideMenu = document.querySelector('aside');

    // Function to toggle the display of the aside menu
    menuIcon.addEventListener('click', function(event) {
        event.stopPropagation(); // Prevents the event from bubbling to the document
        asideMenu.style.display = 'block';
    });

    // Function to hide aside menu when clicking outside
    document.addEventListener('click', function(event) {
        if (!asideMenu.contains(event.target) && !menuIcon.contains(event.target)) {
            asideMenu.style.display = 'none'; // Hides the aside menu if clicked outside
        }
    });
});