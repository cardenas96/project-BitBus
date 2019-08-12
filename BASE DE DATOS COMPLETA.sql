-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-04-2018 a las 15:10:20
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bitbus`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autobus`
--

CREATE TABLE `autobus` (
  `idAutobus` int(11) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(15) NOT NULL,
  `capacidad` int(11) NOT NULL,
  `Estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `autobus`
--

INSERT INTO `autobus` (`idAutobus`, `marca`, `modelo`, `capacidad`, `Estado`) VALUES
(1, 'MERCEDES', 'M21 2015', 49, 1),
(2, 'AYCO', 'ATT 2007', 38, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boletos`
--

CREATE TABLE `boletos` (
  `idBoleto` varchar(50) NOT NULL,
  `idViaje` int(11) NOT NULL,
  `idTipo` int(11) NOT NULL,
  `dia` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `an` int(11) NOT NULL,
  `folio` varchar(15) NOT NULL,
  `noAsiento` int(11) NOT NULL,
  `importe` float NOT NULL,
  `iva` float NOT NULL,
  `descuento` float NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `boletos`
--

INSERT INTO `boletos` (`idBoleto`, `idViaje`, `idTipo`, `dia`, `mes`, `an`, `folio`, `noAsiento`, `importe`, `iva`, `descuento`, `total`) VALUES
('1', 1, 1, 20, 4, 20, '12309123135', 2, 15.5, 2.48, 0, 17.98),
('2', 1, 1, 20, 4, 20, '12309123136', 3, 15.5, 2.48, 0, 17.98),
('3', 1, 2, 20, 4, 20, '12309123137', 11, 15.5, 2.48, 4.495, 22.475),
('4', 1, 1, 20, 4, 20, '12309123135', 48, 15.5, 2.48, 0, 17.98),
('5', 1, 1, 20, 4, 20, '12309123136', 49, 15.5, 2.48, 0, 17.98),
('6', 1, 1, 23, 4, 20, '12309123135', 5, 15.5, 2.48, 0, 17.98),
('7', 1, 1, 23, 4, 20, '12309123136', 9, 15.5, 2.48, 0, 17.98);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `choferes`
--

CREATE TABLE `choferes` (
  `idChofer` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `direccion` varchar(30) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `fechaRegistro` date NOT NULL,
  `foto` varchar(200) NOT NULL,
  `vigenciaLicencia` date NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `choferes`
--

INSERT INTO `choferes` (`idChofer`, `nombre`, `direccion`, `telefono`, `fechaRegistro`, `foto`, `vigenciaLicencia`, `estado`) VALUES
(2, 'gerardo gomez', '16 de septiembre', '341439852', '2018-03-12', 'C:;Users;joaquin;Downloads;ANIMALS;panda.png', '2021-03-12', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleasiento`
--

CREATE TABLE `detalleasiento` (
  `idViaje` int(11) NOT NULL,
  `noAsiento` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalleasiento`
--

INSERT INTO `detalleasiento` (`idViaje`, `noAsiento`, `estado`) VALUES
(1, 1, 0),
(1, 2, 1),
(1, 3, 1),
(1, 4, 0),
(1, 5, 1),
(1, 6, 0),
(1, 7, 0),
(1, 8, 0),
(1, 9, 1),
(1, 10, 1),
(1, 11, 1),
(1, 12, 1),
(1, 13, 0),
(1, 14, 1),
(1, 15, 1),
(1, 16, 1),
(1, 17, 0),
(1, 18, 0),
(1, 19, 1),
(1, 20, 1),
(1, 21, 0),
(1, 22, 0),
(1, 23, 0),
(1, 24, 0),
(1, 25, 0),
(1, 26, 0),
(1, 27, 0),
(1, 28, 0),
(1, 29, 0),
(1, 30, 0),
(1, 31, 0),
(1, 32, 0),
(1, 33, 0),
(1, 34, 0),
(1, 35, 0),
(1, 36, 0),
(1, 37, 0),
(1, 38, 0),
(1, 39, 0),
(1, 40, 0),
(1, 41, 0),
(1, 42, 0),
(1, 43, 0),
(1, 44, 0),
(1, 45, 0),
(1, 46, 0),
(1, 47, 0),
(1, 48, 1),
(1, 49, 1),
(2, 1, 0),
(2, 2, 0),
(2, 3, 1),
(2, 4, 1),
(2, 5, 1),
(2, 6, 0),
(2, 7, 0),
(2, 8, 0),
(2, 9, 0),
(2, 10, 0),
(2, 11, 0),
(2, 12, 0),
(2, 13, 0),
(2, 14, 0),
(2, 15, 1),
(2, 16, 0),
(2, 17, 0),
(2, 18, 0),
(2, 19, 1),
(2, 20, 0),
(2, 21, 0),
(2, 22, 0),
(2, 23, 0),
(2, 24, 0),
(2, 25, 0),
(2, 26, 0),
(2, 27, 0),
(2, 28, 0),
(2, 29, 0),
(2, 30, 0),
(2, 31, 0),
(2, 32, 0),
(2, 33, 0),
(2, 34, 0),
(2, 35, 0),
(2, 36, 0),
(2, 37, 0),
(2, 38, 0),
(3, 1, 0),
(3, 2, 0),
(3, 3, 0),
(3, 4, 0),
(3, 5, 0),
(3, 6, 0),
(3, 7, 0),
(3, 8, 0),
(3, 9, 0),
(3, 10, 0),
(3, 11, 0),
(3, 12, 0),
(3, 13, 0),
(3, 14, 0),
(3, 15, 0),
(3, 16, 0),
(3, 17, 0),
(3, 18, 0),
(3, 19, 0),
(3, 20, 0),
(3, 21, 0),
(3, 22, 0),
(3, 23, 0),
(3, 24, 0),
(3, 25, 0),
(3, 26, 0),
(3, 27, 0),
(3, 28, 0),
(3, 29, 0),
(3, 30, 0),
(3, 31, 0),
(3, 32, 0),
(3, 33, 0),
(3, 34, 0),
(3, 35, 0),
(3, 36, 0),
(3, 37, 0),
(3, 38, 0),
(3, 39, 0),
(3, 40, 0),
(3, 41, 0),
(3, 42, 0),
(3, 43, 0),
(3, 44, 0),
(3, 45, 0),
(3, 46, 0),
(3, 47, 0),
(3, 48, 0),
(3, 49, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `idHora` int(11) NOT NULL,
  `idPoblacionO` int(11) NOT NULL,
  `idPoblacionD` int(11) NOT NULL,
  `hora` time NOT NULL,
  `dia` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `precioBoleto` float NOT NULL,
  `horaLlegada` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`idHora`, `idPoblacionO`, `idPoblacionD`, `hora`, `dia`, `estado`, `precioBoleto`, `horaLlegada`) VALUES
(1, 1, 2, '11:10:00', 1, 1, 15.5, '11:40:00'),
(2, 1, 2, '11:30:00', 1, 1, 15.5, '12:00:00'),
(3, 1, 2, '12:00:00', 1, 1, 15.5, '12:30:00'),
(4, 1, 2, '11:15:00', 2, 1, 15.5, '11:45:00'),
(5, 1, 2, '11:35:00', 2, 1, 15.5, '12:05:00'),
(6, 1, 2, '12:05:00', 2, 1, 15.5, '12:35:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poblaciones`
--

CREATE TABLE `poblaciones` (
  `idPoblacion` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `poblaciones`
--

INSERT INTO `poblaciones` (`idPoblacion`, `nombre`) VALUES
(1, 'zapotiltic'),
(2, 'Tuxpan'),
(3, 'Tamazula'),
(4, 'Ciudad Guzman');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopasajero`
--

CREATE TABLE `tipopasajero` (
  `idTipo` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL,
  `descuento` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipopasajero`
--

INSERT INTO `tipopasajero` (`idTipo`, `descripcion`, `descuento`) VALUES
(1, 'Normal', 0),
(2, 'Estudiante', 0.25),
(3, 'Mayor de edad', 0.5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `idRol` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(30) NOT NULL,
  `colonia` varchar(20) NOT NULL,
  `ciudad` varchar(20) NOT NULL,
  `cp` decimal(5,0) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `fechaRegistro` date NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contraseña` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `idRol`, `nombre`, `direccion`, `colonia`, `ciudad`, `cp`, `telefono`, `foto`, `fechaRegistro`, `correo`, `contraseña`) VALUES
(1, 1, 'gerardo gomez', '16 de septiembre', 'centro', 'guzman', '49070', '341439852', 'C:;Users;joaquin;Downloads;ANIMALS;mono.png', '2018-03-12', 'gerg@gmail.com', 'toluca');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajes`
--

CREATE TABLE `viajes` (
  `idViaje` int(11) NOT NULL,
  `idAutobus` int(11) NOT NULL,
  `idChofer` int(11) NOT NULL,
  `idHora` int(11) NOT NULL,
  `AsientosDisponibles` int(11) NOT NULL,
  `dia` int(10) NOT NULL,
  `mes` int(11) NOT NULL,
  `an` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `viajes`
--

INSERT INTO `viajes` (`idViaje`, `idAutobus`, `idChofer`, `idHora`, `AsientosDisponibles`, `dia`, `mes`, `an`) VALUES
(1, 1, 2, 1, 33, 23, 4, 2018),
(2, 2, 2, 2, 33, 23, 4, 2018),
(3, 1, 2, 3, 49, 23, 4, 2018);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autobus`
--
ALTER TABLE `autobus`
  ADD PRIMARY KEY (`idAutobus`);

--
-- Indices de la tabla `boletos`
--
ALTER TABLE `boletos`
  ADD PRIMARY KEY (`idBoleto`);

--
-- Indices de la tabla `choferes`
--
ALTER TABLE `choferes`
  ADD PRIMARY KEY (`idChofer`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`idHora`);

--
-- Indices de la tabla `poblaciones`
--
ALTER TABLE `poblaciones`
  ADD PRIMARY KEY (`idPoblacion`);

--
-- Indices de la tabla `tipopasajero`
--
ALTER TABLE `tipopasajero`
  ADD PRIMARY KEY (`idTipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `viajes`
--
ALTER TABLE `viajes`
  ADD PRIMARY KEY (`idViaje`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
