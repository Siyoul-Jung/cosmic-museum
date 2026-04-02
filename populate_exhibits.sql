USE cosmic_museum;

-- Clear existing sample data
TRUNCATE TABLE exhibits;

-- Insert actual content for Architecture page
INSERT INTO exhibits (title, description, image_url) VALUES
('Stonehenge', 'Aligned with the solstice sunrise, this prehistoric ring may have served as a solar and lunar observatory — a calendar carved in stone.', 'images/stonehenge.jpg'),
('Newgrange', 'At dawn on winter solstice, sunlight travels through a 19-meter passage to illuminate the inner chamber — symbolizing cosmic renewal.', 'images/newgrange.jpg'),
('Pyramid of Kukulcán', 'During equinox, light and shadow form a serpent slithering down the staircase — a union of architecture, ritual, and astronomy.', 'images/maya-temple.jpg');
