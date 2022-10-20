-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2022 a las 16:44:29
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
productos.Nombre,
SUM(reservas.Total) AS TOTALVENTAS
FROM
reservas
INNER JOIN productos ON reservas.Producto = productos.Nombre
WHERE Estado = "Retirado" AND YEAR(reservas.Fecha) BETWEEN FECHAINICIO AND FECHAFIN
GROUP BY productos.idProducto$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DATOSGRAFICO_PARAMETRO_UNIDADES` (IN `FECHAINICIO` VARCHAR(10), IN `FECHAFIN` VARCHAR(10))   SELECT
productos.Nombre,
SUM(reservas.Cantidad) AS CANTIDAD
FROM
reservas 
INNER JOIN productos ON reservas.Producto = productos.Nombre
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
(303, 'Huevos Triple A', 18500, 44, 'El huevo más grande que vendemos, cuenta con una clara y yema más grande y alta proteína.'),
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
(14, 'Santiago', 'Huevos Pequeños', 10500, 5, '2022-10-20', '09:07:17', 'Vigente', NULL, NULL),
(16, 'julio', 'Huevos Pequeños', 10500, 4, '2022-10-20', '09:19:35', 'Vigente', NULL, NULL),
(17, 'jesus', 'Huevos Pequeños', 10500, 3, '2022-10-20', '09:20:29', 'Cancelado', NULL, NULL),
(18, 'jesus', 'Huevos Pequeños', 10500, 3, '2022-10-20', '09:26:00', 'Vigente', NULL, NULL);

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
(5, 'yeison', 'yeison@gmail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 2),
(6, 'Andres Felipe Llamoza', 'andres.llamoza@misena.edu.co', 'a89d0f82c48766e4df072e1825efa8d44811126fce3a004f478905d650920ec3becadbc339eef0e3d33aec3a63278e2e22d7156760d40863b67348c5439e4c34', 1),
(7, 'Julio', 'juliocesar123456789@gmail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 2),
(9, 'Santiago', 'shernandez136@misena.edu.co', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 2),
(10, 'jesus', 'jesusmva@gmail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 2);

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
  MODIFY `idReserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
