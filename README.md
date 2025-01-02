# Tuerca Dorada

**Tuerca Dorada** es un sistema de ecommerce desarrollado para la compra y venta de artículos de ferretería. Este proyecto está diseñado para mejorar la gestión administrativa y facilitar las compras de productos de manera rápida y segura.

## 📌 Basado en Ituti
Este proyecto se basa en el sistema **Ituti**, un proyecto previamente desarrollado como punto de partida. Las modificaciones incluyen:
- Adaptación del diseño y funcionalidades para un negocio ferretero.
- Añadido de características específicas, como gestión de descuentos y reportes de inventario.
- Personalización de la base de datos y flujo de compras.

Puedes encontrar el repositorio original de Ituti aquí: [Ituti en Git](URL_DEL_REPOSITORIO_DE_ITUTI).

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
- **Pagos Seguros**: Integración con PayPal para procesar pagos.
- **Notificaciones**: Recibir detalles de las compras vía correo electrónico.

---

## 🛠️ Tecnologías Utilizadas
- **Base de Datos**: MySQL administrado con phpMyAdmin
- **Diseño**: Bootstrap para una interfaz responsiva y moderna

---

## 📂 Estructura del Proyecto
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
1. Aseguradte de tener el Apache y Mysql Corriendo
2. Entra a la siguiente ruta en tu navegador: http://localhost/Ecommerce/

## 📜 Licencia
Este proyecto está licenciado bajo la MIT License.
