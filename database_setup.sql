-- ============================================================
-- Unified Database Setup for TSA2Camacho
-- Database: tsa1camacho
-- Tables: users, tasks, customers
-- ============================================================

CREATE DATABASE IF NOT EXISTS tsa1camacho;
USE tsa1camacho;

-- Drop existing tables to ensure a clean schema reset
DROP TABLE IF EXISTS tasks;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS customers;

-- ------------------------------------------------------------
-- 1. Table structure for table `users`
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL DEFAULT '',
    created_at DATETIME NOT NULL
);

-- ------------------------------------------------------------
-- 2. Table structure for table `tasks`
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    status ENUM('pending', 'in_progress', 'completed') DEFAULT 'pending',
    task_date DATE NOT NULL,
    is_archived TINYINT(1) NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL
);

-- ------------------------------------------------------------
-- 3. Table structure for table `customers`
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    created_at DATETIME NOT NULL
);

-- ------------------------------------------------------------
-- Seed Data for table `users`
-- Default password for accounts: password123 (hashed via bcrypt)
-- ------------------------------------------------------------
INSERT INTO users (id, username, full_name, email, password, created_at) VALUES
(202310616, 'valerie_camacho', 'Ann Valerie L. Camacho', 'valerie.camacho@gmail.com', '$2y$10$WhNKxPzXg9Bkq8t2SbgqF.hBJSFzY/XUQDywZHPIJ.rCFJd8DC5qq', NOW()),
(1, 'admin', 'Administrator', 'admin@example.com', '$2y$10$WhNKxPzXg9Bkq8t2SbgqF.hBJSFzY/XUQDywZHPIJ.rCFJd8DC5qq', NOW()),
(2, 'cashier1', 'John Smith', 'cashier1@example.com', '$2y$10$WhNKxPzXg9Bkq8t2SbgqF.hBJSFzY/XUQDywZHPIJ.rCFJd8DC5qq', NOW()),
(3, 'cashier2', 'Jane Doe', 'cashier2@example.com', '$2y$10$WhNKxPzXg9Bkq8t2SbgqF.hBJSFzY/XUQDywZHPIJ.rCFJd8DC5qq', NOW()),
(4, 'manager', 'Robert Johnson', 'manager@example.com', '$2y$10$WhNKxPzXg9Bkq8t2SbgqF.hBJSFzY/XUQDywZHPIJ.rCFJd8DC5qq', NOW()),
(5, 'supervisor', 'Emily Brown', 'supervisor@example.com', '$2y$10$WhNKxPzXg9Bkq8t2SbgqF.hBJSFzY/XUQDywZHPIJ.rCFJd8DC5qq', NOW());

-- ------------------------------------------------------------
-- Seed Data for table `tasks`
-- ------------------------------------------------------------
INSERT INTO tasks (title, status, task_date, is_archived, created_at) VALUES
('Complete project documentation', 'in_progress', CURDATE(), 0, NOW()),
('Review code changes', 'pending', CURDATE(), 0, NOW()),
('Database optimization', 'pending', DATE_ADD(CURDATE(), INTERVAL 1 DAY), 0, NOW()),
('User interface updates', 'pending', DATE_ADD(CURDATE(), INTERVAL 2 DAY), 0, NOW()),
('Security audit', 'pending', DATE_ADD(CURDATE(), INTERVAL 3 DAY), 0, NOW()),
('Performance testing', 'pending', DATE_ADD(CURDATE(), INTERVAL 4 DAY), 0, NOW()),
('API integration', 'pending', DATE_ADD(CURDATE(), INTERVAL 5 DAY), 0, NOW()),
('Deployment preparation', 'pending', DATE_ADD(CURDATE(), INTERVAL 6 DAY), 0, NOW());

-- ------------------------------------------------------------
-- Seed Data for table `customers`
-- ------------------------------------------------------------
INSERT INTO customers (full_name, email, phone, created_at) VALUES
('Juan Dela Cruz', 'juan@example.com', '09171234567', NOW()),
('Maria Santos', 'maria@example.com', '09181234567', NOW()),
('Pedro Reyes', 'pedro@example.com', '09191234567', NOW()),
('Ana Garcia', 'ana@example.com', '09201234567', NOW()),
('Mark Flores', 'mark@example.com', '09211234567', NOW());
