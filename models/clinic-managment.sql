-- Tabla para almacenar información de usuarios
CREATE TABLE usuarios (
    usuario_id VARCHAR(9) PRIMARY KEY,
    nombre VARCHAR(255),
    apellidos VARCHAR(255),
    telefono VARCHAR(100),
    direccion VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    pass VARCHAR(255),
    rol ENUM('administrador', 'paciente', 'fisioterapeuta'),
    genero ENUM('hombre', 'mujer', 'otro')
);

-- Tabla para almacenar información de citas
CREATE TABLE citas (
    cita_id INT AUTO_INCREMENT PRIMARY KEY,
    paciente_id VARCHAR(9),
    fisioterapeuta_id VARCHAR(9),
    fecha_hora DATETIME,
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
    monto DECIMAL(10, 2),
    estado ENUM('pendiente', 'pagada'),
    FOREIGN KEY (paciente_id) REFERENCES usuarios(usuario_id)
);

CREATE TABLE historial_medico (
    id INT AUTO_INCREMENT PRIMARY KEY,
    paciente_id VARCHAR(9),
    fecha DATE,
    descripcion TEXT,
    diagnostico TEXT,
    tratamiento TEXT,
    notas TEXT,
    FOREIGN KEY (paciente_id) REFERENCES usuarios(usuario_id)
);