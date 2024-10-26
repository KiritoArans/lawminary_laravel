document.addEventListener('DOMContentLoaded', function() {
    const menuIcon = document.querySelector('.header-top .fa-bars');
    const asideMenu = document.querySelector('aside');

    function handleMenu() {
        if (window.innerWidth <= 1024) {
            // Show aside menu on menu icon click
            menuIcon.addEventListener('click', function(event) {
                event.stopPropagation(); // Prevents the event from bubbling to the document
                asideMenu.style.display = 'block';
            });

            // Hide aside menu when clicking outside, only if screen width is <= 1024
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 1024 && !asideMenu.contains(event.target) && !menuIcon.contains(event.target)) {
                    asideMenu.style.display = 'none'; // Hides the aside menu if clicked outside
                }
            });
        } else {
            // Show aside menu when the screen is > 1024px
            asideMenu.style.display = 'block';
        }
    }

    handleMenu();

    window.addEventListener('resize', function() {
        if (window.innerWidth > 1024) {
            asideMenu.style.display = 'block'; // Ensure aside menu is visible when width > 1024px
        } else {
            asideMenu.style.display = 'none'; // Hide aside menu for <= 1024px initially
            handleMenu(); // Re-apply the menu handling for <= 1024px
        }
    });
});
