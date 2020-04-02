-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-04-2020 a las 23:43:38
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sensoresparte2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conjuntodsensores`
--

CREATE TABLE `conjuntodsensores` (
  `idconjuntoDsensores` int(10) NOT NULL,
  `NombreDelConjunto` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lecturas`
--

CREATE TABLE `lecturas` (
  `idSensores` int(10) NOT NULL,
  `valor` int(30) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sensores`
--

CREATE TABLE `sensores` (
  `idSensores` int(11) NOT NULL,
  `idtipoDsensor` int(11) NOT NULL,
  `idconjuntoDsensores` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodsensor`
--

CREATE TABLE `tipodsensor` (
  `idtipoDsensor` int(10) NOT NULL,
  `tipo` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `conjuntodsensores`
--
ALTER TABLE `conjuntodsensores`
  ADD PRIMARY KEY (`idconjuntoDsensores`);

--
-- Indices de la tabla `lecturas`
--
ALTER TABLE `lecturas`
  ADD KEY `idSensores` (`idSensores`);

--
-- Indices de la tabla `sensores`
--
ALTER TABLE `sensores`
  ADD PRIMARY KEY (`idSensores`),
  ADD KEY `idtipoDsensor` (`idtipoDsensor`),
  ADD KEY `idconjuntoDsensores` (`idconjuntoDsensores`);

--
-- Indices de la tabla `tipodsensor`
--
ALTER TABLE `tipodsensor`
  ADD PRIMARY KEY (`idtipoDsensor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `conjuntodsensores`
--
ALTER TABLE `conjuntodsensores`
  MODIFY `idconjuntoDsensores` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sensores`
--
ALTER TABLE `sensores`
  MODIFY `idSensores` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipodsensor`
--
ALTER TABLE `tipodsensor`
  MODIFY `idtipoDsensor` int(10) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lecturas`
--
ALTER TABLE `lecturas`
  ADD CONSTRAINT `lecturas_ibfk_1` FOREIGN KEY (`idSensores`) REFERENCES `sensores` (`idSensores`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sensores`
--
ALTER TABLE `sensores`
  ADD CONSTRAINT `sensores_ibfk_1` FOREIGN KEY (`idconjuntoDsensores`) REFERENCES `conjuntodsensores` (`idconjuntoDsensores`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sensores_ibfk_2` FOREIGN KEY (`idtipoDsensor`) REFERENCES `tipodsensor` (`idtipoDsensor`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
