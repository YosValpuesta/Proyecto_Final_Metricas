-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-05-2024 a las 06:44:32
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
-- Base de datos: `dashboard`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hu`
--

CREATE TABLE `hu` (
  `numeroHU` int(3) NOT NULL,
  `Nombre` varchar(40) NOT NULL,
  `PH` int(3) NOT NULL,
  `Responsable` varchar(20) NOT NULL,
  `Sprint` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hu`
--

INSERT INTO `hu` (`numeroHU`, `Nombre`, `PH`, `Responsable`, `Sprint`) VALUES
(1, 'Registro de usuarios', 13, 'Jorge-Scrum', 1),
(2, 'Inicio de sesión ', 8, 'DianaSev', 1),
(3, 'Gestionar perfiles', 13, 'Juan18', 1),
(5, 'Modificar cuenta ', 5, 'JuanitoCruz', 1),
(6, 'Búsqueda de contenido ', 3, 'YosValpuesta', 2),
(7, 'Reproducción de contenido', 20, 'DianaSev', 2),
(8, 'Control de reproducción ', 5, 'JuanitoCruz', 2),
(9, 'Agregar a ver más tarde', 2, 'DianaSev', 3),
(10, 'Calificar películas', 5, 'Jorge-Scrum', 3),
(11, 'Sistema de recomendaciones', 5, 'YosValpuesta', 3),
(12, 'Gestión de pagos ', 8, 'Juan18', 3),
(13, 'PruebaCapturaPrueba', 2, 'Juan18', 2),
(14, 'yuyu', 1, 'DianaSev', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hu_tablero`
--

CREATE TABLE `hu_tablero` (
  `numeroHU` int(3) NOT NULL,
  `Estado` varchar(30) NOT NULL,
  `FechaAgregada` date DEFAULT NULL,
  `FechaIniciada` date DEFAULT NULL,
  `FechaTerminada` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hu_tablero`
--

INSERT INTO `hu_tablero` (`numeroHU`, `Estado`, `FechaAgregada`, `FechaIniciada`, `FechaTerminada`) VALUES
(1, 'Terminada', '2024-05-06', '2024-05-07', '2024-05-10'),
(2, 'Terminada', '2024-05-06', '2024-05-06', '2024-05-09'),
(3, 'Terminada', '2024-05-08', '2024-05-09', '2024-05-09'),
(5, 'Terminada', '2024-05-09', '2024-05-09', '2024-05-10'),
(6, 'Terminada', '2024-05-13', '2024-05-13', '2024-05-15'),
(7, 'Terminada', '2024-05-16', '2024-05-16', '2024-05-17'),
(8, 'Terminada', '2024-05-15', '2024-05-16', '2024-05-16'),
(9, 'Terminada', '2024-05-20', '2024-05-20', '2024-05-21'),
(10, 'Terminada', '2024-05-21', '2024-05-22', '2024-05-23'),
(11, 'Terminada', '2024-05-22', '2024-05-22', '2024-05-24'),
(12, 'Terminada', '2024-05-22', '2024-05-23', '2024-05-24'),
(13, 'Terminada', '2024-05-11', '2024-05-12', '2024-05-13'),
(14, 'En progreso', '2024-05-11', '2024-05-12', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metricawip`
--

CREATE TABLE `metricawip` (
  `idWIP` int(2) NOT NULL,
  `valorPorHacer` int(3) DEFAULT NULL,
  `valorHaciendo` int(3) DEFAULT NULL,
  `proyectoNombre` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `metricawip`
--

INSERT INTO `metricawip` (`idWIP`, `valorPorHacer`, `valorHaciendo`, `proyectoNombre`) VALUES
(1, 1, 1, 'Aplicacion-Streaming');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tablero`
--

CREATE TABLE `tablero` (
  `Nombre` varchar(40) NOT NULL,
  `TotalSprint` int(2) NOT NULL,
  `DuracionSprint` int(2) NOT NULL,
  `Duracion` varchar(20) NOT NULL,
  `Desarrolladores` int(2) NOT NULL,
  `FechaInicio` date NOT NULL,
  `FechaFin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tablero`
--

INSERT INTO `tablero` (`Nombre`, `TotalSprint`, `DuracionSprint`, `Duracion`, `Desarrolladores`, `FechaInicio`, `FechaFin`) VALUES
('Aplicacion-Streaming', 3, 5, 'Dias', 4, '2024-05-06', '2024-05-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Usuario` varchar(20) NOT NULL,
  `Nombre` varchar(40) DEFAULT NULL,
  `Apellidos` varchar(60) DEFAULT NULL,
  `Correo` varchar(40) NOT NULL,
  `Contraseña` varchar(15) NOT NULL,
  `Rol` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Usuario`, `Nombre`, `Apellidos`, `Correo`, `Contraseña`, `Rol`) VALUES
('DianaSev', 'Diana', 'Sevilla Perez', 'diana14@gmail.com', 'uacm123', 'Desarrollador'),
('Jorge-Scrum', 'Jorge', 'Hernández Ortiz', 'jorHer@gmail.com', 'uacm124', 'Diseñador'),
('Juan18', 'JUAN', 'JUAREZ ROSAS', 'juan18@gmail.com', '12345678', 'Tester'),
('JuanitoCruz', 'Juan', 'Flores Cruz', 'juan.98@gmail.com', 'uacm123', 'Desarrollador'),
('YosValpuesta', 'Yoselin', 'Valpuesta', 'yose.valpuesta@gmail.com', 'uacm123', 'Desarrollador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `hu`
--
ALTER TABLE `hu`
  ADD PRIMARY KEY (`numeroHU`,`Nombre`);

--
-- Indices de la tabla `hu_tablero`
--
ALTER TABLE `hu_tablero`
  ADD KEY `numeroHU` (`numeroHU`);

--
-- Indices de la tabla `metricawip`
--
ALTER TABLE `metricawip`
  ADD KEY `proyectoNombre` (`proyectoNombre`);

--
-- Indices de la tabla `tablero`
--
ALTER TABLE `tablero`
  ADD PRIMARY KEY (`Nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `hu`
--
ALTER TABLE `hu`
  MODIFY `numeroHU` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `hu_tablero`
--
ALTER TABLE `hu_tablero`
  ADD CONSTRAINT `hu_tablero_ibfk_1` FOREIGN KEY (`numeroHU`) REFERENCES `hu` (`numeroHU`);

--
-- Filtros para la tabla `metricawip`
--
ALTER TABLE `metricawip`
  ADD CONSTRAINT `metricawip_ibfk_1` FOREIGN KEY (`proyectoNombre`) REFERENCES `tablero` (`Nombre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
