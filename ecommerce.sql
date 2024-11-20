-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-11-2024 a las 23:06:25
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
-- Base de datos: `ecommerce`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `user`, `password`, `email`, `status`) VALUES
(1, 'admin', 'admin123', 'a@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `name`, `status`) VALUES
(1, 'Manos', 1),
(2, 'Ajustes', 1),
(3, 'Eléctricas', 1),
(4, 'Medición', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `user` varchar(80) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(80) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `dni` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `status` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`id`, `user`, `password`, `email`, `phone`, `dni`, `status`) VALUES
(1, 'bryan', 'obando', 'bryan@gmail.com', '0983231570', '123456789', 1),
(2, 'Ignacio', 'Obando', 'bryanobandochavez@gmail.com', '0983231570', '0987654321', 1),
(3, 'Axel', 'Vargas', 'av@uta.edu.ec', '0967441018', '1804786091', 1),
(4, 'David', 'Flores', 'davidfloresalazar11@gmail.com', '0981315272', '1850009091', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_token`
--

CREATE TABLE `password_token` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `usado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` tinyint(3) NOT NULL DEFAULT 0,
  `stock` int(11) NOT NULL DEFAULT 0,
  `id_category` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `discount`, `stock`, `id_category`, `status`, `image`) VALUES
(1, 'Destornillador', 'Destornillador', 2.00, 1, 794, 2, 1, 'https://www.gastronomiavasca.net/uploads/image/file/4295/lentejas.jpg'),
(2, 'Llave', 'Llave', 1.45, 0, 100, 2, 1, 'https://www.cocinista.es/download/bancorecursos/ingredientes/ingrediente-aceite-oliva-2.jpg '),
(3, 'Martillo', 'Martillo', 1.34, 0, 50, 3, 1, ''),
(4, 'Alicate', 'Alicate', 1.34, 0, 0, 1, 1, ''),
(5, 'Cinta adesiva', 'Cinta adesiva', 0.90, 10, 0, 2, 1, ''),
(6, 'Sierra', 'Sierra', 2.56, 0, 0, 3, 1, ''),
(7, 'Taladro', 'Taladro', 1.20, 0, 0, 4, 1, ''),
(8, 'Nivel', 'Nivel de burbuja', 1.00, 1, 4, 1, 0, ''),
(9, 'Escuadra', 'Escuadra', 2.00, 10, 14, 4, 0, ''),
(10, 'Lijadoras', 'Lijadoras', 2.00, 1, 7, 4, 1, ''),
(11, 'Pistola de silicona', 'Pistola de silicona', 2.00, 21, 1, 1, 0, ''),
(12, 'Esmeriles', 'Esmeriales', 1.00, 1, 1, 1, 0, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_token`
--
ALTER TABLE `password_token`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `fk_admin_password_token` (`admin_id`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `password_token`
--
ALTER TABLE `password_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `password_token`
--
ALTER TABLE `password_token`
  ADD CONSTRAINT `fk_admin_password_token` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `password_token_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `client` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
