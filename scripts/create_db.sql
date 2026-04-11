-- Creates lifecare database and user
CREATE DATABASE IF NOT EXISTS `lifecare` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS 'lifecare'@'localhost' IDENTIFIED BY 'secret';
GRANT ALL PRIVILEGES ON `lifecare`.* TO 'lifecare'@'localhost';
FLUSH PRIVILEGES;
