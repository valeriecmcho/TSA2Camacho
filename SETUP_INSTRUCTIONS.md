# TSA2 Database Setup Instructions

## Overview
Ang database setup ay pinag-isa na sa iisang script at SQL file na naglalaman ng lahat ng kailangang tables (`users`, `tasks`, at `customers`) kasama ang kumpletong schema (authentication password at archived flags) at seed data.

## Database Details
- **Database Name:** `tsa1camacho`
- **Tables:**
  - `users` (id, username, full_name, email, password, created_at)
  - `tasks` (id, title, status, task_date, is_archived, created_at)
  - `customers` (id, full_name, email, phone, created_at)

---

## Paano Patakbuhin ang Setup (Pumili ng isa)

### Option 1: Via CLI (Pinakamabilis)
Buksan ang terminal sa folder ng project (`c:\xampp\htdocs\TSA2Camacho`) at patakbuhin:
```bash
php setup_database.php
```

### Option 2: Via Browser
1. Siguraduhing tumatakbo ang **Apache** at **MySQL** sa XAMPP Control Panel.
2. Buksan ang browser at pumunta sa:
   - `http://localhost/TSA2Camacho/setup_database.php`
   *(o `http://localhost:8080/setup_database.php` kung gamit ang spark serve)*

### Option 3: Via phpMyAdmin (Gamit ang SQL File)
1. Buksan ang phpMyAdmin: `http://localhost/phpmyadmin`
2. I-import o i-run ang laman ng [database_setup.sql](file:///c:/xampp/htdocs/TSA2Camacho/database_setup.sql).

---

## Default Login Credentials
- **Username:** `valerie_camacho`
- **Password:** `password123`

*(Available din ang admin account: `admin` / `password123`)*

---

## Verification Checklist
- [x] Database `tsa1camacho` ay nagagawa nang buo
- [x] Tables (`users`, `tasks`, `customers`) ay kumpleto ang columns
- [x] Seed data (sample tasks, default users with hashed passwords, customers) ay nakapasok
- [x] Login page gumagana gamit ang credentials
- [x] Tasks CRUD at Task display gumagana nang maayos
