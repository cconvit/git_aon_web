-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 14, 2014 at 03:11 PM
-- Server version: 5.6.12
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cotizador_aon`
--
CREATE DATABASE IF NOT EXISTS `cotizador_aon` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cotizador_aon`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_aseguradora`
--

CREATE TABLE IF NOT EXISTS `tbl_aseguradora` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `razon_social` varchar(200) NOT NULL,
  `logo_img` varchar(100) NOT NULL,
  `ut_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cr_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clasificacion`
--

CREATE TABLE IF NOT EXISTS `tbl_clasificacion` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_convenio_as` bigint(20) NOT NULL,
  `marca` varchar(60) NOT NULL,
  `modelo` varchar(60) NOT NULL,
  `clasificacion` varchar(10) NOT NULL,
  `tipo_carro` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_aseguradora` (`id_convenio_as`),
  KEY `tipo` (`tipo_carro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3478 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clasificacion_ma`
--

CREATE TABLE IF NOT EXISTS `tbl_clasificacion_ma` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_convenio_as` bigint(20) NOT NULL,
  `monto_min` double NOT NULL,
  `monto_max` double NOT NULL,
  `clasificacion` varchar(10) NOT NULL,
  `tipo_carro` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_convenio_as` (`id_convenio_as`,`tipo_carro`),
  KEY `tipo` (`tipo_carro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cliente`
--

CREATE TABLE IF NOT EXISTS `tbl_cliente` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `razon_social` varchar(100) NOT NULL,
  `estatus` tinyint(4) NOT NULL,
  `ut_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cr_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cob_as`
--

CREATE TABLE IF NOT EXISTS `tbl_cob_as` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `desc_cobertura` varchar(100) NOT NULL,
  `cr_time` datetime NOT NULL,
  `ut_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `tbl_cob_as`
--

INSERT INTO `tbl_cob_as` (`id`, `desc_cobertura`, `cr_time`, `ut_time`) VALUES
(1, 'COBERTURA AMPLIA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'COBERTURA P&Eacute;RDIDA TOTAL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'EVENTOS CATASTR&Oacute;FICOS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'INDEMNIZACI&Oacute;N DIARIA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'DA&Ntilde;OS A PERSONAS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'DA&Ntilde;OS A COSAS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'EXCESO DE L&Iacute;MITES', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'ASISTENCIA LEGAL Y DEFENSA PENAL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'MUERTE E INVALIDEZ PERMANENTE', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'GASTOS M&Eacute;DICOS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'GASTOS FUNERARIOS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'OFTALMOL&Oacute;GICO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'ODONTOL&Oacute;GICO', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'ASISTENCIA DOMICILIARIA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'ENFERMEDADES GRAVES', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'ODOF (ODONTOL&Oacute;GICO + DERMATOL&Oacute;GICO + OFTALMOL&Oacute;GICO)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'ASISTENCIA VIAL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'APIS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'EXTRA-PROTECCI&Oacute;N', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'Esto es todo', '2013-11-26 14:20:26', '2013-11-26 19:20:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_convenio_aseguradora`
--

CREATE TABLE IF NOT EXISTS `tbl_convenio_aseguradora` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_aseguradora` bigint(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `num_poliza` varchar(100) NOT NULL,
  `cr_time` datetime NOT NULL,
  `ut_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_aseguradora` (`id_aseguradora`),
  KEY `id_aseguradora_2` (`id_aseguradora`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cotizacion`
--

CREATE TABLE IF NOT EXISTS `tbl_cotizacion` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `id_cliente` bigint(20) NOT NULL,
  `id_flota` bigint(20) NOT NULL,
  `cr_time` datetime NOT NULL,
  `ut_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sexo` (`id_flota`),
  KEY `id_flota` (`id_flota`),
  KEY `id_cliente` (`id_cliente`,`id_flota`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cotizacion_carros`
--

CREATE TABLE IF NOT EXISTS `tbl_cotizacion_carros` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `asegurado` varchar(100) NOT NULL,
  `identificacion` varchar(50) NOT NULL,
  `edad` int(11) NOT NULL,
  `sexo` tinyint(4) NOT NULL,
  `estado_civil` tinyint(4) NOT NULL,
  `tipo_carro` tinyint(4) NOT NULL,
  `car_marca` varchar(60) NOT NULL,
  `car_modelo` varchar(60) NOT NULL,
  `car_ano` int(11) NOT NULL,
  `car_version` varchar(60) NOT NULL,
  `placa` varchar(20) NOT NULL,
  `car_ocupantes` tinyint(4) NOT NULL,
  `tipo_cobertura` tinyint(4) NOT NULL,
  `id_cotizacion` bigint(20) NOT NULL,
  `valor_INMA` double NOT NULL,
  `is_car_marca` tinyint(4) NOT NULL,
  `is_car_modelo` tinyint(4) NOT NULL,
  `is_car_ocupantes` tinyint(4) NOT NULL,
  `is_edad` tinyint(4) NOT NULL,
  `is_sexo` tinyint(4) NOT NULL,
  `is_estado_civil` tinyint(4) NOT NULL,
  `is_tipo_carros` tinyint(4) NOT NULL,
  `is_tipo_cobertura` tinyint(4) NOT NULL,
  `cr_time` datetime NOT NULL,
  `ut_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sexo` (`sexo`,`estado_civil`,`tipo_cobertura`,`id_cotizacion`),
  KEY `id_flota` (`id_cotizacion`),
  KEY `tipo_cobertura` (`tipo_cobertura`),
  KEY `estado_civil` (`estado_civil`),
  KEY `estado_civil_2` (`estado_civil`),
  KEY `tipo_carro` (`tipo_carro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_estado_civil`
--

CREATE TABLE IF NOT EXISTS `tbl_estado_civil` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_estado_civil`
--

INSERT INTO `tbl_estado_civil` (`id`, `descripcion`) VALUES
(1, 'Casado'),
(2, 'Diferente casado');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_flota`
--

CREATE TABLE IF NOT EXISTS `tbl_flota` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `empresa` varchar(40) NOT NULL,
  `porcentaje_INMA` double NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `avatar` varchar(40) NOT NULL,
  `cr_time` datetime NOT NULL,
  `ut_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grua`
--

CREATE TABLE IF NOT EXISTS `tbl_grua` (
  `id_convenio_as` bigint(20) NOT NULL,
  `id_tipo_carro` tinyint(4) NOT NULL,
  `ano` int(11) NOT NULL,
  `valor` double NOT NULL,
  PRIMARY KEY (`id_convenio_as`,`id_tipo_carro`,`ano`),
  KEY `id_tipo_carro` (`id_tipo_carro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grupo`
--

CREATE TABLE IF NOT EXISTS `tbl_grupo` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_grupo`
--

INSERT INTO `tbl_grupo` (`id`, `descripcion`) VALUES
(1, 'CASCO'),
(2, 'RESPONSABILIDAD CIVIL DE VEH&Iacute;CULOS'),
(3, 'ACCIDENTES PERSOANLES A OCUPANTES DE VEH&Iacute;CULO'),
(4, 'COBERTURAS ADICIONALES');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_parametros`
--

CREATE TABLE IF NOT EXISTS `tbl_parametros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  `valor` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_parametros`
--

INSERT INTO `tbl_parametros` (`id`, `descripcion`, `valor`) VALUES
(1, 'Unidad Tributaria', '107'),
(2, 'Año modelos nuevos', '2014');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_plantilla`
--

CREATE TABLE IF NOT EXISTS `tbl_plantilla` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_plantilla`
--

INSERT INTO `tbl_plantilla` (`id`, `descripcion`) VALUES
(1, 'Cobertura Amplia 01-32-34-8819 01-07-2013/2014'),
(2, 'Perdida Total 01-32-34-8819 01-07-2013/2014'),
(3, 'RCV 01-32-34-8819 01-07-2013/2014');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_plantilla_detalle`
--

CREATE TABLE IF NOT EXISTS `tbl_plantilla_detalle` (
  `id_plantilla` bigint(20) NOT NULL,
  `id_grupo` bigint(20) NOT NULL,
  `id_cobertura` bigint(20) NOT NULL,
  PRIMARY KEY (`id_plantilla`,`id_grupo`,`id_cobertura`),
  KEY `id_grupo` (`id_grupo`),
  KEY `id_cobertura` (`id_cobertura`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_plantilla_detalle`
--

INSERT INTO `tbl_plantilla_detalle` (`id_plantilla`, `id_grupo`, `id_cobertura`) VALUES
(1, 1, 1),
(1, 1, 3),
(1, 1, 4),
(2, 1, 2),
(2, 1, 3),
(2, 1, 4),
(1, 2, 5),
(1, 2, 6),
(1, 2, 7),
(1, 2, 8),
(2, 2, 5),
(2, 2, 6),
(2, 2, 7),
(2, 2, 8),
(3, 2, 5),
(3, 2, 6),
(3, 2, 7),
(3, 2, 8),
(1, 3, 9),
(1, 3, 10),
(1, 3, 11),
(2, 3, 9),
(2, 3, 10),
(2, 3, 11),
(3, 3, 9),
(3, 3, 10),
(3, 3, 11),
(1, 4, 12),
(1, 4, 13),
(1, 4, 14),
(1, 4, 15),
(1, 4, 17),
(1, 4, 18),
(1, 4, 19),
(2, 4, 12),
(2, 4, 13),
(2, 4, 14),
(2, 4, 15),
(2, 4, 17),
(2, 4, 18),
(2, 4, 19),
(3, 4, 12),
(3, 4, 13),
(3, 4, 14),
(3, 4, 15),
(3, 4, 17),
(3, 4, 18),
(3, 4, 19);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prima`
--

CREATE TABLE IF NOT EXISTS `tbl_prima` (
  `id_cotizacion` bigint(20) NOT NULL,
  `id_aseguradora` bigint(20) NOT NULL,
  `id_cob_as` bigint(20) NOT NULL,
  `prima` double NOT NULL,
  PRIMARY KEY (`id_cotizacion`,`id_aseguradora`,`id_cob_as`),
  KEY `id_aseguradora` (`id_aseguradora`),
  KEY `id_cob_as` (`id_cob_as`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_re_cot_ase`
--

CREATE TABLE IF NOT EXISTS `tbl_re_cot_ase` (
  `id_cotizacion` bigint(20) NOT NULL,
  `id_aseguradora` bigint(20) NOT NULL,
  `id_convenio` bigint(20) NOT NULL,
  `cr_time` datetime NOT NULL,
  `ut_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_cotizacion`,`id_aseguradora`,`id_convenio`),
  KEY `id_aseguradora` (`id_aseguradora`),
  KEY `id_convenio` (`id_convenio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_re_flota_co_as`
--

CREATE TABLE IF NOT EXISTS `tbl_re_flota_co_as` (
  `id_flota` bigint(20) NOT NULL,
  `id_aseguradora` bigint(20) NOT NULL,
  `id_convenio_as` bigint(20) NOT NULL,
  PRIMARY KEY (`id_flota`,`id_aseguradora`),
  KEY `id_convenio_as` (`id_convenio_as`),
  KEY `id_aseguradora` (`id_aseguradora`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_re_plantilla_flota`
--

CREATE TABLE IF NOT EXISTS `tbl_re_plantilla_flota` (
  `id_plantilla` bigint(20) NOT NULL,
  `id_flota` bigint(20) NOT NULL,
  `id_tipo_seguro` tinyint(20) NOT NULL,
  PRIMARY KEY (`id_plantilla`,`id_flota`,`id_tipo_seguro`),
  KEY `id_flota` (`id_flota`),
  KEY `id_tipo_seguro` (`id_tipo_seguro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_re_tipo_cob_as`
--

CREATE TABLE IF NOT EXISTS `tbl_re_tipo_cob_as` (
  `id_convenio_as` bigint(20) NOT NULL,
  `id_tipo_cob` tinyint(4) NOT NULL,
  `id_cob_as` bigint(20) NOT NULL,
  `id_tipo_carro` tinyint(4) NOT NULL,
  `tipo_calculo` tinyint(4) NOT NULL,
  `valor` double NOT NULL,
  `limite` double NOT NULL,
  `tasa` double NOT NULL,
  `incluida` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_convenio_as`,`id_tipo_cob`,`id_cob_as`,`id_tipo_carro`),
  KEY `id_cob_as` (`id_cob_as`),
  KEY `id_tipo_cob` (`id_tipo_cob`),
  KEY `tipo_calculo` (`tipo_calculo`),
  KEY `id_tipo_carro` (`id_tipo_carro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_segmentacion`
--

CREATE TABLE IF NOT EXISTS `tbl_segmentacion` (
  `id_convenio_as` bigint(20) NOT NULL,
  `id_estado_civil` tinyint(4) NOT NULL,
  `id_sexo` tinyint(4) NOT NULL,
  `edad` int(11) NOT NULL,
  `tasa` double NOT NULL,
  PRIMARY KEY (`id_convenio_as`,`id_estado_civil`,`id_sexo`,`edad`),
  KEY `id_estado_civil` (`id_estado_civil`),
  KEY `id_sexo` (`id_sexo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sexo`
--

CREATE TABLE IF NOT EXISTS `tbl_sexo` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_sexo`
--

INSERT INTO `tbl_sexo` (`id`, `descripcion`) VALUES
(1, 'FEMENINO'),
(2, 'MASCULINO');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tasa_casco`
--

CREATE TABLE IF NOT EXISTS `tbl_tasa_casco` (
  `id_convenio_as` bigint(20) NOT NULL,
  `id_tipo_co` tinyint(4) NOT NULL,
  `clasificacion` varchar(10) NOT NULL,
  `tipo_carro` tinyint(4) NOT NULL,
  `ano` int(11) NOT NULL,
  `tasa` double NOT NULL,
  PRIMARY KEY (`id_convenio_as`,`id_tipo_co`,`clasificacion`,`tipo_carro`,`ano`),
  KEY `id_tipo_co` (`id_tipo_co`),
  KEY `tipo_carro` (`tipo_carro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tipo_calculo`
--

CREATE TABLE IF NOT EXISTS `tbl_tipo_calculo` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  `calculo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_tipo_calculo`
--

INSERT INTO `tbl_tipo_calculo` (`id`, `descripcion`, `calculo`) VALUES
(1, 'Prima de casco', 'Suma Asegurada * Tasa Cobertura'),
(2, 'Suma asegurada', 'VALOR_INMA + (VALOR_INMA*%_INMA)'),
(3, 'RCV Basica', 'Valor * UT'),
(4, '	Valor * Prima Casco', 'Valor * Prima Casco'),
(5, 'Valor * (Suma Asegurada)', 'Valor * (Suma Asegurada)'),
(6, 'Valor * Num Ocupantes', 'Valor * Num Ocupantes'),
(7, 'Valor * RCV Basico', 'Valor * RCV Basico'),
(8, 'Valor', 'Valor'),
(9, 'Valor grua según año del vehículo', 'VALOR GRUA SEGUN EL AÑO DEL VEHICULO');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tipo_carro`
--

CREATE TABLE IF NOT EXISTS `tbl_tipo_carro` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_tipo_carro`
--

INSERT INTO `tbl_tipo_carro` (`id`, `descripcion`) VALUES
(1, 'PARTICULARES'),
(2, 'RUSTICOS'),
(3, 'PICK UP');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tipo_seguro`
--

CREATE TABLE IF NOT EXISTS `tbl_tipo_seguro` (
  `id` tinyint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_tipo_seguro`
--

INSERT INTO `tbl_tipo_seguro` (`id`, `nombre`) VALUES
(1, 'COBERTURA AMPLIA'),
(2, 'PERDIDA TOTAL'),
(3, 'RCV');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_clasificacion`
--
ALTER TABLE `tbl_clasificacion`
  ADD CONSTRAINT `tbl_clasificacion_ibfk_1` FOREIGN KEY (`id_convenio_as`) REFERENCES `tbl_convenio_aseguradora` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_clasificacion_ibfk_2` FOREIGN KEY (`tipo_carro`) REFERENCES `tbl_tipo_carro` (`id`);

--
-- Constraints for table `tbl_clasificacion_ma`
--
ALTER TABLE `tbl_clasificacion_ma`
  ADD CONSTRAINT `tbl_clasificacion_ma_ibfk_1` FOREIGN KEY (`id_convenio_as`) REFERENCES `tbl_convenio_aseguradora` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_clasificacion_ma_ibfk_2` FOREIGN KEY (`tipo_carro`) REFERENCES `tbl_tipo_carro` (`id`);

--
-- Constraints for table `tbl_convenio_aseguradora`
--
ALTER TABLE `tbl_convenio_aseguradora`
  ADD CONSTRAINT `tbl_convenio_aseguradora_ibfk_1` FOREIGN KEY (`id_aseguradora`) REFERENCES `tbl_aseguradora` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_cotizacion`
--
ALTER TABLE `tbl_cotizacion`
  ADD CONSTRAINT `tbl_cotizacion_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_cliente` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_cotizacion_ibfk_2` FOREIGN KEY (`id_flota`) REFERENCES `tbl_flota` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_cotizacion_carros`
--
ALTER TABLE `tbl_cotizacion_carros`
  ADD CONSTRAINT `tbl_cotizacion_carros_ibfk_1` FOREIGN KEY (`id_cotizacion`) REFERENCES `tbl_cotizacion` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_grua`
--
ALTER TABLE `tbl_grua`
  ADD CONSTRAINT `tbl_grua_ibfk_1` FOREIGN KEY (`id_convenio_as`) REFERENCES `tbl_convenio_aseguradora` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_grua_ibfk_2` FOREIGN KEY (`id_tipo_carro`) REFERENCES `tbl_tipo_carro` (`id`);

--
-- Constraints for table `tbl_plantilla_detalle`
--
ALTER TABLE `tbl_plantilla_detalle`
  ADD CONSTRAINT `tbl_plantilla_detalle_ibfk_1` FOREIGN KEY (`id_plantilla`) REFERENCES `tbl_plantilla` (`id`),
  ADD CONSTRAINT `tbl_plantilla_detalle_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `tbl_grupo` (`id`),
  ADD CONSTRAINT `tbl_plantilla_detalle_ibfk_3` FOREIGN KEY (`id_cobertura`) REFERENCES `tbl_cob_as` (`id`);

--
-- Constraints for table `tbl_prima`
--
ALTER TABLE `tbl_prima`
  ADD CONSTRAINT `tbl_prima_ibfk_3` FOREIGN KEY (`id_cob_as`) REFERENCES `tbl_cob_as` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_prima_ibfk_1` FOREIGN KEY (`id_cotizacion`) REFERENCES `tbl_cotizacion` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_prima_ibfk_2` FOREIGN KEY (`id_aseguradora`) REFERENCES `tbl_aseguradora` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_re_cot_ase`
--
ALTER TABLE `tbl_re_cot_ase`
  ADD CONSTRAINT `tbl_re_cot_ase_ibfk_3` FOREIGN KEY (`id_convenio`) REFERENCES `tbl_convenio_aseguradora` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_re_cot_ase_ibfk_1` FOREIGN KEY (`id_cotizacion`) REFERENCES `tbl_cotizacion` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_re_cot_ase_ibfk_2` FOREIGN KEY (`id_aseguradora`) REFERENCES `tbl_aseguradora` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_re_flota_co_as`
--
ALTER TABLE `tbl_re_flota_co_as`
  ADD CONSTRAINT `tbl_re_flota_co_as_ibfk_1` FOREIGN KEY (`id_flota`) REFERENCES `tbl_flota` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_re_flota_co_as_ibfk_2` FOREIGN KEY (`id_aseguradora`) REFERENCES `tbl_aseguradora` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_re_flota_co_as_ibfk_3` FOREIGN KEY (`id_convenio_as`) REFERENCES `tbl_convenio_aseguradora` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_re_plantilla_flota`
--
ALTER TABLE `tbl_re_plantilla_flota`
  ADD CONSTRAINT `tbl_re_plantilla_flota_ibfk_2` FOREIGN KEY (`id_flota`) REFERENCES `tbl_flota` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_re_plantilla_flota_ibfk_1` FOREIGN KEY (`id_plantilla`) REFERENCES `tbl_plantilla` (`id`),
  ADD CONSTRAINT `tbl_re_plantilla_flota_ibfk_3` FOREIGN KEY (`id_tipo_seguro`) REFERENCES `tbl_tipo_seguro` (`id`);

--
-- Constraints for table `tbl_re_tipo_cob_as`
--
ALTER TABLE `tbl_re_tipo_cob_as`
  ADD CONSTRAINT `tbl_re_tipo_cob_as_ibfk_3` FOREIGN KEY (`id_cob_as`) REFERENCES `tbl_cob_as` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_re_tipo_cob_as_ibfk_1` FOREIGN KEY (`id_convenio_as`) REFERENCES `tbl_convenio_aseguradora` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_re_tipo_cob_as_ibfk_4` FOREIGN KEY (`id_tipo_cob`) REFERENCES `tbl_tipo_seguro` (`id`),
  ADD CONSTRAINT `tbl_re_tipo_cob_as_ibfk_5` FOREIGN KEY (`tipo_calculo`) REFERENCES `tbl_tipo_calculo` (`id`),
  ADD CONSTRAINT `tbl_re_tipo_cob_as_ibfk_6` FOREIGN KEY (`id_tipo_carro`) REFERENCES `tbl_tipo_carro` (`id`);

--
-- Constraints for table `tbl_segmentacion`
--
ALTER TABLE `tbl_segmentacion`
  ADD CONSTRAINT `tbl_segmentacion_ibfk_1` FOREIGN KEY (`id_convenio_as`) REFERENCES `tbl_convenio_aseguradora` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_segmentacion_ibfk_2` FOREIGN KEY (`id_estado_civil`) REFERENCES `tbl_estado_civil` (`id`),
  ADD CONSTRAINT `tbl_segmentacion_ibfk_3` FOREIGN KEY (`id_sexo`) REFERENCES `tbl_sexo` (`id`);

--
-- Constraints for table `tbl_tasa_casco`
--
ALTER TABLE `tbl_tasa_casco`
  ADD CONSTRAINT `tbl_tasa_casco_ibfk_1` FOREIGN KEY (`id_convenio_as`) REFERENCES `tbl_convenio_aseguradora` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_tasa_casco_ibfk_2` FOREIGN KEY (`id_tipo_co`) REFERENCES `tbl_tipo_seguro` (`id`),
  ADD CONSTRAINT `tbl_tasa_casco_ibfk_3` FOREIGN KEY (`tipo_carro`) REFERENCES `tbl_tipo_carro` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
