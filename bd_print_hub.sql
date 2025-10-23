-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-10-2025 a las 18:02:22
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
-- Base de datos: `bd_print_hub`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `abonos`
--

CREATE TABLE `abonos` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `tipo_transferencia` varchar(20) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `comprobante_pago` varchar(250) DEFAULT NULL,
  `estado` enum('pendiente','aceptado','rechazado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atencion_clientes`
--

CREATE TABLE `atencion_clientes` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` enum('PE','RE') DEFAULT NULL,
  `correo` varchar(150) DEFAULT NULL,
  `telefono` bigint(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `atencion_clientes`
--

INSERT INTO `atencion_clientes` (`id`, `nombre`, `mensaje`, `fecha`, `estado`, `correo`, `telefono`) VALUES
(1, 'Julio Andrés Casanova Ramírez', 'Hola, buenos días.\r\nEstoy interesado en más información acerca de sus productos', '2025-10-23 15:28:27', 'PE', 'julioacr8@gmail.com', 3102366157);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Tintas', 'En esta categoría podrás encontrar cualquier variedad de tientas para tus impresoras, siempre de la mejor calidad'),
(2, 'Cartuchos de Tinta', 'Tenemos gran variedad de cartuchos de tinta, de todos los precios y marca');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `tipo_documento` enum('CC','TI','RC','PASAPORTE','CE') DEFAULT NULL,
  `numero_documento` int(11) DEFAULT NULL,
  `fecha_registro` timestamp NULL DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `correo` varchar(150) NOT NULL,
  `contacto_1` varchar(15) DEFAULT NULL,
  `contacto_2` varchar(15) DEFAULT NULL,
  `clave` varchar(100) NOT NULL,
  `direccion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `tipo_documento`, `numero_documento`, `fecha_registro`, `fecha_nacimiento`, `correo`, `contacto_1`, `contacto_2`, `clave`, `direccion`) VALUES
(1, 'Julio Andrés Casanova Ramírez', 'CC', 1075252762, '2025-10-23 13:50:22', '2025-05-01', 'julioacr8@gmail.com', '3102366155', '0', '$2y$10$nnduMikWxtKqrTR/2b5uUu9WocmdijkD.wGUbcI3GPr6hokaFcL4.', 'Teruel, Cra 3e #5-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_categoria`, `nombre`, `imagen`, `descripcion`, `precio`) VALUES
(1, 1, 'Tinta para Impresora HP', '68fa5003ae253-D_NQ_NP_852694-MLU78443162654_082024-O.webp', 'Paquete de tintas, incluye las tintas que requiere la impresora, además cuenta con 4 paquetes adicionales a un menor precio', 50000),
(2, 2, 'Cartuchos de Tinta para HP', '68fa504543a48-imgIndex.webp', 'Par de cartuchos para tu impresora. Súper económicos, además de buena marca', 20000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `correo` varchar(150) NOT NULL,
  `rol` enum('ADMIN','AGENTE','ATENCION_CLIENTE') NOT NULL,
  `contacto_1` varchar(15) NOT NULL,
  `contacto_2` varchar(15) DEFAULT NULL,
  `clave` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `rol`, `contacto_1`, `contacto_2`, `clave`) VALUES
(1, 'ADMIN', 'julioacr8@gmail.com', 'ADMIN', '3102366157', NULL, '$2y$10$EoJVifmbmdv387qP2BPah.bZ773wAfEaNTCpbbQqWvYHdyMwenNKm');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `tipo_venta` enum('online','fisica','','') NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `total` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `nombre_cliente` varchar(35) DEFAULT NULL,
  `telefono` bigint(15) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `estado` enum('solicitado','atendido','rechazado') DEFAULT NULL,
  `detalles` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `tipo_venta`, `fecha`, `total`, `id_cliente`, `nombre_cliente`, `telefono`, `direccion`, `estado`, `detalles`) VALUES
(1, 'fisica', '2025-10-23 15:58:02', 120000, NULL, 'Julio Andrés Casanova', 3102366157, 'Teruel, Cra 3e #5-13', 'atendido', 'Tinta para Impresora HP (x2) - $100.000, Cartuchos de Tinta para HP (x1) - $20.000'),
(2, 'online', '2025-10-23 15:59:08', 170000, 1, NULL, NULL, NULL, 'solicitado', 'Tinta para Impresora HP (x3) - $150.000\n Cartuchos de Tinta para HP (x1) - $20.000\n ');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `abonos`
--
ALTER TABLE `abonos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_venta` (`id_venta`);

--
-- Indices de la tabla `atencion_clientes`
--
ALTER TABLE `atencion_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`) USING HASH;

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD UNIQUE KEY `numero_documento` (`numero_documento`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abonos`
--
ALTER TABLE `abonos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `atencion_clientes`
--
ALTER TABLE `atencion_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `abonos`
--
ALTER TABLE `abonos`
  ADD CONSTRAINT `abonos_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
