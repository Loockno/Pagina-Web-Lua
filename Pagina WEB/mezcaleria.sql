-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-05-2024 a las 16:40:14
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
-- Base de datos: `mezcaleria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_de_compras`
--

CREATE TABLE `carrito_de_compras` (
  `ID_carrito` int(11) NOT NULL,
  `ID_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito_de_compras`
--

INSERT INTO `carrito_de_compras` (`ID_carrito`, `ID_usuario`) VALUES
(1, 3),
(2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_mezcales`
--

CREATE TABLE `carrito_mezcales` (
  `ID_carrito` int(11) NOT NULL,
  `ID_mezcal` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito_mezcales`
--

INSERT INTO `carrito_mezcales` (`ID_carrito`, `ID_mezcal`, `Cantidad`) VALUES
(1, 1, 7),
(2, 2, 1),
(2, 5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `ID_compra` int(11) NOT NULL,
  `ID_usuario` int(11) DEFAULT NULL,
  `Fecha_hora_compra` datetime NOT NULL,
  `Estado_compra` enum('pendiente','completada','cancelada') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_de_compra`
--

CREATE TABLE `detalles_de_compra` (
  `ID_detalle_compra` int(11) NOT NULL,
  `ID_compra` int(11) DEFAULT NULL,
  `ID_mezcal` int(11) DEFAULT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio_unitario` decimal(10,2) NOT NULL,
  `Subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE `direcciones` (
  `ID_direccion` int(11) NOT NULL,
  `ID_usuario` int(11) DEFAULT NULL,
  `Calle_numero` varchar(255) NOT NULL,
  `Ciudad` varchar(255) NOT NULL,
  `Estado` varchar(255) NOT NULL,
  `Codigo_postal` varchar(10) NOT NULL,
  `Pais` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `direcciones`
--

INSERT INTO `direcciones` (`ID_direccion`, `ID_usuario`, `Calle_numero`, `Ciudad`, `Estado`, `Codigo_postal`, `Pais`) VALUES
(1, 4, 'Calle Ficticia 123', 'Ciudad Muestra', 'Estado Ejemplo', '12345', 'México');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_de_compras`
--

CREATE TABLE `historial_de_compras` (
  `ID_compra` int(11) NOT NULL,
  `ID_usuario` int(11) DEFAULT NULL,
  `Fecha_hora_compra` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodos_pago`
--

CREATE TABLE `metodos_pago` (
  `ID_pago` int(11) NOT NULL,
  `ID_usuario` int(11) DEFAULT NULL,
  `Tipo` varchar(50) DEFAULT NULL,
  `Numero_tarjeta` varchar(16) DEFAULT NULL,
  `Nombre_tarjeta` varchar(100) DEFAULT NULL,
  `Fecha_expiracion` varchar(7) DEFAULT NULL,
  `CVV` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `metodos_pago`
--

INSERT INTO `metodos_pago` (`ID_pago`, `ID_usuario`, `Tipo`, `Numero_tarjeta`, `Nombre_tarjeta`, `Fecha_expiracion`, `CVV`) VALUES
(1, 4, 'Visa', '4111111111111111', 'Nombre Apellido', '12/2027', '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mezcales`
--

CREATE TABLE `mezcales` (
  `ID_mezcal` int(11) NOT NULL,
  `Nombre_mezcal` varchar(255) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Volumen` int(11) NOT NULL,
  `Imagen_mezcal` varchar(255) DEFAULT NULL,
  `Cantidad` int(11) NOT NULL,
  `Tipo_de_mezcal` varchar(255) DEFAULT NULL,
  `Tipo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mezcales`
--

INSERT INTO `mezcales` (`ID_mezcal`, `Nombre_mezcal`, `Descripcion`, `Precio`, `Volumen`, `Imagen_mezcal`, `Cantidad`, `Tipo_de_mezcal`, `Tipo`) VALUES
(1, 'Mezcal Espadín', 'Mezcal joven con notas ahumadas y frutales.', 39.99, 750, 'botella_Espadin.png', 100, NULL, 'Espadin'),
(2, 'Mezcal Tobalá', 'Mezcal artesanal de agave Tobalá, suave y aromático.', 59.99, 750, 'botella_Tobala.png', 50, NULL, 'Tobala'),
(3, 'Mezcal Arroqueño', 'Mezcal de agave Arroqueño con sabores intensos y complejos.', 79.99, 750, 'botella_Arroqueno.png', 30, NULL, 'Arroqueno'),
(4, 'Mezcal Jabalí', 'Mezcal joven con un toque de picante y notas herbales.', 29.99, 750, 'botella_Jabali.png', 80, NULL, 'Jabali'),
(5, 'Mezcal Ensamble', 'Mezcla de agaves espadín, tobalá y arroqueño, equilibrado y suave.', 49.99, 750, 'botella_Ensamble.png', 60, NULL, 'Ensamble');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas`
--

CREATE TABLE `recetas` (
  `ID_receta` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `ID_mezcal` int(11) NOT NULL,
  `ingredientes` text NOT NULL,
  `instrucciones` text NOT NULL,
  `Imagen_coctel` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recetas`
--

INSERT INTO `recetas` (`ID_receta`, `nombre`, `ID_mezcal`, `ingredientes`, `instrucciones`, `Imagen_coctel`) VALUES
(1, 'Margarita Mezcal', 6, '2 oz de Mezcal, 1 oz de jugo de limón, 1/2 oz de triple sec, Sal para el borde del vaso', '1. Frotar el borde del vaso con limón y sumergir en sal. 2. Mezclar todos los ingredientes con hielo y agitar bien. 3. Colar en el vaso preparado.', 'coctel_Margarita.png'),
(2, 'Paloma Mezcal', 7, '2 oz de Mezcal, 6 oz de jugo de toronja, 1/2 oz de jarabe de agave, 1/2 oz de jugo de lima, Soda de toronja, Sal para el borde del vaso', '1. Frotar el borde del vaso con lima y sumergir en sal. 2. Mezclar el Mezcal, jugo de toronja, jugo de lima y jarabe de agave en el vaso. 3. Añadir hielo y completar con soda de toronja.', 'coctel_Paloma.png'),
(3, 'Mezcal Mule', 8, '2 oz de Mezcal, 6 oz de ginger beer, 1/2 oz de jugo de limón, Rodaja de limón y menta para decorar', '1. Llenar un vaso alto con hielo. 2. Añadir el mezcal y el jugo de limón al vaso. 3. Completar con ginger beer. 4. Remover suavemente y decorar con rodaja de limón y hojas de menta.', 'coctel_Mule.png'),
(4, 'Fresa y Humo', 8, '2 oz de Mezcal, 1 oz de jugo de fresa fresca, 1/2 oz de jugo de limón, 1/2 oz de jarabe simple, Fresas frescas y hojas de menta para decorar', '1. En un shaker, combinar el mezcal, jugo de fresa, jugo de limón y jarabe simple con hielo. 2. Agitar bien hasta que la mezcla esté bien fría. 3. Colar en un vaso lleno de hielo. 4. Decorar con fresas frescas y hojas de menta.', 'coctel_Fresa.png'),
(5, 'Oaxaca Old Fashioned', 7, '2 oz de Mezcal, 1 barra de azúcar, Unas gotas de angostura, Una rodaja de naranja, Hielo', '1. Colocar la barra de azúcar en el vaso. 2. Añadir unas gotas de angostura y un poco de agua. 3. Mezclar hasta disolver el azúcar. 4. Llenar el vaso con hielo y añadir el mezcal. 5. Remover suavemente. 6. Adornar con la rodaja de naranja.', 'coctel_Oaxaca.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_usuario` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Apellido_paterno` varchar(255) DEFAULT NULL,
  `Apellido_materno` varchar(255) DEFAULT NULL,
  `Celular` varchar(20) DEFAULT NULL,
  `Correo_electronico` varchar(255) NOT NULL,
  `Contraseña` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_usuario`, `Nombre`, `Apellido_paterno`, `Apellido_materno`, `Celular`, `Correo_electronico`, `Contraseña`) VALUES
(1, 'Pedro', 'Estanislado', 'Mendez', '4435954101', 'mendezestanislado@gmail.com', '$2y$10$Imv.X/.6BIDmnP.yFkq2wutv1M9PoLxaJRdzBHJDkFIDEQLDNPXt2'),
(2, 'Komi', 'Shouko', 'Shouko', '4435954101', 'komi@gmail.com', '$2y$10$XBuAhwLSU4dKtJwGrJ2x8.lUCv4.tsLNFLrtGYWHY/TetOXjRNRm6'),
(3, 'Komi', 'Shouko', 'Shouko', '1', 'komi1@gmail.com', '$2y$10$lmPDVAmh7dHwOacQrfJDw.DSi0x4S/ZXmVbKCaNgqt9fhCXqfdJMK'),
(4, 'Komi', 'Shouko', 'Shouko', '1', 'komi2@gmail.com', '$2y$10$dpDTfN.488khC522UspU4O3hHeflWyRky34TyrdGSyyNftwFdlAfC');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito_de_compras`
--
ALTER TABLE `carrito_de_compras`
  ADD PRIMARY KEY (`ID_carrito`),
  ADD KEY `ID_usuario` (`ID_usuario`);

--
-- Indices de la tabla `carrito_mezcales`
--
ALTER TABLE `carrito_mezcales`
  ADD PRIMARY KEY (`ID_carrito`,`ID_mezcal`),
  ADD KEY `ID_mezcal` (`ID_mezcal`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`ID_compra`),
  ADD KEY `idx_usuario_compra` (`ID_usuario`);

--
-- Indices de la tabla `detalles_de_compra`
--
ALTER TABLE `detalles_de_compra`
  ADD PRIMARY KEY (`ID_detalle_compra`),
  ADD KEY `idx_compra_detalle` (`ID_compra`),
  ADD KEY `idx_mezcal_detalle` (`ID_mezcal`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`ID_direccion`),
  ADD KEY `ID_usuario` (`ID_usuario`);

--
-- Indices de la tabla `historial_de_compras`
--
ALTER TABLE `historial_de_compras`
  ADD PRIMARY KEY (`ID_compra`),
  ADD KEY `ID_usuario` (`ID_usuario`);

--
-- Indices de la tabla `metodos_pago`
--
ALTER TABLE `metodos_pago`
  ADD PRIMARY KEY (`ID_pago`),
  ADD KEY `ID_usuario` (`ID_usuario`);

--
-- Indices de la tabla `mezcales`
--
ALTER TABLE `mezcales`
  ADD PRIMARY KEY (`ID_mezcal`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_usuario`),
  ADD UNIQUE KEY `Correo_electronico` (`Correo_electronico`),
  ADD KEY `idx_correo` (`Correo_electronico`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito_de_compras`
--
ALTER TABLE `carrito_de_compras`
  MODIFY `ID_carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `ID_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalles_de_compra`
--
ALTER TABLE `detalles_de_compra`
  MODIFY `ID_detalle_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `ID_direccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `metodos_pago`
--
ALTER TABLE `metodos_pago`
  MODIFY `ID_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `mezcales`
--
ALTER TABLE `mezcales`
  MODIFY `ID_mezcal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito_de_compras`
--
ALTER TABLE `carrito_de_compras`
  ADD CONSTRAINT `carrito_de_compras_ibfk_1` FOREIGN KEY (`ID_usuario`) REFERENCES `usuarios` (`ID_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `carrito_mezcales`
--
ALTER TABLE `carrito_mezcales`
  ADD CONSTRAINT `carrito_mezcales_ibfk_1` FOREIGN KEY (`ID_carrito`) REFERENCES `carrito_de_compras` (`ID_carrito`) ON DELETE CASCADE,
  ADD CONSTRAINT `carrito_mezcales_ibfk_2` FOREIGN KEY (`ID_mezcal`) REFERENCES `mezcales` (`ID_mezcal`) ON DELETE CASCADE;

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`ID_usuario`) REFERENCES `usuarios` (`ID_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalles_de_compra`
--
ALTER TABLE `detalles_de_compra`
  ADD CONSTRAINT `detalles_de_compra_ibfk_1` FOREIGN KEY (`ID_compra`) REFERENCES `compras` (`ID_compra`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalles_de_compra_ibfk_2` FOREIGN KEY (`ID_mezcal`) REFERENCES `mezcales` (`ID_mezcal`) ON DELETE CASCADE;

--
-- Filtros para la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD CONSTRAINT `direcciones_ibfk_1` FOREIGN KEY (`ID_usuario`) REFERENCES `usuarios` (`ID_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `historial_de_compras`
--
ALTER TABLE `historial_de_compras`
  ADD CONSTRAINT `historial_de_compras_ibfk_1` FOREIGN KEY (`ID_compra`) REFERENCES `compras` (`ID_compra`) ON DELETE CASCADE,
  ADD CONSTRAINT `historial_de_compras_ibfk_2` FOREIGN KEY (`ID_usuario`) REFERENCES `usuarios` (`ID_usuario`);

--
-- Filtros para la tabla `metodos_pago`
--
ALTER TABLE `metodos_pago`
  ADD CONSTRAINT `metodos_pago_ibfk_1` FOREIGN KEY (`ID_usuario`) REFERENCES `usuarios` (`ID_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
