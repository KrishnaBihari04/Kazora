const menuBtn = document.querySelector('.menu-btn');
const mobileMenu = document.getElementById('mobileMenu');

if (menuBtn) {
  menuBtn.addEventListener('click', () => {
    menuBtn.classList.toggle('active');
  });

  mobileMenu.addEventListener('shown.bs.offcanvas', () => {
    const items = document.querySelectorAll('.menu-item');
    items.forEach((item, index) => {
      setTimeout(() => {
        item.style.transform = 'translateX(0)';
        item.style.opacity = '1';
      }, index * 100);
    });
  });

  mobileMenu.addEventListener('hidden.bs.offcanvas', () => {
    menuBtn.classList.remove('active');
    const items = document.querySelectorAll('.menu-item');
    items.forEach(item => {
      item.style.transform = 'translateX(-100px)';
      item.style.opacity = '0';
    });
  });
}
