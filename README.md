# API Documentation for School Management System

## Table of Contents

1. [Introduction](#introduction)
2. [Features](#features)
3. [Technologies Used](#technologies-used)
4. [Installation](#installation)
5. [Database Structure](#database-structure)
6. [API Endpoints](#api-endpoints)
    - [Jurusan (Department)](#jurusan-endpoints)
    - [Tingkat (Level)](#tingkat-endpoints)
    - [Siswa (Student)](#siswa-endpoints)
    - [Device](#device-endpoints)
    - [Setting](#setting-endpoints)
7. [Author](#author)

---

## Introduction
This project is a School Management System API designed to handle CRUD operations for various entities such as Jurusan (Departments), Tingkat (Levels), Siswa (Students), Devices, and Settings. It is built with Laravel and follows RESTful principles, providing a structured, scalable, and efficient backend for school management.

## Features
- Manage departments, levels, and students with soft deletes and relational integrity.
- Generate and update secret keys for settings.
- Handle student registration with dynamic updates to related entities (Jurusan and Tingkat).
- Comprehensive error handling and validation.

## Technologies Used
- **Framework**: Laravel
- **Database**: PostgreSQL
- **Language**: PHP
- **Others**: Composer, Artisan CLI, UUID support

## Installation

1. Clone the repository:
    ```bash
    git clone <repository-url>
    cd <repository-folder>
    ```
2. Install dependencies:
    ```bash
    composer install
    ```
3. Set up the `.env` file:
    ```env
    APP_NAME=SchoolManagement
    APP_ENV=local
    APP_KEY=
    APP_DEBUG=true
    APP_URL=http://localhost

    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=school_db
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```
4. Generate the application key:
    ```bash
    php artisan key:generate
    ```
5. Run migrations:
    ```bash
    php artisan migrate
    ```
6. Serve the application:
    ```bash
    php artisan serve
    ```

## Database Structure

### Tables Overview

1. **Jurusan**:
    - `id`: UUID, Primary Key
    - `nama`: String
    - `is_active`: TinyInteger

2. **Tingkat**:
    - `id`: UUID, Primary Key
    - `nama`: String
    - `is_active`: TinyInteger
    - `isUse`: Boolean (Dynamic Update)

3. **Siswa**:
    - `id`: UUID, Primary Key
    - `id_jurusan`: Foreign Key
    - `id_tingkat`: Foreign Key
    - Other attributes: `kode`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `nomor`, `start_date`

4. **Device**:
    - `id`: UUID, Primary Key
    - `nama`: String
    - `mode`: String (`reader`, `add_card`)
    - `is_active`: TinyInteger

5. **Setting**:
    - `id`: UUID, Primary Key
    - `mode`: String (`clock_in`, `clock_out`)
    - `secret_key`: String (Auto-generated)

## API Endpoints

### Jurusan Endpoints
- **GET /api/jurusan**: Get all departments.
- **POST /api/jurusan**: Create a new department.
- **GET /api/jurusan/{id}**: Get department by ID.
- **PUT /api/jurusan/{id}**: Update a department.
- **DELETE /api/jurusan/{id}**: Delete a department.

### Tingkat Endpoints
- **GET /api/tingkat**: Get all levels.
- **POST /api/tingkat**: Create a new level.
- **GET /api/tingkat/{id}**: Get level by ID.
- **PUT /api/tingkat/{id}**: Update a level.
- **DELETE /api/tingkat/{id}**: Delete a level.

### Siswa Endpoints
- **GET /api/siswa**: Get all students.
- **POST /api/siswa**: Register a new student.
- **GET /api/siswa/{id}**: Get student by ID.
- **PUT /api/siswa/{id}**: Update a student.
- **DELETE /api/siswa/{id}**: Remove a student and update related entities.

### Device Endpoints
- **GET /api/device**: Get all devices.
- **POST /api/device**: Add a new device.
- **GET /api/device/{id}**: Get device by ID.
- **PUT /api/device/{id}**: Update a device.
- **DELETE /api/device/{id}**: Remove a device.

### Setting Endpoints
- **GET /api/settings**: Get all settings.
- **POST /api/settings**: Add a new setting with an auto-generated `secret_key`.
- **GET /api/settings/{id}**: Get setting by ID.
- **PUT /api/settings/{id}**: Update the mode of a setting.
- **PUT /api/settings/{id}/regenerate-secret**: Regenerate the `secret_key` for a setting.
- **DELETE /api/settings/{id}**: Delete a setting.

## Author
**Jayadana**

This project was created to streamline school management with efficient APIs. For any inquiries or contributions, feel free to reach out!
