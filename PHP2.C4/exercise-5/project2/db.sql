CREATE TABLE classrooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reg_no VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    grade VARCHAR(1) NOT NULL,
    classroom_id INT NOT NULL,
    FOREIGN KEY (classroom_id) REFERENCES classrooms(id)
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Insert a default user (username: admin, password: admin)
INSERT INTO users (username, password) VALUES ('admin', 'admin');
