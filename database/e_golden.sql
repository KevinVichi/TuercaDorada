-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-01-2025 a las 20:07:25
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `e_golden`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idCategoria` int(11) NOT NULL,
  `nombreCategoria` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `nombreCategoria`, `descripcion`) VALUES
(1, 'Manos', 'Herramientas de manos'),
(2, 'Eléctricas', 'Herramientas eléctricas'),
(3, 'Medición', 'Herramientas de medición'),
(4, 'Ajustes', 'Herramientas de ajustes\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentariosproductos`
--

CREATE TABLE `comentariosproductos` (
  `idComentario` int(11) NOT NULL,
  `idProducto` int(11) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `comentario` text NOT NULL,
  `fechaComentario` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cupones`
--

CREATE TABLE `cupones` (
  `idCupon` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `descuento` decimal(5,2) NOT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `cantidadDisponible` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuentos`
--

CREATE TABLE `descuentos` (
  `idDescuento` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `porcentaje` decimal(5,2) NOT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedidos`
--

CREATE TABLE `detallepedidos` (
  `idDetalle` int(11) NOT NULL,
  `idPedido` int(11) DEFAULT NULL,
  `idProducto` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precioUnitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) GENERATED ALWAYS AS (`cantidad` * `precioUnitario`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccionesenvio`
--

CREATE TABLE `direccionesenvio` (
  `idDireccion` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `direccion` varchar(255) NOT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `provincia` varchar(100) DEFAULT NULL,
  `codigoPostal` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenesproductos`
--

CREATE TABLE `imagenesproductos` (
  `idImagen` int(11) NOT NULL,
  `imagenURL` varchar(255) NOT NULL,
  `idProducto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `imagenesproductos`
--

INSERT INTO `imagenesproductos` (`idImagen`, `imagenURL`, `idProducto`) VALUES
(28, 'https://www.herramientasavi.com/wp-content/uploads/2023/08/5007MG-1.jpg', 1),
(48, '/uploads/imagenes-1728846904698-789820498.png', 6),
(49, '/uploads/imagenes-1728846904698-212242688.png', 6),
(50, '/uploads/imagenes-1728846904699-805304193.png', 6),
(51, '/uploads/imagenes-1728846932757-936474454.png', 7),
(52, '/uploads/imagenes-1728846932762-37103791.png', 7),
(53, '/uploads/imagenes-1728846932764-123698231.png', 7),
(54, '/uploads/imagenes-1728846932767-255024355.png', 7),
(55, '/uploads/imagenes-1728846932769-900040951.png', 7),
(56, '/uploads/imagenes-1728846932769-668158298.png', 7),
(57, '/uploads/imagenes-1728846932769-754208630.png', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `idPago` int(11) NOT NULL,
  `idPedido` int(11) DEFAULT NULL,
  `MetodoPago` varchar(100) DEFAULT NULL,
  `monto` decimal(10,2) NOT NULL,
  `estadoPago` enum('pendiente','completado','fallido') DEFAULT 'pendiente',
  `fechaPago` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `fechaPedido` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('pendiente','procesado','enviado','entregado','cancelado') DEFAULT 'pendiente',
  `subtotal` decimal(10,2) NOT NULL,
  `iva` decimal(10,2) NOT NULL,
  `costo_envio` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `idDireccionEnvio` int(11) DEFAULT NULL,
  `idCupon` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `nombreProducto` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `idCategoria` int(11) DEFAULT NULL,
  `imagenURL` varchar(255) DEFAULT NULL,
  `SKU` varchar(50) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1,
  `fechaAgregado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `nombreProducto`, `descripcion`, `precio`, `stock`, `idCategoria`, `imagenURL`, `SKU`, `activo`, `fechaAgregado`) VALUES
(1, 'Sierra Circular', 'Sierra eléctrica con hoja de 7.25 pulgadas, perfecta para cortes rápidos en madera y materiales compuestos.', 17.90, 35, 2, '/uploads/imagen-1728839189441-716458592.jpg', 'cam-r-m', 1, '2024-10-06 23:58:07'),
(2, 'Taladro Inalámbrico', 'Taladro recargable de 20V, con varias velocidades y un diseño ergonómico, ideal para perforar y atornillar.', 10.88, 100, 2, '/uploads/imagen-1728842527124-72101525.png', 'su-de-bn', 1, '2024-10-07 00:00:42'),
(3, 'Llave Ajustable', 'Llave con abertura regulable, diseñada para ajustarse a diferentes tamaños de tuercas y pernos.', 10.00, 100, 4, '/uploads/imagen-1728846787739-861729905.png', 'nasu', 1, '2024-10-08 16:50:51'),
(4, 'Juego de Llaves Allen', 'Conjunto de llaves en forma de \"L\" en varios tamaños, ideal para tornillos hexagonales en bicicletas y muebles.', 10.00, 100, 4, '/uploads/imagen-1728406293782-659971215.png', 'len-su-vc', 1, '2024-10-08 16:51:33'),
(5, 'Cinta Métrica', 'Cinta métrica de 5 metros con gancho magnético y bloqueo automático, perfecta para mediciones precisas en proyectos de construcción.', 10.00, 100, 3, '/uploads/imagen-1728408128982-10821260.png', 'za-ve-34', 1, '2024-10-08 17:22:08'),
(6, 'Nivel de Burbuja', 'Herramienta de nivelación de 24 pulgadas con burbujas de nivel en tres direcciones, ideal para colgar cuadros y estanterías.', 10.00, 0, 3, '/uploads/imagen-1728409246724-643199310.png', 'me-de-red', 1, '2024-10-08 17:40:46'),
(7, 'Destornillador de Precisión', 'Destornillador compacto con punta magnética, ideal para trabajos en dispositivos electrónicos y de precisión.', 0.50, 50, 1, '/uploads/imagen-1728579683538-886470704.jpg', 'prue-cam-su', 1, '2024-10-10 17:01:23'),
(9, 'Martillo de clavos', 'Martillo con cabeza de acero y mango de madera, perfecto para clavar clavos y realizar trabajos de carpintería.', 80.90, 100, 1, '/uploads/imagen-1728580516198-485104950.jpg', 'prue-cam-sur', 1, '2024-10-10 17:15:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productosdescuento`
--

CREATE TABLE `productosdescuento` (
  `idProductoDescuento` int(11) NOT NULL,
  `idProducto` int(11) DEFAULT NULL,
  `idDescuento` int(11) DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productospromocion`
--

CREATE TABLE `productospromocion` (
  `idProductoPromocion` int(11) NOT NULL,
  `idProducto` int(11) DEFAULT NULL,
  `idPromocion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `idPromocion` int(11) NOT NULL,
  `nombrePromocion` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `descuento` decimal(5,2) NOT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reseñas`
--

CREATE TABLE `reseñas` (
  `idReseña` int(11) NOT NULL,
  `idProducto` int(11) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `calificacion` int(11) DEFAULT NULL CHECK (`calificacion` between 1 and 5),
  `comentario` text DEFAULT NULL,
  `fechaReseña` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `correo` varchar(255) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `sexo` varchar(100) DEFAULT NULL,
  `fecha_naci` date DEFAULT NULL,
  `contrasena` varchar(255) NOT NULL,
  `tipoUsuario` enum('cliente','admin') DEFAULT 'cliente',
  `fechaRegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('activo','inactivo') DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nombre`, `apellido`, `correo`, `telefono`, `direccion`, `sexo`, `fecha_naci`, `contrasena`, `tipoUsuario`, `fechaRegistro`, `estado`) VALUES
(1, 'Juan', 'Pérez', 'juan.perez@example.com', '0999999999', 'Calle Falsa 123', 'Masculino', '1990-05-15', 'mi_contrasena_segura', 'cliente', '2024-10-06 23:16:03', 'activo'),
(2, 'María', 'García', 'maria.garcia@example.com', '0998888888', 'Avenida Siempreviva 456', 'Femenino', '1985-10-20', 'otra_contrasena_segura', 'admin', '2024-10-06 23:16:42', 'activo'),
(3, 'diego', 'loquin', 'diegoloquin77@example.com', '0998765432', 'Calle Falsa 123', 'masculino', '1990-01-01', '$argon2id$v=19$m=65536,t=3,p=4$PcnHNwt6CdPYk44TSXeLkA$yvpyOSaceSZvi2gXMdZjGq087yVoFZCblVy7xoeyzEU', '', '2024-10-16 02:25:39', 'activo'),
(4, 'Diego', 'Fernando', 'dpincha6411@uta.edu.ec', '0998765432', 'Calle Falsa 123', 'masculino', '1990-01-01', '$argon2id$v=19$m=65536,t=3,p=4$6CxKwvCnSMXcxLEhZCRygw$Ig8RvGKdftMRzLtINJ2wjPE2LIweVhtewZixhrvy3os', 'admin', '2024-10-16 02:28:39', 'activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `comentariosproductos`
--
ALTER TABLE `comentariosproductos`
  ADD PRIMARY KEY (`idComentario`),
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `cupones`
--
ALTER TABLE `cupones`
  ADD PRIMARY KEY (`idCupon`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  ADD PRIMARY KEY (`idDescuento`);

--
-- Indices de la tabla `detallepedidos`
--
ALTER TABLE `detallepedidos`
  ADD PRIMARY KEY (`idDetalle`),
  ADD KEY `idPedido` (`idPedido`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `direccionesenvio`
--
ALTER TABLE `direccionesenvio`
  ADD PRIMARY KEY (`idDireccion`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `imagenesproductos`
--
ALTER TABLE `imagenesproductos`
  ADD PRIMARY KEY (`idImagen`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`idPago`),
  ADD KEY `idPedido` (`idPedido`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idDireccionEnvio` (`idDireccionEnvio`),
  ADD KEY `idCupon` (`idCupon`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`),
  ADD UNIQUE KEY `SKU` (`SKU`),
  ADD KEY `idCategoria` (`idCategoria`);

--
-- Indices de la tabla `productosdescuento`
--
ALTER TABLE `productosdescuento`
  ADD PRIMARY KEY (`idProductoDescuento`),
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `idDescuento` (`idDescuento`);

--
-- Indices de la tabla `productospromocion`
--
ALTER TABLE `productospromocion`
  ADD PRIMARY KEY (`idProductoPromocion`),
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `idPromocion` (`idPromocion`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`idPromocion`);

--
-- Indices de la tabla `reseñas`
--
ALTER TABLE `reseñas`
  ADD PRIMARY KEY (`idReseña`),
  ADD KEY `idProducto` (`idProducto`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `comentariosproductos`
--
ALTER TABLE `comentariosproductos`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cupones`
--
ALTER TABLE `cupones`
  MODIFY `idCupon` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  MODIFY `idDescuento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detallepedidos`
--
ALTER TABLE `detallepedidos`
  MODIFY `idDetalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `direccionesenvio`
--
ALTER TABLE `direccionesenvio`
  MODIFY `idDireccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagenesproductos`
--
ALTER TABLE `imagenesproductos`
  MODIFY `idImagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `idPago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `productosdescuento`
--
ALTER TABLE `productosdescuento`
  MODIFY `idProductoDescuento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productospromocion`
--
ALTER TABLE `productospromocion`
  MODIFY `idProductoPromocion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `idPromocion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reseñas`
--
ALTER TABLE `reseñas`
  MODIFY `idReseña` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentariosproductos`
--
ALTER TABLE `comentariosproductos`
  ADD CONSTRAINT `comentariosproductos_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`),
  ADD CONSTRAINT `comentariosproductos_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `detallepedidos`
--
ALTER TABLE `detallepedidos`
  ADD CONSTRAINT `detallepedidos_ibfk_1` FOREIGN KEY (`idPedido`) REFERENCES `pedidos` (`idPedido`),
  ADD CONSTRAINT `detallepedidos_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`);

--
-- Filtros para la tabla `direccionesenvio`
--
ALTER TABLE `direccionesenvio`
  ADD CONSTRAINT `direccionesenvio_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `imagenesproductos`
--
ALTER TABLE `imagenesproductos`
  ADD CONSTRAINT `imagenesproductos_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`);

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`idPedido`) REFERENCES `pedidos` (`idPedido`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`idDireccionEnvio`) REFERENCES `direccionesenvio` (`idDireccion`),
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`idCupon`) REFERENCES `cupones` (`idCupon`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`idCategoria`);

--
-- Filtros para la tabla `productosdescuento`
--
ALTER TABLE `productosdescuento`
  ADD CONSTRAINT `productosdescuento_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`),
  ADD CONSTRAINT `productosdescuento_ibfk_2` FOREIGN KEY (`idDescuento`) REFERENCES `descuentos` (`idDescuento`);

--
-- Filtros para la tabla `productospromocion`
--
ALTER TABLE `productospromocion`
  ADD CONSTRAINT `productospromocion_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`),
  ADD CONSTRAINT `productospromocion_ibfk_2` FOREIGN KEY (`idPromocion`) REFERENCES `promociones` (`idPromocion`);

--
-- Filtros para la tabla `reseñas`
--
ALTER TABLE `reseñas`
  ADD CONSTRAINT `reseñas_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`),
  ADD CONSTRAINT `reseñas_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
