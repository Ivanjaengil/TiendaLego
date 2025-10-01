let menu = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');

menu.onclick = () => {
    menu.classList.toggle('bx-x');
    navbar.classList.toggle('open');
}

window.onscroll = () => {
    menu.classList.remove('bx-x');
    navbar.classList.remove('open');
}

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const sortSelect = document.getElementById('sortSelect');
    const productsGrid = document.querySelector('.products-grid');
    const products = document.querySelectorAll('.product-card');

    // Función de búsqueda
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        products.forEach(product => {
            const title = product.querySelector('h3').textContent.toLowerCase();
            const description = product.querySelector('p').textContent.toLowerCase();
            
            if (title.includes(searchTerm) || description.includes(searchTerm)) {
                product.style.display = 'block';
                product.style.animation = 'fadeIn 0.5s ease';
            } else {
                product.style.display = 'none';
            }
        });
    });

    // Función de ordenamiento
    sortSelect.addEventListener('change', function() {
        const sortValue = this.value;
        const productsArray = Array.from(products);

        productsArray.sort((a, b) => {
            if (sortValue === 'name') {
                const nameA = a.querySelector('h3').textContent;
                const nameB = b.querySelector('h3').textContent;
                return nameA.localeCompare(nameB);
            } else {
                const priceA = parseFloat(a.dataset.price);
                const priceB = parseFloat(b.dataset.price);
                return sortValue === 'price-asc' ? priceA - priceB : priceB - priceA;
            }
        });

        productsGrid.innerHTML = '';
        productsArray.forEach(product => {
            productsGrid.appendChild(product);
            product.style.animation = 'slideIn 0.3s ease';
        });
    });

    // Animación para añadir al carrito
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function() {
            this.classList.add('clicked');
            setTimeout(() => {
                this.classList.remove('clicked');
            }, 200);
            
            // Aquí puedes agregar la lógica para añadir al carrito
            const productId = this.dataset.id;
            console.log(`Producto ${productId} añadido al carrito`);
        });
    });
});

// Animaciones CSS
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideIn {
        from { 
            transform: translateY(20px);
            opacity: 0;
        }
        to { 
            transform: translateY(0);
            opacity: 1;
        }
    }

    .clicked {
        transform: scale(0.95);
    }
`;
document.head.appendChild(style); 