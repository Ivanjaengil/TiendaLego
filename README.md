# TiendaLego 🧱

TiendaLego es una aplicación web desarrollada en **Laravel** que simula una tienda en línea dedicada a productos LEGO.  
El sistema permite la gestión de productos, usuarios, carritos de compra y pedidos, ofreciendo una experiencia de compra sencilla y moderna.  

---

## 🚀 Tecnologías utilizadas

- **PHP 8+**  
- **Laravel** (Framework principal)  
- **MySQL** (Base de datos)  
- **Composer** (Gestor de dependencias de PHP)  
- **Node.js & NPM** (para la gestión de assets)  
- **Tailwind CSS** (framework CSS)  
- **Vite** (compilación de assets)  

---

## 📂 Estructura del proyecto

- `app/` → Lógica principal de la aplicación (modelos, controladores, etc.)  
- `bootstrap/` → Archivos de inicio de la aplicación.  
- `config/` → Configuración de Laravel.  
- `database/` → Migraciones y seeds.  
- `public/` → Archivos accesibles públicamente (CSS, JS compilado, imágenes).  
- `resources/` → Vistas (Blade), archivos CSS y JS sin compilar.  
- `routes/` → Rutas de la aplicación (`web.php`, `api.php`).  
- `storage/` → Archivos generados por Laravel (logs, caché, etc.).  
- `tests/` → Pruebas automatizadas.  

---

## ✨ Funcionalidades principales

- **Gestión de productos LEGO**  
  - Alta, baja, modificación y listado de productos.  
  - Categorías de productos (sets, minifiguras, accesorios, etc.).  

- **Gestión de usuarios**  
  - Registro y autenticación.  
  - Perfiles personales.  

- **Carrito de compras**  
  - Añadir productos al carrito.  
  - Modificación de cantidades y eliminación de ítems.  
  - Proceso de compra.  

- **Gestión de pedidos**  
  - Creación, seguimiento y control de pedidos.  

- **Panel de administración**  
  - Control de inventario.  
  - Gestión de usuarios y pedidos.  

- **Interfaz moderna y responsiva** gracias a **Tailwind CSS** y **Vite**.  

---

## 📌 Notas adicionales

- El proyecto está preparado para funcionar tanto en entornos de desarrollo como de producción.  
- Se recomienda configurar correctamente el `.env` con las credenciales de tu servidor.  

---

## 👨‍💻 Autor

Proyecto desarrollado como parte de una práctica académica/profesional.  
