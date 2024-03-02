-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 02-03-2024 a las 13:37:07
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
-- Base de datos: `project-crm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `appointments`
--

CREATE TABLE `appointments` (
  `ID_Cita` int(11) NOT NULL,
  `ID_Paciente` int(11) DEFAULT NULL,
  `ID_Fisioterapeuta` int(11) DEFAULT NULL,
  `FechaHora_C` datetime DEFAULT NULL,
  `Duracion_C` int(11) DEFAULT NULL,
  `Notas_C` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invoices`
--

CREATE TABLE `invoices` (
  `ID_Factura` int(11) NOT NULL,
  `ID_Paciente` int(11) DEFAULT NULL,
  `FechaEmision_FA` date DEFAULT NULL,
  `Total_FA` decimal(10,2) DEFAULT NULL,
  `EstadoPago_FA` varchar(20) DEFAULT NULL,
  `MetodoPago_FA` varchar(20) DEFAULT NULL,
  `Detalles_FA` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patients`
--

CREATE TABLE `patients` (
  `ID_Paciente` int(11) NOT NULL,
  `Nombre_P` varchar(50) DEFAULT NULL,
  `Apellido_P` varchar(50) DEFAULT NULL,
  `Direccion_P` varchar(100) DEFAULT NULL,
  `Telefono_P` varchar(15) DEFAULT NULL,
  `CorreoElectronico_P` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `patients`
--

INSERT INTO `patients` (`ID_Paciente`, `Nombre_P`, `Apellido_P`, `Direccion_P`, `Telefono_P`, `CorreoElectronico_P`) VALUES
(1, 's', 's', 's', '6', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `physiotherapists`
--

CREATE TABLE `physiotherapists` (
  `ID_Fisioterapeuta` int(11) NOT NULL,
  `Nombre_F` varchar(50) DEFAULT NULL,
  `Apellido_F` varchar(50) DEFAULT NULL,
  `Especialidad_F` varchar(50) DEFAULT NULL,
  `Telefono_F` varchar(15) DEFAULT NULL,
  `CorreoElectronico_F` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `user-type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `lastname`, `password`, `email`, `user-type`) VALUES
(1, 'miguelon', 'Miguel', 'Ortega', '1234', 'hola@gmail.com', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`ID_Cita`),
  ADD KEY `ID_Paciente` (`ID_Paciente`),
  ADD KEY `ID_Fisioterapeuta` (`ID_Fisioterapeuta`);

--
-- Indices de la tabla `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`ID_Factura`),
  ADD KEY `ID_Paciente` (`ID_Paciente`);

--
-- Indices de la tabla `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`ID_Paciente`);

--
-- Indices de la tabla `physiotherapists`
--
ALTER TABLE `physiotherapists`
  ADD PRIMARY KEY (`ID_Fisioterapeuta`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`ID_Paciente`) REFERENCES `patients` (`ID_Paciente`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`ID_Fisioterapeuta`) REFERENCES `physiotherapists` (`ID_Fisioterapeuta`);

--
-- Filtros para la tabla `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`ID_Paciente`) REFERENCES `patients` (`ID_Paciente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;