-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2022 at 01:55 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tis`
--

-- --------------------------------------------------------

--
-- Table structure for table `componentes`
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
-- Table structure for table `comunas`
--

CREATE TABLE `comunas` (
  `COD_INE_COM` int(11) NOT NULL,
  `COD_INE_PROV` int(11) DEFAULT NULL,
  `NOMBRE` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comunas`
--

INSERT INTO `comunas` (`COD_INE_COM`, `COD_INE_PROV`, `NOMBRE`) VALUES
(8101, 81, 'Concepcion');

-- --------------------------------------------------------

--
-- Table structure for table `departamentos`
--

CREATE TABLE `departamentos` (
  `ID_DEPARTAMENTO` int(11) NOT NULL,
  `ID_EDIFICIO` int(11) DEFAULT NULL,
  `NOMBRE_DEPARTAMENTO` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departamentos`
--

INSERT INTO `departamentos` (`ID_DEPARTAMENTO`, `ID_EDIFICIO`, `NOMBRE_DEPARTAMENTO`) VALUES
(1, 10, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `discos_internos`
--

CREATE TABLE `discos_internos` (
  `ID_COMPONENTE` int(11) NOT NULL,
  `CAPACIDAD` varchar(30) DEFAULT NULL,
  `ID_TIPO_DISCO` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `edificios`
--

CREATE TABLE `edificios` (
  `ID_EDIFICIO` int(11) NOT NULL,
  `ID` int(11) DEFAULT NULL,
  `COD_INE_COM` int(11) DEFAULT NULL,
  `NOMBRE_EDIFICIO` varchar(30) DEFAULT NULL,
  `TIPO_EDIFICIO` varchar(30) DEFAULT NULL,
  `ID_ORGANIZACIONES` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `edificios`
--

INSERT INTO `edificios` (`ID_EDIFICIO`, `ID`, `COD_INE_COM`, `NOMBRE_EDIFICIO`, `TIPO_EDIFICIO`, `ID_ORGANIZACIONES`) VALUES
(10, NULL, 8101, 'oficin ', ' oficina', 1);

-- --------------------------------------------------------

--
-- Table structure for table `equipos`
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

--
-- Dumping data for table `equipos`
--

INSERT INTO `equipos` (`ID_EQUIPO`, `ID_DEPARTAMENTO`, `RUT_FUNCIONARIO`, `NOMBRE_EQUIPO`, `FECHA_ADQUISICION`, `COSTO_ADQUISICION`, `CARACTERISTICAS_ADQUISICION`, `FORMA_ADQUISICION`) VALUES
(5, 1, 20511753, 'Equipo1', '2000-08-09', 100, 'lkjafg', 'lkjafg');

-- --------------------------------------------------------

--
-- Table structure for table `funcionarios`
--

CREATE TABLE `funcionarios` (
  `RUT_FUNCIONARIO` int(11) NOT NULL,
  `NOMBRE_FUNCIONARIO` varchar(30) DEFAULT NULL,
  `TIPO` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `funcionarios`
--

INSERT INTO `funcionarios` (`RUT_FUNCIONARIO`, `NOMBRE_FUNCIONARIO`, `TIPO`) VALUES
(20511753, 'Jose', 'tipo_1');

-- --------------------------------------------------------

--
-- Table structure for table `mantenciones`
--

CREATE TABLE `mantenciones` (
  `ID_MANTENCION` int(11) NOT NULL,
  `ID_EQUIPO` int(11) DEFAULT NULL,
  `NOMBRE_MANTENCION` varchar(30) DEFAULT NULL,
  `TIPO_MANTENCION` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mantenedores`
--

CREATE TABLE `mantenedores` (
  `RUT` varchar(12) NOT NULL,
  `NOMBRE` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `memorias_ram`
--

CREATE TABLE `memorias_ram` (
  `ID_COMPONENTE` int(11) NOT NULL,
  `VELOCIDAD_FRECUENCIA` varchar(30) DEFAULT NULL,
  `MEMORIA` varchar(30) DEFAULT NULL,
  `TECNOLOGIA` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `organizaciones`
--

CREATE TABLE `organizaciones` (
  `ID` int(11) NOT NULL,
  `NOMBRE_ORGANIZACION` varchar(30) DEFAULT NULL,
  `ID_TIPO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `organizaciones`
--

INSERT INTO `organizaciones` (`ID`, `NOMBRE_ORGANIZACION`, `ID_TIPO`) VALUES
(1, 'Municipalidad de Concepcion', 10);

-- --------------------------------------------------------

--
-- Table structure for table `placa_base`
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
-- Table structure for table `procesadores`
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
-- Table structure for table `provincia`
--

CREATE TABLE `provincia` (
  `COD_INE_PROV` int(11) NOT NULL,
  `COD_INE_REG` int(11) DEFAULT NULL,
  `NOMBRE` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `provincia`
--

INSERT INTO `provincia` (`COD_INE_PROV`, `COD_INE_REG`, `NOMBRE`) VALUES
(81, 8, 'Concepcion');

-- --------------------------------------------------------

--
-- Table structure for table `realiza`
--

CREATE TABLE `realiza` (
  `ID_MANTENCION` int(11) DEFAULT NULL,
  `RUT` varchar(12) DEFAULT NULL,
  `FECHA_MANTENCION` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `regiones`
--

CREATE TABLE `regiones` (
  `COD_INE_REG` int(11) NOT NULL,
  `NOMBRE` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `regiones`
--

INSERT INTO `regiones` (`COD_INE_REG`, `NOMBRE`) VALUES
(8, 'Bio-Bio');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_discos_internos`
--

CREATE TABLE `tipo_discos_internos` (
  `ID_TIPO_DISCO` varchar(30) NOT NULL,
  `NOMBRE_TIPO` varchar(30) DEFAULT NULL,
  `DESCRIPCION` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_organizacion`
--

CREATE TABLE `tipo_organizacion` (
  `ID_TIPO` int(11) NOT NULL,
  `NOMBRE` varchar(30) DEFAULT NULL,
  `DESCRIPCION` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tipo_organizacion`
--

INSERT INTO `tipo_organizacion` (`ID_TIPO`, `NOMBRE`, `DESCRIPCION`) VALUES
(10, 'Municipalidad', 'gafgadfg');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(200) NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `correo` varchar(500) NOT NULL,
  `contrasena` varchar(200) NOT NULL,
  `id_organizacion` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `contrasena`, `id_organizacion`) VALUES
(6, 'kevin', 'kevin@gmail.com', '2fe04e524ba40505a82e03a2819429cc', 1),
(7, 'david', 'david@gmail.com', '172522ec1028ab781d9dfd17eaca4427', 12),
(8, 'luis', 'luis@hotmail.com', '502ff82f7f1f8218dd41201fe4353687', 13),
(9, 'juan', 'juan@gmail.com', 'f5737d25829e95b9c234b7fa06af8736', 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `componentes`
--
ALTER TABLE `componentes`
  ADD PRIMARY KEY (`ID_COMPONENTE`),
  ADD KEY `FK_COMPUESTO2` (`ID_EQUIPO`);

--
-- Indexes for table `comunas`
--
ALTER TABLE `comunas`
  ADD PRIMARY KEY (`COD_INE_COM`),
  ADD KEY `FK_COMPONE2` (`COD_INE_PROV`);

--
-- Indexes for table `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`ID_DEPARTAMENTO`),
  ADD KEY `FK_TIENE2` (`ID_EDIFICIO`);

--
-- Indexes for table `discos_internos`
--
ALTER TABLE `discos_internos`
  ADD PRIMARY KEY (`ID_COMPONENTE`),
  ADD KEY `ID_TIPO_DISCO` (`ID_TIPO_DISCO`);

--
-- Indexes for table `edificios`
--
ALTER TABLE `edificios`
  ADD PRIMARY KEY (`ID_EDIFICIO`),
  ADD KEY `FK_CONTIENE` (`COD_INE_COM`),
  ADD KEY `FK_TIENE` (`ID`);

--
-- Indexes for table `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`ID_EQUIPO`),
  ADD KEY `FK_CONTIENE3` (`ID_DEPARTAMENTO`),
  ADD KEY `FK_REGISTRA` (`RUT_FUNCIONARIO`);

--
-- Indexes for table `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`RUT_FUNCIONARIO`);

--
-- Indexes for table `mantenciones`
--
ALTER TABLE `mantenciones`
  ADD PRIMARY KEY (`ID_MANTENCION`),
  ADD KEY `FK_REGISTRA2` (`ID_EQUIPO`);

--
-- Indexes for table `mantenedores`
--
ALTER TABLE `mantenedores`
  ADD PRIMARY KEY (`RUT`);

--
-- Indexes for table `memorias_ram`
--
ALTER TABLE `memorias_ram`
  ADD PRIMARY KEY (`ID_COMPONENTE`);

--
-- Indexes for table `organizaciones`
--
ALTER TABLE `organizaciones`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_TIPO` (`ID_TIPO`);

--
-- Indexes for table `placa_base`
--
ALTER TABLE `placa_base`
  ADD PRIMARY KEY (`ID_COMPONENTE`);

--
-- Indexes for table `procesadores`
--
ALTER TABLE `procesadores`
  ADD PRIMARY KEY (`ID_COMPONENTE`);

--
-- Indexes for table `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`COD_INE_PROV`),
  ADD KEY `FK_COMPONE` (`COD_INE_REG`);

--
-- Indexes for table `realiza`
--
ALTER TABLE `realiza`
  ADD KEY `FK_REALIZA` (`ID_MANTENCION`),
  ADD KEY `FK_REALIZA2` (`RUT`);

--
-- Indexes for table `regiones`
--
ALTER TABLE `regiones`
  ADD PRIMARY KEY (`COD_INE_REG`);

--
-- Indexes for table `tipo_discos_internos`
--
ALTER TABLE `tipo_discos_internos`
  ADD PRIMARY KEY (`ID_TIPO_DISCO`);

--
-- Indexes for table `tipo_organizacion`
--
ALTER TABLE `tipo_organizacion`
  ADD PRIMARY KEY (`ID_TIPO`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `componentes`
--
ALTER TABLE `componentes`
  MODIFY `ID_COMPONENTE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discos_internos`
--
ALTER TABLE `discos_internos`
  MODIFY `ID_COMPONENTE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `memorias_ram`
--
ALTER TABLE `memorias_ram`
  MODIFY `ID_COMPONENTE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `placa_base`
--
ALTER TABLE `placa_base`
  MODIFY `ID_COMPONENTE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `procesadores`
--
ALTER TABLE `procesadores`
  MODIFY `ID_COMPONENTE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `componentes`
--
ALTER TABLE `componentes`
  ADD CONSTRAINT `FK_COMPUESTO2` FOREIGN KEY (`ID_EQUIPO`) REFERENCES `equipos` (`ID_EQUIPO`);

--
-- Constraints for table `comunas`
--
ALTER TABLE `comunas`
  ADD CONSTRAINT `FK_COMPONE2` FOREIGN KEY (`COD_INE_PROV`) REFERENCES `provincia` (`COD_INE_PROV`);

--
-- Constraints for table `departamentos`
--
ALTER TABLE `departamentos`
  ADD CONSTRAINT `FK_TIENE2` FOREIGN KEY (`ID_EDIFICIO`) REFERENCES `edificios` (`ID_EDIFICIO`);

--
-- Constraints for table `discos_internos`
--
ALTER TABLE `discos_internos`
  ADD CONSTRAINT `discos_internos_ibfk_1` FOREIGN KEY (`ID_TIPO_DISCO`) REFERENCES `tipo_discos_internos` (`ID_TIPO_DISCO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `edificios`
--
ALTER TABLE `edificios`
  ADD CONSTRAINT `FK_CONTIENE` FOREIGN KEY (`COD_INE_COM`) REFERENCES `comunas` (`COD_INE_COM`),
  ADD CONSTRAINT `FK_TIENE` FOREIGN KEY (`ID`) REFERENCES `organizaciones` (`ID`);

--
-- Constraints for table `equipos`
--
ALTER TABLE `equipos`
  ADD CONSTRAINT `FK_CONTIENE3` FOREIGN KEY (`ID_DEPARTAMENTO`) REFERENCES `departamentos` (`ID_DEPARTAMENTO`),
  ADD CONSTRAINT `FK_REGISTRA` FOREIGN KEY (`RUT_FUNCIONARIO`) REFERENCES `funcionarios` (`RUT_FUNCIONARIO`);

--
-- Constraints for table `mantenciones`
--
ALTER TABLE `mantenciones`
  ADD CONSTRAINT `FK_REGISTRA2` FOREIGN KEY (`ID_EQUIPO`) REFERENCES `equipos` (`ID_EQUIPO`);

--
-- Constraints for table `memorias_ram`
--
ALTER TABLE `memorias_ram`
  ADD CONSTRAINT `memorias_ram_ibfk_1` FOREIGN KEY (`ID_COMPONENTE`) REFERENCES `componentes` (`ID_COMPONENTE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `organizaciones`
--
ALTER TABLE `organizaciones`
  ADD CONSTRAINT `organizaciones_ibfk_1` FOREIGN KEY (`ID_TIPO`) REFERENCES `tipo_organizacion` (`ID_TIPO`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `placa_base`
--
ALTER TABLE `placa_base`
  ADD CONSTRAINT `placa_base_ibfk_1` FOREIGN KEY (`ID_COMPONENTE`) REFERENCES `componentes` (`ID_COMPONENTE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `procesadores`
--
ALTER TABLE `procesadores`
  ADD CONSTRAINT `procesadores_ibfk_1` FOREIGN KEY (`ID_COMPONENTE`) REFERENCES `componentes` (`ID_COMPONENTE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `provincia`
--
ALTER TABLE `provincia`
  ADD CONSTRAINT `FK_COMPONE` FOREIGN KEY (`COD_INE_REG`) REFERENCES `regiones` (`COD_INE_REG`);

--
-- Constraints for table `realiza`
--
ALTER TABLE `realiza`
  ADD CONSTRAINT `FK_REALIZA` FOREIGN KEY (`ID_MANTENCION`) REFERENCES `mantenciones` (`ID_MANTENCION`),
  ADD CONSTRAINT `FK_REALIZA2` FOREIGN KEY (`RUT`) REFERENCES `mantenedores` (`RUT`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
