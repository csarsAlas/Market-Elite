-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-05-2024 a las 04:48:08
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
-- Base de datos: `abfime`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_carrito` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id_carrito`, `id_cliente`, `id_producto`, `nombre`, `cantidad`, `precio`) VALUES
(16, 8, 78, 'Pimienta', 1, 8),
(17, 8, 97, 'Arroz 250 g', 2, 10),
(18, 8, 117, 'Galletas Emperador Nuez', 3, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `ID_cli` int(11) NOT NULL,
  `nombre_cli` varchar(100) NOT NULL,
  `cel_cli` varchar(100) NOT NULL,
  `fia_cli` int(11) NOT NULL,
  `cantf_cli` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`ID_cli`, `nombre_cli`, `cel_cli`, `fia_cli`, `cantf_cli`) VALUES
(10, 'Cesar', '8180156387', 0, 0),
(11, 'Sergio', '8180156437', 0, 0),
(12, 'Sergio', '8180156437', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `ID_prod` int(11) NOT NULL,
  `nombre_pord` varchar(100) NOT NULL,
  `prec_prod` float NOT NULL,
  `marc_prod` varchar(100) NOT NULL,
  `secc_prod` varchar(100) NOT NULL,
  `cant_prod` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`ID_prod`, `nombre_pord`, `prec_prod`, `marc_prod`, `secc_prod`, `cant_prod`) VALUES
(47, 'Salsa Botanera', 15, 'Mega Alimentos', '1', '30'),
(48, 'Veladoras', 25, 'LOCAL', '1', '20'),
(49, 'Platos Desechables', 40, 'Great Value', '1', '15'),
(50, 'Vasos Desechables', 40, 'Great Value', '1', '40'),
(51, 'Papel Higiénico', 10, 'Kleenex', '1', '50'),
(52, 'Servilletas', 20, 'Great Value', '1', '15'),
(53, 'Cloralex 950 ml', 30, 'Cloralex', '1', '20'),
(54, 'Cloralex 500 ml', 20, 'Cloralex', '1', '20'),
(55, 'Pinol 1L', 35, 'Pinol', '1', '25'),
(56, 'Pinol 250 ml', 15, 'Pinol', '1', '25'),
(57, 'Ariel 250 g', 15, 'Ariel', '1', '20'),
(58, 'Ariel 500 g', 20, 'Ariel', '1', '20'),
(59, 'Salvo Multiusos 500 g', 20, 'Jabón Lavatrastes Salvo', '1', '20'),
(60, 'Fabuloso 250 ml', 15, 'Fabuloso', '1', '20'),
(61, 'Zote (jabón)', 9, 'Jabon Zote', '1', '37'),
(75, 'Chile Ancho', 10, 'LOCAL', '2', '80'),
(76, 'Canela', 8, 'LOCAL', '2', '30'),
(77, 'Comino', 8, 'LOCAL', '2', '30'),
(78, 'Pimienta', 8, 'LOCAL', '2', '44'),
(79, 'Chile cascabel', 10, 'LOCAL', '2', '50'),
(80, 'Ajo molido', 8, 'LOCAL', '2', '40'),
(82, 'Chile japonés', 9, 'LOCAL', '2', '30'),
(83, 'Coco rallado', 12, 'LOCAL', '2', '30'),
(84, 'Pasas', 12, 'LOCAL', '2', '30'),
(85, 'Clavo de olor', 8, 'LOCAL', '2', '50'),
(86, 'Rexal', 15, 'Rexal', '2', '36'),
(87, 'Catsup 320 g', 14, 'Clemente Jacques', '2', '35'),
(88, 'Catsup 220 g', 10, 'Clemente Jacques', '2', '30'),
(89, 'Mayonesa 190 g', 15, 'McCormick', '2', '20'),
(90, 'Manteca inca', 22, 'Manteca INCA', '2', '30'),
(91, 'Chiles jalapeños enteros 380 g (lata)', 18, 'La Costeña', '2', '30'),
(92, 'Chiles en rajas 380g(lata)', 18, 'La Costeña', '2', '30'),
(93, 'Elote 225 g(lata)', 12, 'Del Monte', '2', '30'),
(94, 'Nescafé 42 g', 28, 'Nestle', '2', '30'),
(95, 'Mole 235 g', 35, 'Mole Doña María', '2', '36'),
(96, 'Frijoles (lata)', 15, 'LOCAL', '2', '40'),
(97, 'Arroz 250 g', 10, 'Verde Valle', '2', '38'),
(98, 'Arroz 500 g', 20, 'Verde Valle', '2', '40'),
(99, 'Sopa (Fideos) 250 g', 10, 'YEMINA', '2', '20'),
(100, 'Sopa (conchitas)', 10, 'YEMINA', '2', '20'),
(101, 'Sopa (coditos) 250 g', 10, 'YEMINA', '2', '20'),
(102, 'Spaghetti 200 g', 10, 'YEMINA', '2', '20'),
(103, 'Sal', 10, 'LA FINA', '2', '30'),
(104, 'Huevo 1 kg', 48, 'LOCAL', '2', '200'),
(105, 'Palomitas', 12, 'LOCAL', '2', '20'),
(106, 'Kola Loka', 22, 'Krazy', '2', '30'),
(115, 'Galletas Emperador Vainilla', 14, 'Emperador', '3', '14'),
(116, 'Galletas Emperador Chocolate', 14, 'GAMESA', '3', '14'),
(117, 'Galletas Emperador Nuez', 14, 'Emperador', '3', '11'),
(118, 'Galletas Emperador Limón', 14, 'Emperador', '3', '14'),
(119, 'Galletas Arcoíris', 14, 'GAMESA', '3', '13'),
(120, 'Galletas Chokis', 14, 'GAMESA', '3', '14'),
(122, 'Galletas Saladitas', 17, 'GAMESA', '3', '12'),
(124, 'Pan molido clásico', 25, 'BIMBO', '4', '20'),
(125, 'Pan molido crujiente', 25, 'BIMBO', '4', '20'),
(126, 'Pan blanco grande (Blanco)', 42, 'BIMBO', '4', '20'),
(127, 'Pan blanco chico (Blanco)', 34, 'BIMBO', '4', '20'),
(128, 'Pan integral grande', 45, 'BIMBO', '4', '20'),
(129, 'Pan integral chico', 35, 'BIMBO', '4', '20'),
(130, 'Pan Medias Noches', 37, 'BIMBO', '4', '20'),
(131, 'Bimbollos', 42, 'BIMBO', '4', '15'),
(132, 'Donas', 42, 'BIMBO', '4', '15'),
(133, 'Bimbuñuelos', 18, 'BIMBO', '4', '18'),
(135, 'Panquecitos', 18, 'BIMBO', '4', '14'),
(136, 'Madalenas', 18, 'BIMBO', '4', '15'),
(138, 'Roles con canela', 20, 'BIMBO', '4', '20'),
(139, 'Nito', 15, 'BIMBO', '4', '15'),
(140, 'Mantecadas Chispas de chocolate', 24, 'BIMBO', '4', '12'),
(141, 'Mantecadas Vainilla', 24, 'BIMBO', '4', '12'),
(142, 'Mantecadas de nuez', 24, 'BIMBO', '4', '12'),
(143, 'Conchas', 17, 'BIMBO', '4', '12'),
(144, 'Panque con pasas', 24, 'BIMBO', '4', '4'),
(145, 'Sabritas Originales', 14, 'SABRITAS', '5', '20'),
(146, 'Sabritas Limón', 14, 'SABRITAS', '5', '20'),
(147, 'Sabritas Habanero', 14, 'SABRITAS', '5', '20'),
(148, 'Sabritas Adobadas', 14, 'SABRITAS', '5', '20'),
(149, 'Sabritas fleming hot', 14, 'SABRITAS', '5', '14'),
(150, 'Sabritas crujientes Original', 15, 'SABRITAS', '5', '15'),
(151, 'Sabritas crujientes fleming hot', 15, 'SABRITAS', '5', '15'),
(152, 'Sabritas crujientes jalapeño', 15, 'SABRITAS', '5', '15'),
(153, 'Ruffles Original', 14, 'SABRITAS', '5', '15'),
(154, 'Ruffles Queso', 14, 'SABRITAS', '5', '14'),
(155, 'Sabritas chicharrones', 15, 'SABRITAS', '5', '15'),
(156, 'Ruffles mega crunch salsa roja', 15, 'SABRITAS', '5', '15'),
(157, 'Ruffles mega crunch jalapeño', 15, 'SABRITAS', '5', '15'),
(158, 'Tostitos salsa verde', 15, 'SABRITAS', '5', '14'),
(159, 'Tostitos fleming hot', 15, 'SABRITAS', '5', '15'),
(160, 'Doritos nacho', 14, 'SABRITAS', '5', '15'),
(161, 'Doritos diablo', 14, 'SABRITAS', '5', '15'),
(162, 'Doritos pizzerolas', 14, 'SABRITAS', '5', '15'),
(163, 'Doritos incognita', 14, 'SABRITAS', '5', '15'),
(164, 'Doritos dinamita fleming hot', 14, 'SABRITAS', '5', '15'),
(165, 'Chettos torciditos', 14, 'SABRITAS', '5', '15'),
(166, 'Chettos fleming hot', 14, 'SABRITAS', '5', '15'),
(167, 'Chettos poffs jalapeño', 13, 'SABRITAS', '5', '15'),
(168, 'Chettos bolita', 13, 'SABRITAS', '5', '15'),
(169, 'Rancheritos', 14, 'SABRITAS', '5', '15'),
(170, 'Tecate light', 19, 'CERVECERÍA', 'Refri_1', '70'),
(171, 'Tecate light six', 108, 'CERVECERÍA', 'Refri_1', '30'),
(172, 'Tecate original (rojo)', 19, 'CERVECERÍA', 'Refri_1', '50'),
(173, 'Tecate original (rojo)six', 108, 'CERVECERÍA', 'Refri_1', '50'),
(174, 'Caguama Carta Blanca', 34, 'CERVECERÍA', 'Refri_1', '30'),
(175, 'Caguama light chica', 34, 'CERVECERÍA', 'Refri_1', '30'),
(176, 'Caguama light grande', 42, 'CERVECERÍA', 'Refri_1', '30'),
(177, 'Caguama original grande', 42, 'CERVECERÍA', 'Refri_1', '30'),
(178, 'Caguama INDIO grande', 42, 'CERVECERÍA', 'Refri_1', '30'),
(179, 'Coca cola original 350 ml', 12, 'COCA COLA', 'Refri_2', '40'),
(180, 'Coca cola original 600 ml', 18, 'COCA COLA', 'Refri_2', '40'),
(181, 'Coca cola original 1 L', 19, 'COCA COLA', 'Refri_2', '30'),
(182, 'Coca cola original 1.5 L', 22, 'COCA COLA', 'Refri_2', '30'),
(183, 'Coca cola original 2 L', 29, 'COCA COLA', 'Refri_2', '30'),
(184, 'Coca cola original 2.5 L', 34, 'COCA COLA', 'Refri_2', '30'),
(185, 'Coca cola sin azúcar 600 ml', 18, 'COCA COLA', 'Refri_2', '30'),
(186, 'Coca cola light 600 ml', 18, 'COCA COLA', 'Refri_2', '40'),
(187, 'Joya manzana 600 ml', 18, 'COCA COLA', 'Refri_2', '30'),
(188, 'Sprite 600 ml', 18, 'COCA COLA', 'Refri_2', '30'),
(189, 'Fresca 600 ml', 18, 'COCA COLA', 'Refri_2', '40'),
(190, 'Joya ponche 600 ml', 18, 'COCA COLA', 'Refri_2', '30'),
(191, 'Agua Mineral  Topo Chico 600 ml', 18, 'COCA COLA', 'Refri_2', '30'),
(192, 'Coca cola original Medio litro (Vidrio)', 13, 'COCA COLA', 'Refri_2', '30'),
(193, 'Coca cola original chica (Vidrio)', 12, 'COCA COLA', 'Refri_2', '30'),
(194, 'Coca cola light (8Vidrio)', 13, 'COCA COLA', 'Refri_2', '30'),
(195, 'Joya manzana (Vidrio)', 13, 'COCA COLA', 'Refri_2', '30'),
(196, 'Fanta (Vidrio)', 13, 'COCA COLA', 'Refri_2', '30'),
(197, 'Pepsi 1.5 L', 22, 'Pepsi', 'Refro_3', '30'),
(198, 'Pepsi 2.5 L ', 33, 'Pepsi', 'Refro_3', '40'),
(199, 'Barrilito durazno 750 ml', 15, 'Barrilitos', 'Refro_3', '30'),
(200, 'Barrilito ponche 750 ml', 15, 'Barrilitos', 'Refro_3', '15'),
(201, 'Barrilito piña 750 ml', 15, 'Barrilitos', 'Refro_3', '30'),
(202, 'Jugo valle 237 ml', 9, 'COCA COLA', 'Refro_3', '25'),
(203, 'Jugo Vigor 200 ml', 8, 'JUMEX', 'Refro_3', '30'),
(204, 'Jugo JUMEX 250 ml', 13, 'JUMEX', 'Refro_3', '20'),
(205, 'Nesquik 240 ml', 13, 'Nestlé', 'Refro_3', '30'),
(206, 'Yogurt Lala 220 g', 14, 'LALA', 'Refro_3', '15'),
(207, 'Gelatinas LALA 125 g', 8, 'LALA', 'Refro_3', '20'),
(208, 'Flan LALA 125 g', 8, 'LALA', 'Refro_3', '20'),
(209, 'Leche Nutri 1 L', 20, 'LALA', 'Refro_3', '20'),
(210, 'Mantequilla', 20, 'LOCAL', 'Refro_3', '30'),
(211, 'Chorizo', 12, 'FUD', 'Refro_3', '15'),
(212, 'Jamón', 27, 'FUD', 'Refro_3', '20'),
(213, 'Salchichas', 25, 'FUD', 'Refro_3', '12'),
(214, 'Salchichas para asar', 12, 'FUD', 'Refro_3', '12'),
(215, 'Queso OAXACA', 43, 'La Villita', 'Refro_3', '20'),
(216, 'Queso Panela', 40, 'La Villita', 'Refro_3', '13'),
(217, 'Crema norteñita', 20, 'Norteñita', 'Refro_3', '13'),
(218, 'Queso amarillo', 15, 'La Villita', 'Refro_3', '15'),
(219, 'Fritos Prispas', 13, 'BOKADOS', '6', '15'),
(220, 'Fritos Mix', 15, 'BOKADOS', '6', '15'),
(221, 'Fritos Bokaditas', 13, 'BOKADOS', '6', '15'),
(222, 'Fritos Ruedas', 13, 'BOKADOS', '6', '15'),
(223, 'Fritos Chicharrones', 13, 'BOKADOS', '6', '15'),
(224, 'Cacahuates', 13, 'BOKADOS', '6', '15'),
(225, 'Semillas de calabaza', 13, 'BOKADOS', '6', '15'),
(226, 'Semillas girasol', 13, 'BOKADOS', '6', '15'),
(227, 'Cacahuates japoneses', 13, 'BOKADOS', '6', '15'),
(228, 'Fritos Strips', 15, 'BOKADOS', '6', '15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `ID_prov` int(11) NOT NULL,
  `nombre_prov` varchar(100) NOT NULL,
  `tel_prov` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`ID_prov`, `nombre_prov`, `tel_prov`, `email`) VALUES
(1, 'COCA-COLAa', '8181577510', 'salaprensa@coca-cola.com'),
(2, 'EMPRESA BIMBO', '8110908850', 'Atencionenlinea@grupobimbo.com'),
(3, 'SABRITAS SA DE CV', '8183274661', 'consumidores.1800@pepsico.com'),
(5, 'CERVECERÍA CUAUHTÉMOC -MOCTEZUMA  SA DE CV', '8183285000', 'contacto@heineken.com'),
(6, 'BOKADOS SA DE CV', '8181222300', 'contabilidad@fiavocado.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `fechaHora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_carrito`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID_cli`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`ID_prod`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`ID_prov`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID_cli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `ID_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `ID_prov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
