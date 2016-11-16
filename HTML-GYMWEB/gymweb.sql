-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2016 a las 16:54:14
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gymweb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE `actividad` (
  `idActividad` int(11) NOT NULL,
  `nomActividad` varchar(30) DEFAULT NULL,
  `totalPlazas` int(11) DEFAULT NULL,
  `descripAct` varchar(500) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `plazasOcupadas` int(11) DEFAULT NULL,
  `imagenAct` longblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`idActividad`, `nomActividad`, `totalPlazas`, `descripAct`, `fecha`, `plazasOcupadas`, `imagenAct`) VALUES
(2, 'Zumba', 40, 'Zumba es una disciplina fitness enfocada por una parte a mantener\r\nun cuerpo saludable y por otra a desarrollar,fortalecer y dar \r\nflexibilidad al cuerpo mediante movimientos de baile combinados\r\ncon una serie de rutinas aerÃ³bicas.\r\nEsta Actividad durarÃ¡ aproximadamente 50 minutos.', '2016-11-29 18:00:00', 0, 0x7a756d62612e6a7067),
(3, 'Aerobic', 15, 'sdsadasdasdasdasdsadfddfd', '2016-11-28 22:00:00', 0, 0x6165726f6269632e6a7067);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `idComentario` int(11) NOT NULL,
  `texto` varchar(500) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `TablaEjercicios_has_Usuario_TablaEjercicios_idTablaEjercicios` int(11) NOT NULL,
  `TablaEjercicios_has_Usuario_Usuario_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicio`
--

CREATE TABLE `ejercicio` (
  `idEjercicio` int(11) NOT NULL,
  `nomEjercicio` varchar(30) DEFAULT NULL,
  `descripEjerc` varchar(500) DEFAULT NULL,
  `tipoEjerc` varchar(30) DEFAULT NULL,
  `repeticiones` varchar(15) DEFAULT NULL,
  `carga` int(11) DEFAULT NULL,
  `imagen` longblob
) ENGINE=InnoDB DEFAULT CHARSET=big5;

--
-- Volcado de datos para la tabla `ejercicio`
--

INSERT INTO `ejercicio` (`idEjercicio`, `nomEjercicio`, `descripEjerc`, `tipoEjerc`, `repeticiones`, `carga`, `imagen`) VALUES
(1, 'Aperturas Mancuernas', 'Mira la IMAGEN.........jafsafoasdpfksdoakfposdafopasf', 'Pecho', '10-10-10-10', 10, 0x6170657274757261732d6d616e637565726e61732e706e67),
(2, 'Biceps Brazos Cruz', 'Mira la IMAGEN.........jafsafoasdpfksdoakfposdafopasf', 'Brazos', '10-10-10-10', 10, 0x6269636570732d6272617a6f732d6372757a2e706e67),
(3, 'Curl Concentrado', 'Mira la IMAGEN.........jafsafoasdpfksdoakfposdafopasf', 'Brazos', '10-10-10-8', 10, 0x6375726c2d636f6e63656e747261646f2e706e67),
(4, 'Dipping', 'Mira la IMAGEN.........jafsafoasdpfksdoakfposdafopasf', 'Brazos', '10-10-10-10', 0, 0x64697070696e67732e706e67),
(5, 'Dips Barra', 'Mira la IMAGEN.........jafsafoasdpfksdoakfposdafopasf', 'Pecho', '10-10-10-8', 0, 0x646970732d62617272612e706e67),
(6, 'Dominadas', 'Mira la IMAGEN.........jafsafoasdpfksdoakfposdafopasf', 'Espalda', '10-10-8-5', 0, 0x646f6d696e616461732e706e67),
(7, 'Flexiones', 'Mira la IMAGEN.........jafsafoasdpfksdoakfposdafopasf', 'Pecho', '10-10-10-10', 0, 0x666c6578696f6e65732e706e67);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicio_tablaejercicios`
--

CREATE TABLE `ejercicio_tablaejercicios` (
  `Ejercicio_idEjercicio` int(11) NOT NULL,
  `TablaEjercicios_idTablaEjercicios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion`
--

CREATE TABLE `notificacion` (
  `idNotificacion` int(11) NOT NULL,
  `texto` varchar(500) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `Actividad_idActividad` int(11) NOT NULL,
  `Usuario_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `idReserva` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `Usuario_idUsuario` int(11) NOT NULL,
  `Actividad_idActividad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tablaejercicios`
--

CREATE TABLE `tablaejercicios` (
  `idTablaEjercicios` int(11) NOT NULL,
  `nomTabla` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tablaejercicios_has_usuario`
--

CREATE TABLE `tablaejercicios_has_usuario` (
  `TablaEjercicios_idTablaEjercicios` int(11) NOT NULL,
  `Usuario_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nomUsuario` varchar(30) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `tipoUsuario` varchar(13) DEFAULT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `apellidos` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nomUsuario`, `password`, `email`, `tipoUsuario`, `nombre`, `apellidos`) VALUES
(3, 'Admin2', 'a906449d5769fa7361d7ecc6aa3f6d28', 'Admin2@Admin', 'Administrador', 'Admin2', '-'),
(4, 'drSelles', 'a906449d5769fa7361d7ecc6aa3f6d28', 'drselles@gmail.com', 'Entrenador', 'Diego', 'Selles'),
(5, 'antoportero', 'a906449d5769fa7361d7ecc6aa3f6d28', 'antoportero@gmail.com', 'Entrenador', 'Xose Antonio', 'Silva'),
(6, 'isgarcia', 'a906449d5769fa7361d7ecc6aa3f6d28', 'isg@gmail.com', 'DeportistaTDU', 'Ismael', 'Sierra'),
(7, 'mltallon', 'a906449d5769fa7361d7ecc6aa3f6d28', 'tallon@gmail.com', 'DeportistaPEF', 'Manuel', 'Lorenzo Tallon');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_actividad`
--

CREATE TABLE `usuario_actividad` (
  `Usuario_idUsuario` int(11) NOT NULL,
  `Actividad_idActividad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`idActividad`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`idComentario`),
  ADD KEY `fk_Comentario_TablaEjercicios_has_Usuario1_idx` (`TablaEjercicios_has_Usuario_TablaEjercicios_idTablaEjercicios`,`TablaEjercicios_has_Usuario_Usuario_idUsuario`);

--
-- Indices de la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  ADD PRIMARY KEY (`idEjercicio`);

--
-- Indices de la tabla `ejercicio_tablaejercicios`
--
ALTER TABLE `ejercicio_tablaejercicios`
  ADD PRIMARY KEY (`Ejercicio_idEjercicio`,`TablaEjercicios_idTablaEjercicios`),
  ADD KEY `fk_Ejercicio_has_TablaEjercicios_TablaEjercicios1_idx` (`TablaEjercicios_idTablaEjercicios`),
  ADD KEY `fk_Ejercicio_has_TablaEjercicios_Ejercicio1_idx` (`Ejercicio_idEjercicio`);

--
-- Indices de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD PRIMARY KEY (`idNotificacion`),
  ADD KEY `fk_Notificacion_Actividad1_idx` (`Actividad_idActividad`),
  ADD KEY `fk_Notificacion_Usuario1_idx` (`Usuario_idUsuario`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`idReserva`),
  ADD KEY `fk_Reserva_Usuario1_idx` (`Usuario_idUsuario`),
  ADD KEY `fk_Reserva_Actividad1_idx` (`Actividad_idActividad`);

--
-- Indices de la tabla `tablaejercicios`
--
ALTER TABLE `tablaejercicios`
  ADD PRIMARY KEY (`idTablaEjercicios`);

--
-- Indices de la tabla `tablaejercicios_has_usuario`
--
ALTER TABLE `tablaejercicios_has_usuario`
  ADD PRIMARY KEY (`TablaEjercicios_idTablaEjercicios`,`Usuario_idUsuario`),
  ADD KEY `fk_TablaEjercicios_has_Usuario_Usuario1_idx` (`Usuario_idUsuario`),
  ADD KEY `fk_TablaEjercicios_has_Usuario_TablaEjercicios1_idx` (`TablaEjercicios_idTablaEjercicios`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `usuario_actividad`
--
ALTER TABLE `usuario_actividad`
  ADD PRIMARY KEY (`Usuario_idUsuario`,`Actividad_idActividad`),
  ADD KEY `fk_Usuario_has_Actividad_Actividad1_idx` (`Actividad_idActividad`),
  ADD KEY `fk_Usuario_has_Actividad_Usuario1_idx` (`Usuario_idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividad`
--
ALTER TABLE `actividad`
  MODIFY `idActividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  MODIFY `idEjercicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  MODIFY `idNotificacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `idReserva` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tablaejercicios`
--
ALTER TABLE `tablaejercicios`
  MODIFY `idTablaEjercicios` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `fk_Comentario_TablaEjercicios_has_Usuario1` FOREIGN KEY (`TablaEjercicios_has_Usuario_TablaEjercicios_idTablaEjercicios`,`TablaEjercicios_has_Usuario_Usuario_idUsuario`) REFERENCES `tablaejercicios_has_usuario` (`TablaEjercicios_idTablaEjercicios`, `Usuario_idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ejercicio_tablaejercicios`
--
ALTER TABLE `ejercicio_tablaejercicios`
  ADD CONSTRAINT `fk_Ejercicio_has_TablaEjercicios_Ejercicio1` FOREIGN KEY (`Ejercicio_idEjercicio`) REFERENCES `ejercicio` (`idEjercicio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Ejercicio_has_TablaEjercicios_TablaEjercicios1` FOREIGN KEY (`TablaEjercicios_idTablaEjercicios`) REFERENCES `tablaejercicios` (`idTablaEjercicios`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD CONSTRAINT `fk_Notificacion_Actividad1` FOREIGN KEY (`Actividad_idActividad`) REFERENCES `actividad` (`idActividad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Notificacion_Usuario1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `fk_Reserva_Actividad1` FOREIGN KEY (`Actividad_idActividad`) REFERENCES `actividad` (`idActividad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Reserva_Usuario1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tablaejercicios_has_usuario`
--
ALTER TABLE `tablaejercicios_has_usuario`
  ADD CONSTRAINT `fk_TablaEjercicios_has_Usuario_TablaEjercicios1` FOREIGN KEY (`TablaEjercicios_idTablaEjercicios`) REFERENCES `tablaejercicios` (`idTablaEjercicios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TablaEjercicios_has_Usuario_Usuario1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_actividad`
--
ALTER TABLE `usuario_actividad`
  ADD CONSTRAINT `fk_Usuario_has_Actividad_Actividad1` FOREIGN KEY (`Actividad_idActividad`) REFERENCES `actividad` (`idActividad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Usuario_has_Actividad_Usuario1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
