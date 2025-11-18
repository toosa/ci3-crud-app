-- Create database
CREATE DATABASE IF NOT EXISTS ci3webapp;

-- Create user and grant privileges
CREATE USER IF NOT EXISTS 'ci3user'@'localhost' IDENTIFIED BY 'ci3password';
GRANT ALL PRIVILEGES ON ci3webapp.* TO 'ci3user'@'localhost';
FLUSH PRIVILEGES;

-- Use the database
USE ci3webapp;

-- Create users table for CRUD operations
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert sample data
INSERT INTO users (name, email, phone, address) VALUES 
('John Doe', 'john.doe@example.com', '123-456-7890', '123 Main St, City, State'),
('Jane Smith', 'jane.smith@example.com', '098-765-4321', '456 Oak Ave, City, State'),
('Bob Johnson', 'bob.johnson@example.com', '555-123-4567', '789 Pine Rd, City, State');