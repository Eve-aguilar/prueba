-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-07-2023 a las 15:49:55
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdusuario2023`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id_cargo` int(11) NOT NULL,
  `nombre_cargo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id_cargo`, `nombre_cargo`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'DESARROLLADOR'),
(3, 'INVITADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `apaterno` varchar(20) NOT NULL,
  `amaterno` varchar(20) NOT NULL,
  `nombres` varchar(40) NOT NULL,
  `usuario` varchar(40) NOT NULL,
  `password` varchar(80) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `id_cargo_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `apaterno`, `amaterno`, `nombres`, `usuario`, `password`, `foto`, `id_cargo_fk`) VALUES
(4, 'Mayta', 'GutiÃ©rrez', 'Alejandra Oriana', 'ale@gmail.com', '$2y$10$4GzuPMhw24qQwORcsqI10OVX0NkWsvrCVHjeyi3iC9yo9hXWRDebq', '1684329454_3392832a-4f29-4c58-8c6c-8682c48cbaf8.jpg', 1),
(21, 'FRI', 'FNEWOI', 'gwfew', 'd@gmail.com', '$2y$10$m6CHWniqUX1OZ4643ITfWuu7V57ZLy3v62iXp1XR1FeC/MOf/4wdi', '1684329583_52edcd57373ebf34c24fa632d232c6de.jpg', 2),
(24, 'Mamani', 'Mamani', 'Miguel', 'miguel@gmail.com', '$2y$10$llRVRqbZoSW.ikwp/.nFOuXYuQYMDYfxp6NtkGvdeLHqrzLSjyttO', '', 2),
(25, 'D', 'D', 'D', 'W@gmail.com', '$2y$10$EBtz9rIdKFIB3BSVw/DG0ekdgcX6mzQHU2ryQxoKuxhX.sgD6bm6C', '', 2),
(26, 'Aguilar', 'Vargas', 'Evelyn', 'aguilarvargasevelyn@gmail.com', '$2y$10$r8pW8JmZhS1KuGc2ShLbpega8POMNCCIeurwa6otlC5byHGTX3uNC', '', 1),
(27, 'a', 'a', 'a', 'a@gmail.com', '$2y$10$PoLVICHQvyapAdAxmfGWDOx0fcj5rsTshQVuZm2kUY3gBMiDvgiVO', '1686148249_Chrysanthemum.jpg', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_cargo_fk` (`id_cargo_fk`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_cargo_fk`) REFERENCES `cargo` (`id_cargo`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
