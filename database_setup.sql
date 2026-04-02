CREATE DATABASE IF NOT EXISTS cosmic_museum;
USE cosmic_museum;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    is_admin BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    message TEXT NOT NULL,
    rating INT CHECK (rating >= 1 AND rating <= 5),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS exhibits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS timeline_events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    era VARCHAR(50) NOT NULL,
    discovery TEXT NOT NULL,
    impact TEXT NOT NULL,
    sort_order INT DEFAULT 0
);

-- Insert sample exhibits
INSERT INTO exhibits (title, description, image_url) VALUES
('Cosmic Order', 'How ancient civilizations mapped the stars.', 'images/cosmic-order.jpg'),
('Celestial Monuments', 'Structures built to align with the heavens.', 'images/monuments.jpg');
