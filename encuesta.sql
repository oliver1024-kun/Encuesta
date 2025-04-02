CREATE DATABASE IF NOT EXISTS encuesta;
USE encuesta;

CREATE TABLE IF NOT EXISTS respuestas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mayor_edad VARCHAR(3),
    sabor VARCHAR(10),
    calidad VARCHAR(10),
    presentacion VARCHAR(10),
    recomendacion VARCHAR(3)
);
