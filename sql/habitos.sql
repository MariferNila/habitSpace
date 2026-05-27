CREATE DATABASE IF NOT EXISTS proyecto_integrador;

USE proyecto_integrador;

CREATE TABLE usuarios (

    id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin','usuario') DEFAULT 'usuario',
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    UNIQUE KEY correo (correo)

);

CREATE TABLE habitos (

    id INT NOT NULL AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    descripcion TEXT,
    frecuencia VARCHAR(255) DEFAULT NULL,
    meta VARCHAR(255) DEFAULT '',
    completado TINYINT(1) DEFAULT 0,
    fecha DATE DEFAULT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    ultima_fecha DATE DEFAULT NULL,
    dias_completados INT DEFAULT 0,

    PRIMARY KEY (id),
    KEY usuario_id (usuario_id),

    CONSTRAINT habitos_ibfk_1
    FOREIGN KEY (usuario_id)
    REFERENCES usuarios(id)
    ON DELETE CASCADE

);

CREATE TABLE metas (

    id INT NOT NULL AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    nombre VARCHAR(100) DEFAULT NULL,
    objetivo INT DEFAULT NULL,
    progreso INT DEFAULT 0,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    KEY usuario_id (usuario_id),

    CONSTRAINT metas_ibfk_1
    FOREIGN KEY (usuario_id)
    REFERENCES usuarios(id)
    ON DELETE CASCADE

);