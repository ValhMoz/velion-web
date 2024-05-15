-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: mysql
-- Tiempo de generación: 15-05-2024 a las 10:30:39
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
  `duracion_minutos` int DEFAULT NULL,
  `estado` enum('Programada','Cancelada','Realizada') DEFAULT NULL,
  `especialidad_id` int DEFAULT NULL,
  `historial_id` int DEFAULT NULL,
  `horario_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`cita_id`, `paciente_id`, `fisioterapeuta_id`, `fecha_hora`, `duracion_minutos`, `estado`, `especialidad_id`, `historial_id`, `horario_id`) VALUES
(1, '123456789', '234567890', '2024-01-15 10:00:00', 60, 'Realizada', 1, 1, 1),
(2, '123456789', '234567890', '2024-02-20 11:00:00', 60, 'Realizada', 1, 2, 2),
(3, '123456789', '234567890', '2024-03-25 09:00:00', 60, 'Realizada', 1, 3, 3),
(4, '123456789', '234567890', '2024-04-20 10:00:00', 60, 'Programada', 1, NULL, 4),
(5, '234567890', '345678901', '2024-05-05 14:00:00', 60, 'Cancelada', 2, NULL, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidades`
--

CREATE TABLE `especialidades` (
  `especialidad_id` int NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `especialidades`
--

INSERT INTO `especialidades` (`especialidad_id`, `descripcion`, `fecha`) VALUES
(1, 'Fisioterapia Deportiva', '2024-05-15 10:24:33'),
(2, 'Fisioterapia Neurológica', '2024-05-15 10:24:33'),
(3, 'Fisioterapia Respiratoria', '2024-05-15 10:24:33'),
(4, 'Fisioterapia Pediátrica', '2024-05-15 10:24:33'),
(5, 'Fisioterapia Geriátrica', '2024-05-15 10:24:33'),
(6, 'Fisioterapia Ortopédica', '2024-05-15 10:24:33'),
(7, 'Fisioterapia Cardiovascular', '2024-05-15 10:24:33'),
(8, 'Fisioterapia Oncológica', '2024-05-15 10:24:33'),
(9, 'Fisioterapia del Suelo Pélvico', '2024-05-15 10:24:33'),
(10, 'Fisioterapia Musculoesquelética', '2024-05-15 10:24:33'),
(11, 'Fisioterapia Acuática (Hidroterapia)', '2024-05-15 10:24:33'),
(12, 'Fisioterapia Manual', '2024-05-15 10:24:33'),
(13, 'Fisioterapia Deportiva Adaptada', '2024-05-15 10:24:33'),
(14, 'Fisioterapia del Dolor', '2024-05-15 10:24:33'),
(15, 'Fisioterapia Vestibular', '2024-05-15 10:24:33'),
(16, 'Fisioterapia en Salud Mental', '2024-05-15 10:24:33'),
(17, 'Fisioterapia Dermatofuncional', '2024-05-15 10:24:33'),
(18, 'Fisioterapia en Disfunciones Temporomandibulares', '2024-05-15 10:24:33'),
(19, 'Fisioterapia en Traumatología y Cirugía Ortopédica', '2024-05-15 10:24:33'),
(20, 'Fisioterapia en Salud de la Mujer (Maternidad y Postparto)', '2024-05-15 10:24:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `factura_id` int NOT NULL,
  `paciente_id` varchar(9) DEFAULT NULL,
  `fecha_emision` date DEFAULT NULL,
  `producto` int DEFAULT NULL,
  `estado` enum('Pendiente','Pagada') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`factura_id`, `paciente_id`, `fecha_emision`, `producto`, `estado`) VALUES
(1, '123456789', '2024-04-01', 2, 'Pendiente'),
(2, '234567890', '2024-04-02', 5, 'Pagada'),
(3, '345678901', '2024-04-03', 1, 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_medico`
--

CREATE TABLE `historial_medico` (
  `historial_id` int NOT NULL,
  `paciente_id` varchar(9) DEFAULT NULL,
  `fisioterapeuta_id` varchar(9) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `descripcion` text,
  `diagnostico` text,
  `tratamiento` text,
  `notas` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `historial_medico`
--

INSERT INTO `historial_medico` (`historial_id`, `paciente_id`, `fisioterapeuta_id`, `fecha`, `descripcion`, `diagnostico`, `tratamiento`, `notas`) VALUES
(1, '123456789', '234567890', '2024-01-15 10:00:00', 'Dolor de espalda', 'Lumbalgia', 'Fisioterapia y ejercicios de fortalecimiento', 'Mejoría progresiva'),
(2, '123456789', '234567890', '2024-02-20 11:00:00', 'Revisión de dolor de espalda', 'Lumbalgia', 'Continuar con fisioterapia', 'Dolor disminuido en un 50%'),
(3, '123456789', '234567890', '2024-03-25 09:00:00', 'Rehabilitación post cirugía de rodilla', 'Post-cirugía', 'Ejercicios de movilidad y fortalecimiento', 'Buena evolución');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `horario_id` int NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `estado` enum('Activo','Pendiente','Cancelado') DEFAULT NULL,
  `ult_modificacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`horario_id`, `nombre`, `estado`, `ult_modificacion`) VALUES
(1, 'Lunes Mañana', 'Activo', '2024-05-15 10:24:33'),
(2, 'Lunes Tarde', 'Activo', '2024-05-15 10:24:33'),
(3, 'Martes Mañana', 'Activo', '2024-05-15 10:24:33'),
(4, 'Martes Tarde', 'Activo', '2024-05-15 10:24:33'),
(5, 'Miércoles Mañana', 'Activo', '2024-05-15 10:24:33'),
(6, 'Miércoles Tarde', 'Activo', '2024-05-15 10:24:33'),
(7, 'Jueves Mañana', 'Activo', '2024-05-15 10:24:33'),
(8, 'Jueves Tarde', 'Activo', '2024-05-15 10:24:33'),
(9, 'Viernes Mañana', 'Activo', '2024-05-15 10:24:33'),
(10, 'Viernes Tarde', 'Activo', '2024-05-15 10:24:33'),
(11, 'Sábado Mañana', 'Activo', '2024-05-15 10:24:33'),
(12, 'Sábado Tarde', 'Activo', '2024-05-15 10:24:33'),
(13, 'Domingo Mañana', 'Activo', '2024-05-15 10:24:33'),
(14, 'Domingo Tarde', 'Activo', '2024-05-15 10:24:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `producto_id` int NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `monto` int DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`producto_id`, `nombre`, `descripcion`, `monto`, `fecha`) VALUES
(1, 'Sesión individual', '', 35, '2024-05-15 10:24:33'),
(2, 'Bono de 10 sesiones', '(30€/sesión)', 300, '2024-05-15 10:24:33'),
(3, 'Bono de 15 sesiones', '(26€/sesión)', 390, '2024-05-15 10:24:33'),
(4, 'Bono de 20 sesiones', '(24€/sesión)', 480, '2024-05-15 10:24:33'),
(5, 'Bono de 30 sesiones', '(20,5€/sesión)', 615, '2024-05-15 10:24:33'),
(6, 'Bono especial de 10 sesiones', '(37€/sesión)', 370, '2024-05-15 10:24:33');

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
  `rol` enum('Administrador','Paciente','Fisioterapeuta') DEFAULT NULL,
  `genero` enum('hombre','mujer','otro') DEFAULT NULL,
  `especialidad` int DEFAULT NULL,
  `sesiones_disponibles` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `nombre`, `apellidos`, `telefono`, `fecha_nacimiento`, `direccion`, `provincia`, `municipio`, `cp`, `email`, `pass`, `rol`, `genero`, `especialidad`, `sesiones_disponibles`) VALUES
('123456789', 'Juan', 'Perez', '123456789', '1990-01-01', 'Calle 123', 'Provincia 1', 'Ciudad 1', '12345', 'patient@example.com', '$2y$10$N7JA82u/XFyaeHM.4t44S.9KKcgpj5yikEYBZ8k/0cp4qmvA/MEb6', 'Paciente', 'hombre', 10, NULL),
('234567890', 'Maria', 'Lopez', '234567890', '1995-05-05', 'Avenida 456', 'Provincia 2', 'Ciudad 2', '23456', 'fisio@example.com', '$2y$10$N7JA82u/XFyaeHM.4t44S.9KKcgpj5yikEYBZ8k/0cp4qmvA/MEb6', 'Fisioterapeuta', 'mujer', NULL, 10),
('345678901', 'Pedro', 'Gomez', '345678901', '1985-10-10', 'Plaza 789', 'Provincia 3', 'Ciudad 3', '34567', 'admin@example.com', '$2y$10$N7JA82u/XFyaeHM.4t44S.9KKcgpj5yikEYBZ8k/0cp4qmvA/MEb6', 'Administrador', 'hombre', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`cita_id`),
  ADD UNIQUE KEY `historial_id` (`historial_id`),
  ADD KEY `paciente_id` (`paciente_id`),
  ADD KEY `fisioterapeuta_id` (`fisioterapeuta_id`),
  ADD KEY `especialidad_id` (`especialidad_id`),
  ADD KEY `horario_id` (`horario_id`);

--
-- Indices de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`especialidad_id`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`factura_id`),
  ADD KEY `paciente_id` (`paciente_id`),
  ADD KEY `producto` (`producto`);

--
-- Indices de la tabla `historial_medico`
--
ALTER TABLE `historial_medico`
  ADD PRIMARY KEY (`historial_id`),
  ADD KEY `paciente_id` (`paciente_id`),
  ADD KEY `fisioterapeuta_id` (`fisioterapeuta_id`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`horario_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`producto_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `especialidad` (`especialidad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `cita_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `especialidades`
--
ALTER TABLE `especialidades`
  MODIFY `especialidad_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `factura_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `historial_medico`
--
ALTER TABLE `historial_medico`
  MODIFY `historial_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `horario_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `producto_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `usuarios` (`usuario_id`),
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`fisioterapeuta_id`) REFERENCES `usuarios` (`usuario_id`),
  ADD CONSTRAINT `citas_ibfk_3` FOREIGN KEY (`especialidad_id`) REFERENCES `especialidades` (`especialidad_id`),
  ADD CONSTRAINT `citas_ibfk_4` FOREIGN KEY (`horario_id`) REFERENCES `horarios` (`horario_id`),
  ADD CONSTRAINT `citas_ibfk_5` FOREIGN KEY (`historial_id`) REFERENCES `historial_medico` (`historial_id`);

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `usuarios` (`usuario_id`),
  ADD CONSTRAINT `facturas_ibfk_2` FOREIGN KEY (`producto`) REFERENCES `productos` (`producto_id`);

--
-- Filtros para la tabla `historial_medico`
--
ALTER TABLE `historial_medico`
  ADD CONSTRAINT `historial_medico_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `usuarios` (`usuario_id`),
  ADD CONSTRAINT `historial_medico_ibfk_2` FOREIGN KEY (`fisioterapeuta_id`) REFERENCES `usuarios` (`usuario_id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`especialidad`) REFERENCES `especialidades` (`especialidad_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
