document.addEventListener('DOMContentLoaded', function() {
    const menuIcon = document.querySelector('.header-top .fa-bars');
    const asideMenu = document.querySelector('aside');

    // Function to handle the menu click and outside click events
    function handleMenu() {
        if (window.innerWidth < 1024) {
            // Show aside menu on menu icon click
            menuIcon.addEventListener('click', function(event) {
                event.stopPropagation(); // Prevents the event from bubbling to the document
                asideMenu.style.display = 'block';
            });

            // Hide aside menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!asideMenu.contains(event.target) && !menuIcon.contains(event.target)) {
                    asideMenu.style.display = 'none'; // Hides the aside menu if clicked outside
                }
            });
        }
    }

    // Initialize the menu handling
    handleMenu();

    // Also handle resizing of the window
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) {
            asideMenu.style.display = 'none'; // Ensure aside menu is hidden when width >= 1024px
        } else {
            handleMenu(); // Re-apply the menu handling for < 1024px
        }
    });
});
