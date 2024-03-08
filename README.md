# **Job Recruitment Platform**

## Overview
This Job Recruitment Platform features distinct jobSeeker and employer interfaces. Job Seekers can explore job listings posted by employers and upload their resumes for potential job opportunities. Also job seeker can filter categories and search accordingly. In addition, Job seeker can see the names of all the companies who have posted or uploaded job listings. Employers, on the other hand, have exclusive access to uploading job listing, edit, delete and view that job listings.

## Features
- Job Seeker Authentication (Registration, Login, Logout)
- Employer Authentication (Registration, Login, Logout)
- Job Listing Management by Employer (create, edit, delete, view)
- Job Seeker can upload resumes
- Simple and intuitive UI

## Requirements
- PHP >= 8.1
- Composer
- Node.js >= 21.6.2
- NPM >= 10.2.4
- MySQL

## installation

Step 1: Clone the Repository

Clone the repository to your local machine using Git.
```bash
$ git clone https://github.com/shreya-zignuts/job-recruitment
```

Step 2: Navigate to the Project Directory

Change your current directory to the project directory.
```bash
$ cd job-recruitment-system
```

Step 3: Install Composer Dependencies

Install the PHP dependencies using Composer.
```bash
$ composer install
```

Step 4: Install NPM Dependencies

Install the JavaScript dependencies using NPM.
```bash
$ npm install
```

Step 5: Copy the Environment File

Copy the .env.example file to .env.
```bash
$ cp .env.example .env
```

Step 6: Generate Application Key

Generate an application key.
```bash
$ php artisan key:generate
```

Step 7: Configure Database Connection

Configure your database connection in the .env file.
```make
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

Step 8: Run Migrations and Seeders

Run database migrations and seeders to create database tables and populate them with initial data.
```bash
$ php artisan migrate --seed
```

Step 9: Compile Assets

Compile assets using Laravel Mix.
```bash
$ npm run dev
```

Step 10: Start the Development Server

Start the development server to run the application.
```bash
$ php artisan serve
```

Step 11: Access the Application

Open your web browser and visit http://localhost:8000 to access the application.