DROP DATABASE IF EXISTS lazloLMVL;
CREATE DATABASE IF NOT EXISTS lazloLMVL;
USE lazloLMVL;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username_login VARCHAR(50) NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS last_updated_at (
    id INT PRIMARY KEY DEFAULT 1,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO users (username_login, username, password) VALUES ('v', 'Vanny', SHA2('v', 256));
INSERT INTO users (username_login, username, password) VALUES ('l', 'Lucas', SHA2('l', 256));

INSERT INTO last_updated_at (id) VALUES (1);
