document.addEventListener('DOMContentLoaded', function() {
    // Manejar los botones de + y -
    const decreaseButtons = document.querySelectorAll('.decrease-quantity');
    const increaseButtons = document.querySelectorAll('.increase-quantity');
    
    decreaseButtons.forEach(button => {
        button.addEventListener('click', function() {
            const input = this.parentElement.querySelector('.quantity-input');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
                updateCartItem(input);
            }
        });
    });

    increaseButtons.forEach(button => {
        button.addEventListener('click', function() {
            const input = this.parentElement.querySelector('.quantity-input');
            input.value = parseInt(input.value) + 1;
            updateCartItem(input);
        });
    });

    // Manejar cambios directos en el input
    const quantityInputs = document.querySelectorAll('.quantity-input');
    quantityInputs.forEach(input => {
        input.addEventListener('change', function() {
            if (parseInt(this.value) < 1) {
                this.value = 1;
            }
            updateCartItem(this);
        });
    });

    function updateCartItem(input) {
        const cartItem = input.closest('.cart-item');
        const id = cartItem.dataset.id;
        const cantidad = input.value;

        fetch('/carrito/update', {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                id: id,
                cantidad: cantidad
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Actualizar el subtotal del item
                cartItem.querySelector('.subtotal').textContent = 
                    `Subtotal: ${data.subtotal}€`;
                
                // Actualizar el total del carrito
                document.getElementById('cart-total').textContent = 
                    `${data.total}€`;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al actualizar el carrito');
        });
    }
}); 