-- Elimina la base de datos si existe
DROP DATABASE IF EXISTS restaurante;

-- Crea la base de datos
CREATE DATABASE restaurante;
USE restaurante;

-- Crea la tabla de reservas
CREATE TABLE IF NOT EXISTS reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    comensales INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
