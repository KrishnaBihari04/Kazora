// Hamburger menu animation
const menuBtn = document.querySelector('.menu-btn');
const mobileMenu = document.getElementById('mobileMenu');

// Animate menu items when opening
mobileMenu.addEventListener('shown.bs.offcanvas', () => {
    const items = document.querySelectorAll('.menu-item');
    items.forEach((item, index) => {
        setTimeout(() => {
            item.style.transform = 'translateX(0)';
            item.style.opacity = '1';
        }, index * 100);
    });
});

// Reset animations when closing
mobileMenu.addEventListener('hidden.bs.offcanvas', () => {
    const items = document.querySelectorAll('.menu-item');
    items.forEach(item => {
        item.style.transform = 'translateX(-100px)';
        item.style.opacity = '0';
    });
});