-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-11-2022 a las 01:07:50
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tis`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `componentes`
--

CREATE TABLE `componentes` (
  `ID_COMPONENTE` int(11) NOT NULL,
  `ID_EQUIPO` int(11) DEFAULT NULL,
  `NOMBRE` varchar(30) DEFAULT NULL,
  `MARCA` varchar(30) DEFAULT NULL,
  `MODELO` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunas`
--

CREATE TABLE `comunas` (
  `COD_INE_COM` int(11) NOT NULL,
  `COD_INE_PROV` int(11) DEFAULT NULL,
  `NOMBRE` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `ID_DEPARTAMENTO` int(11) NOT NULL,
  `ID_EDIFICIO` int(11) DEFAULT NULL,
  `NOMBRE_EDIFICIO` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `discos_internos`
--

CREATE TABLE `discos_internos` (
  `ID_COMPONENTE` int(11) NOT NULL,
  `CAPACIDAD` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edificios`
--

CREATE TABLE `edificios` (
  `ID_EDIFICIO` int(11) NOT NULL,
  `ID` int(11) DEFAULT NULL,
  `COD_INE_COM` int(11) DEFAULT NULL,
  `NOMBRE_EDIFICIO` varchar(30) DEFAULT NULL,
  `TIPO_EDIFICIO` varchar(30) DEFAULT NULL,
  `ID_ORGANIZACIONES` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `ID_EQUIPO` int(11) NOT NULL,
  `ID_DEPARTAMENTO` int(11) DEFAULT NULL,
  `RUT_FUNCIONARIO` int(11) DEFAULT NULL,
  `NOMBRE_EQUIPO` varchar(30) DEFAULT NULL,
  `FECHA_ADQUISICION` date DEFAULT NULL,
  `COSTO_ADQUISICION` int(11) DEFAULT NULL,
  `CARACTERISTICAS_ADQUISICION` varchar(200) DEFAULT NULL,
  `FORMA_ADQUISICION` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionarios`
--

CREATE TABLE `funcionarios` (
  `RUT_FUNCIONARIO` int(11) NOT NULL,
  `NOMBRE_FUNCIONARIO` varchar(30) DEFAULT NULL,
  `TIPO` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenciones`
--

CREATE TABLE `mantenciones` (
  `ID_MANTENCION` int(11) NOT NULL,
  `ID_EQUIPO` int(11) DEFAULT NULL,
  `NOMBRE_MANTENCION` varchar(30) DEFAULT NULL,
  `TIPO_MANTENCION` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenedores`
--

CREATE TABLE `mantenedores` (
  `RUT` varchar(12) NOT NULL,
  `NOMBRE` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `memorias_ram`
--

CREATE TABLE `memorias_ram` (
  `ID_COMPONENTE` int(11) NOT NULL,
  `VELOCIDAD_FRECUENCIA` varchar(30) DEFAULT NULL,
  `MEMORIA` varchar(30) DEFAULT NULL,
  `TECNOLOGIA` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `organizaciones`
--

CREATE TABLE `organizaciones` (
  `ID` int(11) NOT NULL,
  `NOMBRE_ORGANIZACION` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `placa_base`
--

CREATE TABLE `placa_base` (
  `ID_COMPONENTE` int(11) NOT NULL,
  `FACTOR_DE_FORMA` varchar(30) DEFAULT NULL,
  `CPU_SOCKET` varchar(30) DEFAULT NULL,
  `SOPORTE_MEMORIA` varchar(30) DEFAULT NULL,
  `CARACTERISTICAS` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesadores`
--

CREATE TABLE `procesadores` (
  `ID_COMPONENTE` int(11) NOT NULL,
  `NUCLEOS` varchar(30) DEFAULT NULL,
  `SOCKET` varchar(30) DEFAULT NULL,
  `RELOJ_BASE` varchar(30) DEFAULT NULL,
  `HILOS` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `COD_INE_PROV` int(11) NOT NULL,
  `COD_INE_REG` int(11) DEFAULT NULL,
  `NOMBRE` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `realiza`
--

CREATE TABLE `realiza` (
  `ID_MANTENCION` int(11) DEFAULT NULL,
  `RUT` varchar(12) DEFAULT NULL,
  `FECHA_MANTENCION` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regiones`
--

CREATE TABLE `regiones` (
  `COD_INE_REG` int(11) NOT NULL,
  `NOMBRE` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_discos_internos`
--

CREATE TABLE `tipo_discos_internos` (
  `ID_TIPO_DISCO` varchar(30) NOT NULL,
  `NOMBRE_TIPO` varchar(30) DEFAULT NULL,
  `DESCRIPCION` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_organizacion`
--

CREATE TABLE `tipo_organizacion` (
  `ID_TIPO` int(11) NOT NULL,
  `ID` int(11) DEFAULT NULL,
  `NOMBRE` varchar(30) DEFAULT NULL,
  `DESCRIPCION` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(200) NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `correo` varchar(500) NOT NULL,
  `contrasena` varchar(200) NOT NULL,
  `id_organizacion` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `contrasena`, `id_organizacion`) VALUES
(6, 'kevin', 'kevin@gmail.com', '2fe04e524ba40505a82e03a2819429cc', 1),
(7, 'david', 'david@gmail.com', '172522ec1028ab781d9dfd17eaca4427', 12),
(8, 'luis', 'luis@hotmail.com', '502ff82f7f1f8218dd41201fe4353687', 13),
(9, 'juan', 'juan@gmail.com', 'f5737d25829e95b9c234b7fa06af8736', 12);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `componentes`
--
ALTER TABLE `componentes`
  ADD PRIMARY KEY (`ID_COMPONENTE`),
  ADD KEY `FK_COMPUESTO2` (`ID_EQUIPO`);

--
-- Indices de la tabla `comunas`
--
ALTER TABLE `comunas`
  ADD PRIMARY KEY (`COD_INE_COM`),
  ADD KEY `FK_COMPONE2` (`COD_INE_PROV`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`ID_DEPARTAMENTO`),
  ADD KEY `FK_TIENE2` (`ID_EDIFICIO`);

--
-- Indices de la tabla `discos_internos`
--
ALTER TABLE `discos_internos`
  ADD PRIMARY KEY (`ID_COMPONENTE`);

--
-- Indices de la tabla `edificios`
--
ALTER TABLE `edificios`
  ADD PRIMARY KEY (`ID_EDIFICIO`),
  ADD KEY `FK_CONTIENE` (`COD_INE_COM`),
  ADD KEY `FK_TIENE` (`ID`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`ID_EQUIPO`),
  ADD KEY `FK_CONTIENE3` (`ID_DEPARTAMENTO`),
  ADD KEY `FK_REGISTRA` (`RUT_FUNCIONARIO`);

--
-- Indices de la tabla `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`RUT_FUNCIONARIO`);

--
-- Indices de la tabla `mantenciones`
--
ALTER TABLE `mantenciones`
  ADD PRIMARY KEY (`ID_MANTENCION`),
  ADD KEY `FK_REGISTRA2` (`ID_EQUIPO`);

--
-- Indices de la tabla `mantenedores`
--
ALTER TABLE `mantenedores`
  ADD PRIMARY KEY (`RUT`);

--
-- Indices de la tabla `memorias_ram`
--
ALTER TABLE `memorias_ram`
  ADD PRIMARY KEY (`ID_COMPONENTE`);

--
-- Indices de la tabla `organizaciones`
--
ALTER TABLE `organizaciones`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `placa_base`
--
ALTER TABLE `placa_base`
  ADD PRIMARY KEY (`ID_COMPONENTE`);

--
-- Indices de la tabla `procesadores`
--
ALTER TABLE `procesadores`
  ADD PRIMARY KEY (`ID_COMPONENTE`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`COD_INE_PROV`),
  ADD KEY `FK_COMPONE` (`COD_INE_REG`);

--
-- Indices de la tabla `realiza`
--
ALTER TABLE `realiza`
  ADD KEY `FK_REALIZA` (`ID_MANTENCION`),
  ADD KEY `FK_REALIZA2` (`RUT`);

--
-- Indices de la tabla `regiones`
--
ALTER TABLE `regiones`
  ADD PRIMARY KEY (`COD_INE_REG`);

--
-- Indices de la tabla `tipo_discos_internos`
--
ALTER TABLE `tipo_discos_internos`
  ADD PRIMARY KEY (`ID_TIPO_DISCO`);

--
-- Indices de la tabla `tipo_organizacion`
--
ALTER TABLE `tipo_organizacion`
  ADD PRIMARY KEY (`ID_TIPO`),
  ADD KEY `FK_COMPONE3` (`ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `componentes`
--
ALTER TABLE `componentes`
  MODIFY `ID_COMPONENTE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `discos_internos`
--
ALTER TABLE `discos_internos`
  MODIFY `ID_COMPONENTE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `memorias_ram`
--
ALTER TABLE `memorias_ram`
  MODIFY `ID_COMPONENTE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `placa_base`
--
ALTER TABLE `placa_base`
  MODIFY `ID_COMPONENTE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `procesadores`
--
ALTER TABLE `procesadores`
  MODIFY `ID_COMPONENTE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `componentes`
--
ALTER TABLE `componentes`
  ADD CONSTRAINT `FK_COMPUESTO2` FOREIGN KEY (`ID_EQUIPO`) REFERENCES `equipos` (`ID_EQUIPO`);

--
-- Filtros para la tabla `comunas`
--
ALTER TABLE `comunas`
  ADD CONSTRAINT `FK_COMPONE2` FOREIGN KEY (`COD_INE_PROV`) REFERENCES `provincia` (`COD_INE_PROV`);

--
-- Filtros para la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD CONSTRAINT `FK_TIENE2` FOREIGN KEY (`ID_EDIFICIO`) REFERENCES `edificios` (`ID_EDIFICIO`);

--
-- Filtros para la tabla `edificios`
--
ALTER TABLE `edificios`
  ADD CONSTRAINT `FK_CONTIENE` FOREIGN KEY (`COD_INE_COM`) REFERENCES `comunas` (`COD_INE_COM`),
  ADD CONSTRAINT `FK_TIENE` FOREIGN KEY (`ID`) REFERENCES `organizaciones` (`ID`);

--
-- Filtros para la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD CONSTRAINT `FK_CONTIENE3` FOREIGN KEY (`ID_DEPARTAMENTO`) REFERENCES `departamentos` (`ID_DEPARTAMENTO`),
  ADD CONSTRAINT `FK_REGISTRA` FOREIGN KEY (`RUT_FUNCIONARIO`) REFERENCES `funcionarios` (`RUT_FUNCIONARIO`);

--
-- Filtros para la tabla `mantenciones`
--
ALTER TABLE `mantenciones`
  ADD CONSTRAINT `FK_REGISTRA2` FOREIGN KEY (`ID_EQUIPO`) REFERENCES `equipos` (`ID_EQUIPO`);

--
-- Filtros para la tabla `memorias_ram`
--
ALTER TABLE `memorias_ram`
  ADD CONSTRAINT `memorias_ram_ibfk_1` FOREIGN KEY (`ID_COMPONENTE`) REFERENCES `componentes` (`ID_COMPONENTE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `placa_base`
--
ALTER TABLE `placa_base`
  ADD CONSTRAINT `placa_base_ibfk_1` FOREIGN KEY (`ID_COMPONENTE`) REFERENCES `componentes` (`ID_COMPONENTE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `procesadores`
--
ALTER TABLE `procesadores`
  ADD CONSTRAINT `procesadores_ibfk_1` FOREIGN KEY (`ID_COMPONENTE`) REFERENCES `componentes` (`ID_COMPONENTE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD CONSTRAINT `FK_COMPONE` FOREIGN KEY (`COD_INE_REG`) REFERENCES `regiones` (`COD_INE_REG`);

--
-- Filtros para la tabla `realiza`
--
ALTER TABLE `realiza`
  ADD CONSTRAINT `FK_REALIZA` FOREIGN KEY (`ID_MANTENCION`) REFERENCES `mantenciones` (`ID_MANTENCION`),
  ADD CONSTRAINT `FK_REALIZA2` FOREIGN KEY (`RUT`) REFERENCES `mantenedores` (`RUT`);

--
-- Filtros para la tabla `tipo_organizacion`
--
ALTER TABLE `tipo_organizacion`
  ADD CONSTRAINT `FK_COMPONE3` FOREIGN KEY (`ID`) REFERENCES `organizaciones` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
