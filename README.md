# Tuerca Dorada

**Tuerca Dorada** es un sistema de ecommerce desarrollado para la compra y venta de artículos de ferretería. Este proyecto es una **modificación** del proyecto original [Ituti](https://github.com/davidf110102/ITutiShop), adaptado y extendido para cubrir los requisitos de un negocio ferretero.

---

## 📌 Basado en Ituti
Este proyecto se basa en el sistema **Ituti**, un proyecto previamente desarrollado como punto de partida. Las modificaciones incluyen:
- Adaptación del diseño y funcionalidades para un negocio ferretero.
- Añadido de características específicas, como gestión de descuentos y reportes de inventario.
- Personalización de la base de datos y flujo de compras.

Puedes encontrar el repositorio original de Ituti aquí: [Ituti en Git](https://github.com/davidf110102/ITutiShop).

---

## 🚀 Características

### Para Administradores
- **Gestión de Productos**: Crear, editar, eliminar y actualizar detalles de productos (nombre, descripción, categoría, inventario, etc.).
- **Gestión de Precios y Descuentos**: Modificar precios y aplicar descuentos a productos o categorías específicas.
- **Consulta y Filtrado**: Buscar productos por nombre, categoría, precio y disponibilidad.
- **Reportes**: Generar reportes sobre inventarios, ventas y descuentos.
- **Seguridad**: Inicio de sesión con credenciales seguras y recuperación de contraseña por correo electrónico.

### Para Clientes
- **Compra de Productos**: Navegar por el catálogo, agregar productos al carrito y realizar compras.
- **Historial de Compras**: Consultar compras previas desde su perfil.
- **Pagos Seguros**: Integración con PayPal y Mercado Pago para procesar pagos.
- **Notificaciones**: Recibir detalles de las compras vía correo electrónico.

---

## 🛠️ Tecnologías Utilizadas

### Backend
- **PHP 8.2.12**: Lenguaje principal del backend.
- **MySQL/MariaDB 10.4.32**: Sistema de base de datos relacional.
- **PDO**: Para conexiones seguras a la base de datos.

### Frontend
- **HTML5**
- **CSS3**
- **Bootstrap 5.3.3**: Framework CSS para diseño responsive.
- **JavaScript**: Para interactividad del cliente.

### Procesamiento de Pagos
- **PayPal API**: Integración para pagos online.
- **Mercado Pago**: Sistema alternativo de pagos.

### Generación de PDFs
- **FPDF**: Librería PHP para generar documentos PDF.

### Envío de Emails
- **PHPMailer**: Para el envío de correos electrónicos.

### Características de Seguridad
- **Argon2**: Algoritmo de hash para contraseñas.
- **PDO Prepared Statements**: Para prevenir inyección SQL.
- **Token CSRF**: Para protección contra ataques CSRF.

---

## 📂 Estructura del Proyecto
- **Frontend**: Carpeta `frontend/` contiene los archivos de diseño e interactividad.
- **Backend**: Carpeta `backend/` incluye las APIs desarrolladas en PHP.
- **Base de Datos**: Archivo en `database/` para importar la estructura de la base de datos.

---

## 🔧 Requisitos para Usar el Sistema
1. Tener **XAMPP** instalado.
2. Importar la base de datos:
   - Abrir phpMyAdmin desde XAMPP.
   - Crear una nueva base de datos y cargar el archivo SQL ubicado en `database/`.
3. Descargar el repositorio:
   - Clonar el proyecto con:
     ```bash
     git clone <URL_DEL_REPOSITORIO>
     ```
   - O descargarlo como archivo comprimido.

---

## 🚀 Cómo Ejecutar el Proyecto

### Backend
1. Asegurarse de que el servidor Apache y MySQL estén activos en XAMPP.
2. Colocar los archivos del proyecto en la carpeta `htdocs`.
3. Acceder a través del navegador en: `http://localhost/TuercaDorada`.

### Frontend
El frontend se encuentra integrado en el backend y puede ser accesado desde el mismo enlace.

---

## 📜 Licencia
Este proyecto está licenciado bajo la [MIT License](LICENSE).
