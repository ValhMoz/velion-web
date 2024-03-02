-- Tabla para almacenar información de pacientes
CREATE TABLE pacientes (
    paciente_id VARCHAR(9) PRIMARY KEY,
    nombre VARCHAR(100),
    apellido VARCHAR(100),
    fecha_nacimiento DATE,
    genero ENUM('masculino', 'femenino', 'otro'),
    sesiones_disponibles INT,
    telefono VARCHAR(20),
    direccion VARCHAR(255)
);

-- Tabla para almacenar información de médicos
CREATE TABLE fisioterapeutas (
    fisioterapeuta_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    apellido VARCHAR(100),
    telefono VARCHAR(20)
);

-- Tabla para almacenar información de citas
CREATE TABLE citas (
    cita_id INT AUTO_INCREMENT PRIMARY KEY,
    paciente_id VARCHAR(9),
    fisioterapeuta_id INT,
    fecha_hora DATETIME,
    sala_consulta VARCHAR(50),
    estado ENUM('programada', 'cancelada', 'realizada'),
    FOREIGN KEY (paciente_id) REFERENCES pacientes(paciente_id),
    FOREIGN KEY (fisioterapeuta_id) REFERENCES fisioterapeutas(fisioterapeuta_id)
);

-- Tabla para almacenar información de usuarios
CREATE TABLE usuarios (
    usuario_id VARCHAR(9) PRIMARY KEY,
    nombre_usuario VARCHAR(50) UNIQUE,
    email VARCHAR(100),
    contraseña VARCHAR(255),
    rol ENUM('administrador', 'recepcionista', 'fisioterapeuta')
);

-- Tabla para almacenar información de usuarios
CREATE TABLE usuarios (
    usuario_id VARCHAR(9) PRIMARY KEY,
    nombre_usuario VARCHAR(50) UNIQUE,
    email VARCHAR(100),
    contraseña VARCHAR(255),
    rol ENUM('administrador', 'recepcionista', 'fisioterapeuta'),
    paciente_id VARCHAR(9),
    fisioterapeuta_id INT,
    FOREIGN KEY (paciente_id) REFERENCES pacientes(paciente_id),
    FOREIGN KEY (fisioterapeuta_id) REFERENCES fisioterapeutas(fisioterapeuta_id)
);


-- Creamos una tabla intermedia para la relación entre usuarios y pacientes/fisioterapeutas
CREATE TABLE usuarios_roles (
    usuario_id VARCHAR(9) PRIMARY KEY,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(usuario_id) ON DELETE CASCADE,
    paciente_id VARCHAR(9),
    FOREIGN KEY (paciente_id) REFERENCES pacientes(paciente_id) ON DELETE CASCADE,
    fisioterapeuta_id INT,
    FOREIGN KEY (fisioterapeuta_id) REFERENCES fisioterapeutas(fisioterapeuta_id) ON DELETE CASCADE,
    CONSTRAINT chk_roles CHECK (
        (paciente_id IS NOT NULL AND fisioterapeuta_id IS NULL) OR
        (paciente_id IS NULL AND fisioterapeuta_id IS NOT NULL)
    )
);

-- Tabla para almacenar información de facturas
CREATE TABLE facturas (
    factura_id INT AUTO_INCREMENT PRIMARY KEY,
    paciente_id VARCHAR(9),
    fecha_emision DATE,
    monto DECIMAL(10, 2),
    estado ENUM('pendiente', 'pagada'),
    FOREIGN KEY (paciente_id) REFERENCES pacientes(paciente_id)
);