// ==============================
// Home (JS limpio y modular)
// ==============================
(function () {
    // ---- Utilidades ----
    const $ = window.jQuery;
  
    // CSRF en todas las peticiones AJAX
    $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
    });
  
    // Rutas desde Blade
    function getRoute(name, fallback) {
      return (window.routes && window.routes[name]) ? window.routes[name] : fallback;
    }
  
    // ---- Menú hamburguesa (si tu CSS define .open) ----
    document.addEventListener('DOMContentLoaded', function () {
      const menuIcon = document.querySelector('#menu-icon');
      const navbar = document.querySelector('.navbar');
      if (menuIcon && navbar) {
        menuIcon.addEventListener('click', function () {
          menuIcon.classList.toggle('bx-x');
          navbar.classList.toggle('open');
        });
  
        window.addEventListener('scroll', function () {
          menuIcon.classList.remove('bx-x');
          navbar.classList.remove('open');
        });
      }
    });
  
    // ---- Ocultar header al hacer scroll hacia abajo ----
    (function () {
      let lastScroll = 0;
      const header = document.querySelector('header');
      if (!header) return;
  
      window.addEventListener('scroll', () => {
        const current = window.pageYOffset;
        if (current > lastScroll) header.classList.add('hidden');
        else header.classList.remove('hidden');
        lastScroll = current;
      });
    })();
  
    // ---- Animaciones de entrada (header, título, cards) ----
    document.addEventListener('DOMContentLoaded', function () {
      // Header
      const header = document.querySelector('header');
      if (header) {
        header.style.opacity = '0';
        header.style.transform = 'translateY(-20px)';
        setTimeout(() => {
          header.style.transition = 'all 0.5s ease';
          header.style.opacity = '1';
          header.style.transform = 'translateY(0)';
        }, 100);
      }
  
      // Título principal (h2 de "Sets Exclusivos")
      const mainTitle = document.querySelector('.featured-products h2');
      if (mainTitle) {
        mainTitle.style.opacity = '0';
        mainTitle.style.transform = 'translateY(20px)';
        setTimeout(() => {
          mainTitle.style.transition = 'all 0.5s ease';
          mainTitle.style.opacity = '1';
          mainTitle.style.transform = 'translateY(0)';
        }, 300);
      }
  
      // Tarjetas de productos (entrada en cascada)
      const productCards = document.querySelectorAll('.product-card');
      productCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(40px)';
        setTimeout(() => {
          card.style.transition = 'all 0.5s ease';
          card.style.opacity = '1';
          card.style.transform = 'translateY(0)';
        }, 500 + (index * 200));
      });
  
      // Hover sutil en tarjetas (sin duplicar inline handlers)
      productCards.forEach(card => {
        card.addEventListener('mouseenter', function () { this.style.transform = 'translateY(-5px)'; });
        card.addEventListener('mouseleave', function () { this.style.transform = 'translateY(0)'; });
      });
  
      // ---- Sección Fortnite: aparición al entrar en viewport + hover ----
      const fortniteImg = document.querySelector('.fortnite-img');
      const fortniteTitle = document.querySelector('.fortnite-collaboration h3');
      const collaborationText = document.querySelector('.collaboration-text');
  
      if (fortniteImg) {
        // Preparar estados iniciales
        fortniteImg.style.transition = 'all 0.8s ease';
        fortniteImg.style.opacity = '0';
        fortniteImg.style.transform = 'scale(0.98)';
      }
      if (fortniteTitle) {
        fortniteTitle.style.opacity = '0';
        fortniteTitle.style.transform = 'translateX(-30px)';
        fortniteTitle.style.transition = 'all 0.8s ease';
      }
      if (collaborationText) {
        collaborationText.style.opacity = '0';
        collaborationText.style.transition = 'all 0.8s ease';
      }
  
      const fortniteSection = document.querySelector('.fortnite-collaboration');
      if (fortniteSection) {
        const io = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
            if (!entry.isIntersecting) return;
  
            // Título
            if (fortniteTitle) {
              setTimeout(() => {
                fortniteTitle.style.opacity = '1';
                fortniteTitle.style.transform = 'translateX(0)';
              }, 100);
            }
  
            // Imagen
            if (fortniteImg) {
              setTimeout(() => {
                fortniteImg.style.opacity = '1';
                fortniteImg.style.transform = 'scale(1)';
              }, 300);
            }
  
            // Texto
            if (collaborationText) {
              setTimeout(() => {
                collaborationText.style.opacity = '1';
              }, 500);
            }
  
            io.unobserve(fortniteSection);
          });
        }, { threshold: 0.2 });
  
        io.observe(fortniteSection);
  
        // Hover de la imagen
        if (fortniteImg) {
          fortniteImg.addEventListener('mouseenter', () => {
            fortniteImg.style.transform = 'scale(1.02)';
          });
          fortniteImg.addEventListener('mouseleave', () => {
            fortniteImg.style.transform = 'scale(1)';
          });
        }
      }
    });
  
    // ---- Añadir al carrito ----
    document.addEventListener('DOMContentLoaded', function () {
      $(document).on('click', '.add-to-cart', function (e) {
        e.preventDefault();
  
        const $btn = $(this);
        const producto = {
          id: $btn.data('id'),
          nombre: $btn.data('nombre'),
          precio: $btn.data('precio'),
          imagen: $btn.data('imagen')
        };
  
        $.ajax({
          url: getRoute('carritoAdd', '/carrito/add'),
          method: 'POST',
          data: producto,
          success: function (response) {
            if (response && response.success) {
              $btn.css('backgroundColor', '#cc0000').text('¡Añadido!');
              setTimeout(() => {
                $btn.css('backgroundColor', '#FF0000').text('Añadir al Carrito');
              }, 1000);
            } else {
              alert('No se pudo añadir al carrito.');
            }
          },
          error: function (xhr) {
            console.error('Error al añadir al carrito:', xhr.status, xhr.responseText);
            alert('Error al añadir el producto al carrito');
          }
        });
      });
    });
  
  })();
  