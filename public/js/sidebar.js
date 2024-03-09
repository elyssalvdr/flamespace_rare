document.addEventListener("DOMContentLoaded", function (event) {
    const showNavbar = (toggleId, navId, bodyId, headerId) => {
        const toggle = document.getElementById(toggleId),
            nav = document.getElementById(navId),
            bodypd = document.getElementById(bodyId),
            headerpd = document.getElementById(headerId);

        // Validate that all variables exist
        if (toggle && nav && bodypd && headerpd) {
            toggle.addEventListener('click', () => {
                // show navbar
                nav.classList.toggle('show');
                // change icon
                toggle.classList.toggle('bx-x');
                // add padding to body
                bodypd.classList.toggle('body-pd');
                // add padding to header
                headerpd.classList.toggle('body-pd');
            });
        }
    };

    showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header');

    // Get all navigation links
    const navLinks = document.querySelectorAll('.nav_link');

    // Function to remove 'active' class from all navigation links
    function removeActiveClass() {
        navLinks.forEach(link => {
            link.classList.remove('active');
        });
    }

    // Function to add 'active' class to the clicked link
    function setActiveClass(link) {
        link.classList.add('active');
    }

    // Attach click event listener to each navigation link
    navLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            // Remove 'active' class from all navigation links
            removeActiveClass();
            // Add 'active' class to the clicked link
            setActiveClass(this);
        });
    });
});




$.getScript("https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js", function () {
    $.getScript("https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js", function () {
    });
});