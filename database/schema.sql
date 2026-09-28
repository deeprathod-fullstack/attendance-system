-- ---------------------------------------------------------------------------
-- Attendance System - database schema
--
-- Creates the `attendance` database and all tables, plus one admin account:
--     email:    admin@example.com
--     password: admin123        (change it after your first login!)
--
-- WARNING: re-importing this file DROPS the existing tables and all their data.
-- Optional demo data lives in seed.sql - import it after this file.
-- ---------------------------------------------------------------------------

CREATE DATABASE IF NOT EXISTS `attendance`
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE `attendance`;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `attendance`, `feedback`, `student`, `teacher`, `admin`;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE `admin` (
    `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(50)  NOT NULL,
    `last_name`  VARCHAR(50)  NOT NULL DEFAULT '',
    `email`      VARCHAR(100) NOT NULL,
    `password`   VARCHAR(255) NOT NULL COMMENT 'password_hash() output',
    `created_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_admin_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `teacher` (
    `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(50)  NOT NULL,
    `last_name`  VARCHAR(50)  NOT NULL,
    `email`      VARCHAR(100) NOT NULL,
    `password`   VARCHAR(255) NOT NULL COMMENT 'password_hash() output',
    `image`      VARCHAR(255) NULL COMMENT 'File name inside admin/upload/',
    `created_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_teacher_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- The student id doubles as the roll number shown in the app.
CREATE TABLE `student` (
    `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(50)  NOT NULL,
    `last_name`  VARCHAR(50)  NOT NULL,
    `email`      VARCHAR(100) NOT NULL,
    `password`   VARCHAR(255) NOT NULL COMMENT 'password_hash() output',
    `image`      VARCHAR(255) NULL COMMENT 'File name inside admin/upload/',
    `created_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_student_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- One row per student per day; the unique key makes double-marking impossible.
CREATE TABLE `attendance` (
    `id`              INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `student_id`      INT UNSIGNED NOT NULL,
    `attendance_date` DATE         NOT NULL,
    `is_present`      TINYINT(1)   NOT NULL COMMENT '1 = present, 0 = absent',
    `marked_at`       TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_attendance_student_date` (`student_id`, `attendance_date`),
    KEY `idx_attendance_date` (`attendance_date`),
    CONSTRAINT `fk_attendance_student`
        FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `feedback` (
    `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name`       VARCHAR(100) NOT NULL,
    `email`      VARCHAR(100) NOT NULL,
    `phone`      VARCHAR(20)  NOT NULL,
    `message`    TEXT         NOT NULL,
    `created_at` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Default admin account (password: admin123)
INSERT INTO `admin` (`first_name`, `last_name`, `email`, `password`) VALUES
    ('Site', 'Admin', 'admin@example.com', '$2y$10$Td/7vDzho7nAP4Y5qxTpu.8/AA8vOCzVzNvWO7e9uKPnR0OaTRNAW');
