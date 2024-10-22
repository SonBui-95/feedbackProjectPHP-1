/* Create example Database in MySQL manually*/
CREATE DATABASE phpapp;

USE phpapp;

CREATE TABLE feedback (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    name NVARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    body NVARCHAR(150) NOT NULL,
    date DATETIME DEFAULT NOW(),
    pic VARCHAR(150) DEFAULT NULL
);

INSERT INTO feedback(name, email, body, pic) VALUES
('John', 'john@gmail.com', 'I like it', NULL),
('Tony', 'tony@gmail.com', 'Please add more videos', NULL),
('Huy', 'huy@gmail.com', 'PHP is good', NULL),
('Son', 'son@gmail.com', 'KDB+ is fast', 'uploads/1729527838.png');

