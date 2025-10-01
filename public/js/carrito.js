// ==============================
// Carrito de Compras (externo)
// ==============================
$(function () {

    // ---------------------------------
    // Configuración CSRF para TODAS las peticiones AJAX
    // ---------------------------------
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  
    // Util para obtener rutas desde window.routes con fallback
    function getRoute(name, fallback) {
      return (window.routes && window.routes[name]) ? window.routes[name] : fallback;
    }
  
    // ------------------------------
    // Función: actualizar cantidad
    // ------------------------------
    function updateQuantity($cartItem) {
      var id = $cartItem.data('id');
      var cantidad = $cartItem.find('.quantity-input').val();
  
      $.ajax({
        url: getRoute('carritoUpdate', '/carrito/update'),
        method: 'PATCH',
        data: {
          id: id,
          cantidad: cantidad
        },
        success: function (response) {
          var precioUnitario = parseFloat(
            $cartItem.find('.precio-unitario')
              .text()
              .replace('Precio unitario: ', '')
              .replace('€', '')
          );
  
          var subtotal = precioUnitario * cantidad;
  
          $cartItem.find('.subtotal')
            .text('Subtotal: ' + subtotal.toFixed(2) + '€');
  
          $('#cart-total').text(response.total);
        },
        error: function (xhr) {
          console.error('Error al actualizar cantidad:', xhr.status, xhr.responseText);
        }
      });
    }
  
    // ------------------------------
    // Eventos + y -
    // ------------------------------
    $(document).on('click', '.increase-quantity', function (e) {
      e.preventDefault();
      var $input = $(this).siblings('.quantity-input');
      $input.val(parseInt($input.val()) + 1);
      updateQuantity($(this).closest('.cart-item'));
    });
  
    $(document).on('click', '.decrease-quantity', function (e) {
      e.preventDefault();
      var $input = $(this).siblings('.quantity-input');
      if (parseInt($input.val()) > 1) {
        $input.val(parseInt($input.val()) - 1);
        updateQuantity($(this).closest('.cart-item'));
      }
    });
  
    // Cambio manual en input
    $(document).on('change', '.quantity-input', function () {
      updateQuantity($(this).closest('.cart-item'));
    });
  
    // ------------------------------
    // Eliminar producto
    // ------------------------------
    $(document).on('click', '.remove-item', function (e) {
      e.preventDefault();
  
      var $cartItem = $(this).closest('.cart-item');
      var id = $cartItem.data('id');
  
      $.ajax({
        url: getRoute('carritoRemove', '/carrito/remove'),
        type: 'POST',
        data: {
          _method: 'DELETE',
          id: id
        },
        success: function (response) {
          $cartItem.fadeOut(300, function () { $(this).remove(); });
          $('#cart-total').text(response.total);
  
          if (response.is_empty) {
            $('.cart-summary').hide();
            $('.cart-items').html(
              '<div class="empty-cart" style="text-align:center; padding:20px;">' +
                '<p>Tu carrito está vacío</p>' +
                '<a href="' + getRoute('piezaslegoIndex', '/piezaslego') + '" class="continue-shopping">Continuar Comprando</a>' +
              '</div>'
            );
          }
        },
        error: function (xhr) {
          console.error('Error al eliminar producto:', xhr.status, xhr.responseText);
          alert('No se pudo eliminar el producto. Reintenta.');
        }
      });
    });
  
    // ------------------------------
    // Animaciones al cargar (igual que PiezasLego)
    // ------------------------------
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
  
    const cartTitle = document.querySelector('.cart-title');
    if (cartTitle) {
      cartTitle.style.opacity = '0';
      cartTitle.style.transform = 'translateY(20px)';
      setTimeout(() => {
        cartTitle.style.transition = 'all 0.5s ease';
        cartTitle.style.opacity = '1';
        cartTitle.style.transform = 'translateY(0)';
      }, 300);
    }
  
    const cartItems = document.querySelectorAll('.cart-item');
    cartItems.forEach((item, index) => {
      item.style.opacity = '0';
      item.style.transform = 'translateY(40px)';
      setTimeout(() => {
        item.style.transition = 'all 0.5s ease';
        item.style.opacity = '1';
        item.style.transform = 'translateY(0)';
      }, 500 + (index * 200));
    });
  
    const cartSummary = document.querySelector('.cart-summary');
    if (cartSummary) {
      cartSummary.style.opacity = '0';
      cartSummary.style.transform = 'translateY(30px)';
      setTimeout(() => {
        cartSummary.style.transition = 'all 0.5s ease';
        cartSummary.style.opacity = '1';
        cartSummary.style.transform = 'translateY(0)';
      }, 700 + (cartItems.length * 200));
    }
  });
  