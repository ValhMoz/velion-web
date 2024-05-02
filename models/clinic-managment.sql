-- Tabla para almacenar información de usuarios
CREATE TABLE usuarios (
    usuario_id VARCHAR(9) PRIMARY KEY,
    nombre VARCHAR(255),
    apellidos VARCHAR(255),
    telefono VARCHAR(100),
    fecha_nacimiento DATE,
    direccion VARCHAR(100),
    provincia VARCHAR(100),
    municipio VARCHAR(100),
    cp VARCHAR(7),
    email VARCHAR(100) UNIQUE,
    pass VARCHAR(255),
    rol ENUM('administrador', 'paciente', 'fisioterapeuta'),
    genero ENUM('hombre', 'mujer', 'otro'),
    sesiones_disponibles INT
);

-- Tabla para almacenar información de citas
CREATE TABLE citas (
    cita_id INT AUTO_INCREMENT PRIMARY KEY,
    paciente_id VARCHAR(9),
    fisioterapeuta_id VARCHAR(9),
    fecha DATE,
    hora VARCHAR(9),
    sala_consulta VARCHAR(50),
    estado ENUM('programada', 'cancelada', 'realizada'),
    FOREIGN KEY (paciente_id) REFERENCES usuarios(usuario_id),
    FOREIGN KEY (fisioterapeuta_id) REFERENCES usuarios(usuario_id)
);

-- Tabla para almacenar información de facturas
CREATE TABLE facturas (
    factura_id INT AUTO_INCREMENT PRIMARY KEY,
    paciente_id VARCHAR(9),
    fecha_emision DATE,
    descripcion VARCHAR(100),
    monto DECIMAL(10, 2),
    estado ENUM('pendiente', 'pagada'),
    FOREIGN KEY (paciente_id) REFERENCES usuarios(usuario_id)
);

CREATE TABLE historial_medico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    paciente_id VARCHAR(9),
    fisioterapeuta_id VARCHAR(9),
    fecha DATE,
    descripcion TEXT,
    diagnostico TEXT,
    tratamiento TEXT,
    notas TEXT,
    FOREIGN KEY (paciente_id) REFERENCES usuarios(usuario_id),
    FOREIGN KEY (fisioterapeuta_id) REFERENCES usuarios(usuario_id)
);

-- Insertar datos de prueba para la tabla usuarios
-- La contraseña está cifrada. Deberás escribir 12345678 en el formulario de inicio de sesión
INSERT INTO usuarios (usuario_id, nombre, apellidos, telefono, fecha_nacimiento, direccion, provincia, municipio, cp, email, pass, rol, genero, sesiones_disponibles)
VALUES
('123456789', 'Juan', 'Pérez', '123456789', '1990-01-01', 'Calle 123', 'Provincia 1', 'Ciudad 1', '12345', 'juan@example.com', '$2y$10$N7JA82u/XFyaeHM.4t44S.9KKcgpj5yikEYBZ8k/0cp4qmvA/MEb6', 'paciente', 'hombre', 5),
('234567890', 'María', 'López', '234567890', '1995-05-05', 'Avenida 456', 'Provincia 2', 'Ciudad 2', '23456', 'maria@example.com', '$2y$10$N7JA82u/XFyaeHM.4t44S.9KKcgpj5yikEYBZ8k/0cp4qmvA/MEb6', 'fisioterapeuta', 'mujer', 10),
('345678901', 'Pedro', 'Gómez', '345678901', '1985-10-10', 'Plaza 789', 'Provincia 3', 'Ciudad 3', '34567', 'pedro@example.com', '$2y$10$N7JA82u/XFyaeHM.4t44S.9KKcgpj5yikEYBZ8k/0cp4qmvA/MEb6', 'administrador', 'hombre', NULL);

-- Insertar datos de prueba para la tabla citas
INSERT INTO citas (paciente_id, fisioterapeuta_id, fecha_hora, sala_consulta, estado)
VALUES
('123456789', '234567890', '2024-04-05 09:00:00', 'Sala 1', 'realizada'),
('234567890', '345678901', '2024-04-06 10:00:00', 'Sala 2', 'programada'),
('345678901', '123456789', '2024-04-07 11:00:00', 'Sala 3', 'cancelada');

-- Insertar datos de prueba para la tabla facturas
INSERT INTO facturas (paciente_id, fecha_emision, descripcion, monto, estado)
VALUES
('123456789', '2024-04-01', 'Consulta médica', 50.00, 'pendiente'),
('234567890', '2024-04-02', 'Terapia física', 75.00, 'pagada'),
('345678901', '2024-04-03', 'Examen de diagnóstico', 100.00, 'pendiente');

-- Insertar datos de prueba para la tabla historial_medico
INSERT INTO historial_medico (paciente_id, fisioterapeuta_id, fecha, descripcion, diagnostico, tratamiento, notas)
VALUES
('123456789', '234567890', '2024-03-01', 'Paciente con dolor de espalda', 'Contractura muscular', 'Masajes y estiramientos', 'Reposo recomendado'),
('234567890', '345678901', '2024-03-02', 'Paciente con esguince de tobillo', 'Esguince grado II', 'Terapia de frío y calor, ejercicios de rehabilitación', 'Evolución positiva'),
('345678901', '123456789', '2024-03-03', 'Paciente con dolor de cuello', 'Contractura cervical', 'Masajes terapéuticos y ejercicios de estiramiento', 'Controlar postura durante actividades diarias');
