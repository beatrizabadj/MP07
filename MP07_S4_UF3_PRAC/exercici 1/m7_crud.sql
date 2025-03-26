-- crear base de dades
CREATE DATABASE IF NOT EXISTS m7_crud;
USE m7_crud;

-- taula usuaris
CREATE TABLE IF NOT EXISTS usuaris (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    edat INT NOT NULL
);

-- dades de prova
INSERT INTO usuaris (nom, email, edat)
SELECT 'Joan Garcia', 'joan@example.com', 30 
UNION ALL
SELECT 'Maria López', 'maria@example.com', 25 
UNION ALL
SELECT 'Pere Font', 'pere@example.com', 40
WHERE NOT EXISTS (SELECT 1 FROM usuaris);