-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2022 a las 03:10:28
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `huevosjireth`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DATOSGRAFICO_BAR` ()   SELECT Producto, SUM(Total) FROM reservas WHERE Producto = 'Huevos Pequeños' AND Estado='Retirado'
UNION
SELECT Producto, SUM(Total) FROM reservas WHERE Producto = 'Huevos Medianos' AND Estado='Retirado'
UNION
SELECT Producto, SUM(Total) FROM reservas WHERE Producto = 'Huevos Triple A' AND Estado='Retirado'
UNION
SELECT Producto, SUM(Total) FROM reservas WHERE Producto = 'Huevos Doble Yema' AND Estado='Retirado'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DATOSGRAFICO_CANT` ()   SELECT Producto, SUM(Cantidad) FROM reservas WHERE Producto='Huevos Pequeños' AND Estado='Retirado'
UNION
SELECT Producto, SUM(Cantidad) FROM reservas WHERE Producto='Huevos Medianos' AND Estado='Retirado'
UNION
SELECT Producto, SUM(Cantidad) FROM reservas WHERE Producto='Huevos Triple A' AND Estado='Retirado'
UNION
SELECT Producto, SUM(Cantidad) FROM reservas WHERE Producto='Huevos Doble Yema' AND Estado='Retirado'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DATOSGRAFICO_MAS` ()   SELECT Producto, COUNT(Producto) FROM reservas WHERE Producto='Huevos Pequeños' AND Estado='Retirado'
UNION
SELECT Producto, COUNT(Producto) FROM reservas WHERE Producto='Huevos Medianos' AND Estado='Retirado'
UNION
SELECT Producto, COUNT(Producto) FROM reservas WHERE Producto='Huevos Triple A' AND Estado='Retirado'
UNION
SELECT Producto, COUNT(Producto) FROM reservas WHERE Producto='Huevos Doble Yema' AND Estado='Retirado'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DATOSGRAFICO_PARAMETRO_GANACIAS` (IN `FECHAINICIO` VARCHAR(10), IN `FECHAFIN` VARCHAR(10))   SELECT
productos.Producto,
SUM(reservas.Total) AS TOTALVENTAS
FROM
reservas
INNER JOIN productos ON reservas.Producto = productos.Producto
WHERE Estado = "Retirado" AND YEAR(reservas.Fecha) BETWEEN FECHAINICIO AND FECHAFIN
GROUP BY productos.idProducto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DATOSGRAFICO_PARAMETRO_UNIDADES` (IN `FECHAINICIO` VARCHAR(10), IN `FECHAFIN` VARCHAR(10))   SELECT
productos.Producto,
SUM(reservas.Cantidad) AS CANTIDAD
FROM
reservas 
INNER JOIN productos ON reservas.Producto = productos.Producto
WHERE Estado = "Retirado" AND YEAR(reservas.Fecha) BETWEEN FECHAINICIO AND FECHAFIN
GROUP BY productos.idProducto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DATOSGRAFICO_PARAMETRO_VENTAS` (IN `FECHAINICIO` VARCHAR(10), IN `FECHAFIN` VARCHAR(10))   SELECT
productos.Producto,
COUNT(reservas.Producto) AS PRODUCTO
FROM
reservas 
INNER JOIN productos ON reservas.Producto = productos.Producto
WHERE Estado = "Retirado" AND YEAR(reservas.Fecha) BETWEEN FECHAINICIO AND FECHAFIN
GROUP BY productos.idProducto$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `idMensaje` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Correo` varchar(30) NOT NULL,
  `Telefono` varchar(10) NOT NULL,
  `Mensaje` varchar(500) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idProducto` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Precio` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Descripcion` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `Nombre`, `Precio`, `Cantidad`, `Descripcion`) VALUES
(101, 'Huevos Pequeños', 10500, 47, 'Los huevos más pequeños, con el precio más barato y accesibles para nuestros clientes.'),
(202, 'Huevos Medianos', 15400, 48, 'Huevos de tamaño mediano, económicos con un precio razonable.'),
(303, 'Huevos Triple A', 18500, 46, 'El huevo más grande que vendemos, cuenta con una clara y yema más grande y alta proteína.'),
(404, 'Huevos Doble Yema', 22000, 50, 'Los huevos que contienen doble sorpresa por dentro, los más costosos y con mejor aceptación de nuestros clientes.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `idReserva` int(11) NOT NULL,
  `Cliente` varchar(50) NOT NULL,
  `Producto` varchar(50) NOT NULL,
  `Precio` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Total` int(11) GENERATED ALWAYS AS (`Precio` * `Cantidad`) VIRTUAL,
  `Fecha` date DEFAULT NULL,
  `Hora` time DEFAULT NULL,
  `Estado` varchar(15) NOT NULL DEFAULT 'Vigente',
  `idUsuario` int(11) DEFAULT NULL,
  `idProducto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`idReserva`, `Cliente`, `Producto`, `Precio`, `Cantidad`, `Fecha`, `Hora`, `Estado`, `idUsuario`, `idProducto`) VALUES
(1, 'llamoza', 'Huevos Pequeños', 10500, 1, '2022-10-18', '15:12:07', 'Retirado', NULL, NULL),
(2, 'llamoza', 'Huevos Medianos', 15400, 2, '2022-10-18', '15:26:39', 'Cancelado', NULL, NULL),
(3, 'jesus', 'Huevos Doble Yema', 22000, 4, '2022-10-18', '15:26:57', 'Vigente', NULL, NULL),
(4, 'jesus', 'Huevos Triple A', 18500, 3, '2022-10-18', '15:27:03', 'Cancelado', NULL, NULL),
(5, 'jesus', 'Huevos Medianos', 15400, 2, '2022-10-18', '15:27:11', 'Vigente', NULL, NULL),
(6, 'santiago', 'Huevos Pequeños', 10500, 2, '2022-10-18', '15:27:27', 'Retirado', NULL, NULL),
(7, 'santiago', 'Huevos Triple A', 18500, 2, '2022-10-18', '15:27:33', 'Vigente', NULL, NULL),
(8, 'yeison', 'Huevos Doble Yema', 22000, 5, '2022-10-18', '15:27:50', 'Cancelado', NULL, NULL),
(9, 'yeison', 'Huevos Triple A', 18500, 4, '2022-10-18', '15:27:57', 'Retirado', NULL, NULL),
(10, 'yeison', 'Huevos Medianos', 15400, 2, '2022-10-18', '15:28:04', 'Retirado', NULL, NULL),
(11, 'llamoza', 'Huevos Medianos', 15400, 3, '2022-10-19', '19:39:08', 'Cancelado', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idRol` int(11) NOT NULL,
  `Perfil` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRol`, `Perfil`) VALUES
(1, 'Administrador'),
(2, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Correo` varchar(30) NOT NULL,
  `Contraseña` varchar(150) NOT NULL,
  `idRol` int(11) DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `Nombre`, `Correo`, `Contraseña`, `idRol`) VALUES
(1, 'guzman', 'guzman@gmail.com', '82a844967e7a71871447348bea08c9226d4cc9f280f2ba5c383ec75ba997afa0c335275fa2b8eb41785613090d0357e82e1cc0e0cacaddd02197d70b40a4320c', 1),
(2, 'llamoza', 'llamoza@gmail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 2),
(3, 'jesus', 'jesus@gmail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 2),
(4, 'santiago', 'santiago@gmail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 2),
(5, 'yeison', 'yeison@gmail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`idMensaje`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idProducto`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`idReserva`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idProducto` (`idProducto`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `idRol` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `idMensaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `idReserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `fk_msg_user` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `fk_rsv_prd` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`),
  ADD CONSTRAINT `fk_rsv_user` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_user_rol` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
