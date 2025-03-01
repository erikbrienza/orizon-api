CREATE Database IF NOT EXISTS orizon_travel;
USE orizon_travel;

--Tabella per i Paesi
CREATE TABLE IF NOT EXISTS countries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE
);

-- Tabella per i viaggi
CREATE TABLE IF NOT EXISTS trips (
   id INT AUTO_INCREMENT PRIMARY KEY,
    country_id INT NOT NULL,
    seats_available INT NOT NULL CHECK (seats_available >= 0),
    FOREIGN KEY (country_id) REFERENCES countries(id) ON DELETE CASCADE
);