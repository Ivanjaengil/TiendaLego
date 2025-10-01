// ==============================
// PiezasLego (JS limpio y modular)
// ==============================
(function () {
    const $ = window.jQuery;
  
    // CSRF en todas las peticiones AJAX
    $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
    });
  
    // Helper rutas
    function getRoute(name, fallback) {
      return (window.routes && window.routes[name]) ? window.routes[name] : fallback;
    }
  
    // =========================
    // Menú hamburguesa
    // =========================
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
  
    // =========================
    // Animaciones de entrada
    // =========================
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
  
      // Título catálogo
      const title = document.querySelector('.catalog-title');
      if (title) {
        title.style.opacity = '0';
        title.style.transform = 'translateY(20px)';
        setTimeout(() => {
          title.style.transition = 'all 0.5s ease';
          title.style.opacity = '1';
          title.style.transform = 'translateY(0)';
        }, 300);
      }
  
      // Tarjetas en cascada + observer (aparecer al hacer scroll)
      const cards = document.querySelectorAll('.product-card');
      const io = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (!entry.isIntersecting) return;
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
          io.unobserve(entry.target);
        });
      }, { threshold: 0.1 });
  
      cards.forEach((card, idx) => {
        // estado inicial
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.5s ease-in-out';
  
        // pequeña cascada inicial
        setTimeout(() => io.observe(card), 300 + (idx * 100));
  
        // hover sutil
        card.addEventListener('mouseenter', function () {
          this.style.transform = 'translateY(-5px)';
        });
        card.addEventListener('mouseleave', function () {
          this.style.transform = 'translateY(0)';
        });
      });
    });
  
    // =========================
    // Añadir al carrito (AJAX)
    // =========================
    document.addEventListener('DOMContentLoaded', function () {
      $(document).on('click', '.add-to-cart', function (e) {
        e.preventDefault();
  
        const $btn = $(this);
        const id = $btn.data('id');
  
        $.ajax({
          url: getRoute('carritoAdd', '/carrito/add'),
          method: 'POST',
          data: { id: id },
          success: function (response) {
            if (response && response.success) {
              // feedback visual
              $btn.css('backgroundColor', '#28a745').text('¡Añadido!');
              setTimeout(() => {
                $btn.css('backgroundColor', '#FF0000').text('Añadir al Carrito');
              }, 1200);
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
  
    // =========================
    // Filtros: búsqueda y ordenación
    // =========================
    document.addEventListener('DOMContentLoaded', function () {
      const searchInput = document.getElementById('searchInput');
      const sortSelect = document.getElementById('sortSelect');
      const grid = document.getElementById('productsGrid');
  
      if (!grid) return;
  
      const getCards = () => Array.from(grid.querySelectorAll('.product-card'));
  
      function applySearch() {
        const term = (searchInput?.value || '').trim().toLowerCase();
        getCards().forEach(card => {
          const name = (card.querySelector('.product-name')?.textContent || '').toLowerCase();
          card.style.display = name.includes(term) ? '' : 'none';
        });
      }
  
      function applySort() {
        const value = sortSelect?.value || 'name';
        const cards = getCards().filter(c => c.style.display !== 'none'); // solo visibles
  
        let sorted = [];
        if (value === 'name') {
          sorted = cards.sort((a, b) => {
            const na = (a.querySelector('.product-name')?.textContent || '').toLowerCase();
            const nb = (b.querySelector('.product-name')?.textContent || '').toLowerCase();
            return na.localeCompare(nb);
          });
        } else if (value === 'price-asc' || value === 'price-desc') {
          sorted = cards.sort((a, b) => {
            const pa = parseFloat(a.getAttribute('data-price') || '0');
            const pb = parseFloat(b.getAttribute('data-price') || '0');
            return value === 'price-asc' ? pa - pb : pb - pa;
          });
        }
  
        // reordenar en el DOM
        sorted.forEach(card => grid.appendChild(card));
      }
  
      if (searchInput) searchInput.addEventListener('input', () => { applySearch(); applySort(); });
      if (sortSelect) sortSelect.addEventListener('change', applySort);
  
      // primera pasada
      applySearch();
      applySort();
    });
  
  })();
  