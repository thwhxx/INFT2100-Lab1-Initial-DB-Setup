-- SQL Script for creating and populating the 'users' table
-- Author: Anh Thu Huynh
-- Date: Sep 29th, 2023
-- Course Code: INFT-2100-06 - Web Development Intermediate

-- Drop the existing 'users' table if it exists
DROP TABLE IF EXISTS users;
CREATE EXTENSION IF NOT EXISTS pgcrypto;
-- Create the 'users' table
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    created_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login_time TIMESTAMP,
    phone_extension VARCHAR(10),
    user_type CHAR(1) NOT NULL DEFAULT 'A'
);

-- Insert data
INSERT INTO users (email, first_name, last_name, password_hash, phone_extension, user_type)
VALUES 
    ('messi@gmail.com', 'Lionel', 'Messi', crypt('some', gen_salt('bf')), '7890', 'A'),
    ('Kimmich@gmail.com', 'Joshua', 'Kimmich', crypt('some', gen_salt('bf')), '5678', 'A'),
    ('Iniesta@gmail.com', 'Andres', 'Iniesta', crypt('some', gen_salt('bf')), '1234', 'A');
