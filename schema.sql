-- Club Members Manager - database setup
-- Import this file in phpMyAdmin before you start.

DROP DATABASE IF EXISTS club_db;
CREATE DATABASE club_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE club_db;

CREATE TABLE members (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    full_name   VARCHAR(100)   NOT NULL,
    email       VARCHAR(120)   NOT NULL,
    phone       VARCHAR(15)    NOT NULL,
    role        VARCHAR(20)    NOT NULL,
    fee_paid    DECIMAL(8,2)   NOT NULL DEFAULT 0,
    date_joined DATE           NOT NULL,
    created_at  TIMESTAMP      NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO members (full_name, email, phone, role, fee_paid, date_joined) VALUES
('Anjali Ramdhony',  'anjali@school.mu',  '57123456', 'President',  500.00, '2025-01-15'),
('Kevin Lai Fat',    'kevin@school.mu',   '52987654', 'Treasurer',  500.00, '2025-02-03'),
('Yashna Bhugaloo',  'yashna@school.mu',  '58445566', 'Secretary',  350.00, '2025-02-20'),
('Dylan Appadoo',    'dylan@school.mu',   '59112233', 'Member',     250.00, '2025-03-08');
