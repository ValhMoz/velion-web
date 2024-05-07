-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql
-- Tiempo de generación: 07-05-2024 a las 11:07:27
-- Versión del servidor: 8.3.0
-- Versión de PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clinic-managment`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `cita_id` int NOT NULL,
  `paciente_id` varchar(9) DEFAULT NULL,
  `fisioterapeuta_id` varchar(9) DEFAULT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `sala_consulta` varchar(50) DEFAULT NULL,
  `estado` enum('Programada','Cancelada','Realizada') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`cita_id`, `paciente_id`, `fisioterapeuta_id`, `fecha_hora`, `hora`, `sala_consulta`, `estado`) VALUES
(1, '123456789', '234567890', '2024-04-05 00:00:00', '09:00:00', 'Sala 1', 'Realizada'),
(2, '234567890', '345678901', '2024-04-06 00:00:00', '10:00:00', 'Sala 2', 'Programada'),
(3, '345678901', '123456789', '2024-04-07 00:00:00', '11:00:00', 'Sala 3', 'Cancelada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidades`
--

CREATE TABLE `especialidades` (
  `id` int NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `especialidades`
--

INSERT INTO `especialidades` (`id`, `descripcion`, `fecha`) VALUES
(1, 'Fisioterapia Deportiva', '2024-05-03 10:35:36'),
(2, 'Fisioterapia Neurológica', '2024-05-03 10:35:36'),
(3, 'Fisioterapia Respiratoria', '2024-05-03 10:35:36'),
(4, 'Fisioterapia Pediátrica', '2024-05-03 10:35:36'),
(5, 'Fisioterapia Geriátrica', '2024-05-03 10:35:36'),
(6, 'Fisioterapia Ortopédica', '2024-05-03 10:35:36'),
(7, 'Fisioterapia Cardiovascular', '2024-05-03 10:35:36'),
(8, 'Fisioterapia Oncológica', '2024-05-03 10:35:36'),
(9, 'Fisioterapia del Suelo Pélvico', '2024-05-03 10:35:36'),
(10, 'Fisioterapia Musculoesquelética', '2024-05-03 10:35:36'),
(11, 'Fisioterapia Acuática (Hidroterapia)', '2024-05-03 10:35:36'),
(12, 'Fisioterapia Manual', '2024-05-03 10:35:36'),
(13, 'Fisioterapia Deportiva Adaptada', '2024-05-03 10:35:36'),
(14, 'Fisioterapia del Dolor', '2024-05-03 10:35:36'),
(15, 'Fisioterapia Vestibular', '2024-05-03 10:35:36'),
(16, 'Fisioterapia en Salud Mental', '2024-05-03 10:35:36'),
(17, 'Fisioterapia Dermatofuncional', '2024-05-03 10:35:36'),
(18, 'Fisioterapia en Disfunciones Temporomandibulares', '2024-05-03 10:35:36'),
(19, 'Fisioterapia en Traumatología y Cirugía Ortopédica', '2024-05-03 10:35:36'),
(20, 'Fisioterapia en Salud de la Mujer (Maternidad y Postparto)', '2024-05-03 10:35:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `factura_id` int NOT NULL,
  `paciente_id` varchar(9) DEFAULT NULL,
  `fecha_emision` date DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `monto` decimal(10,2) DEFAULT NULL,
  `estado` enum('Pendiente','Pagada') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`factura_id`, `paciente_id`, `fecha_emision`, `descripcion`, `monto`, `estado`) VALUES
(1, '123456789', '2024-04-01', 'Consulta medica', 50.00, 'Pendiente'),
(2, '234567890', '2024-04-02', 'Terapia fisica', 75.00, 'Pagada'),
(3, '345678901', '2024-04-03', 'Examen de diagnostico', 100.00, 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_medico`
--

CREATE TABLE `historial_medico` (
  `id` int NOT NULL,
  `paciente_id` varchar(9) DEFAULT NULL,
  `fisioterapeuta_id` varchar(9) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `descripcion` text,
  `diagnostico` text,
  `tratamiento` text,
  `notas` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `historial_medico`
--

INSERT INTO `historial_medico` (`id`, `paciente_id`, `fisioterapeuta_id`, `fecha`, `descripcion`, `diagnostico`, `tratamiento`, `notas`) VALUES
(1, '123456789', '234567890', '2024-03-01', 'Paciente con dolor de espalda', 'Contractura muscular', 'Masajes y estiramientos', 'Reposo recomendado'),
(2, '234567890', '345678901', '2024-03-02', 'Paciente con esguince de tobillo', 'Esguince grado II', 'Terapia de frío y calor, ejercicios de rehabilitacion', 'Evolucion positiva'),
(3, '345678901', '123456789', '2024-03-03', 'Paciente con dolor de cuello', 'Contractura cervical', 'Masajes terapéuticos y ejercicios de estiramiento', 'Controlar postura durante actividades diarias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id` int NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `estado` enum('Activo','Pendiente','Cancelado') DEFAULT NULL,
  `ult_modificacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id`, `nombre`, `estado`, `ult_modificacion`) VALUES
(1, 'Lunes Mañana', 'Activo', '2024-05-03 11:40:47'),
(2, 'Lunes Tarde', 'Activo', '2024-05-03 11:40:47'),
(3, 'Martes Mañana', 'Cancelado', '2024-05-03 11:50:16'),
(4, 'Martes Tarde', 'Activo', '2024-05-03 11:40:47'),
(5, 'Miércoles Mañana', 'Activo', '2024-05-03 11:40:47'),
(6, 'Miércoles Tarde', 'Pendiente', '2024-05-03 11:50:13'),
(7, 'Jueves Mañana', 'Activo', '2024-05-03 11:40:47'),
(8, 'Jueves Tarde', 'Activo', '2024-05-03 11:40:47'),
(9, 'Viernes Mañana', 'Activo', '2024-05-03 11:40:47'),
(10, 'Viernes Tarde', 'Activo', '2024-05-03 11:40:47'),
(11, 'Sábado Mañana', 'Activo', '2024-05-03 11:40:47'),
(12, 'Sábado Tarde', 'Activo', '2024-05-03 11:40:47'),
(13, 'Domingo Mañana', 'Activo', '2024-05-03 11:40:47'),
(14, 'Domingo Tarde', 'Activo', '2024-05-03 11:40:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario_id` varchar(9) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `telefono` varchar(100) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `provincia` varchar(100) DEFAULT NULL,
  `municipio` varchar(100) DEFAULT NULL,
  `cp` varchar(7) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `rol` enum('Administrador','Paciente','Fisioterapeuta') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `genero` enum('hombre','mujer','otro') DEFAULT NULL,
  `sesiones_disponibles` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `nombre`, `apellidos`, `telefono`, `fecha_nacimiento`, `direccion`, `provincia`, `municipio`, `cp`, `email`, `pass`, `rol`, `genero`, `sesiones_disponibles`) VALUES
('123456789', 'Juan', 'Perez', '123456789', '1990-01-01', 'Calle 123', 'Provincia 1', 'Ciudad 1', '12345', 'patient@example.com', '$2y$10$N7JA82u/XFyaeHM.4t44S.9KKcgpj5yikEYBZ8k/0cp4qmvA/MEb6', 'Paciente', 'hombre', 5),
('234567890', 'Maria', 'Lopez', '234567890', '1995-05-05', 'Avenida 456', 'Provincia 2', 'Ciudad 2', '23456', 'fisio@example.com', '$2y$10$N7JA82u/XFyaeHM.4t44S.9KKcgpj5yikEYBZ8k/0cp4qmvA/MEb6', 'Fisioterapeuta', 'mujer', 10),
('345678901', 'Pedro', 'Gomez', '345678901', '1985-10-10', 'Plaza 789', 'Provincia 3', 'Ciudad 3', '34567', 'admin@example.com', '$2y$10$N7JA82u/XFyaeHM.4t44S.9KKcgpj5yikEYBZ8k/0cp4qmvA/MEb6', 'Administrador', 'hombre', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`cita_id`),
  ADD KEY `paciente_id` (`paciente_id`),
  ADD KEY `fisioterapeuta_id` (`fisioterapeuta_id`);

--
-- Indices de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`factura_id`),
  ADD KEY `paciente_id` (`paciente_id`);

--
-- Indices de la tabla `historial_medico`
--
ALTER TABLE `historial_medico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paciente_id` (`paciente_id`),
  ADD KEY `fisioterapeuta_id` (`fisioterapeuta_id`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `cita_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `factura_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `historial_medico`
--
ALTER TABLE `historial_medico`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `usuarios` (`usuario_id`),
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`fisioterapeuta_id`) REFERENCES `usuarios` (`usuario_id`);

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `usuarios` (`usuario_id`);

--
-- Filtros para la tabla `historial_medico`
--
ALTER TABLE `historial_medico`
  ADD CONSTRAINT `historial_medico_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `usuarios` (`usuario_id`),
  ADD CONSTRAINT `historial_medico_ibfk_2` FOREIGN KEY (`fisioterapeuta_id`) REFERENCES `usuarios` (`usuario_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
