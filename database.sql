CREATE DATABASE IF NOT EXISTS cooperativa_escuela;
USE cooperativa_escuela;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    segundo_nombre VARCHAR(50),
    apellido_paterno VARCHAR(50),
    apellido_materno VARCHAR(50),
    grado VARCHAR(10),
    grupo VARCHAR(10),
    correo VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    rol ENUM('alumno', 'propietario') DEFAULT 'alumno'
);

CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    codigo_pedido VARCHAR(25) UNIQUE,
    comentario TEXT,
    total DECIMAL(10,2),
    estatus ENUM('pendiente', 'entregado') DEFAULT 'pendiente',
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Acceso Propietario: admin@cecyte06.edu.mx | Pass: Cecyte2026
INSERT INTO usuarios (nombre, apellido_paterno, correo, password, rol) 
VALUES ('Admin', 'Tepeyanco', 'admin@cecyte06.edu.mx', 'Cecyte2026', 'propietario');