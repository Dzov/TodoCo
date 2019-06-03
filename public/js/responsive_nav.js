function handleNavbarResponsive () {
    if (window.innerWidth > 767) {
        let navListContainer = document.querySelector('.nav-list-container');
        navListContainer.classList.remove('collapse');
    }
}

window.addEventListener('resize', handleNavbarResponsive);
