-- Creación de la base de datos (si no existe)
CREATE DATABASE IF NOT EXISTS weather_app;
USE weather_app;

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de datos meteorológicos
CREATE TABLE IF NOT EXISTS weather_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    city VARCHAR(100) NOT NULL,
    temperature FLOAT NOT NULL,
    description VARCHAR(255) NOT NULL,
    date_time DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Inserción de usuario de prueba
INSERT INTO users (username, email, password)
VALUES ('prueba', 'prueb@prueba.com', PASSWORD('123456'));
