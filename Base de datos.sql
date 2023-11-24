-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-11-2023 a las 20:25:38
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `learning_sites`
--
CREATE DATABASE IF NOT EXISTS `learning_sites` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `learning_sites`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Programación'),
(2, 'Diseño'),
(3, 'Idiomas'),
(4, 'Ciencias'),
(5, 'Arte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `site_id`, `rating`) VALUES
(26, 1, 1, 5),
(27, 1, 2, 4),
(28, 2, 3, 5),
(29, 3, 4, 4),
(30, 2, 2, 4),
(31, 3, 3, 5),
(32, 4, 4, 4),
(33, 5, 5, 3),
(34, 1, 3, 4),
(35, 2, 1, 3),
(36, 3, 2, 5),
(37, 4, 5, 4),
(38, 5, 4, 2),
(39, 1, 5, 5),
(40, 2, 4, 4),
(41, 3, 1, 5),
(42, 4, 3, 4),
(43, 5, 2, 3),
(44, 1, 4, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sites`
--

CREATE TABLE `sites` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sites`
--

INSERT INTO `sites` (`id`, `title`, `url`, `description`, `category_id`, `image_url`, `user_id`) VALUES
(1, 'Codecademy', 'https://www.codecademy.com/', 'Plataforma interactiva de aprendizaje de programación.', 1, 'https://play-lh.googleusercontent.com/sfcMEVWE3eIUF5uQ2fo4MeLBFNDGaftbN_t6_i6zbvE6XC0dOcizOMA9cfigSXq7_92b', 1),
(2, 'Coursera', 'https://www.coursera.org/', 'Ofrece cursos online de diversas áreas académicas.', 4, 'https://www.usnews.com/object/image/00000174-976f-da32-a9fc-d7ff531b0000/200916-coursera-submitted.png?update-time=1600268540900&size=responsiveFlow300', 1),
(3, 'Duolingo', 'https://www.duolingo.com/', 'Aplicación para aprender idiomas de manera interactiva.', 3, 'https://www.langoly.com/wp-content/uploads/2020/03/Duolingo-app-icon.png', 2),
(4, 'Khan Academy', 'https://www.khanacademy.org/', 'Recursos educativos gratuitos en diversas materias.', 4, 'https://yt3.googleusercontent.com/ytc/APkrFKaHmx8qkQu272Abo2FF0ejEmqiBXwZAwPChz4aU=s900-c-k-c0x00ffffff-no-rj', 3),
(5, 'Udemy', 'https://www.udemy.com/', 'Plataforma de cursos online de variadas temáticas.', 2, 'https://play-lh.googleusercontent.com/oDuTGEHru1KMr3QOfQfPKgIdNnlq3WWQxpBYND23r2a7RVnS1HW0t7dyON86Vn_QhtM', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'john_doe', '$2y$10$5wqsYunXDx3Wxp.CrUJfgeDerK1xhvpHEHS5WpncH7Xr6eq28hG/O'),
(2, 'jane_smith', '$2y$10$5wqsYunXDx3Wxp.CrUJfgeDerK1xhvpHEHS5WpncH7Xr6eq28hG/O'),
(3, 'alex_wong', '$2y$10$5wqsYunXDx3Wxp.CrUJfgeDerK1xhvpHEHS5WpncH7Xr6eq28hG/O'),
(4, 'emily_jones', '$2y$10$5wqsYunXDx3Wxp.CrUJfgeDerK1xhvpHEHS5WpncH7Xr6eq28hG/O'),
(5, 'chris_miller', '$2y$10$5wqsYunXDx3Wxp.CrUJfgeDerK1xhvpHEHS5WpncH7Xr6eq28hG/O');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`site_id`),
  ADD KEY `site_id` (`site_id`);

--
-- Indices de la tabla `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `sites`
--
ALTER TABLE `sites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`);

--
-- Filtros para la tabla `sites`
--
ALTER TABLE `sites`
  ADD CONSTRAINT `sites_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `sites_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
