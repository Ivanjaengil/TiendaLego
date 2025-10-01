// Menu hamburguesa
(function () {
    const menuIcon = document.querySelector('#menu-icon');
    const navbar = document.querySelector('.navbar');
    if (menuIcon && navbar) {
      menuIcon.addEventListener('click', () => {
        menuIcon.classList.toggle('bx-x');
        navbar.classList.toggle('open');
      });
      window.addEventListener('scroll', () => {
        menuIcon.classList.remove('bx-x');
        navbar.classList.remove('open');
      });
    }
  })();
  
  // Animaciones de entrada
  document.addEventListener('DOMContentLoaded', function () {
    // Form groups (fade + slide)
    const groups = document.querySelectorAll('.form-group');
    groups.forEach((g, idx) => {
      g.style.opacity = '0';
      g.style.transform = 'translateY(20px)';
      setTimeout(() => {
        g.style.transition = 'all 0.5s ease';
        g.style.opacity = '1';
        g.style.transform = 'translateY(0)';
      }, idx * 160);
    });
  
    // Info items (slide X)
    const info = document.querySelectorAll('.info-item');
    info.forEach((it, idx) => {
      it.style.opacity = '0';
      it.style.transform = 'translateX(20px)';
      setTimeout(() => {
        it.style.transition = 'all 0.5s ease';
        it.style.opacity = '1';
        it.style.transform = 'translateX(0)';
      }, 260 + idx * 180);
    });
  });
  