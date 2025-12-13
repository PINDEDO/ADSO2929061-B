-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2025 a las 02:59:59
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
-- Base de datos: `pokeadso`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gyms`
--

CREATE TABLE `gyms` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `gyms`
--

INSERT INTO `gyms` (`id`, `name`) VALUES
(2, 'fucshia'),
(1, 'palett');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pokemons`
--

CREATE TABLE `pokemons` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `type` varchar(32) NOT NULL,
  `strength` int(11) NOT NULL,
  `staming` int(11) NOT NULL,
  `speed` int(11) NOT NULL,
  `accuracy` int(11) NOT NULL,
  `trainer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pokemons`
--

INSERT INTO `pokemons` (`id`, `name`, `type`, `strength`, `staming`, `speed`, `accuracy`, `trainer_id`) VALUES
(1, 'pikachu', 'Electric', 90, 80, 96, 79, 1),
(2, 'charmander', 'Fire', 95, 78, 80, 82, 1),
(3, 'bulbasaour', 'Grass', 80, 88, 70, 75, 1),
(4, 'squirtle', 'Water', 70, 90, 75, 90, 1),
(5, 'Snorlax', 'Normal', 180, 320, 69, 180, 3),
(6, 'Vaporeon', 'Water', 186, 260, 90, 168, 1),
(7, 'Lapras', 'Water', 111, 255, 100, 168, 1),
(8, 'Blastoise', 'Water', 720, 158, 70, 222, 1),
(9, 'Golem', 'Water', 500, 160, 80, 198, 1),
(10, 'Dragonite', 'Dragon', 900, 250, 69, 182, 3),
(11, 'Exeggutor', 'Grass', 596, 190, 90, 232, 1),
(12, 'Omaster', 'Rock', 1500, 140, 112, 202, 1),
(13, 'Muk', 'Poison', 1070, 210, 112, 180, 1),
(14, 'Onix', 'Rock', 662, 70, 80, 90, 1),
(15, 'Poliwag', 'Water', 815, 80, 69, 108, 3),
(16, 'Mankey', 'Water', 563, 80, 70, 122, 2),
(17, 'Magnemite', 'Electric', 750, 50, 40, 128, 2),
(18, 'Pidgey', 'Normal', 818, 80, 95, 90, 2),
(19, 'Gastly', 'Ghost', 750, 60, 60, 82, 2),
(20, 'Rattata', 'Normal', 810, 60, 65, 22, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trainers`
--

CREATE TABLE `trainers` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `level` int(11) NOT NULL,
  `gym_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `trainers`
--

INSERT INTO `trainers` (`id`, `name`, `level`, `gym_id`) VALUES
(1, 'Ash Ketchum', 10, 1),
(2, 'Misty', 4, 2),
(3, 'Brok', 6, 2),
(4, 'Serena', 4, 2),
(5, 'Oak', 9, 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_pokemons`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_pokemons` (
`name_trainer` varchar(32)
,`name_pokemon` varchar(32)
,`name_gym` varchar(32)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `view_pokemons`
--
DROP TABLE IF EXISTS `view_pokemons`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_pokemons`  AS SELECT `trainers`.`name` AS `name_trainer`, `pokemons`.`name` AS `name_pokemon`, `gyms`.`name` AS `name_gym` FROM ((`trainers` join `pokemons` on(`trainers`.`id` = `pokemons`.`trainer_id`)) join `gyms` on(`trainers`.`gym_id` = `gyms`.`id`)) ORDER BY `trainers`.`name` ASC ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `gyms`
--
ALTER TABLE `gyms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `pokemons`
--
ALTER TABLE `pokemons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- Indices de la tabla `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `gym_id` (`gym_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `gyms`
--
ALTER TABLE `gyms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pokemons`
--
ALTER TABLE `pokemons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `trainers`
--
ALTER TABLE `trainers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pokemons`
--
ALTER TABLE `pokemons`
  ADD CONSTRAINT `pokemons_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`);

--
-- Filtros para la tabla `trainers`
--
ALTER TABLE `trainers`
  ADD CONSTRAINT `trainers_ibfk_1` FOREIGN KEY (`gym_id`) REFERENCES `gyms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
