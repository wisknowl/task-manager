# Task Management Application

## Overview
This is a simple Task Management Application built with Laravel. Users can manage their to-do lists, including creating, reading, updating, and deleting tasks. Each user can only see their own tasks.

## Features
- User Authentication (Register and Login)
- Task Management (CRUD)
- Task Filters (by status and due date)
- Input Validation

## Requirements
- PHP >= 8.2
- Composer
- Nodejs 18+
- Laravel >= 11
- MySQL or MariaDB

## Installation

### Step 1: Clone the Repository

- git clone https://github.com/wisknowl/task-manager.git
- cd task-manager

### Step 2: Install Dependencies

- composer install
- npm install
- npm run dev

### Step 3: Setup the environment variables

- cp .env.example .env

- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=task_manager

### Step 4: Creating Database

- Create a new database in your MySQL or MariaDB server: task_manager
- Run migrations: php artisan migrate
- Start the development server: php artisan serve
- If you are workin in dev mode run: npm run dev
- The application will be available at http://localhost:8000.

### Step 5: Running seeder
Run seeder to create test user and populate task table on database: 
- php artisan migrate:fresh --seed      
- php artisan db:seed --class=TaskSeeder

### Step 6: Login Details

- Email: test@example.com
- Password: 12345678