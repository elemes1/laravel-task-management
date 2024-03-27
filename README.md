
# Task Management System (TMS) - Laravel Application




## Project Overview

Welcome to the Task Management System (TMS), a Laravel-based web application designed to streamline the process of managing tasks. This system allows users to register, log in, and effortlessly handle their tasks with features to create, update, delete, and list tasks.


## Key Features
-  User Registration and Authentication: Securely register and log in to manage tasks.

- Project / Plan Management: Trello like feature to Create plans/project . which houses various tasks.

- Task Management: Create, update, and delete tasks. Tasks include details such as title, description, due date, priority, and status.

- Event-Driven Architecture: Leverages Laravel's event system for actions like email notifications.

- Laravel Livewire & alpine Frontend: Showcases real-time UI updates and interactive components.

- Laravel Filament Admin: Provides a rich admin panel for enhanced management capabilities.



## Technical Specifications

Laravel 11  and PHP 8.2: Adheres to Laravel best practices with the use of the latest PHP features.

Authentication and Authorization: Utilizes Laravel's built-in features with policy-based access control.

Database: Uses migrations for schema definition and seeders for initial data setup.

Testing:  unit and feature tests.




## Installation & Setup

- Clone Repository: git clone git@github.com:elemes1/laravel-task-management.git

- Install Dependencies: Navigate to the project directory and run -



```bash
  composer install
```

- Environment Configuration: Copy .env.example to .env and configure your environment settings.

- Generate Key: Run php artisan key:generate.
- Run Migrations: Set up your database and run php artisan migrate.

- Run Seeders: Populate initial data with php artisan db:seed.
- Start Server: Run php artisan serve and navigate to the provided URL.


## Usage
- Register/Login: Start by registering a new account or logging in.
- To use sample account login with the following credentials
    ```bash
      username : admin@example.com
      password : adminpassword
    ```
- Task Management: Navigate to the task dashboard to start managing your tasks.
- Real-time Updates: Experience the power of Livewire in the task UI.
- Admin Panel:  Access the admin panel for advanced management on /admin  url

Testing
Run the test suite using the command: php artisan test.
```bash
   ./vendor/bin/pest

```

Additional Features
Trello Like  Kanban Board
File Attachments: Attach files to tasks for better context.
Background Email Notifications: Leverage Laravel's queue system for non-blocking email notifications.

This project was designed with a focus on effective architecture, quality coding practices, comprehensive feature implementation, innovation, and thorough testing. It demonstrates the capabilities of Laravel and PHP in building modern web applications.


## Screenshots

![App Screenshot](https://i.ibb.co/vhkStqX/Todoist.png)

