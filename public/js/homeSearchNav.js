document.addEventListener('DOMContentLoaded', function () {
    // Get the navigation tabs
    var allTab = document.getElementById('all-tab');
    var userTab = document.getElementById('user-tab');
    var lawyerTab = document.getElementById('lawyer-tab');
    var postTab = document.getElementById('post-tab');

    // Get the content sections
    var userSection = document.getElementById('user-section');
    var lawyerSection = document.getElementById('lawyer-section');
    var postSection = document.getElementById('post-section');

    // Function to show all sections
    function showAll() {
        allTab.classList.add('active');
        userTab.classList.remove('active');
        lawyerTab.classList.remove('active');
        postTab.classList.remove('active');

        userSection.style.display = 'block';
        lawyerSection.style.display = 'block';
        postSection.style.display = 'block';
    }

    // Function to show only the users section
    function showUsers() {
        allTab.classList.remove('active');
        userTab.classList.add('active');
        lawyerTab.classList.remove('active');
        postTab.classList.remove('active');

        userSection.style.display = 'block';
        lawyerSection.style.display = 'none';
        postSection.style.display = 'none';
    }

    function showLawyers() {
        allTab.classList.remove('active');
        userTab.classList.remove('active');
        lawyerTab.classList.add('active');
        postTab.classList.remove('active');

        userSection.style.display = 'none';
        lawyerSection.style.display = 'block';
        postSection.style.display = 'none';
    }

    // Function to show only the posts section
    function showPosts() {
        allTab.classList.remove('active');
        userTab.classList.remove('active');
        lawyerTab.classList.remove('active');
        postTab.classList.add('active');

        userSection.style.display = 'none';
        lawyerSection.style.display = 'none';
        postSection.style.display = 'block';
    }

    // Event listeners for tab switching
    allTab.onclick = function() {
        showAll();
    };

    userTab.onclick = function() {
        showUsers();
    };

    lawyerTab.onclick = function() {
        showLawyers();
    };

    postTab.onclick = function() {
        showPosts();
    };

    // By default, show all sections
    showAll();
});
