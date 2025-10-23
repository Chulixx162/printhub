-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-08-2025 a las 16:19:29
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
-- Base de datos: `bd_siw_turismo`
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

--
-- Volcado de datos para la tabla `abonos`
--

INSERT INTO `abonos` (`id`, `id_venta`, `fecha`, `monto`, `metodo_pago`, `tipo_transferencia`, `observaciones`, `comprobante_pago`, `estado`) VALUES
(1, 15, '0000-00-00', 25000.00, 'Transferencia', 'nequi', NULL, NULL, 'rechazado'),
(2, 15, '0000-00-00', 10475000.00, 'Transferencia', 'nequi', '', '68aa4a37290ec-21470714072ecdd016b65cc8ba2b3424.png', 'aceptado'),
(3, 15, '2025-08-22', 25000.00, 'Transferencia', 'nequi', '', '68aa4a60be933-career.webp', 'aceptado'),
(5, 15, '2025-08-22', 10000.00, 'Transferencia', 'bancolombia', NULL, NULL, 'rechazado'),
(6, 12, '2025-08-23', 250000.00, 'Transferencia', 'Daviplata', 'Hola', '', 'aceptado'),
(7, 12, '2025-08-23', 50000.00, 'Transferencia', 'Nequi', 'okokok', '', 'rechazado'),
(8, 12, '2025-08-23', 50000000.00, 'Transferencia', 'Nequi', 'jojojo', '68a9cdadca2c3-Piecewise-functions.png', 'rechazado'),
(9, 4, '2025-08-23', 50000000.00, 'Transferencia', 'Daviplata', 'uuuuuuuuuu', '68a9f6cfd85d0-21470714072ecdd016b65cc8ba2b3424.png', 'aceptado'),
(10, 12, '2025-08-23', 59750108.00, 'Efectivo', 'Bancolombia', 'prueba', '', 'aceptado'),
(11, 5, '2025-08-23', 2380000.00, 'Transferencia', 'Daviplata', 'Observaciones', '68aa315bc5cb6-conclusion-text-written-on-blueb.png', 'aceptado'),
(12, 5, '2025-08-23', 21420000.00, 'Transferencia', 'Daviplata', '', '68aa31b637e11-89fbf09b3110e5849b96036a18316a1f.png', 'aceptado'),
(13, 20, '2025-08-29', 50500000.00, 'Efectivo', '', '', NULL, 'aceptado'),
(14, 21, '2025-08-29', 65500000.00, 'Efectivo', '', '', NULL, 'aceptado'),
(15, 24, '2025-08-30', 2500000.00, 'Transferencia', 'Nequi', 'Okokok', '68b2f9d3eaf5a-file_0000000065c0623085bf5f7026727697.png', 'aceptado'),
(16, 24, '2025-08-30', 2500000.00, 'Transferencia', 'Nequi', '', '68b2fba7e4ef1-1756256267622.jpg', 'aceptado');

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
(1, 'Julio Andrés ', 'DFKNVNÑ SDKFH V KEFHBVPJHEBFIVHBERF IPEHFBVUHFBVIBF´PVI FIVHBIERBFVPIDHFBP0IUGYB RIPBG0RTPIWRBY', '2025-07-09 21:02:19', 'RE', 'julio@gmail.com', 3102366157),
(2, 'Juan Manuel', 'Hola mundo', '2025-06-07 20:37:37', 'RE', 'JuanManuelSena@gmail.com', 3227097033),
(3, 'Julio Andrés ', 'Este es un mensaje de prueba', '2025-07-09 21:02:23', 'RE', 'juan@gmail.com', 3227097033),
(4, 'Julio Andrés ', 'Mensaje de prueba', '2025-08-29 21:19:37', 'RE', 'julio@gmail.com', 3102366157);

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
(1, 'Paquetes Turísticos', 'Un paquete turístico es un servicio turístico que combina varios elementos o servicios en una sola oferta, diseñada para facilitar la organización y experiencia del viaje para el turista. Estos paquetes suelen incluir transporte, alojamiento, comidas, excursiones, y a veces actividades especiales o entradas a atracciones.'),
(2, 'Planes Individuales', 'Los planes individuales son opciones de viaje o servicios turísticos diseñados para un solo viajero, que buscan ofrecer una experiencia personalizada y flexible. A diferencia de los paquetes turísticos grupales, estos planes se adaptan a las necesidades, gustos y tiempos particulares de una persona.'),
(3, 'Tours Guiados', 'Los tours guiados son recorridos turísticos organizados y dirigidos por un guía experto que acompaña a un grupo o a viajeros individuales para mostrarles un destino, monumentos, atractivos naturales o culturales, brindando información, historia y datos relevantes durante la experiencia.');

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
(1, 'Julio Andrés', 'CC', 1075252762, '2025-05-26 04:24:21', '2009-05-01', 'julio@gmail.com', '3102366157', '3123456789', '$2y$10$uaKKUX1YDi.WDyoh9NXyb.bWBJzRNjDdesdzjcnhQd0GqiTkDKq7m', 'Teruel, Cra 3E #5-13'),
(2, 'Juan Esteban', 'CC', 1084923574, '2025-05-25 23:53:04', '2008-08-16', 'juan@gmail.com', '3123456789', '32123456789', '$2y$10$CSU4/MBvhNtk7peVOcNMHOYjaOD0eNSATY2P5so8ePreXiCnSBt0K', 'Teruel, Cra 1 #4E-30'),
(3, 'Vrenda Galindo', 'CC', 1084923524, '2025-05-27 01:58:57', '2008-10-17', 'vrenda@gmail.com', '3213456789', '', '$2y$10$2ZmzeEgmMU3SLEL78jPweez7jUDg1jKXCWA.OO2UKANorT9tr4hGq', 'Cra 4 #3-01'),
(4, 'juan', 'CC', 21988982, '2025-06-04 20:42:44', '2001-02-23', 'juacho@silva.com', '310236623', '', '$2y$10$Ns/JcV1vHbUYNdspAMl5wOQwNNJDqI1lMTVKCVTS/UzjqKYOrryui', 'Teruel, Cra 1 #4E-31'),
(23, 'Juan Silva', 'CC', 1007273585, '2025-08-30 12:58:31', '2001-06-29', 'juancho29silva@gmail.com', '3112119638', '0', '$2y$10$qQbSwdf3w.NVmIFcspiQ/u27VvqZEQ1Kf.AcAwU/qUZwrC2fmnAVS', 'Cr 5 #36-30 sur, Conjunto Goya, T11, Apt 104'),
(24, 'Daniel E', 'CC', 1029283017, '2025-08-30 13:09:33', '2008-11-06', 'daniel@gmail.com', '3132157620', '0', '$2y$10$DKHIMmP7.N.sT9.DNPPMvO21pD2WoeWYaCQSy5WQ8a/Wl3u3wwTZK', 'Cll 6 3-11');

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
(1, 1, 'CARTAGENA', '68704e9ecf73c-CARTAGENA.jpg', 'Disfruta de una experiencia inolvidable de 5 noches y 6 días en la joya del Caribe colombiano, con alojamiento en hotel cuatro estrellas, desayunos buffet, cenas incluidas y transporte aéreo o terrestre ida y regreso, según tu preferencia.', 15000000),
(2, 2, 'Santa Marta', '68704eb518564-SANTA MARTA.jpg', 'Incluye transporte aéreo o terrestre ida y regreso, hospedaje en hotel tres o cuatro estrellas con vista al mar, desayunos buffet y cenas incluidas. Recorre la ciudad más antigua de Colombia con un tour guiado por el centro histórico, el Malecón de El Rodadero y la Quinta de San Pedro Alejandrino.', 5000000),
(3, 2, 'Medellín', '68704eca101e1-COMUNA.jpg', 'Este plan completo incluye transporte aéreo o terrestre ida y regreso, 6 días y 5 noches de alojamiento en un hotel cómodo y bien ubicado, desayunos tipo buffet, cenas y traslados internos en vehículo climatizado.', 500000);

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
(1, 'Juan Cerquera', 'juan@gmail.com', 'ADMIN', '312345662', '3213456789', '$2y$10$nIrnWA4SllFnKRyr3.umNOlgGpEDvh/hjrKHajt58ZgObhfb/OW/q'),
(2, 'Julio Andrés ', 'julio@gmail.com', 'ADMIN', '320658535', '3125849964', '$2y$10$xIXKjfc7u.vNDtJ2N5z1NeRH2TFCs1VbkgQakNtUrpcm.0h.4PViW'),
(3, 'Vrenda Galindo', 'vrenda@gmail.com', 'ATENCION_CLIENTE', '3125854562', '31023447895', '$2y$10$AdUSxJ8uqI5D76Lc2zfdk.atjehfJkv9kvHGN5OT/QNQj1NKAenjC');

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
(1, 'online', '2025-08-22 00:40:43', 60000000, 1, NULL, NULL, NULL, 'rechazado', 'CARTAGENA (x4) - $60.000.000\n'),
(2, 'fisica', '2025-08-22 00:41:46', 23800011, 2, 'FREDY MAURICIO', 3123456789, NULL, 'solicitado', 'CARTAGENA (x1) - $15.000.000\nSanta Marta (x1) - $5.000.000\nnuevo (x1) - $9\n'),
(3, 'online', '2025-07-09 20:56:03', 35700011, 3, NULL, NULL, NULL, 'atendido', 'nuevo (x1) - $9\nCARTAGENA (x2) - $30.000.000\n'),
(4, 'fisica', '2025-07-09 20:55:57', 53550000, 4, 'RICARDO', 3123456789, NULL, 'atendido', 'CARTAGENA (x3) - $45.000.000\n'),
(5, 'online', '2025-07-09 20:55:52', 23800000, 1, NULL, NULL, NULL, 'atendido', 'Santa Marta (x4) - $20.000.000\n'),
(6, 'online', '2025-07-09 20:55:45', 35000009, 2, NULL, NULL, NULL, 'rechazado', 'CARTAGENA (x2) - $30.000.000\nSanta Marta (x1) - $5.000.000\nnuevo (x1) - $9\n'),
(7, 'online', '2025-07-09 20:55:40', 306, 2, NULL, NULL, NULL, 'rechazado', 'nuevo (x34) - $306\n'),
(8, 'online', '2025-07-09 20:55:35', 20000009, 3, NULL, NULL, NULL, 'rechazado', 'CARTAGENA (x1) - $15.000.000\nSanta Marta (x1) - $5.000.000\nnuevo (x1) - $9\n'),
(9, 'online', '2025-07-09 20:55:29', 20000000, 3, NULL, NULL, NULL, 'atendido', 'Santa Marta (x4) - $20.000.000\n'),
(10, 'online', '2025-07-22 02:06:15', 20000000, 3, NULL, NULL, NULL, 'atendido', 'Santa Marta (x1) - $5.000.000\n CARTAGENA (x1) - $15.000.000\n '),
(11, 'online', '2025-07-09 20:55:01', 15000000, 3, NULL, NULL, NULL, 'rechazado', 'CARTAGENA (x1) - $15.000.000\n '),
(12, 'online', '2025-07-09 21:20:27', 60000108, 1, NULL, NULL, NULL, 'atendido', 'CARTAGENA (x4) - $60.000.000\n nuevo (x12) - $108\n '),
(13, 'online', '2025-08-22 00:42:45', 5000000, 1, NULL, NULL, NULL, 'rechazado', 'Santa Marta (x1) - $5.000.000\n '),
(14, 'online', '2025-08-22 23:21:21', 15000000, 1, NULL, NULL, NULL, 'rechazado', 'CARTAGENA (x1) - $15.000.000\n '),
(15, 'online', '2025-08-22 23:21:41', 10500000, 1, NULL, NULL, NULL, 'atendido', 'Santa Marta (x2) - $10.000.000\n Medellín (x1) - $500.000\n '),
(16, 'online', '2025-08-29 22:26:12', 20500000, 1, NULL, NULL, NULL, 'solicitado', 'Santa Marta (x1) - $5.000.000\n CARTAGENA (x1) - $15.000.000\n Medellín (x1) - $500.000\n '),
(18, 'fisica', '2025-08-30 01:59:42', 15000000, NULL, 'Luis Alfredo', 3208653588, 'cr3e Teruel', 'atendido', 'CARTAGENA (x1) - $15.000.000'),
(19, 'fisica', '2025-08-30 02:21:38', 45000000, NULL, 'VANESSA SÁNCHEZ', 3214567899, 'Sin dirección', 'atendido', 'CARTAGENA (x2) - $30.000.000, Santa Marta (x3) - $15.000.000'),
(20, 'fisica', '2025-08-30 02:35:04', 50500000, NULL, 'LUIS ALFREDO', 3102366157, 'Neiva', 'atendido', 'Santa Marta (x1) - $5.000.000, Medellín (x1) - $500.000, CARTAGENA (x3) - $45.000.000'),
(21, 'fisica', '2025-08-30 03:02:14', 65500000, NULL, 'ROBERTO', 311585679, 'Bogota', 'atendido', 'Santa Marta (x1) - $5.000.000, Medellín (x1) - $500.000, CARTAGENA (x4) - $60.000.000'),
(22, 'fisica', '2025-08-30 03:07:20', 5500000, NULL, 'ALBERTO', 3123456789, 'CÚCUTA', 'atendido', 'Santa Marta (x1) - $5.000.000, Medellín (x1) - $500.000'),
(23, 'online', '2025-08-30 13:02:52', 5000000, 23, NULL, NULL, NULL, 'atendido', 'Medellín (x10) - $5.000.000\n '),
(24, 'online', '2025-08-30 13:10:42', 5000000, 24, NULL, NULL, NULL, 'atendido', 'Santa Marta (x1) - $5.000.000\n '),
(25, 'online', '2025-08-30 13:54:51', 15000000, 1, NULL, NULL, NULL, 'atendido', 'CARTAGENA (x1) - $15.000.000\n ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajeros`
--

CREATE TABLE `viajeros` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `tipo_de_documento` enum('CC','TI','RC','PASAPORTE','CE') NOT NULL,
  `numero_de_documento` int(11) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_nacimiento` date DEFAULT NULL,
  `contacto_1` varchar(15) DEFAULT NULL,
  `contacto_2` varchar(15) DEFAULT NULL,
  `direccion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `viajeros`
--

INSERT INTO `viajeros` (`id`, `nombre`, `tipo_de_documento`, `numero_de_documento`, `fecha_registro`, `fecha_nacimiento`, `contacto_1`, `contacto_2`, `direccion`) VALUES
(1, 'Julio Andrés ', 'CC', 1075252762, '2025-06-04 21:55:34', '2009-05-01', '3102366157', '3208653588', 'Teruel, Cra 3E #5-13');

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
-- Indices de la tabla `viajeros`
--
ALTER TABLE `viajeros`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `abonos`
--
ALTER TABLE `abonos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `atencion_clientes`
--
ALTER TABLE `atencion_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `viajeros`
--
ALTER TABLE `viajeros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
