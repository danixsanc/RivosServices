-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 13-10-2016 a las 17:37:43
-- Versión del servidor: 5.6.26-74.0-log
-- Versión de PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `yozzizql_Rivos_Taxi_TEST`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Admin`
--

CREATE TABLE IF NOT EXISTS `Admin` (
  `Admin_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Company` varchar(45) NOT NULL,
  `FirstName` varchar(45) NOT NULL,
  `LastName` varchar(45) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `Salt` varchar(45) NOT NULL,
  `Create_At` varchar(45) NOT NULL,
  `Image` blob,
  `AdminActv_Id` int(11) NOT NULL,
  `AdminType_Id` int(11) NOT NULL,
  `AdminAddressId` int(11) NOT NULL,
  `AdminBy_Id` int(11) DEFAULT NULL,
  PRIMARY KEY (`Admin_Id`),
  KEY `fk_Admin_AdminActv1_idx` (`AdminActv_Id`),
  KEY `fk_Admin_AdminType1_idx` (`AdminType_Id`),
  KEY `fk_Admin_AdminAddress1_idx` (`AdminAddressId`),
  KEY `fk_Admin_Admin1_idx` (`AdminBy_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `Admin`
--

INSERT INTO `Admin` (`Admin_Id`, `Company`, `FirstName`, `LastName`, `Phone`, `Email`, `Password`, `Salt`, `Create_At`, `Image`, `AdminActv_Id`, `AdminType_Id`, `AdminAddressId`, `AdminBy_Id`) VALUES
(1, 'Taxis Toro', 'Daniel', 'Sanchez', '6672010101', 'dannys219@gmail.com', 'SGoiTLCKiaL04sex2Ip/e7VaD5o5ZWQzMWUyYTcy', '9ed31e2a72', '01-01-16', '', 1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AdminActv`
--

CREATE TABLE IF NOT EXISTS `AdminActv` (
  `AdminActv_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(45) NOT NULL,
  PRIMARY KEY (`AdminActv_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `AdminActv`
--

INSERT INTO `AdminActv` (`AdminActv_Id`, `Description`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AdminAddress`
--

CREATE TABLE IF NOT EXISTS `AdminAddress` (
  `AdminAddressId` int(11) NOT NULL AUTO_INCREMENT,
  `Colony_Id` int(11) NOT NULL,
  `NoExt` int(11) NOT NULL,
  `NoInt` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`AdminAddressId`),
  KEY `fk_AdminAddress_Colony1_idx` (`Colony_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `AdminAddress`
--

INSERT INTO `AdminAddress` (`AdminAddressId`, `Colony_Id`, `NoExt`, `NoInt`) VALUES
(1, 2, 1200, 'B');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AdminType`
--

CREATE TABLE IF NOT EXISTS `AdminType` (
  `AdminType_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(45) NOT NULL,
  PRIMARY KEY (`AdminType_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `AdminType`
--

INSERT INTO `AdminType` (`AdminType_Id`, `Description`) VALUES
(1, 'Normal'),
(2, 'Aeropuerto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cabbie`
--

CREATE TABLE IF NOT EXISTS `Cabbie` (
  `Cabbie_Id` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(45) NOT NULL,
  `LastName` varchar(45) NOT NULL,
  `Phone` varchar(45) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Salt` varchar(30) NOT NULL,
  `Gcm_Id` varchar(200) NOT NULL,
  `Admin_Id` int(11) NOT NULL,
  `Cabbie_Status_Id` int(11) NOT NULL,
  `Date_Selection` datetime DEFAULT NULL,
  `CabbieActv_Id` int(11) NOT NULL,
  `PaymentSystem_Id` int(11) NOT NULL,
  `User_Type_Id` int(11) NOT NULL,
  PRIMARY KEY (`Cabbie_Id`),
  KEY `fk_Cabbie_Admin1_idx` (`Admin_Id`),
  KEY `fk_Cabbie_Cabbie_Status1_idx` (`Cabbie_Status_Id`),
  KEY `fk_Cabbie_CabbieActv1_idx` (`CabbieActv_Id`),
  KEY `fk_Cabbie_PaymentSystem1_idx` (`PaymentSystem_Id`),
  KEY `fk_Cabbie_User_Type1_idx` (`User_Type_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `Cabbie`
--

INSERT INTO `Cabbie` (`Cabbie_Id`, `FirstName`, `LastName`, `Phone`, `Email`, `Password`, `Salt`, `Gcm_Id`, `Admin_Id`, `Cabbie_Status_Id`, `Date_Selection`, `CabbieActv_Id`, `PaymentSystem_Id`, `User_Type_Id`) VALUES
(1, 'Raul', 'Cardenas', '6672010101', 'd@g.com', 'SGoiTLCKiaL04sex2Ip/e7VaD5o5ZWQzMWUyYTcy', '9ed31e2a72', 'APA_', 1, 1, '0000-00-00 00:00:00', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CabbieActv`
--

CREATE TABLE IF NOT EXISTS `CabbieActv` (
  `CabbieActv_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(45) NOT NULL,
  PRIMARY KEY (`CabbieActv_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `CabbieActv`
--

INSERT INTO `CabbieActv` (`CabbieActv_Id`, `Description`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CabbieDetail`
--

CREATE TABLE IF NOT EXISTS `CabbieDetail` (
  `CabbieDetail_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Schedule_In` time(1) NOT NULL,
  `Schedule_Out` time(1) NOT NULL,
  `Image` blob NOT NULL,
  `Contract` varchar(45) NOT NULL,
  `Cabbie_Id` int(11) NOT NULL,
  `Car_Id` int(11) NOT NULL,
  PRIMARY KEY (`CabbieDetail_Id`),
  KEY `fk_CabbieDetail_Cabbie1_idx` (`Cabbie_Id`),
  KEY `fk_CabbieDetail_CarModel1_idx` (`Car_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cabbie_Status`
--

CREATE TABLE IF NOT EXISTS `Cabbie_Status` (
  `Cabbie_Status_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(45) NOT NULL,
  PRIMARY KEY (`Cabbie_Status_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `Cabbie_Status`
--

INSERT INTO `Cabbie_Status` (`Cabbie_Status_Id`, `Description`) VALUES
(1, 'Desocupado'),
(2, 'Ocupado'),
(3, 'Seleccionado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CarBrand`
--

CREATE TABLE IF NOT EXISTS `CarBrand` (
  `CarBrand_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Brand` varchar(45) NOT NULL,
  PRIMARY KEY (`CarBrand_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Card`
--

CREATE TABLE IF NOT EXISTS `Card` (
  `Card_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Conekta_Card` varchar(45) NOT NULL,
  `Client_Id` int(11) NOT NULL,
  PRIMARY KEY (`Card_Id`),
  KEY `fk_Card_Client2_idx` (`Client_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `Card`
--

INSERT INTO `Card` (`Card_Id`, `Conekta_Card`, `Client_Id`) VALUES
(4, 'card_XjgpG7LDYYzrb3i7', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CarModel`
--

CREATE TABLE IF NOT EXISTS `CarModel` (
  `Car_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Model` varchar(45) NOT NULL,
  `CarBrand_Id` int(11) NOT NULL,
  PRIMARY KEY (`Car_Id`),
  KEY `fk_CarModel_CarBrand1_idx` (`CarBrand_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Client`
--

CREATE TABLE IF NOT EXISTS `Client` (
  `Client_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Conekta_Id` varchar(45) DEFAULT NULL,
  `FirstName` varchar(45) NOT NULL,
  `LastName` varchar(45) NOT NULL,
  `Phone` varchar(10) DEFAULT NULL,
  `Email` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `Salt` varchar(45) NOT NULL,
  `Gcm_Id` varchar(200) NOT NULL,
  `Created_At` datetime NOT NULL,
  `User_Type_Id` int(11) NOT NULL,
  `ClientActv_Id` int(11) NOT NULL,
  `Image` blob,
  PRIMARY KEY (`Client_Id`),
  KEY `fk_Client_Client_Type1_idx` (`User_Type_Id`),
  KEY `fk_Client_ClienteActv1_idx` (`ClientActv_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Volcado de datos para la tabla `Client`
--

INSERT INTO `Client` (`Client_Id`, `Conekta_Id`, `FirstName`, `LastName`, `Phone`, `Email`, `Password`, `Salt`, `Gcm_Id`, `Created_At`, `User_Type_Id`, `ClientActv_Id`, `Image`) VALUES
(1, 'A', 'Daniel', 'Sanchez', '6672010101', 'dannys219@gmail.com', 'SGoiTLCKiaL04sex2Ip/e7VaD5o5ZWQzMWUyYTcy', '9ed31e2a72', 'APA_', '2016-09-29 11:33:38', 1, 1, NULL),
(2, 'cus_nRUM1kikLsvAXhobw', 'Prueba', 'Prueba', '6672010100', 'p@g.com', 's329pMT6RNFp8HNljK+TLZgSiYI4ZDlhNWFlMmQw', '8d9a5ae2d0', 'APA_', '2016-09-24 04:32:37', 1, 1, NULL),
(19, 'cus_5zjSAwMH99VQvTh4k', 'Daniel', 'Sanchez', '6672010888', 'aaa@hotmail.com', 'iy48BCvbpOeshEMZYgRgndLNgNg2ZTZkN2RhMTFj', '6e6d7da11c', 'APA91bFeW_LhL0gMJRrLssisKj1jHfxEE04hVqd-AF3sdUE5gTdoMS5KdYxLl0haGCrXfMsUWUYy7BQ9fubVI4m0d48XV2OimcIV9NZWqyg9Gl35ZTfTG3Txwp77-rs-UElMGe2C6jCS', '2016-09-24 20:22:15', 1, 1, NULL),
(20, 'cus_1xmX2u1xdnpLFKQ4E', 'Ramon', 'QuiÃ±onez Castro', '6673412518', 'r_fut@hotmail.com', 'UgZ4lb1NCRH7Xr/9SI0lKhJebuY5M2Y2NzE1NGQx', '93f67154d1', 'APA_ASDOWJDPOJQD345345234rqrwew3r', '2016-09-25 04:23:05', 1, 1, NULL),
(27, 'cus_27SZnW48hGGmBbksA', 'Daniel', 'Sanchez', '6672010886', 'd.ani.loko@hotmail.com', '+zH9mlN3Q47fk+woEDKxX5W2K1ExMDdkZjc4NGI5', '107df784b9', 'APA91bFeW_LhL0gMJRrLssisKj1jHfxEE04hVqd-AF3sdUE5gTdoMS5KdYxLl0haGCrXfMsUWUYy7BQ9fubVI4m0d48XV2OimcIV9NZWqyg9Gl35ZTfTG3Txwp77-rs-UElMGe2C6jCS', '2016-09-28 16:45:38', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ClientActv`
--

CREATE TABLE IF NOT EXISTS `ClientActv` (
  `ClientActv_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(45) NOT NULL,
  PRIMARY KEY (`ClientActv_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `ClientActv`
--

INSERT INTO `ClientActv` (`ClientActv_Id`, `Description`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Colony`
--

CREATE TABLE IF NOT EXISTS `Colony` (
  `Colony_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(45) NOT NULL,
  `Latitude` varchar(100) NOT NULL,
  `Longitude` varchar(100) NOT NULL,
  `Town_Id` int(11) NOT NULL,
  PRIMARY KEY (`Colony_Id`),
  KEY `fk_Colony_Town1_idx` (`Town_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=388 ;

--
-- Volcado de datos para la tabla `Colony`
--

INSERT INTO `Colony` (`Colony_Id`, `Description`, `Latitude`, `Longitude`, `Town_Id`) VALUES
(1, 'Desconocido', '0', '0', 1),
(2, '10 de Abril', '24.837000', '-107.411159', 1),
(3, '10 de Mayo', '24.781578', '-107.378663', 1),
(4, '12 de Diciembre', '24.757582', '-107.376665', 1),
(5, '16 de Septiembre', '24.847850', '-107.381783', 1),
(6, ' 21 de Marzo', '24.780743', '-107.363681', 1),
(7, '22 de Diciembre', '24.758060', '-107.389077', 1),
(8, '3 Rios', '24.819621', '-107.404052', 1),
(9, '4 de Marzo', '24.811549', '-107.427554', 1),
(10, '5 de Febrero', '24.790397', '-107.349054', 1),
(11, '5 de Mayo', '24.794369', '-107.378230', 1),
(12, '6 de Enero', '24.841072', '-107.391583', 1),
(13, '7 Gotas', '24.796389', '-107.348954', 1),
(14, ' 8 de Febrero', '24.758436', '-107.378442', 1),
(15, 'Acueducto', '24.818155', '-107.443891', 1),
(16, 'Acueducto III', '24.819879', '-107.442353', 1),
(17, 'Adolfo Lopez Mateos', '24.766540', '-107.403904', 1),
(18, 'Adolfo Ruiz Cortinez', '24.760122', '-107.427965', 1),
(19, 'Aeropuerto', '24.764653', '-107.477222', 1),
(20, 'Agrarista Mexicana', '24.831166', '-107.373883', 1),
(21, 'Agustina Ramirez', '24.832436', '-107.421355', 1),
(22, 'Alameda', '24.828013', '-107.398670', 1),
(23, 'Alegranza', '24.838046', '-107.414671', 1),
(24, 'Almacenes Zaragoza S.A.', '24.811317', '-107.398377', 1),
(25, 'Altos Bacurimi', '24.811123', '-107.441804', 1),
(26, 'Amado Nervo', '24.771439', '-107.391729', 1),
(27, 'Ampliacion El Barrio', '24.803725', '-107.331691', 1),
(28, 'Antonio Nakayama', '24.751535', '-107.423170', 1),
(29, 'Antonio Rosales', '24.796551', '-107.384661', 1),
(30, 'Antonio Toledo Corro', '24.762054', '-107.373723', 1),
(31, 'Aquiles Serdan', '24.769094', '-107.413857', 1),
(32, 'Arboledas', '24.838388', '-107.395025', 1),
(33, 'Aurora', '24.809311', '-107.370267', 1),
(34, 'Azaleas Residencial', '24.819941', '-107.433723', 1),
(35, 'Bachigualato', '24.773112', '-107.461606', 1),
(36, 'Balcones Del Humaya', '24.839228', '-107.423125', 1),
(37, 'Bachigualato', '24.773112', '-107.461606', 1),
(38, ' Balcones Del Valle ', '24.752173', '-107.434418', 1),
(39, 'Balcones de San Miguel', '24.784291', '-107.387217', 1),
(40, 'Banjercito', '24.777879', '-107.357569', 1),
(41, 'Banus 360', '24.826900', '-107.368459', 1),
(42, 'Barrio de San Anselmo', '24.733006', '-107.389695', 1),
(43, 'Barrio de San Luis  ', '24.736516', '-107.397347', 1),
(44, 'Barrio San Agustin', '24.740780', ' -107.397355', 1),
(45, 'Barrio San Francisco', '24.736995', '-107.400512', 1),
(46, 'Benito Juarez', '24.800221', '-107.380353', 1),
(47, 'Bosque Encinos', '24.763741', '-107.394636', 1),
(48, ' Bosques Del Alamo', '24.853207', '-107.391758', 1),
(49, 'Bosques del Humaya', '24.825082', '-107.410640', 1),
(50, 'Bosques Del Rio ', '24.803954', ' -107.438048', 1),
(51, 'Brisas de Humaya ', '24.833138', '-107.413789', 1),
(52, 'Buena Vista', '24.833147', '-107.373966', 1),
(53, 'Buenos Aires', '24.773126', '-107.396844', 1),
(54, 'Bugambilias', '24.770199', '-107.452068', 1),
(55, 'Burocrata', '24.827342', '-107.388120', 1),
(56, 'Campesina El Barrio', '24.800167', '-107.334819', 1),
(57, 'Campestre', '24.836617', '-107.383659', 1),
(58, 'Campestre Tres Ríos', '24.833403', '-107.429202', 1),
(59, 'Campo Bello', '24.760627', '-107.462404', 1),
(60, 'CANACO', '24.822487', '-107.424609', 1),
(61, 'Cañadas', '24.781993', '-107.408206', 1),
(62, 'Capistrano Residencial', '24.747913', '-107.416981', 1),
(63, ' Casas Lindas', '24.757945', '-107.436438', 1),
(64, 'Centenario', '24.758363', '-107.438926', 1),
(65, 'Centro', '24.808225', '-107.394548', 1),
(66, 'Centro Sct Sinaloa', '24.800898', '-107.410255', 1),
(67, 'Centro Sinaloa', '24.798943', '-107.408639', 1),
(68, 'Chapultepec', '24.818108', '-107.389875', 1),
(69, 'Chapultepec Del Rio', '24.818299', '-107.383737', 1),
(70, 'Chulavista ', '24.756996', '-107.413482', 1),
(71, 'Ciudad Universitaria', '24.825087', '-107.381919', 1),
(72, 'CNOP ', '24.766114', '-107.377782', 1),
(73, 'Colina del Rey', '24.778127', '-107.399373', 1),
(74, 'Colinas de La Rivera', '24.840583', '-107.420717', 1),
(75, 'Colinas del Bosque', '24.752495', '-107.405402', 1),
(76, ' Colinas Del Humaya', '24.838963', '-107.410', 1),
(77, 'Colinas Del Humaya II', '24.838804', '-107.410573', 1),
(78, ' Colinas Del Parque', '24.780846', '-107.388652', 1),
(79, 'Colinas de San Miguel', '24.787494', '-107.388764', 1),
(80, 'Comunicadores', '24.832585', '-107.396858', 1),
(81, 'Constitución CROC', '24.800111', '-107.351887', 1),
(82, 'Country Alamos', '24.802099', '-107.425507', 1),
(83, 'Country Courts', '24.791575', '-107.439069', 1),
(84, 'Country Tres Ríos', '24.833442', '-107.429502', 1),
(85, 'Cuauhtemoc', '24.829155', '-107.422794', 1),
(86, 'Danubio', '24.756713', '-107.464334', 1),
(87, 'Del Camino ', '24.754255', '-107.437064', 1),
(88, 'Del Humaya', '24.822859', '-107.418298', 1),
(89, 'Desarrollo Urbano 3 Ríos', '24.819543', '-107.404309', 1),
(90, 'Desarrollo Urbano 3 Ríos', '24.819543', '-107.404309', 1),
(91, 'Diamante', '24.830715', '-107.413218', 1),
(92, 'Diana Laura Riojas de Colosio', '24.768514', '-107.392902', 1),
(93, ' Domingo Rubí', '24.757397', '-107.417575', 1),
(94, 'El Barrio', '24.804978', '-107.344930', 1),
(95, 'El Mirador', '24.850559', '-107.385802', 1),
(96, 'El Pipila', '24.797702', '-107.350236', 1),
(97, 'El Vallado', '24.788778', '-107.417192', 1),
(98, 'Emiliano Zapata', '24.789388', '-107.364997', 1),
(99, 'Espacios Barcelona', '24.833187', '-107.433351', 1),
(100, 'Espacios Marsella', '24.805626', '-107.437727', 1),
(101, 'Esthela Ortiz de Toledo ', '24.763653', '-107.418114', 1),
(102, 'Estrella Nueva Galicia', '24.770443', '-107.358930', 1),
(103, 'Felipe Ángeles', '24.761233', '-107.417491', 1),
(104, 'Ferrocarrilera', '24.762830', '-107.429291', 1),
(105, 'Fincas del Humaya', '24.847101', '-107.431086', 1),
(106, 'Finisterra ', '24.749070', '-107.421927', 1),
(107, 'Floresta ', '24.837011', '-107.360776', 1),
(108, 'Florida ', '24.780434', '-107.358687', 1),
(109, 'FOVISSSTE Diamante', '24.830733', '-107.413334', 1),
(110, 'FOVISSSTE Humaya', '24.832063', '-107.409548', 1),
(111, 'Francisco I. Madero', '24.764060', '-107.389904', 1),
(112, 'Francisco Labastida Ochoa', '24.766050', '-107.389447', 1),
(113, 'Francisco Villa', '24.787252', '-107.421169', 1),
(114, 'Fuentes Del Valle', '24.769447', '-107.438865', 1),
(115, 'Gabriel Leyva', '24.818305', '-107.396910', 1),
(116, 'Genaro Estrada', '24.807682', '-107.360790', 1),
(117, 'Girasoles', '24.859181', '-107.390658', 1),
(118, 'Grecia', '24.839334', '-107.378941', 1),
(119, 'Guadalupe', '24.793957', '-107.394129', 1),
(120, 'Guadalupe Victoria', '24.797057', '-107.363040', 1),
(121, 'Gustavo Díaz Ordaz', '24.773223', '-107.421616', 1),
(122, 'Hacienda Alameda', '24.871864', '-107.384481', 1),
(123, 'Hacienda Arboledas', '24.838378', '-107.395111', 1),
(124, ' Hacienda de La Mora', '24.759609', '-107.454235', 1),
(125, 'Hacienda Del Valle', '24.759371', '-107.407776', 1),
(126, 'Hacienda Los Huertos', '24.862571', '-107.389657', 1),
(127, 'Hacienda San Juan', '24.799752', '-107.354992', 1),
(128, 'Haciendas del Río ', '24.828105', '-107.359064', 1),
(129, 'Heraclio Bernal', '24.840269', '-107.410096', 1),
(130, 'Hermanos Flores Magón', '24.809388', '-107.415284', 1),
(131, 'Horizontes ', '24.814144', '-107.429127', 1),
(132, 'Huizaches', '24.761022', '-107.383224', 1),
(133, 'Humaya ', '24.825070', '-107.411929', 1),
(134, 'Humaya del Super', '24.825466', '-107.418738', 1),
(135, 'Ignacio Allende', '24.834651', '-107.391791', 1),
(136, 'Independencia', '24.772838', '-107.407799', 1),
(137, 'Industrial Bravo', '24.793654', '-107.403332', 1),
(138, 'Industrial El Palmito  ', '24.778237', '-107.429962', 1),
(139, 'INFONAVIT Barrancos', '24.756422', '-107.431724', 1),
(140, 'INFONAVIT El Barrio', '24.804257', '-107.352920', 1),
(141, 'INFONAVIT Humaya', '24.823193', '-107.419551', 1),
(142, 'INFONAVIT Las Flores ', '24.786627', '-107.435241', 1),
(143, 'INFONAVIT Solidaridad', '24.821473', '-107.427613', 1),
(144, 'Instituto Tecnológico Regional de Culiacán', '24.788414', '-107.396984', 1),
(145, 'Interlomas ', '24.838221', '-107.381504', 1),
(146, 'Isla del Oeste', '24.735489', '-107.395638', 1),
(147, 'ISSSTESIN', '24.827389', '-107.422816', 1),
(148, 'La Amistad ', '24.792638', '-107.352656', 1),
(149, 'La Campiña', '24.813583', '-107.363501', 1),
(150, 'La Cantera', '24.800573', '-107.434316', 1),
(151, 'La Cascada', '24.840039', '-107.430420', 1),
(152, 'La Conquista', '24.820541', '-107.441051', 1),
(153, 'La Costera', '24.754627', '-107.372650', 1),
(154, 'La Esperanza', '24.786629', '-107.349734', 1),
(155, 'La Lima', '24.826592', '-107.376521', 1),
(156, 'La Primavera', '24.738872', '-107.397253', 1),
(157, 'La Puerta', '24.837933', '-107.426021', 1),
(158, 'La Ribera Residencial', '24.830068', '-107.369844', 1),
(159, 'La Rioja', '24.759221', '-107.452376', 1),
(160, 'Las Américas', '24.846234', '-107.384927', 1),
(161, 'Las Cucas', '24.844955', '-107.396265', 1),
(162, 'Las Dunas', '24.800872', '-107.416929', 1),
(163, 'Las Flores', '24.785384', '-107.441398', 1),
(164, 'Las Huertas', '24.777942', '-107.370254', 1),
(165, 'Las Ilusiones', '24.762606', '-107.359864', 1),
(166, 'Las Mañanitas', '24.761115', '-107.466566', 1),
(167, 'Las Moras', '24.854499', '-107.359844', 1),
(168, 'Las Quintas', '24.815063', '-107.375445', 1),
(169, 'Las Terrazas', '24.759325', '-107.467115', 1),
(170, 'Las Vegas', '24.806643', '-107.381188', 1),
(171, 'Laureles', '24.876614', '-107.389005', 1),
(172, 'Laureles Pinos ', '24.779107', '-107.354100', 1),
(173, 'La Ventana', '24.784251', '-107.396874', 1),
(174, 'Lázaro Cárdenas', '24.771931', '-107.377613', 1),
(175, ' Libertad', '24.779216', '-107.414848', 1),
(176, 'Limita de Hitaje', '24.819452', '-107.357177', 1),
(177, 'Lirios del Río', '24.855845', '-107.397564', 1),
(178, 'Loma Bonita', '24.762770', '-107.432878', 1),
(179, 'Loma de Rodriguera', '24.871431', '-107.390651', 1),
(180, 'Loma Linda', '24.777962', '-107.403835', 1),
(181, 'Lomas de Guadalupe', '24.791620', '-107.382209', 1),
(182, 'Lomas del Boulevard', '24.787738', '-107.426123', 1),
(183, 'Lomas Del Humaya', '24.841887', '-107.417054', 1),
(184, 'Lomas Del Magisterio ', '24.845188', '-107.374078', 1),
(185, 'Lomas Del Pedregal', '24.838758', '-107.385783', 1),
(186, 'Lomas del Sol', '24.841982', '-107.385750', 1),
(187, 'Lomas de San Isidro', '24.763289', '-107.397363', 1),
(188, ' Lomas de Tamazula ', '24.836420', '-107.369948', 1),
(189, 'Lomas Verdes', '24.840562', '-107.429398', 1),
(190, 'Los Alamitos', '24.853142', '-107.394010', 1),
(191, 'Los Álamos', '24.796932', '-107.419410', 1),
(192, 'Los Angeles ', '24.848503', '-107.361226', 1),
(193, ' Los Cerritos', '24.847893', '-107.420434', 1),
(194, 'Los Girasoles', '24.763216', '-107.436055', 1),
(195, 'Los Helechos', '24.779234', '-107.456586', 1),
(196, 'Los Huertos', '24.862766', '-107.389593', 1),
(197, 'Los Mezcales', '24.858028', '-107.394061', 1),
(198, 'Los Olivos', '24.826359', '-107.417635', 1),
(199, 'Los Patios 1', '24.805653', '-107.414114', 1),
(200, 'Los Patios 2', '24.805729', '-107.414628', 1),
(201, 'Los Pinos', '24.791090', '-107.410030', 1),
(202, 'Los Portales ', '24.767644', '-107.435330', 1),
(203, 'Los Sauces', '24.829937', '-107.419218', 1),
(204, 'Magnolias Residencial', '24.795386', '-107.418878', 1),
(205, ' Maralago', '24.839033', '-107.359629', 1),
(206, 'Margarita', '24.781378', '-107.371548', 1),
(207, 'Melchor Ocampo', '24.797365', '-107.379133', 1),
(208, 'Mercado de Abastos', '24.769345', '-107.364126', 1),
(209, 'Mezquitillo', '24.772991', '-107.363549', 1),
(210, 'Miguel Alemán', '24.800891', '-107.389492', 1),
(211, 'Miguel de La Madrid', '24.760824', '-107.365984', 1),
(212, 'Miguel Hidalgo ', '24.804732', '-107.368769', 1),
(213, ' Miravalle   ', '24.752067', '-107.429989', 1),
(214, ' Misión del Álamo', '24.803309', '-107.426512', 1),
(215, 'Misión San Fernando', '24.800940', '-107.442057', 1),
(216, 'Montebello', '24.782718', '-107.387325', 1),
(217, 'Montecarlo Residencial ', '24.816349', '-107.42460', 1),
(218, 'Montesierra ', '24.854421', '-107.378660', 1),
(219, 'Morelos', '24.787464', '-107.406182', 1),
(220, 'Músala Isla Bonita', '24.823153', '-107.368699', 1),
(221, 'Novena Zona Militar ', '24.796215', '-107.373526', 1),
(222, 'Nueva Galaxia ', '24.838129', '-107.370358', 1),
(223, 'Nueva Galicia', '24.764278', '-107.367277', 1),
(224, 'Nueva Vizcaya', '24.827574', '-107.417209', 1),
(225, 'Nuevo Bachigualato', '24.773283', '-107.476834', 1),
(226, 'Nuevo Culiacán', '24.784935', '-107.409929', 1),
(227, 'Nuevo México', '24.764906', '-107.386352', 1),
(228, 'Obrero Campesino', '24.830496', '-107.378136', 1),
(229, 'Oficinas Corporativas Ley S.A. ', '24.797264', '-107.420272', 1),
(230, 'Palacio de Gobierno Del Estado de Sinaloa', '24.797948', '-107.408589', 1),
(231, 'Palermo ', '24.765337', '-107.395610', 1),
(232, 'Palmillas Residencial', '24.781659', '-107.434112', 1),
(233, ' Paraíso', '24.767347', '-107.462609', 1),
(234, 'Parque Alameda', '24.830216', '-107.396987', 1),
(235, 'Parque Industrial CANACINTRA', '24.796735', '-107.385181', 1),
(236, 'Paseo Alameda ', '24.869469', '-107.385536', 1),
(237, 'Paseo de los Arcos', '24.765339', '-107.433301', 1),
(238, 'Paseo Del Rio', '24.830247', '-107.370127', 1),
(239, 'Pedregal del Humaya', '24.833841', '-107.410252', 1),
(240, 'Pedregal de San Angel', '24.800316', '-107.419669', 1),
(241, 'PEMEX ', '24.767457', '-107.429705', 1),
(242, 'Periodista ', '24.810073', '-107.376975', 1),
(243, 'Perisur', '24.750562', '-107.394528', 1),
(244, 'Plutarco Elias Calles', '24.756440', '-107.423400', 1),
(245, 'Popular ', '24.790508', '-107.403281', 1),
(246, 'Portafe', '24.846848', ' -107.428385', 1),
(247, 'Portalegre', '24.801530', '-107.400826', 1),
(248, 'Portales Del Country', '24.794332', '-107.420560', 1),
(249, 'Portanova', '24.829673', '-107.408646', 1),
(250, 'Pradera Dorada', '24.819108', '-107.431860', 1),
(251, 'Prados de La Conquista', '24.817753', '-107.440214', 1),
(252, 'Prados Del Sol', '24.752879', '-107.416282', 1),
(253, 'Prados Del Sur', '24.751727', '-107.380743', 1),
(254, 'Prados Residencial', '24.749454', '-107.418744', 1),
(255, ' Privada Del Real', '24.825619', '-107.378800', 1),
(256, 'Privada la Estancia', '24.757920', '-107.457791', 1),
(257, 'Privada La Estancia II', '24.757920', '-107.457791', 1),
(258, 'Privada La Estancia III', '24.757920', '-107.457791', 1),
(259, ' Privada La Estancia V', '24.757920', '-107.457791', 1),
(260, 'Privada La Estancia VII', '24.757920', '-107.457791', 1),
(261, 'Privada La Estancia VIII', '24.757920', '-107.457791', 1),
(262, 'Privada La Rivera', '24.829538', '-107.413335', 1),
(263, 'Privada Real del Valle', '24.806155', '-107.466970', 1),
(264, 'Privanzas', '24.802971', '-107.416763', 1),
(265, 'Progreso', '24.756045', '-107.396069', 1),
(266, 'Providencia ', '24.776641', '-107.367129', 1),
(267, 'Puerta de Hierro', '24.801008', '-107.418477', 1),
(268, 'Quinta Americana', '24.817109', '-107.362261', 1),
(269, 'Rafael Buelna', '24.787174', '-107.378093', 1),
(270, 'Rancho Contento', '24.827806', '-107.430029', 1),
(271, 'Real de Chapultepec', '24.819160', '-107.389489', 1),
(272, 'Real del Álamo', '24.803918', '-107.425526', 1),
(273, 'Real Del Country ', '24.788203', '-107.440363', 1),
(274, 'Real Del Parque', '24.746601', '-107.422305', 1),
(275, 'Real de Santa Fe', '24.845017', '-107.428125', 1),
(276, 'Real San Ángel', '24.764524', '-107.461229', 1),
(277, 'Real San Sebastián ', '24.754860', '-107.434971', 1),
(278, 'Recursos Hidráulicos', '24.806566', '-107.406805', 1),
(279, 'Renato Vega Alvarado', '24.754462', '-107.389047', 1),
(280, 'Renato Vega Amador', '24.781040', '-107.349041', 1),
(281, 'República Mexicana', '24.777486', '-107.385761', 1),
(282, 'Residencial Hacienda', '24.836747', '-107.381541', 1),
(283, 'Revolución', '24.788626', '-107.355592', 1),
(284, 'Riberas del Humaya', '24.837569', '-107.416592', 1),
(285, 'Riberas de Tamazula', '24.829484', '-107.373552', 1),
(286, 'Rincón Alameda', '24.827199', '-107.400561', 1),
(287, ' Rincón Colonial', '24.831482', '-107.388178', 1),
(288, 'Rincón Del Humaya', '24.819540', '-107.429644', 1),
(289, 'Rincón Del Parque', '24.760303', '-107.412001', 1),
(290, 'Rincón del Valle ', '24.768644', '-107.445295', 1),
(291, 'Rincón de Santa Rosa', '24.754222', ' -107.435389', 1),
(292, 'Rincón Feliz ', '24.784475', '-107.355019', 1),
(293, 'Rincón Las Palmas', '24.783904', '-107.437010', 1),
(294, 'Rincón Real ', '24.842798', '-107.425938', 1),
(295, 'Rincón San Rafael ', '24.774446', '-107.440228', 1),
(296, 'Rosario Uzarraga', '24.838341', '-107.373794', 1),
(297, 'Ruben Jaramillo', '24.835781', '-107.378770', 1),
(298, 'Salvador Alvarado', '24.784184', '-107.422616', 1),
(299, ' San Agustin', '24.753628', '-107.434647', 1),
(300, 'San Benito', '24.772858', '-107.356631', 1),
(301, 'San Carlos', '24.780522', '-107.404889', 1),
(302, 'San Cipriano ', '24.754407', '-107.434928', 1),
(303, 'San Diego', '24.769305', '-107.463098', 1),
(304, 'San Fermín', '24.788451', '-107.384097', 1),
(305, 'San Florencio', '24.820997', '-107.435806', 1),
(306, 'San Javier ', '24.771417', '-107.487227', 1),
(307, 'San Juan', '24.800252', '-107.355160', 1),
(308, 'San Luis Residencial', '24.757687', '-107.463249', 1),
(309, ' San Rafael', '24.774290', '-107.439885', 1),
(310, 'San Sebastián', '24.755045', '-107.434864', 1),
(311, 'Santa Aynes', '24.814891', '-107.433988', 1),
(312, 'Santa Bárbara', '24.765075,', '-107.458130', 1),
(313, ' Santa Clara', '24.757763', ' -107.462283', 1),
(314, 'Santa Elena', '24.835442', '-107.424730', 1),
(315, ' Santa Fe ', '24.844828', '-107.420853', 1),
(316, 'Santa Fe Real', '24.846425', '-107.424286', 1),
(317, 'Santa Inés', '24.794686', '-107.419915', 1),
(318, 'Santa Margarita', '24.827446', '-107.378817', 1),
(319, 'Santa Rocio', '24.770342', '-107.484293', 1),
(320, 'Santa Rosa ', '24.847756', '-107.421853', 1),
(321, 'Secretaria de Agricultura Ganadería y Desarro', '24.817276', '-107.371031', 1),
(322, 'Secretaria de La Reforma Agraria', '24.831200', '-107.413865', 1),
(323, ' Servidor Publico Municipal ', '-23.523676', '-46.702112', 1),
(324, ' Simon Bolívar', '24.770027', '-107.384348', 1),
(325, 'Sinaloa', '24.788470', '-107.37373', 1),
(326, 'Solidaridad', '24.843237', '-107.378733', 1),
(327, ' Stanza Toscana  ', '24.810169', '-107.460746', 1),
(328, 'STASE', '24.829028', '-107.409204', 1),
(329, 'STASE II', '24.829270', '-107.416248', 1),
(330, 'STASE III', '24.831078', '-107.406518', 1),
(331, 'Tabachines ', '24.838873', '-107.414375', 1),
(332, 'Terranova', '24.768028', '-107.458135', 1),
(333, 'Tierra Blanca', '24.825893', '-107.394397', 1),
(334, 'Torres Aeropuerto', '24.772558', '-107.456379', 1),
(335, 'Tulipanes', '24.831876', '-107.417441', 1),
(336, 'Unidad de Servicios Estatales', '24.788618', '-107.443879', 1),
(337, ' Universidad 94', '24.822776', '-107.430923', 1),
(338, 'Universidad 94 II ', '24.826601', '-107.431718', 1),
(339, 'Universidad Autónoma de Sinaloa', '24.825849', '-107.381548', 1),
(340, ' Vallado Viejo ', '24.804417', '-107.406674', 1),
(341, 'Valle Alto', '24.803568', '-107.463866', 1),
(342, 'Valle Bonito ', '24.763043', '-107.461720', 1),
(343, 'Valle del Agua ', '24.817587', '-107.442376', 1),
(344, 'Valle Del Rio', '24.807129', '-107.428577', 1),
(345, 'Valle Dorado', '24.817650', '-107.437934', 1),
(346, 'Valles Del Sol', '24.754866', '-107.457555', 1),
(347, 'Valles Españoles', '24.760818', '-107.450973', 1),
(348, 'Verona', '24.827663', '-107.363838', 1),
(349, 'Vicente Guerrero', '24.808357', '-107.363867', 1),
(350, 'Vicente Lombardo Toledano', '24.847055', '-107.389712', 1),
(351, 'Villa Andalucía', '24.806219', '-107.442088', 1),
(352, ' Villa Bonita', '24.750732', '-107.386886', 1),
(353, 'Villa Colonial', '24.749670', '-107.429579', 1),
(354, 'Villa Contenta', '24.784271', '-107.438449', 1),
(355, 'Villa del Cedro', '24.822831', '-107.453327', 1),
(356, ' Villa del Pedregal ', '24.839400', '-107.430398', 1),
(357, 'Villa Del Real', '24.797746', '-107.347245', 1),
(358, ' Villa del Roble', '24.868893', '-107.385967', 1),
(359, 'Villa Del Sol', '24.846385', '-107.378917', 1),
(360, 'Villa Dorada', '24.837068', '-107.419406', 1),
(361, 'Villa Fontana', '24.838117', '-107.423726', 1),
(362, ' Villa Satélite  ', '24.805025', '-107.355916', 1),
(363, 'Villas de Cortés', '24.763605', '-107.462651', 1),
(364, 'Villas del Humaya', '24.838990', '-107.425820', 1),
(365, 'Villas Del Rio ', '24.804731', '-107.441665', 1),
(366, ' Villas Del Rio Elite', '24.807719', '-107.450590', 1),
(367, 'Villas Santa Anita', '24.820219', '-107.437993', 1),
(368, 'Villas Victoria', '24.816067', '-107.434117', 1),
(369, 'Villa Universidad ', '24.834112', '-107.386362', 1),
(370, ' Villa Verde', '24.750114', '-107.433999', 1),
(371, 'Viñedos', '24.811992', '-107.358747', 1),
(372, 'Vinoramas', '24.747805', '-107.433993', 1),
(373, 'Vista Hermosa', '24.780357', '-107.351855', 1),
(374, 'Alteza', '24.773377', '-107.372234', 1),
(375, '9 de Marzo', '24.815533', '-107.447967', 1),
(376, 'Alturas del Sur', '24.815533', '-107.447967', 1),
(377, 'Avellaneda', '24.804742', '-107.417027', 1),
(378, 'Azucena', '24.83751', '-107.497412', 1),
(379, 'Barrio San José', '24.813729', '-107.184392', 1),
(380, 'Bonanza', '24.887167', '-107.487484', 1),
(381, 'Bonaterra', '24.887167', '-107.487484', 1),
(382, 'Campestre Los Laureles', '24.82119', '-107.430829', 1),
(383, 'Campos Elíseos', '24.738575', '-107.408622', 1),
(384, 'Culiacancito', '24.825977', '-107.528590', 1),
(385, 'Portalegre Premium', '24.8261689', '-107.456359', 1),
(386, 'Cedros', '24.825338', '-107.453974', 1),
(387, 'La Limita del Itaje', '24.819304', '-107.356955', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Comment`
--

CREATE TABLE IF NOT EXISTS `Comment` (
  `Comment_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Star` decimal(10,0) NOT NULL,
  `Comment` varchar(250) NOT NULL,
  `Client_Id` int(11) NOT NULL,
  `Cabbie_Id` int(11) NOT NULL,
  PRIMARY KEY (`Comment_Id`),
  KEY `fk_Comment_Client1_idx` (`Client_Id`),
  KEY `fk_Comment_Cabbie1_idx` (`Cabbie_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Country`
--

CREATE TABLE IF NOT EXISTS `Country` (
  `Country_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(45) NOT NULL,
  PRIMARY KEY (`Country_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `Country`
--

INSERT INTO `Country` (`Country_Id`, `Description`) VALUES
(1, 'Mexico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Location_Cabbie`
--

CREATE TABLE IF NOT EXISTS `Location_Cabbie` (
  `Location_Cabbie_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Longitude` varchar(45) NOT NULL,
  `Latitude` varchar(45) NOT NULL,
  `Cabbie_Id` int(11) NOT NULL,
  PRIMARY KEY (`Location_Cabbie_Id`),
  KEY `fk_Location_Cabbie_Cabbie1_idx` (`Cabbie_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `Location_Cabbie`
--

INSERT INTO `Location_Cabbie` (`Location_Cabbie_Id`, `Longitude`, `Latitude`, `Cabbie_Id`) VALUES
(1, '24', '-107', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Message_Cabbie`
--

CREATE TABLE IF NOT EXISTS `Message_Cabbie` (
  `Message_Client_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Subject` varchar(40) NOT NULL,
  `Message` varchar(200) NOT NULL,
  `Cabbie_Id` int(11) NOT NULL,
  PRIMARY KEY (`Message_Client_Id`),
  KEY `fk_Message_Cabbie_Cabbie1_idx` (`Cabbie_Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `Message_Cabbie`
--

INSERT INTO `Message_Cabbie` (`Message_Client_Id`, `Subject`, `Message`, `Cabbie_Id`) VALUES
(1, ':S', ':M', 0),
(2, 'jsjsjs', 'ndnsnsn', 1),
(3, 'Ayuda', 'Tengo un problema con mi unidad', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Message_Client`
--

CREATE TABLE IF NOT EXISTS `Message_Client` (
  `Message_Client_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Subject` varchar(45) NOT NULL,
  `Message` varchar(180) NOT NULL,
  `Client_Id` int(11) NOT NULL,
  PRIMARY KEY (`Message_Client_Id`),
  KEY `fk_Message_Client_Client1_idx` (`Client_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `Message_Client`
--

INSERT INTO `Message_Client` (`Message_Client_Id`, `Subject`, `Message`, `Client_Id`) VALUES
(4, 'prueba', 'prueba', 1),
(5, 'Prueba', 'Prueba', 19),
(6, 'jzjsjsjs', 'jdjdjzbzbz', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PaymentSystem`
--

CREATE TABLE IF NOT EXISTS `PaymentSystem` (
  `PaymentSystem_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(45) NOT NULL,
  PRIMARY KEY (`PaymentSystem_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `PaymentSystem`
--

INSERT INTO `PaymentSystem` (`PaymentSystem_Id`, `Description`) VALUES
(1, 'Rango'),
(2, 'Distancia'),
(3, 'Aeropuerto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PaymentType`
--

CREATE TABLE IF NOT EXISTS `PaymentType` (
  `PaymentType_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(45) NOT NULL,
  PRIMARY KEY (`PaymentType_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `PaymentType`
--

INSERT INTO `PaymentType` (`PaymentType_Id`, `Description`) VALUES
(1, 'Tarjeta'),
(2, 'Efectivo'),
(3, 'Otro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Permission`
--

CREATE TABLE IF NOT EXISTS `Permission` (
  `idPermission` int(11) NOT NULL AUTO_INCREMENT,
  `Admin_Admin_Id` int(11) NOT NULL,
  `Reports` int(11) NOT NULL,
  `Cabbies` int(11) NOT NULL,
  PRIMARY KEY (`idPermission`),
  KEY `fk_Permission_Admin1_idx` (`Admin_Admin_Id`),
  KEY `fk_Permission_PermissionActv1_idx` (`Reports`),
  KEY `fk_Permission_PermissionActv2_idx` (`Cabbies`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PermissionActv`
--

CREATE TABLE IF NOT EXISTS `PermissionActv` (
  `PermissionActvId` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(45) NOT NULL,
  PRIMARY KEY (`PermissionActvId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Place_Favorite`
--

CREATE TABLE IF NOT EXISTS `Place_Favorite` (
  `Place_Favorite_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Latitude` varchar(30) NOT NULL,
  `Longitude` varchar(30) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `Client_Id` int(11) NOT NULL,
  PRIMARY KEY (`Place_Favorite_Id`),
  KEY `fk_Place_Favorite_Client1_idx` (`Client_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Volcado de datos para la tabla `Place_Favorite`
--

INSERT INTO `Place_Favorite` (`Place_Favorite_Id`, `Latitude`, `Longitude`, `Name`, `Description`, `Client_Id`) VALUES
(11, '24.835036788174474', '-107.3808978125453', 'casa', 'Caporal 1149 CuliacÃ¡n Rosales Sinaloa MÃ©xico', 27),
(14, '24', '-107', 'Nam', 'Desc', 27),
(23, '24.8214139', '-107.4256312', 'Mi casa', 'Avenida Vulcano 2081â€“2185, Canaco', 20),
(27, '24', '-107', 'Other', 'Descr', 27),
(28, '24.7873611', '-107.398189', 'Tec', '80225, Guadalupe', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PSystem_Airport`
--

CREATE TABLE IF NOT EXISTS `PSystem_Airport` (
  `PSystem_Colony_Id` int(11) NOT NULL AUTO_INCREMENT,
  `ToColony_Price` decimal(10,0) NOT NULL,
  `FromColony_Price` decimal(10,0) NOT NULL,
  `Colony_Id` int(11) NOT NULL,
  `Cabbie_Cabbie_Id` int(11) NOT NULL,
  PRIMARY KEY (`PSystem_Colony_Id`),
  KEY `fk_PSystem_Airport_Colony1_idx` (`Colony_Id`),
  KEY `fk_PSystem_Airport_Cabbie1_idx` (`Cabbie_Cabbie_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PSystem_Distance`
--

CREATE TABLE IF NOT EXISTS `PSystem_Distance` (
  `PSystem_Distance_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Kilometer_Price` varchar(45) NOT NULL,
  `Minute_Price` varchar(45) NOT NULL,
  `Cabbie_Cabbie_Id` int(11) NOT NULL,
  PRIMARY KEY (`PSystem_Distance_Id`),
  KEY `fk_PSystem_Distance_Cabbie1_idx` (`Cabbie_Cabbie_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PSystem_Range`
--

CREATE TABLE IF NOT EXISTS `PSystem_Range` (
  `PSystem_Range_Id` int(11) NOT NULL AUTO_INCREMENT,
  `RangD` varchar(45) NOT NULL,
  `Price` decimal(10,0) NOT NULL,
  `Cabbie_Cabbie_Id` int(11) NOT NULL,
  PRIMARY KEY (`PSystem_Range_Id`),
  KEY `fk_PSystem_Range_Cabbie1_idx` (`Cabbie_Cabbie_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `PSystem_Range`
--

INSERT INTO `PSystem_Range` (`PSystem_Range_Id`, `RangD`, `Price`, `Cabbie_Cabbie_Id`) VALUES
(1, '0,5', '60', 1),
(3, '5,10', '100', 1),
(4, '10,15000', '200', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Request`
--

CREATE TABLE IF NOT EXISTS `Request` (
  `Request_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Date` datetime NOT NULL,
  `Latitude_In` varchar(45) NOT NULL,
  `Longitude_In` varchar(45) NOT NULL,
  `Latitude_Fn` varchar(45) NOT NULL,
  `Longitude_Fn` varchar(45) NOT NULL,
  `Inicio` varchar(250) NOT NULL,
  `Destino` varchar(250) NOT NULL,
  `Ref` varchar(30) NOT NULL,
  `Price` decimal(10,0) NOT NULL,
  `Client_Id` int(11) NOT NULL,
  `Cabbie_Id` int(11) NOT NULL,
  `PaymentType_Id` int(11) NOT NULL,
  `RequestStatus_Id` int(11) NOT NULL,
  `Pay_uid` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Request_Id`),
  KEY `fk_Request_Client1_idx` (`Client_Id`),
  KEY `fk_Request_Cabbie1_idx` (`Cabbie_Id`),
  KEY `fk_Request_PaymentType1_idx` (`PaymentType_Id`),
  KEY `fk_Request_RequestStatus1_idx` (`RequestStatus_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `Request`
--

INSERT INTO `Request` (`Request_Id`, `Date`, `Latitude_In`, `Longitude_In`, `Latitude_Fn`, `Longitude_Fn`, `Inicio`, `Destino`, `Ref`, `Price`, `Client_Id`, `Cabbie_Id`, `PaymentType_Id`, `RequestStatus_Id`, `Pay_uid`) VALUES
(1, '2016-09-22 12:38:28', '24', '-107', '24.0', '-107.0', 'Tec de culiacan', 'Casa del rulo', '12341234', '100', 20, 1, 1, 2, NULL),
(2, '2016-09-14 00:00:00', '24', '-107', '24.1', '-107.2', 'Casa', 'Hotel', '423432523', '50', 20, 1, 1, 2, NULL),
(5, '2016-09-28 18:03:54', '24.834915384360013', '-107.38086931407452', '24.79019204470224', '-107.40171007812023', 'Caporal 1149 CuliacÃ¡n Rosales Sinaloa MÃ©xico', 'RÃ­o Aguanaval 737', '1609281-27180354', '200', 20, 1, 2, 3, NULL),
(6, '2016-09-28 21:27:16', '24.834915384360013', '-107.38086931407452', '24.788498', '-107.3983665', 'Caporal 1149 CuliacÃ¡n Rosales Sinaloa MÃ©xico', 'Mi ubicaciÃ³n', '1609281-27212716', '200', 27, 1, 2, 3, NULL),
(7, '2016-09-28 21:52:03', '24.834915384360013', '-107.38086931407452', '24.7885053', '-107.3983767', 'Caporal 1149 CuliacÃ¡n Rosales Sinaloa MÃ©xico', 'Mi ubicaciÃ³n', '1609281-27215203', '200', 27, 1, 2, 3, NULL),
(8, '2016-10-04 18:04:19', '24.835036788174474', '-107.3808978125453', '24.788506', '-107.398336', 'Caporal 1149 CuliacÃ¡n Rosales Sinaloa MÃ©xico', 'Mi ubicaciÃ³n', '1610041-27180419', '200', 27, 1, 2, 3, NULL),
(21, '2016-10-10 22:48:39', '24', '-107', '24', '-107', 'Casa', 'Trabajo', '1610101-19224836', '200', 19, 1, 1, 1, NULL),
(22, '2016-10-10 22:54:56', '24', '-107', '24', '-107', 'Casa', 'Trabajo', '1610101-19225453', '200', 19, 1, 1, 1, NULL),
(23, '2016-10-10 22:58:53', '24', '-107', '24', '-107', 'Casa', 'Trabajo', '1610101-19225851', '200', 19, 1, 1, 1, '57fc1d2fdba34d42a1014698'),
(24, '2016-10-10 23:03:07', '24.83531', '-107.380694', '24.79019204470224', '-107.40171007812023', 'Mi ubicaciÃ³n', 'RÃ­o Aguanaval 737', '1610101-19230305', '200', 19, 1, 1, 1, '57fc1e2dc835f0fae9013a96'),
(25, '2016-10-11 18:13:35', '24.7885157', '-107.398333', '24.79019204470224', '-107.40171007812023', 'Mi ubicaciÃ³n', 'RÃ­o Aguanaval 737', '1610111-19181333', '200', 19, 1, 1, 1, '57fd2bd0c835f004c001894c'),
(26, '2016-10-11 18:13:37', '24.7885157', '-107.398333', '24.79019204470224', '-107.40171007812023', 'Mi ubicaciÃ³n', 'RÃ­o Aguanaval 737', '1610111-19181335', '200', 19, 1, 1, 1, '57fd2bd2dba34d2bcd018e27'),
(27, '2016-10-11 18:20:11', '24.7885238', '-107.3983447', '24.79019204470224', '-107.40171007812023', 'Mi ubicaciÃ³n', 'RÃ­o Aguanaval 737', '1610111-19182010', '200', 19, 1, 1, 1, '57fd2d5ddba34d42a101a28b');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `RequestStatus`
--

CREATE TABLE IF NOT EXISTS `RequestStatus` (
  `RequestStatus_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`RequestStatus_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `RequestStatus`
--

INSERT INTO `RequestStatus` (`RequestStatus_Id`, `Description`) VALUES
(1, 'Activa'),
(2, 'Asignada'),
(3, 'Finalizada'),
(4, 'Eliminada por el usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Reservation`
--

CREATE TABLE IF NOT EXISTS `Reservation` (
  `Reservation_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Day` datetime NOT NULL,
  `ReservationStatus_Id` int(11) NOT NULL,
  `Request_Id` int(11) NOT NULL,
  PRIMARY KEY (`Reservation_Id`),
  KEY `fk_Reservation_ReservationStatus1_idx` (`ReservationStatus_Id`),
  KEY `fk_Reservation_Request1_idx` (`Request_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ReservationStatus`
--

CREATE TABLE IF NOT EXISTS `ReservationStatus` (
  `ReservationStatus_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(45) NOT NULL,
  PRIMARY KEY (`ReservationStatus_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `State`
--

CREATE TABLE IF NOT EXISTS `State` (
  `State_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(45) NOT NULL,
  `Country_Id` int(11) NOT NULL,
  PRIMARY KEY (`State_Id`),
  KEY `fk_State_Country_idx` (`Country_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `State`
--

INSERT INTO `State` (`State_Id`, `Description`, `Country_Id`) VALUES
(1, 'Sinaloa', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Town`
--

CREATE TABLE IF NOT EXISTS `Town` (
  `Town_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(45) NOT NULL,
  `North` varchar(50) NOT NULL,
  `South` varchar(50) NOT NULL,
  `East` varchar(50) NOT NULL,
  `West` varchar(50) NOT NULL,
  `State_Id` int(11) NOT NULL,
  PRIMARY KEY (`Town_Id`),
  KEY `fk_Town_State1_idx` (`State_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `Town`
--

INSERT INTO `Town` (`Town_Id`, `Description`, `North`, `South`, `East`, `West`, `State_Id`) VALUES
(1, 'Culiacan', '0', '0', '0', '0', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `User_Type`
--

CREATE TABLE IF NOT EXISTS `User_Type` (
  `Client_Type_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(45) NOT NULL,
  PRIMARY KEY (`Client_Type_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `User_Type`
--

INSERT INTO `User_Type` (`Client_Type_Id`, `Description`) VALUES
(1, 'Android'),
(2, 'IoS');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Admin`
--
ALTER TABLE `Admin`
  ADD CONSTRAINT `fk_Admin_Admin1` FOREIGN KEY (`AdminBy_Id`) REFERENCES `Admin` (`Admin_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Admin_AdminActv1` FOREIGN KEY (`AdminActv_Id`) REFERENCES `AdminActv` (`AdminActv_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Admin_AdminAddress1` FOREIGN KEY (`AdminAddressId`) REFERENCES `AdminAddress` (`AdminAddressId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Admin_AdminType1` FOREIGN KEY (`AdminType_Id`) REFERENCES `AdminType` (`AdminType_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `AdminAddress`
--
ALTER TABLE `AdminAddress`
  ADD CONSTRAINT `fk_AdminAddress_Colony1` FOREIGN KEY (`Colony_Id`) REFERENCES `Colony` (`Colony_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Cabbie`
--
ALTER TABLE `Cabbie`
  ADD CONSTRAINT `fk_Cabbie_Admin1` FOREIGN KEY (`Admin_Id`) REFERENCES `Admin` (`Admin_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Cabbie_CabbieActv1` FOREIGN KEY (`CabbieActv_Id`) REFERENCES `CabbieActv` (`CabbieActv_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Cabbie_Cabbie_Status1` FOREIGN KEY (`Cabbie_Status_Id`) REFERENCES `Cabbie_Status` (`Cabbie_Status_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Cabbie_PaymentSystem1` FOREIGN KEY (`PaymentSystem_Id`) REFERENCES `PaymentSystem` (`PaymentSystem_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Cabbie_User_Type1` FOREIGN KEY (`User_Type_Id`) REFERENCES `User_Type` (`Client_Type_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `CabbieDetail`
--
ALTER TABLE `CabbieDetail`
  ADD CONSTRAINT `fk_CabbieDetail_Cabbie1` FOREIGN KEY (`Cabbie_Id`) REFERENCES `Cabbie` (`Cabbie_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CabbieDetail_CarModel1` FOREIGN KEY (`Car_Id`) REFERENCES `CarModel` (`Car_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Card`
--
ALTER TABLE `Card`
  ADD CONSTRAINT `fk_Card_Client2` FOREIGN KEY (`Client_Id`) REFERENCES `Client` (`Client_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `CarModel`
--
ALTER TABLE `CarModel`
  ADD CONSTRAINT `fk_CarModel_CarBrand1` FOREIGN KEY (`CarBrand_Id`) REFERENCES `CarBrand` (`CarBrand_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Client`
--
ALTER TABLE `Client`
  ADD CONSTRAINT `fk_Client_Client_Type1` FOREIGN KEY (`User_Type_Id`) REFERENCES `User_Type` (`Client_Type_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Client_ClienteActv1` FOREIGN KEY (`ClientActv_Id`) REFERENCES `ClientActv` (`ClientActv_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Colony`
--
ALTER TABLE `Colony`
  ADD CONSTRAINT `fk_Colony_Town1` FOREIGN KEY (`Town_Id`) REFERENCES `Town` (`Town_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `fk_Comment_Cabbie1` FOREIGN KEY (`Cabbie_Id`) REFERENCES `Cabbie` (`Cabbie_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Comment_Client1` FOREIGN KEY (`Client_Id`) REFERENCES `Client` (`Client_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Location_Cabbie`
--
ALTER TABLE `Location_Cabbie`
  ADD CONSTRAINT `fk_Location_Cabbie_Cabbie1` FOREIGN KEY (`Cabbie_Id`) REFERENCES `Cabbie` (`Cabbie_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Message_Client`
--
ALTER TABLE `Message_Client`
  ADD CONSTRAINT `fk_Message_Client_Client1` FOREIGN KEY (`Client_Id`) REFERENCES `Client` (`Client_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Permission`
--
ALTER TABLE `Permission`
  ADD CONSTRAINT `fk_Permission_Admin1` FOREIGN KEY (`Admin_Admin_Id`) REFERENCES `Admin` (`Admin_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Permission_PermissionActv1` FOREIGN KEY (`Reports`) REFERENCES `PermissionActv` (`PermissionActvId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Permission_PermissionActv2` FOREIGN KEY (`Cabbies`) REFERENCES `PermissionActv` (`PermissionActvId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Place_Favorite`
--
ALTER TABLE `Place_Favorite`
  ADD CONSTRAINT `fk_Place_Favorite_Client1` FOREIGN KEY (`Client_Id`) REFERENCES `Client` (`Client_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `PSystem_Airport`
--
ALTER TABLE `PSystem_Airport`
  ADD CONSTRAINT `fk_PSystem_Airport_Cabbie1` FOREIGN KEY (`Cabbie_Cabbie_Id`) REFERENCES `Cabbie` (`Cabbie_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PSystem_Airport_Colony1` FOREIGN KEY (`Colony_Id`) REFERENCES `Colony` (`Colony_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `PSystem_Distance`
--
ALTER TABLE `PSystem_Distance`
  ADD CONSTRAINT `fk_PSystem_Distance_Cabbie1` FOREIGN KEY (`Cabbie_Cabbie_Id`) REFERENCES `Cabbie` (`Cabbie_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `PSystem_Range`
--
ALTER TABLE `PSystem_Range`
  ADD CONSTRAINT `fk_PSystem_Range_Cabbie1` FOREIGN KEY (`Cabbie_Cabbie_Id`) REFERENCES `Cabbie` (`Cabbie_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Request`
--
ALTER TABLE `Request`
  ADD CONSTRAINT `fk_Request_Cabbie1` FOREIGN KEY (`Cabbie_Id`) REFERENCES `Cabbie` (`Cabbie_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Request_Client1` FOREIGN KEY (`Client_Id`) REFERENCES `Client` (`Client_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Request_PaymentType1` FOREIGN KEY (`PaymentType_Id`) REFERENCES `PaymentType` (`PaymentType_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Request_RequestStatus1` FOREIGN KEY (`RequestStatus_Id`) REFERENCES `RequestStatus` (`RequestStatus_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Reservation`
--
ALTER TABLE `Reservation`
  ADD CONSTRAINT `fk_Reservation_Request1` FOREIGN KEY (`Request_Id`) REFERENCES `Request` (`Request_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Reservation_ReservationStatus1` FOREIGN KEY (`ReservationStatus_Id`) REFERENCES `ReservationStatus` (`ReservationStatus_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `State`
--
ALTER TABLE `State`
  ADD CONSTRAINT `fk_State_Country` FOREIGN KEY (`Country_Id`) REFERENCES `Country` (`Country_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Town`
--
ALTER TABLE `Town`
  ADD CONSTRAINT `fk_Town_State1` FOREIGN KEY (`State_Id`) REFERENCES `State` (`State_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
